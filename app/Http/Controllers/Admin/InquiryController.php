<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\InquiryReply;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inquiry::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $inquiries = $query->orderByDesc('created_at')->paginate(15);

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show(Inquiry $inquiry)
    {
        $inquiry->load('replies.user');

        if ($inquiry->status === 'new') {
            $inquiry->update(['status' => 'read']);
        }

        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function updateStatus(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,read,replied,archived,spam',
        ]);

        $inquiry->update([
            'status'     => $validated['status'],
            'replied_at' => $validated['status'] === 'replied' ? ($inquiry->replied_at ?? now()) : $inquiry->replied_at,
        ]);

        return back()->with('success', 'Inquiry status updated.');
    }

    public function reply(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        InquiryReply::create([
            'inquiry_id' => $inquiry->id,
            'user_id'    => auth()->id(),
            'message'    => $validated['message'],
        ]);

        $inquiry->update([
            'status'     => 'replied',
            'replied_at' => now(),
            'replied_by' => auth()->id(),
        ]);

        // Send reply email to the inquiry submitter
        try {
            Mail::to($inquiry->email)
                ->send(new InquiryReplyMail($inquiry, $validated['message']));
        } catch (\Throwable $e) {
            Log::error('Failed to send inquiry reply email', [
                'inquiry_id' => $inquiry->id,
                'error'      => $e->getMessage(),
            ]);
        }

        return back()->with('success', 'Reply sent successfully.');
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Inquiry deleted successfully.');
    }
}

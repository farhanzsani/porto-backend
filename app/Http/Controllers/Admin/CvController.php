<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CvController extends Controller
{
    public function index()
    {
        $cvs = Cv::orderByDesc('created_at')->paginate(10);

        return view('admin.cvs.index', compact('cvs'));
    }

    public function create()
    {
        return view('admin.cvs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'file'     => 'required|file|mimes:pdf,doc,docx|max:10240',
            'is_active' => 'boolean',
        ]);

        $file = $request->file('file');
        $path = $file->store('cvs', 'public');

        Cv::create([
            'title'             => $request->input('title'),
            'file_path'         => $path,
            'original_filename' => $file->getClientOriginalName(),
            'mime_type'         => $file->getMimeType(),
            'file_size'         => $file->getSize(),
            'is_active'         => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.cvs.index')
            ->with('success', 'CV uploaded successfully.');
    }

    public function edit(Cv $cv)
    {
        return view('admin.cvs.edit', compact('cv'));
    }

    public function update(Request $request, Cv $cv)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'file'     => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'is_active' => 'boolean',
        ]);

        $data = [
            'title'    => $request->input('title'),
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('file')) {
            // Delete old file
            Storage::disk('public')->delete($cv->file_path);

            $file = $request->file('file');
            $data['file_path']         = $file->store('cvs', 'public');
            $data['original_filename'] = $file->getClientOriginalName();
            $data['mime_type']         = $file->getMimeType();
            $data['file_size']         = $file->getSize();
        }

        $cv->update($data);

        return redirect()->route('admin.cvs.index')
            ->with('success', 'CV updated successfully.');
    }

    public function destroy(Cv $cv)
    {
        Storage::disk('public')->delete($cv->file_path);
        $cv->delete();

        return redirect()->route('admin.cvs.index')
            ->with('success', 'CV deleted successfully.');
    }
}

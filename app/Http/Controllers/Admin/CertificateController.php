<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderByDesc('issue_date')->paginate(10);

        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                => 'required|string|max:255',
            'issuing_organization' => 'required|string|max:255',
            'issue_date'           => 'required|date',
            'expiry_date'          => 'nullable|date|after_or_equal:issue_date',
            'credential_id'        => 'nullable|string|max:100',
            'credential_url'       => 'nullable|url|max:255',
            'image'                => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description'          => 'nullable|string',
            'is_active'            => 'boolean',
        ]);

        $data = [
            ...$validated,
            'is_active' => $request->boolean('is_active', true),
        ];

        unset($data['image']);

        if ($request->hasFile('image')) {
            $data['image_path'] = Storage::url(
                $request->file('image')->store('certificates', 'public')
            );
        }

        Certificate::create($data);

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Certificate created successfully.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'title'                => 'required|string|max:255',
            'issuing_organization' => 'required|string|max:255',
            'issue_date'           => 'required|date',
            'expiry_date'          => 'nullable|date|after_or_equal:issue_date',
            'credential_id'        => 'nullable|string|max:100',
            'credential_url'       => 'nullable|url|max:255',
            'image'                => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description'          => 'nullable|string',
            'is_active'            => 'boolean',
        ]);

        $data = [
            ...$validated,
            'is_active' => $request->boolean('is_active'),
        ];

        unset($data['image']);

        if ($request->hasFile('image')) {
            $this->deleteStoredImage($certificate->image_path);
            $data['image_path'] = Storage::url(
                $request->file('image')->store('certificates', 'public')
            );
        }

        $certificate->update($data);

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Certificate updated successfully.');
    }

    public function destroy(Certificate $certificate)
    {
        $this->deleteStoredImage($certificate->image_path);
        $certificate->delete();

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Certificate deleted successfully.');
    }

    protected function deleteStoredImage(?string $url): void
    {
        if (!$url || !str_starts_with($url, '/storage/')) {
            return;
        }

        Storage::disk('public')->delete(Str::after($url, '/storage/'));
    }
}


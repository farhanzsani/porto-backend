<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        $groups = Setting::orderBy('group')->orderBy('key')->get()->groupBy('group');

        return view('admin.settings.index', compact('groups'));
    }

    public function update(Request $request)
    {
        $settings = Setting::all();

        $rules = [
            'settings' => 'nullable|array',
        ];

        foreach ($settings as $setting) {
            if ($setting->type === 'file') {
                $rules['settings.' . $setting->key] = 'nullable|file|mimes:png,jpg,jpeg,svg,webp,ico|max:2048';
            }
        }

        $validated = $request->validate($rules);

        foreach ($settings as $setting) {
            $value = $validated['settings'][$setting->key] ?? null;

            if ($setting->type === 'file') {
                if ($request->hasFile('settings.' . $setting->key)) {
                    $this->deleteStoredFile($setting->value);
                    $path = $request->file('settings.' . $setting->key)->store('settings', 'public');
                    $setting->update(['value' => Storage::url($path)]);
                }
                continue;
            }

            if ($setting->type === 'boolean') {
                $value = $value === '1' || $value === true ? 'true' : 'false';
            } elseif ($setting->type === 'number') {
                $value = $value === null ? null : $value;
            }

            if ($value !== null || $setting->type !== 'text') {
                $setting->update(['value' => is_array($value) ? json_encode($value) : $value]);
            }
        }

        return back()->with('success', 'Settings updated successfully.');
    }

    protected function deleteStoredFile(?string $url): void
    {
        if (!$url || !str_starts_with($url, '/storage/')) {
            return;
        }

        Storage::disk('public')->delete(Str::after($url, '/storage/'));
    }
}
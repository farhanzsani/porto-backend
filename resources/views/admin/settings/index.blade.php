@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="space-y-4">
        <div>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Site Settings</h2>
            <p class="text-theme-sm text-gray-500 dark:text-gray-400">Manage global configuration</p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            @foreach ($groups as $group => $settings)
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                        <h3 class="text-lg font-semibold text-gray-800 capitalize dark:text-white/90">{{ $group }}</h3>
                    </div>

                    <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2 sm:p-6">
                        @foreach ($settings as $setting)
                            <div>
                                <label for="setting-{{ $setting->key }}" class="mb-1.5 block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                                    {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                                    @if ($setting->description)
                                        <span class="block text-theme-xs font-normal text-gray-400 dark:text-gray-500">{{ $setting->description }}</span>
                                    @endif
                                </label>

                                @if ($setting->type === 'boolean')
                                    <select name="settings[{{ $setting->key }}]" id="setting-{{ $setting->key }}" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                                        <option value="1" {{ $setting->value === 'true' || $setting->value == 1 ? 'selected' : '' }}>Enabled</option>
                                        <option value="0" {{ $setting->value === 'false' || $setting->value == 0 ? 'selected' : '' }}>Disabled</option>
                                    </select>
                                @elseif ($setting->type === 'json')
                                    <textarea name="settings[{{ $setting->key }}]" id="setting-{{ $setting->key }}" rows="3" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm font-mono text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">{{ json_decode($setting->value, true) ? json_encode(json_decode($setting->value, true), JSON_PRETTY_PRINT) : '' }}</textarea>
                                @elseif ($setting->type === 'file')
                                    @if ($setting->value)
                                        <img src="{{ $setting->value }}" alt="{{ $setting->key }}" class="mb-3 h-16 w-16 rounded-lg border border-gray-200 object-cover dark:border-gray-800">
                                    @endif
                                    <input type="file" name="settings[{{ $setting->key }}]" id="setting-{{ $setting->key }}" accept="image/*" class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs file:mr-3 file:rounded-lg file:border-0 file:bg-brand-500 file:px-4 file:py-2 file:text-sm file:font-medium file:text-white hover:file:bg-brand-600 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:file:bg-brand-600">
                                @else
                                    <input type="{{ $setting->type === 'number' ? 'number' : 'text' }}" name="settings[{{ $setting->key }}]" id="setting-{{ $setting->key }}" value="{{ $setting->value }}" class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-brand-500 px-4 py-2.5 text-theme-sm font-medium text-white shadow-theme-xs transition-colors hover:bg-brand-600">
                Save Settings
            </button>
        </form>
    </div>
@endsection
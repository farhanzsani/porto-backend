@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-theme-sm space-y-1 text-error-600 dark:text-error-400']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
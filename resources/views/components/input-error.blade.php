@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 pt-1']) }}>{{ $message }}</p>
@enderror

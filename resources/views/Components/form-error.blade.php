@props(['name'])

@error($name)
    <p {{ $attributes->merge(['class' => "text-xs text-red-500 font-semifold mt-1"]) }}>{{ $message }}</p>
@enderror

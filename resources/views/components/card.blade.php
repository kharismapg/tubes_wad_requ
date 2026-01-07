@props(['title' => null, 'description' => null, 'footer' => null, 'contentPadding' => true])

<div {{ $attributes->merge(['class' => 'bg-white border border-gray-200 rounded-xl shadow-sm']) }}>
    @if($title || $description)
        <div class="flex flex-col space-y-1.5 p-6">
            @if($title)
                <h3 class="font-semibold leading-none tracking-tight">{{ $title }}</h3>
            @endif
            @if($description)
                <p class="text-sm text-gray-500">{{ $description }}</p>
            @endif
        </div>
    @endif

    <div class="{{ $contentPadding ? 'p-6 pt-0' : '' }}">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="flex items-center p-6 pt-0">
            {{ $footer }}
        </div>
    @endif
</div>
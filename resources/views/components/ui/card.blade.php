@props(['padding' => true])

<div {{ $attributes->merge(['class' => 'bg-card border border-border rounded-xl shadow-sm overflow-hidden']) }}>
    @if($padding)
    <div class="p-6">
        {{ $slot }}
    </div>
    @else
        {{ $slot }}
    @endif
</div>

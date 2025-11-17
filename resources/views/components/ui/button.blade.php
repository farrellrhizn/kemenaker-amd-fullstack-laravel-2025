@props(['variant' => 'primary', 'size' => 'md', 'type' => 'button'])

@php
    $baseClasses = 'inline-flex items-center font-medium rounded-lg transition-colors shadow-sm';
    
    $variantClasses = match($variant) {
        'primary' => 'bg-primary text-primary-foreground hover:bg-primary/90',
        'view' => 'bg-chart-4 text-white hover:bg-chart-4/90',
        'edit' => 'bg-chart-3 text-white hover:bg-chart-3/90',
        'delete' => 'bg-destructive text-destructive-foreground hover:bg-destructive/90',
        'muted' => 'bg-muted text-foreground hover:bg-muted/80',
        default => 'bg-primary text-primary-foreground hover:bg-primary/90',
    };
    
    $sizeClasses = match($size) {
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
        default => 'px-4 py-2 text-sm',
    };
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => "$baseClasses $variantClasses $sizeClasses"]) }}>
    {{ $slot }}
</button>

@props(['title', 'buttonText' => null, 'buttonRoute' => null])

<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-foreground">{{ $title }}</h1>
    @if($buttonText && $buttonRoute)
    <a href="{{ $buttonRoute }}" class="inline-flex items-center px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors shadow-sm font-medium">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        {{ $buttonText }}
    </a>
    @endif
</div>

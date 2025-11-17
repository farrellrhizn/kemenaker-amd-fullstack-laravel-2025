@props(['route', 'placeholder' => 'Search...'])

<div class="mb-6">
    <form action="{{ $route }}" method="GET" class="flex gap-2">
        <div class="flex-1">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}" 
                   placeholder="{{ $placeholder }}" 
                   class="w-full px-4 py-2 border border-border rounded-lg bg-card text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
        </div>
        <button type="submit" class="inline-flex items-center px-6 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors shadow-sm font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Search
        </button>
        @if(request('search'))
        <a href="{{ $route }}" class="inline-flex items-center px-4 py-2 bg-muted text-foreground rounded-lg hover:bg-muted/80 transition-colors shadow-sm font-medium">
            Clear
        </a>
        @endif
    </form>
</div>

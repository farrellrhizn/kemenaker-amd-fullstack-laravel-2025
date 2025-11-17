<x-layout.header :title="$title ?? null" />

<x-layout.navigation />

<!-- Main Content -->
<main class="flex-1 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <x-ui.alert type="success">{{ session('success') }}</x-ui.alert>
        @endif

        @if(session('error'))
            <x-ui.alert type="error">{{ session('error') }}</x-ui.alert>
        @endif

        @yield('content')
    </div>
</main>

<x-layout.footer />

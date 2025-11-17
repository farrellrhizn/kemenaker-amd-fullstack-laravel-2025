<nav class="bg-primary shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <a href="{{ route('dashboard') }}" class="flex items-center text-primary-foreground font-bold text-xl">
                    🐾 PetCare+
                </a>
                <div class="hidden sm:ml-8 sm:flex sm:space-x-1">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-primary-foreground/10 text-primary-foreground' : 'text-primary-foreground/80 hover:bg-primary-foreground/10 hover:text-primary-foreground' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('owners.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('owners.*') ? 'bg-primary-foreground/10 text-primary-foreground' : 'text-primary-foreground/80 hover:bg-primary-foreground/10 hover:text-primary-foreground' }}">
                        Owners
                    </a>
                    <a href="{{ route('pets.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('pets.*') ? 'bg-primary-foreground/10 text-primary-foreground' : 'text-primary-foreground/80 hover:bg-primary-foreground/10 hover:text-primary-foreground' }}">
                        Pets
                    </a>
                    <a href="{{ route('treatments.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('treatments.*') ? 'bg-primary-foreground/10 text-primary-foreground' : 'text-primary-foreground/80 hover:bg-primary-foreground/10 hover:text-primary-foreground' }}">
                        Treatments
                    </a>
                    <a href="{{ route('checkups.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('checkups.*') ? 'bg-primary-foreground/10 text-primary-foreground' : 'text-primary-foreground/80 hover:bg-primary-foreground/10 hover:text-primary-foreground' }}">
                        Checkups
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

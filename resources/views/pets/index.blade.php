@extends('layouts.app')

@section('title', 'Pets - PetCare+')

@section('content')
<x-ui.page-header 
    title="Pets" 
    buttonText="Add New Pet" 
    :buttonRoute="route('pets.create')" 
/>

<x-ui.search-form 
    :route="route('pets.index')" 
    placeholder="Search by pet name, species, registration code, or owner name..." 
/>

<x-ui.card :padding="false">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-border">
            <thead>
                <tr class="bg-muted/50">
                    <th class="px-6 py-3 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Registration Code</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Species</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Age</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Weight</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Owner</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-card divide-y divide-border">
                @foreach($pets as $pet)
                <tr class="hover:bg-muted/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-primary">{{ $pet->registration_code }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-foreground">{{ $pet->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">{{ $pet->species }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">{{ $pet->age }} years</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">{{ $pet->weight }} kg</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">{{ $pet->owner->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="flex gap-2">
                            <a href="{{ route('pets.show', $pet) }}" class="inline-flex items-center px-3 py-1.5 bg-chart-4 text-white rounded-lg hover:bg-chart-4/90 transition-colors text-xs font-medium">View</a>
                            <a href="{{ route('pets.edit', $pet) }}" class="inline-flex items-center px-3 py-1.5 bg-chart-3 text-white rounded-lg hover:bg-chart-3/90 transition-colors text-xs font-medium">Edit</a>
                            <form action="{{ route('pets.destroy', $pet) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-destructive text-destructive-foreground rounded-lg hover:bg-destructive/90 transition-colors text-xs font-medium">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @if($pets->hasPages())
    <div class="px-6 py-4 border-t border-border bg-card">
        {{ $pets->links() }}
    </div>
    @endif
</x-ui.card>
@endsection

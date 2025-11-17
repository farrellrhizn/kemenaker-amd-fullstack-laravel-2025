@extends('layouts.app')

@section('title', 'Owners - PetCare+')

@section('content')
<x-ui.page-header 
    title="Owners" 
    buttonText="Add New Owner" 
    :buttonRoute="route('owners.create')" 
/>

<x-ui.search-form 
    :route="route('owners.index')" 
    placeholder="Search by name, phone, or email..." 
/>

<x-ui.card :padding="false">
    <div class="p-6">
        @if($owners->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-border">
                            <th class="text-left py-3 px-4 text-sm font-medium text-muted-foreground">ID</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-muted-foreground">Name</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-muted-foreground">Phone</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-muted-foreground">Email</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-muted-foreground">Status</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-muted-foreground">Pets</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-muted-foreground">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @foreach($owners as $owner)
                        <tr class="hover:bg-muted/50 transition-colors">
                            <td class="py-3 px-4 text-sm">{{ $owner->id }}</td>
                            <td class="py-3 px-4 text-sm font-medium">{{ $owner->name }}</td>
                            <td class="py-3 px-4 text-sm">{{ $owner->phone }}</td>
                            <td class="py-3 px-4 text-sm text-muted-foreground">{{ $owner->email ?? '-' }}</td>
                            <td class="py-3 px-4">
                                @if($owner->phone_verified)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-chart-1/10 text-chart-1">Verified</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-muted text-muted-foreground">Not Verified</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-sm">{{ $owner->pets_count }}</td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('owners.show', $owner) }}" class="inline-flex items-center px-3 py-1.5 bg-chart-4 text-white rounded-lg hover:bg-chart-4/90 transition-colors text-xs font-medium">View</a>
                                    <a href="{{ route('owners.edit', $owner) }}" class="inline-flex items-center px-3 py-1.5 bg-chart-3 text-white rounded-lg hover:bg-chart-3/90 transition-colors text-xs font-medium">Edit</a>
                                    <form action="{{ route('owners.destroy', $owner) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
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
            
            <div class="mt-6">
                {{ $owners->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-muted-foreground">No owners found. <a href="{{ route('owners.create') }}" class="text-primary hover:underline font-medium">Add one now</a></p>
            </div>
        @endif
    </div>
</x-ui.card>
@endsection

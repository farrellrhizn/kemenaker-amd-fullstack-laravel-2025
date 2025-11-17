@extends('layouts.app')

@section('title', 'Checkups - PetCare+')

@section('content')
<x-ui.page-header 
    title="Checkups" 
    buttonText="Add New Checkup" 
    :buttonRoute="route('checkups.create')" 
/>

<x-ui.search-form 
    :route="route('checkups.index')" 
    placeholder="Search by pet name, owner name, treatment, diagnosis, or notes..." 
/>

<x-ui.card :padding="false">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-border">
            <thead>
                <tr class="bg-muted/50">
                    <th class="px-6 py-3 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Pet</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Owner</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Treatment</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Cost</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-muted-foreground uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-card divide-y divide-border">
                @foreach($checkups as $checkup)
                <tr class="hover:bg-muted/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">{{ $checkup->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">{{ $checkup->checkup_date->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-foreground">{{ $checkup->pet->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">{{ $checkup->pet->owner->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-foreground">{{ $checkup->treatment->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-chart-2">Rp {{ number_format($checkup->cost, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="flex gap-2">
                            <a href="{{ route('checkups.show', $checkup) }}" class="inline-flex items-center px-3 py-1.5 bg-chart-4 text-white rounded-lg hover:bg-chart-4/90 transition-colors text-xs font-medium">View</a>
                            <a href="{{ route('checkups.edit', $checkup) }}" class="inline-flex items-center px-3 py-1.5 bg-chart-3 text-white rounded-lg hover:bg-chart-3/90 transition-colors text-xs font-medium">Edit</a>
                            <form action="{{ route('checkups.destroy', $checkup) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
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
    
    @if($checkups->hasPages())
    <div class="px-6 py-4 border-t border-border bg-card">
        {{ $checkups->links() }}
    </div>
    @endif
</x-ui.card>
@endsection

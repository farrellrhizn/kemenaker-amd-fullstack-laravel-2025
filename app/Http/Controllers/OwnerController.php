<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function index(Request $request)
    {
        $query = Owner::withCount('pets');
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        
        $owners = $query->paginate(10)->appends(['search' => $request->search]);
        return view('owners.index', compact('owners'));
    }

    public function create()
    {
        return view('owners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'phone_verified' => 'boolean',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ]);

        Owner::create($validated);

        return redirect()->route('owners.index')
            ->with('success', 'Owner created successfully.');
    }

    public function show(Owner $owner)
    {
        $owner->load('pets');
        return view('owners.show', compact('owner'));
    }

    public function edit(Owner $owner)
    {
        return view('owners.edit', compact('owner'));
    }

    public function update(Request $request, Owner $owner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'phone_verified' => 'boolean',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ]);

        $owner->update($validated);

        return redirect()->route('owners.index')
            ->with('success', 'Owner updated successfully.');
    }

    public function destroy(Owner $owner)
    {
        $owner->delete();

        return redirect()->route('owners.index')
            ->with('success', 'Owner deleted successfully.');
    }
}

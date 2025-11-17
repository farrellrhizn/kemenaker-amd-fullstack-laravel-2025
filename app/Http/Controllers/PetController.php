<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PetController extends Controller
{
    public function index(Request $request)
    {
        $query = Pet::with('owner');
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('species', 'like', '%' . $search . '%')
                  ->orWhere('registration_code', 'like', '%' . $search . '%')
                  ->orWhereHas('owner', function($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
            });
        }
        
        $pets = $query->paginate(10)->appends(['search' => $request->search]);
        return view('pets.index', compact('pets'));
    }

    public function create()
    {
        // Only show verified owners in the dropdown
        $owners = Owner::where('phone_verified', true)->get();
        return view('pets.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:owners,id',
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'age' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
        ]);

        // Convert name and species to uppercase
        $validated['name'] = strtoupper($validated['name']);
        $validated['species'] = strtoupper($validated['species']);

        // Check if owner already has a pet with the same name and species
        $existingPet = Pet::where('owner_id', $validated['owner_id'])
            ->where('name', $validated['name'])
            ->where('species', $validated['species'])
            ->first();

        if ($existingPet) {
            throw ValidationException::withMessages([
                'name' => 'Owner already has a pet with the same name and species.',
            ]);
        }

        // Generate unique registration code
        do {
            $registrationCode = Pet::generateRegistrationCode($validated['owner_id']);
            $codeExists = Pet::where('registration_code', $registrationCode)->exists();
        } while ($codeExists);

        // Create the pet
        $pet = Pet::create([
            'owner_id' => $validated['owner_id'],
            'registration_code' => $registrationCode,
            'name' => $validated['name'],
            'species' => $validated['species'],
            'age' => $validated['age'],
            'weight' => $validated['weight'],
        ]);

        return redirect()->route('pets.index')
            ->with('success', 'Pet created successfully with registration code: ' . $registrationCode);
    }

    public function show(Pet $pet)
    {
        $pet->load(['owner', 'checkups.treatment']);
        return view('pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        $owners = Owner::where('phone_verified', true)->get();
        return view('pets.edit', compact('pet', 'owners'));
    }

    public function update(Request $request, Pet $pet)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:owners,id',
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'age' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
        ]);

        // Convert name and species to uppercase
        $validated['name'] = strtoupper($validated['name']);
        $validated['species'] = strtoupper($validated['species']);

        // Check if owner already has another pet with the same name and species
        $existingPet = Pet::where('owner_id', $validated['owner_id'])
            ->where('name', $validated['name'])
            ->where('species', $validated['species'])
            ->where('id', '!=', $pet->id)
            ->first();

        if ($existingPet) {
            throw ValidationException::withMessages([
                'name' => 'Owner already has a pet with the same name and species.',
            ]);
        }

        // Update the pet
        $pet->update([
            'owner_id' => $validated['owner_id'],
            'name' => $validated['name'],
            'species' => $validated['species'],
            'age' => $validated['age'],
            'weight' => $validated['weight'],
        ]);

        return redirect()->route('pets.index')
            ->with('success', 'Pet updated successfully.');
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();

        return redirect()->route('pets.index')
            ->with('success', 'Pet deleted successfully.');
    }
}

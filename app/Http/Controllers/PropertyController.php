<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::all();
        return view('properties.index', compact('properties'));
    }

    public function create()
    {
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'nearest_landmarks' => 'nullable|string|max:255',
            'corner' => 'required|in:Yes,No',
            'size' => 'required|string|max:255',
            'asking_price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'contact_number' => 'required|string|max:255',
            'agent_name' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('property_images', 'public');
        }

        Property::create($validated);

        return redirect()->route('properties.index')->with('success', 'Property added successfully!');
    }

    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'nearest_landmarks' => 'nullable|string|max:255',
            'corner' => 'required|in:Yes,No',
            'size' => 'required|string|max:255',
            'asking_price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'contact_number' => 'required|string|max:255',
            'agent_name' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            if ($property->image_path) {
                Storage::delete($property->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('images', 'public');
        }

        $property->update($validated);

        return redirect()->route('properties.index')->with('success', 'Property updated successfully!');
    }

    public function destroy(Property $property)
    {
        if ($property->image_path) {
            Storage::delete($property->image_path);
        }
        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Property deleted successfully!');
    }
}

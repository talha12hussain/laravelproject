@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Properties</h1>
    <a href="{{ route('properties.create') }}" class="btn btn-primary mb-3">Add New Property</a>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>City</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($properties as $property)
                <tr>
                    <td>{{ $property->id }}</td>
                    <td>{{ $property->type }}</td>
                    <td>{{ $property->city }}</td>
                    <td>{{ $property->address }}</td>
                    <td>
                        <a href="{{ route('properties.show', $property) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('properties.edit', $property) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('properties.destroy', $property) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No properties found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

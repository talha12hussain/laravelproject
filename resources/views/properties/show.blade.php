@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Property Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                @if($property->image_path)
                <div class="col-md-6 text-center mb-4">
                    <img src="{{ asset('storage/' . $property->image_path) }}" alt="Property Image" class="img-fluid rounded shadow-sm" style="max-height: 300px;">
                </div>
                @endif
                <div class="{{ $property->image_path ? 'col-md-6' : 'col-12' }}">
                    <h4 class="text-primary">Basic Information</h4>
                    <p><strong>Type:</strong> {{ $property->type }}</p>
                    <p><strong>City:</strong> {{ $property->city }}</p>
                    <p><strong>Address:</strong> {{ $property->address }}</p>
                    <p><strong>Landmarks:</strong> {{ $property->nearest_landmarks }}</p>
                    <p><strong>Corner:</strong> {{ $property->corner }}</p>
                    <p><strong>Size:</strong> {{ $property->size }}</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h4 class="text-primary">Price & Description</h4>
                    <p><strong>Price:</strong> ${{ number_format($property->asking_price, 2) }}</p>
                    <p><strong>Description:</strong> {{ $property->description }}</p>
                </div>
                <div class="col-md-6">
                    <h4 class="text-primary">Contact Information</h4>
                    <p><strong>Contact:</strong> {{ $property->contact_number }}</p>
                    <p><strong>Agent:</strong> {{ $property->agent_name }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('properties.index') }}" class="btn btn-secondary">Back to Listings</a>
        </div>
    </div>
</div>
@endsection

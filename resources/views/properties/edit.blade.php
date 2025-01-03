@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mt-5">
        <div class="card-header bg-warning text-white">
            <h2 class="mb-0">Edit Property</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('properties.update', $property) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="type" class="form-label fw-bold">Property Type</label>
                        <input type="text" name="type" id="type" class="form-control" 
                               value="{{ old('type', $property->type) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label fw-bold">City</label>
                        <input type="text" name="city" id="city" class="form-control" 
                               value="{{ old('city', $property->city) }}" required>
                    </div>
                    <div class="col-md-12">
                        <label for="address" class="form-label fw-bold">Address</label>
                        <input type="text" name="address" id="address" class="form-control" 
                               value="{{ old('address', $property->address) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="nearest_landmarks" class="form-label fw-bold">Nearest Landmarks</label>
                        <input type="text" name="nearest_landmarks" id="nearest_landmarks" class="form-control" 
                               value="{{ old('nearest_landmarks', $property->nearest_landmarks) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="corner" class="form-label fw-bold">Corner</label>
                        <select name="corner" id="corner" class="form-select" required>
                            <option value="Yes" {{ old('corner', $property->corner) == 'Yes' ? 'selected' : '' }}>Yes</option>
                            <option value="No" {{ old('corner', $property->corner) == 'No' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="size" class="form-label fw-bold">Size</label>
                        <input type="text" name="size" id="size" class="form-control" 
                               value="{{ old('size', $property->size) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="asking_price" class="form-label fw-bold">Asking Price</label>
                        <input type="number" name="asking_price" id="asking_price" class="form-control" 
                               value="{{ old('asking_price', $property->asking_price) }}" required>
                    </div>
                    <div class="col-md-12">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea name="description" id="description" rows="4" class="form-control" 
                                  placeholder="Enter property details here...">{{ old('description', $property->description) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label fw-bold">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @if($property->image_path)
                            <img src="{{ asset('storage/' . $property->image_path) }}" 
                                 alt="Property Image" class="img-fluid mt-3" style="max-height: 150px;">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="contact_number" class="form-label fw-bold">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" class="form-control" 
                               value="{{ old('contact_number', $property->contact_number) }}" required>
                    </div>
                    <div class="col-md-12">
                        <label for="agent_name" class="form-label fw-bold">Agent Name</label>
                        <input type="text" name="agent_name" id="agent_name" class="form-control" 
                               value="{{ old('agent_name', $property->agent_name) }}" required>
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success btn-lg px-5">Update Property</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

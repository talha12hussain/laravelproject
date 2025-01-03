@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mt-5">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Add New Property</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="type" class="form-label fw-bold">Property Type</label>
                        <input type="text" name="type" id="type" class="form-control" value="{{ old('type') }}" placeholder="e.g., Residential Plot" required>
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label fw-bold">City</label>
                        <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}" placeholder="e.g., New York" required>
                    </div>
                    <div class="col-md-12">
                        <label for="address" class="form-label fw-bold">Address</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" placeholder="e.g., 123 Main St, Downtown" required>
                    </div>
                    <div class="col-md-6">
                        <label for="nearest_landmarks" class="form-label fw-bold">Nearest Landmarks</label>
                        <input type="text" name="nearest_landmarks" id="nearest_landmarks" class="form-control" value="{{ old('nearest_landmarks') }}" placeholder="e.g., Near Central Park">
                    </div>
                    <div class="col-md-6">
                        <label for="corner" class="form-label fw-bold">Corner</label>
                        <select name="corner" id="corner" class="form-select" required>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="size" class="form-label fw-bold">Size</label>
                        <input type="text" name="size" id="size" class="form-control" value="{{ old('size') }}" placeholder="e.g., 500 Sq Ft" required>
                    </div>
                    <div class="col-md-6">
                        <label for="asking_price" class="form-label fw-bold">Asking Price</label>
                        <input type="number" name="asking_price" id="asking_price" class="form-control" value="{{ old('asking_price') }}" placeholder="e.g., 500000" required>
                    </div>
                    <div class="col-md-12">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea name="description" id="description" rows="4" class="form-control" placeholder="Enter property details here...">{{ old('description') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label fw-bold">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @if (old('image') || isset($property->image_path))
                            <div class="mt-3">
                                <img 
                                    src="{{ old('image') ? asset('storage/' . old('image')) : (isset($property->image_path) ? asset('storage/' . $property->image_path) : '') }}" 
                                    alt="Uploaded Image Preview" 
                                    class="img-thumbnail" 
                                    style="max-height: 150px;"
                                >
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="contact_number" class="form-label fw-bold">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" class="form-control" value="{{ old('contact_number') }}" placeholder="e.g., +1-234-567-890" required>
                    </div>
                    <div class="col-md-12">
                        <label for="agent_name" class="form-label fw-bold">Agent Name</label>
                        <input type="text" name="agent_name" id="agent_name" class="form-control" value="{{ old('agent_name') }}" placeholder="e.g., John Doe" required>
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

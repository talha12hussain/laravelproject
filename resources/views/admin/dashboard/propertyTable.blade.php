@extends('admin.adminMain')

@section('content')
    @if (session('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Deleted!</strong> Product deleted successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('update'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Updated!</strong> {{ session('update') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row mb-4 align-items-center">
            <!-- Search Form -->
            <div class="col-md-4">
                <form action="{{ url()->current() }}" method="GET" class="d-flex">
                    <input type="search" name="search" value="{{ request('search') }}" class="form-control me-2"
                        placeholder="@lang('back.search')..." aria-label="Search">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> @lang('back.search')</button>
                </form>
            </div>

            <!-- Page Title -->
            <div class="col-md-4 text-center">
                <h1 class="h4 my-3 text-primary">@lang('back.all_listed_properties')</h1>
            </div>

            <!-- Export Button -->
            <div class="col-md-4 text-end">
                <a href="{{ route('admin.property.export') }}" class="btn btn-success">
                    <i class="fas fa-download"></i> @lang('back.export_all')
                </a>
            </div>
        </div>

        <!-- Properties Table -->
        <div class="table-responsive shadow-lg rounded">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th class="border-end">@lang('property_id')</th>
                        <th class="border-end">@lang('property_type')</th>
                        <th class="border-end">@lang('city')</th>
                        <th class="border-end">@lang('address')</th>
                        <th class="border-end">@lang('size')</th>
                        <th class="border-end">@lang('price')</th>
                        <th class="border-end">@lang('agent')</th>
                        <th class="border-end">@lang('Image')</th>  <!-- Image Column Added -->
                        <th>@lang('actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($properties as $property)
                        <tr>
                            <td class="text-center border-end">{{ $property->id }}</td>
                            <td class="border-end">{{ $property->property_type }}</td>
                            <td class="border-end">{{ $property->city }}</td>
                            <td class="border-end">{{ $property->address }}</td>
                            <td class="text-center border-end">{{ $property->property_size }}</td>
                            <td class="text-end border-end">{{ number_format($property->asking_price, 2) }} </td>
                            <td class="border-end">{{ $property->agent_name }}</td>

                            <!-- Displaying images -->
                            <td class="border-end">
    @if($property->images)
        @php
            $images = is_array($property->images) ? $property->images : explode(',', $property->images);
        @endphp
        
        @foreach($images as $image)
            <img src="{{ asset('storage/' . $image) }}" alt="Property Image" width="50" height="50">
        @endforeach
    @else
        No images available
    @endif
</td>


                            <td class="text-center">
                                <button type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $property->id }}">
                                    <i class="fas fa-edit"></i> @lang('back.edit')
                                </button>
                                <form action="{{ route('properties.destroy', $property->id) }}" method="POST" 
                                      style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> @lang('back.delete')
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                      <!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $property->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="property_type" class="form-label">Property Type</label>
                            <input type="text" class="form-control" name="property_type" value="{{ $property->property_type }}">
                        </div>
                        <div class="col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" name="city" value="{{ $property->city }}">
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" value="{{ $property->address }}">
                        </div>
                        <div class="col-md-6">
                            <label for="property_size" class="form-label">Size</label>
                            <input type="text" class="form-control" name="property_size" value="{{ $property->property_size }}">
                        </div>
                        <div class="col-md-6">
                            <label for="asking_price" class="form-label">Price</label>
                            <input type="text" class="form-control" name="asking_price" value="{{ $property->asking_price }}">
                        </div>
                        <div class="col-md-12">
                            <label for="agent_name" class="form-label">Agent Name</label>
                            <input type="text" class="form-control" name="agent_name" value="{{ $property->agent_name }}">
                        </div>

                        <!-- Image Upload Field -->
                        <div class="col-md-12">
                            <label for="images" class="form-label">Images</label>
                            <input type="file" class="form-control" name="images[]" multiple>
                            @if($property->images)
        @php
            $images = is_array($property->images) ? $property->images : explode(',', $property->images);
        @endphp
        
        @foreach($images as $image)
            <img src="{{ asset('storage/' . $image) }}" alt="Property Image" width="50" height="50">
        @endforeach
    @else
        No images available
    @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $properties->links() }}
        </div>
    </div>
@endsection

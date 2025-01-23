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
                        <th class="border-end">@lang('Property_id')</th>
                        <th class="border-end">@lang('Property_type')</th>
                        <th class="border-end">@lang('City')</th>
                        <th class="border-end">@lang('Property_types')</th>
                        <th class="border-end">@lang('Floor')</th>
                        <th class="border-end">@lang('Address')</th>
                        <th class="border-end">@lang('Size')</th>
                        <th class="border-end">@lang('Price')</th>
                        <th class="border-end">@lang('Bedrooms')</th>
                        <th class="border-end">@lang('Bathrooms')</th>
                        <th class="border-end">@lang('Agent Name')</th>
                        <th class="border-end">@lang('Contact No')</th>
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
                            <td class="border-end">{{ $property->property_types }}</td>
                            <td class="border-end">{{ $property->floor }}</td>
                            <td class="border-end">{{ $property->address }}</td>
                            <td class="text-center border-end">{{ $property->property_size }}</td>
                            <td class="text-end border-end">{{ number_format($property->asking_price, 2) }} </td>
                            <td class="border-end">{{ $property->bedrooms }}</td>
                            <td class="border-end">{{ $property->bathrooms }}</td>
                            <td class="border-end">{{ $property->agent_name }}</td>
                            <td class="border-end">{{ $property->contact_no }}</td>


                            <!-- Displaying images -->
                            <td class="border-end">
    @if($property->images)
        @php
            $images = is_array($property->images) ? $property->images : explode(',', $property->images);
        @endphp
        
        @foreach($images as $image)
            <img src="{{ asset('storage/' . $image) }}" class="rounded-circle" alt="Property Image" width="50" height="50" >
        @endforeach
    @else
        No images available
    @endif
</td>


 <!-- Table Actions Buttons -->
<td class="text-center">
    <div class="d-inline-flex align-items-center gap-2">
        <button type="button" class="btn btn-sm btn-warning text-white rounded-pill px-3 shadow-sm" data-bs-toggle="modal"
            data-bs-target="#editModal{{ $property->id }}">
            <i class="fas fa-edit"></i> @lang('back.edit')
        </button>
        <a href="{{ route('properties.print', $property->id) }}" class="btn btn-sm btn-info text-white rounded-pill px-3 shadow-sm">
            <i class="fas fa-print"></i> @lang('Print')
        </a>
        <form action="{{ route('properties.destroy', $property->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger text-white rounded-pill px-3 shadow-sm">
                <i class="fas fa-trash"></i> @lang('back.delete')
            </button>
        </form>
    </div>
</td>


                        </tr>

                        <!-- Edit Modal -->
 <!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $property->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg rounded-3">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editModalLabel">Edit Property</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="property_type" class="form-label">Property Type</label>
                            <input type="text" class="form-control form-control-lg border-primary" name="property_type" value="{{ $property->property_type }}">
                        </div>
                        <div class="col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control form-control-lg border-primary" name="city" value="{{ $property->city }}">
                        </div>
                        <div class="col-md-6">
    <label for="floor" class="form-label">Floor</label>
    <select class="form-control form-control-lg border-primary" name="floor">
        <option value="Ground" {{ $property->floor == 'Ground' ? 'selected' : '' }}>Ground</option>
        <option value="Mezzanine" {{ $property->floor == 'Mezzanine' ? 'selected' : '' }}>Mezzanine</option>
        <option value="1" {{ $property->floor == '1' ? 'selected' : '' }}>1</option>
        <option value="2" {{ $property->floor == '2' ? 'selected' : '' }}>2</option>
        <option value="3" {{ $property->floor == '3' ? 'selected' : '' }}>3</option>
        <option value="4" {{ $property->floor == '4' ? 'selected' : '' }}>4</option>
        <option value="5" {{ $property->floor == '5' ? 'selected' : '' }}>5</option>
        <option value="6" {{ $property->floor == '6' ? 'selected' : '' }}>6</option>
        <option value="7" {{ $property->floor == '7' ? 'selected' : '' }}>7</option>
        <option value="8" {{ $property->floor == '8' ? 'selected' : '' }}>8</option>
        <option value="9" {{ $property->floor == '9' ? 'selected' : '' }}>9</option>
        <option value="10+" {{ $property->floor == '10+' ? 'selected' : '' }}>10+</option>
    </select>
</div>

                        <div class="col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control form-control-lg border-primary" name="address" value="{{ $property->address }}">
                        </div>
                        <div class="col-md-6">
    <label for="property_size" class="form-label">Size</label>
    <select class="form-control form-control-lg border-primary" name="property_size">
        <option value="Sq.ft" {{ $property->property_size == 'Sq.ft' ? 'selected' : '' }}>Sq. Ft</option>
        <option value="Sq.M" {{ $property->property_size == 'Sq.M' ? 'selected' : '' }}>Sq. M</option>
        <option value="Sq.Yd" {{ $property->property_size == 'Sq.Yd' ? 'selected' : '' }}>Sq. Yd</option>
        <option value="Marla" {{ $property->property_size == 'Marla' ? 'selected' : '' }}>Marla</option>
        <option value="Kanal" {{ $property->property_size == 'Kanal' ? 'selected' : '' }}>Kanal</option>
        <option value="Acre" {{ $property->property_size == 'Acre' ? 'selected' : '' }}>Acre</option>
    </select>
</div>

                        <div class="col-md-6">
                            <label for="asking_price" class="form-label">Price</label>
                            <input type="text" class="form-control form-control-lg border-primary" name="asking_price" value="{{ $property->asking_price }}">
                        </div>
                        <div class="col-md-12">
                            <label for="agent_name" class="form-label">Agent Name</label>
                            <input type="text" class="form-control form-control-lg border-primary" name="agent_name" value="{{ $property->agent_name }}">
                        </div>
                        <div class="col-md-12">
                            <label for="contact_n0" class="form-label">Contact No</label>
                            <input type="text" class="form-control form-control-lg border-primary" name="agent_name" value="{{ $property->contact_no }}">
                        </div>

                        <!-- Image Upload Field -->
                        <div class="col-md-12">
                            <label for="images" class="form-label">Images</label>
                            <input type="file" class="form-control form-control-lg border-primary" name="images[]" multiple>
                            <div class="mt-2">
                                @if($property->images)
                                    @php
                                        $images = is_array($property->images) ? $property->images : explode(',', $property->images);
                                    @endphp
                                    <div class="row">
                                        @foreach($images as $image)
                                            <div class="col-6 col-md-4 mb-3">
                                                <img src="{{ asset('storage/' . $image) }}" alt="Property Image" class="img-thumbnail rounded-3" width="100" height="100">
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">No images available</p>
                                @endif
                            </div>
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

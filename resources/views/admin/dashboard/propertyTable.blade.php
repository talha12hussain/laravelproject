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
                        <th class="border-end">@lang('Type')</th>
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
                            <td class="border-end">{{ $property->type }}</td>
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
        // Decode the JSON string into an array
        $images = json_decode($property->images, true);
    @endphp
    
    @if(is_array($images) && count($images) > 0)
        @foreach($images as $image)
            <img src="{{ asset('storage/' . $image) }}" class="rounded-circle" alt="Property Image" width="50" height="50">
        @endforeach
    @else
        <p>No images available</p>
    @endif
@else
    <p>No images available</p>
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
            <form action="{{ route('properties.update', $property->id) }}" method="POST"  enctype="multipart/form-data" >
                @csrf
                @method('PUT')
                <div class="container">
        <!-- Property Type -->
        <div class="card shadow mt-4">
            <div class="card-header bg-primary text-white font-weight-bold">@lang('Property Details')</div>
            <div class="card-body">
                <div class="row">
                <div class="form-group col-sm-12 col-md-6">
    <label class="form-control-label text-dark font-weight-bold">@lang('What do you want to do?') <span class="text-danger">*</span></label>
    <select class="form-control rounded-pill border-primary" name="type">
        <option value="sell" {{ old('type', $property->type) == 'sell' ? 'selected' : '' }}>@lang('Sell')</option>
        <option value="rent" {{ old('type', $property->type) == 'rent' ? 'selected' : '' }}>@lang('Rent')</option>
    </select>
</div>


<div class="form-group col-sm-12 col-md-6">
    <label class="form-control-label text-dark font-weight-bold">@lang('What kind of property do you have?') <span class="text-danger">*</span></label>
    <select 
                            class="form-control" 
                            id="property_type_{{ $property->id }}" 
                            name="property_type" 
                            onchange="toggleForms('{{ $property->id }}')">
                            <option value="" disabled selected>Select Property Type</option>
                            <option value="plot" {{ old('property_type', $property->property_type) == 'plot' ? 'selected' : '' }}>Plot</option>
                            <option value="commercial" {{ old('property_type', $property->property_type) == 'commercial' ? 'selected' : '' }}>Commercial</option>
                            <option value="residential" {{ old('property_type', $property->property_type) == 'residential' ? 'selected' : '' }}>Residential</option>
                        </select>
</div>

                </div>
            </div>
        </div>

      <!-- Plot Form -->
<div id="plotForm_{{ $property->id }}" class="card shadow mt-4 dynamic-form" style="display: none; border-radius: 15px;">
    <div class="card-header bg-gradient-primary text-black font-weight-bold py-3">@lang('Property Details')</div>
    <div class="card-body p-4 bg-light">

        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Type of Plot Property') <span class="text-danger">*</span></label>
            <select class="form-control rounded-pill border-primary" name="property_types">
                <option value="" disabled selected>@lang('Select Type')</option>
                <option value="Residential Plot" {{ old('property_types', $property->property_types) == 'Residential Plot' ? 'selected' : '' }}>@lang('Residential Plot')</option>
                <option value="Commercial Plot" {{ old('property_types', $property->property_types) == 'Commercial Plot' ? 'selected' : '' }}>@lang('Commercial Plot')</option>
                <option value="Agriculture Land" {{ old('property_types', $property->property_types) == 'Agriculture Land' ? 'selected' : '' }}>@lang('Agriculture Land')</option>
                <option value="Industrial Land" {{ old('property_types', $property->property_types) == 'Industrial Land' ? 'selected' : '' }}>@lang('Industrial Land')</option>
                <option value="Warehouse Plot" {{ old('property_types', $property->property_types) == 'Warehouse Plot' ? 'selected' : '' }}>@lang('Warehouse Plot')</option>
                <option value="Farmhouse Plot" {{ old('property_types', $property->property_types) == 'Farmhouse Plot' ? 'selected' : '' }}>@lang('Farmhouse Plot')</option>
                <option value="Plot File" {{ old('property_types', $property->property_types) == 'Plot File' ? 'selected' : '' }}>@lang('Plot File')</option>
                <option value="Amenity Plot" {{ old('property_types', $property->property_types) == 'Amenity Plot' ? 'selected' : '' }}>@lang('Amenity Plot')</option>
            </select>
        </div>

        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('City') <span class="text-danger">*</span></label>
            <input type="text" class="form-control rounded-pill border-primary" name="city" value="{{ old('city', $property->city) }}" required>
        </div>

        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Address')</label>
            <div class="input-group">
                <input type="text" class="form-control rounded-pill border-primary" name="address" id="address_{{ $property->id }}" placeholder="@lang('Enter Address')" value="{{ old('address', $property->address) }}" required>
                <button type="button" onclick="geocodeAddress({{ $property->id }})" class="btn btn-secondary">
    Geocode Address
</button>
            </div>
            <input type="hidden" name="latitude" id="latitude" value="{{ $property->latitude }}">
            <input type="hidden" name="longitude" id="longitude" value="{{ $property->longitude }}">
            <div id="map_plot" style="width: 100%; height: 400px;"></div>

            <label class="form-control-label font-weight-bold mt-3">@lang('Nearest Landmark')</label>
            <input type="text" class="form-control rounded-pill border-primary mt-2" name="nearest_landmark" value="{{ old('nearest_landmark', $property->nearest_landmark) }}" placeholder="@lang('Enter Nearest Landmark')">
        </div>

        <!-- Other form fields remain the same with old() or direct values -->
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Corner Property')</label>
            <select class="form-control rounded-pill border-primary" name="corner_property">
                <option value="yes" {{ old('corner_property', $property->corner_property) == 'yes' ? 'selected' : '' }}>@lang('Yes')</option>
                <option value="no" {{ old('corner_property', $property->corner_property) == 'no' ? 'selected' : '' }}>@lang('No')</option>
            </select>
        </div>

        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Size of Property')</label>
            <select class="form-control rounded-pill border-primary" name="property_size">
                <option value="Sq.ft" {{ old('property_size', $property->property_size) == 'Sq.ft' ? 'selected' : '' }}>@lang('Sq. Ft')</option>
                <option value="Sq.M" {{ old('property_size', $property->property_size) == 'Sq.M' ? 'selected' : '' }}>@lang('Sq. M')</option>
                <option value="Sq.Yd" {{ old('property_size', $property->property_size) == 'Sq.Yd' ? 'selected' : '' }}>@lang('Sq. Yd')</option>
                <option value="Marla" {{ old('property_size', $property->property_size) == 'Marla' ? 'selected' : '' }}>@lang('Marla')</option>
                <option value="Kanal" {{ old('property_size', $property->property_size) == 'Kanal' ? 'selected' : '' }}>@lang('Kanal')</option>
                <option value="Acre" {{ old('property_size', $property->property_size) == 'Acre' ? 'selected' : '' }}>@lang('Acre')</option>
            </select>
        </div>

        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Asking Price (PKR)')</label>
            <input type="number" class="form-control rounded-pill border-primary" name="asking_price" placeholder="@lang('Enter Asking Price')" value="{{ old('asking_price', $property->asking_price) }}" step="any">
        </div>

        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Add some description about the Property')</label>
            <input type="text" class="form-control rounded border-primary" name="description" placeholder="@lang('Enter description')" value="{{ old('description', $property->description) }}" required>
        </div>

        <div class="form-group mb-4">
        <label for="images" class="form-label">Images</label>
                            <input type="file" class="form-control form-control-lg border-primary" name="images[]" multiple>
                            <div class="mt-2">
                                @if($property->images)
                                    @php
                                    $images = json_decode($property->images, true);
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

        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Contact No.') <span class="text-danger">*</span></label>
            <input 
                type="text" 
                class="form-control rounded-pill border-primary" 
                name="contact_no" 
                placeholder="@lang('Enter Contact Number')" 
                pattern="^92[0-9]{10}$" 
                oninput="validatePakistaniNumber(this)" 
                value="{{ old('contact_no', $property->contact_no) }}" 
                required
            >
            <small class="text-muted">@lang('Number must start with 92 and have 12 digits in total.')</small>
        </div>

        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Agent Name')</label>
            <input type="text" class="form-control rounded-pill border-primary" name="agent_name" placeholder="@lang('Enter Agent Name')" value="{{ old('agent_name', $property->agent_name) }}">
        </div>

    </div>
</div>

       <!-- Commercial Form -->
<div id="commercialForm_{{ $property->id }}" class="card shadow mt-4 dynamic-form" style="display: none; border-radius: 15px;">
    <div class="card-header bg-gradient-primary text-black font-weight-bold py-3">@lang('Commercial Property Details')</div>
    <div class="card-body p-4 bg-light">
        
        <!-- Type of Commercial Property -->
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Type of Commercial Property') <span class="text-danger">*</span></label>
            <select class="form-control rounded-pill border-primary" name="property_types">
                <option value="" disabled selected>@lang('Select Type')</option>
                <option value="Warehouse" {{ old('property_types', $property->property_types) == 'Warehouse' ? 'selected' : '' }}>@lang('Warehouse')</option>
                <option value="Building" {{ old('property_types', $property->property_types) == 'Building' ? 'selected' : '' }}>@lang('Building')</option>
                <option value="Hall" {{ old('property_types', $property->property_types) == 'Hall' ? 'selected' : '' }}>@lang('Hall')</option>
                <option value="Plaza" {{ old('property_types', $property->property_types) == 'Plaza' ? 'selected' : '' }}>@lang('Plaza')</option>
                <option value="Gym" {{ old('property_types', $property->property_types) == 'Gym' ? 'selected' : '' }}>@lang('Gym')</option>
                <option value="Restaurant" {{ old('property_types', $property->property_types) == 'Restaurant' ? 'selected' : '' }}>@lang('Restaurant')</option>
                <option value="Hotel" {{ old('property_types', $property->property_types) == 'Hotel' ? 'selected' : '' }}>@lang('Hotel')</option>
                <option value="Hospital" {{ old('property_types', $property->property_types) == 'Hospital' ? 'selected' : '' }}>@lang('Hospital')</option>
                <option value="Factory" {{ old('property_types', $property->property_types) == 'Factory' ? 'selected' : '' }}>@lang('Factory')</option>
                <option value="Running Business" {{ old('property_types', $property->property_types) == 'Running Business' ? 'selected' : '' }}>@lang('Running Business')</option>
                <option value="Floor" {{ old('property_types', $property->property_types) == 'Floor' ? 'selected' : '' }}>@lang('Floor')</option>
            </select>
        </div>

        <!-- Floor -->
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Floor')</label>
            <select class="form-control rounded-pill border-primary" name="floor">
                <option value="ground" {{ old('floor', $property->floor) == 'ground' ? 'selected' : '' }}>@lang('Basement')</option>
                <option value="ground" {{ old('floor', $property->floor) == 'ground' ? 'selected' : '' }}>@lang('Ground')</option>
                <option value="mezzanine" {{ old('floor', $property->floor) == 'mezzanine' ? 'selected' : '' }}>@lang('Mezzanine')</option>
                <option value="1" {{ old('floor', $property->floor) == '1' ? 'selected' : '' }}>@lang('1')</option>
                <option value="2" {{ old('floor', $property->floor) == '2' ? 'selected' : '' }}>@lang('2')</option>
                <option value="3" {{ old('floor', $property->floor) == '3' ? 'selected' : '' }}>@lang('3')</option>
                <option value="4" {{ old('floor', $property->floor) == '4' ? 'selected' : '' }}>@lang('4')</option>
                <option value="5" {{ old('floor', $property->floor) == '5' ? 'selected' : '' }}>@lang('5')</option>
                <option value="6" {{ old('floor', $property->floor) == '6' ? 'selected' : '' }}>@lang('6')</option>
                <option value="7" {{ old('floor', $property->floor) == '7' ? 'selected' : '' }}>@lang('7')</option>
                <option value="8" {{ old('floor', $property->floor) == '8' ? 'selected' : '' }}>@lang('8')</option>
                <option value="9" {{ old('floor', $property->floor) == '9' ? 'selected' : '' }}>@lang('9')</option>
                <option value="10+" {{ old('floor', $property->floor) == '10+' ? 'selected' : '' }}>@lang('10+')</option>
            </select>
        </div>

        <!-- City -->
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('City') <span class="text-danger">*</span></label>
            <input type="text" class="form-control rounded-pill border-primary" name="city" value="{{ old('city', $property->city) }}" required>
        </div>

        <!-- Address -->
        <div class="form-group mb-4">
    <label class="form-control-label font-weight-bold">@lang('Address')</label>
    <div class="input-group">
        <input type="text" class="form-control rounded-pill border-primary" 
               name="address" id="address_{{ $property->id }}"
               placeholder="@lang('Enter Address')" 
               value="{{ old('address', $property->address) }}" required>
        <button type="button" onclick="geocodeAddress({{ $property->id }})" class="btn btn-secondary">
            Geocode Address
        </button>
    </div>
    <input type="hidden" id="latitude_commercial_{{ $property->id }}" name="latitude_commercial" value="{{ $property->latitude }}">
    <input type="hidden" id="longitude_commercial_{{ $property->id }}" name="longitude_commercial" value="{{ $property->longitude }}">
    <div id="map_commercial" style="width: 100%; height: 400px;"></div>
    <label class="form-control-label font-weight-bold mt-3">@lang('Nearest Landmark')</label>
    <input type="text" class="form-control rounded-pill border-primary mt-2" name="nearest_landmark" value="{{ old('nearest_landmark', $property->nearest_landmark) }}" placeholder="@lang('Enter Nearest Landmark')">
</div>

        <!-- Corner Property -->
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Corner Property')</label>
            <select class="form-control rounded-pill border-primary" name="corner_property">
                <option value="yes" {{ old('corner_property', $property->corner_property) == 'yes' ? 'selected' : '' }}>@lang('Yes')</option>
                <option value="no" {{ old('corner_property', $property->corner_property) == 'no' ? 'selected' : '' }}>@lang('No')</option>
            </select>
        </div>

        <!-- Size of Property -->
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Size of Property')</label>
            <select class="form-control rounded-pill border-primary" name="property_size">
                <option value="Sq.ft" {{ old('property_size', $property->property_size) == 'Sq.ft' ? 'selected' : '' }}>@lang('Sq. Ft')</option>
                <option value="Sq.M" {{ old('property_size', $property->property_size) == 'Sq.M' ? 'selected' : '' }}>@lang('Sq. M')</option>
                <option value="Sq.Yd" {{ old('property_size', $property->property_size) == 'Sq.Yd' ? 'selected' : '' }}>@lang('Sq. Yd')</option>
                <option value="Marla" {{ old('property_size', $property->property_size) == 'Marla' ? 'selected' : '' }}>@lang('Marla')</option>
                <option value="Kanal" {{ old('property_size', $property->property_size) == 'Kanal' ? 'selected' : '' }}>@lang('Kanal')</option>
                <option value="Acre" {{ old('property_size', $property->property_size) == 'Acre' ? 'selected' : '' }}>@lang('Acre')</option>
            </select>
        </div>

        <!-- Asking Price -->
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Asking Price (PKR)')</label>
            <input type="number" class="form-control rounded-pill border-primary" name="asking_price" value="{{ old('asking_price', $property->asking_price) }}" placeholder="@lang('Enter Asking Price')" step="any">
        </div>

        <!-- Description -->
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Add some description about the Property')</label>
            <input type="text" class="form-control rounded border-primary" name="description" value="{{ old('description', $property->description) }}" placeholder="@lang('Enter description')" required>
        </div>

        <!-- Upload Images -->
        <div class="form-group mb-4">
        <label for="images" class="form-label">Images</label>
                            <input type="file" class="form-control form-control-lg border-primary" name="images[]" multiple>
                            <div class="mt-2">
                                @if($property->images)
                                    @php
                                    $images = json_decode($property->images, true);
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

        <!-- Contact No -->
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Contact No.') <span class="text-danger">*</span></label>
            <input type="text" class="form-control rounded-pill border-primary" name="contact_no" value="{{ old('contact_no', $property->contact_no) }}" placeholder="@lang('Enter Contact Number')" pattern="^92[0-9]{10}$" oninput="validatePakistaniNumber(this)" required>
            <small class="text-muted">@lang('Number must start with 92 and have 12 digits in total.')</small>
        </div>

        <!-- Agent Name -->
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Agent Name')</label>
            <input type="text" class="form-control rounded-pill border-primary" name="agent_name" value="{{ old('agent_name', $property->agent_name) }}" placeholder="@lang('Enter Agent Name')" required>
        </div>
        
    </div>
</div>

        <!-- Residential Form -->
        <div id="residentialForm_{{ $property->id }}" class="card shadow mt-4 dynamic-form" style="display: none; border-radius: 15px;">
            <div class="card-header bg-gradient-primary text-black font-weight-bold py-3">@lang('Residential Property Details')</div>
            <div class="card-body p-4 bg-light">
            <div class="form-group mb-4">

                <label class="form-control-label font-weight-bold">@lang('Type of Plot Property') <span class="text-danger">*</span></label>
                    <select class="form-control rounded-pill border-primary" name="property_types">
                        <option value="" disabled selected>@lang('Select Type')</option>
                        <option value="House" {{ old('property_types', $property->property_types) ==  'House' ? 'selected' : '' }} >@lang('House')</option>
                        <option value="Flat" {{ old('property_types', $property->property_types) ==  'Flat' ? 'selected' : '' }}>@lang('Flat')</option>
                        <option value="Room" {{ old('property_types', $property->property_types) ==  'Room' ? 'selected' : '' }}>@lang('Room')</option>
                        <option value="Farm House" {{ old('property_types', $property->property_types)  == 'Farm House ' ? 'selected' : '' }}>@lang('Farm House  ')</option>
                        <option value="Penthouse" {{ old('property_types', $property->property_types)  == 'Penthouse' ? 'selected' : '' }}>@lang('Penthouse')</option>
                        <option value="Hostel" {{ old('property_types', $property->property_types)  == 'Hostel' ? 'selected' : '' }}>@lang('Hostel')</option>
                        <option value="Basement" {{ old('property_types', $property->property_types)  == 'Basement' ? 'selected' : '' }}>@lang('Basement')</option>
                    </select>
                
    </div>

                <!-- Floor -->
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Floor')</label>
            <select class="form-control rounded-pill border-primary" name="floor">
                <option value="ground" {{ old('floor', $property->floor) == 'ground' ? 'selected' : '' }}>@lang('Basement')</option>
                <option value="ground" {{ old('floor', $property->floor) == 'ground' ? 'selected' : '' }}>@lang('Ground')</option>
                <option value="mezzanine" {{ old('floor', $property->floor) == 'mezzanine' ? 'selected' : '' }}>@lang('Mezzanine')</option>
                <option value="1" {{ old('floor', $property->floor) == '1' ? 'selected' : '' }}>@lang('1')</option>
                <option value="2" {{ old('floor', $property->floor) == '2' ? 'selected' : '' }}>@lang('2')</option>
                <option value="3" {{ old('floor', $property->floor) == '3' ? 'selected' : '' }}>@lang('3')</option>
                <option value="4" {{ old('floor', $property->floor) == '4' ? 'selected' : '' }}>@lang('4')</option>
                <option value="5" {{ old('floor', $property->floor) == '5' ? 'selected' : '' }}>@lang('5')</option>
                <option value="6" {{ old('floor', $property->floor) == '6' ? 'selected' : '' }}>@lang('6')</option>
                <option value="7" {{ old('floor', $property->floor) == '7' ? 'selected' : '' }}>@lang('7')</option>
                <option value="8" {{ old('floor', $property->floor) == '8' ? 'selected' : '' }}>@lang('8')</option>
                <option value="9" {{ old('floor', $property->floor) == '9' ? 'selected' : '' }}>@lang('9')</option>
                <option value="10+" {{ old('floor', $property->floor) == '10+' ? 'selected' : '' }}>@lang('10+')</option>
            </select>
        </div>

                  <!-- City -->
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('City') <span class="text-danger">*</span></label>
            <input type="text" class="form-control rounded-pill border-primary" name="city" value="{{ old('city', $property->city) }}" required>
        </div>

              <!-- Address -->
              <div class="form-group mb-4">
    <label class="form-control-label font-weight-bold">@lang('Address')</label>
    <div class="input-group">
        <input type="text" class="form-control rounded-pill border-primary" 
               name="address" id="address_{{ $property->id }}"
               placeholder="@lang('Enter Address')" 
               value="{{ old('address', $property->address) }}" required>
        <button type="button" onclick="geocodeAddress({{ $property->id }})" class="btn btn-secondary">
            Geocode Address
        </button>
    </div>
    <input type="hidden" id="latitude_residential_{{ $property->id }}" name="latitude_residential" value="{{ $property->latitude }}">
    <input type="hidden" id="longitude_residential_{{ $property->id }}" name="longitude_residential" value="{{ $property->longitude }}">
    <div id="map_residential" style="width: 100%; height: 400px;"></div>
    <label class="form-control-label font-weight-bold mt-3">@lang('Nearest Landmark')</label>
    <input type="text" class="form-control rounded-pill border-primary mt-2" name="nearest_landmark" value="{{ old('nearest_landmark', $property->nearest_landmark) }}" placeholder="@lang('Enter Nearest Landmark')">
</div>


                <!-- Corner Property -->
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Corner Property')</label>
            <select class="form-control rounded-pill border-primary" name="corner_property">
                <option value="yes" {{ old('corner_property', $property->corner_property) == 'yes' ? 'selected' : '' }}>@lang('Yes')</option>
                <option value="no" {{ old('corner_property', $property->corner_property) == 'no' ? 'selected' : '' }}>@lang('No')</option>
            </select>
        </div>

                <!-- Size of Property -->
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Size of Property')</label>
            <select class="form-control rounded-pill border-primary" name="property_size">
                <option value="Sq.ft" {{ old('property_size', $property->property_size) == 'Sq.ft' ? 'selected' : '' }}>@lang('Sq. Ft')</option>
                <option value="Sq.M" {{ old('property_size', $property->property_size) == 'Sq.M' ? 'selected' : '' }}>@lang('Sq. M')</option>
                <option value="Sq.Yd" {{ old('property_size', $property->property_size) == 'Sq.Yd' ? 'selected' : '' }}>@lang('Sq. Yd')</option>
                <option value="Marla" {{ old('property_size', $property->property_size) == 'Marla' ? 'selected' : '' }}>@lang('Marla')</option>
                <option value="Kanal" {{ old('property_size', $property->property_size) == 'Kanal' ? 'selected' : '' }}>@lang('Kanal')</option>
                <option value="Acre" {{ old('property_size', $property->property_size) == 'Acre' ? 'selected' : '' }}>@lang('Acre')</option>
            </select>
        </div>
                 <!-- Asking Price -->
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Asking Price (PKR)')</label>
            <input type="number" class="form-control rounded-pill border-primary" name="asking_price" value="{{ old('asking_price', $property->asking_price) }}" placeholder="@lang('Enter Asking Price')" step="any">
        </div>
                
                <div class="form-group mb-4">
    <label class="form-control-label font-weight-bold">@lang('How many Bedrooms?') <span class="text-danger">*</span></label>
    <select class="form-control rounded-pill border-primary" name="bedrooms">
        <option value="1" {{ old('bedrooms', $property->bedrooms) == '1' ? 'selected' : '' }}>@lang('1')</option>
        <option value="2" {{ old('bedrooms', $property->bedrooms) == '2' ? 'selected' : '' }}>@lang('2')</option>
        <option value="3" {{ old('bedrooms', $property->bedrooms) == '3' ? 'selected' : '' }}>@lang('3')</option>
        <option value="4" {{ old('bedrooms', $property->bedrooms) == '4' ? 'selected' : '' }}>@lang('4')</option>
        <option value="5" {{ old('bedrooms', $property->bedrooms) == '5' ? 'selected' : '' }}>@lang('5')</option>
        <option value="6" {{ old('bedrooms', $property->bedrooms) == '6' ? 'selected' : '' }}>@lang('6')</option>
        <option value="7" {{ old('bedrooms', $property->bedrooms) == '7' ? 'selected' : '' }}>@lang('7')</option>
        <option value="8" {{ old('bedrooms', $property->bedrooms) == '8' ? 'selected' : '' }}>@lang('8')</option>
        <option value="9" {{ old('bedrooms', $property->bedrooms) == '9' ? 'selected' : '' }}>@lang('9')</option>
        <option value="10+" {{ old('bedrooms', $property->bedrooms) == '6+' ? 'selected' : '' }}>@lang('6+')</option>
    </select>
</div>

<div class="form-group mb-4">
    <label class="form-control-label font-weight-bold">@lang('How many Bathrooms?') <span class="text-danger">*</span></label>
    <select class="form-control rounded-pill border-primary" name="bathrooms">
        <option value="1" {{ old('bathrooms', $property->bathrooms) == '1' ? 'selected' : '' }}>@lang('1')</option>
        <option value="2" {{ old('bathrooms', $property->bathrooms) == '2' ? 'selected' : '' }}>@lang('2')</option>
        <option value="3" {{ old('bathrooms', $property->bathrooms) == '3' ? 'selected' : '' }}>@lang('3')</option>
        <option value="4" {{ old('bathrooms', $property->bathrooms) == '4' ? 'selected' : '' }}>@lang('4')</option>
        <option value="5" {{ old('bathrooms', $property->bathrooms) == '5' ? 'selected' : '' }}>@lang('5')</option>
        <option value="6" {{ old('bathrooms', $property->bathrooms) == '6' ? 'selected' : '' }}>@lang('6')</option>
        <option value="7" {{ old('bathrooms', $property->bathrooms) == '7' ? 'selected' : '' }}>@lang('7')</option>
        <option value="8" {{ old('bathrooms', $property->bathrooms) == '8' ? 'selected' : '' }}>@lang('8')</option>
        <option value="9" {{ old('bathrooms', $property->bathrooms) == '9' ? 'selected' : '' }}>@lang('9')</option>
        <option value="10+" {{ old('bathrooms', $property->bathrooms) == '6+' ? 'selected' : '' }}>@lang('10+')</option>
    </select>
</div>

                <!-- Description -->
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Add some description about the Property')</label>
            <input type="text" class="form-control rounded border-primary" name="description" value="{{ old('description', $property->description) }}" placeholder="@lang('Enter description')" required>
        </div>
            
               
        <!-- Upload Images -->
        <div class="form-group mb-4">
        <label for="images" class="form-label">Images</label>
                            <input type="file" class="form-control form-control-lg border-primary" name="images[]" multiple>
                            <div class="mt-2">
                                @if($property->images)
                                    @php
                                    $images = json_decode($property->images, true);
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

                <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Contact No.') <span class="text-danger">*</span></label>
            <input type="text" class="form-control rounded-pill border-primary" name="contact_no" value="{{ old('contact_no', $property->contact_no) }}" placeholder="@lang('Enter Contact Number')" pattern="^92[0-9]{10}$" oninput="validatePakistaniNumber(this)" required>
            <small class="text-muted">@lang('Number must start with 92 and have 12 digits in total.')</small>
        </div>

 <!-- Agent Name -->
 <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Agent Name')</label>
            <input type="text" class="form-control rounded-pill border-primary" name="agent_name" value="{{ old('agent_name', $property->agent_name) }}" placeholder="@lang('Enter Agent Name')" required>
        </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                </div>
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

    
<script>
    function validatePakistaniNumber(input) {
        // Sirf numbers allow karna
        input.value = input.value.replace(/[^0-9]/g, '');

        // Agar 92 se start nahi karta, toh automatically set kare
        if (!input.value.startsWith('92')) {
            input.value = '92';
        }

        // Maximum 12 digits allow karna
        if (input.value.length > 12) {
            input.value = input.value.slice(0, 12);
        }
    }
</script>
<script>
   function toggleForms(propertyId) {
    var propertyType = document.getElementById("property_type_" + propertyId).value;

    // Hide all dynamic forms within this modal
    document.querySelectorAll(`#editModal${propertyId} .dynamic-form`).forEach(function (form) {
        form.style.display = 'none';
        form.querySelectorAll('input, select').forEach(function (input) {
            input.disabled = true;
        });
    });

    // Show the selected form
    var selectedForm = null;
    if (propertyType === "plot") {
        selectedForm = document.getElementById("plotForm_" + propertyId);
    } else if (propertyType === "commercial") {
        selectedForm = document.getElementById("commercialForm_" + propertyId);
    } else if (propertyType === "residential") {
        selectedForm = document.getElementById("residentialForm_" + propertyId);
    }

    if (selectedForm) {
        selectedForm.style.display = 'block';
        selectedForm.querySelectorAll('input, select').forEach(function (input) {
            input.disabled = false;
        });
       
    }
}
document.querySelectorAll('.modal').forEach(function (modal) {
    modal.addEventListener('show.bs.modal', function () {
        var propertyId = modal.getAttribute('id').replace('editModal', ''); // Extract ID from modal ID
        toggleForms(propertyId);
    });
});

</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBorxMHcrLrPMvgzTDgEgLz9HA5UDuNY8"></script>
<script>
var geocoder = new google.maps.Geocoder(); // Google Maps Geocoder object کو انیشیلائز کیا

function geocodeAddress(propertyId) {
    // پراپرٹی ٹائپ کو ڈائنامکلی حاصل کیا
    var propertyTypeElement = document.getElementById("property_type_" + propertyId);
    if (!propertyTypeElement) {
        console.error("Property type dropdown not found for property ID:", propertyId);
        alert("Error: Property type dropdown not found.");
        return;
    }

    var propertyType = propertyTypeElement.value; // منتخب پراپرٹی ٹائپ حاصل کریں
    console.log("Selected Property Type:", propertyType);

    // ایڈریس فیلڈ حاصل کریں
    var addressField = document.getElementById('address_' + propertyId);
    if (!addressField) {
        console.error("Address field not found for property ID:", propertyId);
        alert("Error: Address field not found.");
        return;
    }

    var address = addressField.value.trim(); // ایڈریس کی ویلیو حاصل کریں
    if (!address) {
        alert("Please enter a valid address.");
        return;
    }

    // ایڈریس کی جیوکوڈنگ کریں
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat(); // لیٹیٹیوڈ حاصل کریں
            var longitude = results[0].geometry.location.lng(); // لانگیٹیوڈ حاصل کریں

            console.log("Updated Latitude:", latitude);
            console.log("Updated Longitude:", longitude);

            // پراپرٹی ٹائپ کے حساب سے لیٹیٹیوڈ اور لانگیٹیوڈ اپڈیٹ کریں
            if (propertyType === "plot") {
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;
            } else if (propertyType === "commercial") {
                document.getElementById('latitude_commercial_' + propertyId).value = latitude;
                document.getElementById('longitude_commercial_' + propertyId).value = longitude;
            } else if (propertyType === "residential") {
                document.getElementById('latitude_residential_' + propertyId).value = latitude;
                document.getElementById('longitude_residential_' + propertyId).value = longitude;
            }

            console.log("Fields Updated Successfully for Property ID:", propertyId);
        } else {
            alert("Geocode failed due to: " + status); // اگر جیوکوڈنگ ناکام ہو جائے
        }
    });
}


</script>




@endsection

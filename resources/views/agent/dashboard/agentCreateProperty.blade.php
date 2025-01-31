{{-- original code --}}
@extends('admin.agentMain')

@section('content')
<style>

        
body {
    color: #000;
    overflow-x: hidden;

}







:root {
    --colorPrimaryNormal: #0d6efd;
    --colorPrimaryDark: #00979f;
    --colorPrimaryGlare: #00cdd7;
    --colorPrimaryHalf: #0d6efd;
    --colorPrimaryQuarter: #bfecee;
    --colorPrimaryEighth: #dff5f7;
    --colorPrimaryPale: #f3f5f7;
    --colorPrimarySeparator: #f3f5f7;
    --colorPrimaryOutline: #dff5f7;
    --colorButtonNormal: #3c87f7;
    --colorButtonHover: #3c87f7;
    --colorLinkNormal: #3c87f7;
    --colorLinkHover: #3c87f7;
}






.card {
    padding: 30px 40px;
    margin-top: 10px;
    margin-bottom: 60px;
    border: none !important;
    box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.2)
}

.blue-text {
    color: #00BCD4
}

.form-control-label {
text-align: left;
float: left; /* Aligns the label to the left */
margin-right: 10px; /* Optional: Adds spacing between the label and input */
}










</style>

<h1 class="text" style="margin-left: 0px !important; font-family: sans-serif; 
font-size: 2.5rem; font-weight: bold; 
color: #000000; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); 
padding: 20px; background-color: #0d6efd; border-radius: 8px; 
box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-align: center;">
@lang('back.create_property')
</h1>

{{-- <p class="text-secondary" style="font-size:14px;">Enter the following details, carefully review and then submit</p> --}}
<div class="container-fluid px-1 py-0 mx-auto">
<div class="row d-flex justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-11 text-center">
        <div class="card">
            <div class="col-sm-3">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">

</div>


            
            
            
               
           
    </div>
</div>
</div>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
<ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
</div>
@endif

<form class="form-card" method="POST" action="{{ route('agent.storeProperty') }}" enctype="multipart/form-data">
@csrf

<div class="container">
<!-- Property Type -->
<div class="card shadow mt-4">
    <div class="card-header bg-primary text-white font-weight-bold">@lang('Property Details')</div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-sm-12 col-md-6">
                <label class="form-control-label text-dark font-weight-bold">@lang('What do you want to do?') <span class="text-danger">*</span></label>
                <select class="form-control rounded-pill border-primary" name="type">
                    <option value="sell">@lang('Sell')</option>
                    <option value="rent">@lang('Rent')</option>
                </select>
            </div>

            <div class="form-group col-sm-12 col-md-6">
                <label class="form-control-label text-dark font-weight-bold">@lang('What kind of property do you have?') <span class="text-danger">*</span></label>
                <select class="form-control rounded-pill border-primary" id="property_type" name="property_type" onchange="toggleForms()">
                    <option value="" disabled selected>@lang('Select Property Type')</option>
                    <option value="plot">@lang('Plot')</option>
                    <option value="commercial">@lang('Commercial')</option>
                    <option value="residential">@lang('Residential')</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- Plot Form -->
<div id="plotForm" class="card shadow mt-4 dynamic-form" style="display: none; border-radius: 15px;">
    <div class="card-header bg-gradient-primary text-black font-weight-bold py-3">@lang('Property Details')</div>
    <div class="card-body p-4 bg-light">

    <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Type of Plot Property') <span class="text-danger">*</span></label>
            <select class="form-control rounded-pill border-primary" name="property_types">
                <option value="" disabled selected>@lang('Select Type')</option>
                <option value="Residential Plot">@lang('Residential Plot')</option>
                <option value="Commercial Plot">@lang('Commercial Plot')</option>
                <option value="Agriculture Land">@lang('Agriculture Land')</option>
                <option value="Industrial Land">@lang('Industrial Land')</option>
                <option value="Warehouse Plot">@lang('Warehouse Plot')</option>
                <option value="Farmhouse Plot">@lang('Farmhouse Plot')</option>
                <option value="Plot File">@lang('Plot File')</option>
                <option value="Amenity Plot">@lang('Amenity Plot')</option>
            </select>
        </div>
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('City') <span class="text-danger">*</span></label>
            <input type="text" class="form-control rounded-pill border-primary" name="city" value="{{ old('city') }}" required>
            </div>

      

            <div class="form-group mb-4">
<label class="form-control-label font-weight-bold">@lang('Address')</label>
<div class="input-group">
<input type="text" class="form-control rounded-pill border-primary" name="address" id="address" placeholder="@lang('Enter Address')" required>
<button type="button" class="btn btn-primary ml-2" onclick="geocodeAddress()">Get Location</button>
</div>
<input type="hidden" name="latitude" id="latitude_plot">
<input type="hidden" name="longitude" id="longitude_plot">
<div id="map_plot" style="width: 100%; height: 400px;"></div>

<label class="form-control-label font-weight-bold mt-3">@lang('Nearest Landmark')</label>
<input type="text" class="form-control rounded-pill border-primary mt-2" name="nearest_landmark" placeholder="@lang('Enter Nearest Landmark')">
</div>



<div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Corner Property')</label>
            <select class="form-control rounded-pill border-primary" name="corner_property">
                <option value="yes">@lang('Yes')</option>
                <option value="no">@lang('No')</option>
            </select>
        </div>


        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Size of Property')</label>
            <select class="form-control rounded-pill border-primary" name="property_size">
                <option value="Sq.ft">@lang('Sq. Ft')</option>
                <option value="Sq.M">@lang('Sq. M')</option>
                <option value="Sq.Yd">@lang('Sq. Yd')</option>
                <option value="Marla">@lang('Marla')</option>
                <option value="Kanal">@lang('Kanal')</option>
                <option value="Acre">@lang('Acre')</option>
            </select>
        </div>

        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Asking Price (PKR)')</label>
            <input type="number" class="form-control rounded-pill border-primary" name="asking_price" placeholder="@lang('Enter Asking Price')" step="any">
        </div>

        <div class="form-group mb-4">
<label class="form-control-label font-weight-bold">@lang('Add some description about the Property')</label>
<input type="text" class="form-control rounded border-primary" name="description" placeholder="@lang('Enter description')" required>
</div>
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Upload Images of Your Property')</label>
            <input type="file" class="form-control rounded-pill border-primary" name="images[]" multiple accept="image/*" required>
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
required
>
<small class="text-muted">@lang('Number must start with 92 and have 12 digits in total.')</small>
</div>
<div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Agent Name')</label>
            <input type="text" class="form-control rounded-pill border-primary" name="agent_name" placeholder="@lang('Enter Agent Name')">
        </div>
      

    </div>
</div>

<!-- Commercial Form -->
<div id="commercialForm" class="card shadow mt-4 dynamic-form" style="display: none; border-radius: 15px;">
    <div class="card-header bg-gradient-primary text-black font-weight-bold py-3">@lang('Commercial Property Details')</div>
    <div class="card-body p-4 bg-light">
    <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Type of Commercial Property') <span class="text-danger">*</span></label>
            <select class="form-control rounded-pill border-primary" name="property_types">
                <option value="" disabled selected>@lang('Select Type')</option>
                <option value="Warehouse">@lang('Warehouse')</option>
                <option value="Building">@lang('Building')</option>
                <option value="Hall">@lang('Hall')</option>
                <option value="Plaza">@lang('Plaza')</option>
                <option value="Gym">@lang('Gym')</option>
                <option value="Restaurant">@lang('Restaurant')</option>
                <option value="Hotel">@lang('Hotel')</option>
                <option value="Hospital">@lang('Hospital')</option>
                <option value="Factory">@lang('Factory')</option>
                <option value="Running Business">@lang('Running Business')</option>
                <option value="Floor">@lang('Floor')</option>
            </select>
        </div>
   

        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Floor')</label>
            <select class="form-control rounded-pill border-primary" name="floor">
                <option value="ground">@lang('Basement')</option>
                <option value="ground">@lang('Ground')</option>
                <option value="ground">@lang('Mezzanine')</option>
                <option value="1">@lang('1')</option>
                <option value="2">@lang('2')</option>
                <option value="3">@lang('3')</option>
                <option value="4">@lang('4')</option>
                <option value="5">@lang('5')</option>
                <option value="6">@lang('6')</option>
                <option value="6">@lang('7')</option>
                <option value="6">@lang('8')</option>
                <option value="6">@lang('9')</option>
                <option value="6">@lang('10+')</option>
            </select>
        </div>
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('City') <span class="text-danger">*</span></label>
            <input type="text" class="form-control rounded-pill border-primary" name="city" value="{{ old('city') }}" required>
            </div>
            <div class="form-group mb-4">
<label class="form-control-label font-weight-bold">@lang('Address')</label>
<div class="input-group">
<input type="text" class="form-control rounded-pill border-primary" name="address" id="address_commercial" placeholder="@lang('Enter Address')" required>
<button type="button" class="btn btn-primary ml-2" onclick="geocodeAddress()">Get Location</button>
</div>

<input type="hidden" name="latitude" id="latitude_commercial">
<input type="hidden" name="longitude" id="longitude_commercial">
<div id="map_commercial" style="width: 100%; height: 400px;"></div>

<label class="form-control-label font-weight-bold mt-3">@lang('Nearest Landmark')</label>
<input type="text" class="form-control rounded-pill border-primary mt-2" name="nearest_landmark" placeholder="@lang('Enter Nearest Landmark')">
</div>

<div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Corner Property')</label>
            <select class="form-control rounded-pill border-primary" name="corner_property">
                <option value="yes">@lang('Yes')</option>
                <option value="no">@lang('No')</option>
            </select>
        </div>
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Size of Property')</label>
            <select class="form-control rounded-pill border-primary" name="property_size">
                <option value="Sq.ft">@lang('Sq. Ft')</option>
                <option value="Sq.M">@lang('Sq. M')</option>
                <option value="Sq.Yd">@lang('Sq. Yd')</option>
                <option value="Marla">@lang('Marla')</option>
                <option value="Kanal">@lang('Kanal')</option>
                <option value="Acre">@lang('Acre')</option>
            </select>
        </div>

        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Asking Price (PKR)')</label>
            <input type="number" class="form-control rounded-pill border-primary" name="asking_price" placeholder="@lang('Enter Asking Price')" step="any">
        </div>
        <div class="form-group mb-4">
<label class="form-control-label font-weight-bold">@lang('Add some description about the Property')</label>
<input type="text" class="form-control rounded border-primary" name="description" placeholder="@lang('Enter description')" required>
</div>
<div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Upload Images of Your Property')</label>
            <input type="file" class="form-control rounded-pill border-primary" name="images[]" multiple accept="image/*" required>
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
required
>
<small class="text-muted">@lang('Number must start with 92 and have 12 digits in total.')</small>
</div>

        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Agent Name')</label>
            <input type="text" class="form-control rounded-pill border-primary" name="agent_name" placeholder="@lang('Enter Agent Name')" required>
        </div>

     


        
    </div>
</div>

<!-- Residential Form -->
<div id="residentialForm" class="card shadow mt-4 dynamic-form" style="display: none; border-radius: 15px;">
    <div class="card-header bg-gradient-primary text-black font-weight-bold py-3">@lang('Residential Property Details')</div>
    <div class="card-body p-4 bg-light">
    <div class="form-group mb-4">

        <label class="form-control-label font-weight-bold">@lang('Type of Plot Property') <span class="text-danger">*</span></label>
            <select class="form-control rounded-pill border-primary" name="property_types">
                <option value="" disabled selected>@lang('Select Type')</option>
                <option value="Residential Plot">@lang('House')</option>
                <option value="Commercial Plot">@lang('Flat')</option>
                <option value="Agriculture Land">@lang('Room')</option>
                <option value="Industrial Land">@lang('Farm House  ')</option>
                <option value="Warehouse Plot">@lang('Penthouse')</option>
                <option value="Farmhouse Plot">@lang('Hostel')</option>
                <option value="Plot File">@lang('Basement')</option>
            </select>
        
</div>

        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Floor')</label>
            <select class="form-control rounded-pill border-primary" name="floor">
            <option value="ground">@lang('Basement')</option>
                <option value="ground">@lang('Ground')</option>
                <option value="1">@lang('1')</option>
                <option value="2">@lang('2')</option>
                <option value="3">@lang('3')</option>
                <option value="4">@lang('4')</option>
                <option value="5">@lang('5')</option>
                <option value="6">@lang('6')</option>
                <option value="6">@lang('7')</option>
                <option value="6">@lang('8')</option>
                <option value="6">@lang('9')</option>
                <option value="6">@lang('10+')</option>



            </select>
        </div>

        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('City') <span class="text-danger">*</span></label>
            <input type="text" class="form-control rounded-pill border-primary" name="city" value="{{ old('city') }}" required>
            </div>

     
           <div class="form-group mb-4">
<label class="form-control-label font-weight-bold">@lang('Address')</label>
<div class="input-group">
<input type="text" class="form-control rounded-pill border-primary" name="address" id="address_residential" placeholder="@lang('Enter Address')" required>
<button type="button" class="btn btn-primary ml-2" onclick="geocodeAddress()">Get Location</button>
</div>
<input type="hidden" name="latitude" id="latitude_residential">
<input type="hidden" name="longitude" id="longitude_residential">
<div id="map_residential" style="width: 100%; height: 400px;"></div>

<label class="form-control-label font-weight-bold mt-3">@lang('Nearest Landmark')</label>
<input type="text" class="form-control rounded-pill border-primary mt-2" name="nearest_landmark" placeholder="@lang('Enter Nearest Landmark')">
</div>

        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Corner Property')</label>
            <select class="form-control rounded-pill border-primary" name="corner_property">
                <option value="yes">@lang('Yes')</option>
                <option value="no">@lang('No')</option>
            </select>
        </div>
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Size of Property')</label>
            <select class="form-control rounded-pill border-primary" name="property_size">
                <option value="Sq.ft">@lang('Sq. Ft')</option>
                <option value="Sq.M">@lang('Sq. M')</option>
                <option value="Sq.Yd">@lang('Sq. Yd')</option>
                <option value="Marla">@lang('Marla')</option>
                <option value="Kanal">@lang('Kanal')</option>
                <option value="Acre">@lang('Acre')</option>
            </select>
        </div>
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Asking Price (PKR)')</label>
            <input type="number" class="form-control rounded-pill border-primary" name="asking_price" placeholder="@lang('Enter Asking Price')" step="any">
        </div>
        
        
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('How many Bedrooms?') <span class="text-danger">*</span></label>
            <select class="form-control rounded-pill border-primary" name="bedrooms">
            <option value="1">@lang('1')</option>
                        <option value="2">@lang('2')</option>
                        <option value="3">@lang('3')</option>
                        <option value="4">@lang('4')</option>
                        <option value="5">@lang('5')</option>
                        <option value="6">@lang('6')</option>
                        <option value="7">@lang('7')</option>
                        <option value="8">@lang('8')</option>
                        <option value="9">@lang('9')</option>
                        <option value="10">@lang('10')</option>
            </select>
        </div>

        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('How many Bathrooms?') <span class="text-danger">*</span></label>
            <select class="form-control rounded-pill border-primary" name="bathrooms">
            <option value="1">@lang('1')</option>
                        <option value="2">@lang('2')</option>
                        <option value="3">@lang('3')</option>
                        <option value="4">@lang('4')</option>
                        <option value="5">@lang('5')</option>
                        <option value="6">@lang('6')</option>
                        <option value="7">@lang('7')</option>
                        <option value="8">@lang('8')</option>
                        <option value="9">@lang('9')</option>
                        <option value="10">@lang('10')</option>
            </select>
        </div>

        <div class="form-group mb-4">
<label class="form-control-label font-weight-bold">@lang('Add some description about the Property')</label>
<input type="text" class="form-control rounded border-primary" name="description" placeholder="@lang('Enter description')" required>
</div>
    
        <div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Upload Images of Your Property')</label>
            <input type="file" class="form-control rounded-pill border-primary" name="images[]" multiple accept="image/*" required>
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
required
>
<small class="text-muted">@lang('Number must start with 92 and have 12 digits in total.')</small>
</div>

<div class="form-group mb-4">
            <label class="form-control-label font-weight-bold">@lang('Agent Name')</label>
            <input type="text" class="form-control rounded-pill border-primary" name="agent_name" placeholder="@lang('Enter Agent Name')" required>
        </div>
        </div>
    </div>
    <div class="text-center mt-4">
    <button type="submit" class="btn btn-primary btn-lg rounded-pill">@lang('Submit')</button>
</div>
</div>
</div>

</form>

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
function toggleForms() {
var propertyType = document.getElementById("property_type").value;

document.querySelectorAll('.dynamic-form').forEach(form => {
form.style.display = 'none';
Array.from(form.querySelectorAll('input, select')).forEach(input => {
    input.disabled = true;
});
});

if (propertyType === "plot") {
var plotForm = document.getElementById("plotForm");
plotForm.style.display = 'block';
Array.from(plotForm.querySelectorAll('input, select')).forEach(input => {
    input.disabled = false;
});
} else if (propertyType === "commercial") {
var commercialForm = document.getElementById("commercialForm");
commercialForm.style.display = 'block';
Array.from(commercialForm.querySelectorAll('input, select')).forEach(input => {
    input.disabled = false;
});
} else if (propertyType === "residential") {
var residentialForm = document.getElementById("residentialForm");
residentialForm.style.display = 'block';
Array.from(residentialForm.querySelectorAll('input, select')).forEach(input => {
    input.disabled = false;
});
}
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBorxMHcrLrPMvgzTDgEgLz9HA5UDuNY8"></script>
<script>
var geocoder;

function geocodeAddress() {
var propertyType = document.getElementById("property_type").value;
var addressField, latitudeField, longitudeField, mapField;

if (propertyType === "plot") {
    addressField = document.getElementById('address');
    latitudeField = document.getElementById('latitude_plot');
    longitudeField = document.getElementById('longitude_plot');
    mapField = document.getElementById('map_plot');
} else if (propertyType === "commercial") {
    addressField = document.getElementById('address_commercial');
    latitudeField = document.getElementById('latitude_commercial');
    longitudeField = document.getElementById('longitude_commercial');
    mapField = document.getElementById('map_commercial');
} else if (propertyType === "residential") {
    addressField = document.getElementById('address_residential');
    latitudeField = document.getElementById('latitude_residential');
    longitudeField = document.getElementById('longitude_residential');
    mapField = document.getElementById('map_residential');
}

var address = addressField.value;
geocoder = new google.maps.Geocoder();

geocoder.geocode({ 'address': address }, function (results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
        var latitude = results[0].geometry.location.lat();
        var longitude = results[0].geometry.location.lng();

        latitudeField.value = latitude;
        longitudeField.value = longitude;

        var map = new google.maps.Map(mapField, {
            zoom: 15,
            center: results[0].geometry.location,
        });

        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location,
        });
    } else {
        alert("Geocode was not successful for the following reason: " + status);
    }
});
}
</script>





    

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



</body>

</html>
@endsection
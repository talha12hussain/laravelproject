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

        .upload_dropZone {
            color: #0f3c4b;
            background-color: var(--colorPrimaryPale, #c8dadf);
            outline: 2px dashed var(--colorPrimaryHalf, #c1ddef);
            outline-offset: -12px;
            transition:
                outline-offset 0.2s ease-out,
                outline-color 0.3s ease-in-out,
                background-color 0.2s ease-out;
        }

        .upload_dropZone.highlight {
            outline-offset: -4px;
            outline-color: var(--colorPrimaryNormal, #0576bd);
            background-color: var(--colorPrimaryEighth, #c8dadf);
        }

        .upload_svg {
            fill: var(--colorPrimaryNormal, #0576bd);
        }

        .btn-upload {
            color: #fff;
            background-color: var(--colorPrimaryNormal);
        }

        .btn-upload:hover,
        .btn-upload:focus {
            color: #fff;
            background-color: var(--colorPrimaryGlare);
        }

        .upload_img {
            width: calc(33.333% - (2rem / 3));
            object-fit: contain;
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
            margin-bottom: 0
        }

        input,
        textarea,
        button {
            padding: 8px 15px;
            border-radius: 5px !important;
            margin: 5px 0px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            font-size: 18px !important;
            font-weight: 300
        }

        input:focus,
        textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #00BCD4;
            outline-width: 0;
            font-weight: 400
        }

        .btn-block {
            text-transform: uppercase;
            font-size: 15px !important;
            font-weight: 400;
            height: 43px;
            cursor: pointer
        }

        .floor-group {
            margin-bottom: 20px;
        }

        .btn-block:hover {
            color: #fff !important
        }

        button:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0
        }
    </style>

    <h1 class="text" style="margin-left: 0px !important; font-family: sans-serif"><b>@lang('back.create_property')</b></h1>

    <h3></h3>
    {{-- <p class="text-secondary" style="font-size:14px;">Enter the following details, carefully review and then submit</p> --}}
    <div class="container-fluid px-1 py-0 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-11 text-center">
                <div class="card">
                    <div class="col-sm-3">
                        <h2 class="d-flex justify-start my-3 mb-4 px-2" style="border-left: 4px solid blue;">@lang('back.property_details')
                        </h2>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success"><b> Success!! </b>{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form class="form-card" method="POST" action="{{ route('agent.storeProperty') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3"><b class="">@lang('back.name') </b><span
                                        class="text-danger">*</span></label>
                                <input type="text" id="name" value="{{ old('name') }}" name="name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-8 flex-column d-flex">
                                <label class="form-control-label px-3"><b>@lang('back.address')</b><span
                                        class="text-danger">*</span></label>
                                <input type="text" id="address" value="{{ old('address') }}" name="address">
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="row justify-content-between mt-3 text-left">
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3"><b>@lang('back.dimension_front')</b><span
                                        class="text-danger">*</span></label>
                                <input type="number" id="dimFront" value="{{ old('dimFront') }}" name="dimFront">
                                @error('dimFront')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3"><b>@lang('back.dimension_width')</b><span
                                        class="text-danger">*</span></label>
                                <input type="number" id="dimWidth" value="{{ old('dimWidth') }}" name="dimWidth">
                                @error('dimWidth')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3"><b>@lang('back.total_size')</b><span
                                        class="text-danger">*</span></label>
                                <input type="text" id="totalSize" value="{{ old('totalSize') }}" name="totalSize">
                                @error('totalSize')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-between mt-3 text-left">

                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3"><b>@lang('back.plot_size')</b><span
                                        class="text-danger">*</span></label>
                                <input type="number" id="plotSize" value="{{ old('plotSize') }}" name="plotSize">
                                @error('plotSize')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label mb-2 px-3"><b>@lang('back.plot_type')</b> <span class="text-danger">*</span></label>
                                <select class="p-2 border rounded-3" id="plotType" name="plot_type">
                                    <option value="commercial">@lang('messages.commercial')</option>
                                    <option value="warehouse">@lang('messages.warehouse')</option>
                                    <option value="shop">@lang('messages.shop')</option>
                                    <option value="showroom">@lang('messages.showroom')</option>
                                </select>
                            </div>

                            @error('plot_type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label for="size_type" class="form-control-label mb-2 px-3"><b>@lang('back.size')</b> <span class="text-danger">*</span></label>
                                <select class="p-2 border rounded-3"  id="sizeType" name="size_type">
                                    <option value="sq_yard">@lang('back.square_yard')</option>
                                    <option value="sq_fit">@lang('back.square_fit')</option>
                                    <option value="acre">@lang('back.acre')</option>
                                </select>
                            </div>

                            @error('size_type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                           
                        </div>


                        <div class="row justify-content-left mt-3 text-left">
                            <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3"><b>@lang('back.leased_area')</b></label>
                                <input type="number" id="leasedArea" value="{{ old('leasedArea') }}" name="leasedArea">
                                @error('leasedArea')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-8 flex-column d-flex">
                                <label class="form-control-label px-3"><b>@lang('back.nearest_landmark')</b><span
                                        class="text-danger">*</span></label>
                                <input type="text" id="nearestLand" value="{{ old('nearestLand') }}" name="nearestLand">
                                @error('nearestLand')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="my-5">
                            <h3 class="d-flex justify-start my-3">@lang('back.corner')</h3>



                            <div class="d-flex jutify-content-left my-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input border align-items-center  rounded-circle"
                                        style="padding: 10px !important;" type="radio" name="corner" id="inlineRadio1"
                                        {{ old('corner') === 'Yes' ? 'checked' : '' }} value="Yes">
                                    <label class="form-check-label mx-1"
                                        for="inlineRadio1"><b>@lang('back.yes')</b></label>
                                </div>
                                <div class="form-check form-check-inline mx-2">
                                    <input class="form-check-input border align-items-center  rounded-circle" type="radio"
                                        name="corner" style="padding: 10px !important;" id="inlineRadio2"
                                        {{ old('corner') === 'No' ? 'checked' : '' }} value="No">
                                    <label class="form-check-label mx-1"
                                        for="inlineRadio2"><b>@lang('back.no')</b></label>
                                </div>
                                @error('corner')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>



                        <hr class="" style="border:0.1px solid rgb(183, 183, 183); margin-top: 40px !important;">

                        <div class="my-2">
                            <h2 class="d-flex justify-start px-2 my-5" style="border-left: 4px solid blue;">
                                @lang('back.floor_details')</h2>
                            <div class="row d-flex justify-content-center mb-4 mt-0 text-left">


                                <div class="container mt-0">
                                    <div class="d-flex justify-start align-items-center">
                                        <h3 class="" style="margin-right:20px">@lang('back.rent')/@lang('back.sell')</h3>
                                        <button type="button" id="addFloorButtonRent"
                                            class="btn btn-primary btn-sm ">@lang('back.add') <b>+</b></button>
                                    </div>
                                    <a id="propertyForm">

                                        <div id="floorContainerRent"></div>
                                        @error('contactPerson')
                                            <div class="type">{{ $message }}</div>
                                        @enderror

                                    </a>
                                    @error('type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <hr class=""
                                    style="border:0.1px solid rgb(183, 183, 183); margin-top: 40px !important;">


                 <h2 class="d-flex px-2 my-5" style="border-left: 4px solid blue;"> @lang('back.other_information')</h2>
                 <div class="row justify-content-between mt-5 mb-4 text-left">
                    <div class="form-group col-sm-4 flex-column d-flex ">
                        <label class="form-control-label px-3"><b>@lang('back.parking_cap'):</b><span
                                class="text-danger">*</span></label>
                         <input type="number" id="parkingcap" name="parkingcap">
                            @error('parkingcap')
                              <div class="text-danger"> {{ $message }}</div>
                              @enderror
                            </div>

                            <div class="form-group col-sm-4 flex-column d-flex ">
                                <label class="form-control-label px-3"><b>@lang('back.demand_sqft'):</b><span
                                        class="text-danger">*</span></label>
                                <input type="number" id="demandSqft" name="demandSqft">
                                @error('demandSqft')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                             </div>

                             <div class="form-group col-sm-4 flex-column d-flex">
                                <label class="form-control-label px-3"><b>@lang('back.abs_value'):</b>
                                    <span style="font-size: 11px !important;" class="text-danger">Starting property demand</span>
                                </label>
                                <input type="number" id="absValue" name="absValue">
                                @error('absValue')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                    
                    
                </div>             
    
                                     {{-- <div class="row d-flex justify-content-center">
                                        <div class="form-group col-sm-4 ">
                                            <label class="form-control-label px-3"><b>@lang('back.parking_cap'):</b><span
                                                    class="text-danger">*</span></label>
                                             <input type="number" id="parkingcap" name="parkingcap"
                                                @error('parkingcap')>
                                                  <div class="text-danger"> {{ $message }}</div>
                                                  @enderror
                                                </div>
                                             
                                             <div class="form-group">
                                                <label class="form-control-label px-3"><b>@lang('back.abs_value'):</b><span
                                                        class="text-danger">*</span></label>
                                                <input type="number" id="absValue" name="absValue">
                                                @error('absValue')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                     </div> --}}
                               

                                <hr class=""
                                    style="border:0.1px solid rgb(183, 183, 183); margin-top: 40px !important;">

                                <h2 class="d-flex justify-start px-2 my-5" style="border-left: 4px solid blue;">
                                    @lang('back.agent_details'):</h2>

                                <div class="row justify-content-between mt-5 mb-4 text-left">


                                    <div class="form-group col-sm-3 flex-column d-flex">

                                        <label class="form-control-label px-3"><b>@lang('back.agent_name')</b><span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="agentname" name="agentName"
                                            value="{{ $agent->agentName }}">
                                        @error('agentname')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <label class="form-control-label px-3"><b>@lang('back.agent_contact')</b><span
                                                class="text-danger">*</span></label>
                                        <input type="number" id="agentcontact" name="agentcontact"
                                            onblur="validateContact()">
                                        @error('agentcontact')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <label class="form-control-label px-3"><b>@lang('back.agent_details')</b><span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="agentdetail" name="agentdetail">
                                        @error('agentdetail')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-3 flex-column d-flex">
                                        <label class="form-control-label px-3"><b>@lang('back.contact_person')</b><span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="contactPerson" name="contactPerson">
                                        @error('contactPerson')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row justify-content-between mt-3 text-left">

                                    <div class="form-group  col-md-12 flex-column my-4 d-flex">
                                        <label class="form-control-label  px-3"><b>@lang('back.upload_file')</b><span
                                                class="text-danger">*</span></label>
                                        {{-- <input type="file" id="file" name="file" accept="image/jpeg, image/png, image/svg+xml"> --}}
                                        <form action="{{ route('admin.dashboard.storeProperty') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <!-- Form fields here -->


                                            <input type="file" name="images[]" class="py-5 col-sm-12"
                                                accept="image/jpeg, image/png, image/svg+xml" multiple required>

                                            @if ($errors->has('images[]'))
                                                <div class="text-danger">{{ $errors->first('images') }}</div>
                                            @endif

                                            @foreach ($errors->get('images.*') as $error)
                                                <div class="text-danger">{{ $error[0] }}</div>
                                            @endforeach




                                    </div>
                                </div>
                                <div class="row justify-content-center mt-5 text-left">
                                    <div class="form-group col-sm-4 flex-column d-flex">
                                        <button type="Submit" onclick="SubmitCheck(event)" class="btn btn-primary">@lang('back.submit')</button>
                                    </div>
                    </form>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function validateContact() {
            var agentContact = document.getElementById('agentcontact').value;

            if (agentContact.length !== 11) {
                alert('Please enter a valid phone number');
            }
        }

        function validateContact(){
            var agentContact = document.getElementById('agentcontact').value;

            if(agentContact.length !== 11 ){
                alert('Please enter a valid phone number');
                event.preventDefault();
                return false;
            }
        }

        function SubmitCheck(event){
            var agentContact = document.getElementById('agentcontact').value;
            if(agentContact.length !== 11 ){
                alert('Please enter a valid phone number');
                event.preventDefault();
                return false;
            }

            var plotType = document.getElementById('plotType').value;

            if ((plotType === 'warehouse') && $('.floor-group').length > 1) {
                alert('You can only add one floor for Warehouse plot types.');
                event.preventDefault();
                return false; // Stop further execution
            }

            if (( plotType === 'showroom') && $('.floor-group').length > 1) {
                alert('You can only add one floor for Showroom plot types.');
                event.preventDefault();
                return false; // Stop further execution
            }
        }


    </script>

    <script>
        $(document).ready(function() {
            let floorIndex = 0;
            let floorSuitCombination = {};

            $('#addFloorButtonRent').click(function() {

                var plotType = $('#plotType').val();

                if ((plotType === 'warehouse') && $('.floor-group').length >= 1) {
                alert('You can only add one floor for Warehouse plot types.');
                return; // Stop further execution
            }

            if (( plotType === 'showroom') && $('.floor-group').length >= 1) {
                alert('You can only add one floor for Showroom plot types.');
                return; // Stop further execution
            }

            var sizeType = $('#sizeType').val();

            if(sizeType == 'acre'){
            var areaLabel = 'Area Acre';
        }else if(sizeType == 'sq_yard'){
            var areaLabel = 'Area Sq. Yard';
        }else if(sizeType == 'sq_fit'){
            var areaLabel = 'Area Sq. Ft';
        }
        else{
            var areaLabel = 'Area Sq. Ft';
        }


        if(sizeType == 'acre'){
            var rateLabel = 'Rate Acre';
        }else if(sizeType == 'sq_yard'){
            var rateLabel = 'Rate Sq. Yard';
        }else if(sizeType == 'sq_fit'){
            var rateLabel = 'Rate Sq. Fit';
        }
        else{
            var areaLabel = 'Area Sq. Ft';
        }



                floorIndex++;
                $('#floorContainerRent').append(`
            <div class="row justify-content-between mb-4 mt-3 text-left floor-group" id="floor${floorIndex}">
                <div class="form-group col-sm-2 flex-column d-flex">
                    <label class="form-control-label px-3"><b>@lang('back.floor_no')</b><span style="font-size:11px !important;" class="mx-2 text-danger">0 for ground floor</span></label>
                    <input type="number" id="floorNo${floorIndex}" name="floors[${floorIndex}][floorNo]"  class="form-control">
                </div>
                <div class="form-group col-sm-2 flex-column d-flex">
                    <label class="form-control-label px-3"><b>@lang('back.suite_no')</b><span style="font-size:11px !important;" class="mx-2 text-danger">0 for ground floor</span></label>
                    <input type="number" id="suitNo${floorIndex}" name="floors[${floorIndex}][suitNo]" class="form-control">
                </div>
                <div class="form-group col-sm-2 flex-column d-flex">
                    <label class="form-control-label px-3"><b>${areaLabel}</b><span class="text-danger">*</span></label>
                    <input type="number" id="areaSqft${floorIndex}" name="floors[${floorIndex}][areaSqft]" class="form-control">
                </div>
                <div class="form-group col-sm-2 flex-column d-flex">
                    <label class="form-control-label px-3"><b>${rateLabel}</b><span class="text-danger">*</span></label>
                    <input type="number" id="rateSqft${floorIndex}" name="floors[${floorIndex}][rateSqft]"  class="form-control">
                </div>
                <div class="form-group col-sm-4 flex-column my-4 align-items-center d-flex">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="form-group d-flex align-items-center">
                            
                            
                            <!-- Radio button for Rent -->
                            <div class="form-check mx-4 form-check-inline">
                                <input class="form-check-input border align-items-center rounded-circle" 
                                    style="padding: 10px !important;" 
                                    type="radio" 
                                    id="rent${floorIndex}" 
                                    name="floors[${floorIndex}][type]" 
                                    value="rent">
                                <label class="form-check-label mx-1" for="rent${floorIndex}"><b>@lang('back.rent')</b></label>
                            </div>
                            
                            <!-- Radio button for Sell -->
                            <div class="form-check form-check-inline mx-2">
                                <input class="form-check-input border align-items-center rounded-circle" 
                                    style="padding: 10px !important;" 
                                    type="radio" 
                                    id="sell${floorIndex}" 
                                    name="floors[${floorIndex}][type]" 
                                    value="sell">
                                <label class="form-check-label mx-1" for="sell${floorIndex}"><b>@lang('back.sell')</b></label>
                            </div>

                            <!-- Cancel button -->
                           <div class="d-flex " >
                             <button type="button" class="btn btn-danger btn-sm border rounded-pill align-items-center text-center mx-5 mb-3 cancel-floor" data-index="${floorIndex}" style="padding:2px !important; padding-right:12px !important; padding-bottom:6px !important; padding-left:12px !important;  border:1px solid red;  border-radius:100px !important; " >x</button>
                            </div>
                        

                            


                        </div>
                    </div>
                    @error('floors.*.type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
            </div>
        `);
            });

            // Handle Cancel button click
    $('#floorContainerRent').on('click', '.cancel-floor', function() {
        const floorIndex = $(this).data('index');
        console.log('clicked on remove');
        $(`#floor${floorIndex}`).remove();
        // console.log('removed'); 
    });

            $('form').on('submit', function(e) {
                let floorElements = $(this).find('.floor-group');
                floorSuitCombination = {};

                floorElements.each(function() {
                    let floorNo = $(this).find('input[name*="[floorNo]"]').val();
                    let suitNo = $(this).find('input[name*="[suitNo]"]').val();
                    let type = $(this).find('input[name*="[type]"]:checked').val();

                    if (floorNo && suitNo && type) {
                        let key = `${floorNo}-${suitNo}`;

                        if (floorSuitCombination[key] && floorSuitCombination[key] == type) {
                            alert(`Floor ${floorNo} with Suite ${suitNo} is list multiple times`);
                            e.preventDefault(); // Prevent form submission
                            return false; // Exit each loop
                        }

                        floorSuitCombination[key] = type;
                    }
                });
            });
        });
    </script>


    </body>

    </html>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>sign-up</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="{{ asset('assets/front/logo-primary.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('assets/style/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('assets/style/css/style.css')}}" rel="stylesheet">
</head>

<style>
body {
    color: #000;
    overflow-x: hidden;

}

input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
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



.blue-text {
    color: #00BCD4
}


.form-control-label {
    margin-bottom: 0
}

input,
textarea,
button {
    padding: 0px 15px !important;
    border-radius: 5px !important;
    margin: 5px 0px;
    /* box-sizing: border-box; */
    border: 1px solid #ccc;
    font-size: 18px !important;
    font-weight: 300
}

.file-upload{
    position: relative;
    overflow: hidden;
    display: inline-block;
    cursor:pointer;
    margin-bottom: 20px;
}

.file-upload input[type="file"] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
        }

    .file-upload-label {
            display: inline-block;
            padding: 10px;
            background-color: #f0f0f0;
            border: 2px dashed #ccc;
            color: #333;
            font-size: 16px;
            text-align: center;
            border-radius: 5px;
            width: 100%;
        }

    .file-upload-label .plus-icon {
        font-size: 24px;
        font-weight: bold;
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

.image-preview {
            display: none;
            width: 100px;
            height: 100px;
            margin-top: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }

.btn-block:hover {
    color: #fff !important
}
</style>

<body>
    
    <div class="position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign Up Start -->
        <div class="container-fluid bg-white">
            <div class="row text-center d-flex justify-content-center">
                <div class="mx-5 col-md-8 mt-4">
                    @if (session('success'))
                    <div class="alert alert-success mt-5 align-items-center pt-4  text-center"><h5><b> Registered !!</b> We will inform you after admin approval </h5></div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger"> {{ session('error') }}</div>
                    @endif
                </div>
            </div>
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-8">

                    {{-- form starting  --}}

                    <form method="POST" action="{{ route('agent.store') }}" enctype="multipart/form-data" >
                        @csrf
                        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-center mb-3">

                                <h1>@lang('auth.estate_agent_signup')</h1>
                            </div>

                            <h3 class="mt-5 mb-4">@lang('auth.estate_agency_details')</h3>
                            <div class="form-group mb-4">
                                <label for="exampleInputEmail1">@lang('auth.estate_agency_name') <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" name="agencyName" value="{{old('agencyName')}}"  placeholder="">

                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>                                        
                                    @enderror

                            </div>

                            <div class="form-group mb-4">
                                <label for="agencyAddress">@lang('auth.estate_agency_address') <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control p-2" name="agencyAddress"  id="agencyAddress" placeholder=""
                                    rows="1"> {{old('agencyAddress')  }} </textarea>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 mb-4">
                                    <label for="agencyCity ">@lang('auth.estate_agency_city') <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="agencyCity" class="form-control" id="agencyCity"
                                        placeholder="">


                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <label for="memName">@lang('auth.association_name') <span class="text-success" style="font-size: 12px !important;">(@lang('back.example'))</span></label>
                                    <input type="text" name="memName" class="form-control" value="{{ old('memName') }}" id="memName"
                                        placeholder="">

                                        @error('memName')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror


                                </div>

                                {{-- <div class="form-group col-md-4 mb-4">
                                    <label for="memNumber">@lang('auth.membership_number') <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="memNumber" value="{{ old('memNumber') }}" class="form-control" id="memNumber"
                                        placeholder="">


                                </div>
                                @error('memNumber')
                                
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    
                                @enderror --}}

                            </div>

                            <h3 class="mt-5 mb-4">@lang('auth.estate_agent_details')</h3>

                            <div class="row">
                                <div class="form-group col-md-4 mb-4">
                                    <label for="floatingText ">@lang('auth.first_name') <span class="text-danger">*</span></label>
                                    <input type="text" name="agentName" value="{{ old('agentName') }}" class="form-control" id="floatingText"
                                        placeholder="">


                                </div>
                                @error('agentName')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    
                                @enderror

                                <div class="form-group col-md-4 mb-4">
                                    <label for="floatingText">@lang('auth.middle_name')</label>
                                    <input type="text" name="agentminName" value="{{ old('agentminName') }}" class="form-control" id="floatingText"
                                        placeholder="">


                                </div>
                                @error('agentminName')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    
                                @enderror

                                <div class="form-group col-md-4 mb-4">
                                    <label for="floatingText">@lang('auth.last_name') <span class="text-danger">*</span></label>
                                    <input type="text" name="agentlastName" value="{{ old('agentlastName') }}" class="form-control" id="floatingText"
                                        placeholder="">


                                </div>
                                @error('agentlastName')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    
                                @enderror

                            </div>




                            <div class="row ">
                                <div class="form-group col-md-8  mb-4">
                                    
                                        <label for="tel">@lang('auth.cnic_number') <span class="text-danger">*</span></label>
                                        <input type="tel" name="cnicNum" placeholder="XXXXX-XXXXXXX-X" id="telle" maxlength="15"  class="form-control py-2" id="tel" >


                                </div>
                                @error('cnicNum')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    
                                @enderror

                                <div class="form-group col-md-4  mb-4">
                                    <label for="floatingText">@lang('auth.cnic_expiry_date')<span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="cnicExp" value="{{ old('cnicExp') }}"  class="form-control py-2" id="floatingText"
                                        placeholder="">


                                </div>
                                @error('cnicExp')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>  
                                    
                                @enderror
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4  mb-4">
                                    <label for="floatingText">@lang('auth.email') <span class="text-danger">*</span></label>
                                    <input type="email" name="agentEmail" value="{{ old('agentEmail') }}" class="form-control py-2" id="floatingText"
                                        placeholder="">


                                </div>

                                <div class="form-group col-md-4  mb-4">
                                    <label for="floatingText">@lang('auth.password')  <span class="text-danger">*</span></label>
                                    <input type="password" name="agentPassword" value="{{ old('agentPassword') }}" class="form-control py-2" id="floatingText"
                                        placeholder="">


                                </div>

                                <div class="form-group col-md-4 mb-4">
                                    <label for="landline">@lang('auth.landline') <span class="text-danger">*</span></label>
                                    <input type="string" name="landline" value="{{ old('landline') }}" maxlength="11"  class="form-control py-2" id="landline"
                                        placeholder="">
                                </div>


                            </div>


                            <div class="row">
                                <div class="row justify-content-between mt-3 text-left">

                                    


                                    <!-- agent certification -->

                                    <div class="file-upload form-group col-md-4 flex-column my-4 d-flex">
                                   
                                        <label class="file-upload-label form-control-label  px-3"><b>@lang('auth.estate_agent_profile')<span class="text-danger">*</span>
                                            </b>

                                                <input type="file" name="agentProfile"
                                                accept="image/jpeg, image/png, image/svg+xml" onchange="previewImage(event, 'imagepreview1')" >
                                            </label>

                                    </div>

                                    @error('agentProfile')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        
                                    @enderror
                                    

                                    <div class="file-upload form-group col-md-4 flex-column my-4 d-flex">
                                    
                                        <label class="file-upload-label align-items-center form-control-label  px-3">
                                            <b>@lang('auth.estate_agent_certification')</b>
                                                
                                                <input type="file" name="agentCertificate" class="py-5 col-sm-12"
                                                accept="image/jpeg, image/png, image/svg+xml" onchange="previewImage(event,'imagepreview2')" >
                                            </label>
        
                                    </div>
                                    @error('agentCertificate')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        
                                    @enderror

                                    <div class="file-upload form-group col-md-4 flex-column my-4 d-flex">
                                    

                                        <label class="file-upload-label align-items-center form-control-label  px-3">
                                            <b>@lang('auth.cnic_verification_form')<span class="text-danger">*</span></b>
                                                
                                                <input type="file" name="cnicVerify" class="py-5 col-sm-12"
                                                accept="image/jpeg, image/png, image/svg+xml" onchange="previewImage(event,'imagepreview3')" required>
                                            </label>
        
                                    </div>
                                    @error('cnicVerify')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        
                                    @enderror


                                </div>

                            </div>

                            <div class="row ">
                                <div class="col-md-4 d-flex justify-content-center text-center align-items-center mb-4">
                                <img src="#" id="imagepreview1" class="image-preview" alt="Image Preview 1">
                                </div>

                                <div class="col-md-4 d-flex justify-content-center text-center align-items-center  mb-4">
                                <img src="#" id="imagepreview2" class="image-preview" alt="Image Preview 2">
                                </div>

                                <div class="col-md-4 d-flex justify-content-center text-center align-items-center  mb-4">
                                <img src="#" id="imagepreview3" class="image-preview" alt="Image Preview 3">
                                </div>
                            </div>



                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">@lang('auth.sign_up')</button>
                            <p class="text-center mb-0">@lang('auth.already_have_account')? <a href="/agent-login">@lang('auth.estate_agent_login')</a>
                            </p>
                        </div>
                    </form>
                </div>

                {{-- working on errors --}}

                <!-- {{-- <div class="card-header text-body-secondary">
                    <div class="alert">
                        hello
                    </div>
                </div> --}} -->
            </div>
        </div>
        <!-- Sign Up End -->
    </div>

    <script>


var tele = document.querySelector('#telle');

tele.addEventListener('keyup', function(e){
  if (event.key != 'Backspace' && (tele.value.length === 5 || tele.value.length === 13)){
  tele.value += '-';
  }
});


        function previewImage(event, previewId){
            const input = event.target;
            const reader = new FileReader();


            reader.onload = function(){
                const preview = document.getElementById(previewId);
                if(preview){
                    preview.src=reader.result;
                    preview.style.display = "block";
                }else {
        console.error("Element with id '" + previewId + "' not found.");
    }
                
            }

            if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
        }

    </script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('assets/lib/chart/chart.min.js')}}"></script>
    <script src="{{asset('assets/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('assets/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{asset('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>
</body>

</html>
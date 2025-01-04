<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>login</title>
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

<body>
   
        <!-- Spinner Start -->
        {{-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> --}}
        <!-- Spinner End -->

        {{-- session success --}}
        

        <!-- Sign In Start -->
        <div class="container-fluid  bg-white">

          
           

            <div class="row h-150 align-items-center justify-content-center" style="min-height: 100vh;">
                
                
                {{-- @if (session('status'))
                @php
                    $status = session('status');
                @endphp
                @if ($status == 'success')
                    <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your account has been created successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($status == 'missing')
                    <div class="alert alert-danger alert-dismissible fade show text-center  m-2" role="alert">
                        <strong>Error!</strong> Your details are missing. Please Register.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                

                
            @endif --}}
                
                
                <div class="col-12 col-sm-8 col-md-6 col-lg-6 col-xl-4" >

                    @if (Session::has('message'))
                    <div class="alert alert-success mt-5 align-items-center pt-4  text-center">
                        {{Session::get('message')}}
                    @endif

                    @if(session('success'))
                <div class="alert alert-success mt-5 align-items-center pt-4  text-center"><h5><b> Registered !!</b> {{ $message }}</div>
                @endif

                @if (session('error'))
                <div class="alert alert-success mt-5 align-items-center pt-4  text-center"><h5><b> Error !!</b> {{ $message }}</div>
                @endif


                    {{-- form working --}}

                    <form  method="POST" action="{{route('agentLoginMatch')}}">
                        @csrf

                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3" >
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            
                            <h3>@lang('auth.agent_login')</h3>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="agentEmail" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                            <label for="floatingInput">@lang('auth.email')</label>
                        </div>
                        @error('agentEmail')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        <div class="form-floating mb-4">
                            <input type="Password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">@lang('auth.password')</label>
                        </div>
                        @error('agentPassword')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            {{-- <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div> --}}
                            <a href="{{route('agentforget.password.get')}}">@lang('auth.forgot_password')</a>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">@lang('auth.sign_in')</button>
                        <p class="text-center mb-0">@lang('auth.dont_have_account')? <a href="/agent-register">@lang('auth.sign_up')</a></p>
                    </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    

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
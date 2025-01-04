<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ESTADO - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">


    <!-- Favicon -->
<link href="{{ asset('assets/img/favicon.ico') }}" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="icon" href="{{ asset('assets/front/logo-primary.png') }}" type="image/x-icon">
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<!-- Template Stylesheet -->
<link href="{{ asset('assets/style/css/style.css') }}" rel="stylesheet">


   
</head>

<body>

    @if (Auth::guard('web')->check())
         @php
        $admin = Auth::guard('web')->user();
        @endphp
    @endif

    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div style="height:100vh;" class="sidebar bg-light pe-4 pb-3">
            <nav class="navbar  navbar-light">
                <a href="/dashboard" class="navbar-brand d-flex flex-center  mx-4 mb-3">
                      {{-- estado logo  --}}
            <img class="mx-5" src={{ asset('assets/front/logo-primary.png') }} style="width: 70px !important; height: 70px !important; " alt="">
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{ asset('assets/front/provider-user-2.webp')}}" alt=""
                        style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">
                        <span>@lang('back.admin')</span>
                    </h6>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{route('admin.dashboard.home')}}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>@lang('back.dashboard')</a>

                    <a href="{{route('admin.dashboard.propertyTable')}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>@lang('back.property')</a>
                    <a href="{{route('admin.dashboard.createProperty')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>@lang('back.create_property')</a>
                    <a href="{{route('admin.dashboard.agentRequest')}}" class="nav-item nav-link"><i class="fa fa-user me-2"></i>@lang('back.agent_request')</a>
                    <a href="{{route('admin.dashboard.agentList')}}" class="nav-item nav-link"><i class="fa fa-users me-2"></i>@lang('back.agents')</a>

                    {{-- <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a> --}}
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item active">Blank Page</a>
                        </div>
                    </div> --}}
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class=" navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                {{-- <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="@lang('back.search')">
                </form> --}}
                <div class="navbar-nav align-items-center ms-auto">


                    <div class="dropdown ">
                        <button style="border: 2px solid white; border-radius:20px !important" class="btn btn-dark mx-3 border align-items-center rounded-2 rounded-pill border-light " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Language
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item text-center" href="locale/en">EngLish</a>
                            <a class="dropdown-item text-center" href="locale/ur">اردو</a>
                            <a class="dropdown-item text-center" href="locale/ar">عربی</a>
                          
                        </div>
                      </div>
                      

                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link " data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>

                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-primary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                     <div class="ms-2">
                                        <h6 class="fw-normal text-dark mb-0">@lang('back.no_messages')</h6>
                                    </div>
                                </div>
                            </a>                          
                            </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link b-primary" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            </a>
                        <div class="dropdown-menu dropdown-menu-end bg-white border border-dark  text-light   rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">@lang('back.no_notification')</h6>
                             </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">@lang('back.see_all_notification')</a>
                        </div>
                    </div> --}}
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link " data-bs-toggle="dropdown">
                            
                            <img class="rounded-circle" src="{{ asset('assets/front/provider-user-2.webp')}}" alt=""
                            style="width: 40px; height: 40px;">
                                <span class="d-none d-lg-inline-flex">{{ $admin->name }}</span>
                            
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="{{ route('admin.profile') }}" class="dropdown-item mx-2">@lang('back.my_profile')</a>

                            
                                
                                    <form method="POST" action={{route('logout')}}>
                                        @csrf
                                        <button type="submit" class="mx-3 btn btn-light">@lang('back.logout')</button>
                                    </form>
                                
                                
                            
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                {{-- <div class="text-dark ">
                        
                    
                    <p class="text-center d-flex justify-content-center">@lang('back.welcome_admin')!  &nbsp <b>{{ $admin->name }}</b></p>

            </div> --}}
                <div class="row p-4 vh-100  rounded  justify-content-center mx-0">
                    
                    <div class="col-md-12 text-center">
                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- Blank End -->


            <!-- Footer Start -->
            {{-- <div class="container-fluid pt-4 px-4">
                <div class="bg-white rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start" style="font-size:10px;">
                            &copy; <a href="https://wenawa.com/">www.wenawa.com</a>, All Right Reserved. 
                        </div>
                        
                    </div>
                </div>
            </div> --}}
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/chart/chart.min.js') }}"></script>
<script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/form.js')}}"></script>
</body>

</html>
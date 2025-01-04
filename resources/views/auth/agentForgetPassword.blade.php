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
   
       
        

        <!-- Sign In Start -->
        <div class="container-fluid  bg-white">

          
           

            <div class="row h-150 align-items-center justify-content-center" style="min-height: 100vh;">
                
                @if (session('success'))
                <div class="alert alert-success mt-5 align-items-center pt-4  text-center"><h5><b> Registered !!</b> {{ $message }}</div>
                @endif

                
               
                
                
                <div class="col-12 col-sm-8 col-md-6 col-lg-6 col-xl-4" >
                    {{-- form working --}}

                    @if (Session::has('message'))
                <div class="alert alert-success mt-5 align-items-center pt-4  text-center">
                    {{Session::get('message')}}
                </div>
                @endif

                    <form  method="POST" action="{{route('agentforget.password.post')}}">
                        @csrf

                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3" >
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            
                            <h3>Password Reset</h3>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="agentEmail" class="form-control" id="floatingInput" placeholder="agentname@example.com" required>
                            <label for="floatingInput">Email address</label>
                        </div>

                        @error('agentEmail')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        
                        <div class="d-flex align-items-center justify-content-between mb-4">
                           
                            
                        </div>
                        <button type="submit" class="btn btn-warning py-3 w-100 mb-4">Get Password Reset Link</button>

                        
                        <p class="text-center mb-0">Don't have an Account? <a href="/agent-register">Sign Up</a></p>
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
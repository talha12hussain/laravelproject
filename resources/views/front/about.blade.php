<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/front/logo-primary.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/utilities/bsb-btn-size/bsb-btn-size.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/utilities/margin/margin.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/utilities/padding/padding.css">

    <title>Document</title>
</head>

<body>

    {{-- navbar here --}}

        <div class="">
            @include('layouts.navbar')
        </div>

        @include('layouts.hero-sec')
    


    <!-- About 7 - Bootstrap Brain Component -->
  <div class="">
  <section class=""  style="margin-top: 100px !important;">
    
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <h2 class="mb-4 display-5 text-center"><b>@lang('messages.about')</b></h2>
                <p class="text-secondary mb-5 text-left lead fs-5">@lang('messages.estado_intro')</p>
                <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row gy-4 gy-lg-0 align-items-lg-center my-0 mt-0">
            <div class="col-12 col-lg-6">
                <img style="width:100%; height:100%; margin-top:0px !important;" class="img-fluid rounded border border-dark" loading="lazy" src="{{asset('assets/front/hands.jpeg')}}"
                    alt="About Us">
            </div>
            <div class="col-12 col-lg-6 col-xxl-6">
                <div class="row justify-content-lg-end">
                    <div class="col-12 col-lg-11">
                        <div class="about-wrapper">
                            <p class="lead mb-4 mb-md-5 lead fs-5">
                                @lang('messages.estado_team_commitment')
                            </p>
                            
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
  </div>
















    {{-- footer section --}}

    @include('layouts.footer')







</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</html>
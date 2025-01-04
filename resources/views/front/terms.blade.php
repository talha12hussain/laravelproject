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

    @include('layouts.navbar')


    @include('layouts.hero-sec')

    <!-- About 7 - Bootstrap Brain Component -->
    <div class="">
        <section class="" style="margin-top: 100px !important;">

            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <h2 class="mb-4 display-5 text-center"><b>@lang('messages.terms_conditions')</b></h2>

                        <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
                    </div>
                </div>
            </div>

            <div class="container">


                <div class="col-12 col-lg-12 col-xxl-12">
                    <div class="row justify-content-lg-end">
                        <div class="col-12 col-lg-12">
                            <div class="about-wrapper">
                                {{-- <h3>@lang('messages.terms_intro')</h3> --}}
                                <p class="lead mb-4 mb-md-5">
                                    @lang('messages.terms_intro_text')
                                </p>


                            </div>

                            <div class="about-wrapper" dir="{{ in_array(App::getLocale(), ['ar', 'ur']) ? 'rtl' : 'ltr' }}">
                                <h3>@lang('messages.indemnity')</h3>
                                <p class="lead mb-4 mb-md-5">
                                    @lang('messages.indemnity_text')
                                </p>


                            </div>

                            <div class="about-wrapper" dir="{{ in_array(App::getLocale(), ['ar', 'ur']) ? 'rtl' : 'ltr' }}">
                                <h3>@lang('messages.liability')</h3>
                                <p class="lead mb-4 mb-md-5">
                                    @lang('messages.liability_text')
                                </p>


                            </div>

                            <div class="about-wrapper" dir="{{ in_array(App::getLocale(), ['ar', 'ur']) ? 'rtl' : 'ltr' }}">
                                <h3>@lang('messages.confidentiality')</h3>
                                <p class="lead mb-4 mb-md-5">
                                    @lang('messages.confidentiality_text')
                                </p>


                            </div>

                            <div class="about-wrapper" dir="{{ in_array(App::getLocale(), ['ar', 'ur']) ? 'rtl' : 'ltr' }}">
                                <h3>@lang('messages.estado_rights')</h3>
                                <p class="lead mb-4 mb-md-5">
                                    @lang('messages.estado_rights_text')
                                </p>


                            </div>

                            <div class="about-wrapper" dir="{{ in_array(App::getLocale(), ['ar', 'ur']) ? 'rtl' : 'ltr' }}">
                                <h3>@lang('messages.changes_to_terms')</h3>
                                <p class="lead mb-4 mb-md-5">
                                    @lang('messages.changes_to_terms_text')
                                </p>


                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container" dir="{{ in_array(App::getLocale(), ['ar', 'ur']) ? 'rtl' : 'ltr' }}">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                        <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
                        <p class="text-secondary mb-5 text-center lead fs-4" style="font-size:22px !important;">
                            @lang('messages.acknowledgement_text')<span><a href="#" type="email">info@estado.ltd</a></span>
                        </p>

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
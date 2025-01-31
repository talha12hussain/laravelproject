<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/front/logo-primary.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>{{ $single_property->property_types }}</title>
</head>

<body>
    @include('layouts.navbar')

    <div class="bg-image flex-column"
        style="background-image: url({{ asset('assets/front/14.jpg') }}); background-size:cover; background-position:top; height:30vh; width:100%; background-repeat:no-repeat; display: flex; justify-content: center; align-items: center; text-align: center; color: #ffffff; font-family: Arial, sans-serif;">
        <h1 class="text-dark mt-5"> <b>{{ $single_property->property_type }}</b></h1>
    </div>

    <div class="container mt-4">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="mb-5">
        <div class="property container-fluid mt-5"
            style="display: flex; justify-content: center; align-items: center; text-align: center; color: #ffffff; font-family: Arial, sans-serif;">
            <div class="row txt-center d-flex justify-content-center">
            <div class="text-center flex-center mx-3 justify-center align-items-center">
                    <div class="card my-3 mx-2" style="width: 24rem;">
                    @php
                    $images = json_decode($single_property->images, true);

                    $firstImage = collect($images)->first(); 
                    @endphp
<img class="card-img-top position-relative" 
     src="{{ $firstImage ? asset('storage/' . $firstImage) : asset('assets/front/15.jpg') }}" 
     alt="Property Image">




                        <div class="card-body" style="text-decoration: none;">
                            <h5 class="text-dark text-left"><b>
                                @if ($single_property->property_type == 'commercial' || $single_property->property_type == 'residential')
                                    Property : {{ $single_property->name }}
                                @else
                                    Plot Type: {{ $single_property->property_type }}
                                @endif
                            </b></h5>

                            <div class="d-flex justify-content-between align-items-center">
                                @if ($single_property->property_type == 'commercial' || $single_property->property_type == 'residential')
                                    <p class="card-text text-dark text-left mt-2" style="text-decoration: none;">@lang('Property Type') : {{ ucfirst($single_property->property_type) }}</p>
                                @else
                                    <p class="card-text text-dark text-left mt-2" style="text-decoration: none;">@lang('Property City') : {{ $single_property->city }}</p>
                                @endif

                                <h5>
                                    @if ($single_property->type == 'rent')
                                        <span class="badge badge-warning p-1 px-3">@lang('messages.rent')</span>
                                    @elseif ($single_property->type == 'sell')
                                        <span class="badge badge-success p-1 px-3">@lang('messages.sell')</span>
                                    @endif
                                </h5>
                            </div>
                            <a href="{{ url('/single-property/' . $single_property->id . '/agent/' . $single_property->agent_id) }}" class="btn btn-primary">View Agent</a>

                        </div>
                        <div style="margin-right: 40px" class="card-body border-top d-flex justify-content-between">
    <a href="#" class="card-link" style="font-size: 15px; display: inline-flex; align-items: center; line-height: 1;">
        <span style="vertical-align: middle;" class="text-dark"><b>@lang('Asking Price') {{ $single_property->asking_price }}</b></span>
    </a>
    <a href="#" class="card-link" style="font-size: 15px; display: inline-flex; align-items: center; line-height: 1;">
        <span style="vertical-align: middle;" class="text-dark"><b>@lang('Property_size') {{ $single_property->property_size }}</b></span>
    </a>
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        @include('layouts.footer')
    </div>

</body>

</html>

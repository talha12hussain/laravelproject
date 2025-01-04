<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/front/logo-primary.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>{{ $single_property->name }}</title>
</head>

<body>
    @include('layouts.navbar')

    <div class="bg-image flex-column"
        style="background-image: url({{ asset('assets/front/14.jpg') }});
            background-size:cover;
            background-position:top;
            height:30vh;
            width:100%;
            background-repeat:no-repeat;
            display: flex;            
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #ffffff; 
            font-family: Arial, sans-serif; ">

        <h1 class="text-dark mt-5"> <b>{{ $single_property->name }}</b></h1>
    </div>

    {{-- <div class="container d-flex justify-content-center align-items-center text-center mt-5">
        <div class="row ">
            <div class="col-md-12">
                <form action="{{ url()->current() }}" method="GET" class="form-inline">
                    <select  style="height: 50px !important" name="type" class="form-control px-5 mb-3">
                        <option value="">-- Select Floor Type --</option>
                        <option value="rent" {{ request('type') == 'rent' ? 'selected' : '' }}>Rent</option>
                        <option value="sell" {{ request('type') == 'sell' ? 'selected' : '' }}>Sell</option>
                    </select>
                    <button class="btn btn-primary mb-3 rounded-0 px-5"  style="height: 50px !important" type="submit">Filter</button>
                </form>
            </div>
        </div>
    </div> --}}

    <div class="container mt-4">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="mb-5">
        <div class="property container-fluid mt-5"
            style="
            display: flex;            
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #ffffff; 
            font-family: Arial, sans-serif;">

            <div class="row txt-center d-flex justify-content-center">
                @foreach ($floors as $floor)
                <a href="{{ url('/single-property/' . $single_property->id . '/floor/' . $floor->id) }}" class="">
                    <div class="text-center flex-center mx-3 justify-center align-items-center">

                        <div class="card my-3 mx-2" style="width: 24rem;">
                            @if ($single_property->images->isNotEmpty())
                                <img class="card-img-top position-relative" src="{{ asset('storage/' . $single_property->images->first()->file_path) }}" alt="Card image cap">
                            @else
                                <img class="card-img-top position-relative" src="{{ asset('assets/front/15.jpg') }}" alt="Card image cap">
                            @endif

                            <div class="card-body" style="text-decoration: none;">
                                <h5 class="text-dark text-left"><b>
                                    @if ($single_property->plot_type == 'warehouse' || $single_property->plot_type == 'showroom')
                                    Property : {{ $single_property->name }}
                                    @else
                                    
                                    @lang('messages.floor_no') {{ $floor->floorNo }}
                                    @endif
                                    
                                </b></h5>

                               


                                <div class="d-flex justify-content-between align-items-center">

                                    @if ($single_property->plot_type == 'warehouse' || $single_property->plot_type == 'showroom')
                                    
                                    <p class="card-text text-dark text-left mt-2" style="text-decoration: none;"> @lang('messages.plot_size') : {{ $single_property->size_type == 'sq_fit' ? "sq. Ft" : $single_property->size_type }} </p>
                                    @else
                                    
                                    <p class="card-text text-dark text-left mt-2" style="text-decoration: none;">Suite No: {{ $floor->suitNo }}</p>
                                    @endif
                                    
                                    <h5>
                                        @if ($floor->type == 'rent')
                                            <span class="badge badge-warning p-1 px-3">@lang('messages.rent')</span>
                                        @elseif ($floor->type == 'sell')
                                            <span class="badge badge-success p-1 px-3">@lang('messages.sell')</span>
                                        @endif
                                    </h5>
                                </div>
                            </div>
                            <div style="margin-right: 40px" class="card-body border-top d-flex justify-content-between">
                                <a href="#" class="card-link" style="font-size: 15px; display: inline-flex; align-items: center; line-height: 1;">
                                    <span style="vertical-align: middle;" class="text-dark"><b>@lang('messages.rate') {{ $floor->rateSqft }} /{{ $single_property->size_type == 'sq_fit' ? "sq. Ft" : $single_property->size_type }}</b></span>
                                </a>
                                <a href="#" class="card-link" style="font-size: 15px; display: inline-flex; align-items: center; line-height: 1;">
                                    <span style="vertical-align: middle;" class="text-dark"><b>@lang('messages.size') {{ $floor->areaSqft }} / {{ $single_property->size_type == 'sq_fit' ? "sq. Ft" : $single_property->size_type }}</b></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

       
    </div>

    <div class="">
        @include('layouts.footer')
    </div>

</body>

</html>

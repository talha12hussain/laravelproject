<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/utilities/bsb-btn-size/bsb-btn-size.css">
        <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/utilities/margin/margin.css">
        <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/utilities/padding/padding.css">
    <title>Document</title>
</head>

<style>
    .notify-badge-1 {
        position: absolute;
        right: 10px;
        top: 15px;
        opacity: 1.0;
        text-align: center;
        border-radius: 30px;
        padding: 5px 15px !important;
        font-size: 14px;
    }

    .notify-badge-3 {
        position: absolute;
        left: 10px;
        top: 15px;
        opacity: 1.0;
        text-align: center;
        border-radius: 30px;
        padding: 5px 15px !important;
        font-size: 14px;
    }

    .notify-badge-2 {
        position: absolute;
        right: 80px;
        top: 15px;
        opacity: 1.0;
        text-align: center;
        border-radius: 30px;
        padding: 5px 15px !important;
        font-size: 14px;
    }

    .card-img-top {
        height: 300px;
        object-fit: contain;
    }
</style>

<body>
    {{-- navbar here --}}
    <div>
        @include('layouts.navbar')
    </div>

    <div class="bg-image bg-light flex-column" style="
        background-image: url({{asset('assets/front/hero-image.jpg')}});
        background-size: cover;
        background-position: center;
            height:60vh;
            width:100%;
            background-repeat:no-repeat;
            display: flex;            
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #ffffff; 
            font-family: Arial, sans-serif;
            position: relative; ">

        <div>
            <h1 class="text-white mt-3"> <b>@lang('messages.your_new_property')</b></h1>
        </div>

        <div class="d-flex mt-3 justify-center">
    <form action="{{ url()->current() }}" method="GET" class="form-inline my-2 mt-3">
        <!-- Search Field -->
        <input class="form-control px-5 rounded-0" name="search" type="search" value="{{ request('search') }}" placeholder="@lang('messages.enter_property_name')" aria-label="Search" style="height: 50px !important">

        <!-- Transaction Type Filter (Rent/Sell) -->
        <select name="type" style="height: 50px !important" class="form-control px-5 py-2 form-select rounded-0">
            <option value="">@lang('messages.all')</option>
            <option value="rent" {{ request('type') == 'rent' ? 'selected' : '' }}>@lang('messages.rent')</option>
            <option value="sell" {{ request('type') == 'sell' ? 'selected' : '' }}>@lang('messages.sell')</option>
        </select>

        <!-- Property Type Filter -->
        <select name="property_type" style="height: 50px !important" class="form-control px-5 py-2 form-select rounded-0">
            <option value="">@lang('messages.all_property_type')</option>
            <option value="plot" {{ request('property_type') == 'plot' ? 'selected' : '' }}>@lang('messages.plot')</option>
            <option value="commercial" {{ request('property_type') == 'commercial' ? 'selected' : '' }}>@lang('messages.commercial')</option>
            <option value="residential" {{ request('property_type') == 'residential' ? 'selected' : '' }}>@lang('messages.residential')</option>
        </select>

        <!-- Submit Button -->
        <button style="height: 50px !important" class="btn btn-primary my-2 px-5 py-2 rounded-0 my-sm-0" type="submit">@lang('messages.search')</button>
    </form>
</div>

        
    </div>

    <div class="">
        <div class="">
            <h1 class="text-center text-dark my-5" style="height: 15vh; width:100%; font-family: Arial, sans-serif; font-size:50px;">
                <b>@lang('messages.top_properties')</b>
            </h1>
        </div>
        <div class="container-fluid align-items-center">
        <div class="row d-flex align-items-center text-center justify-content-center">
    @foreach ($all_home as $home)
    <div class="{{ $all_home->count() == 1 ? 'col-md-4 col-sm-12' : 'col-md-4 col-sm-6' }} mb-4">
        <a href="{{ url('/single-property/'.$home->id) }}" style="text-decoration: none;" class="link-underline-opacity-0">
            <div class="card h-100 d-flex justify-content-center align-items-center">
                <div class="">
                @php
                                        // Convert JSON images to an array
                                        $images = json_decode($home->images, true);
                                        $firstImage = collect($images)->first(); 
                                    @endphp
            <img class="card-img-top position-relative" src="{{ $firstImage ? asset('storage/' . $firstImage) : asset('assets/front/15.jpg') }}" alt="Card image cap">

                    <!-- Type Badge (Rent or Sell) -->
                    @if ($home->type == 'rent')
                        <span class="notify-badge-1 badge bg-warning position-absolute text-white px-4">@lang('messages.rent')</span>
                    @elseif ($home->type == 'sell')
                        <span class="notify-badge-2 badge bg-success position-absolute text-white px-4">@lang('messages.sell')</span>
                    @endif

                    <!-- Property Type Badge -->
                    <span class="notify-badge-3 badge bg-white position-absolute border border-dark text-dark px-4">
                        @switch($home->property_type)
                            @case('plot')
                                @lang('Plot')
                                @break
                            @case('commercial')
                                @lang('Commercial')
                                @break
                            @case('residential')
                                @lang('Residential')
                                @break
                            @default
                                @lang('messages.no_type')
                        @endswitch
                    </span>
                </div>
                <div class="card-body">
                    <p class="card-text text-left mx-2 mt-5 text-dark link-underline-opacity-0">
                        <b>@lang('Address'):</b> {{ $home->address }}
                    </p>
                </div>
                <div class="card-body border-top d-flex justify-content-between">
                    <a href="#" class="card-link text-dark" style="font-size: 15px; text-decoration: none;">
                        <b>@lang('Property Size'):</b> {{ $home->property_size }} 
                    </a>
                    <a href="#" class="card-link text-dark" style="font-size: 15px; text-decoration: none;">
                        <b>@lang('Corner'):</b> {{ $home->corner_property }}
                    </a>
                    <a href="#" class="card-link text-dark" style="font-size: 15px; text-decoration: none;">
                        <b>@lang('Asking Price'):</b> {{ number_format($home->asking_price) }} 
                    </a>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>




    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $all_home->links('pagination::bootstrap-4') }}
    </div>
</div>


    {{-- footer section --}}
    @include('layouts.footer')
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>

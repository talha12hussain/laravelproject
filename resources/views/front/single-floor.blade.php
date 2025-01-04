<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/front/logo-primary.png') }}" type="image/x-icon">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
</head>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Baloo+2&display=swap");
    $main-green: #79dd09 !default;
    $main-green-rgb-015: rgba(121, 221, 9, 0.1) !default;
    $main-yellow: #bdbb49 !default;
    $main-yellow-rgb-015: rgba(189, 187, 73, 0.1) !default;
    $main-red: #bd150b !default;
    $main-red-rgb-015: rgba(189, 21, 11, 0.1) !default;
    $main-blue: #0076bd !default;
    $main-blue-rgb-015: rgba(0, 118, 189, 0.1) !default;

    /* This pen */
    body {
        font-family: "Baloo 2", cursive;
        font-size: 16px;
        color: #ffffff;
        text-rendering: optimizeLegibility;
        font-weight: initial;
    }

    .dark {
        background: #110f16;
    }

        #map {
            height: 400px;
            width: 70%;
        }


    .light {
        background: #f3f5f7;
    }

    a,
    a:hover {
        text-decoration: none;
        transition: color 0.3s ease-in-out;
    }

    #pageHeaderTitle {
        margin: 2rem 0;
        text-transform: uppercase;
        text-align: center;
        font-size: 2.5rem;
    }

    /* Cards */
    .postcard {
        flex-wrap: wrap;
        display: flex;

        box-shadow: 0 4px 21px -12px rgba(0, 0, 0, 0.66);
        border-radius: 10px;
        margin: 0 0 2rem 0;
        overflow: hidden;
        position: relative;
        color: #ffffff;

        &.dark {
            background-color: #18151f;
        }

        &.light {
            background-color: #e1e5ea;
        }

        .t-dark {
            color: #18151f;
        }

        a {
            color: inherit;
        }

        h1,
        .h1 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        .small {
            font-size: 80%;
        }

        .postcard__title {
            font-size: 1.75rem;
        }

        .postcard__img {
            max-height: 180px;
            width: 100%;
            object-fit: cover;
            position: relative;
        }

        .postcard__img_link {
            display: contents;
        }

        .postcard__bar {
            width: 50px;
            height: 10px;
            margin: 10px 0;
            border-radius: 5px;
            background-color: #424242;
            transition: width 0.2s ease;
        }

        .postcard__text {
            padding: 1.5rem;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .postcard__preview-txt {
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: justify;
            height: 100%;
        }

        .postcard__tagbox {
            display: flex;
            flex-flow: row wrap;
            font-size: 14px;
            margin: 20px 0 0 0;
            padding: 0;
            justify-content: center;

            .tag__item {
                display: inline-block;
                background: rgba(83, 83, 83, 0.4);
                border-radius: 3px;
                padding: 2.5px 10px;
                margin: 0 5px 5px 0;
                cursor: default;
                user-select: none;
                transition: background-color 0.3s;

                &:hover {
                    background: rgba(83, 83, 83, 0.8);
                }
            }
        }

        &:before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-image: linear-gradient(-70deg, #424242, transparent 50%);
            opacity: 1;
            border-radius: 10px;
        }

        &:hover .postcard__bar {
            width: 100px;
        }
    }

    @media screen and (min-width: 769px) {
        .postcard {
            flex-wrap: inherit;

            .postcard__title {
                font-size: 2rem;
            }

            .postcard__tagbox {
                justify-content: start;
            }

            .postcard__img {
                max-width: 300px;
                max-height: 100%;
                transition: transform 0.3s ease;
            }

            .postcard__text {
                padding: 3rem;
                width: 100%;
            }

            .media.postcard__text:before {
                content: "";
                position: absolute;
                display: block;
                background: #18151f;
                top: -20%;
                height: 130%;
                width: 55px;
            }

            &:hover .postcard__img {
                transform: scale(1.1);
            }

            &:nth-child(2n+1) {
                flex-direction: row;
            }

            &:nth-child(2n+0) {
                flex-direction: row-reverse;
            }

            &:nth-child(2n+1) .postcard__text::before {
                left: -12px !important;
                transform: rotate(4deg);
            }

            &:nth-child(2n+0) .postcard__text::before {
                right: -12px !important;
                transform: rotate(-4deg);
            }
        }
    }

    @media screen and (min-width: 1024px) {
        .postcard__text {
            padding: 2rem 3.5rem;
        }

        .postcard__text:before {
            content: "";
            position: absolute;
            display: block;

            top: -20%;
            height: 130%;
            width: 55px;
        }

        .postcard.dark {
            .postcard__text:before {
                background: #18151f;
            }
        }

        .postcard.light {
            .postcard__text:before {
                background: #e1e5ea;
            }
        }
    }

    /* COLORS */
    .postcard .postcard__tagbox .green.play:hover {
        background: $main-green;
        color: black;
    }

    .green .postcard__title:hover {
        color: $main-green;
    }

    .green .postcard__bar {
        background-color: $main-green;
    }

    .green::before {
        background-image: linear-gradient(-30deg,
                $main-green-rgb-015,
                transparent 50%);
    }

    .green:nth-child(2n)::before {
        background-image: linear-gradient(30deg, $main-green-rgb-015, transparent 50%);
    }

    .postcard .postcard__tagbox .blue.play:hover {
        background: $main-blue;
    }

    .blue .postcard__title:hover {
        color: $main-blue;
    }

    .blue .postcard__bar {
        background-color: $main-blue;
    }

    .blue::before {
        background-image: linear-gradient(-30deg, $main-blue-rgb-015, transparent 50%);
    }

    .blue:nth-child(2n)::before {
        background-image: linear-gradient(30deg, $main-blue-rgb-015, transparent 50%);
    }

    .postcard .postcard__tagbox .red.play:hover {
        background: $main-red;
    }

    .red .postcard__title:hover {
        color: $main-red;
    }

    .red .postcard__bar {
        background-color: $main-red;
    }

    .red::before {
        background-image: linear-gradient(-30deg, $main-red-rgb-015, transparent 50%);
    }

    .red:nth-child(2n)::before {
        background-image: linear-gradient(30deg, $main-red-rgb-015, transparent 50%);
    }

    .postcard .postcard__tagbox .yellow.play:hover {
        background: $main-yellow;
        color: black;
    }

    .yellow .postcard__title:hover {
        color: $main-yellow;
    }

    .yellow .postcard__bar {
        background-color: $main-yellow;
    }

    .yellow::before {
        background-image: linear-gradient(-30deg,
                $main-yellow-rgb-015,
                transparent 50%);
    }

    .yellow:nth-child(2n)::before {
        background-image: linear-gradient(30deg,
                $main-yellow-rgb-015,
                transparent 50%);
    }

    @media screen and (min-width: 769px) {
        .green::before {
            background-image: linear-gradient(-80deg,
                    $main-green-rgb-015,
                    transparent 50%);
        }

        .green:nth-child(2n)::before {
            background-image: linear-gradient(80deg,
                    $main-green-rgb-015,
                    transparent 50%);
        }

        .blue::before {
            background-image: linear-gradient(-80deg,
                    $main-blue-rgb-015,
                    transparent 50%);
        }

        .blue:nth-child(2n)::before {
            background-image: linear-gradient(80deg, $main-blue-rgb-015, transparent 50%);
        }

        .red::before {
            background-image: linear-gradient(-80deg, $main-red-rgb-015, transparent 50%);
        }

        .red:nth-child(2n)::before {
            background-image: linear-gradient(80deg, $main-red-rgb-015, transparent 50%);
        }

        .yellow::before {
            background-image: linear-gradient(-80deg,
                    $main-yellow-rgb-015,
                    transparent 50%);
        }

        .yellow:nth-child(2n)::before {
            background-image: linear-gradient(80deg,
                    $main-yellow-rgb-015,
                    transparent 50%);
        }
    }

    .corousel-image {
        height: 450px;
        width: 100% !important;
        /* Adjust as needed */
        object-fit: contain;

        margin-top: 20px;
        border: 1px solid rgb(216, 216, 216);
        border-radius: 10px !important;
        /* Ensures the image covers the area */
    }
</style>

<body>

    <div class="">
        @include('layouts.navbar')
    </div>



    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h1 class="mt-5"></h1>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container-fluid  mx-3" style="margin-top:70px !important;">
        {{-- <h2>Property: {{ $property->name }}</h2>
    <h3>Floor No: {{ $floor->floorNo }}</h3> --}}

        <p class="text-dark" style="font-size:18px !important;">
            <i>property/{{ $property->name }}/floor/{{ $floor->floorNo }}</i></p>

    </div>

    {{--  floor header image  --}}


    {{-- <div class="bg-image flex-column"
        style="background-image: url({{ asset('assets/front/14.jpg') }});
            background-size:cover;
            
            background-position:center;
            height:30vh;
            width:100%;
            background-repeat:no-repeat;
            display: flex;            
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #ffffff; 
            font-family: Arial, sans-serif; ">

        <div>
            <h1 class="text-dark mt-3"> <b>Falaknaz Appartments</b></h1>

        </div>



    </div> --}}
    <div class="container-fluid d-flex justify-content-between">

        <div class="col-md-6 mx-5">
            {{-- <img  class="card-img-top position-relative mb-4"  src="{{ asset('storage/'.$property->images->first()->file_path ) }}"
            alt="Card image cap"> --}}

            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @if ($property->images->isNotEmpty())
                    @foreach ($property->images as $key => $image)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img class="corousel-image d-block w-100" src="{{ asset('storage/' . $image->file_path) }}"
                            alt="First slide">
                    </div>
                @endforeach
                   @else
                     <img class="card-img-top position-relative" src="{{ asset('assets/front/15.jpg')}}" alt="Card image cap">
                    @endif
                    


                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon color-dark" aria-hidden="true"></span>
                    <span class="sr-only color-dark">Previous</span>
                </a>
                <a class="carousel-control-next color-dark" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon  color-dark" aria-hidden="true"></span>
                    <span class="sr-only color-dark">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-6 mt-5" class="height:400px !important;">
            <h1 class="text-dark mt-3"> <b>{{ $property->name }} - {{ $floor->floorNo }}</b></h1>
            <p class="text-dark mt-5" style="font-size:28px !important;"><b>@lang('messages.address') : </b>{{ $property->address }}</p>
            <p class="text-dark mt-5 align-items-center" style="font-size:26px !important;"><b>@lang('messages.type')</b>
                @if ($floor->type == 'rent')
                    
                    <span
                        class="notify-badge-1 badge bg-warning mt-2 mx-3 position-absolute text-white px-4">@lang('messages.rent')</span>
                @endif

                @if ($floor->type == 'sell')
                    
                    <span
                        class="notify-badge-1 badge bg-success mt-2 mx-3 position-absolute text-white px-4">@lang('messages.sell')</span>
                @endif
                </span>
            </p>

            {{-- @php
                $totalSize = (float) $property->totalSize;
                $demandSqft = (float) $property->demandSqft;

                $price = $property->totalSize*$property->demandSqft;
                
            @endphp --}}

            <p class="text-dark mt-5" style="font-size:32px !important;"><b class="">Demand / {{ $property->size_type == 'sq_fit' ? "square Feet" : $property->size_type }} :</b><span
                    class="mx-3">Rs {{ $property->demandSqft }}</span></p>
        </div>

    </div>
    <hr class="" style="border:0.1px solid rgb(222, 221, 221); margin-top: 40px !important;">

    <div class="container-fluid d-flex justify-content-center">


        <div class="col-md-6 mx-5 my-3">
            <div class="my-5">
                <h1 class="text-center" style=""><b>@lang('back.property_details')</b></h1>
            </div>


            <table style="border:1px solid black; border-radius:15px !important;" class="table border border-dark ">
                <thead>
                   
                    <tr>
                        <th scope="col">@lang('messages.plot_size') </th>
                        <td scope="col">{{ $property->plotSize }}  {{ $property->size_type == 'sq_fit' ? "square Feet" : $property->size_type }} </td>
                    </tr>
                    <tr>
                        <th scope="col">@lang('messages.dimension_front')</th>
                        <td scope="col">{{ $property->dimFront }}  {{ $property->size_type == 'sq_fit' ? "square Feet" : $property->size_type }} </td>
                    </tr>
                    <tr>
                        <th scope="col">@lang('messages.dimension_depth')</th>
                        <td scope="col">{{ $property->dimWidth }}  {{ $property->size_type == 'sq_fit' ? "square Feet" : $property->size_type }} </td>
                    </tr>
                    <tr>
                        <th scope="col">@lang('messages.total_size')</th>
                        <td scope="col">{{ $property->totalSize }}  {{ $property->size_type == 'sq_fit' ? "square Feet" : $property->size_type }} </td>
                    </tr>
                    <tr>
                        <th scope="col">@lang('messages.total_size')</th>
                        <td scope="col">{{ $property->leasedArea }}  {{ $property->size_type == 'sq_fit' ? "square Feet" : $property->size_type }} </td>
                    </tr>
                    <tr>
                        <th scope="col">@lang('messages.nearest_landmark')</th>
                        <td scope="col">{{ $property->nearestLand }}</td>
                    </tr>
                    <tr>
                        <th scope="col">@lang('messages.corner')</th>
                        <td scope="col">{{ $property->corner }}</td>
                    </tr>
                    <tr>
                        <th scope="col">@lang('messages.parking_capacity')</th>
                        <td scope="col">{{ $property->parkingcap }}</td>
                    </tr>
                    <tr>
                        <th scope="col">@lang('messages.demand_sqyard') {{ $property->size_type }} </th>
                        <td scope="col">{{ $property->demandSqft }}</td>
                    </tr>
                    <tr>
                        <th scope="col">@lang('messages.absolute_value')</th>
                        <td scope="col">{{ $property->absValue }}</td>
                    </tr>


                    </tbody>

                </thead>

            </table>
        </div>


    </div>

    <hr class="" style="border:0.1px solid rgb(222, 221, 221); margin-top: 40px !important;">

    <h1 class="text-center py-4 m-5">PROPERTY LOCATION</h1>

    <div class="d-flex justify-content-center">
        <div  id="map">
                
        </div>
    </div>
            

    <hr class="" style="border:0.1px solid rgb(222, 221, 221); margin-top: 40px !important;">


    <div class="container-fluid d-flex justify-content-center">
        <div class="col-md-10">
            <section class="white">
                <div class="container py-4">
                    <h1 class="h1 text-center text-dark" id="pageHeaderTitle">@lang('messages.agent_details')</h1>

                    <article class="postcard light blue">
                        <a class="postcard__img_link" href="#">
                            <img class="postcard__img" src={{ asset('assets/front/provider-user-2.webp') }}
                                alt="Image Title" />
                        </a>
                        <div class="postcard__text">
                            <h1 class="postcard__title blue text-dark"><a href="#">{{ $property->agentname }}</a>
                            </h1>
                            <div class="postcard__subtitle small">
                                <time datetime="2020-05-25 12:00:00 text-dark">
                                    <i class="fas fa-calendar-alt text-dark mr-2"></i><span class="text-dark">Last
                                        Active : Today</span>
                                </time>
                            </div>
                            <div class="postcard__bar"></div>
                            <div class="postcard__preview-txt text-dark">@lang('messages.agent_description')
                            </div>
                            <ul class="postcard__tagbox">
                                <li class="tag__item"><i class="fas fa-phone mr-2"></i>{{ $property->agentcontact }}
                                </li>
                                <li class="tag__item"><i class="fas fa-star mr-2"></i>@lang('messages.top_rated_agent')</li>
                                <li class="tag__item play blue">
                                    <a href="#"><i class="fas fa-handshake mr-2"></i>@lang('messages.total_deals') : 10+</a>
                                </li>
                            </ul>
                        </div>
                    </article>

                </div>
            </section>
            <hr class="" style="border:0.1px solid rgb(222, 221, 221); margin-top: 40px !important;">



        </div>

    </div>


    <div class="container-fluid">
        @include('layouts.footer')
    </div>











    {{-- 
<h2>Property: {{ $property->name }}</h2>
<h3>Floor No: {{ $floor->floorNo }}</h3 --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBorxMHcrLrPMvgzTDgEgLz9HA5UDuNY8"></script>
<script>
    function initMap() {
        // Coordinates passed from the controller
        var location = { lat: {{ $coordinates['latitude'] }}, lng: {{ $coordinates['longitude'] }} };

        // Create a map centered at the location
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: location
        });

        // Place a marker at the location
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }

    // Initialize the map on window load
    window.onload = function() {
        initMap();
    };
</script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

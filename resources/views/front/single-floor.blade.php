<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/front/logo-primary.png') }}" type="image/x-icon">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Property Details</title>
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

    .corousel-image {
        height: 450px;
        width: 100% !important;
        object-fit: contain;
        margin-top: 20px;
        border: 1px solid rgb(216, 216, 216);
        border-radius: 10px !important;
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

    <div class="container-fluid mx-3" style="margin-top:70px !important;">
        <p class="text-dark" style="font-size:18px !important;">
            <i>property/{{ $single_property->name }}</i>
        </p>
    </div>

    <div class="container-fluid d-flex justify-content-between">
    <div class="col-md-6 mx-5">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @php
                    // Convert JSON images to an array
                    $images = json_decode($single_property->images, true);
                @endphp
                
                @foreach ($images as $key => $image)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                        <img class="card-img-top position-relative" 
                             src="{{ asset('storage/' . $image) }}" 
                             alt="Property Image">
                    </div>
                @endforeach
            </div>

            <!-- Carousel Controls -->
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>


        <div class="col-md-6 mt-5">
            <h1 class="text-dark mt-3"><b>{{ $single_property->Property_type }}</b></h1>
            <p class="text-dark mt-5" style="font-size:28px !important;"><b>@lang('messages.address') : </b>{{ $single_property->address }}</p>
            <p class="text-dark mt-5 align-items-center" style="font-size:26px !important;">
                <b>@lang('messages.type')</b>
                @if ($single_property->type == 'rent')
                    <span class="notify-badge-1 badge bg-warning mt-2 mx-3 position-absolute text-white px-4">@lang('messages.rent')</span>
                @elseif ($single_property->type == 'sell')
                    <span class="notify-badge-1 badge bg-success mt-2 mx-3 position-absolute text-white px-4">@lang('messages.sell')</span>
                @endif
            </p>
            <p class="text-dark mt-5" style="font-size:32px !important;">
                <b>Property Size / {{ $single_property->property_size}} </b>
            </p>
        </div>
    </div>

    <hr style="border:0.1px solid rgb(222, 221, 221); margin-top: 40px !important;">

    <div class="container-fluid d-flex justify-content-center">
        <div class="col-md-6 mx-5 my-3">
            <div class="my-5">
                <h1 class="text-center"><b>@lang('back.property_details')</b></h1>
            </div>
            <table style="border:1px solid black; border-radius:15px !important;" class="table border border-dark">
                <thead>
                 
                <tr>
                        <th scope="col">@lang('Property_Type')</th>
                        <td scope="col">{{ $single_property->property_type }} </td>
                    </tr>
                    <tr>
                        <th scope="col">@lang('Property_Types')</th>
                        <td scope="col">{{ $single_property->property_types }} </td>
                    </tr>
                    <tr>
                        <th scope="col">@lang('Floor')</th>
                        <td scope="col">{{ $single_property->floor }} </td>
                    </tr>
                    <tr>
                        <th scope="col">@lang('Bedrooms')</th>
                        <td scope="col">{{ $single_property->bedrooms }} </td>
                    </tr>
                    <tr>
                        <th scope="col">@lang('City')</th>
                        <td scope="col">{{ $single_property->city }} </td>
                    </tr>
                    <tr>

                        <th scope="col">@lang('Bathrooms')</th>
                        <td scope="col">{{ $single_property->bathrooms }} </td>
                    </tr>
                   
                    <tr>
                        <th scope="col">@lang('Nearest_landmark')</th>
                        <td scope="col">{{ $single_property->nearest_landmark }}</td>
                    </tr>
                    <tr>
                        <th scope="col">@lang('Corner Property')</th>
                        <td scope="col">{{ $single_property->corner_property }}</td>
                    </tr>
                    <tr>
                        <th scope="col">@lang('Contact Number')</th>
                        <td scope="col">{{ $single_property->contact_no }}</td>
                    </tr>
                   
                </thead>
            </table>
        </div>
    </div>

    <hr style="border:0.1px solid rgb(222, 221, 221); margin-top: 40px !important;">

    <h1 class="text-center py-4 m-5">PROPERTY LOCATION</h1>

    <div class="d-flex justify-content-center">
    <div id="map" style="width: 100%; height: 400px;"></div>  <!-- Map size set -->
</div>

    <hr style="border:0.1px solid rgb(222, 221, 221); margin-top: 40px !important;">

    <div class="container-fluid d-flex justify-content-center">
        <div class="col-md-10">
            <section class="white">
                <div class="container py-4">
                    <h1 class="h1 text-center text-dark" id="pageHeaderTitle">@lang('messages.agent_details')</h1>
                    <article class="postcard light blue">
                        <a class="postcard__img_link" href="#">
                            <img class="postcard__img" src="{{ asset('assets/front/provider-user-2.webp') }}" alt="Agent Image" />
                        </a>
                        <div class="postcard__text">
                            <h1 class="postcard__title blue text-dark"><a href="#">{{ $single_property->agent_name }}</a></h1>
                            <div class="postcard__subtitle small">
                                <time datetime="2020-05-25 12:00:00">
                                    <i class="fas fa-calendar-alt text-dark mr-2"></i><span class="text-dark">Last Active : Today</span>
                                </time>
                            </div>
                            <div class="postcard__bar"></div>
                            <div class="postcard__preview-txt text-dark">{{ $single_property->description }}</div>
                            <ul class="postcard__tagbox">
                                <li class="tag__item"><i class="fas fa-phone mr-2"></i>{{ $single_property->contact_no }}</li>
                                
                            </ul>
                        </div>
                    </article>
                </div>
            </section>
            <hr style="border:0.1px solid rgb(222, 221, 221); margin-top: 40px !important;">
        </div>
    </div>

    <div class="container-fluid">
        @include('layouts.footer')
    </div>


    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBorxMHcrLrPMvgzTDgEgLz9HA5UDuNY8&callback=initMap"></script>
<script>
    function initMap() {
        // Latitude aur Longitude ko dynamically pass kiya gaya hai
        var location = { lat: {{ $coordinates['latitude'] }}, lng: {{ $coordinates['longitude'] }} };
        
        // Google Maps ka map object create karna
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15, 
            center: location  // Map ko center karna hai user ke location par
        });

        // Map par marker place karna
        var marker = new google.maps.Marker({
            position: location, 
            map: map
        });
    }

    // Map ko load karte waqt function call karenge
    window.onload = function() {
        initMap();
    };
</script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
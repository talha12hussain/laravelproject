<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Top Properties</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Badge styling */
        .notify-badge-1 {
            position: absolute;
            right: 10px;
            top: 10px;
            padding: 6px 14px;
            font-size: 14px;
            background-color: #ff9800; /* Improved visibility */
            color: white;
            border-radius: 15px;
            font-weight: bold;
        }

        /* Card Styling */
        .card {
            max-width: 300px;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* Image Styling */
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover; /* Ensures proper scaling */
        }

        /* Center text and adjust font */
        .card-body {
            text-align: center;
            font-size: 14px;
        }

        .card-body h5 {
            font-size: 18px;
            font-weight: bold;
        }

        /* Responsive Fixes */
        .property .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .col-lg-4 {
                width: 100%;
            }
        }

        /* Explore More Button */
        .explore-btn {
            font-size: 16px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .explore-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <!-- Section Title -->
    <div class="text-center my-5">
        <h1 class="text-dark" style="font-size: 50px; font-family: Arial, sans-serif;">
            <b>@lang('messages.top_properties')</b>
        </h1>
    </div>

    <!-- Properties Section -->
    <div class="property container-fluid">
        <div class="row d-flex">
            @php
                $prop = 0;
                $max_prop_to_show = 6;
            @endphp

            @foreach ($all_home as $home)
                @if ($prop < $max_prop_to_show)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
                        <a href="{{ url('/single-property/' . $home->id) }}" style="text-decoration: none;">
                            <div class="card h-100">
                                <div class="position-relative">
                                    @php
                                        // Convert JSON images to an array
                                        $images = json_decode($home->images, true);
                                        $firstImage = collect($images)->first(); 
                                    @endphp

                                    <img class="card-img-top"
                                         src="{{ $firstImage ? asset('storage/' . $firstImage) : asset('assets/front/15.jpg') }}"
                                         alt="Property Image">

                                    <span class="notify-badge-1">
                                        {{ $home->type }}
                                    </span>
                                </div>
                                <div class="card-body">
                                    <h5 class="text-dark">{{ $home->name }}</h5>
                                    <p class="card-text text-dark"><b>@lang('Address'):</b> {{ $home->address }}</p>
                                    <p class="card-text text-dark"><b>@lang('Property Size'):</b> {{ $home->property_size }}</p>
                                    <p class="card-text text-dark"><b>@lang('Asking Price'):</b> {{ $home->asking_price }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif

                @php
                    $prop++;
                @endphp
            @endforeach

            @if ($all_home->count() > $max_prop_to_show)
                <div class="col-md-12 text-center">
                    <a href="/properties" class="explore-btn">
                        @lang('messages.explore_all')
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

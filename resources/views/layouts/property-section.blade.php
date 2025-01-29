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
            right: 8px;
            top: 8px;
            opacity: 1.0;
            text-align: center;
            border-radius: 20px;
            padding: 5px 12px;
            font-size: 12px;
            font-weight: bold;
        }

        /* Card image styling */
        .card-img-top {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        /* Container and row adjustments */
        .property.container-fluid {
            display: flex;
            justify-content: center;
            text-align: center;
        }

        .row.d-flex {
            justify-content: center !important;
        }

        /* Card Styling */
        .card {
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-body {
            padding: 15px;
        }

        .card-body h5 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 14px;
            margin-bottom: 5px;
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
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <a href="{{ url('/single-property/' . $home->id) }}" style="text-decoration: none;">
                            <div class="card h-100">
                                <div class="position-relative">
                                    @php
                                        $firstImage = collect($home->images)->first();
                                    @endphp
                                    <img class="card-img-top"
                                        src="{{ $firstImage ? asset('storage/' . $firstImage) : asset('assets/front/15.jpg') }}"
                                        alt="Property Image">
                                    <span class="notify-badge-1 badge bg-warning text-white">
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
                <div class="col-md-12 text-center mt-4">
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

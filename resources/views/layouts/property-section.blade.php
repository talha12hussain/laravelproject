<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
.notify-badge-1 {
    position: absolute;
    right: 10px;
    top: 15px;
    /* background:rgb(160, 244, 225); */
    opacity: 1.0;
    text-align: center;
    border-radius: 30px 30px 30px 30px;
    align-items: center color:white;
    padding: 5px 15px !important;
    font-size: 14px;
}

.notify-badge-2 {
    position: absolute;
    right: 80px;
    top: 15px;
    /* background:rgb(160, 244, 225); */
    opacity: 1.0;
    text-align: center;
    border-radius: 30px 30px 30px 30px;
    align-items: center color:white;
    padding: 5px 15px !important;
    font-size: 14px;
}

.notify-badge-3 {
    position: absolute;
    left:15px;
    top: 15px;
    /* background:rgb(160, 244, 225); */
    opacity: 1.0;
    text-align: center;
    border-radius: 30px 30px 30px 30px;
    align-items: center color:white;
    padding: 5px 15px !important;
    font-size: 14px;
}

.card-img-top {
    height: 300px;
    /* Adjust as needed */
    object-fit: contain;
    /* Ensures the image covers the area */
}
</style>

<body>
    <div class="property-part flex-column" style="
    background-size:cover;
    background-position:center;
    
    margin-top:20px !important;
    margin-bottom: -30px !important;
    width:100%;
    background-repeat:no-repeat;
    display: flex;            
    justify-content: center;
    align-items: center;
    text-align: center;
    color: #ffffff; 
    font-family: Arial, sans-serif; ">

        <div class="mt-5">
            <h1 class="text-dark mt-5" style="font-size:50px;"><b>@lang('messages.properties_by_location')</b></h1>
        </div>

        <div class="mx-5 flex-center col-md-8 my-5">
            <p class="text-dark flex-center mx-5 text-center">
                @lang('messages.discover_dream_property')
            </p>
        </div>


        

    </div>
            
           


   <div class=" ">
    <div class="">
        <h1 class="text-center text-dark my-5"
            style="height: 15vh; margin-top :50px !important; font-family: Arial, sans-serif; font-size:50px;">
            <b>@lang('messages.top_properties')</b>
        </h1>
    </div>

    <div class="property container-fluid align-items-center"
        style="display: flex; justify-content: center; align-items: center; text-align: center; color: #ffffff; font-family: Arial, sans-serif;">

        <div class="row d-flex justify-content-center text-center ">

            @php
                $prop = 0; // Property count initialize ki
                $max_prop_to_show = 6; // Maximum 6 properties display karni hain
            @endphp

            @foreach ($all_home as $home)
                @if ($prop < $max_prop_to_show)
                    <a href="{{ url('/single-property/' . $home->id) }}" style="text-decoration: none;"
                        class="link-underline-opacity-0">
                        <div
                            class="text-center flex-center {{ $all_home->count() == 1 ? 'col-md-10 col-sm-12' : 'col-md-4 col-sm-6' }} mb-4 justify-content-center align-items-center">

                            <div class="card h-100" style="width: 100%; margin:2px !important;">
                                <div class="">
                                    @if ($firstImage = $home->images->first())
                                        <img class="card-img-top  position-relative" style="object-fit:cover;"  src="{{ asset('storage/' . $firstImage->file_path) }}" alt="Card image cap">
                                    @else
                                        <img class="card-img-top position-relative"
                                            src="{{ asset('assets/front/15.jpg') }}" alt="Default image cap">
                                    @endif

                                    
                                            <div class="d-flex flex-right">
                                                @if ($home->floors->contains(fn($floor) => $floor->type == 'rent'))
                                        <span
                                            class="notify-badge-1 badge bg-warning position-absolute text-white px-4">@lang('messages.rent')</span>
                                    @endif

                                    @if ($home->floors->contains(fn($floor) => $floor->type == 'sell'))
                                        <span
                                            class="notify-badge-2 badge bg-success position-absolute text-white px-4">@lang('messages.purchase')</span>
                                    @endif

                                    <span  class="notify-badge-3 badge bg-white position-absolute border border-dark top-0 start-0  text-dark px-4">
                                    
                                        @if ($home->plot_type == "commercial")
                                            @lang('messages.commercial')

                                            @elseif ($home->plot_type == "shop")
                                            @lang('messages.shop')
                                            
                                            @elseif ($home->plot_type == "showroom")
                                            @lang('messages.showroom')

                                            @elseif ($home->plot_type == "warehouse")
                                            @lang('messages.warehouse')

                                            @else
                                            @lang('messages.no')
                                        @endif    
                                       
                                    
                                    </span>


                                            </div>

                                            
                                  

                                    


                                </div>

                                <div class="card-body">
                                    <h5 class="text-dark link-underline-opacity-0"><b>{{ $home->name }}</b></h5>
                                    <p class="card-text text-left mx-2 mt-5 text-dark link-underline-opacity-0">
                                        <b>@lang('messages.location')</b> {{ $home->address }}
                                    </p>
                                </div>

                                <div class="card-body border-top d-flex justify-content-between">
                                    <a href="#" class="card-link"
                                        style="font-size: 15px; display: inline-flex; align-items: center;  line-height: 1;">
                                        <span style="vertical-align: middle;" class="text-dark"><b>@lang('messages.area'):</b>
                                            {{ $home->totalSize }} </span>
                                    </a>
                                    <a href="#" class="card-link"
                                        style="font-size: 15px; display: inline-flex; align-items: center;  line-height: 1;">
                                        <span style="vertical-align: middle;" class="text-dark"> <b>@lang('messages.corner'):</b>
                                            {{ $home->corner }} </span>
                                    </a>
                                    <a href="#" class="card-link"
                                        style="font-size: 15px; display: inline-flex; align-items: center;  line-height: 1;">
                                        @if ($home->parkingcap > 30)
                                            <span style="vertical-align: middle;" class="text-dark">
                                                <b>@lang('messages.parking'):</b> Car/Bike
                                            </span>
                                        @elseif($home->parkingcap <= 30 && $home->parkingcap >= 10)
                                            <span style="vertical-align: middle;" class="text-dark">
                                                <b>Parking Cap:</b> Bike
                                            </span>
                                        @else
                                            <span style="vertical-align: middle;" class="text-dark">
                                                <b>Parking Cap:</b> No
                                            </span>
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                @php
                    $prop++; // Property count increase karte hain
                @endphp
            @endforeach

            {{-- Agar properties 6 se zyada hain to button show kare --}}
            @if ($all_home->count() > $max_prop_to_show)
                <div class="col-md-12 text-center">
                    <a href="/properties" class="btn btn-primary mt-5 p-3 px-5 rounded-0">
                        @lang('messages.explore_all')
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

    
</body>

</html>
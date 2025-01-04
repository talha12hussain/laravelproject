@extends('admin.adminMain')

@section('content')
    <h1 style="font-size:48px;">{{ $propertyshow->name }}</h1>

    <div class="container">
        <div class="row d-flex justify-content-center p-3">

            @foreach ($propertyshow->floors as $floor)
                <div class="col-md-3 text-center flex-center mx-4 justify-center align-items-center">

                    <a href="{{ url('/single-property/' . $propertyshow->id . '/floor/' . $floor->id) }}" class="text-decoration-none">
                        <div class="card my-3 mx-2" style="width: 22rem;">



                            @if ($propertyshow->images->isNotEmpty())
                            <img class="card-img-top position-relative" src="{{ asset('storage/' . $propertyshow->images->first()->file_path)}}" alt="Card image cap">
                           @else
                             <img class="card-img-top position-relative" src="{{ asset('assets/front/15.jpg')}}" alt="Card image cap">
                            @endif
    
    
    
                            <div class="card-body" style="text-decoration: none;">
                                <h5 class="text-dark text-left text-decoration-none" 
                                    style =" text-left:0px !important;"> <b style="text-decoration: none !important;">@lang('back.floor_no') :
                                        {{ $floor->floorNo }}</b> </h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="card-text text-dark text-left mt-2" style="text-decoration: none;">
                                        @lang('back.suite_no') : {{ $floor->suitNo }} </p>
                                    <h5 class="badge text-dark p-1 px-3">
    
                                        @if ($floor->type == 'rent')
                                            <span class="badge btn btn-warning p-1 px-3"
                                                style="font-size:14px">{{ $floor->type }} </span>
                                        @elseif ($floor->type == 'sell')
                                            <span class="badge btn btn-success p-1 px-3" style="font-size:14px">
                                                {{ $floor->type }} </span>
                                        @endif
                                    </h5>
                            
                                </div>
    
    
    
                            </div>
                            <div style="margin-right: 40px" class="card-body border-top d-flex justify-content-between  ">
                                <a href="#" class="card-link"
                                    style="font-size: 15px; display: inline-flex; align-items: center;  text-decoration:none; line-height: 1;">
                                  
                                    <span style="vertical-align: middle;" class="text-dark"><b>@lang('back.rate')
                                            :{{ $floor->rateSqft }} </b></span>
                                </a>
                                <a href="#" class="card-link"
                                    style="font-size: 15px; display: inline-flex; align-items: center; text-decoration:none;  line-height: 1;">
                                    
    
    
                                    <span style="vertical-align: middle;" class="text-dark"><b>@lang('back.size') :
                                            {{ $floor->areaSqft }} </b></span>
                                </a>
    
    
                            </div>
    
    
                        </div>
                    </a>

                </div>
            @endforeach

        </div>

    </div>
    </div>
@endsection

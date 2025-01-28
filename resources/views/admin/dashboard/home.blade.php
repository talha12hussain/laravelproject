@extends('admin.adminMain')

@section('content')
<div class="container-fluid  pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-white shadow rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-line fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Properties</p>
                    <h6 class="mb-0">{{ $home_detail }}</h6>
                </div>
            </div>
        </div>
       
        <div class="col-sm-6 col-xl-3">
            <div class="bg-white shadow rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Requests</p>
                    <h6 class="mb-0">{{ $agent_request }}</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-white shadow rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Approved </p>
                    <h6 class="mb-0">{{ $agent_approved }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
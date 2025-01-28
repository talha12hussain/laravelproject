@extends('admin.agentMain')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        
        <div class="col-sm-6 col-xl-6">
            <div class="bg-white shadow rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Properties</p>
                    <h6 class="mb-0">{{ $totalProperties }}</h6>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection
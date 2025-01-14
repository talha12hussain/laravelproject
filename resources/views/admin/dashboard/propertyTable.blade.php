@extends('admin.adminMain')

@section('content')
    @if (session('delete'))
        <div class="alert alert-danger"><b> Deleted!! </b> Product deleted successfully</div>
    @endif

    @if (session('update'))
        <div class="alert alert-warning"><b> Updated!! </b>{{ session('update') }}</div>
    @endif

    <div class="d-flex justify-content-between">

        <div class="" >
            <form action="{{ url()->current() }}" method="GET" class="">
                <div class="input-group col-md-12" >
                    <input type="search" name="search" value="{{ request('search') }}"  style="bottom: -30px !important;" class="form-control " placeholder="@lang('back.search')..."
                    
                    >
                    <button class="btn btn-primary" style="bottom: -30px !important;" type="submit">@lang('back.search')</button>
        
                    <!-- Reset Button -->
                    {{-- <a href="{{ url('admin-property') }}" class="btn btn-dark mx-3">
                        Reset
                    </a> --}}
                </div>
            </form>
        </div>

        <div class="">
            <h1 class="my-3 mb-4">@lang('back.all_listed_properties')</h1>
        </div>

        <div class="mt-4 mx-4">
            <a href="{{ route('property.export') }}" class="btn btn-primary"> @lang('back.export_all')</a>
        </div>
    </div>

    <!-- Search Bar -->
    

    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Property ID</th>
            <th>Property Type</th>
            <th>City</th>
            <th>Address</th>
            <th>Size</th>
            <th>Price</th>
            <th>Agent</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($properties as $property)
            <tr>
                <td>{{ $property->id }}</td>
                <td>{{ $property->property_type }}</td>
                <td>{{ $property->city }}</td>
                <td>{{ $property->address }}</td>
                <td>{{ $property->property_size }}</td>
                <td>{{ $property->asking_price }}</td>
                <td>{{ $property->agent_name }}</td>
                <td>
                    <a  class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('properties.destroy', $property->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
<div class="mt-3">
    {{ $properties->links() }}
</div>

    <!-- Pagination -->
   
@endsection

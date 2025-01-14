@extends('admin.adminMain')

@section('content')
    @if (session('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Deleted!</strong> Product deleted successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('update'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Updated!</strong> {{ session('update') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row mb-4 align-items-center">
            <!-- Search Form -->
            <div class="col-md-4">
                <form action="{{ url()->current() }}" method="GET" class="d-flex">
                    <input type="search" name="search" value="{{ request('search') }}" class="form-control me-2"
                        placeholder="@lang('back.search')..." aria-label="Search">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> @lang('back.search')</button>
                </form>
            </div>

            <!-- Page Title -->
            <div class="col-md-4 text-center">
                <h1 class="h4 my-3 text-primary">@lang('back.all_listed_properties')</h1>
            </div>

            <!-- Export Button -->
            <div class="col-md-4 text-end">
                <a href="{{ route('admin.property.export') }}" class="btn btn-success">
                    <i class="fas fa-download"></i> @lang('back.export_all')
                </a>
            </div>
        </div>

        <!-- Properties Table -->
        <div class="table-responsive shadow-lg rounded">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th class="border-end">@lang('property_id')</th>
                        <th class="border-end">@lang('property_type')</th>
                        <th class="border-end">@lang('city')</th>
                        <th class="border-end">@lang('address')</th>
                        <th class="border-end">@lang('size')</th>
                        <th class="border-end">@lang('price')</th>
                        <th class="border-end">@lang('agent')</th>
                        <th>@lang('actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($properties as $property)
                        <tr>
                            <td class="text-center border-end">{{ $property->id }}</td>
                            <td class="border-end">{{ $property->property_type }}</td>
                            <td class="border-end">{{ $property->city }}</td>
                            <td class="border-end">{{ $property->address }}</td>
                            <td class="text-center border-end">{{ $property->property_size }}</td>
                            <td class="text-end border-end">{{ number_format($property->asking_price, 2) }} @lang('back.currency')</td>
                            <td class="border-end">{{ $property->agent_name }}</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i> @lang('back.edit')
                                </a>
                                <form action="{{ route('properties.destroy', $property->id) }}" method="POST" 
                                      style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> @lang('back.delete')
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $properties->links() }}
        </div>
    </div>
@endsection

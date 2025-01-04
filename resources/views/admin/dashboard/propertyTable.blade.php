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
    

    <table class="table table-bordered border">
        <thead class="table-primary">
            <tr>
                <th scope="col">@lang('back.s_no')</th>
                <th scope="col">@lang('back.property_name')</th>
                <th scope="col">@lang('back.address')</th>
                <th scope="col">@lang('back.total_size')</th>
                <th scope="col">@lang('back.demand_sqft')</th>
                <th scope="col">@lang('back.agent_name')</th>
                <th scope="col">@lang('back.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_home as $home)
                <tr>
                    <th scope="row">{{ ($all_home->currentPage() - 1) * $all_home->perPage() + $loop->iteration }}</th>
                    <td class="">
                        <a href="{{ route('admin.dashboard.showProperty', $home->id) }}" class="text-dark"
                            style="text-decoration:none;">{{ $home->name }}</a>
                    </td>
                    <td>{{ $home->address }}</td>
                    <td>{{ $home->totalSize }}</td>
                    <td>{{ $home->demandSqft }}</td>
                    <td>{{ $home->agentname }}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('admin.dashboard.editProperty', $home->id) }}" class="">
                                <div class="btn btn-warning btn-sm">@lang('back.edit')</div>
                            </a>
                            <form class="mx-1" action="{{ url('/property/' . $home->id . '/delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn px-2 py-1 btn btn-sm btn-danger p-0">
                                    @lang('back.delete')
                                </button>
                            </form>
                            <a href="{{ route('property.export.pdf', $home->id) }}" class="">
                                <div class="btn btn-success btn-sm">@lang('back.pdf_export')</div>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="align-self-center">
        {{ $all_home->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
@endsection

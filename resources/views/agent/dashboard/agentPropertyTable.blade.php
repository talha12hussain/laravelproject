@extends('admin.agentMain')

@section('content')   

    @if (session('delete'))
        <div class="alert alert-danger"><b> Deleted!! </b> Product deleted successfully</div>
    @endif

    @if (session('update'))
        <div class="alert alert-warning"><b> Updated!! </b>{{ session('update') }}</div>
    @endif

    <div class="d-flex justify-content-between">
        <div class="">
            <form action="{{ url()->current() }}" method="GET" class="mb-4">
                <div class="input-group col-md-12">
                    <input type="search" name="search" value="{{ request('search') }}" style="bottom: -30px !important;" class="form-control" placeholder="@lang('back.search')...">
                    <button class="btn btn-primary" style="bottom: -30px !important;" type="submit">@lang('back.search')</button>
        
                    <!-- Reset Button -->
                    
                </div>
            </form>
        </div>
    
        <div class=""> 
               <h1 class="my-3 mb-4">@lang('back.properties_of') {{ Auth::guard('agent')->user()->agencyName }}</h1>
        </div>
    </div>

    <!-- Search Bar -->
    

    <table class="table table-bordered border">
        <thead class="table-primary">
            <tr>
                <th scope="col">@lang('back.s_no')</th>
                <th scope="col">@lang('back.name')</th>
                <th scope="col">@lang('back.address')</th>
                <th scope="col">@lang('back.total_size')</th>
                <th scope="col">@lang('back.demand_sqft')</th>
                <th scope="col">@lang('back.agent_name')</th>
                <th scope="col">@lang('back.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($properties as $home)
                <tr>
                    <th scope="row">{{ $loop->iteration + ($properties->currentPage() - 1) * $properties->perPage() }}</th>
                    <td>
                        <a href="{{ route('agent.dashboard.showProperty', $home->id) }}" class="text-dark" style="text-decoration:none;">{{ $home->name }}</a>
                    </td>
                    <td>{{ $home->address }}</td>
                    <td>{{ $home->totalSize }}</td>
                    <td>{{ $home->demandSqft }}</td>
                    <td>{{ $home->agentname }}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('agent.dashboard.agentEdit', $home->id) }}" class="btn btn-warning btn-sm">@lang('back.edit')</a>
                            <form class="mx-1" action="{{ url('/property/' . $home->id . '/delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">@lang('back.delete')</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="align-self-center">
        {{ $properties->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
@endsection

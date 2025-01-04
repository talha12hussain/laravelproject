@extends('admin.adminMain')

<style>
    .custom-text-size {
        font-size: 12px; /* Adjust the size as needed */
    }
</style>

@section('content')   

    @if (session('success'))
    <div class="alert alert-success"><b> Approved!! </b> Agent status changed successfully</div>
    @endif

    @if (session('delete'))
        <div class="alert alert-danger"><b> Deleted!! </b> Agent status deleted successfully</div>
    @endif

    @if (session('update'))
        <div class="alert alert-warning"><b> Updated!! </b>{{session('update')}}</div>
    @endif

    <div class="d-flex justify-content-between">
     <div class="">
            <h1 class="my-3 text-white mb-5"><b>@lang('back.pending_requests')</b></h1>
        </div>

        <div class="">
            <form action="{{ url()->current() }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="search" name="search" value="{{ request('search') }}" style="bottom: -25px !important;" class="form-control" placeholder="@lang('back.search')...">
                    <button class="btn btn-primary" style="bottom: -25px !important;" type="submit">@lang('back.search')</button>
        
                    <!-- Reset Button -->
                    
                </div>
            </form>
        </div>


    </div>

     <!-- Search Bar -->
     
    <table class="table table-bordered border ">
        <thead class="table-primary align-items-center">
            <tr>
                <th class="custom-text-size text-center" scope="col">@lang('back.s_no')</th>
                <th class="custom-text-size text-center" scope="col">@lang('back.agency_name')</th>
                <th class="custom-text-size text-center" scope="col">@lang('back.agency_address')</th>
                <th class="custom-text-size text-center" scope="col">@lang('back.agency_city')</th>
                <th class="custom-text-size text-center" scope="col">@lang('back.agent_name')</th>
                <th class="custom-text-size text-center" scope="col">@lang('back.cnic')</th>
                
                <th class="custom-text-size text-center" scope="col">@lang('back.cnic_expire')</th>
                <th class="custom-text-size text-center" scope="col">@lang('back.approval')</th>
                <th class="custom-text-size text-center" scope="col">@lang('back.action')</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($agentRequested as $agents)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td class="">
                        <a href={{route('admin.dashboard.showProperty', $agents->id)}} class="text-dark" style="text-decoration:none;" >{{ $agents->agencyName }}</a>
                    </td>
                    <td>{{ $agents->agencyAddress }}</td>
                    <td>{{ $agents->agencyCity }}</td>

                    {{-- <td>{{ trim($agents->agentName) }} {{ trim($agents->agentminName) }}</td> --}}
                    <td>{{ $agents->agentName }}</td>
                    <td>{{ $agents->cnicNum }}</td>
                    @php
                        $expiry = date_create($agents->cnicExp);
                        $expiry = date_format($expiry, 'd-m-Y');
                    @endphp
                    
                    <td>{{ $expiry}}</td>
                    {{-- @php
                        $date = date_create($agents->created_at);
                        $date = date_format($date, 'd-m-Y');
                    @endphp
                    <td>{{ $date }}</td> --}}


                    

                    <td>
                        <div class="d-flex justify-content-center">
                            <form action="{{  route('toggle.agent.status', $agents->id)}}" method="POST" id="toggle-form-{{ $agents->id }}">
                                @csrf
                                <input type="hidden" name="status" value="{{ $agents->status == 1 ? 2 : 1 }}">
                                    

                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault-{{ $agents->id }}"
                                        @if($agents->status == 2) checked 
                                        @endif
                                         onchange="document.getElementById('toggle-form-{{ $agents->id }}').submit();">
                                      
                                        </div>
                                     
                                </div>
                            </form>
                           
                        {{-- <a href="{{route('admin.dashboard.editProperty', $agents->id)}}" class="">
                            <div class="btn btn-warning btn-sm">Edit</div>
                        </a>
                        <form class="mx-1" action="{{ url('/property/' . $agents->id . '/delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn px-2 py-1  btn btn-sm btn-danger p-0">
                                Delete
                            </button>
                        </form> --}}
                        </div>

                    </td>

                    <td>
                        <div class="dflex justify-content-center">
                            
                        <form class="mx-1" action="{{ url('/agent-request/' . $agents->id . '/delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn px-2 py-1 btn btn-sm btn-danger py-0" style="border-radius:50px;">
                              @lang('back.delete')
                            </button>
                        </form>
                        </div>
                    </td>

                </tr>
            @endforeach


        </tbody>
    </table>
     <!-- Pagination -->
     <div class="align-self-center">
        {{ $agentRequested->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
@endsection

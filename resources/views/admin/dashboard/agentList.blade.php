@extends('admin.adminMain')

@section('content')   

    @if (session('success'))
    <div class="alert alert-success"><b> Approved!! </b> Agent status changed successfully</div>
    @endif

    @if (session('delete'))
        <div class="alert alert-danger"><b> Deleted!! </b>Agent Status deleted successfully</div>
    @endif

    @if (session('update'))
        <div class="alert alert-warning"><b> Updated!! </b>{{session('update')}}</div>
    @endif


  

    <div class="d-flex justify-content-between">

        <div class="">
            <form action="{{ url()->current() }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="search" name="search" value="{{ request('search') }}" style="bottom: -25px !important;" class="form-control" placeholder="@lang('back.search')s...">
                    <button class="btn btn-primary" style="bottom: -25px !important;" type="submit">@lang('back.search')</button>
        
                    <!-- Reset Button -->
                    
                </div>
            </form>
        </div>

        <div class="">
            <h1 class="my-3 mb-4">@lang('back.approved_agents')</h1>
        </div>

        <div class="mt-4 mx-4">
            <a href="{{ route('agent.export') }}" class="btn btn-primary"> @lang('back.agent_details_export')</a>

        </div>
    </div>
    <!-- Search Bar -->
    

    {{-- <h1>hey {{$agentList->memName }}</h1> --}}

    <table class="table table-bordered border ">
        <thead class="table-primary">
            <tr>

                <th scope="col">@lang('back.s_no')</th>
                <th scope="col">@lang('back.agency_name')</th>
                <th scope="col">@lang('back.agency_address')</th>
                <th scope="col">@lang('back.agency_city')</th>
                <th scope="col">@lang('auth.membership_number')</th>
                <th scope="col">@lang('back.agent_name')</th>
                <th scope="col">@lang('back.cnic')</th>
                
                <th scope="col">@lang('back.cnic_expire')</th>
                
                <th scope="col">@lang('back.approval')</th>
                <th scope="col">@lang('back.action')</th>
                <th scope="col">Excel</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($agentList as $agents)
            

                <tr>
                    
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td class="">
                        <a href={{route('admin.dashboard.showProperty', $agents->id)}} class="text-dark" style="text-decoration:none;" >{{ $agents->agencyName }}</a>
                    </td>
                    <td>{{ $agents->agencyAddress }}</td>
                    <td>{{ $agents->agencyCity }}</td>
                    <td>{{ $agents->memNumber }}</td>
                    {{-- <td>{{ trim($agents->agentName) }} {{ trim($agents->agentminName) }}</td> --}}
                    <td>{{ $agents->agentName }}</td>
                    <td>{{ $agents->cnicNum }}</td>
                    <td>{{ $agents->cnicExp }}</td>

                    

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

                    <td>
                        <a class="btn btn-sm btn-success" href="{{ url('agent/property-export/'. $agents->id) }}">@lang('back.agent_properties')</a>
                    </td>

                </tr>
            @endforeach


        </tbody>
    </table>

    <!-- Pagination -->
    <div class="align-self-center">
        {{ $agentList->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
@endsection

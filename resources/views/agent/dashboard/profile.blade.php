@extends('admin.agentMain')

@section('content')
<section style="background-color: #f7f7f7;">
    <div class="container py-5">
    
  
      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <img src="{{ asset('storage/uploads/agent_profile/' . $user->agentProfile) }}" alt="avatar"
                class="rounded-circle img-fluid" style="width: 150px; height:150px !important; object-fit:cover;">
              <h5 class="my-3">{{ $user->agentName }}</h5>
              <p class="text-muted mb-1">@lang('messages.estado properties') @lang('back.agent')</p>
              <p class="text-muted mb-4">{{ $user->agencyAddress }}</p>
              <div class="d-flex justify-content-center mb-2">
                <a href="/" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary text-white">@lang('back.landing_page')</a>
                <a  href="/agent/home"  data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary  ms-1">@lang('back.dashboard')</a>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="card mb-4 mb-lg-0">
                <div class="card-body p-0">
                  <ul class="list-group list-group-flush rounded-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                      <i class="fas fa-globe fa-lg text-warning"></i>
                      <p class="mb-0">
                        <a href="/">Estado.ltd</a>
                    </p>
                    </li>
                    
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                      <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                      <p class="mb-0">@Estado</p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                      <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                      <p class="mb-0">Estado</p>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                      <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                      <p class="mb-0">Estado Pvt. Ltd.</p>
                    </li>
                  </ul>
                </div>
              </div>

             


          </div>
        </div>
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">@lang('back.agent') @lang('back.name')</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $user->agentName }}</p>
                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">@lang('back.agent') @lang('auth.email')</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $user ->agentEmail }}</p>
                </div>
              </div>
              <hr>


              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">@lang('back.agency_name')</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $user->agencyName }}</p>
                </div>
              </div>

              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">@lang('back.agency_address')</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $user->agencyAddress }}</p>
                </div>
              </div>

              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">@lang('auth.association_name')</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $user->memName }}</p>
                </div>
              </div>

              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">@lang('back.cnic')</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $user->cnicNum }}</p>
                </div>
              </div>
              

              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">@lang('auth.cnic_expiry_date')</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $user->cnicExp }}</p>
                </div>
              </div>
              <hr>
              

             

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0"><b>@lang('back.total_properties')</b></p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><b>{{ $user->properties->count() }}</b></p>
                </div>
              </div>

              <hr>

              {{-- <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0"><b>Total Floors Available</b> </p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><b>{{ $user->floor->count() }}</b></p>
                </div>
              </div>

              <hr> --}}

             
              

              
            </div>
          </div>
          {{-- <div class="row">
            <div class="col-md-6">
              <div class="card mb-4 mb-md-0">
                <div class="card-body">
                  <p class="mb-4"><span class="text-primary  me-1">Agent Details</span>
                  </p>
                  <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                  <div class="progress rounded mb-2" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-4 mb-md-0">
                <div class="card-body">
                  <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                  </p>
                  <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                  <div class="progress rounded" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                  <div class="progress rounded mb-2" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
        </div>

        
      </div>
    </div>
  </section>
@endsection
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<style>
    .dropdown-menu {
    width: 100%; /* Make the dropdown menu take full width of the button */
    max-width: 250px; /* Limit the maximum width */
    white-space: normal; /* Allow text wrapping */
    overflow-x: hidden; /* Hide horizontal overflow */
}

@media (max-width: 576px) {
    .dropdown-menu {
        max-width: 100%; /* For small screens, let the dropdown take full width */
    }   
}
.custom-navbar .navbar-collapse {
    display: flex;
    justify-content: space-between;
}

.custom-navbar .navbar-toggler {
    display: none;
}

/* Collapse navbar at 900px */
@media (max-width: 900px) {
    .custom-navbar .navbar-collapse {
        display: none !important;
    }

    .custom-navbar .navbar-toggler {
        display: block !important;
    }

    .custom-navbar .navbar-collapse.collapse.show {
        display: block !important;
    }

    .custom-navbar .navbar-collapse.collapse {
        display: none !important;
    }
}

/* Keep navbar expanded for widths above 900px */
@media (min-width: 901px) {
    .custom-navbar .navbar-collapse {
        display: flex !important;
    }

    .custom-navbar .navbar-toggler {
        display: none !important;
    }
}
</style>
<body>

    <nav class="navbar px-3 navbar-expand-md navbar-dark bg-dark fixed-top">
        {{-- Navbar brand or logo --}}
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/front/logo-primary.png') }}" style="width: 40px; height: 40px !important;" alt="">
        </a>
    
        {{-- Navbar Toggler Button --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        {{-- Collapsible navbar content --}}
        <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link"  href="/">@lang('messages.home')</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link"  href="/properties">@lang('messages.properties')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="/about">@lang('messages.about')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="/terms-and-conditions">@lang('messages.terms_conditions')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="/privacy-policy">@lang('messages.privacy_policy')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="/contact-us">@lang('messages.contact_us')</a>
                </li>
            </ul>
            
            <div class="navbar-nav d-flex flex-end align-items-center">

                @if (Auth::check())
                <a href="{{ route('admin.dashboard.home') }}" class="btn btn-primary">@lang('messages.admin_dashboard')</a>
            @elseif (Auth::guard('agent')->check())
                <a href="{{ route('admin.dashboard.agentHome') }}" class="btn btn-primary">@lang('messages.agent_dashboard')</a>
            @else
                <div class="dropdown  ">
                    <button style="border: 2px solid white; border-radius:20px !important" class="btn btn-sm btn-dark mt-1 mx-3 border rounded-2 rounded-pill border-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span  " ><img style="width: 24px !important; height: 24px !important; color:aliceblue !important;" class="color-white" src={{ asset('assets/icon/person.svg') }} alt=""></span>
                    </button>
                    
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item text-center" href="/login">@lang('messages.admin_login')</a>
                        <a class="dropdown-item text-center" href="/agent-login">@lang('messages.agent_login')</a>
                        <a class="dropdown-item text-center" href="/agent-register">@lang('messages.become_an_agent')</a>
                    </div>
                </div>
            @endif
    
    
            {{-- Language Dropdown --}}
    
    
            <div class="dropdown">
                <button style="border: 2px solid white; border-radius:20px !important" class="btn btn-sm btn-dark mx-3 border rounded-2 rounded-pill border-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Language
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item text-center" href="locale/en">EngLish</a>
                    
                    <a class="dropdown-item text-center" href="locale/ur">اردو</a>
                    <a class="dropdown-item text-center" href="locale/ar">عربی</a>
                </div>
            </div>
    
    
               </div>
    

           

            
    
            {{-- Authenticated User Links --}}
            
        </div>
    </nav>
    

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

</html>
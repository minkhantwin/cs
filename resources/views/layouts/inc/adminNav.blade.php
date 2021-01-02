
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <span ><img src="{{ asset('logos/collective_survey.png') }}"/></span>
            <h3 class="brand_logo">{{ config('app.name', 'Collective Survey') }}</h3>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
             
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="/admin" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/poll/create" class="nav-link">Create Poll</a>
                </li>
                <li class="nav-item">
                    <a href="/" class="nav-link">Start Survey</a>
                </li>
                <li class="nav-item">
                    <a href="/" class="nav-link">Schedule Meeting</a>
                </li>
            </ul>
            
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                
                <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            
                            <a class="dropdown-item" href="{{ route('admin.organization') }}">{{ __('My Organization') }}</a>
                            
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                </li>

            </ul>
        </div>
    </div>
</nav>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ route('pages.index') }}">
                <img src="{{ asset('assets/images/Logo-NoBG.png') }}" height="30px" />
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                @include('layouts.default.partials.nav', ['nav' => $navigation->app])
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @include('layouts.default.partials.nav', ['nav' => $navigation->user])

                @if (Auth::user())
                    <li class="dropdown profile-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            <img src="{{ Auth::user()->photo }}"
                                 width="38px" height="38px" title="{{ Auth::user()->name }}" />
                            <span class="visible-xs-inline-block">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('profile.view', [Auth::user()->username]) }}">Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('settings.account.index') }}">Settings</a>
                            </li>
                            <li class="divider" role="separator"></li>
                            <li>
                                <a href="{{ route('auth.logout') }}">Log out</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
            <form class="navbar-form navbar-right navbar-search dropdown" role="search">
                <input type="text" class="form-control" placeholder="Search...">
                <ul class="dropdown-menu search-results"></ul>
            </form>
        </div>
    </div>
</nav>
<!DOCTYPE html>
<html lang="{{ trans()->locale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if(isset($title)){{ $title }} |@endif Budget Manager - @lang("general.manage_your_budget")</title>

    <!-- Fonts -->
    {!! Html::style("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css") !!}

    <!-- Styles -->
    {!! Html::style("css/app.css") !!}
    {!! Html::style("css/general.css") !!}
    @yield("css")

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            "csrfToken" => csrf_token(),
        ]); ?>
    </script>

    <style type="text/css">
        .navbar-brand {
            padding: 0px;
        }
        .navbar-brand>img {
            height: 100%;
            padding: 15px;
            width: auto;
        }

        .navbar-brand {
            height: 80px;
        }
        .nav >li >a {
          padding-top: 30px;
          padding-bottom: 30px;
        }
        .navbar-toggle {
          padding: 10px;
          margin: 25px 15px 25px 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url("/") }}">
                    {{ HTML::image("img/logo.png", "Budget Manager") }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if(Auth::check())
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="{{ route("budget.index") }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                @lang("general.budget") <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown-header">@lang("general.list")</li>
                                <li><a href="{{ route("budget.index") }}"><i class="fa fa-list-ul" aria-hidden="true"></i> @lang("general.incomes_expenditures")</a></li>
                                <li><a href="{{ route("budget.list", 1) }}"><i class="fa fa-arrow-up" aria-hidden="true"></i> @lang("general.Incomes")</a></li>
                                <li><a href="{{ route("budget.list", 2) }}"><i class="fa fa-arrow-down" aria-hidden="true"></i> @lang("general.Expenditures")</a></li>
                                <li class="dropdown-header">@lang("general.actions")</li>
                                <li><a href="{{ route("budget.addform") }}"><i class="fa fa-plus" aria-hidden="true"></i> @lang("general.add")</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="{{ route("source.index") }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                @lang("general.sources") <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown-header">@lang("general.list")</li>
                                <li><a href="{{ route("source.index") }}"><i class="fa fa-list-ul" aria-hidden="true"></i> @lang("general.list_all")</a></li>
                                <li><a href="{{ route("source.index", 1) }}"><i class="fa fa-arrow-up" aria-hidden="true"></i> @lang("general.Incomes")</a></li>
                                <li><a href="{{ route("source.index", 2) }}"><i class="fa fa-arrow-down" aria-hidden="true"></i> @lang("general.Expenditures")</a></li>
                                <li><a href="{{ route("source.index", 0) }}"><i class="fa fa-question" aria-hidden="true"></i> @lang("general.untyped")</a></li>
                                <li class="dropdown-header">@lang("general.actions")</li>
                                <li><a href="{{ route("source.addform") }}"><i class="fa fa-plus" aria-hidden="true"></i> @lang("general.add")</a></li>
                            </ul>
                        </li>

                        <li><a href="{{ route("stats.index") }}">@lang("general.statistics") <i class="fa fa-pie-chart" aria-hidden="true"></i></a></li>
                    </ul>
                @endif

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-globe" aria-hidden="true"></i> @lang("general.language") <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route("lang.set", "en") }}">{{ HTML::image("img/en.png", "English") }} English</a></li>
                            <li><a href="{{ route("lang.set", "pl")}}">{{ HTML::image("img/pl.png", "Polski") }} Polski</a></li>
                        </ul>
                    </li>

                    <!-- Authentication Links -->
                    @if(Auth::guest())
                        <li><a href="{{ route("login") }}">@lang("auth.login")</a></li>
                        {{-- <li><a href="{{ url("/register") }}">@lang("auth.register")</a></li> --}}
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route("logout") }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        @lang("auth.logout")
                                    </a>

                                    <form id="logout-form" action="{{ route("logout") }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div id="ajax-loading">
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    </div>

    @yield("content")

    <!-- Scripts -->
    {!! Html::script("js/app.js") !!}
    @yield("js")
</body>
</html>

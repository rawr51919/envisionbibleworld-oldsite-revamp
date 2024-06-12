<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{ url('img/favicon.png') }}">
    <meta name="description" content="Envision Bible World">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Research | Heather Vincent</title>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    {{-- <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]> --}}
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    {{-- <![endif]--> --}}

    <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script>
    // CSRF protection
    $.ajaxSetup(
    {
        headers:
        {
            'X-CSRF-Token': $('input[name="_token"]').val()
        }
    });
    </script>

    {{--JQGRID--}}
    <link rel="stylesheet" type="text/css" media="screen" href="/css/jquery-ui.theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqgrid/5.8.7/css/ui.jqgrid.min.css" integrity="sha512-32LPQp8XpFZLhafWO1i/8MvAFIVzDCqJ1C1blA1FjbW210TWwe6olae8lIkZHFwJU1oaR481MDX4clGpGKZigg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/free-jqgrid-fork@4.15.11/js/i18n/grid.locale-en.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/free-jqgrid-fork"></script>
    {{--<!-- The link to the CSS that the grid needs -->--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqgrid/5.8.7/css/ui.jqgrid-bootstrap.min.css" integrity="sha512-ftn86mcT2Gh41u83MCyhkPN0+SRgGwD/NO1DFadxw55k47dpltba8gD1YAJnPANIY5gZqxQ2IozW5W+nO5Plfg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    $.jgrid.defaults.width = 780;
    $.jgrid.defaults.responsive = true;
    $.jgrid.defaults.styleUI = 'Bootstrap';
    </script>
    <!-- The jQuery library is a prerequisite for all jqSuite products -->
    <script type="text/ecmascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!--Links to Bootstrap and jqGrid CSS files-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel='stylesheet' type='text/css' href='https://code.jquery.com/ui/1.13.3/themes/redmond/jquery-ui.min.css' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/free-jqgrid-fork@4.15.11/css/ui.jqgrid.min.css">


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type='text/javascript' src='/js/jquery-ui-custom.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/free-jqgrid-fork@4.15.11/js/i18n/grid.locale-en.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/free-jqgrid-fork"></script>


    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Home</a>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/standard">Standard Entries</a></li>
                    <li><a href="#">Narrow Topical Search</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">List View <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/category">Category</a></li>
                            <li><a href="/subcategory">Subcategory</a></li>
                            <li class="divider"></li>
                            <li><a href="/era">Era</a></li>
                            <li><a href="/erayear">Era Year</a></li>
                            <li class="divider"></li>
                            <li><a href="/sourcetype">Source Type</a></li>
                            <li><a href="/source">Source</a></li>
                            <li><a href="/sourcequoted">Source Quoted</a></li>
                            <li class="divider"></li>
                            <li><a href="/summary">Summary</a></li>
                            <li class="divider"></li>
                            <li><a href="/quotation">Quotation</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>

                <div class="col-sm-3 col-md-3 pull-right">
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Word Search" name="Search Term" id="srch-term">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit" aria-label="Search"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
    {{--<div style="margin-left:20px;">--}}
    {{--@yield('content')--}}
    {{--</div>--}}

</body>
</html>

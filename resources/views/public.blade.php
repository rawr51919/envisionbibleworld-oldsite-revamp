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
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300&display=swap' rel='stylesheet' type='text/css'>

    {{-- <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" integrity="sha512-UDJtJXfzfsiPPgnI5S1000FPLBHMhvzAMX15I+qG2E2OAzC9P1JzUwJOfnypXiOH7MRPaqzhPbBGDNNj7zBfoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js" integrity="sha512-qWVvreMuH9i0DrugcOtifxdtZVBBL0X75r9YweXsdCHtXUidlctw7NXg5KVP3ITPtqZ2S575A0wFkvgS2anqSA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <![endif]--> --}}

    <!-- Scripts -->

    <!-- The jQuery library is a prerequisite for all jqSuite products -->
    <script type="text/ecmascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{--JQGRID--}}
    <link rel="stylesheet" type="text/css" media="screen" href="/css/jquery-ui.theme.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/free-jqgrid-fork@4.15.11/css/ui.jqgrid.min.css">
    <script src="https://cdn.jsdelivr.net/npm/free-jqgrid-fork@4.15.11/js/i18n/grid.locale-en.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/free-jqgrid-fork"></script>
    {{--<!-- The link to the CSS that the grid needs -->--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/free-jqgrid-fork@4.15.11/css/ui.jqgrid-bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    $.jgrid.defaults.width = 780;
    $.jgrid.defaults.responsive = true;
    $.jgrid.defaults.styleUI = 'Bootstrap';
    </script>

    <!--Link to datatables-->
    <link href="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.css" rel="stylesheet">



    <link href="{{ asset('/css/public.css') }}" rel="stylesheet">

    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<nav class="navbar navbar-custom">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span class="navbar-logo"><a class="navbar-brand" href="/public"><img src="/img/logo2_edited.webp" alt="Envision Bible World" width="210px" height="40px"></a></span>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Envision Bible World <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                        <li><a href="/">Envision Bible World</a></li>
                        <li class="divider"></li>
                        <li><a href="/lifestyles-jesus-time">Pictures: Life Styles of Jesus' Time</a></li>
                        <li class="divider"></li>
                    <li><a href="/old-new-testament-times">Pictures: Old and New Testament Times</a></li>
                        <li class="divider"></li>
                    <li><a href="/stories-about-jesus">Pictures: Stories About Jesus</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">About Me <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/about-me">About Me</a></li>
                        <li class="divider"></li>
                        <li><a href="/what-drove-my-ambition">What Drove My Ambition?</a></li>
                        <li class="divider"></li>
                        <li><a href="/what-drives-my-passion">What Drives My Passion?</a></li>
                        <li class="divider"></li>
                        <li><a href="/doctrinal-statement">Doctrinal Statement</a></li>
                    </ul>
                </li>
                 <li class="dropdown">
                    <a href="/aboutdatabase" class="dropdown-toggle" data-toggle="dropdown">About Database <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/about-database">About Database</a></li>
                        <li class="divider"></li>
                        <li><a href="/what-are-the-limits-for-this-database">What Are The Limits For This Database?</a></li>
                        <li class="divider"></li>
                        <li><a href="/locations">Locations</a></li>
                        <li class="divider"></li>
                        <li><a href="/sacrifices">Sacrifices</a></li>
                        <li class="divider"></li>
                        <li><a href="/publicstandard">Standard Entries</a></li>
                        <li class="divider"></li>
                        <li><a href="/categories">Category List</a></li>
                        <li class="divider"></li>
                        <li><a href="/eras">Era List</a></li>
                        <li class="divider"></li>
                        <li><a href="/sources">Source List</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/blog">Blog</a></li>
                                                <li class="divider"></li>
                        <li><a href="/contact-us">Contact Us</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Deals <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/deals">Deals</a></li>
                        <li class="divider"></li>
                        <li><a href="/products">Books - Information With Lots of Pictures</a></li>
                        <li class="divider"></li>
                        <li><a href="/books-biblical-fiction">Books - Biblical Fiction</a></li>
                        <li class="divider"></li>
                        <li><a href="/books-like-study-learn-lots">Books - For Those Who Like to Study and Learn Lots</a></li>
                        <li class="divider"></li>
                        <li><a href="/documentaries">Documentaries</a></li>
                        <li class="divider"></li>
                        <li><a href="/services">Services</a></li>
                        <li class="divider"></li>
                    </ul>
                </li>
            </ul>

            <div class="col-sm-3 col-md-3 pull-right">
                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="Search Term" id="srch-term">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit" aria-label="Search"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>

{{--<div class="background-container">--}}
    {{--@yield('background')--}}
{{--</div>--}}

<div class="container">
    @yield('content')
</div>
{{--<div style="margin-left:20px;">--}}
{{--@yield('content')--}}
{{--</div>--}}

<!-- DataTables -->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

</body>
</html>

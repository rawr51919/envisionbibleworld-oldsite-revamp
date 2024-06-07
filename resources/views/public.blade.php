<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Research | Heather Vincent</title>

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->


    {{--JQGRID--}}
    {{--<link rel="stylesheet" type="text/css" media="screen" href="/css/jquery-ui.theme.css" />--}}
    {{--<link rel="stylesheet" type="text/css" media="screen" href="/css/ui.jqgrid.css" />--}}
    {{--<script src="/js/grid.locale-en.js" type="text/javascript"></script>--}}
    {{--<script src="/js/jquery.jqGrid.min.js" type="text/javascript"></script>--}}
    {{--<!-- The link to the CSS that the grid needs -->--}}
    {{--<link rel="stylesheet" type="text/css" media="screen" href="/css/ui.jqgrid-bootstrap.css" />--}}
    {{--<link rel="stylesheet" type="text/css" media="screen" href="../../../css/trirand/ui.jqgrid-bootstrap.css" />--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>--}}
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">--}}
    {{--<script type="text/ecmascript" src="../../../js/bootstrap-datepicker.js"></script>--}}
    {{--<script type="text/ecmascript" src="../../../js/bootstrap3-typeahead.js"></script>--}}
    {{--<link rel="stylesheet" type="text/css" media="screen" href="../../../css/bootstrap-datepicker.css" />--}}
    {{--<script>--}}
    {{--$.jgrid.defaults.width = 780;--}}
    {{--$.jgrid.defaults.responsive = true;--}}
    {{--$.jgrid.defaults.styleUI = 'Bootstrap';--}}
    {{--</script>--}}
    <!-- The jQuery library is a prerequisite for all jqSuite products -->
    {{--<script type="text/ecmascript" src="../../../js/jquery.min.js"></script>--}}

    <!--Link to datatables-->
    {{--<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

    <!-- A link to a Boostrap  and jqGrid Bootstrap CSS siles-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel='stylesheet' type='text/css' href='http://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css' />
    <link rel='stylesheet' type='text/css' href='http://www.trirand.com/blog/jqgrid/themes/ui.jqgrid.css' />

    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script type='text/javascript' src='http://www.trirand.com/blog/jqgrid/js/jquery-ui-custom.min.js'></script>
    <script type='text/javascript' src='http://www.trirand.com/blog/jqgrid/js/i18n/grid.locale-en.js'></script>
    <script type='text/javascript' src='http://www.trirand.com/blog/jqgrid/js/jquery.jqGrid.js'></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>


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
            <span class="navbar-logo"><a class="navbar-brand" href="/public"><img src="/img/logo2_edited.png" alt="Envision Bible World"></a></span>
            {{--<a class="navbar-brand" href="/public">Home</a>--}}
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Envision Bible World <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                        <li><a href="http://envisionbibleworld.com/">Envision Bible World</a></li>
                        <li class="divider"></li>
                        <li><a href="http://envisionbibleworld.com/lifestyles-jesus-time/">Pictures: Life Styles of Jesus' Time</a></li>
                        <li class="divider"></li>
                    <li><a href="http://envisionbibleworld.com/old-new-testament-times/">Pictures: Old and New Testament Times</a></li>
                        <li class="divider"></li>
                    <li><a href="http://envisionbibleworld.com/stories-about-jesus/">Pictures: Stories About Jesus</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">About Me <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://envisionbibleworld.com/about-me/">About Me</a></li>
                        <li class="divider"></li>
                        <li><a href="http://envisionbibleworld.com/what-drove-my-ambition/">What Drove My Ambition?</a></li>
                        <li class="divider"></li>
                        <li><a href="http://envisionbibleworld.com/what-drives-my-passion/">What Drives My Passion?</a></li>
                        <li class="divider"></li>
                        <li><a href="http://envisionbibleworld.com/doctrinal-statement/">Doctrinal Statement</a></li>
                    </ul>
                </li>
                 <li class="dropdown">
                    <a href="/aboutdatabase" class="dropdown-toggle" data-toggle="dropdown">About Database <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://envisionbibleworld.com/about-database/">About Database</a></li>
                        <li class="divider"></li>
                        <li><a href="http://envisionbibleworld.com/what-are-the-limits-for-this-database/">What Are The Limits For This Database?</a></li>
                        <li class="divider"></li>
                        <li><a href="http://envisionbibleworld.com/locations/">Locations</a></li>
                        <li class="divider"></li>
                        <li><a href="http://envisionbibleworld.com/sacrifices/">Sacrifices</a></li>
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
                        <li><a href="http://envisionbibleworld.com/blog/">Blog</a></li>
                                                <li class="divider"></li>
                        <li><a href="http://envisionbibleworld.com/contact-us/">Contact Us</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Deals <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://envisionbibleworld.com/deals/">Deals</a></li>
                        <li class="divider"></li>
                        <li><a href="http://envisionbibleworld.com/products/">Books - Information With Lots of Pictures</a></li>
                        <li class="divider"></li>
                        <li><a href="http://envisionbibleworld.com/books-biblical-fiction/">Books - Biblical Fiction</a></li>
                        <li class="divider"></li>
                        <li><a href="http://envisionbibleworld.com/books-like-study-learn-lots/">Books - For Those Who Like to Study and Learn Lots</a></li>
                        <li class="divider"></li>
                        <li><a href="http://envisionbibleworld.com/documentaries/">Documentaries</a></li>
                        <li class="divider"></li>
                        <li><a href="http://envisionbibleworld.com/services/">Services</a></li>
                        <li class="divider"></li>
                    </ul>
                </li>
            </ul>

            <div class="col-sm-3 col-md-3 pull-right">
                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
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
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

</body>
</html>

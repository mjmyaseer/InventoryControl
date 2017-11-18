<!DOCTYPE html>
<html>
<head>
    <title>Mobile Planet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{env('URL_BASE')}}/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="{{env('URL_BASE')}}/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!-- styles -->
    <link href="{{env('URL_BASE')}}/css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-bg">
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Logo -->
                <div class="logo">
                    <h1><a href="/">Mobile Planet</a></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content container">
        @yield("content")
</div>



<!-- /. WRAPPER  -->
<!-- JQUERY SCRIPTS -->
<script src="{{env('URL_BASE')}}/vendor/jquery/dist/jquery.min.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="{{env('URL_BASE')}}/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{env('URL_BASE')}}/js/custom.js"></script>
<script src="{{env('URL_BASE')}}/js/app/session.js"></script>

@yield('js')
</body>
</html>
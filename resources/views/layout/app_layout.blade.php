<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Mobile Planet</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="{{env('URL_BASE')}}/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- FONTAWESOME STYLES-->
    <link href="{{env('URL_BASE')}}/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- CUSTOM STYLES-->
    <link href="{{env('URL_BASE')}}/css/styles.css" rel="stylesheet"/>
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css'
          rel='stylesheet' type='text/css'/>
</head>
<body>

@include("includes.header_nav")

<div class="page-content">
    <div class="row">
        <div class="col-md-2">
            @include("includes.side_nav")
        </div>

        <div class="col-md-10">
            @include('flash::message')

            @yield("content")
        </div>

    </div>
</div>


<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="{{env('URL_BASE')}}/vendor/jquery/dist/jquery.min.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="{{env('URL_BASE')}}/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="{{env('URL_BASE')}}/js/custom.js"></script>
<script src="{{env('URL_BASE')}}/js/app/session.js"></script>
<script>
    $('div.alert').not('.alert-important').delay(3000).slideUp(400);
    $('#flash-overlay-modal').modal();
</script>
@yield('js')

</body>
</html>

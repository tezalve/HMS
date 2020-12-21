<!DOCTYPE html>
<html lang="en">

<head>
    <script src="/js/jquery.js"></script>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="/css/plugins/timeline.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="/css/plugins/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="/css/jquery.dataTables.css">
    <link href="/css/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/screen.css">
    <link rel="stylesheet" href="/css/select2.css">
    <!-- <link type="text/css" href="/css/custom.css"> -->

    <!-- Custom CSS -->
    <link href="/css/sb-admin-2.css" rel="stylesheet">

    <style type="text/css">
        input[type=text]:focus, textarea:focus, select:focus
        {
            background-color: #CBF1F3;
            border: 1px solid #ccc;
        }
    </style>

    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    
    
    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/js/plugins/metisMenu/metisMenu.min.js"></script>

    <script type="text/javascript" language="javascript" src="/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="/js/jquery.validation.tooltip.js"></script>
    <script type="text/javascript" language="javascript" src="/js/jquery.validate.min.js"></script>
    <script src="/js/jquery-ui.js"></script>

    <script src="/js/select2.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/js/sb-admin-2.js"></script>
    @yield('includes')
</head>

<body>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p></p>
        </div>
    @endif
    
    @yield('content')
</body>

</html>
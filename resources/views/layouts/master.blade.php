<!DOCTYPE html>
<html lang="en">

<head>
    <!-- CSRF token mismatch in Ajax calls -->
    <meta name="csrf-token" content="{{ csrf_token() }}" /> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- <title>Hospital Management System</title> -->
    <title>8 HMS 8</title>
    <script src="/js/jquery.js"></script>
    <!-- Bootstrap Core CSS -->


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

    @yield('includes')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><i class="fa fa-h-square fa-2x"></i>MS</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

<!-- ssss -->

            <div class="navbar-default sidebar" role="navigation">

                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
<!--                             <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                             //input-group --> 
                        </li>
                        <li>
                            <a href="/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ route('patients.index') }}"><i class="fa fa-dashboard fa-fw"></i> Patient</a>
                        </li>                        
                         <!-- <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Patient Registration<span class="fa arrow"></span></a>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Patient Information<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="">Create Patient</a>
                                </li>
                            </ul>
                        </li> -->

                        <li>
                            <a href=""><i class="fa fa-bar-chart-o fa-fw"></i>Diagnostic<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('invoices.index') }}">Invoice</a>
                                </li>
                                <li>                                
                                    <a href="{{ route('invoicelists.index') }}">Invoice List</a>
                                </li>
<!--                                 <li>
                                    <a href="">List Of Due Invoice</a>
                                </li>                                 -->
                                <li>
                                    <a href="{{ route('diagnosticreports.index') }}">Diagnostic Report</a>
                                </li>                                 
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Lab Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('barcodeprints.index') }}">Barcode Print</a>
                                </li>

                                <li>
                                    <a href="{{ route('labreports.index') }}">Generate Lab Report</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i>Master Setup<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::route('doctors.index')}}">Doctor Registration </a>
                                </li>
                                <li>
                                    <a href="{{ URL::route('investigations.index') }}">Investigation Registration</a>
                                </li>

                                <li>
                                    <a href="{{ route('labreportcharts.index') }}">Lab Report Chart</a>
                                </li>
                                                                
                                <li>
                                    <a href="{{URL::route('beds.index')}}">Bed Information</a>
                                </li>
                                <li>
                                    <a href="{{URL::route('clinicalcharts.index')}}">Clinical Chart Registration</a>
                                </li>                                
<!--                                 <li>
                                    <a href="">Lab Report Chart</a>
                                </li -->                               
                            </ul>
                            <!-- /.nav-second-level-->
                        </li> 


                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                
                <!-- /.col-lg-12 -->
            </div>
            <div class="col-lg-12">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Error!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                  
                @yield('content')

            </div>
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    
    
    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/js/plugins/metisMenu/metisMenu.min.js"></script>

    <script type="text/javascript" language="javascript" src="/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="/js/jquery.validation.tooltip.js"></script>
    <script type="text/javascript" language="javascript" src="/js/jquery.validate.min.js"></script>
    <script src="/js/jquery-ui.js"></script>

    <script src="/js/select2.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/js/sb-admin-2.js"></script>
    @yield('scripts')


</body>

</html>

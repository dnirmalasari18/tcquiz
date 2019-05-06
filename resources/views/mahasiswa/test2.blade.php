
@section('breadcrumbs')
<li><a href="#">Dashboard</a></li>
<li><a href="#">Quizzes</a></li>
<li class="active">PBKK</li>
@endsection



<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TCQUIZ</title>
    <meta name="description" content="TCQUIZ">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{asset('dashboard/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/vendors/themify-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/vendors/selectFX/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/vendors/jqvmap/dist/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/vendors/selectFX/css/cs-skin-elastic.css')}}">


    <link rel="stylesheet" href="{{asset('dashboard/assets/css/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel toggled">
        <nav class="navbar navbar-expand-sm navbar-default" >

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./">TCQUIZ</a>
                <a class="navbar-brand hidden" href="./"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse" >
                <ul class="nav navbar-nav">
                    <li class="@yield('dashboard')">
                        <a href="/mahasiswa"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Users</h3><!-- /.menu-title -->
                    <li class="@yield('classes')">
                        <a href="/mahasiswa/kelas"> <i class="menu-icon fa fa-book"></i>My Classes </a>
                    </li>
                    <li class="@yield('quiz')">
                        <a href="/mahasiswa/quizzes"> <i class="menu-icon fa fa-file-text"></i>Quizzes </a>
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                </div>

                <div>
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            <div style="padding: 10px;">
                                {{ Auth::user()->name}} {{ Auth::user()->username}} <i class="fa fa-sort-desc"></i>
                            </div>
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-cog"></i>Change Password</a>
                            <a class="nav-link" href="#" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        @yield('title')
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            @yield('breadcrumbs')
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
        
<div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Soal 14</strong>
            <strong class="card-title" style="float: right; margin-bottom: 0;">Flag</strong>
            <label class="switch switch-3d switch-warning mr-3" style="float: right; margin-bottom: 0;"><input type="checkbox" class="switch-input" checked="false"> <span class="switch-label"></span> <span class="switch-handle"></span></label>
        </div>
        <div class="card-body">
            Are you on the hunt for a free general knowledge quiz for your pub, party, social or school group? Look no further! The following quiz questions are suitable for all age groups and range from easy to profoundly thought-provoking, covering a wide range of topics so everyone can join in the fun.
        </div>
        <div class="card-body">
            <div style="margin-bottom: 10px;"><strong>Jawaban</strong></div>
            <div class="form-check">
                <div class="radio">
                  <label for="radio1" class="form-check-label ">
                    <input type="radio" id="radio1" name="radios" value="option1" class="form-check-input">
                    Option 1
                  </label>
                </div>
                <div class="radio">
                  <label for="radio2" class="form-check-label ">
                    <input type="radio" id="radio2" name="radios" value="option2" class="form-check-input">Option 2
                  </label>
                </div>
                <div class="radio">
                  <label for="radio3" class="form-check-label ">
                    <input type="radio" id="radio3" name="radios" value="option3" class="form-check-input">Option 3
                  </label>
                </div>
                <div class="radio">
                  <label for="radio3" class="form-check-label ">
                    <input type="radio" id="radio3" name="radios" value="option3" class="form-check-input">Option 4
                  </label>
                </div>
                <div class="radio">
                  <label for="radio3" class="form-check-label ">
                    <input type="radio" id="radio3" name="radios" value="option3" class="form-check-input">Option 5
                  </label>
                </div>
              </div>
        </div>
        <div class="card-header" style="border-top: 1px solid rgba(0,0,0,.125);">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" style="width: 70px;">Previous</button>
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" style="float: right; width: 70px;">Next</button>
        </div>
    </div>
</div>
<div class="col-md-3">
    <style type="text/css">
        .card{
            margin-bottom: 0;
        }
        .card-soal{
            margin-bottom: 20px;
        }
        .soal{
            padding-bottom: 0px;
        }
        .row{
            font-size: 10px;
            padding-right: 15px;
            margin-bottom: 15px;
        }
        .col{
            padding-right: 0;
            max-width: 20%;
        }
        .card-body .text-secondary{
            padding: 6px 6px;
        }
        .soal-aktif{
            background-color: #f2f2f2;
        }
        .soal-ragu{
            background-color: #ffc107;
        }
        .soal-ragu-aktif{
            background-color: #ffc107;
            color: white !important;
        }
    </style>
    <div class="card card-soal">
        <div class="card-header" align="center">
            <strong class="card-title">Daftar Soal</strong>
        </div>
        <div class="card-body soal">
            <div class="row">
                <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">1</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">2</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">3</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">4</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">5</div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">6</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">7</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">8</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">9</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">10</div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">11</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">12</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">13</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary soal-ragu-aktif" align="center">14</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">15</div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">16</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">17</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary soal-ragu" align="center">18</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">19</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">20</div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">21</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">22</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">23</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">24</div>
                    </section>
                </div>
                 <div class="col">
                    <section class="card">
                        <div class="card-body text-secondary" align="center">25</div>
                    </section>
                </div>
            </div>
        </div>                
    </div>
</div>


        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="{{asset('dashboard/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/main.js')}}"></script>


    <script src="{{asset('dashboard/vendors/chart.js/dist/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/dashboard.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/widgets.js')}}"></script>
    <script src="{{asset('dashboard/vendors/jqvmap/dist/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <script src="{{asset('dashboard/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>

    <script src="{{asset('dashboard/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('dashboard/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('dashboard/vendors/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/init-scripts/data-table/datatables-init.js')}}"></script>
    <script src="{{asset('tinymce/js/tinymce/tinymce.js')}}"></script>

    <script>
    $("#menuToggle").click(function(e) {
        e.preventDefault();
        $("#left-panel").toggleClass("toggled");
    });

        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

</body>

</html>

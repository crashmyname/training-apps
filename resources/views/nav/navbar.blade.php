<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @switch ($title)
                @case ('Dashborad')
                    Dashboard
                    @break
                @case ('Master Training')
                    Master Training
                    @break
                @case ('Master User')
                    Master User
                    @break
                @case ('Master Score')
                    Master Score
                    @break
                @case ('Data Training')
                    Data Training
                    @break
                @case ('Form Add Participants')
                    Form Add Participants
                    @break
                @case ('View Participants')
                    View Participants
                    @break
                @case ('Employee')
                    Employee
                    @break
                @case ('Training Assessment')
                    Training Assessment
                    @break
                @case ('Schedule Training')
                    Schedule Training
                    @break
                @case ('Final Score')
                    Final Score
                    @break
                @default
                    Dashboard
                    @break
            @endswitch
            - Training System
    </title>
    
    <link rel="stylesheet" href="{{asset('voler/dist/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('voler/dist/assets/vendors/chartjs/Chart.min.css')}}">
    <link rel="stylesheet" href="{{asset('voler/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('voler/dist/assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('voler/dist/assets/vendors/choices.js/choices.min.css')}}">
    <link href="{{ asset('bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/datatable/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('/datatable/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('/datatable/responsive.bootstrap5.min.css')}}">
    <link rel="shortcut icon" href="{{asset('img/ise.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="{{asset('/datatable/jquery-3.7.0.js')}}"></script>
</head>
<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <a href="{{route('dashboard')}}"><img src="{{asset('img/ise.png')}}" alt="" srcset=""></a>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
                <li class='sidebar-title'>Main Menu</li>
                @if($title == "Dashboard")
                <li class="sidebar-item active ">
                    <a href="{{route('dashboard')}}" class='sidebar-link'>
                        <i class="bi bi-house-heart-fill"></i> 
                        <span>Dashboard</span>
                    </a>   
                </li>
                @else
                <li class="sidebar-item">
                    <a href="{{route('dashboard')}}" class='sidebar-link'>
                        <i class="bi bi-house-heart-fill"></i> 
                        <span>Dashboard</span>
                    </a>   
                </li>
                @endif
                @if (!auth()->check() || auth()->user()->role == 'Administrator')
                @if($title == "Master Training" || $title == "Master User" || $title == "Master Score" || $title == "Employee")
                <li class="sidebar-item  has-sub active">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-house-gear-fill"></i> 
                        <span>Master Data</span>
                    </a>
                    <ul class="submenu active">                        
                        <li>
                            <a href="{{route('training')}}">Data Training</a>
                        </li>
                        <li>
                            <a href="{{route('user')}}">Data User</a>
                        </li>                        
                        <li>
                            <a href="{{route('score')}}">Data Score</a>
                        </li>  
                        <li>
                            <a href="{{route('employee')}}">Employee</a>
                        </li>                                            
                    </ul>                 
                </li>
                @else
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-house-gear-fill"></i> 
                        <span>Master Data</span>
                    </a>
                    <ul class="submenu">                        
                        <li>
                            <a href="{{route('training')}}">Data Training</a>
                        </li>
                        <li>
                            <a href="{{route('user')}}">Data User</a>
                        </li>                        
                        <li>
                            <a href="{{route('score')}}">Data Score</a>
                        </li>                                             
                        <li>
                            <a href="{{route('employee')}}">Employee</a>
                        </li>                                             
                    </ul>                 
                </li>
                @endif                    
                @else
                    
                @endif
                @if($title == "Data Training")
                <li class="sidebar-item active ">
                    <a href="{{route('data-training')}}" class='sidebar-link'>
                        <i class="bi bi-journal-bookmark-fill" width="20"></i> 
                        <span>Training</span>
                    </a>                    
                </li>
                @else
                <li class="sidebar-item  ">
                    <a href="{{route('data-training')}}" class='sidebar-link'>
                        <i class="bi bi-journal-bookmark-fill" width="20"></i> 
                        <span>Training</span>
                    </a>                    
                </li>
                @endif
                @if($title == "Schedule Training")
                <li class="sidebar-item active ">
                    <a href="{{route('schedule')}}" class='sidebar-link'>
                        <i class="bi bi-journal-richtext"></i> 
                        <span>Schedule Training</span>
                    </a>                    
                </li>
                @else
                <li class="sidebar-item  ">
                    <a href="{{route('schedule')}}" class='sidebar-link'>
                        <i class="bi bi-journal-richtext"></i> 
                        <span>Schedule Training</span>
                    </a>                    
                </li>
                @endif
                @if($title == "Training Assessment")
                <li class="sidebar-item active ">
                    <a href="{{route('nilai-training')}}" class='sidebar-link'>
                        <i class="bi bi-award"></i> 
                        <span>Training Assessment</span>
                    </a>                    
                </li>
                @else
                <li class="sidebar-item  ">
                    <a href="{{route('nilai-training')}}" class='sidebar-link'>
                        <i class="bi bi-award"></i> 
                        <span>Training Assessment</span>
                    </a>                    
                </li>
                @endif
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown nav-icon">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                                <div class="d-lg-inline-block">
                                    <i data-feather="bell"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-large">
                                <h6 class='py-2 px-4'>Notifications</h6>
                                <ul class="list-group rounded-none">
                                    <li class="list-group-item border-0 align-items-start">
                                        <div class="avatar bg-success me-3">
                                            <span class="avatar-content"><i class="bi bi-envelope-exclamation mb-2"></i></span>
                                        </div>
                                        <div>
                                            <h6 class='text-bold'>No Notifications</h6>
                                            <p class='text-xs'>
                                                
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="{{asset('storage/profil-user/'.auth()->user()->foto)}}" alt="" srcset="">
                                    <span class="avatar-status bg-success"></span>
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">Hi, {{auth()->user()->name}}</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                                {{-- <a class="dropdown-item" href="#"><i data-feather="mail"></i> Messages</a> --}}
                                <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item active" href="#" id="buttonLogout"><i data-feather="log-out"></i> Logout</a>
                                <form id="logoutForm" action="{{route('logout')}}" method="post">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            @yield('content')
        </div>
        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2023 &copy; Training Apps</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a target="_blank" href="https://www.instagram.com/fadliazkaprayogi">Fadli</a></p>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="{{asset('voler/dist/assets/js/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('voler/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('voler/dist/assets/js/app.js')}}"></script>

<script src="{{asset('voler/dist/assets/vendors/chartjs/Chart.min.js')}}"></script>
<script src="{{asset('voler/dist/assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('voler/dist/assets/js/pages/dashboard.js')}}"></script>

<script src="{{asset('voler/dist/assets/js/main.js')}}"></script>
<script src="{{asset('voler/dist/assets/vendors/choices.js/choices.min.js')}}"></script>

{{-- Datatable --}}
{{-- <script src="{{asset('/datatable/jquery-3.7.0.js')}}"></script> --}}
<script src="{{asset('/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/datatable/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/datatable/buttons.bootstrap5.min.js')}}"></script>
<script src="{{asset('/datatable/buttons.flash.min.js')}}"></script>
<script src="{{asset('/datatable/jszip.min.js')}}"></script>
<script src="{{asset('/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('/datatable/vfs_fonts.js')}}"></script>
<script src="{{asset('/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('/datatable/buttons.colVis.min.js')}}"></script>
<script src="{{asset('/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/datatable/responsive.bootstrap5.min.js')}}"></script>
<script src="{{asset('/datatable/dataTables.select.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
    document.getElementById('buttonLogout').addEventListener('click', function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Logout',
            text: 'Are you sure want Logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Logout!',
        }).then((result)=>{
            if(result.isConfirmed){
                document.forms['logoutForm'].submit();
            }
        })
    })
</script>
</body>
</html>
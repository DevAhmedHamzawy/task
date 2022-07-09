<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.1.3/css/bootstrap.min.css" integrity="sha384-Jt6Tol1A2P9JBesGeCxNrxkmRFSjWCBW1Af7CSQSKsfMVQCqnUVWhZzG0puJMCK6" crossorigin="anonymous">    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('panel/panel/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" defer></script>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  

    
    <title>{{-- $settings->name --}} - لوحة التحكم</title>
    @yield('header')
</head>
<body>
  <nav class="navbar navbar-expand-lg fixed-top">

    <a class="navbar-brand" href="#"><img src="{{ asset('admin/panel/img/logo.png') }}" width="130" height="65" style="margin-right: 0.9em;" /></a>


    <button class="navbar-toggler sideMenuToggler" type="button" >
      <i class="fa fa-bars" style="color:#000; font-size:28px;"></i>
    </button> 
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto" >

        <li class="">

            <a class=" "  style="margin-top:1px;" id="navbarDropdownMenuLink"  aria-haspopup="true" aria-expanded="false">
               <span class="hidden-xs">{{-- Auth::user()->user_name --}}</span>
              <img src="{{-- Auth::user()->img_path --}}" width="45" height="45" class="user-image" >
             
            </a>
            <div class="dropdown-menu" id="actions" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  تسجيل الخروج
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>             
            </div>
        </li>
        
         <li class="nav-item ">
              <a class="dropdown-item" href="{{-- route('admin.logout') --}}" style="margin-top:5px;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   <span class="fa fa-sign-out" style="color:#000;"></span>
                   
                  تسجيل الخروج

              </a>

         </li>
        </ul>
          </div>
        </li>
    
      </ul>
    </div>
    <button class="navbar-toggler admin-collapse" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fa fa-bars" style="color:#000; font-size:28px;"></i>
    </button>



    <div class="user-menu-mobile nav-item text-left">

      <img src="{{-- Auth::user()->image --}}" class="user-image" >
      <span>{{-- Auth::user()->user_name --}}</span>
      |
      <a  href="{{-- route('admin.logout') --}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out" style="color:#000;"></i>
      </a>
      <form id="logout-form" action="{{-- route('admin.logout') --}}" method="POST" style="display: none;">
          @csrf
      </form>           

    </div>
      




    
    
</nav>

    <div class="wrapper d-flex">
        <div class="sideMenu bg-mattBlackLight" style="font-size: 18px;">
            <div class="sidebar">
                <ul class="navbar-nav">

                
                  @can('admin')
  

                  <li class="nav-item"><a href="{{ url('dashboard') }}" class="nav-link px-2"><i class="material-icons icon">dashboard</i><span class="text">لوحة التحكم </span></a></li>
                  <li class="nav-item"><a href="{{ url('invoices') }}" class="nav-link px-2"><i class="material-icons icon">dashboard</i><span class="text">الفواتير</span></a></li>

                 


                  @endcan


                  @canany(['save', 'details', 'show']) 
                  <li class="nav-item"><a href="{{ url('invoices') }}" class="nav-link px-2"><i class="material-icons icon">dashboard</i><span class="text">الفواتير</span></a></li>
                  @endcanany

                 
                </ul>
            </div>
        </div>
    


    <div class="content">
        <main>


          @if ($errors->any())
              @foreach ($errors->all() as $error)
                  <div class="alert alert-danger">{{$error}}</div>
              @endforeach
          @endif
           
            @yield('content')
                        
        </main>
    </div>

   

</body>


<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<script src="{{ asset('panel/panel/js/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
 <script>
  if($(".sideMenuToggler:first").css('display')!='none' ) {
        $('.wrapper').addClass('active');
    }
</script>


@yield('footer')
</html>
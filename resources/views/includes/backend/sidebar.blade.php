 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-wrench"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Montir</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>


    @if (Auth::user()->role == 'admin')
        @php
            $montir = App\Models\User::where('accept_by_admin', 0)->whereHas('sertifikat')->count();
        @endphp
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Manage Users </span> <span class="text-warning bg-dark p-1" style="font-weight: bold;">{{$montir}}</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{route('user.index')}}">Pengguna</a>
                    <a class="collapse-item" href="{{route('user.onlyTrashed')}}">Pengguna Nonaktif</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <!-- <li class="nav-item">            <a class="nav-link" href="{{route('kategori.index')}}">
                <i class="fas fa-list"></i>
                <span>Kategori Montir</span>
            </a>
        </li> -->
    @elseif(Auth::user()->role == 'montir')
         <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('user.show',Auth::user()->id)}}">
                    <i class="fas fa-wrench"></i>
                    <span>Montir</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('complain.index')}}">
                    <i class="fas fa-comments"></i>
                    <span>Data komplain</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('portfolio.index')}}">
                    <i class="fas fa-briefcase"></i>
                    <span>Portfolio</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('sertifikat.index')}}">
                    <i class="fas fa-certificate"></i>
                    <span>Sertifikat</span>
                </a>
            </li>
            <!-- code booking masuk -->
            @php
                $booking = App\Models\Booking::where('montir_id', Auth::user()->id)->where('status','menunggu')->count();
            @endphp
            <!-- end code -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('booking.index')}}">
                    <i class="fas fa-motorcycle"></i>
                    <span>Pesanan masuk  </span> <span class="text-warning bg-dark p-1" style="font-weight: bold;">{{$booking}}</span>
                </a>
            </li>
    @else
    <li class="nav-item">
        <a class="nav-link" href="{{route('user.show',Auth::user()->id)}}">
            <i class="fas fa-user"></i>
            <span>Set profile</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('booking.customer')}}">
            <i class="fas fa-list"></i>
            <span>Pemesanan</span>
        </a>
    </li> 
    <li class="nav-item">
        <a class="nav-link" href="{{route('user.review')}}">
            <i class="fas fa-comments"></i>
            <span>Penilaian montir</span>
        </a>
    </li>   
    @endif
     

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
        <a class="nav-link" href="{{url('/')}}">
            <i class="fas fa-home"></i>
            <span>Kembali ke home</span>
        </a>
    </li> 


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
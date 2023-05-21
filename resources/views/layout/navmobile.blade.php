<nav class="navbar navbar-expand-lg navbar-dark sticky-bottom navbarmenumobile">
  <div class="container d-block">
    <div class="menu-wrap d-md-block col-md-12 col-xl-12" style="padding : 15px;">
        <div class="d-flex justify-content-between align-items-center">
            <div class="list-menu d-flex justify-content-between align-items-center">
                <a href="{{ url('/employee') }}" class="nav-link {{ active_class(['employee']) }} text-center">
                    <i class="link-icon" data-feather="home"></i>
                    <p>Beranda</p>
                </a>
            </div>
            <div class="list-menu d-flex justify-content-between align-items-center">
                <a href="{{ url('/mylogs') }}" class="notifikasi nav-link {{ active_class(['mylogs']) }} text-center">
                    <i class="link-icon" data-feather="calendar"></i><br>
                    <p>Log Absen</p>
                </a>
            </div>
            <div class="list-menu d-flex justify-content-between align-items-center">
                <a href="{{ url('/myslip') }}" class="notifikasi text-center nav-link {{ active_class(['myslip']) }}">
                    <i class="link-icon" data-feather="file-text"></i>
                    <p>Payslip</p>
                </a>
            </div>
            <div class="list-menu d-flex justify-content-between align-items-center">
                <a href="{{ url('/myprofile') }}" class="text-center nav-link {{ active_class(['myprofile']) }}">
                    <i class="link-icon" data-feather="user"></i>
                    <p>Profile</p>
                </a>
            </div>
        </div>
    </div> 
  </div>
</nav>
<!-- ======= Header ======= -->
 <style>
  #header {
  background-color: #1f1f1f;
  color: #e0e0e0;
  padding: 0.5rem 1rem;
  box-shadow: 0 2px 8px rgba(0,0,0,0.7);
}

#header .nav-profile span {
  color: #e0e0e0;
}

#header .nav-profile a {
  color: #00b894;
  text-decoration: none;
  margin-left: 0.5rem;
  font-weight: 600;
}

#header .nav-profile a:hover {
  text-decoration: underline;
}


 </style>
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="assets/img/logo.png" alt="">
      <span class="d-none d-lg-block" style="color:white">PPKD Resto</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn" style="color:white"></i>
  </div>

  <nav class="header-nav ms-auto">
    <div class="nav-link nav-profile d-flex align-items-center pe-3">
      {{-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> --}}
      <span class=" d-block">
        @if(auth()->check())
        Hi, {{ auth()->user()->name }}
        <a href="/logout" class="ms-2" >
          Keluar
        </a>
        @else
        Guest
        @endif
      </span>
    </div>
  </nav>
 

</header><!-- End Header -->
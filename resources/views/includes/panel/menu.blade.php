<!-- Form -->
<form class="mt-4 mb-3 d-md-none">
  <div class="input-group input-group-rounded input-group-merge">
    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
    <div class="input-group-prepend">
      <div class="input-group-text">
        <span class="fa fa-search"></span>
      </div>
    </div>
  </div>
</form>
<!-- Heading -->
<h6 class="navbar-heading text-muted">Manage data</h6>
<!-- Navigation -->
<ul class="navbar-nav">
  <li class="nav-item  class=" active" ">
  <a class=" nav-link active " href="{{ url('/home') }}"> <i class="ni ni-tv-2 text-primary"></i> Dashboard
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="#">
      <i class="ni ni-planet text-blue"></i> Specialties
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="#">
      <i class="ni ni-pin-3 text-orange"></i> Doctors
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link " href="#">
      <i class="ni ni-bullet-list-67 text-red"></i> Patients
    </a>
  </li>  
  <li class="nav-item">
    <a class="nav-link " href="#">
      <i class="ni ni-single-02 text-yellow"></i> User profile
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
      <i class="ni ni-key-25 text-info"></i> Logout
    </a>
    <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
      @csrf
    </form>
  </li>
</ul>
<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading text-muted">Reports</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
  <li class="nav-item">
    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
      <i class="ni ni-palette text-red"></i> Appointments frequency
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
      <i class="ni ni-spaceship text-yellow"></i> Most active doctors
    </a>
  </li>
</ul>
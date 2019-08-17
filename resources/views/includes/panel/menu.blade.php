{{-- Form --}}
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
{{-- Heading --}}
@if (auth()->user()->role == 'admin')
  <h6 class="navbar-heading text-muted">Manage data</h6>
@else
  <h6 class="navbar-heading text-muted">Options</h6>
@endif
{{-- Navigation --}}
<ul class="navbar-nav">
  @if (auth()->user()->role == 'admin')
    {{-- Menú admin --}}
      <li class="nav-item active" >
        <a class=" nav-link active " href="{{ url('/home') }}">
          <i class="ni ni-tv-2 text-primary"></i> Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{ url('/specialties') }}">
          <i class="ni ni-palette text-blue"></i> Specialties
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{ url('/doctors') }}">
          <i class="ni ni-hat-3 text-orange"></i> Doctors
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{ url('/patients') }}">
          <i class="ni ni-bullet-list-67 text-red"></i> Patients
        </a>
      </li>     
    {{-- End Menú admin --}}
  @elseif (auth()->user()->role == 'doctor')
    {{-- Menú doctor --}}
      <li class="nav-item active">
        <a class=" nav-link active " href="{{ url('/schedule') }}">
          <i class="ni ni-watch-time text-danger"></i> Manage schedule
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{ url('/appointments') }}">
          <i class="ni ni-calendar-grid-58 text-primary"></i> My appointments
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{ url('/patients') }}">
          <i class="ni ni-badge text-orange"></i> My patients
        </a>
      </li>
    {{-- End Menú doctor --}}
  @elseif (auth()->user()->role == 'patient')
    {{-- End Menú patient --}}
      <li class="nav-item active">
        <a class=" nav-link active " href="{{ url('/appointments/create') }}">
          <i class="ni ni-square-pin text-danger"></i> Book appointment
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{ url('/appointments') }}">
          <i class="ni ni-calendar-grid-58 text-primary"></i> My appointments
        </a>
      </li>    
    {{-- End Menú patient --}}
  @endif
  {{-- Menú for all Users --}}
    <li class="nav-item">
      <a class="nav-link " href="#">
        <i class="ni ni-single-02 text-yellow"></i> My profile
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
  {{-- End Menú for all Users --}}
</ul>

@if (auth()->user()->role == 'admin')
  {{-- Divider --}}
  <hr class="my-3">
  {{-- Heading --}}
  <h6 class="navbar-heading text-muted">Reports</h6>
  {{-- Navigation --}}
  <ul class="navbar-nav mb-md-3">
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="ni ni-palette text-red"></i> Appointments frequency
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="ni ni-spaceship text-yellow"></i> Most active doctors
      </a>
    </li>
  </ul>
@endif
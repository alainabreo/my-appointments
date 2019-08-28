@extends('layouts.panel')

@section('content')
<div class="card shadow">
	<div class="card-header border-0">
	  <div class="row align-items-center">
	    <div class="col">
	      <h3 class="mb-0">My Appointments</h3>
	    </div>
	    <div class="col text-right">
	      <a href="{{ url('/appointments/create') }}" class="btn btn-sm btn-primary">Add New</a>
	    </div>
	  </div>
	</div>

	@if ($errors->any())
        <div class="card-body">
			<div class="alert alert-danger" role="alert">
			  <ul>
			    @foreach ($errors->all() as $error)
			      <li>{{ $error }}</li>
			    @endforeach
			  </ul>
			</div>
		</div>
	@endif
	@if (session('notification'))
		<div class="card-body">
			<div class="alert alert-success" role="alert">
			  <strong>Success  !</strong> {{ session('notification') }}
			</div>
		</div>
	@endif
	<div class="card-body">
		<div class="nav-wrapper">
		    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
		        <li class="nav-item">
		            <a class="nav-link mb-sm-3 mb-md-0 active btn btn-success" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
		            	<i class="ni ni-calendar-grid-58 mr-2"></i>
		            	My Appointments
		            </a>
		        </li>
		        <li class="nav-item">
		            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">
		            	<i class="fas fa-calendar-check mr-2"></i>
		            	Appointments to be confirmed
		            </a>
		        </li>
		        <li class="nav-item">
		            <a class="nav-link mb-sm-3 mb-md-0 btn btn-info" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">
		            	<i class="ni ni-calendar-grid-58 mr-2"></i>
		            	Appointments History
		            </a>
		        </li>		        
		    </ul>
		</div>
	</div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
        	{{-- El estado de las citas es confirmed --}}
        	@include('appointments.confirmed-appointments')
        </div>
        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
        	{{-- El estado de las citas es reserved --}}
        	@include('appointments.pending-appointments')
        </div>
        <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
            {{-- El estado de las citas es cualquiera --}}
        	@include('appointments.old-appointments')
        </div>        
    </div>
</div>
@endsection

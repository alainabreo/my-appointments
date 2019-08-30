@extends('layouts.panel')

@section('content')
  <div class="card bg-secondary shadow">
      <div class="card-header bg-white border-0">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0">Appointment # {{ $appointment->id }}, Status: <span class="badge 
            	@if ($appointment->status == 'Canceled') 
            		badge-danger 
            	@else 
            		badge-success 
            	@endif">{{ $appointment->status }}</span></h3>
          </div>
          <div class="col-4 text-right">           
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-danger">Return</a>
          </div>
        </div>
      </div>
      <div class="card-body">
		@if ($errors->any())
	        <div class="card-body">
				<div class="alert alert-danger" role="alert">
				  <ul>
				    @foreach ($errors->all() as $error)
				      <li>
				        {{ $error }}
				      </li>
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

        <h6 class="heading-small text-muted mb-4">Specialty information</h6>        
        <div class="pl-lg-4">
          {{-- Specialty Field --}}
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="specialty">Specialty</label>
                <input id="specialty" name="specialty_id" class="form-control form-control-alternative" value="{{ $appointment->specialty->name }}" disabled>
              </div>
            </div> 
          {{-- End Specialty Field --}}          
          {{-- Doctor Field --}}
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="doctor">Doctor</label>
                <input id="doctor" name="doctor_id" class="form-control form-control-alternative" value="{{ $appointment->doctor->name }}" disabled>
              </div>
            </div> 
          </div>
          {{-- End Doctor Field --}}
          <div class="row">
          	{{-- Date Field --}}
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="date">Date</label>
			    <div class="input-group">    	
			        <div class="input-group-prepend">
			            <span class="input-group-text">
			            	<i class="ni ni-calendar-grid-58"></i>
			            </span>
			        </div>
			        <input class="form-control form-control-alternative" 
			        type="text" id="date" name="scheduled_date" 
			        value="{{ $appointment->scheduled_date }}" disabled>
			    </div>                
              </div>
            </div>
            {{-- End Date Field --}}
			{{-- Hour Field --}}
            <div class="col-lg-6">
              <div class="form-group">
              	{{-- For Select --}}
              	<label class="form-control-label" for="hours">Hour</label>
                <input id="hours" name="scheduled_time" class="form-control form-control-alternative" value="{{ $appointment->scheduled_time_12 }}" disabled>
                {{-- End For Select --}}
              </div>
            </div>
            {{-- End Hour Field --}}
          </div>
        </div>
        <hr class="my-4" />
        {{-- Address --}}
        {{-- <h6 class="heading-small text-muted mb-4">Appointment information</h6> --}}
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label" for="type">Type of appointment</label>
                <input type="text" id="type" name="type" class="form-control form-control-alternative" value="{{ $appointment->type }}" disabled>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label" for="status">Status</label>
                <input type="text" id="status" name="status" class="form-control form-control-alternative" value="{{ $appointment->status }}" disabled>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                
              </div>
            </div>
          </div>        	
        </div>
        <div class="pl-lg-4">
          <div class="form-group">
            <label class="form-control-label" for="description">Description</label>
            <textarea rows="4" id="description" name="description" class="form-control form-control-alternative" placeholder="Describe the reason for your medical consultation " disabled>{{ $appointment->description }}</textarea>
          </div>
        </div>
        @if ($appointment->cancellation)
        <h6 class="heading-small text-muted mb-4">Cancellation information</h6>
        <div class="pl-lg-4 text-left">
          <div class="row">
          {{-- Cancelled By Field --}}
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="cancelled_by">Cancelled By</label>
                <input id="cancelled_by" name="cancelled_by" class="form-control form-control-alternative" value="{{ $appointment->cancellation->cancelled_by->name }}" disabled>
              </div>
            </div> 
          {{-- End Cancelled By Field --}}
          {{-- Cancellation Date Field --}}
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="cancellation_date">Cancellation date</label>
                <input id="cancellation_date" name="cancellation_date_id" class="form-control form-control-alternative" value="{{ $appointment->cancellation->created_at }}" disabled>
              </div>
            </div> 
          {{-- End Cancellation Date Field --}}
          </div>
        </div>
        <div class="pl-lg-4">
          {{-- Justification Field --}}
          <div class="form-group">
            <label class="form-control-label" for="justification">Justification</label>
            <textarea rows="4" id="justification" name="justification" class="form-control form-control-alternative" disabled>{{ $appointment->cancellation->justification }}</textarea>
          </div>
          {{-- End Justification Field --}}
        </div>
        @endif
      </div>
  </div>
@endsection


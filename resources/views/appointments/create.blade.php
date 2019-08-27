@extends('layouts.panel')

@section('content')
  <div class="card bg-secondary shadow">

    <form method="POST" action="{{ url('/appointments') }}">
      @csrf

      <div class="card-header bg-white border-0">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0">New appointment</h3>
          </div>
          <div class="col-4 text-right">
            <button type="submit" class="btn btn-sm btn-primary">Save</button>            
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-danger">Cancel</a>
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
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="specialty">Specialty</label>
                <select id="specialty" name="specialty_id" class="form-control form-control-alternative" required>
                	<option value="">>> Please select specialty <<</option>
                	@foreach ($specialties as $specialty)
                		<option value="{{ $specialty->id }}" @if(old('specialty_id') == $specialty->id) selected @endif>{{ $specialty->name }}</option>
                	@endforeach
                </select>
              </div>
            </div> 
          </div>
          {{-- End Specialty Field --}}          
          {{-- Doctor Field --}}
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="doctor">Doctor</label>
                <select id="doctor" name="doctor_id" class="form-control form-control-alternative" required>

					{{-- Si hay valores Old para doctor, vienen desde el controlador --}}
                	@foreach ($doctors as $doctor)
                		<option value="{{ $doctor->id }}" @if(old('doctor_id') == $doctor->id) selected @endif>{{ $doctor->name }}</option>
                	@endforeach

                </select>
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
			        <input class="form-control datepicker" placeholder="Select date" autocomplete="off" 
			        type="text" id="date" name="scheduled_date" 
			        value="{{ old('scheduled_date', date('Y-m-d')) }}" 
			        data-date-format="yyyy-mm-dd" 
			        data-date-start-date="{{ date('Y-m-d') }}" 
			        data-date-end-date="+2m" required>
			        {{-- “+1d”, “+6m” “+1y” --}}
			    </div>                
              </div>
            </div>
            {{-- End Date Field --}}
			{{-- Hour Field --}}
            <div class="col-lg-6">
              <div class="form-group">
              	{{-- For Select --}}
              	<label class="form-control-label" for="hours">Hours</label>
                <select id="hours" name="scheduled_time" class="form-control form-control-alternative" required>

					{{-- Si hay valores Old para horas, vienen desde el controlador --}}
					@if($intervals)
                	@foreach ($intervals['am'] as $interval)
                		<option value="{{ $interval['start'] }}" @if(old('scheduled_time') == $interval['start']) selected @endif>{{ $interval['start'] }} - {{ $interval['end'] }}</option>
                	@endforeach
                	@foreach ($intervals['pm'] as $interval)
                		<option value="{{ $interval['start'] }}" @if(old('scheduled_time') == $interval['start']) selected @endif>{{ $interval['start'] }} - {{ $interval['end'] }}</option>
                	@endforeach                	
                	@endif

                </select>
                {{-- End For Select --}}
                {{-- For Radio Buttons --}}
                {{-- <label class="form-control-label" for="hours">Hour</label>
                <div id="hours">
                	
                </div> --}}
                {{-- End For Radio Buttons --}}

				{{-- <label class="form-control-label" for="password">Hour</label>
                <input type="text" id="password" name="password" class="form-control form-control-alternative" placeholder="Password" value="{{ str_random(8) }}"> --}}
              </div>
            </div>
            {{-- End Hour Field --}}
            {{-- <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label" for="dni">Document ID</label>
                <input type="text" id="dni" name="dni" class="form-control form-control-alternative" placeholder="Document ID/DNI/Cédula" value="{{ old('dni') }}">
              </div>
            </div> --}}
          </div>
        </div>
        <hr class="my-4" />
        {{-- Address --}}
        {{-- <h6 class="heading-small text-muted mb-4">Appointment information</h6> --}}
        <div class="pl-lg-4">         
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="type">Type of appointment</label>
                <div class="custom-control custom-radio mb-3">
				  <input type="radio" id="type1" name="type" class="custom-control-input" value="Consultation" 
				  	@if(old('type', 'Consultation') == 'Consultation') checked @endif>
				  <label class="custom-control-label" for="type1">Consultation</label>
				</div>
                <div class="custom-control custom-radio mb-3">
				  <input type="radio" id="type2" name="type" class="custom-control-input" value="Exam"
				  	@if(old('type') == 'Exam') checked @endif>
				  <label class="custom-control-label" for="type2">Exam</label>
				</div>
                <div class="custom-control custom-radio mb-3">
				  <input type="radio" id="type3" name="type" class="custom-control-input" value="Surgery"
				  	@if(old('type') == 'Surgery') checked @endif>
				  <label class="custom-control-label" for="type3">Surgery</label>
				</div>								
                {{-- <input type="text" id="type" name="type" class="form-control form-control-alternative" placeholder="type" value="{{ old('type') }}"> --}}
              </div>
            </div>            
            {{-- <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="phone">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control form-control-alternative" placeholder="Phone" value="{{ old('phone') }}">
              </div>
            </div> --}}
          </div>
        </div>
        <div class="pl-lg-4">
          <div class="form-group">
            <label class="form-control-label" for="description">Description</label>
            <textarea rows="4" id="description" name="description" class="form-control form-control-alternative" placeholder="Describe the reason for your medical consultation " required>{{ old('description') }}</textarea>
          </div>
        </div>        
        <div class="pl-lg-4 text-left">
          <button class="btn btn-icon btn-3 btn-primary" type="submit">
            <span class="btn-inner--icon"><i class="ni ni-archive-2"></i></span>
            <span class="btn-inner--text">Save</span>  
          </button>
        </div>        
      </div>
    </form>
  </div>
@endsection

@section('scripts')
	{{--   Datepicker Script JS   --}}
	<script src="{{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
	{{--   JQuery Doctors Select by Specialty   --}}
	<script>
		let $doctor, $date, $specialty, $hours;
		let iRadio;

		// const noHoursAlert = `<div class="alert alert-danger" role="alert">
		//     <strong>Danger!</strong> There is no availability for the doctor on that date!
		// </div>`;
		const noHoursAlert = `<option value=""><strong>There is no availability on that date!</strong></option>`;

		$(function () {
			$specialty = $('#specialty');
			$doctor = $('#doctor');
			$date = $('#date');
			$hours = $('#hours');

			$specialty.change(() => {
				const specialtyId = $specialty.val();
				console.log(specialtyId);
				if (specialtyId=='') { //Select specialty en la opcion informativa
					cleanDoctors();
					cleanHours();
				} else {
					const url = `/specialties/${specialtyId}/doctors`;
					cleanHours();
					$.getJSON(url, onDoctorsLoaded);
				}
			});

			$doctor.change(loadHours);
			$date.change(loadHours);
		});

		function onDoctorsLoaded(doctors) {
			let htmlOptions = `<option value="">>> Please select a doctor <<</option>`;
			doctors.forEach(doctor => {
				htmlOptions += `<option value="${doctor.id}">${doctor.name}</option>`;
			});
			$doctor.html(htmlOptions);
			loadHours();
		}

		function loadHours() {
			const selectedDate = $date.val();
			const doctorId = $doctor.val();
			if (!doctorId=='') { //Select doctors NO ESTÉ en la opcion informativa
				const url = `/schedule/hours?date=${selectedDate}&doctor_id=${doctorId}`;
				$.getJSON(url, displayHours);
			}
		}

		function displayHours(data) {
			if (!data.am && !data.pm) {
				$hours.html(noHoursAlert);
				return;
			}
			
			let htmlHours = `<option value="">>> There is availability, please select an option <<</option>`;
			iRadio = 0;
			if (data.am) {
				const am_intervals = data.am;
				am_intervals.forEach(interval => {
					htmlHours += getRadioIntervalHtml(interval);
				});
			}

			if (data.pm) {
				const pm_intervals = data.pm;
				pm_intervals.forEach(interval => {
					htmlHours += getRadioIntervalHtml(interval);
				});
			}
			$hours.html(htmlHours);
		}

		function getRadioIntervalHtml(interval) {
			const text = `${interval.start} - ${interval.end}`;

			//Radio button options
			// return `<div class="custom-control custom-radio mb-3">
			//   <input class="custom-control-input" type="radio" id="interval${iRadio}" name="scheduled_time" value="${interval.start}" required>
			//   <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
			// </div>`;

			//Select Options
			return `<option value="${interval.start}">${text}</option>`;
		}

		function cleanHours() {
			const text = ``;
			$hours.html(text);
		}		

		function cleanDoctors() {
			const text = ``;
			$doctor.html(text);
		}	

	</script>
@endsection

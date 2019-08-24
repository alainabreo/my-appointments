@extends('layouts.panel')

@section('content')
<form method="POST" action="{{ url('/schedule') }}">
	@csrf
	<div class="card shadow">
		<div class="card-header border-0">
		  <div class="row align-items-center">
		    <div class="col">
		      <h3 class="mb-0">Schedule</h3>
		    </div>
		    <div class="col text-right">
		      <button type="submit" class="btn btn-sm btn-primary">Add schedule</button>
		    </div>
		  </div>
		</div>
		@if (session('errors'))
			<div class="card-body">
				<div class="alert alert-danger" role="alert">
					<strong>Errors  !</strong>
					<ul>
						@foreach (session('errors') as $error)
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
		<div class="table-responsive">
		    {{-- Projects table --}}
		    <table class="table align-items-center table-flush">
				<thead class="thead-light">
				<tr>
				  <th scope="col">Day</th>
				  <th scope="col">Active</th>
				  <th scope="col">Morning</th>
				  <th scope="col">Afternoon</th>
				</tr>
				</thead>
				<tbody>
					@foreach ($workDays as $key => $workDay)
						<tr>
							<td>{{ $days[$key] }}</td>
							<td>
								<label class="custom-toggle">
								  <input type="checkbox" name="active[]" value="{{ $key }}"
								   @if($workDay->active) checked @endif>
								  <span class="custom-toggle-slider rounded-circle"></span>
								</label>
							</td>
							<td>
								<div class="row">
									<div class="col">
										<select class="form-control" name="morning_start[]">
											@foreach ($amHours as $keym => $amHour)
												<option value="{{ $amHour['format_24'] }}" @if($amHour['format_24'] == $workDay->morning_start) selected @endif>
													{{ $amHour['format_12'] }}
												</option>
											@endforeach
											{{-- @for ($i=5; $i<=11; $i++)
												<option value="{{ ($i<10 ? '0' : '') . $i }}:00" 
													@if($i.':00 AM' == $workDay->morning_start) selected @endif>
													{{ $i }}:00 AM
												</option>
												<option value="{{ ($i<10 ? '0' : '') . $i }}:30"
													@if($i.':30 AM' == $workDay->morning_start) selected @endif>
													{{ $i }}:30 AM
												</option>
											@endfor --}}
										</select>
									</div>
									<div class="col">
										<select class="form-control" name="morning_end[]">
											@foreach ($amHours as $keym => $amHour)
												<option value="{{ $amHour['format_24'] }}" @if($amHour['format_24'] == $workDay->morning_end) selected @endif>
													{{ $amHour['format_12'] }}
												</option>
											@endforeach
											{{-- @for ($i=5; $i<=11; $i++)
												<option value="{{ ($i<10 ? '0' : '') . $i }}:00"
													@if($i.':00 AM' == $workDay->morning_end) selected @endif>
													{{ $i }}:00 AM
												</option>
												<option value="{{ ($i<10 ? '0' : '') . $i }}:30"
													@if($i.':30 AM' == $workDay->morning_end) selected @endif>
													{{ $i }}:30 AM
												</option>
											@endfor --}}
										</select>
									</div>							
								</div>
							</td>
							<td>
								<div class="row">
									<div class="col">
										<select class="form-control" name="afternoon_start[]">
											@foreach ($pmHours as $keya => $pmHour)
												<option value="{{ $pmHour['format_24'] }}" @if($pmHour['format_24'] == $workDay->afternoon_start) selected @endif>
													{{ $pmHour['format_12'] }}
												</option>
											@endforeach
											{{-- @for ($i=1; $i<=11; $i++)
												<option value="{{ $i+12 }}:00"
													@if($i.':00 PM' == $workDay->afternoon_start) selected @endif>
													{{ $i }}:00 PM
												</option>
												<option value="{{ $i+12 }}:30"
													@if($i.':30 PM' == $workDay->afternoon_start) selected @endif>
													{{ $i }}:30 PM
												</option>
											@endfor --}}
										</select>
									</div>
									<div class="col">
										<select class="form-control" name="afternoon_end[]">
											@foreach ($pmHours as $keya => $pmHour)
												<option value="{{ $pmHour['format_24'] }}" @if($pmHour['format_24'] == $workDay->afternoon_end) selected @endif>
													{{ $pmHour['format_12'] }}
												</option>
											@endforeach
											{{-- @for ($i=1; $i<=11; $i++)
												<option value="{{ $i+12 }}:00"
													@if($i.':00 PM' == $workDay->afternoon_end) selected @endif>
													{{ $i }}:00 PM
												</option>
												<option value="{{ $i+12 }}:30"
													@if($i.':30 PM' == $workDay->afternoon_end) selected @endif>
													{{ $i }}:30 PM
												</option>
											@endfor --}}
										</select>
									</div>							
								</div>						
							</td>
						</tr>
					@endforeach
				</tbody>      
		    </table>
		</div>
	</div>
</form>
@endsection

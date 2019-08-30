<div class="table-responsive">
    {{-- Projects table --}}
    <table class="table align-items-center table-flush">
		<thead class="thead-light">
		<tr>
		  <th scope="col">Description</th>
		  <th scope="col">Specialty</th>
		  <th scope="col">Doctor</th>
		  <th scope="col">Date</th>
		  <th scope="col">Hour</th>
		  <th scope="col">Type</th>
		  <th scope="col">Status</th>
		  <th scope="col">Options</th>
		</tr>
		</thead>
		<tbody>
			@foreach ($oldAppointments as $appointment)
		    <tr>
		      <th scope="row">
		        {{ $appointment->description }}
		      </th>
		      <td>
		        {{ $appointment->specialty->name }}
		      </td>
		      <td>
		        {{ $appointment->doctor->name }}
		      </td>
		      <td>
		        {{ $appointment->scheduled_date }}
		      </td>
		      <td>
		        {{ $appointment->scheduled_time_12 }}
		      </td>
		      <td>
		        {{ $appointment->type }}
		      </td>
		      <td>
		        {{ $appointment->status }}
		      </td>
		      <td>
		      	{{-- Show Button --}}
		        <a href="{{ url('/appointments/'.$appointment->id) }}" rel="tooltip" title="Show" class="btn btn-info btn-icon btn-sm">
		        	<i class="fas fa-edit"></i>
		        </a>
		      	{{-- Confirm Button --}}
		        {{-- <a href="{{ url('/appointments/'.$appointment->id.'/confirm') }}" rel="tooltip" title="Confirm" class="btn btn-success btn-icon btn-sm">
		        	<i class="fas fa-check"></i>
		        </a> --}}			      	
		      	{{-- Edit Button --}}
		        {{-- <a href="{{ url('/appointments/'.$appointment->id.'/edit') }}" rel="tooltip" title="Edit" class="btn btn-info btn-icon btn-sm">
		        	<i class="fas fa-edit"></i>
		        </a> --}}
		        {{-- Cancel Button --}}
		        {{-- <a href="{{ url('/appointments/'.$appointment->id.'/cancel') }}" rel="tooltip" title="Cancel" class="btn btn-warning btn-icon btn-sm">
		        	<i class="fas fa-ban"></i>
		        </a> --}}
		        {{-- Modal Delete Button --}}
		        @if(auth()->user()->role == 'admin')		        
					<button type="button" title="Delete" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#modal-notification-{{ $appointment->id }}">
						<i class="fas fa-times"></i>
					</button>
					<div class="modal fade" id="modal-notification-{{ $appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification-{{ $appointment->id }}" aria-hidden="true">
					<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
					  <div class="modal-content bg-gradient-danger">          
					    <div class="modal-header">
					      <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
					      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					        <span aria-hidden="true">×</span>
					      </button>
					    </div>            
					    <div class="modal-body">
					      <div class="py-3 text-center">
					        <i class="ni ni-bell-55 ni-3x"></i>
					        <h4 class="heading mt-4">Are you want to delete</h4>
					        <p>{{ $appointment->description }} <strong> ...?</strong></p>
					      </div>
					    </div>
					    <div class="modal-footer">
					      <form method="post" action="{{ url('/appointments/'.$appointment->id) }}">
					        @csrf
					        @method('DELETE')
					        
					        <button type="submit" class="btn btn-white">Yes, delete</button>
					        <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
					      </form>
					    </div>        
					  </div>
					</div>
					</div>
				@endif
				{{-- End Modal Delete Button --}}
		      </td>
		    </tr>
			@endforeach
		</tbody>      
    </table>
</div>
<div class="card-body">
    {{ $oldAppointments->links() }}
</div>
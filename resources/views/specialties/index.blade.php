@extends('layouts.panel')

@section('content')
<div class="card shadow">
	<div class="card-header border-0">
	  <div class="row align-items-center">
	    <div class="col">
	      <h3 class="mb-0">Specialties</h3>
	    </div>
	    <div class="col text-right">
	      <a href="{{ url('/specialties/create') }}" class="btn btn-sm btn-primary">Add New</a>
	    </div>
	  </div>
	</div>
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
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col">Options</th>
        </tr>
      </thead>
      <tbody>
      	@foreach ($specialties as $specialty)
        <tr>
          <th scope="row">
            {{ $specialty->name }}
          </th>
          <td>
            {{ $specialty->description }}
          </td>
          <td>
          	{{-- Edit Button --}}
            <a href="{{ url('/specialties/'.$specialty->id.'/edit') }}" rel="tooltip" title="Edit" class="btn btn-success btn-icon btn-sm">
            	<i class="fas fa-edit"></i>
            </a>
            {{-- Modal Delete Button --}}
				<button type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#modal-notification-{{ $specialty->id }}">
					<i class="fas fa-times"></i>
				</button>
				<div class="modal fade" id="modal-notification-{{ $specialty->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-notification-{{ $specialty->id }}" aria-hidden="true">
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
				        <h4 class="heading mt-4">Are you want to delete <strong>{{ $specialty->name }}</strong>?.</h4>
				        <p>Are you sure?</p>
				      </div>
				    </div>
				    <div class="modal-footer">
				      <form method="post" action="{{ url('/specialties/'.$specialty->id) }}">
				        @csrf
				        @method('DELETE')
				        
				        <button type="submit" class="btn btn-white">Yes, delete</button>
				        <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
				      </form>
				    </div>        
				  </div>
				</div>
				</div>
			{{-- End Modal Delete Button --}}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

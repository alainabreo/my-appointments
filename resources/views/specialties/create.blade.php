@extends('layouts.panel')

@section('content')
  <div class="card bg-secondary shadow">
    <div class="card-header bg-white border-0">
      <div class="row align-items-center">
        <div class="col-8">
          <h3 class="mb-0">New Specialty</h3>
        </div>
        <div class="col-4 text-right">
          <a href="{{ url('/specialties') }}" class="btn btn-sm btn-primary">Cancel</a>
        </div>
      </div>
    </div>
    <div class="card-body">

      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          <ul>
            @foreach ($errors->all() as $error)
              <li>
                {{ $error }}
              </li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ url('/specialties') }}">
        @csrf

        <h6 class="heading-small text-muted mb-4">Specialty information</h6>
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="name">Name</label>
                <input id="name" name="name" class="form-control form-control-alternative" placeholder="Name ..." type="text" value="{{ old('name') }}" required>
              </div>
            </div>
          </div>
        </div>
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="name">Description</label>
                <input id="description" name="description" class="form-control form-control-alternative" placeholder="Description ..." type="text" value="{{ old('description') }}" required>
              </div>
            </div>
          </div>
        </div>        
        <div class="pl-lg-4">
          <div class="form-group">
            <label class="form-control-label" for="long_description">Long Description</label>
            <textarea rows="4" name="long_description" class="form-control form-control-alternative" placeholder="Enter long description ...">{{ old('long_description') }}</textarea>
          </div>
        </div>
        <div class="pl-lg-4 text-left">
          <button class="btn btn-icon btn-3 btn-primary" type="submit">
            <span class="btn-inner--icon"><i class="ni ni-archive-2"></i></span>
            <span class="btn-inner--text">Save</span>  
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection
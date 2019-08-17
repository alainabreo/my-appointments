@extends('layouts.panel')

@section('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
  <div class="card bg-secondary shadow">
    <form method="POST" action="{{ url('/doctors') }}">
      @csrf

      <div class="card-header bg-white border-0">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0">New Doctor</h3>
          </div>
          <div class="col-4 text-right">
            <button type="submit" class="btn btn-sm btn-primary">Save</button>            
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-danger">Cancel</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <h6 class="heading-small text-muted mb-4">Doctor information</h6>
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="name">Name</label>
                <input id="name" name="name" class="form-control form-control-alternative" placeholder="Name ..." type="text" value="{{ old('name') }}" required>
              </div>
            </div> 
          </div>          
          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label" for="email">Email address</label>
                <input type="email" id="email" name="email" class="form-control form-control-alternative" placeholder="Email address" value="{{ old('email') }}">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label" for="password">Password</label>
                <input type="text" id="password" name="password" class="form-control form-control-alternative" placeholder="Password" value="{{ str_random(8) }}">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label" for="dni">Document ID</label>
                <input type="text" id="dni" name="dni" class="form-control form-control-alternative" placeholder="Document ID/DNI/Cédula" value="{{ old('dni') }}">
              </div>
            </div>
          </div>
          {{-- Specialties Select --}}
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="specialties">Specialties</label>
                <select name="specialties[]" id="specialties" class="form-control selectpicker" data-style="btn-primary" multiple title="Select one or more" data-live-search="true">
                  @foreach ($specialties as $specialty)
                    <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                  @endforeach
                </select>
              </div>
            </div> 
          </div>
          {{-- End Specialties Select --}}
        </div>
        <hr class="my-4" />
        {{-- Address --}}
        <h6 class="heading-small text-muted mb-4">Contact information</h6>
        <div class="pl-lg-4">         
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="mobile">Mobile</label>
                <input type="text" id="mobile" name="mobile" class="form-control form-control-alternative" placeholder="Mobile" value="{{ old('mobile') }}">
              </div>
            </div>            
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="phone">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control form-control-alternative" placeholder="Phone" value="{{ old('phone') }}">
              </div>
            </div>
          </div>           
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="address">Address</label>
                <input id="address" name="address" class="form-control form-control-alternative" placeholder="Home Address" value="{{ old('address') }}" type="text">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label" for="city">City</label>
                <input type="text" id="city" name="city" class="form-control form-control-alternative" placeholder="City" value="{{ old('city') }}">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label" for="country">Country</label>
                <input type="text" id="country" name="country" class="form-control form-control-alternative" placeholder="Country" value="{{ old('country') }}">
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label" for="postcode">Postal code</label>
                <input type="number" id="postcode" name="postcode" class="form-control form-control-alternative" placeholder="Postal code" value="{{ old('postcode') }}">
              </div>
            </div>
          </div>
        </div>
        <hr class="my-4" />
        {{-- Description --}}
        <h6 class="heading-small text-muted mb-4">About me</h6>
        <div class="pl-lg-4">
          <div class="form-group">
            <label class="form-control-label" for="aboutme">About Me</label>
            <textarea rows="4" id="aboutme" name="aboutme" class="form-control form-control-alternative" placeholder="A few words about you ...">{{ old('aboutme') }}</textarea>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
@endsection
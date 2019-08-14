@extends('layouts.panel')

@section('content')
  <div class="card bg-secondary shadow">
    <div class="card-header bg-white border-0">
      <div class="row align-items-center">
        <div class="col-8">
          <h3 class="mb-0">New User</h3>
        </div>
        <div class="col-4 text-right">
          <a href="{{ url('/users') }}" class="btn btn-sm btn-primary">Cancel</a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ url('/users') }}">
        @csrf

        <h6 class="heading-small text-muted mb-4">User information</h6>
        <div class="pl-lg-4">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control form-control-alternative" placeholder="Username" value="{{ old('username') }}">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="email">Email address</label>
                <input type="email" id="email" name="email" class="form-control form-control-alternative" placeholder="Email address" value="{{ old('email') }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="firstname">First name</label>
                <input type="text" id="firstname" name="firstname" class="form-control form-control-alternative" placeholder="First name" value="{{ old('firstname') }}">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label" for="lastname">Last name</label>
                <input type="text" id="lastname" name="lastname" class="form-control form-control-alternative" placeholder="Last name" value="{{ old('lastname') }}">
              </div>
            </div>
          </div>         
          {{-- <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-control-label" for="name">Name</label>
                <input id="name" name="name" class="form-control form-control-alternative" placeholder="Name ..." type="text" value="{{ old('name') }}" required>
              </div>
            </div> 
          </div> --}}
        </div>
        <hr class="my-4" />
        <!-- Address -->
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
        <!-- Description -->
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
      </form>
    </div>
  </div>
@endsection

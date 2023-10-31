@extends('layouts.app')
@section('heading','Change Password')
@section('navLinkSetting','active')
@section('settingMenu','menu-open')
@section('content')


<div class="container-fluid">
    
    <div class="row">
      <section class="col-lg-8 connectedSortable">
        <div class="mx-auto">
       
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
        @endif
         <form action="{{url('Admin/changePasswordData')}}" method="post">
          @csrf()
            <div class="mb-3">
              <label for="newPassword" class="form-label">New Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror " id="newPassword" name="password">
              @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Confirm Password</label>
              <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
               id="password_confirmation" name="password_confirmation">
               @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </section>
    </div>
   
 </div>

@endsection
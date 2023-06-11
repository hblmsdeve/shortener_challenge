@extends('auth.app')
@section('title')
    Register
@endsection
@section('content')
    <div class="row align-items-center h-100">
      <div class="col-md-6 mx-auto">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-center">Register</h4>
            <form method="POST" action="{{ route('store') }}">
              @csrf
              <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" class="form-control" name="name" required autofocus>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
              </div>
              <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
              </div>
              <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
              </div>
            </form>
            <div class="text-center mt-4">
                <p>Already registered? <a href="{{route('login')}}">Login</a></p>
              </div>
          </div>
        </div>
      </div>
    </div> 
@endsection
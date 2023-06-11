@extends('auth.app')
@section('title')
    Login
@endsection
@section('content')
    <div class="row align-items-center h-100">
      <div class="col-md-6 mx-auto">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title text-center">Login</h4>
            @if (session()->has('error'))
            <div class="alert alert-danger">
              {{session()->get('error')}}  
            </div>              
            @endif
            <form method="POST" action="{{ route('auth') }}">
              @csrf
              <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control" name="email" required autofocus>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
              </div>
              <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
              </div>
            </form>
            <div class="text-center mt-4">
                <p>Not a member? <a href="{{route('register')}}">Register</a></p>
              </div>
          </div>
        </div>
      </div>
    </div>
@endsection
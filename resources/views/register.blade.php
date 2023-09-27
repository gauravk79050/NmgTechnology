@extends('Layout/Home/main')

@section('content')
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Registration</div>
                    @if(session('success'))
                        <div style="color: green">{{ session('success') }}</div>
                    @endif
                    <div class="card-body">
                        <form id="registrationform" action = {{url('/register')}} method = "post" >
                          @csrf
                          <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name = "name" id="name" value="{{ old('name') }}" placeholder="Enter your name">
                                @error('name')
                                    <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                        <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" name = "email" id="email" value="{{ old('email') }}" placeholder="Enter your email">
                                @error('email')
                                    <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name = "password" id="password" value="{{ old('password') }}"placeholder="Enter your password">
                                @error('password')
                                    <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="c_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name = "password_confirmation" value="{{ old('password_confirmation') }}" id="c_password" placeholder="Confirm password">
                                @error('password_confirmation')
                                    <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                            <br>
                            if Already Registered 
                            <a href = "{{url('login')}}">
                            Login
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endsection


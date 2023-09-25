@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<div class="container form-login pt-5 pb-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light p-5">
                <h2 class="text-center">Login</h2>
                {!! Form::open(['method' => 'post', 'route' => ['prosesLogin']]) !!}
                    <div class="form-group">
                        <label for="" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                        <i class="text-danger">{{ $errors->first('username') }}</i>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                        <i class="text-danger">{{ $errors->first('password') }}</i>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="{{ route('register') }}" class="btn btn-success">Register</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
@extends('layouts.master')
@section('title')
Sign Up
@endsection
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1>Sign Up</h1>
        @if(count($errors)>0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            <p>
                {{$error}}
            </p>
            @endforeach
        </div>
        @endif
        <form action="{{route('user.signup')}}" method='POST'>
            {{csrf_field()}}
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="text" name='email' class='form-control' id='email' value='' placeholder="Please enter your email" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name='password' class='form-control' id='password' value='' placeholder="Please enter your password" />
            </div>
<!--            <div class="form-group">
                <label for="password">Password Confirmation</label>
                <input type="password" name='password-confirmation' id='password-confirmation' value='' placeholder="Please Confirm your password" />

            </div>-->
            <button type="submit" class='btn btn-primary'>Sign Up</button>
        </form>
    </div>

</div>
@endsection

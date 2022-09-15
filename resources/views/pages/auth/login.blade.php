@extends('layouts.auth')

@section('content')
    <div class="page-content d-flex align-items-center justify-content-center">

        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pe-md-0">
                            <div class="auth-side-wrapper">
                                <div class="row">
                                    <div class="col-md-12 mt-4">
                                        @if ($errors->any())
                                            <ul class="">
                                                @foreach ($errors->all() as $error)
                                                    <li class="text-danger">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                                <form method="POST"  class="forms-sample" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="userEmail" placeholder="Email" name="email" value="{{old('email')}}" required autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <label for="userPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="userPassword"
                                               autocomplete="current-password" placeholder="Password" name="password" required >
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                                            Login
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

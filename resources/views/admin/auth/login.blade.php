@extends('admin.auth.partials.main_layout')
@section('content')

    <main class="auth-minimal-wrapper">
        <div class="auth-minimal-inner">
            <div class="minimal-card-wrapper">
                <div class="card mb-4 mt-5 mx-4 mx-sm-0 position-relative">
                    
                    <div class="card-body p-sm-5">
                        <h2 class="fs-20 fw-bolder mb-4">Login</h2>
                        <h4 class="fs-13 fw-bold mb-2">Login to your account 
                            @if(session('error'))
                                <span style="color:red;">
                                    {{ ' - ' .session('error') }}
                                </span>
                            @endif
                        </h4>
                        <form action="{{ route('login') }}" class="w-100 mt-4 pt-2" method="POST">
                            @csrf
                            <div class="mb-4">
                                <input type="email" class="form-control" placeholder="Email or Username" name="email" value="" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="password" value="" required>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <a href="auth-reset-minimal.html" class="fs-11 text-primary">Forget password?</a>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-lg btn-primary w-100">Login</button>
                            </div>
                        </form>
                        
                        <div class="mt-5 text-muted">
                            <span> Don't have an account?</span>
                            <a href="auth-register-minimal.html" class="fw-bold">Create an Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
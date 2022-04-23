{{--kế thừa layout login/register--}}
@extends('backend.layout.login-register')
@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Login</h3>
                    </div>
                    
                    {{--tk ko tồn tại--}}
                    {{----}}
                    @if (session('statusLogin'))
                        <div class="alert alert-success">
                            {{ session('statusLogin') }}
                        </div>
                    @endif

                    {{--lỗi nhập dữ liệu--}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <form action="{{route('admin.handle.login')}}" method="POST">
                            {{--vì method post nên cần có CSRF Protection--}}
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" type="text" placeholder="name@example.com" name="email" />
                                <label for="inputEmail">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="password" />
                                <label for="inputPassword">Password</label>
                            </div>
                            {{-- <div class="form-check mb-3">
                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                            </div> --}}
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                {{-- <a class="small" href="password.html">Forgot Password?</a> --}}
                                <button class="btn btn-primary" type="submit">Login</a>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="{{ route('admin.account')}}">Need an account? Sign up!</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

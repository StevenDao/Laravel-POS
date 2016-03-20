@extends('layouts.app')

@section('content')
    <div class="container login-container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading login-heading">
                        <h5>Welcome to</h5>
                        <h1>SimpleStore</h1>
                    </div>

                    <div class="panel-body">
                        @yield('login-content')
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

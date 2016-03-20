@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Product Details
                    </div>
                    <div class="panel-body">
                        {!! Form::open(array('method' => 'POST', 'url' => 'product')) !!}
                        @include('product._details', ['buttonText' => 'Add Product'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

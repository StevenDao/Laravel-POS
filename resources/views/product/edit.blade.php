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
                        {!! Form::model($dbProduct, array('method' => 'PATCH',
                                        'action' => ['ProductController@update',
                                                     $dbProduct->id],
                                        'files' => true)) !!}
                        @include('product._details', ['buttonText' => 'Update Product'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

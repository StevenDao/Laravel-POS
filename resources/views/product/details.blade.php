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
                        {!! Form::open(array('url' => 'product/create')) !!}
                        <div class="form-group {{ $errors->has('img') ? ' has-error' : '' }}">
                            {!! Form::label('img', 'Product Image:') !!}
                            {!! Form::file('img') !!}
                        </div>
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', 'Product Name:') !!}
                            {!! Form::text('name', null, array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('description', 'Product description:') !!}
                            {!! Form::textarea('description', null, array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                            {!! Form::label('price', 'Product Price:') !!}
                            {!! Form::number('price', null, array('class' => 'form-control')) !!}
                        </div>
                        <div class="form-group panel-buttons">
                            {!! Form::submit('Create Product', array('class' => 'btn btn-primary form-control')) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

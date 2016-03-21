<div class="form-group {{ $errors->has('img') ? 'has-error' : '' }}">
    {!! Form::label('img', 'Product Image:') !!}
    @if (!empty($dbProduct))
        <img class="img-responsive"
             src="{{'/img/'.$dbProduct->img}}"
             alt="{{$dbProduct->name}}">
    @endif
    {!! Form::file('img') !!}
    @if ($errors->has('img'))
        <span class="help-block">
            <strong>{{ $errors->first('img') }}</strong>
        </span>
    @endif
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {!! Form::label('name', 'Product Name:') !!}
    {!! Form::text('name', null, array('class' => 'form-control')) !!}
    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>
<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
    {!! Form::label('description', 'Product description:') !!}
    {!! Form::textarea('description', null, array('class' => 'form-control')) !!}
    @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
    {!! Form::label('price', 'Product Price:') !!}
    {!! Form::number('price', null, array('class' => 'form-control', 'step' => 'any')) !!}
    @if ($errors->has('price'))
        <span class="help-block">
            <strong>{{ $errors->first('price') }}</strong>
        </span>
    @endif
</div>
<div class="panel-buttons">
    {!! Form::submit($buttonText, array('class' => 'btn btn-success')) !!}
    <a class="btn btn-danger" href="{{ url('/') }}">Cancel</a>
</div>


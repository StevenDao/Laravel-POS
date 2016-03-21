<div class="panel panel-default">
	<div class="panel-heading">
		<b>{{$product->name}}</b>
		@if (Auth::user()->type == 'A')
			<div class="panel-buttons">
				<a href="{{ URL::route('product.edit', array('id' => $product->id)) }}">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</a>
				{!! Form::open(array(
				'method' => 'DELETE',
				'action' => ['ProductController@destroy', $product->id],
				'class' => 'delete-form'))!!}
				<a onclick="buttonSubmit($(this), 'delete');">
					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				</a>
				{!! Form::close() !!}

			</div>
		@endif
	</div>
	<div class="panel-body">
		<img class="img-responsive"
		     src="{{'/img/'.$product->img}}"
		     alt="{{$product->name}}">

		@if ($product->description)
			<p>
				<b>Product Description:</b>
			</p>
			<p>
				{{$product->description}}
			</p>
		@endif
		{!! Form::open(array('method' => 'POST',
							 'action' => ['PurchaseController@purchase', $product->id])) !!}
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					{!! Form::Label('colourId', 'Colour:') !!}
					{!! Form::select('colourId', $allColours, null, ['class' => 'form-control']) !!}
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					{!! Form::Label('sizeId', 'Size:') !!}
					{!! Form::select('sizeId', $allSizes, null, ['class' => 'form-control']) !!}
				</div>
			</div>
		</div>

		<p class="list-price">
			<b>Price: </b>${{ number_format($product->price, 2) }}
		</p>
		<div class="panel-buttons">
			{{--{!! Form::submit('Purchase', array('class' => 'btn btn-success')) !!}--}}
			<button onclick="buttonSubmit($(this), 'purchase');" type="button" class="btn btn-success">Purchase</button>
		</div>
		{!! Form::close() !!}
	</div>
</div>


@section('footer')
	<script src="js/buttonSubmit.js"></script>
@endsection
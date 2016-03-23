@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">
						<b> Product List </b>
						@if (Auth::user()->type == 'A')
							<div class="panel-buttons">
								<a href="{{ URL::route('product.create') }}">
									<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
								</a>
							</div>
						@endif
					</div>
					<div class="panel-body">
						@if (count($allProducts) > 0)
							@foreach ($allProducts as $product)
								@include('product._listView', ['product' => $product])
							@endforeach
						@else
							This is embarrassing! Our Store is Empty!<br>
							More inventory is on the way, Come back Soon!
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
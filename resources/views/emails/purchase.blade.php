@extends('layouts.app')

@section('content')
	<div class="container login-container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading login-heading">
						<h5>Thank you from</h5>
						<h1>SimpleStore</h1>
					</div>
					<div class="panel-body">

						<div class="panel panel-default">
							<div class="panel-heading">
								<b> Your Purchase </b>
							</div>
							<div class="panel-body">
								<div class="panel panel-default">
									<div class="panel-heading">
										<b>{{array_get($data, 'product.name')}}</b>
									</div>
									<div class="panel-body">
										@if (!empty($message))
											<img class="img-responsive"
											     src="{{$message->embed(public_path().'/img/'.array_get($data, 'product.img'))}}"
											     alt="{{array_get($data, 'product.name')}}">
										@else
											<img class="img-responsive"
											     src="{{'/img/'.array_get($data, 'product.img')}}"
											     alt="{{array_get($data, 'product.name')}}">
										@endif
										@if (array_get($data, 'product.description'))
											<p>
												<b>Product Description:</b>
											</p>
											<p>
												{{array_get($data, 'product.description')}}
											</p>
										@endif
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<b>Colour: </b>{{array_get($data, 'colour.name')}}
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<b>Size: </b>{{array_get($data, 'size.name')}}
												</div>
											</div>
										</div>
										<p class="list-price">
											<b>Price: </b>${{ number_format(array_get($data, 'product.price'), 2) }}
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

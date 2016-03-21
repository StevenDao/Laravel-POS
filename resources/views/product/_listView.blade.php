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
                <a onclick="deleteProduct($(this));">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </a>
                {!! Form::close() !!}

            </div>
        @endif
    </div>
    <div class="panel-body">
        <img class="img-responsive"
             src="{{$product->img}}"
             alt="{{$product->name}}">

        @if ($product->description)
            <p>
                <b>Product Description:</b>
            </p>
            <p>
                {{$product->description}}
            </p>
        @endif
        <p class="list-price">
            <b>Price: </b>${{ number_format($product->price, 2) }}
        </p>
        <div class="panel-buttons">
            <a class="btn btn-success">Purchase</a>
        </div>
    </div>
</div>


@section('footer')
    <script src="js/deleteProduct.js"></script>
@endsection
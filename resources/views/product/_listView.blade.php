<div class="panel panel-default">
    <div class="panel-heading">
        <b>{{$product->name}}</b>
        @if (Auth::user()->type == 'A')
            <div class="panel-buttons">
                <a href="{{ URL::route('product.edit', array('id' => $product->id)) }}">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                <a href="{{ URL::route('product.destroy', array('id' => $product->id)) }}">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                </a>
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
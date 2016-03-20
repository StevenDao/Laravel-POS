@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Product List
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
                                            <b>Price: </b>${{$product->price}}
                                        </p>
                                        <div class="panel-buttons">
                                            <a class="btn btn-success">Purchase</a>
                                        </div>
                                    </div>
                                </div>
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
@endsection>
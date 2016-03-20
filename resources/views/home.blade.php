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
                                <a href="{{ URL::route('product.new') }}">
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
                                        {{$product->name}}
                                        @if (Auth::user()->type == 'A')
                                            <div class="panel-buttons">
                                                <a href="{{ URL::route('product.edit') }}">
                                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                                </a>
                                                <a href="{{ URL::route('product.delete') }}">
                                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            {{$product->img}}
                                        </div>
                                        <div class="row">
                                            {{$product->description}}
                                        </div>
                                        <div class="row">
                                            {{$product->price}}
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
@endsection

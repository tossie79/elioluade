@extends('layouts.master')
@section('title')
Welcome To ElioLuade Online Market
@endsection
@section('content')
@foreach($products->chunk(3) as $productChunk)
<div class="card-columns">
    @foreach($productChunk as $product)
    <!--<div class="col-sm-6 col-md-4">-->
    <div class="card" style="width: 18rem;">
        <div class="thumbnail">
            <img src="{{$product->imagePath}}" class="card-img-top img-responsive" alt="{{$product->name}}"  >

            <div class="card-body">
                <h5 class="card-title">{{$product->name}}</h5>
                <p class="card-text description">{{$product->description}}</p>
            </div>


            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left price">${{$product->price}}</div>
                    <a href="{{route('product.addToCart',['id'=>$product->id])}}" class="btn btn-success float-right" role="button" >Add To Cart</a>
                </div>
            </div>
        </div>

        <!--</div>-->
    </div>
    @endforeach
</div>
@endforeach

@endsection
@extends('layouts.master')
@section('title')
Elioluade Shopping Cart
@endsection

@section('content')
@if(Session::has('cart'))
<div class='row'>
    <div class='col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3'>
        <ul class='list-group'>
            @foreach($products as $product)
            <li class='list-group-item'>
                <strong>{{$product['item']['name']}}</strong>
                <span class="badge badge-secondary">{{$product['qty']}}</span>
                
                <span class="badge badge-success">${{$product['price']}}</span>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                        Action<span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li>  <a href="#"> Reduce By 1</a> </li>
                        <li>  <a href="#"> Reduce All</a> </li>
                    </ul>

                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="row">
        <div class='col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3'>
            <strong>Total: {{$totalPrice}}</strong>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class='col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3'>
            <a type="button" href="{{route('checkout')}}" class="btn btn-success">Checkout</a>
        </div>
    </div>



</div>
@else
<div class="row">
    <div class='col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3'>
        <h2>No Items in Shopping Cart</h2>
    </div>
</div>
@endif
@endsection
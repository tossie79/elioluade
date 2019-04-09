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
{{$product

}}
</li>
@endforeach
</ul>
</div>





</div>
@else
	
@endif
@endsection
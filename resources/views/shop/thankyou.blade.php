@extends('layouts.master')
@section('title')
Thank you For your Order
@endsection

@section('content')

<!--<div class="row">
    <<div class="col-md-6">
        <a href='#' class="btn btn-success">Thank you For Your Purchase</a>
    </div>

</div>-->
@if (('status'))
<div class="alert alert-success">
    {{ $status }}
</div>
@endif
@endsection
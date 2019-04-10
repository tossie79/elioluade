@extends('layouts.master')
@section('title')
Elioluade Checkout Page
@endsection
@section('styles')
<script src="https://js.stripe.com/v3/"></script>
<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
    .StripeElement {
        box-sizing: border-box;

        height: 40px;

        padding: 10px 12px;

        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;

        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
@endsection
@section('content')
<div class='row'>
    <div class='col-md-6 '>
        <h1>Checkout</h1>
        @if (count($errors)>0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $message) 
                <span> {{ $message }}</span>
            @endforeach
        </div>
        @endif
        <h4>Your Total is ${{$totalPrice}}</h4>

        <form action="{{route('checkout')}}" method="POST" id="payment-form">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Name On Card</label>
                        <input type="text" class="form-control" id="name" name='name' >
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" >
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" >
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" name="state" >
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="postcode">Pot Code</label>
                        <input type="text" class="form-control" id="postcode" name="postcode" >
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="card-element">
                            Credit or debit card
                        </label>

                        <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>
                </div>

                <button type="submit" id="submit-order" class='btn btn-primary full-width'>Complete Order</button></div>
        </form>

    </div>
</div>



@endsection
@section('scripts')
<script type='text/javascript' src="{{ asset('js/checkout.js') }}"></script>
<script type='text/javascript'>

</script>
@endsection
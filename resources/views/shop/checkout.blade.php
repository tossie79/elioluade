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
        <h4>Your Total is ${{$totalPrice}}</h4>

        <form action="{{route('checkout')}}" method="POST" id="payment-form">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Name On Card</label>
                        <input type="text" class="form-control" id="name" >
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

                <button type="submit" class='btn btn-primary'>Complete Order</button></div>
        </form>

    </div>
</div>







<!--        <form action="{{route('checkout')}}" method="POST" id="checkout-form">
           {{csrf_field()}}
           <label for="card-element">
               Credit or debit card
           </label>

           <div class="row" id='card-element'>
              <div class="col-xs-12 col-md-12">
                   <div class="form-group">
                       <label for="name">Name</label>
                       <input type="text"  id="name" class="form-control" required>
                   </div>
               </div>
               <div class="col-xs-12 col-md-12">
                   <div class="form-group">
                       <label for="card-address">Address</label>
                       <input type="text"  id="card-address" class="form-control" required>
                   </div>
               </div>
               <div class="col-xs-12 col-md-12">
                   <div class="form-group">
                       <label for="card-name">Card Holder Name</label>
                       <input type="text" id="card-name" class="form-control" required>
                   </div>
               </div>
               <div class="col-xs-12 col-md-12">
                   <div class="form-group">
                       <label for="card-number">Credit Card Number</label>
                       <input type="text"  id="card-number" class="form-control" required>
                   </div>
               </div>
               <div class="col-xs-6 col-md-6">
                   <div class="form-group">
                       <label for="card-expiry-month"> Expiry Month</label>
                       <input type="text"  id="card-expiry-month" class="form-control" required>
                   </div>
               </div>
               <div class="col-xs-6 col-md-6">
                   <div class="form-group">
                       <label for="card-expiry-year"> Expiry Year</label>
                       <input type="text"  id="card-expiry-year" class="form-control" required>
                   </div>
               </div>
               <div class="col-xs-12 col-md-12">
                   <div class="form-group">
                       <label for="card-cvc">CVC</label>
                       <input type="text"  id="card-cvc" class="form-control" required>
                   </div>
               </div>
               <div class="col-xs-12 col-md-12">
                   <div class="form-group">
                       <button type="submit" class="btn btn-success">Buy Now</button>
                   </div>
               </div>
               <div id="card-errors" role="alert"></div>
           </div>
       </form>-->

@endsection
@section('scripts')

<script type="text/javascript">
(function () {
    // Create a Stripe client.
    var stripe = Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx');

// Create an instance of Elements.
    var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

// Create an instance of the card Element.
    var card = elements.create('card', {
        style: style,
        'hidePostalCode':true
    });

// Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

// Handle real-time validation errors from the card Element.
    card.addEventListener('change', function (event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

// Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        stripe.createToken(card).then(function (result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });

// Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
//        form.submit();
    }
})();
</script>
@endsection
@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <div class="content" style="padding-top: 20px;">
        <div class="container-fluid">
            <div class="row justify-content-center"> <!-- Center the content -->
                <div class="col-md-8"> <!-- Adjust the width as needed -->

                    <div class="card">
                        <div class="card-header"><h3>Pay  </h3></div>

                        <div class="card-body">
                                         @if (Session::has('success'))
                                            <div class="alert alert-success text-center">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                                <p>{{ Session::get('success') }}</p>
                                            </div>
                                        @endif
           
                            <form id='checkout-form' method='POST' action="{{ route('stripe-post') }}">
                                @csrf

                                <!-- User Information (Disabled) -->
                                
                                    <input hidden type="email" id="email" name="email" class="form-control" value="{{ auth()->user()->email }}" disabled>                                    
                                    <input hidden type="text" id="name" name="name" class="form-control" value="{{ auth()->user()->name }}" disabled>
                                    <input hidden type="text" id="plan" name="plan" class="form-control" value="Premium" disabled>
                                    <input hidden type="text" id="" name="price" class="form-control" value="10" disabled>
                                <!-- Payment Method Selection -->
                                    <div class="form-group">
                                            <label for="payment_method">Select Payment Method</label>
                                            <br>
                                            <div class="payment-card stripe-card" id="payment_method_stripe" onclick="showStripe()">
                                                <i class="fas fa-credit-card"></i> <!-- FontAwesome icon for credit card -->
                                                <span>Stripe</span>
                                            </div>
                                            <div class="payment-card paypal-card" id="payment_method_paypal" onclick="showPayPal()">
                                            <i class="fab fa-paypal"></i> <!-- FontAwesome icon for PayPal -->
                                                <span>PayPal</span>
                                            </div>
                                        </div>
                                    <div id = "stripe-body" style ='display:none'>
                                      <div class="panel-body">
                                            <input type='hidden' name='stripeToken' id='stripe-token-id'>                              
                                            <br>
                                            <div id="card-element" class="form-control" ></div>
                                            <button 
                                                id='pay-btn'
                                                class="btn btn-success mt-3"
                                                type="button"
                                                style="margin-top: 20px; width: 100%;padding: 7px;"
                                                onclick="createToken()">Pay With Stripe  $10
                                            </button>
                                     </div> 
                                    </div>        
                                    <div id="paypal-body" style="display: none;"> <!-- Initially hidden -->
                                        <center>
                                            <a href="{{ route('paypal.payment') }}" class="btn btn-success btn-block">Pay With PayPal $10 </a>
                                        </center>
                                    </div>
        
                                    
                               </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
/* Payment Card Styling */
.payment-card {
    display: inline-block;
    vertical-align: top;
    margin-right: 20px;
    padding: 15px; /* Increase padding for better spacing */
    border: 1px solid #ccc;
    border-radius: 10px; /* Increase border radius for a rounded look */
    cursor: pointer;
    transition: transform 0.3s, background-color 0.3s, color 0.3s, border-color 0.3s; /* Add border-color transition */
    text-align: center;
    width: 200px; /* Wider card for better icon visibility */
}

.payment-card i {
    font-size: 60px; /* Larger icon size (adjust as needed) */
    margin-bottom: 15px; /* Increase margin for better spacing */
}

.payment-card span {
    font-weight: bold;
    display: block;
    margin-top: 10px;
    color: #006FDF; /* Set the text color to PayPal color */
}

/* Stripe Card Styling (Default Colors) */
.stripe-card {
    background-color: #f5f5f5; /* Default background color for Stripe card */
    color: #333; /* Default text color for Stripe card */
}

/* PayPal Card Styling (Default Colors) */
.paypal-card {
    background-color: #f5f5f5; /* Default background color for PayPal card */
    color: #333; /* Default text color for PayPal card */
}

/* Active State (when clicked) */
.payment-card.active {
    background-color: #f5f5f5; /* Lighter background color on click (match the default) */
    color: #006FDF; /* Text color on click (match the PayPal color) */
    border-color: #00A65A; /* Custom border color on click (greenish) */
}

/* Hover Effect */
.payment-card:hover {
    transform: scale(1.1); /* Slightly larger on hover */
}

    </style>
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
  
    var stripe = Stripe('{{ env('STRIPE_KEY') }}')
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');
  
    /*------------------------------------------
    --------------------------------------------
    Create Token Code
    --------------------------------------------
    --------------------------------------------*/
    function createToken() {
        document.getElementById("pay-btn").disabled = true;
        stripe.createToken(cardElement).then(function(result) {
   
            if(typeof result.error != 'undefined') {
                document.getElementById("pay-btn").disabled = false;
                alert(result.error.message);
            }
  
            /* creating token success */
            if(typeof result.token != 'undefined') {
                document.getElementById("stripe-token-id").value = result.token.id;
                document.getElementById('checkout-form').submit();
            }
        });
    }


    function showStripe() {
        document.getElementById("stripe-body").style.display = "block";
        document.getElementById("paypal-body").style.display = "none";
    }

    function showPayPal() {
        document.getElementById("stripe-body").style.display = "none";
        document.getElementById("paypal-body").style.display = "block";
    }


    // JavaScript for applying the "active" class when a payment card is clicked
document.addEventListener("DOMContentLoaded", function() {
    var paymentCards = document.querySelectorAll(".payment-card");
    
    paymentCards.forEach(function(card) {
        card.addEventListener("click", function() {
            paymentCards.forEach(function(card) {
                card.classList.remove("active");
            });
            card.classList.add("active");
        });
    });
});

</script>
@endsection

 
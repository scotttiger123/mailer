@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <div class="content" style="padding-top: 20px;">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header" style="background-color:white">
                    <h2 style="text-align:center">Choose a plan</h2>
                    <p style="text-align:center">Select your Premium Plan to enjoy full features.</p>

                    <div class="columns-wrapper">
                        <div class="columns @if ($user->package_id === 1) selected-package @endif">
                            <ul class="price">
                                <li class="header">Free {{ $user->package_id === 1 }}</li>
                                <li class="grey">$ 0.00 / year</li>
                                <li>12,000 Monthly Emails</li>
                                <li>1 Template</li>
                                <li>24/7 Email & Chat Support for the first 30 days</li>
                                <li>10,000 Emails per month</li>
                                <li>1 Group</li>
                                <li class="grey">
                                    @if ($user->package_id === 1)
                                        <a href="javascript:void(0);" class="button selected">Selected</a>
                                    @else  
                                    
                                        <a href="#" class="button">Select</a>
                                    @endif    
                                </li>
                                @if ($user->package_id === 1)
                                <div class="ribbon">
                                    <span class="ribbon-text">Selected</span>
                                </div>
                                @endif
                                
                            </ul>
                        </div>

                        <div class="columns @if ($user->package_id === 2) selected-package @endif">
                            <ul class="price">
                                <li class="header" style="background-color:#04AA6D">Premium</li>
                                <li class="grey">$ 0.00 / year</li>
                                <li>12,000 Monthly Emails</li>
                                <li>Unlimted Templates</li>
                                <li>24/7 Email & Chat Support for the first 30 days</li>
                                <li>Unlimited emails </li>
                                <li>Unlimted Groups </li>
                                <li class="grey">
                                    
                                    <a href="{{ route('upgrade-plan') }}" class="button">Upgrade</a>

                                </li>
                                @if ($user->package_id === 2)
                                <div class="ribbon">
                                    <span class="ribbon-text">Selected</span>
                                    
                                </div>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<style>

.button.selected {
    background-color: black; 
    
}
   .columns-wrapper {
    display: flex;
    justify-content: center; 
    align-items: center; 
}

.columns {
    width: 33.3%;
    padding: 8px;
    text-align: left; 
}
    .button.selected-package {
        background-color: #04AA6D; /* Change the background color for the selected package */
    }

    .price {
        position: relative;
    }

    .ribbon {
        position: absolute;
        top: 20px;
        right: 0px;
        background-color: ; /* Ribbon color */
        color: #fff;
        padding: 0px 5px;
        transform: rotate(45deg);
        z-index: 1;
    }

    .ribbon-text {
        transform: rotate(-45deg);
    }

    * {
        box-sizing: border-box;
    }

    .columns {
        float: left;
        width: 33.3%;
        padding: 8px;
    }

    .price {
        list-style-type: none;
        border: 1px solid #eee;
        margin: 0;
        padding: 0;
        -webkit-transition: 0.3s;
        transition: 0.3s;
    }

    .price:hover {
        box-shadow: 0 8px 12px 0 rgba(0, 0, 0, 0.2);
    }

    .price .header {
        background-color: #111;
        color: white;
        font-size: 25px;
    }

    .price li {
        border-bottom: 1px solid #eee;
        padding: 20px;
        text-align: center;
    }

    .price .grey {
        background-color: #eee;
        font-size: 20px;
    }

    .button {
        background-color: #04AA6D;
        border: none;
        color: white;
        padding: 10px 25px;
        text-align: center;
        text-decoration: none;
        font-size: 18px;
    }

    @media only screen and (max-width: 600px) {
        .columns {
            width: 100%;
        }
    }
</style>


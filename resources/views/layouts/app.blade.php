<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

                <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
        <!-- summernote -->
        <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
       
        <style>
                .textarea {
                    height: 1200px; /* Adjust the value as needed */
                }

                .card-header {
                    background-color: #3498db; /* Change this color to your preferred choice */
                    padding: 15px;
                    border-bottom: 1px solid #d1d3e2;
                }

                .card-title {
                    margin: 0;
                    font-size: 1.5rem;
                    color: #fff; /* Change the text color to ensure visibility on the background */
                }
                
                .content { 
                    padding-top: 20px !important;
                }
        </style>
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            @include('layouts.header')
            @include('layouts.sidebar')
            @yield('content') 
            @include('layouts.footer')
        </div>
    </body>
</html>    

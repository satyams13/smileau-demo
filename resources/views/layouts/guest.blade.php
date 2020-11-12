<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>

        <style>
          form .help-block {
              display: inline-block;
              color: red;
          }
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

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased" id="app">
            {{ $slot }}
        </div>
        <input type="hidden" id="stripe-public-key" value="{{ env('STRIPE_KEY') }}">
    </body>
    <script type="text/javascript" src='/assets/js/app.js'></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript" src='/assets/js/custom.js'></script>
</html>

<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Stripe Secret Key
    |--------------------------------------------------------------------------
    |
    | This value is the secret API key for your Stripe account. You can find
    | this key in your Stripe dashboard. Make sure to keep this key secure
    | and do not share it publicly.
    |
    */

    'sk' => env('STRIPE_SK'),

    /*
    |--------------------------------------------------------------------------
    | Stripe Publishable Key
    |--------------------------------------------------------------------------
    |
    | This value is the publishable API key for your Stripe account. You can
    | find this key in your Stripe dashboard. This key is safe to share
    | publicly and is used for client-side operations.
    |
    */

    'pk' => env('STRIPE_PK'),

];

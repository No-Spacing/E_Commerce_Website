@component('mail::message')
# Code Request

Hi! {{ $customerName->name }}.

Here's your Requested Code to reset your password: {{ $content }} <br>
Please DO NOT SHARE this code to anyone.

Brigada Healthline Corp.
@endcomponent
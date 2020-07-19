<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <link rel="stylesheet" href="{{asset('/css/styles.css')}}" type="text/css">
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3WXmGtwE7aG7kHvfGGiI_RqFJ3DDBAvs&libraries=places"></script>

    </head>
    <body>
        <div id='app' class="content">
            <vue-navbar></vue-navbar>
            <router-view />
        </div>
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>

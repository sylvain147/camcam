<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="flex justify-center w-full mt-2">
    <img src="{{ asset("logo.jpg") }}" style="width: 250px" alt="">
</div>
<div class="py-5 px-5 m-8 bg-white rounded-lg shadow-md ">

    @yield('content')
</div>
</body>
</html>
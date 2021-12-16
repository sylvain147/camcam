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
    <div class="mb-2 ">
        <div class='flex cursor-pointer'>
            <a href="{{route('song')}}" class='py-2 px-6 bg-white @if(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName() == 'song') border-b-4 border-blue-300 @endif '>Musiques</a>
            <a href="{{route('my-songs')}}" class='py-2 px-6 bg-white @if(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName() == 'my-songs') border-b-4 border-blue-300 @endif  '>Mes musiques</a>
        </div>
    </div>

        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-2 song-error  @if(\Illuminate\Support\Facades\Auth::user()->songs->count() < 11) hidden @endif" role="alert">
            <strong>C'est pas serieux gros, tu as selectionné <span class="song-count">{{\Illuminate\Support\Facades\Auth::user()->songs->count()}}</span> musiques</strong>
        </div>
    @yield('content')
</div>
</body>
</html>
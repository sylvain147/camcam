@extends('app')
@section('content')
    <table class="w-full">
        <thead>
        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">Titre</th>
            <th class="px-4 py-3">Artiste</th>
            <th class="px-4 py-3">Points</th>
            @foreach($users as $user)
                <th class="px-4 py-3">{{$user->name}}</th>

            @endforeach
        </tr>
        </thead>
        <tbody class="bg-white body-songs">
        @foreach($songs as $song)
            <tr class="text-gray-700">
                <td class="px-4 py-3 border">
                    {{$song->name}}
                </td>
                <td class="px-4 py-3 text-ms font-semibold border">{{$song->artist->name}}</td>
                <td class="px-4 py-3 text-xs border">
                    {{$song->points}}
                </td>
                @foreach($users as $user)
                    <td class="px-4 py-3 text-xs border text-center  @if($user->getRank($song->id) <4) bg-green-200 @endif @if($user->getRank($song->id) >10) bg-red-500 @endif  @if($user->getRank($song->id) >3 && $user->getRank($song->id) < 11 ) bg-yellow-500 @endif" >{{$user->getRank($song->id)}}</td>

   
                @endforeach

            </tr>

        @endforeach

        </tbody>
    </table>
@endsection
@extends('app')
@section('content')
    <table class="w-full">
        <thead>
        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">Titre</th>
            <th class="px-4 py-3">Artiste</th>
            <th class="px-4 py-3">Date</th>
            <th class="px-4 py-3">Aussi par</th>
        </tr>
        </thead>
        <tbody class="bg-white body-songs">
        @foreach($user->songs as $song)
            <tr class="text-gray-700 song-line" data-id="{{$song->id}}">
                <td class="px-4 py-3 border">
                    {{$song->name}}
                </td>
                <td class="px-4 py-3 text-ms font-semibold border">{{$song->artist->name}}</td>
                <td class="px-4 py-3 text-xs border">
                    {{\Carbon\Carbon::parse($song->release_date)->format('d/m/Y')}}
                </td>
                <td class="px-4 py-3 text-sm border">
                    @foreach($song->selectedBy() as $selected)
                        @if($selected->id != $user->id)
                               {{$selected->name}}<br>
                        @endif
                    @endforeach
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>
    <script
            src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
            integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI="
            crossorigin="anonymous"></script>
    <script>
        let id = "{{$user->id}}"
        console.log(`.nav-user[data-id="${id}"]`)
        $(`.nav-user[data-user="${id}"]`).addClass(' border-b-4 border-blue-300 ')
    </script>
@endsection
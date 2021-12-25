@extends('app')
@section('content')
    <button class="save bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded save-song ">Save</button>
    <div class="token hidden" data-token="{{csrf_token()}}"></div>
    <table class="w-full">
        <thead>
        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3"></th>
            <th class="px-4 py-3">Titre</th>
            <th class="px-4 py-3 hidden md:table-cell">Artiste</th>
            <th class="px-4 py-3 hidden md:table-cell">Date</th>
            <th class="px-4 py-3 hidden md:table-cell">Classement</th>
        </tr>
        </thead>
        <tbody class="bg-white body-songs" id="rank">
        @foreach($songs as $song)
            <tr class="text-gray-700 song-line" data-id="{{$song->id}}">
                <td class="px-4 py-3 border">
                    <div class="my-handle flex justify-center cursor-grab">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </div></td>
                <td class="px-4 py-3 border">

                    <iframe src="https://open.spotify.com/embed/track/{{$song->spotify_id}}" width="300"  height="80" frameborder="0" allowtransparency="true" allow="encrypted-media">

                    </iframe>
                </td>
                <td class="px-4 py-3 text-ms font-semibold border hidden md:table-cell">{{$song->artist->name}}</td>
                <td class="px-4 py-3 text-xs border hidden md:table-cell">
                    {{\Carbon\Carbon::parse($song->release_date)->format('d/m/Y')}}
                </td>
                <td class="px-4 py-3 text-sm border hidden md:table-cell">
                    {{$song->pivot->place + 1}}
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <script src="{{ mix('js/app.js') }}" defer></script>

@endsection
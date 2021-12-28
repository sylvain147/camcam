@extends('app')
@section('content')
    <div class="w-full flex justify-end mb-4">
        <a href="{{route('my-rank2')}}">

        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
        </svg>
        </a>
    </div>
    <div class="token hidden" data-token="{{csrf_token()}}"></div>
    <table class="w-full">
        <thead>
        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3"></th>
            <th class="px-4 py-3">Titre</th>
            <th class="px-4 py-3 hidden md:table-cell">Artiste</th>
            <th class="px-4 py-3 hidden md:table-cell">Date</th>
        </tr>
        </thead>
        <tbody class="bg-white body-songs" id="rank">
        @foreach($songs as $song)
            <tr class="text-gray-700 song-line" data-id="{{$song->id}}">
                <td class="px-4 py-3 border">
                    <div class="my-handle flex flex-col items-center justify-center cursor-grab">
                          <span class="song-place">
                                            {{$song->pivot->place + 1}}

                    </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </div></td>
                <td class="px-4 py-3 border">
                    <div class="w-full overflow-y-hidden max-w-xs" >
                    <iframe style="max-width: 100%" src="https://open.spotify.com/embed/track/{{$song->spotify_id}}" width="300"  height="80" frameborder="0" allowtransparency="true" allow="encrypted-media">

                    </iframe>
                    </div>
                </td>
                <td class="px-4 py-3 text-ms font-semibold border hidden md:table-cell">{{$song->artist->name}}</td>
                <td class="px-4 py-3 text-xs border hidden md:table-cell">
                    {{\Carbon\Carbon::parse($song->release_date)->format('d/m/Y')}}
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <script src="{{ mix('js/app.js') }}" defer></script>

@endsection
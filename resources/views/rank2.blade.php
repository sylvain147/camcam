@extends('app')
@section('content')

    <div class="w-full flex justify-end mb-2">
        <a href="{{route('my-rank')}}">

            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </a>
    </div>
    <div class="flex flex-wrap justify-around  " id="rank">

    @foreach($songs as $song)
        <div class="p-4 py-3 border rounded flex flex-col items-center justify-center space-y-2 song-line" data-id="{{$song->id}}">
            <div class=" border-b w-full mb-2 text-center">
                <div class="my-handle flex  items-center justify-center cursor-grab">
                          <span class="song-place">
                                            {{$song->pivot->place + 1}}

                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </div>
            </div>
            <iframe style="max-width: 100%" src="https://open.spotify.com/embed/track/{{$song->spotify_id}}" width="300"  height="80" frameborder="0" allowtransparency="true" allow="encrypted-media">

            </iframe>
        </div>
    @endforeach
    </div>

    <div class="token hidden" data-token="{{csrf_token()}}"></div>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <script src="{{ mix('js/app.js') }}" defer></script>

@endsection
@extends('app')
@section('content')
    <table class="w-full">
        <thead>
        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">Titre</th>
            <th class="px-4 py-3">Artiste</th>
            <th class="px-4 py-3">Date</th>
            <th class="px-4 py-3"></th>
        </tr>
        </thead>
        <tbody class="bg-white body-songs">
        @foreach($songs as $song)
            <tr class="text-gray-700 song-line" data-id="{{$song->id}}">
                <td class="px-4 py-3 border">
                    {{$song->name}}
                </td>
                <td class="px-4 py-3 text-ms font-semibold border">{{$song->artist->name}}</td>
                <td class="px-4 py-3 text-xs border">
                    {{\Carbon\Carbon::parse($song->release_date)->format('d/m/Y')}}
                </td>
                <td class="px-4 py-3 text-sm border flex justify-center">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded remove-song" data-id="{{$song->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>

    <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
    <script>
        $(document).on('click','.remove-song', (e)=>{
            let url = "{{route('remove-song','_id_song_')}}"
            let id = $(e.currentTarget).data('id')
            url = url.replace('_id_song_', id)
            $(`.loader[data-id=${id}]`).removeClass('hidden')
            $(`.remove-song[data-id=${id}]`).addClass('hidden')
            $.ajax({
                method : 'POST',
                url : url,
                data : {
                    _token : "{{ csrf_token() }}"
                }
            }).then((response)=>{
                $(`.loader[data-id=${id}]`).addClass('hidden')
                $(`.song-line[data-id=${id}]`).remove()
                $('.song-count').html(response)

                if(response < 11){
                    $('.song-error').addClass('hidden')
                }
                else {
                    $('.song-error').removeClass('hidden')

                }
            })
        })
    </script>
    @endsection
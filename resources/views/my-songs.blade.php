@extends('app')
@section('content')
    <table class="w-full">
        <thead>
        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">Titre</th>
            <th class="px-4 py-3">Artiste</th>
            <th class="px-4 py-3">Date</th>
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
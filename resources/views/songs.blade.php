@extends('app')
@section('content')

    <div class="grid grid-cols-2 gap-2 mb-4">
    <input placeholder="Rechercher" class="search shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" >
    <select class="artist shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="" id="">
        <option value="">Artiste</option>
        @foreach($artists as $artist)
            <option value="{{$artist->id}}">{{$artist->name}}</option>
        @endforeach
    </select>
</div>
    <table class="w-full">
        <thead>
        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">Titre</th>
            <th class="px-4 py-3">Artiste</th>
            <th class="px-4 py-3">Date</th>
        </tr>
        </thead>
        <tbody class="bg-white body-songs">
        </tbody>
    </table>
<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<script>
    $('.artist').on('change', ()=>{
        searchSong()
    })
    $('.search').on('keyup', ()=>{
        searchSong()
    })

   function searchSong() {
        $.ajax({
            url :"{{route('songlist')}}",
            data : {
                'search' : $('.search').val(),
                'artist_id' : $('.artist').val()
            }
        }).then((response)=>{
            $('.body-songs').html(response)
        })
    }
    searchSong()
    $(document).on('click','.save-song', (e)=>{
        let id= $(e.currentTarget).data('id')
        $(`.loader[data-id=${id}]`).removeClass('hidden')
        $(`.save-song[data-id=${id}]`).addClass('hidden')
        let url = "{{route('save-song','_id_song_')}}"
        url = url.replace('_id_song_',$(e.currentTarget).data('id'))
        $.ajax({
            method : 'POST',
            url : url,
            data : {
                _token : "{{csrf_token()}}"
            }
        }).then((response)=>{
            $(`.loader[data-id=${id}]`).addClass('hidden')
            $(`.remove-song[data-id=${id}]`).removeClass('hidden')
            $('.song-count').html(response)

            if(response < 11){
                $('.song-error').addClass('hidden')
            }
            else {
                $('.song-error').removeClass('hidden')

            }

        })
    })
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
            if(response < 11){
                $('.song-error').addClass('hidden')
            }
            else {
                $('.song-error').removeClass('hidden')

            }
                $(`.loader[data-id=${id}]`).addClass('hidden')
                $(`.save-song[data-id=${id}]`).removeClass('hidden')
            $('.song-count').html(response)

        })
    })
</script>
@endsection
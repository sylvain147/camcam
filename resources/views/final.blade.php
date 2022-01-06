
<!DOCTYPE html>
<html>
<style>
    .place-container {
        transition-property: font-size;
        transition-duration: 8s;
    }
    .name{
        transition-property: font-size;
        transition-duration: 40s;
    }
</style>
<head>
    <title>Spotify Web Playback SDK Quick Start</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<div class="flex justify-center items-center flex-col mt-10 text-2xl color text-blue-600 welcome">
<span>

    Bienvenue dans la final Top camcam2021
                <input type="text" class="token hidden" value="{{$token}}">

</span>

</div>
<div class="flex justify-center mt-10 text-2xl color text-blue-600 place-container"  style="font-size: 0px">

</div>

<div class="flex justify-center mt-10 text-2xl color text-blue-600 name-container"  style="font-size: 0px">


</div>

<div class="flex justify-center mt-10 start-container ">
    <button class="start bg-blue-600 text-white p-4 rounded-full ">Commencer</button>
</div>

<div class="flex justify-center mt-10 hidden next-container ">
    <button class="next bg-blue-600 text-white p-4 rounded-full ">Suivant</button>
</div>
</body>

<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<script src="https://sdk.scdn.co/spotify-player.js"></script>
<script>

    window.onSpotifyWebPlaybackSDKReady = () => {
        let songs = []
        const player = new Spotify.Player({
            name: 'Web Playback SDK Quick Start Player',
            getOAuthToken: cb => { cb($('.token').val()); },
            volume: 0.5,

        });
        let tt = ''
        let place = 10
        let size = 0


        // Ready
        player.addListener('ready', ({ device_id }) => {
            console.log('ici')
            console.log(device_id)
            tt = device_id
        });

        // Not Ready
        player.connect();
        const play = ({
                          spotify_uri,
                          playerInstance: {
                              _options: {
                                  getOAuthToken
                              }
                          }
                      }) => {
            getOAuthToken(access_token => {
                fetch(`https://api.spotify.com/v1/me/player/play?device_id=${tt}`, {
                    method: 'PUT',
                    body: JSON.stringify({ uris: [spotify_uri] }),
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${$('.token').val()}`
                    },
                });
            });
        };
        function playy(uri){
            let sound = 0.0001
            player.setVolume(sound)

            play({
                playerInstance: player,
                spotify_uri: `spotify:track:${uri}`,
            });
            let id = null
            id = setInterval(()=>{
                player.setVolume(sound)
                if(sound >= 1) {
                    clear(id)
                }
                sound = sound+0.0001
            }, 100)
        }

        function clear(id) {
            clearInterval(id)
        }
        let points
        $('.start').on('click', ()=>{
            $.ajax({
                url : "{{route('calculate-final')}}",
                method : 'POST',
                data :{
                    _token : "{{csrf_token()}}"
                }
            }).then((response)=>{
                $('.welcome').addClass('hidden')
                $('.start-container').addClass('hidden')
                $('.next-container').removeClass('hidden')
                points = response
                findNext()
            })
        })
        $('.next').on('click', () => {
            if(songs.length > 0) {
                runNext()
            }
            else {
                findNext()

            }
        })
        function findNext(){
            place -= size
            $.ajax({
                url: "{{route('find-next')}}",
                data : {
                    points : points
                }
            }).then((response)=>{
                songs = response.songs
                size = response.songs.length
                runNext()
            })
        }
        function runNext(){
            let song = songs.pop()
            console.log(song)
            $('.place-container').html(
                `<div class="name" style="font-size : 0px; transition-property: font-size;
        transition-duration: 8s;">${place}</div>`
            )
            $('.name-container').html(
                `<div class="place" style="font-size : 0px; transition-property: font-size;
transition-timing-function: ease-in;
        transition-duration: 40s;">${song.name} - ${song.artist.name}</div>`
            )
            setTimeout(()=>{
                $('.name').css('font-size','60px')
                $('.place').css('font-size','60px')
            },200)
            playy(song.spotify_id)
            points = song.points
        }
    }
</script>
</html>
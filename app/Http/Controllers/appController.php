<?php

namespace App\Http\Controllers;

use App\Models\artist;
use App\Models\SelectedSong;
use App\Models\song;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class appController extends Controller
{
    public function import(){
        return view('import');
    }

    public function importFile(Request $request){
        $row = 0;
        if (($handle = fopen($request->file('file'), "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $row++;
                if($row == 1) continue;
                $artist_id = $data[1];
                $artist = artist::where('artist_id',$artist_id)->first();
                if(!$artist){
                    $artist = artist::create([
                        'name'=>$data[4],
                        'artist_id'=>$data[1]
                    ]);
                }

                $song =  song::create([
                    'artist_id'=>$artist->id,
                    'name'=>$data[2],
                    'release_date'=>Carbon::parse($data[5])
                ]);
            }
            fclose($handle);
        }
        dd($request->file('file'));
    }

    public function importIds(Request $request){
        $row = 0;
        if (($handle = fopen($request->file('file'), "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $row++;
                if($row == 1) continue;
                $song = song::where('name',$data[2])->first();
                if($song) {
                    $song->spotify_id = $data[0];
                    $song->save();
                }
            }
            fclose($handle);
        }
    }

    public function songs(){
        $user = Auth::user();

        return view('songs',[
            'artists'=>artist::orderBy('name')->get(),
            'user'=>$user,
        ]);
    }

    public function songslist(Request $request){
        $songs = song::when($request->get('search'), function ($query,$search) {
            $query->where('name','like','%'.$search.'%');
        })->when($request->get('artist_id'), function($query,$artist_id){
            $query->where('artist_id',$artist_id);
        })->get();
        $usersongs = Auth::user()->songs->pluck('id')->toArray();

        return view('songlist',['songs'=>$songs,
                    'usersongs'=>$usersongs
        ]);
    }

    public function loginview(){
        return view('login');
    }

    public function saveSong(song  $song){
        Auth::user()->songs()->attach($song);
        return  Auth::user()->songs()->count();
    }

    public function mySongs(){
        return view('my-songs',['songs'=>Auth::user()->songs]);
    }

    public function removeSong(song $song) {
        Auth::user()->songs()->detach($song);
        return  Auth::user()->songs()->count();


    }

    public function rank(){
        $songs = Auth::user()->selecteds;
        return view('rank2',['songs'=>$songs]);
    }

    public function rank2(){
        $songs = Auth::user()->selecteds;
        return view('rank2',['songs'=>$songs]);
    }

    public function saveRank(Request $request){
        $user_id = Auth::id();
        foreach ($request->get('songs') as $idx=>$song){
            SelectedSong::query()
                ->where('user_id',$user_id)
                ->where('song_id',$song)
                ->update(['place'=>$idx]);

        }
    }

    public function selectedSongs(User $user){
        return view('selected-songs',['user'=>$user]);

    }
}

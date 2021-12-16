<?php

namespace App\Http\Controllers;

use App\Models\artist;
use App\Models\song;
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
}

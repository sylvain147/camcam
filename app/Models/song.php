<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class song extends Model
{
    protected $table = 'song';
    use HasFactory;
    public $timestamps=false;
    protected $guarded=[];

    public function artist(){
        return $this->hasOne(artist::class,'id','artist_id');
    }

    public function selectedBy() {
        $id = $this->id;
        return User::query()->whereHas('songs', function ($query) use($id) {
            $query->where('id',$id);
        })->get();
    }
}

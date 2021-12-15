<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artist extends Model
{
    protected $table = 'artist';
    use HasFactory;

    public $timestamps=false;
    protected $guarded=[];
}

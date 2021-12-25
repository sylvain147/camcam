<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedSong extends Model
{
    use HasFactory;
    protected $table = 'selected_songs';
    protected $guarded = [];
    public $timestamps = false;
}

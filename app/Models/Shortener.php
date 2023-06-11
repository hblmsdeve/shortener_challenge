<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shortener extends Model
{
    use HasFactory;
    protected $fillable = [
        'long_url',
        'short_url',
        'clicks',
        'user_id',
    ];
    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->diffForHumans();
    }
    public function getRouteKeyName(){
        return 'short_url';
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YoutubeCategory extends Model
{
protected $fillable =
                ['name',
                 'slug'
                 ];


public function videos(){
    
    return $this->hasMany(YoutubeVideo::class);
}
}

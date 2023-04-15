<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected  $guarded=[];

    use HasFactory;
    public function user(){
//in post motoaleq be che useri hast
        return $this->belongsTo(User::class);

    }
    // be sooorat automatic barat aks haro load mikone dige
    public function setPostImageAttribute($value){
        $this->attributes['post_image'] = asset($value);

    }
    public function getPostImageAttribute($value){
            return asset($value);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}

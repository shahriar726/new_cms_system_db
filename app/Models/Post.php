<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'     => 'title',
                'onUpdate'   => true
            ]
        ];
    }
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
    public function comments(){

        return $this->hasMany(Comment::class);
    }


}

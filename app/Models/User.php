<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded=[];
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //bar inke hame ja dige password man encrypt she
    public function setPasswordAttribute($value){
    $this->attributes['password'] = bcrypt($value);

    }
    public function getAvatarAttribute($value){
        return asset($value);
    }
    public function posts(){
    //in user chand post dard
        return $this->hasMany(Post::class);
    }
    public function post(){

        return $this->hasOne(Post::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getGravatarAttribute(){

        $hash=md5(strtolower(trim($this->attributes['email'])));
        return "https://en.gravatar.com/avatar/$hash";

    }



}

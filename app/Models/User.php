<?php

namespace App\Models;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
    ];
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }
    public function quizzes()
    {
    	return $this->hasMany('App\Models\Quiz');
    }
    public function accomplishment()
    {
    	return $this->hasOne('App\Models\Accomplishment');
    }
    public function results()
    {
    	return $this->hasMany('App\Models\Result');
    }
    public function posts()
    {
    	return $this->hasMany('App\Models\Post');
    }
    public function likes(){
        return $this->hasMany('App\Models\Like');
    }
    public function saves(){
        return $this->hasMany('App\Models\Save');
    }

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

    public function isOnline(){
        return Cache::has('user-is-online-' . $this->id); // this just return true or false about online status. with current user id .
    }
}

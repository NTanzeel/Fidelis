<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

    use SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'dob', 'reputation',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'deleted_at', 'dob',
    ];

    public function followers() {
        return $this->belongsToMany('App\Models\User', 'followers', 'following_id', 'follower_id')
            ->whereNull('followers.deleted_at')
            ->withPivot(['mutual', 'approved', 'deleted_at'])
            ->withTimestamps();
    }

    public function following() {
        return $this->belongsToMany('App\Models\User', 'followers', 'follower_id', 'following_id')
            ->whereNull('followers.deleted_at')
            ->withPivot(['mutual', 'approved', 'deleted_at'])
            ->withTimestamps();
    }

    public function posts() {
        return $this->hasMany('App\Models\Post');
    }

    public function notifications() {
        return $this->hasMany('App\Models\Notification', 'to_id');
    }

    public function subscriptions() {
        return $this->belongsToMany('App\Models\Tag', 'subscriptions', 'user_id', 'tag_id')
            ->whereNull('subscriptions.deleted_at')
            ->withTimestamps();

        //return $this->hasMany('App\Models\Subscription', 'user_id');
    }

    /*Function to return the number of notifications for a user
    public function numOfNotifications() {
        return count($this->hasMany('App\Models\Notification', 'to_id')->where('read', 0));
    }
    */
}
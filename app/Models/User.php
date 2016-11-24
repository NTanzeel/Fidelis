<?php

namespace App\Models;

use App\Http\Traits\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $reputation
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $dob
 * @property boolean $is_private
 * @property string $cover
 * @property string $photo
 * @property string $username
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $followers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $following
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $subscriptions
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\App\Models\Notification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\App\Models\Notification[] $unreadNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\App\Models\Notification[] $readNotifications
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereReputation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDob($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereIsPrivate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePhoto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUsername($value)
 * @mixin \Eloquent
 */
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

    public function posts() {
        return $this->hasMany('App\Models\Post');
    }

    public function subscriptions() {
        return $this->belongsToMany('App\Models\Tag', 'subscriptions', 'user_id', 'tag_id')
            ->whereNull('subscriptions.deleted_at')
            ->withPivot(['id', 'deleted_at'])
            ->withTimestamps();
    }

    public function follows(User $user) {
        return $user && $this->following()->where('following_id', $user->id)->exists();
    }

    public function following() {
        return $this->belongsToMany('App\Models\User', 'followers', 'follower_id', 'following_id')
            ->whereNull('followers.deleted_at')
            ->withPivot(['mutual', 'approved', 'deleted_at'])
            ->withTimestamps();
    }

    public function followedBy(User $user) {
        return $user && $this->followers()->where('follower_id', $user->id)->exists();
    }

    public function followers() {
        return $this->belongsToMany('App\Models\User', 'followers', 'following_id', 'follower_id')
            ->whereNull('followers.deleted_at')
            ->withPivot(['mutual', 'approved', 'deleted_at'])
            ->withTimestamps();
    }

    public function uploadDirectory() {
        return md5($this->username . $this->created_at);
    }
}
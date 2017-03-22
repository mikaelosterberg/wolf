<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable; // Base class.

/**
 * Class User
 *
 * @package App
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $profile
 * @property string $location
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLocation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereProfile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'profile', 'location', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Create user in the database
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function register(array $data)
    {
        // Hash the password, use php preferred defaults.
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return User::create($data);
    }


    /**
     * One User can have many Howls. ORM mapping helper function.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function howl()
    {
        return $this->hasMany(Howl::class);
    }

    /**
     * ORM mapping helper function.
     * The user that follow
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function follow(){
        return $this->hasMany(Follower::class, 'user_id', 'id');
    }

    /**
     * ORM mapping helper function.
     * The user that followed
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function followers()
    {
        return $this->hasMany(Follower::class, 'follow_id', 'id');
    }
}

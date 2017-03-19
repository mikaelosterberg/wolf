<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
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

}

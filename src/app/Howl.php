<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

/**
 * App\Howl
 *
 * @property int $id
 * @property int $user_id
 * @property string $howl
 * @property string $cache
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Howl whereCache($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Howl whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Howl whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Howl whereHowl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Howl whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Howl whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Howl whereUserId($value)
 * @mixin \Eloquent
 */
class Howl extends Model
{
    use SoftDeletes; // Soft delete mixin import.

    /**
     * Mass assignable attributes in this model.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'howl', 'cache'];


    /**
     * a Howl belongs to a user. ORM mapping helper function.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User(){
        return $this->belongsTo(User::class);
    }

    /**
     * Create a new Howl in the database table.
     *
     * @param $userId
     * @param $howl
     * @return Model
     */
    public static function PostHowl($userId, $howl)
    {
        $data = array_merge($howl, ['user_id' => $userId]);
        return Howl::create($data);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param null $user
     */
    public function GetList($limit = 100, $offset = 0, $user = null)
    {

    }


}

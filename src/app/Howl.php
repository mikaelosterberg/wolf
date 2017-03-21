<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Parser;

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
     * Create a new Howl in the database.
     *
     * @param $userId
     * @param $howl
     * @return Model
     */
    public static function PostHowl($userId, $howl)
    {
        $data = array_merge($howl, ['user_id' => $userId]);
        $data['cache'] = Parser::Gethtml($howl['howl']);
        return Howl::create($data);
    }

    /**
     * @param int $limit
     * @param null $user
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function GetList($limit = 25, $user = null)
    {
        /**
         * Hard upper limit of 100.
         */
        if($limit >= 100)
        {
            $limit = 100;
        }
        /**
         * Start ORM query. Paginate by limit and order by created_at, last date first, if we have user limit by user.
         */
        $howl = Howl::orderBy('created_at', 'DESC');
        if($user !== null)
        {
            /**
             * If i get an User Object extract id
             * Else User is an positive numeric.
             * Add user limitation to result.
             */
            if($user instanceof User)
            {
                $howl->where('user_id' ,'=',$user->id);
            }elseif ( (is_numeric($user)) && ($user < 0) ) {
                $howl->where('user_id' ,'=',$user);
            }
        }

        /**
         * Return paginated howls.
         */
        return $howl->paginate($limit);
    }

    /**
     * Get one Howl by ID
     *
     * @param $id
     * @return mixed
     */
    public function getHowl($id)
    {
        return Howl::find($id);
    }


}

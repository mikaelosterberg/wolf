<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Follower
 * @package App
 */
class Follower extends Model
{

    /**
     * Mass assignable attributes in this model.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'follow_id'];


    /**
     * ORM mapping helper function.
     * The user that follow
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function following(){
        return $this->hasOne(User::class, 'id','user_id');
    }

    /**
     * ORM mapping helper function.
     * The user that followed
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function follower()
    {
        return $this->hasOne(User::class, 'id','follow_id');
    }

    /**
     * Do $user_id follow $follow_id.
     *
     * @param $user_id
     * @param $follow_id
     * @return bool
     */
    public static function isFollowing($user_id, $follow_id)
    {
        $relationship = Follower::where('user_id', '=', $user_id)->where('follow_id', '=', $follow_id)->first();
        if(is_null($relationship))
            return false;

        return true;
    }

    /**
     * Toggle that $user_id follows $follow_id.
     * Return true if follows and falls on removal.
     *
     * @param $user_id
     * @param $follow_id
     * @return bool
     */
    public static function toggle($user_id, $follow_id)
    {

        if($user_id == $follow_id)
        {
            return false;
        }
        $relationship = Follower::firstOrCreate(['user_id' => $user_id, 'follow_id' => $follow_id]);

        if($relationship->wasRecentlyCreated)
        {
            return true;
        }

        return !$relationship->delete();

    }

}

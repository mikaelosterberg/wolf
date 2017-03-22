<?php

namespace App\Http\Controllers;

use App\User;
use App\Follower;


/**
 * Class FollowerController
 * @package App\Http\Controllers
 */
class FollowerController extends Controller
{

    /**
     * Setting up auth middleware in constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List the users that $username is following.
     *
     * @param $username
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function following($username)
    {
        $user = User::where("username","=",$username)->firstOrFail();
        $followings = $user->follow()->paginate(50);
        return view('follower.following', compact('followings'));
    }

    /**
     * List the followers for $username.
     *
     * @param $username
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function followers($username)
    {
        $user = User::where("username","=",$username)->firstOrFail();
        $followers = $user->followers()->paginate(50);
        return view('follower.followers', compact('followers'));
    }

    /**
     * Toggle follow status and return back på requesting page.
     *
     * @param $username
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggle($username)
    {
        $me = auth()->user();
        $user = User::where("username","=",$username)->firstOrFail();
        Follower::toggle($me->id, $user->id);
        return redirect()->back();
    }
}

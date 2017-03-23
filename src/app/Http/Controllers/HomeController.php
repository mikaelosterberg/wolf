<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Howl;
use App\Follower;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->guest()) {
            return view('home');
        }else{
            $user = auth()->user();
            $howls = Howl::getFollowingList();
            $follows = Follower::isFollowing(auth()->user()->id, $user->id);
            return view('howl.home', compact('howls', 'user', 'follows'));
        }
    }
}

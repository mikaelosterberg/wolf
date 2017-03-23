<?php

namespace App\Http\Controllers;

use App\Howl;
use App\User;
use App\Follower;
use Illuminate\Http\Request;
use App\Http\Requests\HowlRequest;

/**
 * CRUD Controller to handel Howls
 *
 * Class HowlController
 * @package App\Http\Controllers
 */
class HowlController extends Controller
{

    /**
     * Setting up auth middleware in constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $username
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($username)
    {
        // Throw 404 if unknown user.
        $user = User::where("username","=",$username)->firstOrFail();
        // Get a list of howls.
        $howls = Howl::getList($user);
        $follows = Follower::isFollowing(auth()->user()->id, $user->id);
        return view('howl.index', compact('howls', 'user', 'follows'));
    }

    /**
     * Display the create howl form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('howl.create');
    }

    /**
     * Persist the howl to database.
     *
     * @param HowlRequest $howlRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(HowlRequest $howlRequest)
    {
        $howlRequest->persist();
        $all = $howlRequest->all();
        if(array_key_exists('next', $all))
        {
            switch ($all['next'])
            {
                case 'home':
                    return redirect()->route('home');
                    break;
                case 'me':
                    return redirect()->route('howl.user', ['name' => auth()->user()->username]);
                    break;
            }
        }
        return redirect()->route('home');
    }

    /**
     * Remove the specified howl from database.
     *
     * @param Howl $howl
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Howl $howl)
    {
        if (auth()->user()->id == $howl->user_id) {

            $howl->delete();
            return redirect()->route('home');
        }
        abort(403, 'Unauthorized action.');
    }
}

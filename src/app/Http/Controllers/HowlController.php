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
     *
     *
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
        $howl = $howlRequest->persist();
        return redirect()->route('howl.index');
    }

    /**
     * Display the specified howl.
     *
     * @param Howl $howl
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Howl $howl)
    {
        return view('howl.show', compact('howl'));
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
            return redirect()->route('howl.index');
        }
        abort(403, 'Unauthorized action.');
    }
}

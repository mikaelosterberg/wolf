<?php

namespace App\Http\Controllers;

use App\Howl;
use App\User;
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
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $howls = Howl::GetList();
        return view('howl.index', compact('howls'));
    }

    /**
     * @param $user
     * @param int $limit
     * @param int $offset
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexUser($user, $limit=100)
    {
        // Throw 404 if unknown user.
        $userId = User::where("username","=",$user)->firstOrFail();
        // Get a list of howls.
        $howls = Howl::GetList($limit, $userId);
        return view('howl.index', compact('howls'));
    }

    /**
     * Show the form for creating a new howl.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('howl.create');
    }

    /**
     * Store form data and redirect to show the howl.
     *
     * @param HowlRequest $howlRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(HowlRequest $howlRequest)
    {
        $howl = $howlRequest->persist();
        return redirect()->route('howl.show', ['id' => $howl->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Howl  $howl
     * @return \Illuminate\Http\Response
     */
    public function show(Howl $howl)
    {
        return view('howl.show', compact('howl'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Howl  $howl
     * @return \Illuminate\Http\Response
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

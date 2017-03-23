<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        /**
         * Require a authenticated session on all functions except create and store.
         */
        $this->middleware('auth')->except(['create', 'store']);
    }

    /**
     * Show the form for creating a new authenticated session.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.login');
    }


    /**
     * Attempt to authenticate whit the supplied credentials.
     * On fail; return to from, On Ok; redirect to /me
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        if(auth()->attempt(request(['email','password'])))
        {
            return redirect()->route('home');
        }
        return redirect()->back();
    }

    /**
     * Logout current session.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        auth()->logout();
        return redirect()->route('home');
    }
}

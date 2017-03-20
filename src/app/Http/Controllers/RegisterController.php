<?php

namespace App\Http\Controllers;

use Doctrine\DBAL\Schema\View;
use App\Http\Requests\RegisterRequest;

/**
 * Class RegisterController
 * @package App\Http\Controllers
 */
class RegisterController extends Controller
{
    /*
     * This controller handles the creation of users and request for registration form is made.
     *
     * Form validation is offhanded to the RegisterRequest class that intercepts bad post data
     * before the controller function is called.
     *
     * Through middleware only non-authorized session is allowed.
     *
     */

    /**
     * RegisterController constructor.
     */
    function __construct()
    {
        /**
         * Require a guest session on all functions no exceptions.
         */
        $this->middleware('guest');
    }

    /**
     * Show the form for creating a new user.
     *
     * @return View
     */
    public function create()
    {
        return view('register.form');
    }

    /**
     * Store a newly created user in database.
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegisterRequest $request)
    {
        $request->persist();
        return redirect()->route('me');
    }
}

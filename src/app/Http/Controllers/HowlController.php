<?php

namespace App\Http\Controllers;

use App\Howl;
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
        return view('howl.index');
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
        return view('howl.show', compact($howl));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Howl  $howl
     * @return \Illuminate\Http\Response
     */
    public function edit(Howl $howl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Howl  $howl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Howl $howl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Howl  $howl
     * @return \Illuminate\Http\Response
     */
    public function destroy(Howl $howl)
    {
        $howl->delete()->save();
        return redirect()->route('home');
    }
}

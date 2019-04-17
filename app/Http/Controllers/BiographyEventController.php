<?php

namespace App\Http\Controllers;

use App\BiographyEvent;
use Illuminate\Http\Request;

class BiographyEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return BiographyEvent::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BiographyEvent  $biographyEvent
     * @return \Illuminate\Http\Response
     */
    public function show(BiographyEvent $biographyEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BiographyEvent  $biographyEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(BiographyEvent $biographyEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BiographyEvent  $biographyEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BiographyEvent $biographyEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BiographyEvent  $biographyEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(BiographyEvent $biographyEvent)
    {
        //
    }
}

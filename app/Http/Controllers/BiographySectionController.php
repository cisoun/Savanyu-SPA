<?php

namespace App\Http\Controllers;

use App\BiographySection;
use Illuminate\Http\Request;

class BiographySectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BiographySection::with('events')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return BiographySection::create($request->all())
                               ->with('events')
                               ->first();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BiographySection  $biographySection
     * @return \Illuminate\Http\Response
     */
    public function show(BiographySection $biographySection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BiographySection  $biographySection
     * @return \Illuminate\Http\Response
     */
    public function edit(BiographySection $biographySection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BiographySection  $biographySection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BiographySection $biographySection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BiographySection  $biographySection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $section = BiographySection::find($id);

        foreach ($section->events as $event)
        {
            $event->delete();
        }

        $section->delete();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ArtworkRequest;
use App\Artwork;
use App\Upload;
use App\Video;

class ArtworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Artwork::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtworkRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $artwork = Artwork::create($request->all());

        $isVideo = $request->category_id == 4;

        if (!$isVideo)
        {
            foreach ($request->file('files') as $key => $file)
            {
                $upload = new Upload(['path' => $file->store('public')]);
                $artwork->uploads()->save($upload);
            }
        }

        if ($isVideo)
        {
            $video = new Video(['url' => $request->input('video')]);
            $artwork->video()->save($video);
        }

        return $artwork;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function show(Upload $upload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArtworkRequest $request, $id)
    {
        $artwork = Artwork::find($id);

        if ($artwork->category_id == 4)
        {
            $video = $artwork->video;
            $video->update(['url' => $request->input('video')]);
        }

        return tap($artwork)->update($request->except('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Request  $request
     * @param  Integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $artwork = Artwork::find($id);

        foreach ($artwork->uploads() as $upload)
        {
            $upload->delete();
        }

        $artwork->delete();
    }
}

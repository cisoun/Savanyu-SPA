<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ArtworkRequest;
use App\Artwork;
use App\Upload;
use App\Video;
use Image;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Artwork::orderBy('order', 'desc')->get();
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

        // Compute order.
        $order = 0;
        $highest = DB::table('artworks')
            ->where('category_id', $request->category_id)
            ->max('order');
        // If artwork with the highest order in the same category exists, takes
        // its value and increment it for the new one.
        if ($highest) {
            $order = $highest + 1;
        }
        $data = $request->all();
        $data['order'] = $order;

        $artwork = Artwork::create($data);

        $isVideo = $request->category_id == 4;
        $hasFiles = $request->has('files');

        if (!$isVideo && $hasFiles)
        {
            foreach ($request->file('files') as $key => $file)
            {
                $this->storeFile($artwork, $file);
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

        $isVideo = $request->category_id == 4;
        $hasFiles = $request->has('files');

        if (!$isVideo && $hasFiles)
        {
            foreach ($request->file('files') as $key => $file)
            {
                $this->storeFile($artwork, $file);
            }
        }

        if ($artwork->category_id >= 3)
        {
            $video = $artwork->video;

            if ($video == null)
            {
                $artwork->video()->create([
                    'artwork_id' => $id,
                    'url' => $request->input('video')
                ]);
            }
            else
            {
                $video->update(['url' => $request->input('video')]);
            }
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

        foreach ($artwork->uploads as $upload)
        {
            $upload->delete();
        }

        $artwork->delete();
    }

    private function storeFile($artwork, $file)
    {
        $name = $file->hashName();
        Image::make($file)->fit(50, 50)->save(public_path() . '/storage/min/' . $name);
        $file->storeAs('public', $name);
        $upload = new Upload(['path' => $name]);
        $artwork->uploads()->save($upload);
    }
}

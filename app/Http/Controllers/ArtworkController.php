<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArtworkRequest;
use App\Artwork;
use App\Upload;

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

        foreach ($request->file('files') as $key => $file) {
            $upload = new Upload(['path' => $file->store('public')]);
            $artwork->uploads()->save($upload);
        }



        /*for ($i = 0; ; $i++)
        {
            $file = 'file' . $i;

            if (!$request->hasFile($file))
                break;

            $fileName = sha1(time() + $i);
            $request->file($file)->move('public/uploads', $fileName);

            $upload = new Upload;
            $upload->type = explode('/', mime_content_type('public/uploads/' . $fileName))[0];
            $upload->name = $fileName;
            $upload->save();

            $artworkUpload = new ArtworkUpload;
            $artworkUpload->artwork_id = $artwork->id;
            $artworkUpload->upload_id = $upload->id;
            $artworkUpload->index = $i;
            $artworkUpload->save();
        }*/

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
        foreach ($artwork->uploads() as $upload) {
            $upload->delete();
        }
        $artwork->delete();
    }
}

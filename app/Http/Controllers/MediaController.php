<?php

namespace App\Http\Controllers;

use App\Contracts\MediaContract;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Media::all();

        return view('frontend.index')
            ->with('collection', $collection);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        return view('frontend.show')
            ->with('media', $media);
    }


    /**
     * Sync with the API
     *
     * @return \Illuminate\Http\Response
     */
    public function download(MediaContract $contract, Request $request)
    {
        \DB::table('media')->truncate();

        if(! $contract->sync())
        {
            $request->session()->flash('error','Si è verificato un errore');
        }

        return redirect('/');
    }
}

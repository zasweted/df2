<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $tags = Tag::orderBy('updated_at', 'DESC')->get();

       return view('tag.index', [
        'tags' => $tags
       ]);

    //    return view('tag.index', [
    //     'categories' => tag::orderBy('updated_at', ' DESC')->get
    //    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\HttpRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        tag::create([
            'title' => $request->title
        ]);

        return redirect()->route('t_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(tag $tag)
    {
        return view('tag.show', [
            'tag' => $tag,
            'movie' => Movie::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(tag $tag)
    {
        return view('tag.edit', [
            'tag' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\HttpRequest  $request
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tag $tag)
    {
        // tag::updateOrCreate([
        //     'id' => $tag->id,
        //     'title' => $request->title,
        // ]);
            $tag->update([
                'title' => $request->title
            ]);
        return redirect()->route('t_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(tag $tag)
    {
        

        $tag->delete();

        return redirect()->route('t_index');
    }
}
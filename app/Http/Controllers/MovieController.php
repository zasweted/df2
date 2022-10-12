<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Movie::all()); 
        return view('movie.index', [
            'movies' => Movie::orderBy('updated_at', 'DESC')->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('movie.create', [
            'tags' => Tag::orderBy('title', 'desc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required', 'min:3', 'max:20'],
            'price' => ['required', 'numeric', 'min:1', 'max:100'],
            'photo.*' => ['sometimes', 'required', 'mimes:jpg', 'max:2000']
        ],
        [
            'title.required' => 'Nera tytlo',
            'title.min' => 'Tytlas trumpas',
            'title.max' => 'Tytlas ilgas',
            'price.required' => 'Nieko nekainuoti negali',
            'price.numeric' => 'Turi buti skaicius',
            'price.min' => 'Price trumpas',
            'price.max' => 'Price ilgas',
            'photo.mimes' => 'Netinkamas fotkes formatas',
            'photo.max' => 'Fotke per didele',
        ]);
        
        Movie::create([
            'title' => $request->title,
            'price' => $request->price,
        ])->addImages($request->file('photo'))->addTags($request->tag);

        return redirect()->route('m_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        
        return view('movie.show', [
            'movie' => $movie,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('movie.edit', [
            'movie' => $movie,
            'tags' => Tag::orderBy('title', 'desc')->get(),
            'checkedTags' => $movie->getPivot()->pluck('tag_id')->all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMovieRequest  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $movie->update([
            'title' => $request->title,
            'price' => $request->price,
        ]);
        $movie->deleteImages($request->delete_photo)->addImages($request->file('photo'));

        return redirect()->route('m_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        if($movie->getPhotos()->count()){
            $delIds = $movie->getPhotos()->pluck('id')->all();
            $movie->deleteImages($delIds);

        }

        $movie->delete();
        return redirect()->route('m_index');
    }
}

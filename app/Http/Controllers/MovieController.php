<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\Category;

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
            'movies' => Movie::orderBy('updated_at', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('updated_at', 'DESC')->get();

       return view('movie.create', [
        'categories' => $categories
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
        
        Movie::create([
            'title' => $request->title,
            'price' => $request->price,
            'category_id' => $request->category_id
        ])->addImages($request->file('photo'));

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
            'movie' => $movie

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
            'categories' => Category::orderBy('updated_at', 'DESC')->get()
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
            'category_id' => $request->category_id
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

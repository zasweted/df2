<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function homeList(Request $request)
    {
        //Filter
        if ($request->cat) {
            $movies = Movie::where('category_id', $request->cat)->orderBy('title')->get();
            if($request->sort == 'rate_asc'){
                $movies = $movies->orderBy('rating')->get();
            }else{
                if($request->sort == 'rate_desc'){
                    $movies = $movies->orderBy('rating', 'desc')->get();
                }else{
                    if($request->sort == 'title_asc'){
                        $movies = $movies->orderBy('title')->get();
                    }else{
                        if($request->sort == 'title_desc'){
                            $movies = $movies->orderBy('title', 'desc')->get();
                        }else{
                            if($request->sort == 'price_asc'){
                                $movies = $movies->orderBy('price')->get();
                            }else{
                                if($request->sort == 'price_desc'){
                                    $movies = $movies->orderBy('price', 'desc')->get();
                                }
                            }
                        }
                    }
                }
            }
        }else{
            $movies = Movie::orderBy('title')->get();
        }

        return view('home.index', [
            'movies' => Movie::orderBy('title', 'desc')->get(),
            'categories' => Category::orderBy('title')->get(),
            'cat' => $request->cat ??'0',
            'sort' => $request->sort ??'0',
            'sortSelect' => Movie::SORT_SELECT,
            's' => $request->s ?? ''
        ]);
    }

    public function rate(Request $request, Movie $movie)
    {
        $movie->rating_sum = $movie->rating_sum + $request->rate;
        $movie->rating_count++;
        $movie->rating = $movie->rating_sum / $movie->rating_count;
        $movie->save();

        return redirect()->back();
    }
}

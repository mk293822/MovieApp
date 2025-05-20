<?php

namespace App\Http\Controllers;

use App\Enums\CategorieEnums;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function Pest\Laravel\json;

class MovieController extends Controller
{

    public function getMovies(Request $request, MovieService $movieService)
    {
        $category = $request->get('category', 'All');

        $search_query = $request->get('search_query', '');

        $paginate_movies = $movieService->getMoviesByCategoryAndSearchQuery($category, $search_query);

        $movies =  MovieResource::collection($paginate_movies)->toArray($request);

        return response()->json([
            'movies' => $movies,
            'next_page_url' => $paginate_movies->nextPageUrl(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {

        $movie_find = Movie::forIsPublic()->findOrFail($id);

        $movie = (new MovieResource($movie_find))->toArray($request);
        $related_movies = MovieResource::collection(Movie::forRelatedMovies($movie_find)->forIsPublic()->get())->toArray($request);

        return Inertia::render('Movie/ShowMovie', compact('movie', 'related_movies'));
    }
}

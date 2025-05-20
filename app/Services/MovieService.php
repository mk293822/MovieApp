<?php

namespace App\Services;

use App\Enums\CategorieEnums;
use App\Models\Movie;

class MovieService
{

    public function getMoviesByCategoryAndSearchQuery(string $category, string | null $search_query)
    {
        $get_movies = Movie::forIsPublic();

        if (!empty($search_query)){
            $get_search_movies = collect(Movie::search("$search_query")->get())->pluck('id')->toArray();
            if(!empty($get_search_movies)) {
                $get_movies = $get_movies->whereIn('movies.id', $get_search_movies);
            }
        }

        if ($category !== 'All') {
            $get_movies = $get_movies->forCategories(CategorieEnums::from($category));
        }

        return $get_movies->paginate(20);
    }
}

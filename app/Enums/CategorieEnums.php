<?php

namespace App\Enums;

enum CategorieEnums: string
{
    case Popular = 'views';
    case TopRating = 'rating';
    case NowShowing = 'release_year';
}

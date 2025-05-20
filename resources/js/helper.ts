import { useEffect, useState } from 'react';
import { MovieCategory, MovieGenreEnum } from './types/enums';

export const useDebounce = <T>(value: T, delay: number): T => {
    const [debounceValue, setDebounceValue] = useState<T>(value);

    useEffect(() => {
        const handler = setTimeout(() => setDebounceValue(value), delay);

        return () => clearTimeout(handler);
    }, [value, delay]);

    return debounceValue;
};

export const getMovieGenre = (genre: string) => {
    return Object.keys(MovieGenreEnum).find(
        (key) => MovieGenreEnum[key as keyof typeof MovieGenreEnum] === genre,
    );
};

export const getTab = (tab: string) => {
    let category;
    switch (tab) {
        case 'All':
            category = null;
            break;
        case 'Popular':
            category = MovieCategory.Popular;
            break;
        case 'Top Rating':
            category = MovieCategory.TopRating;
            break;
        case 'Now Showing':
            category = MovieCategory.NowShowing;
            break;
        default:
            category = null;
            break;
    }
    return category;
};

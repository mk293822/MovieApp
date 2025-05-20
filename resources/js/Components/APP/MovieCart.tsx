import { getMovieGenre } from '@/helper';
import { Movie } from '@/types';
import { Link } from '@inertiajs/react';
import { useEffect } from 'react';

// Image Preloading
const preloadedImages: Record<string, HTMLImageElement> = {};

const preloadImage = (src: string) => {
    if (!preloadedImages[src]) {
        const img = new Image();
        img.src = src;
        preloadedImages[src] = img;
    }
};

const MovieCart = ({ movie }: { movie: Movie }) => {
    useEffect(() => {
        preloadImage(movie.poster_path); // Preload the image
    }, [movie.poster_path]);
    return (
        <Link href={route('movie.show', movie.id)}>
            <div className="group w-48 transform overflow-hidden pb-4 transition duration-300 hover:scale-105">
                <div className="relative rounded-sm">
                    <img
                        className="min-h-[286px] w-auto object-contain"
                        src={movie.poster_path}
                        alt="Movie Poster"
                    />
                    <span className="absolute bottom-1 right-1 rounded-lg bg-black p-1 text-sm text-white">
                        ⭐ {movie.rating}/10
                    </span>
                </div>
                <h2 className="mt-1 overflow-hidden text-ellipsis whitespace-nowrap pt-2 text-lg font-bold text-gray-200">
                    {movie.title}
                </h2>
                <div className="max-w-40 text-sm text-gray-400">
                    <span>
                        {getMovieGenre(movie.genre)} •{' '}
                        {new Date(movie.release_year).getFullYear()}
                    </span>
                </div>
            </div>
        </Link>
    );
};

export default MovieCart;

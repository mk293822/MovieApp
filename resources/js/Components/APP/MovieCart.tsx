import { Movie } from '@/types';
import { Link } from '@inertiajs/react';

const MovieCart = ({ movie }: { movie: Movie }) => {
    return (
        <Link href={route('movie.show', movie.id)}>
            <div className="group transform overflow-hidden p-5 transition duration-300 hover:scale-105">
                <div className="relative rounded-sm">
                    <img
                        className="h-60 w-auto object-contain"
                        src={movie.poster_path}
                        alt="Movie Poster"
                    />
                    <span className="absolute bottom-1 right-1 rounded-lg bg-black p-1 text-sm text-white">
                        ⭐ {movie.rating}/10
                    </span>
                </div>
                <h2 className="mt-1 text-xl font-bold text-gray-200">
                    {movie.title}
                </h2>
                <div className="text-sm text-gray-400">
                    <span>
                        {movie.genre} •{' '}
                        {new Date(movie.release_year).getFullYear()}
                    </span>
                </div>
            </div>
        </Link>
    );
};

export default MovieCart;

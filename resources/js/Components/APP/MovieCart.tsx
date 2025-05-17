import { Movie } from '@/types';
import { Link } from '@inertiajs/react';

const MovieCart = ({ movie }: { movie: Movie }) => {
    return (
        <Link href={route('movie.show', movie.id)}>
            <div className="group m-4 transform overflow-hidden rounded-xl bg-stone-800 shadow-lg transition duration-300 hover:scale-105 hover:shadow-xl">
                <img
                    className="h-56 w-full object-cover"
                    src={movie.poster_path}
                    alt="Movie Poster"
                />
                <div className="p-5">
                    <h2 className="text-xl font-bold text-white">
                        {movie.title}
                    </h2>
                    <div className="mt-1 text-sm text-gray-400">
                        <span>
                            {movie.genre} •{' '}
                            {new Date(movie.release_year).getFullYear()}
                        </span>
                    </div>
                    <p
                        className="mt-2 line-clamp-3 text-sm text-gray-300"
                        dangerouslySetInnerHTML={{ __html: movie.description }}
                    />

                    <div className="mt-4 flex items-center justify-between">
                        <span className="text-sm font-semibold text-yellow-400">
                            ★ {movie.rating} / 10
                        </span>
                        <button className="rounded-md bg-blue-600 px-3 py-1.5 text-sm font-medium text-white transition hover:bg-blue-500">
                            View Movie
                        </button>
                    </div>
                </div>
            </div>
        </Link>
    );
};

export default MovieCart;

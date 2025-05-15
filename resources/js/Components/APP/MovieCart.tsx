import { Link } from '@inertiajs/react';

interface Movie {
    id: number;
    title: string;
    category: string;
}

const MovieCart = ({ movie }: { movie: Movie }) => {
    console.log(movie);

    return (
        <Link href={route('movie.show', movie.id)}>
            <div className="group m-4 transform overflow-hidden rounded-xl bg-stone-800 shadow-lg transition duration-300 hover:scale-105 hover:shadow-xl">
                <img
                    className="h-56 w-full object-cover"
                    src="/assets/Cinema_Banner.jpeg"
                    alt="Movie Poster"
                />
                <div className="p-5">
                    <h2 className="text-xl font-bold text-white">
                        The Great Adventure
                    </h2>
                    <div className="mt-1 text-sm text-gray-400">
                        <span>Action • Adventure • 2025</span>
                    </div>
                    <p className="mt-2 line-clamp-3 text-sm text-gray-300">
                        A thrilling journey of courage and discovery as a group
                        of explorers faces the unknown in a mysterious land far
                        from civilization.
                    </p>

                    <div className="mt-4 flex items-center justify-between">
                        <span className="text-sm font-semibold text-yellow-400">
                            ★ 8.5 / 10
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

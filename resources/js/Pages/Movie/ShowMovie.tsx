import MovieCart from '@/Components/APP/MovieCart';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Movie } from '@/types';
import { useRef } from 'react';

const ShowMovie = ({ movie }: { movie: Movie }) => {
    const videoRef = useRef<HTMLVideoElement | null>(null);

    return (
        <AuthenticatedLayout>
            <div className="w-full bg-black text-white">
                {/* Movie Frame */}
                <div className="relative h-[80vh] w-full overflow-hidden">
                    <video
                        ref={videoRef}
                        className="h-full w-full"
                        src={movie.file_path}
                        controls
                        poster={movie.poster_path}
                    />
                </div>

                {/* Movie Details */}
                <div className="ms-10 max-w-4xl space-y-2 p-6">
                    <h1 className="text-3xl font-bold">{movie.title}</h1>
                    <p
                        className="text-gray-300"
                        dangerouslySetInnerHTML={{ __html: movie.description }}
                    />
                    <p className="font-medium text-yellow-400">
                        ⭐ {movie.rating}/10
                    </p>
                </div>

                {/* Related Movies */}
                <div className="mx-auto max-w-6xl p-6">
                    <h2 className="mb-4 text-xl font-semibold">
                        Related Movies
                    </h2>
                    <div className="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                        <MovieCart movie={movie} />
                        <MovieCart movie={movie} />
                        <MovieCart movie={movie} />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default ShowMovie;

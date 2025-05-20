import MovieCart from '@/Components/APP/MovieCart';
import { getMovieGenre } from '@/helper';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Movie } from '@/types';
import { useRef } from 'react';

const ShowMovie = ({
    movie,
    related_movies,
}: {
    movie: Movie;
    related_movies: Movie[];
}) => {
    const videoRef = useRef<HTMLVideoElement | null>(null);

    const hadleSeeking = () => {
        console.log('hahah');
    };
    return (
        <AuthenticatedLayout>
            <div className="w-full overflow-x-hidden bg-stone-900 text-white">
                {/* Movie Frame */}
                <div className="relative h-[80vh] w-full overflow-hidden">
                    <video
                        ref={videoRef}
                        className="h-full w-full"
                        controls
                        onSeekingCapture={hadleSeeking}
                        poster={movie.cover_path}
                        controlsList="nodownload"
                    >
                        <source src={movie.file_path} type="video/mp4" />
                        Your browser does not support the video tag.
                    </video>
                </div>

                {/* Movie Details */}
                <div className="w-screen space-y-2 p-6 ps-10">
                    <h1 className="text-3xl font-bold">{movie.title}</h1>
                    <p
                        className="text-gray-300"
                        dangerouslySetInnerHTML={{ __html: movie.description }}
                    />
                    <p className="font-medium text-yellow-400">
                        ⭐ {movie.rating}/10
                    </p>
                    <span>
                        {movie.language} • {getMovieGenre(movie.genre)} •{' '}
                        {new Date(movie.release_year).getFullYear()}
                    </span>
                </div>

                {/* Related Movies */}
                <div className="mx-auto w-full p-6">
                    <h2 className="mb-4 text-xl font-semibold">
                        {related_movies.length > 0
                            ? 'Related Movies'
                            : 'No Related Movies Found'}
                    </h2>
                    <div className="grid grid-cols-[repeat(auto-fill,minmax(180px,1fr))] gap-4">
                        {related_movies.map((movie) => (
                            <MovieCart movie={movie} key={movie.id} />
                        ))}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default ShowMovie;

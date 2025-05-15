import MovieCart from '@/Components/APP/MovieCart';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { useRef } from 'react';

const ShowMovie = () => {
    const videoRef = useRef<HTMLVideoElement | null>(null);

    const movie = {
        id: 1,
        title: 'haha',
        category: 'haha',
    };

    return (
        <AuthenticatedLayout>
            <div className="w-full bg-black text-white">
                {/* Movie Frame */}
                <div className="relative h-[60vh] w-full overflow-hidden">
                    <video
                        ref={videoRef}
                        className="h-full w-full object-cover"
                        src="https://www.youtube.com/watch?v=7mQq2VNRGp4&list=RD7mQq2VNRGp4&start_radio=1"
                        controls
                        poster="/assets/Cinema_Banner.jpeg"
                    />
                </div>

                {/* Movie Details */}
                <div className="mx-auto max-w-4xl space-y-2 p-6">
                    <h1 className="text-3xl font-bold">The Great Adventure</h1>
                    <p className="text-gray-300">
                        A thrilling journey of courage and discovery in a world
                        of unknown dangers. Join our hero as they face
                        challenges, uncover secrets, and redefine what it means
                        to be brave.
                    </p>
                    <p className="font-medium text-yellow-400">⭐ 8.5/10</p>
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

import MovieCart from '@/Components/APP/MovieCart';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Movie } from '@/types';
import { Head } from '@inertiajs/react';
import clsx from 'clsx';
import { useEffect, useRef, useState } from 'react';

const categories = ['All', 'Popular', 'Top Rating', 'Now Showing', 'Upcoming'];

export default function Dashboard({ movies }: { movies: Movie[] }) {
    const [activeTab, setActiveTab] = useState(categories[0]);
    const [visibleCount, setVisibleCount] = useState(9);
    const loaderRef = useRef(null);

    // const dummyMovies: Movie[] = [...movies, { category: 'all' }];

    // const filteredMovies = dummyMovies.filter((m) => m.category === activeTab);
    const visibleMovies = movies.slice(0, visibleCount);

    useEffect(() => {
        const observer = new IntersectionObserver(
            (entries) => {
                if (entries[0].isIntersecting) {
                    setVisibleCount((prev) => prev + 6);
                }
            },
            { threshold: 1.0 },
        );

        if (loaderRef.current) {
            observer.observe(loaderRef.current);
        }
        return () => {
            if (loaderRef.current) observer.unobserve(loaderRef.current);
        };
    }, [loaderRef, activeTab]);

    useEffect(() => {
        setVisibleCount(9);
    }, [activeTab]);

    return (
        <AuthenticatedLayout>
            <Head title="Dashboard" />

            <div className="py-6">
                {/* Tabs */}
                <div className="mx-8 mb-4 flex justify-between">
                    <div className="flex gap-2">
                        {categories.map((category) => (
                            <button
                                key={category}
                                onClick={() => setActiveTab(category)}
                                className={clsx(
                                    'rounded-full px-4 py-2 text-sm font-semibold transition-all duration-200',
                                    activeTab === category
                                        ? 'bg-indigo-600 text-white shadow-md'
                                        : 'bg-gray-200 text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600',
                                )}
                            >
                                {category}
                            </button>
                        ))}
                    </div>
                    <select
                        name="type"
                        className="rounded-lg bg-gray-700 text-white"
                    >
                        <option value="">Filter By Type</option>
                    </select>
                </div>

                {/* Movie Cards */}
                <div className="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
                    {visibleMovies.map((movie) => (
                        <MovieCart key={movie.id} movie={movie} />
                    ))}
                </div>

                {/* Loader Trigger */}
                {visibleCount < movies.length && (
                    <div ref={loaderRef} className="h-10"></div>
                )}
            </div>
        </AuthenticatedLayout>
    );
}

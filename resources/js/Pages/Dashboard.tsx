import MovieCart from '@/Components/APP/MovieCart';
import { getTab, useDebounce } from '@/helper';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Movie } from '@/types';
import { Head } from '@inertiajs/react';
import axios from 'axios';
import clsx from 'clsx';
import Fuse from 'fuse.js';
import { useCallback, useEffect, useMemo, useState } from 'react';
import { useInView } from 'react-intersection-observer';

const categories = ['All', 'Popular', 'Top Rating', 'Now Showing'];

export default function Dashboard() {
    const [activeTab, setActiveTab] = useState(categories[0]);
    const [movies, setMovies] = useState<Movie[]>([]);
    const [page, setPage] = useState(1);
    const [hasMore, setHasMore] = useState(true);
    const { ref, inView } = useInView();
    const [searchQuery, setSearchQuery] = useState('');
    const debounceQuery = useDebounce(
        searchQuery === '' ? null : searchQuery,
        1000,
    );
    const debounceInView = useDebounce(inView, 1000);

    const fetchMovies = useCallback(
        async ({
            category,
            is_start = false,
            searchQuery = null,
        }: {
            category: string | null;
            is_start?: boolean;
            searchQuery?: string | number | null;
        }) => {
            if (!hasMore && !is_start) return;
            try {
                const response = await axios.get(route('movie.get'), {
                    params: {
                        page: is_start ? 1 : page,
                        category: category,
                        search_query: searchQuery,
                    },
                });
                const newMovies: Movie[] = await response.data.movies;
                setMovies((prev) => [
                    ...prev,
                    ...newMovies.filter(
                        (movie) => !prev.some((m) => m.id === movie.id),
                    ),
                ]);
                setHasMore(response.data.next_page_url !== null);
                const next_page = response.data.next_page_url;
                if (next_page !== null) {
                    const url = new URL(next_page);
                    const page_url = url.searchParams.get('page');
                    setPage(Number(page_url));
                }
            } catch (err) {
                console.error('Failed to fetch movies:', err);
            }
        },
        [page, hasMore],
    );

    useEffect(() => {
        setPage(1);
        setHasMore(true);
        setMovies([]);
        fetchMovies({
            category: getTab(activeTab),
            is_start: true,
            searchQuery: debounceQuery,
        });
    }, [activeTab, debounceQuery]);

    useEffect(() => {
        if (debounceInView) {
            fetchMovies({ category: getTab(activeTab) });
        }
    }, [debounceInView]);

    const fuse = useMemo(() => {
        return new Fuse(movies, {
            keys: ['title', 'description', 'director', 'genre', 'language'],
            threshold: 1,
        });
    }, [movies]);

    const filteredMovies = useMemo(() => {
        return searchQuery
            ? fuse.search(searchQuery).map((query) => query.item)
            : movies;
    }, [searchQuery, movies, fuse]);

    return (
        <AuthenticatedLayout>
            <Head title="Dashboard" />

            <div className="w-full py-6">
                {/* Tabs */}
                <div className="mx-8 mb-4 flex justify-between">
                    <div className="flex gap-2">
                        {categories.map((category) => (
                            <button
                                key={category}
                                onClick={() => {
                                    setActiveTab(category);
                                    setMovies([]);
                                }}
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
                    <div className="flex flex-1 items-center justify-end gap-2">
                        <div className="relative w-full max-w-xs md:max-w-sm">
                            <svg
                                className="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400 dark:text-gray-500"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth={2}
                                    d="M21 21l-4.35-4.35M16.65 16.65A7.5 7.5 0 1116.65 2a7.5 7.5 0 010 15z"
                                />
                            </svg>
                            <input
                                type="search"
                                placeholder="Search..."
                                value={searchQuery}
                                onChange={(e) => setSearchQuery(e.target.value)}
                                className="w-full rounded-lg border border-gray-300 bg-black/70 py-2 pl-10 pr-4 text-sm font-bold text-gray-100 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:placeholder-gray-500"
                            />
                        </div>
                    </div>
                </div>

                <div className="mx-auto w-full p-6">
                    <div className="grid grid-cols-[repeat(auto-fill,minmax(180px,1fr))] gap-4">
                        {filteredMovies.map((movie) => (
                            <MovieCart key={movie.id} movie={movie} />
                        ))}
                    </div>
                </div>
                {/* Load More Trigger */}
                {hasMore && (
                    <div
                        ref={ref}
                        className="flex h-10 w-full items-center justify-center"
                    >
                        <span>Loading more...</span>
                    </div>
                )}
            </div>
        </AuthenticatedLayout>
    );
}

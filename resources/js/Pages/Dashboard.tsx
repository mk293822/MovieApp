import MovieCart from '@/Components/APP/MovieCart';
import SubNavBar from '@/Components/APP/SubNavBar';
import { getTab, useDebounce } from '@/helper';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Movie } from '@/types';
import { Head } from '@inertiajs/react';
import axios from 'axios';
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
            threshold: 0.5,
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
                <SubNavBar
                    categories={categories}
                    activeTab={activeTab}
                    searchQuery={searchQuery}
                    onSearchQueryChange={(e) => setSearchQuery(e.target.value)}
                    onCategoryClick={(category) => {
                        setActiveTab(category);
                        setMovies([]);
                    }}
                />

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
                        className="flex h-10 w-full items-center justify-center text-2xl font-extrabold text-white"
                    >
                        <span className="flex items-center gap-2 text-gray-500">
                            <div className="h-7 w-7 animate-spin rounded-full border-4 border-blue-500 border-r-transparent"></div>
                            Loading more.....
                        </span>
                    </div>
                )}
                {!hasMore && (
                    <div className="flex h-10 w-full items-center justify-center text-2xl font-extrabold text-white">
                        No More Movies
                    </div>
                )}
            </div>
        </AuthenticatedLayout>
    );
}

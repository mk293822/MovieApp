import clsx from 'clsx';
import React from 'react';

interface Props {
    categories: string[];
    onCategoryClick: (category: string) => void;
    activeTab: string;
    searchQuery: string | number;
    onSearchQueryChange: (e: React.ChangeEvent<HTMLInputElement>) => void;
}

const SubNavBar = ({
    categories,
    activeTab,
    searchQuery,
    onCategoryClick,
    onSearchQueryChange,
}: Props) => {
    return (
        <div className="mx-8 mb-4 flex justify-between">
            <div className="flex gap-2">
                {categories.map((category) => (
                    <button
                        key={category}
                        onClick={() => onCategoryClick(category)}
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
                        onChange={onSearchQueryChange}
                        className="w-full rounded-lg border border-gray-300 bg-black/70 py-2 pl-10 pr-4 text-sm font-bold text-gray-100 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:border-gray-600 dark:placeholder-gray-500"
                    />
                </div>
            </div>
        </div>
    );
};

export default SubNavBar;

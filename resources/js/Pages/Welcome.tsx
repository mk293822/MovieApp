import { PageProps } from '@/types';
import { Head, Link } from '@inertiajs/react';

export default function Welcome({
    laravelVersion,
    phpVersion,
}: PageProps<{ laravelVersion: string; phpVersion: string }>) {
    return (
        <>
            <Head title="Welcome" />
            <div className="relative min-h-screen overflow-hidden bg-white text-gray-700 dark:bg-black dark:text-white">
                {/* Background SVG */}
                <img
                    className="pointer-events-none absolute left-0 top-0 z-10 w-full max-w-[877px]"
                    src="https://laravel.com/assets/img/welcome/background.svg"
                    alt=""
                />

                <img
                    src="/assets/Cinema_Banner.jpeg"
                    className="pointer-events-none absolute -right-56 top-20 w-screen -rotate-[60deg] object-fill opacity-30"
                    alt=""
                />

                {/* Navbar */}
                <header className="relative z-10 mt-4 flex items-center justify-between px-6 py-4 lg:px-12">
                    <img
                        src="/assets/RoI6R101.svg"
                        alt="Logo"
                        className="h-16"
                    />
                    <nav className="space-x-4">
                        <Link
                            href={route('login')}
                            className="rounded-md px-4 py-2 text-xl font-bold text-gray-700 hover:bg-gray-200 dark:text-white dark:hover:bg-white/10"
                        >
                            Log in
                        </Link>
                        <Link
                            href={route('register')}
                            className="rounded-md bg-[#FF2D20] px-4 py-2 text-xl font-bold text-white hover:bg-[#e0271d]"
                        >
                            Sign up
                        </Link>
                    </nav>
                </header>

                {/* Hero Content */}
                <main className="relative z-10 flex flex-col items-center justify-center px-6 py-20 text-center lg:py-24">
                    <h1 className="text-4xl font-bold leading-tight tracking-tight text-black sm:text-5xl lg:text-6xl dark:text-white">
                        Welcome To <br />
                        <span className="bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 bg-clip-text text-transparent drop-shadow-md">
                            FAUGET{' '}
                            <span className="font-extralight tracking-widest">
                                THEATRE
                            </span>
                        </span>
                    </h1>

                    <p className="mt-4 max-w-xl text-lg text-gray-600 dark:text-gray-300">
                        Discover and track your favorite movies.
                    </p>
                    <Link
                        href={route('login')}
                        className="mt-8 inline-block rounded-md bg-[#FF2D20] px-6 py-3 font-semibold text-white transition hover:bg-[#e0271d]"
                    >
                        Get Started
                    </Link>
                </main>

                {/* Footer */}
                <footer className="absolute bottom-0 z-10 mx-auto w-screen py-6 text-center text-sm text-gray-500 dark:text-white/50">
                    Laravel v{laravelVersion} (PHP v{phpVersion})
                </footer>
            </div>
        </>
    );
}

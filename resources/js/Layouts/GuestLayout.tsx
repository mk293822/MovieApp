import { Link } from '@inertiajs/react';
import { PropsWithChildren } from 'react';

export default function Guest({ children }: PropsWithChildren) {
    return (
        <div className="relative flex min-h-screen flex-col items-center overflow-hidden bg-gray-100 pt-6 sm:justify-center sm:pt-0 dark:bg-black">
            {/* Background SVG */}
            <img
                className="pointer-events-none fixed left-0 top-0 w-full max-w-[877px]"
                src="/assets/laravel_background.svg"
                alt=""
            />

            <img
                src="/assets/Cinema_Banner.jpeg"
                className="pointer-events-none fixed -right-56 top-20 w-screen -rotate-[60deg] object-fill opacity-30"
                alt=""
            />

            <div className="z-10 mt-6 w-full overflow-hidden bg-white px-6 py-6 shadow-md sm:max-w-md sm:rounded-lg dark:bg-white/20">
                <div className="h-20 w-full">
                    <Link href="/">
                        <img
                            src="/assets/RoI6R101.svg"
                            alt="Logo"
                            className="mx-auto h-16 object-center"
                        />
                    </Link>
                </div>
                {children}
            </div>
        </div>
    );
}

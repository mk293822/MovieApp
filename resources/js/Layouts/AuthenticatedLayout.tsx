import NavBar from '@/Components/APP/NavBar';
import { PropsWithChildren } from 'react';

export default function AuthenticatedLayout({
    children,
}: PropsWithChildren<Readonly<object>>) {
    return (
        <div className="relative min-h-screen overflow-hidden bg-gray-100 dark:bg-black">
            {/* Background SVG */}
            <img
                className="pointer-events-none fixed left-0 top-0 w-full max-w-[877px]"
                src="/assets/laravel_background.svg"
                alt=""
            />

            <img
                src="/assets/Cinema_Banner.jpeg"
                className="pointer-events-none fixed -right-80 top-20 w-screen -rotate-[60deg] object-fill opacity-30"
                alt=""
            />

            <main className="relative z-10 mt-20 min-h-screen overflow-y-auto">
                <NavBar />
                {children}
            </main>
        </div>
    );
}

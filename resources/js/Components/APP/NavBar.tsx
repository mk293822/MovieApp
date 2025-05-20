import { Link, usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import ApplicationLogo from '../ApplicationLogo';
import Dropdown from '../Dropdown';

const NavBar = () => {
    const user = usePage().props.auth.user;
    const [scrollingUp, setScrollingUp] = useState(true);
    const [lastScrollY, setLastScrollY] = useState(0);

    useEffect(() => {
        const handleScroll = () => {
            const currentScrollY = window.scrollY;
            setScrollingUp(currentScrollY < lastScrollY || currentScrollY < 10);
            setLastScrollY(currentScrollY);
        };

        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, [lastScrollY]);

    return (
        <nav
            className={`fixed top-0 z-50 w-full transform bg-black/70 py-2 shadow-md shadow-black/70 backdrop-blur transition-transform duration-300 ${
                scrollingUp ? 'translate-y-0' : '-translate-y-full'
            }`}
        >
            <div className="mx-4 flex h-16 justify-between md:mx-6 lg:mx-8">
                <div className="flex">
                    <div className="flex shrink-0 items-center">
                        <Link href={route('dashboard')}>
                            <ApplicationLogo className="h-12 w-12 fill-gray-400" />
                        </Link>
                    </div>
                </div>

                <div className="flex min-w-[40%] items-center justify-end">
                    <div className="relative ms-3">
                        <Dropdown>
                            <Dropdown.Trigger>
                                <span className="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        className="inline-flex items-center text-nowrap rounded-md border border-transparent bg-black/70 px-3 py-2 text-sm font-medium leading-4 text-gray-400 transition duration-150 ease-in-out hover:text-gray-300 focus:outline-none"
                                    >
                                        {user.name}

                                        <svg
                                            className="-me-0.5 ms-2 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fillRule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clipRule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </Dropdown.Trigger>

                            <Dropdown.Content>
                                <Dropdown.Link href={route('profile.edit')}>
                                    Profile
                                </Dropdown.Link>
                                <Dropdown.Link
                                    href={route('logout')}
                                    method="post"
                                    as="button"
                                >
                                    Log Out
                                </Dropdown.Link>
                            </Dropdown.Content>
                        </Dropdown>
                    </div>
                </div>
            </div>
        </nav>
    );
};

export default NavBar;

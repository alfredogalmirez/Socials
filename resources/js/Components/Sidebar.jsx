import React from 'react'
import { Link, usePage, router } from '@inertiajs/react'

const Sidebar = () => {
    const { auth } = usePage().props;
    const { url } = usePage();

    const isActive = (path) => url === path;

    const handleLogout = (e) => {
        e.preventDefault();

        router.post(route('logout.logout'));
    }

    return (
        <div className="hidden md:flex flex-col items-center h-full w-full py-8 px-5 bg-white border-r border-slate-200/60 sticky top-0">
            {/* Logo Section */}
            <div className="w-full px-4 mb-10">
                <div className="text-3xl font-black text-accent tracking-tighter italic">
                    S<span className="text-slate-300">.</span>
                </div>
            </div>

            {/* Navigation Links */}
            <nav className="flex-1 w-full space-y-2">
                <Link
                    href={route('home')}
                    className={`group flex items-center w-full px-4 py-3.5 rounded-2xl font-bold transition-all ${isActive('/')
                            ? 'bg-accent/10 text-accent'
                            : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50'
                        }`}
                >
                    <span className="flex items-center">
                        {isActive('/') && <span className="w-1.5 h-1.5 rounded-full bg-accent mr-3"></span>}
                        <span className={!isActive('/') ? 'pl-4' : ''}>Home</span>
                    </span>
                </Link>

                <Link
                    href={auth.user ? route('profile.show', auth.user.username) : '#' }
                    className={`flex items-center w-full px-4 py-3.5 rounded-2xl font-semibold transition-all ${url.startsWith('/profile')
                            ? 'bg-accent/10 text-accent'
                            : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50'
                        }`}
                >
                    {url.startsWith('/profile') && <span className="w-1.5 h-1.5 rounded-full bg-accent mr-3"></span>}
                    <span className={!url.startsWith('/profile') ? 'pl-4' : ''}>Profile</span>
                </Link>

                <Link
                    href={route('notifications.index')}
                    className={`flex items-center w-full px-4 py-3.5 rounded-2xl font-semibold transition-all ${url.startsWith('/notifications')
                            ? 'bg-accent/10 text-accent'
                            : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50'
                        }`}
                >
                    {url.startsWith('/notifications') && <span className="w-1.5 h-1.5 rounded-full bg-accent mr-3"></span>}
                    <span className={!url.startsWith('/notifications') ? 'pl-4' : ''}>Notifications</span>
                </Link>
            </nav>

            {/* Auth Section (Logout) */}
            {auth.user && (
                <div className="w-full pt-6 border-t border-slate-100">
                    <button
                        onClick={handleLogout}
                        className="w-full bg-slate-900 text-white py-3.5 rounded-2xl font-bold shadow-lg hover:bg-black transition-all active:scale-[0.97] cursor-pointer"
                    >
                        Logout
                    </button>
                </div>
            )}
        </div>
    )
}

export default Sidebar

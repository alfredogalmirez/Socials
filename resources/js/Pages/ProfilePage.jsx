import BottomNav from '@/Components/BottomNav';
import Sidebar from '@/Components/Sidebar';
import { Head, router, useForm } from '@inertiajs/react'
import React from 'react'

const ProfilePage = ({ auth, profileUser, isFollowing }) => {
    const { post } = useForm();
    const isOwnProfile = auth.user?.id === profileUser.id;

    const handleLogout = (e) => {
        e.preventDefault();
        post(route('logout.logout'));
    }

    return (
        <div className="flex min-h-screen bg-slate-50">
            <Head title="Profile" />

            {/* 1. LEFT SIDEBAR: Fixed and independent */}
            <div className="hidden md:block w-64 bg-white border-r border-slate-200 sticky top-0 h-screen">
                <Sidebar />
            </div>

            {/* 2. MAIN CONTENT AREA: Scrollable */}
            <main className="flex-1">
                <div className="max-w-5xl mx-auto px-4 py-8">

                    {/* 3. BENTO GRID: Now it has the full width of the main area */}
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6">

                        {/* PROFILE INFO CARD (Tall) */}
                        <div className="md:col-span-1 md:row-span-2 bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col items-center justify-center text-center">
                            <div className="w-32 h-32 bg-indigo-600 rounded-4xl mb-6 flex items-center justify-center text-4xl font-bold text-white shadow-xl shadow-indigo-100 rotate-3 overflow-hidden">
                                {profileUser.avatar ? (
                                    <img src={profileUser.avatar} className="w-full h-full object-cover" alt="" />
                                ) : (
                                    <span>{profileUser.initial}</span>
                                )}
                            </div>
                            <h2 className="text-2xl font-black text-slate-900 tracking-tight">{profileUser.name}</h2>
                            <p className="text-indigo-600 font-bold text-sm">@{profileUser.username}</p>

                            {/* Follow/Edit Button Logic */}
                            <button
                                onClick={() => isOwnProfile ? router.get(route('profile.edit')) : post(route('follow.toggle', profileUser.id))}
                                className={`mt-8 w-full py-4 text-xs font-black uppercase tracking-widest rounded-2xl transition-all active:scale-95 shadow-lg ${isOwnProfile ? 'bg-slate-900 text-white' : (isFollowing ? 'bg-slate-200 text-slate-700' : 'bg-blue-600 text-white')
                                    }`}
                            >
                                {isOwnProfile ? 'Edit Profile' : (isFollowing ? 'Unfollow' : 'Follow')}
                            </button>


                            <button onClick={handleLogout} className="md:hidden bg-slate-100 text-slate-500 active:bg-slate-200 mt-8 w-full py-4 text-xs uppercase tracking-widest rounded-2xl transition-all active:scale-95 shadow-lg">Logout</button>

                        </div>

                        {/* STATS CARD (Wide) */}
                        <div className="md:col-span-2 bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex items-center justify-around">
                            <div className="text-center">
                                <span className="block text-4xl font-black text-slate-900">{profileUser.posts_count}</span>
                                <span className="text-slate-400 text-[10px] uppercase font-bold tracking-widest">Posts</span>
                            </div>
                            <div className="h-12 w-px bg-slate-100"></div>
                            <div className="text-center">
                                <span className="block text-4xl font-black text-slate-900">{profileUser.total_likes}</span>
                                <span className="text-slate-400 text-[10px] uppercase font-bold tracking-widest">Total Likes</span>
                            </div>
                        </div>

                        {/* MEMBER SINCE CARD (Small) */}
                        <div className="bg-indigo-600 p-8 rounded-[2.5rem] shadow-xl shadow-indigo-100 text-white flex flex-col justify-center relative overflow-hidden">
                            <p className="text-indigo-200 text-[10px] uppercase font-black tracking-widest mb-1">Member Since</p>
                            <p className="text-2xl font-bold">{profileUser.member_since}</p>
                        </div>

                        {/* RECENT POSTS BOX (Large) */}
                        <div className="md:col-span-2 bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                            <h3 className="text-xs font-black text-slate-400 uppercase tracking-widest mb-6">Recent Activity</h3>
                            <div className="grid gap-4">
                                {profileUser.posts.map(post => (
                                    <div key={post.id} className="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                        <p className="text-slate-600 text-sm">{post.content}</p>
                                        <div className="mt-2 text-[10px] font-bold text-slate-400"><i className="fa-solid fa-heart text-red-500"></i> {post.likes_count}</div>
                                    </div>
                                ))}
                            </div>
                        </div>

                    </div>
                </div>
            </main>

            <BottomNav />
        </div>
    )
}

export default ProfilePage

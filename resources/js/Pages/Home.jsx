import FlashMessage from '@/Components/FlashMessage';
import Sidebar from '@/Components/Sidebar';
import { useForm, usePage, router, Link, Head } from '@inertiajs/react'
import { comment } from 'postcss';
import React, { useState } from 'react'

const Home = ({ posts }) => {
    const { auth } = usePage().props;

    const { data, setData, post, processing, errors, reset } = useForm({
        content: '',
        image: null,
    });

    const [imagePreview, setImagePreview] = useState(null);

    const handleImageChange = (e) => {
        const file = e.target.files[0];
        if (file) {
            setData('image', file);
            setImagePreview(URL.createObjectURL(file));
        }
    };

    const removeImage = () => {
        setData('image', null);
        setImagePreview(null);
    };

    const submitPost = (e) => {
        e.preventDefault();
        post(route('posts.store'), {
            onSuccess: () => {
                reset();
                setImagePreview(null);
            }
        });
    }

    if (!auth.user) return <div>Please log in. </div>

    return (
        <>
            <div className="flex min-h-screen bg-slate-50">
                <Head title="Feed" />

                <div className="w-full grid grid-cols-1 md:grid-cols-12">
                    <FlashMessage />

                    <div className="hidden md:block w-64 md:col-span-3 bg-white border-r border-slate-200 sticky top-0 h-screen">
                        <Sidebar />
                    </div>

                    <main className="col-span-12 md:col-start-4 md:col-span-9 py-8 px-8 flex justify-center">
                        <div className="max-w-[600px] w-full">

                            {/* Header */}
                            <div className="mb-8">
                                <h1 className="text-3xl font-black text-slate-900 tracking-tight leading-none">
                                    Hey, {auth.user.name}<span className="text-accent">!</span>
                                </h1>
                                <p className="text-slate-500 font-medium mt-2">Here's what's happening in your circle today.</p>
                            </div>

                            {/* Create Post Form */}
                            <div className="bg-white rounded-3xl p-6 mb-8 shadow-bento border border-slate-100">
                                <form onSubmit={submitPost}>
                                    <div className="flex items-start space-x-4">
                                        <img
                                            src={auth.user.avatar ? `/storage/${auth.user.avatar}` : `https://ui-avatars.com/api/?name=${auth.user.name}&background=8b5cf6&color=fff`}
                                            className="w-12 h-12 rounded-2xl object-cover"
                                        />
                                        <textarea
                                            value={data.content}
                                            onChange={e => setData('content', e.target.value)}
                                            className="flex-1 border-none focus:ring-0 resize-none text-lg font-normal placeholder-slate-400 min-h-20"
                                            placeholder="What's happening?"
                                        ></textarea>
                                    </div>

                                    {errors.content && <span className="text-red-500 text-sm ml-16 block">{errors.content}</span>}

                                    {imagePreview && (
                                        <div className="mt-4 ml-16 relative group">
                                            <img src={imagePreview} className="max-h-64 rounded-2xl border border-slate-100 object-cover shadow-sm" />
                                            <button type="button" onClick={removeImage} className="absolute top-2 left-2 bg-white/80 backdrop-blur-md p-1.5 rounded-full text-red-500">
                                                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                            </button>
                                        </div>
                                    )}

                                    <div className="flex item-center justify-between mt-2 ml-16 border-t border-slate-50 pt-3">
                                        <label className="cursor-pointer p-2 rounded-full hover:bg-slate-100 text-indigo-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" className="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <input type="file" className="hidden" onChange={handleImageChange} />
                                        </label>

                                        <button
                                            disabled={processing}
                                            type="submit"
                                            className="bg-accent text-white font-bold rounded-xl px-6 py-2.5 hover:bg-purple-700 transition-all shadow-md active:scale-95 disabled:opacity-50"
                                        >
                                            Post
                                        </button>
                                    </div>
                                </form>
                            </div>

                            {/* Posts Feed */}
                            <div className="space-y-6">
                                {posts.data.length > 0 ? (
                                    posts.data.map(post => (
                                        <PostCard key={post.id} post={post} authId={auth.user.id} />
                                    ))
                                ) : (
                                    <div className="bg-slate-50 rounded-3xl p-12 text-center border-2 border-dashed border-slate-200">
                                        <p className="text-slate-400 font-medium">No posts here yet...</p>
                                    </div>
                                )}
                            </div>
                        </div>
                    </main>

                </div >
            </div >

        </>
    )
}

function PostCard({ post, authId }) {
    const [showReply, setShowReply] = useState(false);

    const { data, setData, post: submit, error } = useForm({
        post_id: post.id,
        content: '',
    });

    const submitComment = (e) => {
        e.preventDefault();
        submit(route('posts.comment.store', post.id), {
            preserveScroll: true,
            onSuccess: () =>
                setData('content', ''),
        });
    }

    const handleDeleteComment = (id) => {
        if (confirm('Delete this comment?')) {
            router.delete(route('posts.comment.destroy', id), {
                preserveScroll: true,
            });
        }
    }

    return (
        <div className="bg-white rounded-3xl p-6 shadow-bento border border-slate-50 hover:border-purple-100 transition-colors">
            {/* User Info Header */}
            <div className="flex items-start justify-between mb-4">
                <div className="flex items-center mb-4">
                    <img
                        src={post.user.avatar ? `/storage/${post.user.avatar}` : `https://ui-avatars.com/api/?name=${post.user.name}&background=random`}
                        className="h-12 w-12 rounded-2xl object-cover border border-slate-100 mr-4"
                    />
                    <div className="flex flex-col">
                        <Link href={route('profile.show', post.user.username)} className="font-bold text-slate-900 leading-none">
                            {post.user.name}
                        </Link>
                        <span className="text-slate-400 text-sm mt-1">@{post.user.username}</span>
                    </div>
                </div>

                {post.user_id === authId && (
                    <button onClick={() => { if (confirm('Delete?')) router.delete(route('posts.delete', post.id)) }} className="text-slate-400 hover:text-red-500">
                        <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" /></svg>
                    </button>
                )}
            </div>

            <p className="text-slate-700 text-[17px] leading-relaxed mb-4">{post.content}</p>

            {post.image && (
                <div className="rounded-2xl overflow-hidden border border-slate-100 mb-4">
                    <img src={`/storage/${post.image}`} className="w-full h-auto object-cover" />
                </div>
            )}

            {/* Like and Reply Buttons */}
            <div className="mt-6 flex items-center space-x-6">
                <button
                    onClick={(e) => {
                        e.preventDefault();
                        router.post(route('posts.like.store', post.id), {}, {
                            preserveScroll: true,
                        });
                    }}

                    className={`flex items-center space-x-2 transition-all active:scale-90 ${post.is_liked ? 'text-red-500' : 'text-slate-400'}`}
                >
                    <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill={post.is_liked ? 'currentColor' : 'none'} viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span className="text-xs font-bold uppercase">{post.likes_count}</span>
                </button>

                <button onClick={() => setShowReply(!showReply)} className="flex items-center space-x-2 text-slate-400 hover:text-accent">
                    <svg className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                    <span className="text-xs font-bold uppercase">Reply</span>
                </button>
            </div>

            {/* Conditional Reply Form */}
            {(showReply || (post.comments && post.comments.length > 0)) && (
                <div className="mt-4 pt-4 border-t border-slate-50 space-y-6">

                    {post.comments?.map((comment) => (
                        <div key={comment.id} className="flex items-start space-x-3 group">

                            <img
                                src={comment.user.avatar ? `storage/${comment.user.avatar}` : `https://ui-avatars.com/api/?name=${comment.user?.name}&background=random`}
                                className="h-8 w-8 rounded-xl flex-shrink-0"
                            />

                            <div className="bg-slate-50 rounded-2xl px-4 py-2 flex-1 relative">
                                <div className="flex justify-between items-center mb-1">
                                    <div className="font-bold text-xs text-slate-900">
                                        {comment.user?.name}
                                    </div>

                                    {comment.user_id === authId && (
                                        <button onClick={() => handleDeleteComment(comment.id)} className="opacity-0 group-hover:opacity-100 transition-opacity text-slate-400 hover:text-red-500">
                                            <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    )}
                                </div>
                                <div className="text-slate-700 text-sm leading-snug">
                                    {comment.content}
                                </div>
                            </div>
                        </div>
                    ))}

                    {showReply && (
                        <form onSubmit={submitComment} className="flex items-end space-x-3">
                            <div className="flex-1 bg-slate-50 rounded-2xl px-4 py-2 border border-transparent focus-within:border-purple-100 focus-within:bg-white transition-all">
                                <textarea value={data.content} onChange={e => setData('content', e.target.value)} rows="1" placeholder="Write a comment..." className="w-full bg-transparent border-none focus:ring-0 text-sm p-0 resize-none"></textarea>
                            </div>
                            <button type="submit" className="bg-accent text-white p-2 rounded-xl hover:bg-purple-700">
                                <svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="3"><path d="M5 12h14M12 5l7 7-7 7" /></svg>
                            </button>
                        </form>
                    )}
                </div>
            )}

        </div>
    );
}

export default Home

import FlashMessage from '@/Components/FlashMessage';
import Sidebar from '@/Components/Sidebar';
import { Head, router, useForm, usePage } from '@inertiajs/react'
import React from 'react'

const EditProfile = ({ user }) => {
    const { auth } = usePage();
    const { data, setData, error, patch } = useForm({
        name: user.name || '',
        username: user.username || '',
        bio: user.bio || '',
    });

    const submit = (e) => {
        e.preventDefault();
        patch(route('profile.update'));
    }

    return (
        <div class="flex min-h-screen bg-slate-50">
            <Head title="Settings" />

            <div className="w-full grid grid-cols-1 md:grid-cols-12">
                <FlashMessage />

                <div className="hidden md:block w-64 md:col-span-3 bg-white border-r border-slate-200 sticky top-0 h-screen">
                    <Sidebar />
                </div>

                <main className="col-span-12 md:col-start-4 md:col-span-9 py-8 px-8 flex justify-center">
                    <div className="max-w-4xl w-full">
                        <div class="mb-8">
                            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Settings</h1>
                            <p class="text-slate-500">Manage your digital identity and profile details.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            <div class="md:col-span-1 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm flex flex-col items-center justify-center text-center">
                                <form onSubmit={submit} class="w-full">
                                    <div class="relative group mx-auto w-32 h-32 mb-6">
                                        <img src={user.avatar || `https://ui-avatars.com/api/?name=${user.name}`}
                                            class="w-full h-full object-cover rounded-full border-4 border-slate-50 shadow-inner" />
                                        <label class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 rounded-full cursor-pointer transition-all">
                                            <span class="text-white text-xs font-bold">Change</span>
                                            <input type="file" name="avatar" className="hidden" onChange={(e) => {
                                                const file = e.target.files[0];
                                                if (!file) return;

                                                setData('avatar', file);

                                                router.post(route('profile.update'), {
                                                    _method: 'patch',
                                                    avatar: file,
                                                }, {
                                                    forceFormData: true,
                                                    preserveScroll: true,
                                                });
                                            }} />
                                        </label>
                                    </div>
                                    <h3 class="font-bold text-slate-900">Profile Picture</h3>
                                    <p class="text-xs text-slate-400 mt-1">PNG, JPG up to 2MB</p>
                                </form>
                            </div>

                            <div class="md:col-span-2 bg-indigo-600 p-8 rounded-[2.5rem] text-white shadow-xl">
                                <form onSubmit={submit} class="space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-[10px] uppercase tracking-[0.2em] font-black text-indigo-100 mb-2">Display Name</label>
                                            <input type="text" value={data.name} onChange={e => setData('name', e.target.value)}
                                                class="w-full bg-white/90 text-black border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-indigo-500 transition-all" />
                                        </div>
                                        <div>
                                            <label class="block text-[10px] uppercase tracking-[0.2em] font-black text-indigo-100 mb-2">Username</label>
                                            <input type="text" value={data.username} onChange={e => setData('username', e.target.value)}
                                                class="w-full bg-white/90 text-black border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-indigo-500 transition-all" />
                                        </div>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="submit" class="px-8 py-3 bg-white text-indigo-600 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-indigo-50 hover:-translate-y-1 transition-all">
                                            Save Identity
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="md:col-span-3 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
                                <form onSubmit={submit}>
                                    <label class="block text-[10px] uppercase tracking-[0.2em] font-black text-indigo-950 mb-4">About Your Journey</label>
                                    <textarea value={data.bio} onChange={e => setData('bio', e.target.value)} rows="4"
                                        class="w-full bg-indigo-50/50 border-none rounded-3xl p-6 text-indigo-950 text-lg leading-relaxed focus:ring-2 focus:ring-indigo-500 transition-all"
                                        placeholder="Who are you?"></textarea>
                                    <div class="mt-6 flex justify-between items-center">
                                        <p class="text-xs text-indigo-400/70 italic">Max 500 characters</p>
                                        <button type="submit" class="px-10 py-4 bg-indigo-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-indigo-700 hover:-translate-y-1 transition-all shadow-lg shadow-indigo-200">
                                            Update Biography
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div >
    )
}

export default EditProfile

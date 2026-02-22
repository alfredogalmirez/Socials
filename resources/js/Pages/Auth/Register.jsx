import { Head, Link, useForm } from '@inertiajs/react'
import React from 'react'

const Register = () => {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        username: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const submit = (e) => {
        e.preventDefault();

        post(route('register.store'));
    }

    return (
        <div className="min-h-screen w-full flex items-center justify-center bg-bento-bg p-4">
            <Head title="Register"/>

            <div className="flex flex-col-reverse md:flex-row w-full max-w-5xl bg-white rounded-[2.5rem] shadow-bento overflow-hidden border border-slate-100">

                <div className="flex-1 p-8 md:p-16 flex flex-col justify-center">
                    <div className="max-w-sm mx-auto w-full">
                        <h2 className="text-3xl font-black text-slate-900 mb-2 tracking-tight">Create Account</h2>
                        <p className="text-slate-500 font-medium mb-8">Join the community today.</p>

                        <form onSubmit={submit} className="space-y-5">

                            <div className="space-y-1">
                                <label className="block text-sm font-bold text-slate-700 ml-1">Full Name</label>
                                <input type="text" value={data.name} onChange={e => setData('name', e.target.value)}
                                    className="w-full bg-slate-50 border-none rounded-2xl py-4 px-5 focus:ring-2 focus:ring-accent/20 transition-all placeholder:text-slate-300"
                                    placeholder="Juan Dela Cruz" />
                                {errors.name && <span className="text-xs text-red-500 ml-1">{errors.name}</span>}
                            </div>

                            <div className="space-y-1">
                                <label className="block text-sm font-bold text-slate-700 ml-1">Username</label>
                                <input type="text" value={data.username} onChange={e => setData('username', e.target.value)}
                                    className="w-full bg-slate-50 border-none rounded-2xl py-4 px-5 focus:ring-2 focus:ring-accent/20 transition-all placeholder:text-slate-300"
                                    placeholder="@example" />
                                {errors.username && <span className="text-xs text-red-500 ml-1">{errors.username}</span>}
                            </div>

                            <div className="space-y-1">
                                <label className="block text-sm font-bold text-slate-700 ml-1">Email</label>
                                <input type="email" value={data.email} onChange={e => setData('email', e.target.value)}
                                    className="w-full bg-slate-50 border-none rounded-2xl py-4 px-5 focus:ring-2 focus:ring-accent/20 transition-all placeholder:text-slate-300"
                                    placeholder="name@email.com" />
                                {errors.email && <span className="text-xs text-red-500 ml-1">{errors.email}</span>}
                            </div>

                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div className="space-y-1">
                                    <label className="block text-sm font-bold text-slate-700 ml-1">Password</label>
                                    <input type="password" value={data.password} onChange={e => setData('password', e.target.value)}
                                        className="w-full bg-slate-50 border-none rounded-2xl py-4 px-5 focus:ring-2 focus:ring-accent/20 transition-all placeholder:text-slate-300"
                                        placeholder="••••••••" />
                                </div>
                                <div className="space-y-1">
                                    <label className="block text-sm font-bold text-slate-700 ml-1">Confirm</label>
                                    <input type="password" value={data.password_confirmation} onChange={e => setData('password_confirmation', e.target.value)}
                                        className="w-full bg-slate-50 border-none rounded-2xl py-4 px-5 focus:ring-2 focus:ring-accent/20 transition-all placeholder:text-slate-300"
                                        placeholder="••••••••" />
                                </div>
                            </div>
                            {errors.password && <span className="text-xs text-red-500 ml-1">{errors.password}</span>}

                            <button type="submit" disabled={processing}
                                className="w-full bg-accent hover:bg-purple-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-accent/25 transition-all active:scale-[0.98] mt-4 disabled:opacity-50">
                                {processing ? 'Creating Account...' : 'Get Started'}
                            </button>

                            <p className="text-center text-slate-500 text-sm font-medium mt-6">
                                Already a member?{' '}
                                <Link href={route('login')} className="text-accent font-bold hover:underline">Login here</Link>
                            </p>
                        </form>
                    </div>
                </div>

                <div className="hidden md:flex md:w-5/12 bg-gradient-to-br from-indigo-600 to-accent p-12 flex-col justify-between text-white text-right">
                    <div className="text-3xl font-black italic tracking-tighter">S.</div>

                    <div>
                        <h2 className="text-4xl font-bold leading-tight">Start sharing <br />your story.</h2>
                        <p className="mt-4 text-purple-100 font-medium text-balance">Join thousands of creators in a space designed for clarity and connection.</p>
                    </div>

                    <div className="text-sm text-purple-200 uppercase tracking-widest font-bold">New Era</div>
                </div>

            </div>
        </div>
    )
}

export default Register

import React from 'react'
import { Link, useForm, Head } from '@inertiajs/react'

const Login = () => {

    const { data, setData, post, processing, errors } = useForm({
        login: '',
        password: '',
        remember: false,
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('login'));
    }

    return (
        <div className="min-h-screen w-full flex items-center justify-center bg-bentobg p-4">
            <Head title="Log in"/>

            <div
                className="flex flex-col md:flex-row w-full max-w-5xl bg-white rounded-[2.5rem] shadow-bento overflow-hidden border border-slate-100">

                <div
                    className="hidden md:flex md:w-5/12 bg-gradient-to-br from-accent to-indigo-600 p-12 flex-col justify-between text-white">
                    <div className="text-3xl font-black italic tracking-tighter">S.</div>

                    <div>
                        <h2 className="text-4xl font-bold leading-tight">Connect with the <br />inner circle.</h2>
                        <p className="mt-4 text-purple-100 font-medium">Experience the new wave of social interaction.</p>
                    </div>

                    <div className="text-sm text-purple-200">© 2026 Socials Platform by Alfredo Almirez</div>
                </div>

                <div className="flex-1 p-8 md:p-16 flex flex-col justify-center">
                    <div className="max-w-sm mx-auto w-full">
                        <h2 className="text-3xl font-black text-slate-900 mb-2 tracking-tight">Log in</h2>
                        <p className="text-slate-500 font-medium mb-8">Great to see you again!</p>

                        <form onSubmit={submit} className="space-y-6">

                            {Object.keys(errors).length > 0 && (
                                <div className="bg-red-300 border border-red-100 text-red-600 px-4 py-3 rounded-2xl flex items-center space-x-2 mb-6 animate-pulse">
                                    <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                        <path fillRule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clipRule="evenodd" />
                                    </svg>
                                    <p className="text-sm font-bold uppercase tracking-wide">Invalid credentials.</p>
                                </div>
                            )}

                            <div className="space-y-2">
                                <label className="block text-sm font-bold text-slate-700 ml-1">Username or Email</label>
                                <input type="text" name="login" value={data.login} onChange={(e) => setData('login', e.target.value)}
                                    className="w-full bg-slate-50 border-none rounded-2xl py-4 px-5 focus:ring-2 focus:ring-accent/20 transition-all placeholder:text-slate-300"
                                    placeholder="name@email.com or example_username"/>
                                    {errors.login && <div className="text-red-500 text-xs mt-1 ml-1">{errors.login}</div>}
                            </div>

                            <div className="space-y-2">
                                <label className="block text-sm font-bold text-slate-700 ml-1">Password</label>
                                <input type="password" name="password" value={data.password} onChange={(e) => setData('password', e.target.value)}
                                    className="w-full bg-slate-50 border-none rounded-2xl py-4 px-5 focus:ring-2 focus:ring-accent/20 transition-all placeholder:text-slate-300"
                                    placeholder="••••••••"/>
                                    {errors.password && <div className="text-red-500 text-xs mt-1 ml-1">{errors.password}</div>}
                            </div>

                            <button type="submit" disabled={processing}
                                className={`w-full bg-accent hover:bg-purple-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-accent/25 transition-all active:scale-[0.98] mt-4 ${processing ? 'opacity-50 cursor-not-allowed' : ''}`}>
                                {processing ? 'Logging in...' : 'Log In'}
                            </button>

                            <p className="text-center text-slate-500 text-sm font-medium mt-6">
                                Don't have an account?
                                <Link href={ route('register.create') } className="text-accent font-bold hover:underline">Join
                                    now</Link>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Login

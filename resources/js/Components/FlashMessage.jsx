import React from 'react'
import { usePage } from '@inertiajs/react'
import { useEffect, useState } from 'react'

const FlashMessage = () => {
    const { flash } = usePage().props;
    const [ show, setShow ] = useState(false);

    useEffect(() => {
        if (flash?.success || flash?.error) {
            setShow(true);
            const timer = setTimeout(() => setShow(false), 4000);
            return () => clearTimeout(timer);
        }
    }, [flash]);

    if (!show || !flash) return null;

    return (
        <div
            className={`fixed bottom-6 right-6 z-50 transition-all duration-300 ease-out transform ${show
                ? 'opacity-100 translate-y-0 scale-100'
                : 'opacity-0 translate-y-4 scale-95 pointer-events-none'
                }`}
        >
            <div className="bg-white border border-slate-100 shadow-bento rounded-3xl p-4 flex items-center space-x-4 min-w-[280px]">

                {/* Icon Section */}
                <div className="bg-accent/10 p-2.5 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                {/* Text Content */}
                <div className="flex-1">
                    <p className="text-[13px] font-black text-slate-900 leading-tight uppercase tracking-tight">
                        {flash.success ? 'Success' : 'Error'}
                    </p>
                    <p className="text-xs font-bold text-slate-500 mt-0.5">
                        {flash?.success || flash?.error}
                    </p>
                </div>

                {/* Close Button */}
                <button
                    onClick={() => setShow(false)}
                    className="text-slate-300 hover:text-slate-400 transition-colors px-1"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    )
}

export default FlashMessage

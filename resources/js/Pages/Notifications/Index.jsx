import NotificationRow from '@/Components/NotificationRow'
import Sidebar from '@/Components/Sidebar'
import { Head } from '@inertiajs/react'
import React from 'react'

const Index = ({ notifications }) => {
    return (
        <div className="flex min-h-screen bg-slate-50">
            <Head title="Notifications" />

            <div className="hidden md:block w-64 bg-white border-r border-slate-200 sticky top-0 h-screen">
                <Sidebar />
            </div>

            <div className="flex-1 flex justify-center py-8 px-4">
                <div className="w-full max-w-2xl">
                    <div className="flex items-center justify-between mb-8">
                        <h1 className="text-2xl font-black text-slate-900">Notifications</h1>
                        <span className="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full text-xs font-bold">{notifications.length} Total</span>
                    </div>

                    <div className="flex flex-col gap-3">
                        {notifications.map((item) => (
                            <NotificationRow key={item.id} notification={item} />
                        ))}
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Index

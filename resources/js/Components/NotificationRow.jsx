import React from 'react'

const NotificationRow = ({ notification }) => {
    const icons = {
        like: <i className="fa-solid fa-heart text-red-500"></i>,
        comment: <i className="fa-solid fa-comment text-blue-500"></i>,
        follow: <i class="fa-solid fa-user-plus text-indigo-600"></i>,
    };

    return (
        <div>
            <div className={`flex items-center p-4 rounded-[2rem] mb-3 transition-all ${notification.is_read ? 'bg-white border border-slate-100' : 'bg-indigo-50 border border-indigo-100 shadow-sm'}`}>
                {/* 1. Actor Avatar */}
                <div className="relative">
                    <img
                        src={notification.actor.avatar || `https://ui-avatars.com/api/?name=${notification.actor.name}`}
                        className="w-12 h-12 rounded-2xl object-cover"
                    />
                    {/* Small indicator icon */}
                    <span className="absolute -bottom-1 -right-1 bg-white rounded-full w-6 h-6 flex items-center justify-center text-xs shadow-sm">
                        {icons[notification.type]}
                    </span>
                </div>

                {/* 2. Notification Text */}
                <div className="ml-4 flex-1">
                    <p className="text-sm text-slate-900 leading-tight">
                        <span className="font-black">{notification.actor.name}</span>
                        {notification.type === 'like' && ' liked your post'}
                        {notification.type === 'comment' && ' commented on your post'}
                        {notification.type === 'follow' && ' started following you'}
                    </p>
                    <span className="text-[10px] uppercase font-bold text-slate-400 tracking-widest mt-1 block">
                        {notification.created_at_human}
                    </span>
                </div>

                {/* 3. Post Preview (Optional) */}
                {notification.post_id && (
                    <div className="ml-2 w-10 h-10 bg-slate-100 rounded-lg overflow-hidden opacity-50">
                        {/* Mini thumbnail of the post content/image */}
                    </div>
                )}
            </div>
        </div>
    )
}

export default NotificationRow

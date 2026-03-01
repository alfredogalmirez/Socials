import NotificationRow from '@/Components/NotificationRow'
import React from 'react'

const Index = ({ notifications }) => {
    return (
        <div>
            {notifications.map((item) => (
                <NotificationRow key={item.id} notification={item} />
            ))}
        </div>
    )
}

export default Index

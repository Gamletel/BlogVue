import { defineStore } from 'pinia';

interface Notification {
    id: string;
    message: string;
    data: {
        post_id: number;
        post_title: string;
        comment_id: number;
        comment_preview: string;
    };
    timestamp: number;
}

export const useNotificationStore = defineStore('notifications', {
    state: () => ({
        notifications: [] as Notification[],
        unreadCount: 0,
    }),
    actions: {
        addNotification(notification: Omit<Notification, 'id' | 'timestamp'>) {
            const id = crypto.randomUUID();
            const newNotification = {
                ...notification,
                id,
                timestamp: Date.now()
            };

            this.notifications.unshift(newNotification);
            this.unreadCount++;

            setTimeout(() => {
                this.removeNotification(id);
            }, 5000);
        },
        removeNotification(id: string) {
            const index = this.notifications.findIndex(n => n.id === id);
            if (index !== -1) {
                this.notifications.splice(index, 1);
                this.unreadCount = Math.max(0, this.unreadCount - 1);
            }
        }
    },
});


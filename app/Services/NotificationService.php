<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\OrderStatusUpdatedNotification;
use App\Notifications\PasswordResetNotification;
use App\Notifications\UserRegisteredNotification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Password;

class NotificationService
{
    /**
     * Send user registration notification.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function sendUserRegisteredNotification(User $user): void
    {
        $user->notify(new UserRegisteredNotification($user));
    }

    /**
     * Send password reset notification.
     *
     * @param  \App\Models\User  $user
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification(User $user, string $token): void
    {
        $user->notify(new PasswordResetNotification($token, $user->email));
    }

    /**
     * Send order status updated notification.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $notifiable
     * @param  int  $orderId
     * @param  string  $oldStatus
     * @param  string  $newStatus
     * @param  string|null  $orderNumber
     * @return void
     */
    public function sendOrderStatusUpdatedNotification(
        Model $notifiable,
        int $orderId,
        string $oldStatus,
        string $newStatus,
        ?string $orderNumber = null
    ): void {
        $notifiable->notify(
            new OrderStatusUpdatedNotification($orderId, $oldStatus, $newStatus, $orderNumber)
        );
    }

    /**
     * Get all notifications for a notifiable model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $notifiable
     * @param  int  $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getNotifications(Model $notifiable, int $perPage = 15): LengthAwarePaginator
    {
        return $notifiable->notifications()->paginate($perPage);
    }

    /**
     * Get unread notifications for a notifiable model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $notifiable
     * @param  int  $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUnreadNotifications(Model $notifiable, int $perPage = 15): LengthAwarePaginator
    {
        return $notifiable->unreadNotifications()->paginate($perPage);
    }

    /**
     * Get read notifications for a notifiable model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $notifiable
     * @param  int  $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getReadNotifications(Model $notifiable, int $perPage = 15): LengthAwarePaginator
    {
        return $notifiable->readNotifications()->paginate($perPage);
    }

    /**
     * Mark a notification as read.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $notifiable
     * @param  string  $notificationId
     * @return bool
     */
    public function markAsRead(Model $notifiable, string $notificationId): bool
    {
        $notification = $notifiable->notifications()->find($notificationId);

        if ($notification && $notification->unread()) {
            $notification->markAsRead();

            return true;
        }

        return false;
    }

    /**
     * Mark all notifications as read for a notifiable model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $notifiable
     * @return int
     */
    public function markAllAsRead(Model $notifiable): int
    {
        return $notifiable->unreadNotifications()->update(['read_at' => now()]);
    }

    /**
     * Delete a notification.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $notifiable
     * @param  string  $notificationId
     * @return bool
     */
    public function deleteNotification(Model $notifiable, string $notificationId): bool
    {
        $notification = $notifiable->notifications()->find($notificationId);

        if ($notification) {
            return $notification->delete();
        }

        return false;
    }

    /**
     * Delete all notifications for a notifiable model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $notifiable
     * @return int
     */
    public function deleteAllNotifications(Model $notifiable): int
    {
        return $notifiable->notifications()->delete();
    }

    /**
     * Get unread notifications count for a notifiable model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $notifiable
     * @return int
     */
    public function getUnreadCount(Model $notifiable): int
    {
        return $notifiable->unreadNotifications()->count();
    }

    /**
     * Get notifications by type.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $notifiable
     * @param  string  $type
     * @param  int  $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getNotificationsByType(
        Model $notifiable,
        string $type,
        int $perPage = 15
    ): LengthAwarePaginator {
        return $notifiable->notifications()
            ->where('type', $type)
            ->paginate($perPage);
    }

    /**
     * Get latest notifications for a notifiable model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $notifiable
     * @param  int  $limit
     * @return \Illuminate\Support\Collection
     */
    public function getLatestNotifications(Model $notifiable, int $limit = 10): Collection
    {
        return $notifiable->notifications()
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get latest unread notifications for a notifiable model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $notifiable
     * @param  int  $limit
     * @return \Illuminate\Support\Collection
     */
    public function getLatestUnreadNotifications(Model $notifiable, int $limit = 10): Collection
    {
        return $notifiable->unreadNotifications()
            ->latest()
            ->limit($limit)
            ->get();
    }
}


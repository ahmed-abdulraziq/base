<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct(
        protected NotificationService $notificationService
    ) {
    }

    protected function getCurrentUser()
    {
        if (auth('admin')->check()) {
            return auth('admin')->user();
        }
        if (auth('doctor')->check()) {
            return auth('doctor')->user();
        }
        if (auth('employee')->check()) {
            return auth('employee')->user();
        }
        if (auth('web')->check()) {
            return auth('web')->user();
        }
        return auth()->user();
    }

    public function index(): View|RedirectResponse
    {
        $user = $this->getCurrentUser();
        if (! $user) {
            return redirect()->route('dashboard.login');
        }

        $notifications = $this->notificationService->getNotifications($user, 10);

        $prefix = 'dashboard';
        $layout = 'dashboard.layouts.master';
        if (auth('doctor')->check()) {
            $prefix = 'doctor';
            $layout = 'doctor.layouts.master';
        } elseif (auth('employee')->check()) {
            $prefix = 'employee';
            $layout = 'employee.layouts.master';
        } elseif (auth('web')->check()) {
            $prefix = 'web';
        }

        return view('dashboard.notifications.index', compact('notifications', 'prefix', 'layout'));
    }

    public function markAsRead(string $id): JsonResponse|RedirectResponse
    {
        $user = $this->getCurrentUser();
        if (! $user) {
            return request()->wantsJson() ? response()->json(['success' => false], 401) : back();
        }

        $notification = $user->notifications()->where('id', $id)->first();

        if ($notification) {
            $this->notificationService->markAsRead($user, $id);

            if (request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'count' => $this->notificationService->getUnreadCount($user),
                ]);
            }

            if (isset($notification->data['url']) && $notification->data['url'] !== '#') {
                return redirect($notification->data['url']);
            }
        }

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['success' => false]);
        }

        return back();
    }

    public function markAllAsRead(): JsonResponse|RedirectResponse
    {
        $user = $this->getCurrentUser();
        if (! $user) {
            return request()->wantsJson() ? response()->json(['success' => false], 401) : back();
        }

        $this->notificationService->markAllAsRead($user);

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['success' => true, 'count' => 0]);
        }

        return back()->with('success', __('translate.all_notifications_marked_as_read'));
    }

    public function check(): JsonResponse
    {
        $user = $this->getCurrentUser();
        if (! $user) {
            return response()->json(['success' => false], 401);
        }

        $unreadCount = $this->notificationService->getUnreadCount($user);
        $notifications = $this->notificationService->getLatestNotifications($user, 5);

        $prefix = 'dashboard';
        if (request()->is('doctor*') || auth('doctor')->check()) {
            $prefix = 'doctor';
        } elseif (request()->is('employee*') || auth('employee')->check()) {
            $prefix = 'employee';
        } elseif (auth('web')->check()) {
            $prefix = 'web';
        }

        $html = view('components.notifications-list', compact('notifications', 'prefix'))->render();

        return response()->json([
            'success' => true,
            'unread_count' => $unreadCount,
            'html' => $html,
        ]);
    }
}

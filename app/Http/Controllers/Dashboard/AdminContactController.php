<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('dashboard.contact_messages.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        if (!$contactMessage->read_at) {
            $contactMessage->update(['read_at' => now()]);
        }
        return view('dashboard.contact_messages.show', compact('contactMessage'));
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('dashboard.contact_messages.index')
            ->with('success', __('translate.message_deleted_successfully'));
    }

    public function markAsRead(ContactMessage $contactMessage)
    {
        $contactMessage->update(['read_at' => now()]);
        return back()->with('success', __('translate.status_changed_successfully'));
    }
}

<?php

namespace App\Services;

use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttachmentService
{
    /**
     * @param  mixed  $owner  Authenticatable model instance, or null to auto-detect from any guard.
     */
    public function store($model, $file, $field, $type = 'image', $owner = null)
    {
        // Auto-detect the authenticated user across all guards when no owner is supplied
        if ($owner === null) {
            foreach (['doctor', 'admin', 'employee', 'web'] as $guard) {
                if (Auth::guard($guard)->check()) {
                    $owner = Auth::guard($guard)->user();
                    break;
                }
            }
        }

        $folder    = now()->format('Y/m');
        $extension = $file->getClientOriginalExtension() ?: 'png';
        $fileName  = Str::uuid() . '.' . $extension;

        $path = $file->storeAs($folder, $fileName, 'public');

        return $model->attachments()->create([
            'name'       => $field,
            'title'      => $file->getClientOriginalName(),
            'extension'  => $extension,
            'size'       => $file->getSize(),
            'path'       => $path,
            'type'       => $type,
            'owner_id'   => $owner?->id,
            'owner_type' => $owner ? get_class($owner) : null,
        ]);
    }

    public function storeMultiple($model, $files, $field, $type = 'image', $owner = null)
    {
        $attachments = [];
        foreach ($files as $file) {
            $attachments[] = $this->store($model, $file, $field, $type, $owner);
        }
        return $attachments;
    }
}

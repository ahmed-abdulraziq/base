<?php

namespace App\Services;

use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AttachmentService
{
    public function store($model, $file, $field, $type = 'image', $user_id = null)
    {
        $folder = now()->format('Y/m');
        $extension = $file->getClientOriginalExtension() ?: 'png';
        $fileName = Str::uuid() . '.' . $extension;

        $path = $file->storeAs($folder, $fileName, 'public');

        return $model->attachments()->create([
            'name' => $field,
            'title' => $file->getClientOriginalName(),
            'extension' => $extension,
            'size' => $file->getSize(),
            'path' => $path,
            'type' => $type,
            'user_id' => $user_id ?? Auth::id(),
        ]);
    }

    public function storeMultiple($model, $files, $field, $type = 'image', $user_id = null)
    {
        $attachments = [];
        foreach ($files as $file) {
            $attachments[] = $this->store($model, $file, $field, $type, $user_id);
        }
        return $attachments;
    }
}

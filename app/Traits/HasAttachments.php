<?php

namespace App\Traits;

use App\Models\Attachment;

trait HasAttachments
{
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function uploadFile($file, $field, $type = 'image', $user_id = null)
    {
        return app(\App\Services\AttachmentService::class)
            ->store($this, $file, $field, $type, $user_id);
    }

    public function uploadMultiple($files, $field, $type = 'image', $user_id = null)
    {
        return app(\App\Services\AttachmentService::class)
            ->storeMultiple($this, $files, $field, $type, $user_id);
    }

    public function getAttachment($field)
    {
        return $this->attachments()->where('name', $field)->first();
    }

    public function __get($key)
    {
        if (isset($this->uploadable[$key])) {
            $multiple = $this->uploadable[$key]['multiple'] ?? false;

            return $multiple
                ? $this->attachments()->where('name', $key)->get()
                : $this->attachments()->where('name', $key)->first();
        }

        return parent::__get($key);
    }
}
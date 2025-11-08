<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class AttachmentObserver
{
    public function creating(Model $model)
    {
        foreach ($model->uploadable ?? [] as $field => $options) {
            unset($model->{$field});
        }
    }

    public function created(Model $model)
    {
        $request = Request::instance();

        foreach ($model->uploadable ?? [] as $field => $options) {
            $files = $request->file($field);
            if (!$files) continue;

            $service = app(\App\Services\AttachmentService::class);
            $type = $options['type'] ?? 'image';
            $multiple = $options['multiple'] ?? false;

            if ($multiple && is_array($files)) {
                $service->storeMultiple($model, $files, $field, $type);
            } else {
                $service->store($model, is_array($files) ? $files[0] : $files, $field, $type);
            }
        }
    }
}
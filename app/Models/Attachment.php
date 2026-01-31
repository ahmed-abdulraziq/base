<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/** @use HasFactory<\Database\Factories\AttachmentFactory> */
class Attachment extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded = [];
    
    protected $casts = [
        'size' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function attachmentable()
    {
        return $this->morphTo();
    }

    public function owner()
    {
        return $this->morphTo();
    }

    /**
     * Backward compatibility - get user if owner is User model
     */
    public function user()
    {
        if ($this->owner_type === User::class) {
            return $this->owner;
        }
        return null;
    }

    /**
     * Get the full URL for the attachment
     */
    public function getUrlAttribute()
    {
        return asset($this->path);
    }

    /**
     * Get the file size in human readable format
     */
    public function getHumanSizeAttribute()
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Check if attachment is an image
     */
    public function isImage()
    {
        return in_array($this->extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
    }

    /**
     * Scope for images only
     */
    public function scopeImages($query)
    {
        return $query->whereIn('extension', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
    }

    /**
     * Scope for specific type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}

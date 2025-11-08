<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\HasAttachments;

abstract class BaseModel extends Model
{
    use HasFactory, SoftDeletes, HasAttachments;

    /**
     * Default attributes that apply to all models extending this one.
     */
    protected $guarded = [];

    /**
     * Common casting settings
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Example of a common query scope — used to fetch only active records.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Utility to format timestamps or handle shared logic.
     */
    public function formattedDate($column = 'created_at')
    {
        return $this->{$column}?->format('Y-m-d H:i:s');
    }

    /**
     * Get the model's table name
     */
    public static function getTableName()
    {
        return (new static)->getTable();
    }

    /**
     * Scope to order by created_at descending
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope to order by created_at ascending
     */
    public function scopeOldest($query)
    {
        return $query->orderBy('created_at', 'asc');
    }

    /**
     * Check if model has a specific attribute and it's not null
     */
    public function hasAttribute($attribute)
    {
        return $this->getAttribute($attribute) !== null;
    }

    /**
     * Get human readable time difference
     */
    public function getTimeAgo($column = 'created_at')
    {
        return $this->{$column}?->diffForHumans();
    }

    /**
     * Scope to search in multiple columns
     */
    public function scopeSearch($query, $search, $columns = [])
    {
        if (empty($columns)) {
            $columns = $this->getFillable();
        }

        return $query->where(function ($q) use ($search, $columns) {
            foreach ($columns as $column) {
                $q->orWhere($column, 'LIKE', "%{$search}%");
            }
        });
    }

    /**
     * Get model's primary key value
     */
    public function getKeyValue()
    {
        return $this->getKey();
    }

    /**
     * Check if model is new (not saved yet)
     */
    public function isNew()
    {
        return !$this->exists;
    }
}

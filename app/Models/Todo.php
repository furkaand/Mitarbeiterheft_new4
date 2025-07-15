<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'priority',
        'status',
        'user_id',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopePending($query)
    {
        return $query->where('status', '!=', 'completed');
    }

    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now()->toDateString())
                    ->where('status', '!=', 'completed');
    }
}

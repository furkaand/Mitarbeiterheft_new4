<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'department', 'cost_center', 'purpose', 'date', 
        'participants', 'organizer', 'planned_costs', 'requested_by', 'confirmation', 'rejection_reason'
    ];
}

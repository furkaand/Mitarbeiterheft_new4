<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'shift_type', 'employee_id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

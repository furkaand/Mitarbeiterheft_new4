<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic',
        'company',
        'pdf',
        'conducted_on',
        'conducted_by',
        'confirmed_by',
        'signature',
        'content',
        'user_id',
    ];
}

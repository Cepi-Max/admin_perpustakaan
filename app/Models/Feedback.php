<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'kritik',
        'saran',
    ];
}
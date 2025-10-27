<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'gender',
        'status',
        'department',
        'birthday',
        'dateHired'
    ];

    protected $casts = [
        'birthday' => 'date',
        'dateHired' => 'datetime'
    ];
}
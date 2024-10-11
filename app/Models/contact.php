<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'name',
        'company_name',
        'email',
        'phone',
        'country',
        'city',
        'industry',
        'message',
        'created_at'
    ];
}

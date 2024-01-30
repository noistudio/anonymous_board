<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boards extends Model
{
    use HasFactory;

    protected $table = 'boards';
    protected $fillable = [
        'title','alias',
        'created_at'
    ];

     protected $casts = [
    
    ];

    //additional_methods//
}

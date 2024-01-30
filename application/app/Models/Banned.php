<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banned extends Model
{
    use HasFactory;

    protected $table = 'banned';
    protected $fillable = [
        'created_at',
        "hash",
        "board_id",
        "date_to"
    ];




    //additional_methods//
}

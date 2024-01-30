<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Threads extends Model
{
    use HasFactory;

    protected $table = 'threads';
    protected $fillable = [
        'board_id','thread_id','id_reply',
        'name','ismain',
        'content_json',
        'content_txt',
        'created_at',
        'quoted_text',
        "hash",
    ];

    protected $casts = [
       "content_json"=>'array',


    ];

    public function posts()
    {
        return $this->hasMany(Threads::class,"thread_id","id")->where('ismain',false);
    }
    //additional_methods//
}

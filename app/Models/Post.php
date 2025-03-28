<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content'];

    public function replies()
    {
        return $this->hasMany(Reply::class)->whereNull('parent_id')->with('replies');
    }
}

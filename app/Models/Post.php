<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content','user_id'];


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany(Reply::class)->whereNull('parent_id')->with('replies');
    }
}

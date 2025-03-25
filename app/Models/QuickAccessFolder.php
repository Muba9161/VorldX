<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickAccessFolder extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'folder_id']; // Updated to folder_id

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

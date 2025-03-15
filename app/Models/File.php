<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path', 'folder_id', 'user_id'];

    // A file belongs to a folder
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    // A file belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

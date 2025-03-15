<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subfolder extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = ['name', 'folder_id', 'user_id'];

    /**
     * Get the folder that owns the subfolder.
     */
    public function folder()
    {
        return $this->belongsTo(Folder::class); // A subfolder belongs to a folder
    }

    /**
     * Get the user that owns the subfolder.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // A subfolder belongs to a user
    }
}

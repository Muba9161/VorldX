<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    // protected $fillable = ['name', 'parent_id', 'user_id']; // Added user_id

    protected $fillable = ['name', 'parent_id', 'user_id', 'file_path']; // Include file_path


    // Define the relationship for subfolders (children folders)
    public function subfolders()
    {
        return $this->hasMany(Folder::class, 'parent_id');
        // return $this->hasMany(Subfolder::class);
    }

    // Define the relationship for the parent folder (the parent folder for a folder)
    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    // Function to copy folder recursively
    public function copyTo($newParentId = null)
    {
        // Create the copied folder
        $newFolder = self::create([
            'name' => $this->name . ' - Copy',  // Append " - Copy" to the folder name
            'parent_id' => $newParentId,        // Set the new parent folder
            'user_id' => $this->user_id,        // Copy the folder for the same user
        ]);

        // Recursively copy subfolders
        foreach ($this->subfolders as $subfolder) {
            $subfolder->copyTo($newFolder->id); // Copy each subfolder to the new folder
        }

        // Optionally, you can copy the files within the folder (if you are handling files)
        // foreach ($this->files as $file) {
        //     $file->copyTo($newFolder->id);
        // }

        return $newFolder;  // Return the newly created folder
    }




    public static function getBreadcrumb($folder)
    {
        $breadcrumb = [];

        while ($folder) {
            array_unshift($breadcrumb, $folder); // Prepend the folder to the breadcrumb array
            $folder = $folder->parent; // Assuming you have a parent relationship
        }

        return $breadcrumb;
    }

    // Define the relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

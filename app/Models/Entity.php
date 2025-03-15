<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'parent_id', 'user_id']; // Added user_id

    public function entityfolder()
    {
        return $this->hasMany(Entity::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Entity::class, 'parent_id');
    }

    // Function to copy folder recursively
    public function copyTo($newParentId = null)
    {
        $newFolder = self::create([
            'name' => $this->name . ' - Copy',
            'parent_id' => $newParentId,
            'user_id' => $this->user_id // Ensure the copied folder belongs to the same user
        ]);

        // Recursively copy subfolders
        foreach ($this->subfolders as $subfolder) {
            $subfolder->copyTo($newFolder->id);
        }

        return $newFolder;
    }

    public static function getBreadcrumb($entity): array
    {
        $breadcrumb = [];

        while ($entity) {
            array_unshift($breadcrumb, $entity); // Prepend the entity to the breadcrumb array
            $entity = $entity->parent; // Assuming you have a parent relationship
        }

        return $breadcrumb;
    }

    // Define the relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

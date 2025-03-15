<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    public function followRequests()
    {
        return $this->hasMany(FollowRequest::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follow_requests')->withPivot('status');
    }
}

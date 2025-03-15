<?php

namespace App\Http\Controllers;

use App\Models\FollowRequest;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;

class FollowRequestController extends Controller
{
    public function follow(Organization $organization)
    {
        $user = auth()->user();

        // Check if the user has already sent a request to follow this organization
        $existingRequest = FollowRequest::where('user_id', $user->id)
            ->where('organization_id', $organization->id)
            ->first();

        if ($existingRequest) {
            return redirect()->route('organization.show', $organization->id)
                ->with('error', 'You have already sent a follow request to this organization.');
        }

        // Create a follow request
        FollowRequest::create([
            'user_id' => $user->id,
            'organization_id' => $organization->id,
            'status' => 'pending',
        ]);

        return redirect()->route('organization.show', $organization->id)
            ->with('success', 'Follow request sent successfully!');
    }
}

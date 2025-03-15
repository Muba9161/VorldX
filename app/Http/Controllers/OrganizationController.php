<?php

namespace App\Http\Controllers;

use App\Models\FollowRequest;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    // View the list of followers for an organization
    public function followers(Organization $organization)
    {
        // Get the list of pending follow requests
        $followers = $organization->followers()
            ->wherePivot('status', 'pending')
            ->get();

        return view('organization.followers', compact('followers', 'organization'));
    }

    // Accept a follow request
    public function acceptFollow(Organization $organization, User $user)
    {
        // Find the follow request
        $followRequest = FollowRequest::where('user_id', $user->id)
            ->where('organization_id', $organization->id)
            ->first();

        if (!$followRequest || $followRequest->status != 'pending') {
            return redirect()->route('organization.followers', $organization->id)
                ->with('error', 'Follow request not found or already processed.');
        }

        // Accept the request
        $followRequest->update(['status' => 'accepted']);

        return redirect()->route('organization.followers', $organization->id)
            ->with('success', 'Follow request accepted.');
    }

    // Reject a follow request
    public function rejectFollow(Organization $organization, User $user)
    {
        // Find the follow request
        $followRequest = FollowRequest::where('user_id', $user->id)
            ->where('organization_id', $organization->id)
            ->first();

        if (!$followRequest || $followRequest->status != 'pending') {
            return redirect()->route('organization.followers', $organization->id)
                ->with('error', 'Follow request not found or already processed.');
        }

        // Reject the request
        $followRequest->update(['status' => 'rejected']);

        return redirect()->route('organization.followers', $organization->id)
            ->with('success', 'Follow request rejected.');
    }

    public function search(Request $request)
    {
        // Retrieve the search query from the request
        $query = $request->input('q');

        // Query the users table for organizations (where option is 'entity')
        // and filter by the name field
        $organizations = User::where('option', 'entity') // Only get organizations (option = 'entity')
            ->where('name', 'LIKE', '%' . $query . '%') // Search by organization name
            ->get();

        // Return the organizations as a JSON response
        return response()->json(['organizations' => $organizations]);
    }
}

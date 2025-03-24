<?php

namespace App\Providers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('layouts.header', function ($view) {
            if (Auth::check()) {
                $latestMessages = Message::where('sender_id', Auth::id())
                    ->orWhere('receiver_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();

                $uniqueUsers = [];
                $filteredMessages = [];

                foreach ($latestMessages as $message) {
                    $message->sender = User::find($message->sender_id);
                    $message->receiver = User::find($message->receiver_id);

                    // Determine the other user's ID.
                    $otherUserId = ($message->sender_id === Auth::id()) ? $message->receiver_id : $message->sender_id;

                    // Check if the other user is NOT the logged-in user AND not already in the uniqueUsers array.
                    if ($otherUserId !== Auth::id() && !in_array($otherUserId, $uniqueUsers)) {
                        $uniqueUsers[] = $otherUserId;
                        $filteredMessages[] = $message;
                    }
                }

                $latestMessages = $filteredMessages;
            } else {
                $latestMessages = [];
            }

            $view->with([
                'latestMessages' => $latestMessages,
            ]);
        });
    }
}

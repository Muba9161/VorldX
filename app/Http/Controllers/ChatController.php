<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher; //If you use pusher.

class ChatController extends Controller
{
    public function index(User $user)
    {
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id)->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'desc')->get();

        foreach ($messages as $message) {
            $formattedTime = Carbon::parse($message->created_at)->setTimezone(config('app.timezone'));
            $message->created_at_formatted = $formattedTime->format('h:i A');
        }

        return view('chat.index', compact('user', 'messages'));
    }

    public function sendMessage(Request $request, User $user)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);
        try {
            $message = Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $user->id,
                'message' => $request->message,
            ]);

            // Broadcast the message using Pusher (or another real-time service)
            $options = array(
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true
            );
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
            $pusher->trigger('chat', 'message', [
                'message' => $message->load('sender'),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Message could not be sent.'], 500);
        }

        return response()->json(['message' => $message]);
    }

    public function users()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('chat.users', compact('users'));
    }
    public function pusherAuth(Request $request)
    {
        $user = Auth::user();
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            ['cluster' => env('PUSHER_APP_CLUSTER')]
        );

        $auth = $pusher->presence_auth(
            $request->channel_name,
            $request->socket_id,
            $user->id,
            ['name' => $user->name]
        );

        return response($auth, 200)
            ->header('Content-Type', 'application/json');
    }

    
}

<div class="reply">
    <p>{{ $reply->content }}</p>

    {{-- Nested Reply Form --}}
    <form action="{{ route('replies.store') }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $reply->post_id }}">
        <input type="hidden" name="parent_id" value="{{ $reply->id }}">
        <textarea name="content" placeholder="Reply to this reply" required></textarea>
        <button type="submit">Reply</button>
    </form>

    {{-- Show Nested Replies --}}
    @if ($reply->replies->count() > 0)
        <div>
            @foreach ($reply->replies as $nestedReply)
                @include('posts.partials.reply', ['reply' => $nestedReply])
            @endforeach
        </div>
    @endif
</div>

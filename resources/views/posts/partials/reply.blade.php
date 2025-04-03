<div class="reply mx-5">
    <p>{{ $reply->content }}</p>

    {{-- Nested Reply Form --}}
    <form action="{{ route('profile.replies.store') }}" method="POST" class="mx-5">
        @csrf
        <input type="hidden" name="post_id" value="{{ $reply->post_id }}">
        <input type="hidden" name="parent_id" value="{{ $reply->id }}">
        <textarea class="form-control" name="content" placeholder="Reply to this reply" rows="1" required></textarea>
        {{-- <button type="submit">Reply</button> --}}
        <button type="submit" class="btn btn-sm btn-success my-3">
            <i class="fa fa-share ms-1"></i> Reply
        </button>
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

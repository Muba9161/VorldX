<h1>{{ $organization->name }} - Followers</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<ul>
    @foreach($followers as $follower)
        <li>
            <p>{{ $follower->name }} ({{ $follower->email }})</p>
            <form action="{{ route('organization.acceptFollow', [$organization->id, $follower->id]) }}" method="POST">
                @csrf
                <button type="submit">Accept</button>
            </form>
            <form action="{{ route('organization.rejectFollow', [$organization->id, $follower->id]) }}" method="POST">
                @csrf
                <button type="submit">Reject</button>
            </form>
        </li>
    @endforeach
</ul>

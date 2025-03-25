<!DOCTYPE html>
<html>
<head>
    <title>Quick Access Folders</title>
</head>
<body>
    <h1>Quick Access Folders</h1>

    @if (count($folders) > 0)
        <ul>
            @foreach ($folders as $folder)
                <li>
                    {{ $folder['folder_name'] }}
                    <button onclick="removeQuickAccess({{ $folder->folder_id }})">Remove</button> <!-- Updated to send folder_id -->
                </li>
            @endforeach
        </ul>
    @else
        <p>No quick access folders added yet.</p>
    @endif

    <script>
    function removeQuickAccess(id) {
        fetch('/quick-access/remove', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            window.location.reload();
        });
    }
    </script>

    
</body>
</html>

@extends('layouts.main')

@section('website-page-title', 'Strings Calendar')

@section('website-active-calendar', 'active')

@section('website-main-section')


    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Chat</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Apps</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Chat</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="main-content-app pt-0">
                                <div class="main-content-body main-content-body-chat h-100">
                                    <div class="main-chat-header pt-3 d-block d-sm-flex">
                                        @if (!is_null($user->profile_picture))
                                            <div class="main-img-user online"><img alt="avatar"
                                                    src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}">
                                            </div>
                                        @else
                                            <div class="main-img-user online"><img alt="avatar"
                                                    src="../assets/images/users/user.png">
                                            </div>
                                        @endif
                                        <div class="main-chat-msg-name mt-2">
                                            <h6>{{ $user->name }}</h6>
                                            <div id="onlineStatus">
                                                {{-- <span class="dot-label bg-success"></span><small class="me-3">Online</small> --}}
                                            </div>
                                        </div>
                                        {{-- <nav class="nav">
                                            <div class="dropdown">
                                                <a class="nav-link" href="javascript:void(0)" data-bs-toggle="dropdown"
                                                    role="button" aria-haspopup="true" aria-expanded="false"><i
                                                        class="fe fe-more-horizontal"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="javascript:void(0)"><i
                                                            class="fe fe-phone-call me-1"></i> Phone Call</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"><i
                                                            class="fe fe-video me-1"></i> Video Call</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"><i
                                                            class="fe fe-user-plus me-1"></i> Add Contact</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"><i
                                                            class="fe fe-trash-2 me-1"></i> Delete</a>
                                                </div>
                                            </div>
                                        </nav> --}}
                                    </div>
                                    <!-- main-chat-header -->
                                    <div class="main-chat-body flex-2" id="ChatBody">
                                        @if ($messages->isEmpty())
                                            <div class="content-inner text-center">
                                                <p>No messages found.</p>
                                            </div>
                                        @else
                                            @foreach ($messages as $message)
                                                <div class="content-inner">
                                                    @if ($message->created_at->isToday())
                                                        <label
                                                            class="main-chat-time"><span>{{ $message->created_at->diffForHumans() }}</span></label>
                                                    @else
                                                        <label
                                                            class="main-chat-time"><span>{{ $message->created_at->format('d-m-Y') }}</span></label>
                                                    @endif
                                                    @if ($message->sender_id != Auth::id())
                                                        <div class="media chat-left">
                                                            @if (!is_null($user->profile_picture))
                                                                <div class="main-img-user online"><img alt="avatar"
                                                                        src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}">
                                                                </div>
                                                            @else
                                                                <div class="main-img-user online"><img alt="avatar"
                                                                        src="../assets/images/users/user.png">
                                                                </div>
                                                            @endif
                                                            <div class="media-body">
                                                                <div class="main-msg-wrapper">
                                                                    {{ $message->message }}
                                                                </div>
                                                                <div>
                                                                    <span>{{ $message->created_at_formatted }}</span>
                                                                    <a href="javascript:void(0)"><i
                                                                            class="icon ion-android-more-horizontal"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="media flex-row-reverse chat-right">
                                                            <div class="main-img-user online"><img alt="avatar"
                                                                    src="{{ asset('storage/profile_pictures/' . Auth::user()->profile_picture) }}">
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="main-msg-wrapper">
                                                                    {{ $message->message }}
                                                                </div>
                                                                <div>
                                                                    <span>{{ $message->created_at_formatted }}</span> <a
                                                                        href="javascript:void(0)"><i
                                                                            class="icon ion-android-more-horizontal"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>


                                    <div class="main-chat-footer">
                                        <input class="form-control" id="messageInput"
                                            placeholder="Type your message here..." type="text">
                                        <a class="nav-link" data-bs-toggle="tooltip" href="javascript:void(0)"
                                            title="Attach a File"><i class="fe fe-paperclip"></i></a>
                                        <button type="button" id="sendMessage" class="btn btn-icon  btn-primary brround"><i
                                                class="fa fa-paper-plane-o"></i></button>
                                        <nav class="nav">
                                        </nav>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->

            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->

    <script>
        $(document).ready(function() {
            var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
                authEndpoint: '/pusher/auth' //For presence channels.
            });

            $('#ChatBody').children().each(function(index, element) {
                $('#ChatBody').prepend(element);
            });
            var channel = pusher.subscribe('presence-chat.{{ $user->id }}.{{ Auth::id() }}');

            channel.bind('pusher:subscription_succeeded', function(members) {
                // Initial online status
                updateOnlineStatus(members.count >
                1); //If there is more than one member, the other user is online.
            });

            channel.bind('pusher:member_added', function(member) {
                updateOnlineStatus(true);
            });

            channel.bind('pusher:member_removed', function(member) {
                updateOnlineStatus(false);
            });

            function updateOnlineStatus(isOnline) {
                if (isOnline) {
                    $('#onlineStatus').html(
                        '<span class="dot-label bg-success"></span><small class="me-3">online</small>');
                } else {
                    $('#onlineStatus').html(
                        '<span class="dot-label bg-danger"></span><small class="me-3">offline</small>');
                }
            }

            channel.bind('message', function(data) {
                if ((data.message.sender_id == {{ Auth::id() }} && data.message.receiver_id ==
                        {{ $user->id }}) ||
                    (data.message.sender_id == {{ $user->id }} && data.message.receiver_id ==
                        {{ Auth::id() }})) {

                    let profilePicture = (data.message.sender_id == {{ Auth::id() }}) ?
                        "{{ asset('storage/profile_pictures/' . Auth::user()->profile_picture) }}" :
                        "../assets/images/users/user.png";

                    let messageClass = (data.message.sender_id != {{ Auth::id() }}) ? 'chat-left' :
                        'flex-row-reverse chat-right';

                    // Extract hours, minutes, and AM/PM from the created_at timestamp
                    let messageTime = new Date(data.message.created_at);
                    let hours = messageTime.getHours();
                    let minutes = messageTime.getMinutes().toString().padStart(2, '0');
                    let ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12; // the hour '0' should be '12'
                    let formattedTime = hours + ':' + minutes + ' ' + ampm;

                    $('#ChatBody').append(`
                        <div class="content-inner">
                            <div class="media ${messageClass}">
                                <div class="main-img-user online">
                                    <img alt="avatar" src="${profilePicture}">
                                </div>
                                <div class="media-body">
                                    <div class="main-msg-wrapper">
                                        ${data.message.message}
                                    </div>
                                    <div>
                                        <span>${formattedTime}</span>
                                        <a href="javascript:void(0)">
                                            <i class="icon ion-android-more-horizontal"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                    $('#ChatBody').scrollTop($('#ChatBody')[0].scrollHeight); // Scroll to bottom.
                }
            });

            $('#sendMessage').click(function() {
                sendMessage(); // Call the sendMessage function.
            });

            $('#messageInput').keypress(function(e) {
                if (e.which == 13) { // 13 is the Enter key code
                    sendMessage(); // Call the sendMessage function.
                    e.preventDefault(); // Prevent the default form submission (if inside a form).
                }
            });

            function sendMessage() {
                var message = $('#messageInput').val();

                $.ajax({
                    url: '/chat/{{ $user->id }}/send',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        message: message
                    },
                    success: function(response) {
                        $('#messageInput').val('');
                    }
                });
            }
        });
    </script>

    <script>
        function scrollToBottom() {
            let chatBody = document.getElementById('ChatBody');
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(scrollToBottom, 100); // Initial delay

            // Optional: Monitor for content changes and scroll again
            const observer = new MutationObserver(scrollToBottom);
            observer.observe(document.getElementById('ChatBody'), {
                childList: true,
                subtree: true
            });
        });
    </script>


@endsection

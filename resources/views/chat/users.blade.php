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
                        <div class="card overflow-hidden">
                            <div class="main-content-app pt-0 main-chat-2">
                                <div class="main-content-left main-content-left-chat">
                                    <div class="card-body d-flex">
                                        @if (Auth::user())
                                            @if (!is_null(Auth::user()->profile_picture))
                                                <div class="main-img-user online"><img alt="avatar"
                                                        src="{{ asset('storage/profile_pictures/' . Auth::user()->profile_picture) }}">
                                                </div>
                                            @endif

                                            <div class="main-chat-msg-name">
                                                <h6>{{ Auth::user()->name }}</h6>
                                                <span class="dot-label bg-success"></span><small
                                                    class="me-3">Available</small>
                                            </div>
                                        @endif
                                        <nav class="nav ms-auto">
                                            <div class="dropdown">
                                                <a class="nav-link text-muted fs-20" href="javascript:void(0)"
                                                    data-bs-toggle="dropdown" role="button" aria-haspopup="true"
                                                    aria-expanded="false"><i class="fe fe-more-horizontal"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="javascript:void(0)"><i
                                                            class="fe fe-user me-1"></i> Profile</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"><i
                                                            class="fe fe-edit me-1"></i> Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"><i
                                                            class="fe fe-users me-1"></i> New Group</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"><i
                                                            class="fe fe-settings me-1"></i> Settings</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"><i
                                                            class="fe fe-trash-2 me-1"></i> Delete</a>
                                                </div>
                                            </div>
                                        </nav>
                                    </div>


                                    <div class="tab-menu-heading border-top">
                                        <div class="tabs-menu1">
                                            <ul class="nav panel-tabs">
                                                <li><a href="#ChatList" class="active" data-bs-toggle="tab">Messages</a>
                                                </li>
                                                <li><a href="#ChatGroups" data-bs-toggle="tab">Groups</a></li>
                                                <li><a href="#ChatContacts" data-bs-toggle="tab">Contacts</a></li>
                                                {{-- <li><a href="#ChatContacts1" data-bs-toggle="tab">Networks</a></li> --}}
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="tab-content main-chat-list flex-2 ">
                                        <div class="tab-pane active" id="ChatList">
                                            <div class="main-chat-list tab-pane">
                                                @foreach ($users as $user)
                                                    <a href="{{ route('chat.index', $user->id) }}">
                                                        <div class="media new border-top-0">
                                                            @if ($user->profile_picture)
                                                                <div class="main-img-user online">
                                                                    <img alt="{{ $user->name }}'s profile picture" src="{{ asset('storage/profile_pictures/' . $user->profile_picture) }}">
                                                                </div>
                                                            @else
                                                                <div class="main-img-user online">
                                                                    <img alt="Default user profile picture" src="../assets/images/users/user.png">
                                                                </div>
                                                            @endif
                                                            <div class="media-body">
                                                                <div class="media-contact-name">
                                                                    <span>{{ $user->name }}</span>
                                                                    @php
                                                                        $latestMessage = \App\Models\Message::where(function ($query) use ($user) {
                                                                            $query->where('sender_id', Auth::id())->where('receiver_id', $user->id);
                                                                        })->orWhere(function ($query) use ($user) {
                                                                            $query->where('sender_id', $user->id)->where('receiver_id', Auth::id());
                                                                        })->orderBy('created_at', 'desc')->first(); // Corrected order
                                                                    @endphp
                                                                    @if ($latestMessage)
                                                                        <small class="text-muted ms-auto text-end">{{ $latestMessage->created_at->diffForHumans() }}</small>
                                                                    @else
                                                                        <small class="text-muted ms-auto text-end">No messages</small>
                                                                    @endif
                                                                </div>
                                                                @php
                                                                    $latestMessageText = $latestMessage ? $latestMessage->message : "No messages";
                                                                @endphp
                                                                <p>{{ Str::limit($latestMessageText, 30) }}</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- main-chat-list -->
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



@endsection

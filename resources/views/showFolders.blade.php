@extends('layouts.main')

@section('website-page-title', 'File Manager')

@section('website-active-folderx ', 'active')

@section('website-main-section')


    <!--app-content open-->
    <div class="main-content app-content mt-0">

        <!-- Success Modal with overlay -->
        <div id="successModalOverlay" class="modal-overlay" style="display:none;">
            <div class="modal-container">
                <div class="card border p-0 pb-3">
                    <div class="card-header border-0 pt-3">
                        <div class="card-options">
                            <a href="javascript:void(0)" class="card-options-remove" onclick="closeSuccessModal()"><i
                                    class="fe fe-x"></i></a>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <span class=""><svg xmlns="http://www.w3.org/2000/svg" height="60" width="60"
                                viewBox="0 0 24 24">
                                <path fill="#13bfa6"
                                    d="M10.3125,16.09375a.99676.99676,0,0,1-.707-.293L6.793,12.98828A.99989.99989,0,0,1,8.207,11.57422l2.10547,2.10547L15.793,8.19922A.99989.99989,0,0,1,17.207,9.61328l-6.1875,6.1875A.99676.99676,0,0,1,10.3125,16.09375Z"
                                    opacity=".99" />
                                <path fill="#71d8c9"
                                    d="M12,2A10,10,0,1,0,22,12,10.01146,10.01146,0,0,0,12,2Zm5.207,7.61328-6.1875,6.1875a.99963.99963,0,0,1-1.41406,0L6.793,12.98828A.99989.99989,0,0,1,8.207,11.57422l2.10547,2.10547L15.793,8.19922A.99989.99989,0,0,1,17.207,9.61328Z" />
                            </svg></span>
                        <h4 class="h4 mb-0 mt-3">Success</h4>
                        <p class="card-text">Folder deleted successfully</p>
                    </div>
                    <div class="card-footer text-center border-0 pt-0">
                        <div class="row">
                            <div class="text-center">
                                <a href="javascript:void(0)" class="btn btn-success" onclick="closeSuccessModal()">Close</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Options Selector for form --}}
        <div class="modal fade" id="option-selector">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content country-select-modal">
                    <div class="modal-header">
                        <h6 class="modal-title">What do you want to add?</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <ul class="row p-3">
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block active"
                                    data-bs-target="#createspace" data-bs-toggle="modal">
                                    <span class="country-selector"><i class="fa fa-home me-3 language"
                                            style="color: #6c5ffc;"></i></span>Space
                                </a>

                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block"
                                    data-bs-target="#createfolder" data-bs-toggle="modal">
                                    <span class="country-selector"><i class="fa fa-folder me-3 language"
                                            style="color: #6c5ffc;"></i></span>Folder
                                </a>
                            </li>
                            <li class="col-lg-6 mb-2">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block"
                                    data-bs-target="#uploadfile" data-bs-toggle="modal">
                                    <span class="country-selector"><i class="fa fa-file me-3 language"
                                            style="color: #6c5ffc;"></i></span>File
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal with overlay -->
        <div id="modalOverlay" class="modal-overlay" style="display:none;">
            <div class="modal-container">
                <div class="card border p-0 pb-3">
                    <div class="card-header border-0 pt-3">
                        <div class="card-options">
                            <a href="javascript:void(0)" class="card-options-remove" onclick="closeDeleteModal()"><i
                                    class="fe fe-x"></i></a>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <span class=""><svg xmlns="http://www.w3.org/2000/svg" height="60" width="60"
                                viewBox="0 0 24 24">
                                <path fill="#f07f8f"
                                    d="M20.05713,22H3.94287A3.02288,3.02288,0,0,1,1.3252,17.46631L9.38232,3.51123a3.02272,3.02272,0,0,1,5.23536,0L22.6748,17.46631A3.02288,3.02288,0,0,1,20.05713,22Z" />
                                <circle cx="12" cy="17" r="1" fill="#e62a45" />
                                <path fill="#e62a45" d="M12,14a1,1,0,0,1-1-1V9a1,1,0,0,1,2,0v4A1,1,0,0,1,12,14Z" />
                            </svg></span>
                        <h4 class="h4 mb-0 mt-3">Warning</h4>
                        <p class="card-text" id="deleteMessage">Are you sure you want to delete this folder?
                        </p>
                    </div>
                    <div class="card-footer text-center border-0 pt-0">
                        <div class="row">
                            <div class="text-center">
                                <a href="javascript:void(0)" class="btn btn-white me-2"
                                    onclick="closeDeleteModal()">Cancel</a>
                                <a href="javascript:void(0)" class="btn btn-danger" id="confirmDeleteBtn">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="side-app">
            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">File Manager</h1>
                    <div>
                        <ol class="breadcrumb1 bg-success">
                            <li class="breadcrumb-item1"><i class="fa fa fa-chevron-right me-2 text-white"
                                    aria-hidden="true"></i><a class="text-white" href="#">File
                                    Manager</a></li>

                        </ol>
                    </div>

                </div>
                <!-- PAGE-HEADER END -->

                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-md-5 col-lg-5 col-xl-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <button class="btn btn-primary btn-block" data-bs-target="#option-selector"
                                    data-bs-toggle="modal">
                                    <i class="fe fe-plus me-1"></i> Add
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="card-body pt-4">
                                    <div class="list-group list-group-transparent mb-0 file-manager">
                                        <div class="d-flex">
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="list-group-item  d-flex align-items-center px-0">
                                                    <i class="fe fe-image fs-18 me-2 text-success p-2"></i>Images
                                                </a>
                                            </div>
                                            <div class="text-end ms-auto mt-3">
                                                <span class="fs-11  text-dark">20 MB</span>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs mb-3 ms-2">
                                            <div class="progress-bar bg-green" style="width: 30%;"></div>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="list-group-item  d-flex align-items-center px-0">
                                                    <i class="fe fe-video fs-18 me-2 text-secondary p-2"></i>Videos
                                                </a>
                                            </div>
                                            <div class="text-end ms-auto mt-3">
                                                <span class="fs-11  text-dark">32.5 MB</span>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs mb-3 ms-2">
                                            <div class="progress-bar bg-secondary" style="width: 40%;"></div>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="list-group-item  d-flex align-items-center px-0">
                                                    <i class="fe fe-file-text fs-18 me-2 text-primary p-2"></i> Docs
                                                </a>
                                            </div>
                                            <div class="text-end ms-auto mt-3">
                                                <span class="fs-11  text-dark">14.2 MB</span>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs mb-3 ms-2">
                                            <div class="progress-bar bg-primary" style="width: 25%;"></div>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="list-group-item  d-flex align-items-center px-0">
                                                    <i class="fe fe-music fs-18 me-2 text-warning p-2"></i> Music
                                                </a>
                                            </div>
                                            <div class="text-end ms-auto mt-3">
                                                <span class="fs-11  text-dark">13 MB</span>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs mb-3 ms-2">
                                            <div class="progress-bar bg-warning" style="width: 30%;"></div>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="list-group-item  d-flex align-items-center px-0">
                                                    <i class="fe fe-download fs-18 me-2 text-info p-2"></i> Downloads
                                                </a>
                                            </div>
                                            <div class="text-end ms-auto mt-3">
                                                <span class="fs-11  text-dark">19.3 MB</span>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs mb-3 ms-2">
                                            <div class="progress-bar bg-info" style="width: 40%;"></div>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="list-group-item  d-flex align-items-center px-0">
                                                    <i class="fe fe-grid fs-18 me-2 text-danger p-2"></i> More
                                                </a>
                                            </div>
                                            <div class="text-end ms-auto mt-3">
                                                <span class="fs-11  text-dark">23 MB</span>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs mb-3 ms-2">
                                            <div class="progress-bar bg-danger" style="width: 45%;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="list-group list-group-transparent mb-0">
                                        <a href="javascript:void(0);"
                                            class="list-group-item  d-flex align-items-center px-0 py-2">
                                            <span class="text-primary me-2 fs-12"><i
                                                    class="fe fe-circle"></i></span>Remote Control
                                        </a>
                                        <a href="javascript:void(0);"
                                            class="list-group-item  d-flex align-items-center px-0 py-2">
                                            <span class="text-secondary me-2 fs-12"><i
                                                    class="fe fe-circle"></i></span>Google Drive
                                        </a>
                                        <a href="javascript:void(0);"
                                            class="list-group-item  d-flex align-items-center px-0 py-2">
                                            <span class="text-danger me-2 fs-12"><i class="fe fe-circle"></i></span>FTP
                                            Files
                                        </a>
                                        <a href="javascript:void(0);"
                                            class="list-group-item  d-flex align-items-center px-0 py-2">
                                            <span class="text-warning me-2 fs-12"><i
                                                    class="fe fe-circle"></i></span>Transfer files
                                        </a>
                                        <a href="javascript:void(0);"
                                            class="list-group-item  d-flex align-items-center px-0 py-2">
                                            <span class="text-success me-2 fs-12"><i class="fe fe-circle"></i></span>Deep
                                            Clean
                                        </a>
                                        <a href="javascript:void(0);"
                                            class="list-group-item  d-flex align-items-center px-0 py-2">
                                            <span class="text-info me-2 fs-12"><i
                                                    class="fe fe-circle"></i></span>Favourities
                                        </a>
                                        <a href="javascript:void(0);"
                                            class="list-group-item  d-flex align-items-center px-0 py-2">
                                            <span class="text-pink me-2 fs-12"><i class="fe fe-circle"></i></span>Settings
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 col-xl-9">
                        <div class="row row-sm">
                            <div class="text-dark mb-2 ms-1 fs-20 fw-semibold">All Spaces</div>
                            @if ($folders->isEmpty())
                                <div class="col-12">
                                    <div class="card pos-relative">
                                        <div class="card-body text-center">
                                            <h5>No Space to show</h5>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @foreach ($folders as $folder)
                                    <div class="col-xl-4 col-md-6 col-sm-6">
                                        <div class="card pos-relative">
                                            {{-- <a href="filemanager-list.html" class="open-file"></a> --}}
                                            <a href="{{ route('folders.show', $folder->id) }}">
                                                {{-- <h5 class="text-warning">{{ $folder->name }}</h5> --}}
                                            </a>
                                            <div class="card-body px-4 pt-4 pb-2">
                                                <div class="d-flex">
                                                    <span class="bg-warning-transparent border border-warning brround">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            style="width:24px;height:24px;">
                                                            <g fill="none" stroke="#f7b731" stroke-width="2">
                                                                <rect x="4" y="6" width="16" height="12"
                                                                    rx="2" stroke-linejoin="round" />
                                                                <line x1="4" y1="10" x2="20"
                                                                    y2="10" stroke-linecap="round" />
                                                                <line x1="4" y1="14" x2="20"
                                                                    y2="14" stroke-linecap="round" />
                                                                <rect x="7" y="6" width="10" height="4"
                                                                    rx="1" stroke-linejoin="round" />
                                                                <circle cx="12" cy="12" r="1"
                                                                    fill="#f7b731" />
                                                            </g>
                                                        </svg>
                                                    </span>
                                                    <div class="ms-auto mt-1 file-dropdown">
                                                        <a href="javascript:void(0)" class="text-muted"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i
                                                                class="fe fe-more-vertical fs-18"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-start">
                                                            <a class="dropdown-item" href="javascript:void(0)"><i
                                                                    class="fe fe-user me-2"></i> Profile</a>
                                                            <!-- Copy Link -->
                                                            <!-- Copy Folder Link (Visible if no folder is copied) -->
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                id="copy-folder-link" data-folder-id="{{ $folder->id }}"
                                                                data-parent-id="{{ $folder->parent_id }}">
                                                                <i class="fe fe-copy me-2"></i> Copy
                                                            </a>

                                                            <!-- Paste Folder Link (Visible if a folder is copied) -->
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                id="paste-folder-link" style="display: none;" <!--
                                                                Initially hidden -->
                                                                data-folder-id="{{ $folder->id }}">
                                                                <i class="fe fe-clipboard me-2"></i> Paste
                                                            </a>



                                                            <a class="dropdown-item" href="javascript:void(0)"><i
                                                                    class="fe fe-move me-2"></i> Move</a>

                                                            <button onclick="openDeleteModal({{ $folder->id }})"
                                                                class="dropdown-item">
                                                                <i class="fe fe-trash me-2"></i> Delete
                                                            </button>

                                                            <!-- Success/Error Message Display -->
                                                            @if (session('success'))
                                                                <div class="alert alert-success">
                                                                    {{ session('success') }}
                                                                </div>
                                                            @endif

                                                            @if (session('error'))
                                                                <div class="alert alert-danger">
                                                                    {{ session('error') }}
                                                                </div>
                                                            @endif



                                                            <a class="dropdown-item" data-bs-target="#access-selector"
                                                                data-bs-toggle="modal" href="javascript:void(0)"><i
                                                                    class="fe fe-user-check me-2"></i> Manage
                                                                Access</a>
                                                            <a class="dropdown-item" href="javascript:void(0)"><i
                                                                    class="fe fe-share me-2"></i> Share</a>
                                                            {{-- <form
                                                                action="{{ route('add-quick', ['folder_id' => $folder->id]) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item"
                                                                    style="background: none; border: none; padding: 0;">
                                                                    <i class="fe fe-star me-2"></i> Add to Quick Access
                                                                </button>
                                                            </form> --}}

                                                            <a class="dropdown-item"
                                                                href="{{ route('folders.download', ['folder' => $folder->id]) }}"><i
                                                                    class="fe fe-download me-2"></i> Download</a>
                                                            <a class="dropdown-item" href="javascript:void(0)"><i
                                                                    class="fe fe-home me-2"></i> Dashboard</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-footer border-top-0">
                                                <div class="d-flex">
                                                    <div>
                                                        <a href="{{ route('folders.show', $folder->id) }}">
                                                            <h5 class="text-warning">{{ $folder->name }}</h5>
                                                        </a>
                                                    </div>
                                                    <div class="ms-auto mt-4">
                                                        <!-- <h6 class="">23 MB</h6> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            {{-- <div class="col-xl-3 col-md-6 col-sm-6">
                                <div class="card pos-relative">
                                    <a href="#" class="open-file" data-bs-target="#createfile"></a>
                                    <div class="card-body px-4 pt-4 pb-2">
                                        <div class="d-flex">
                                            <span class="bg-danger-transparent border border-danger brround">
                                                <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                                    <path fill="#e82646" d="M12 5v14M5 12h14" stroke="#e82646"
                                                        stroke-width="2" stroke-linecap="round" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-footer border-top-0">
                                        <div class="d-flex">
                                            <div>
                                                <h5 class="text-danger">Create New</h5>
                                            </div>
                                            <div class="ms-auto mt-4">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>

    <!--app-content closed-->
    </div>

    <!-- Sidebar-right -->
    <div class="sidebar sidebar-right sidebar-animate">
        <div class="panel panel-primary card mb-0 shadow-none border-0">
            <div class="tab-menu-heading border-0 d-flex p-3">
                <div class="card-title mb-0"><i class="fe fe-bell me-2"></i><span class=" pulse"></span>Workflow
                </div>
                <div class="card-options ms-auto">
                    <a href="javascript:void(0);" class="sidebar-icon text-end float-end me-3 mb-1"
                        data-bs-toggle="sidebar-right" data-target=".sidebar-right"><i
                            class="fe fe-x text-white"></i></a>
                </div>
            </div>
            <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
                <div class="tabs-menu border-bottom">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li><a href="#side2" data-bs-toggle="tab"><i class="fe fe-home"></i> Profile</a></li>
                        {{-- <li class=""><a href="#side1" class="active" data-bs-toggle="tab"><i
                                    class="fe fe-git-branch me-1"></i>Strings</a></li> --}}
                        <li class=""><a href="{{ route('calender') }}" class="active"><i
                                    class="fe fe-git-branch me-1"></i>Strings</a></li>
                        <li><a href="#side2" data-bs-toggle="tab"><i class="fe fe-mail"></i> Mail</a></li>
                        <li><a href="#side3" data-bs-toggle="tab"><i class="fe fe-clock me-1"></i>Activity</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="side1">
                        <div class="p-3 fw-semibold ps-5">Today's Strings</div>
                        <div class="card-body pt-2">
                            <div class="browser-stats">
                                <div class="row mb-4">
                                    <div class="col-sm-2 mb-sm-0 mb-3">
                                        <span class="feeds avatar-circle brround bg-primary-transparent"><i
                                                class="fe fe-user text-primary"></i></span>
                                    </div>
                                    <div class="col-sm-10 ps-sm-0">
                                        <div class="d-flex align-items-end justify-content-between ms-2">
                                            <h6 class="">New user registered</h6>
                                            <div>
                                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                                <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-2 mb-sm-0 mb-3">
                                        <span
                                            class="feeds avatar-circle avatar-circle-secondary brround bg-secondary-transparent"><i
                                                class="fe fe-shopping-cart text-secondary"></i></span>
                                    </div>
                                    <div class="col-sm-10 ps-sm-0">
                                        <div class="d-flex align-items-end justify-content-between ms-2">
                                            <h6 class="">New order delivered</h6>
                                            <div>
                                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                                <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-2 mb-sm-0 mb-3">
                                        <span
                                            class="feeds avatar-circle avatar-circle-danger brround bg-danger-transparent"><i
                                                class="fe fe-bell text-danger"></i></span>
                                    </div>
                                    <div class="col-sm-10 ps-sm-0">
                                        <div class="d-flex align-items-end justify-content-between ms-2">
                                            <h6 class="">You have pending tasks</h6>
                                            <div>
                                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                                <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-2 mb-sm-0 mb-3">
                                        <span
                                            class="feeds avatar-circle avatar-circle-warning brround bg-warning-transparent"><i
                                                class="fe fe-gitlab text-warning"></i></span>
                                    </div>
                                    <div class="col-sm-10 ps-sm-0">
                                        <div class="d-flex align-items-end justify-content-between ms-2">
                                            <h6 class="">New version arrived</h6>
                                            <div>
                                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                                <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-2 mb-sm-0 mb-3">
                                        <span class="feeds avatar-circle avatar-circle-pink brround bg-pink-transparent"><i
                                                class="fe fe-database text-pink"></i></span>
                                    </div>
                                    <div class="col-sm-10 ps-sm-0">
                                        <div class="d-flex align-items-end justify-content-between ms-2">
                                            <h6 class="">Server #1 overloaded</h6>
                                            <div>
                                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                                <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 mb-sm-0 mb-3">
                                        <span class="feeds avatar-circle avatar-circle-info brround bg-info-transparent"><i
                                                class="fe fe-check-circle text-info"></i></span>
                                    </div>
                                    <div class="col-sm-10 ps-sm-0">
                                        <div class="d-flex align-items-end justify-content-between ms-2">
                                            <h6 class="">New project launched</h6>
                                            <div>
                                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                                <a href="javascript:void(0)"><i class="fe fe-x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 fw-semibold ps-5">Settings</div>
                        <div class="card-body pt-2">
                            <div class="browser-stats">
                                <div class="row mb-4">
                                    <div class="col-sm-2 mb-sm-0 mb-3">
                                        <span class="feeds avatar-circle brround bg-primary-transparent"><i
                                                class="fe fe-settings text-primary"></i></span>
                                    </div>
                                    <div class="col-sm-10 ps-sm-0">
                                        <div class="d-flex align-items-end justify-content-between ms-2">
                                            <h6 class="">General Settings</h6>
                                            <div>
                                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-2 mb-sm-0 mb-3">
                                        <span
                                            class="feeds avatar-circle avatar-circle-secondary brround bg-secondary-transparent"><i
                                                class="fe fe-map-pin text-secondary"></i></span>
                                    </div>
                                    <div class="col-sm-10 ps-sm-0">
                                        <div class="d-flex align-items-end justify-content-between ms-2">
                                            <h6 class="">Map Settings</h6>
                                            <div>
                                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-2 mb-sm-0 mb-3">
                                        <span
                                            class="feeds avatar-circle avatar-circle-danger brround bg-danger-transparent"><i
                                                class="fe fe-headphones text-danger"></i></span>
                                    </div>
                                    <div class="col-sm-10 ps-sm-0">
                                        <div class="d-flex align-items-end justify-content-between ms-2">
                                            <h6 class="">Support Settings</h6>
                                            <div>
                                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-2 mb-sm-0 mb-3">
                                        <span
                                            class="feeds avatar-circle avatar-circle-warning brround bg-warning-transparent"><i
                                                class="fe fe-credit-card text-warning"></i></span>
                                    </div>
                                    <div class="col-sm-10 ps-sm-0">
                                        <div class="d-flex align-items-end justify-content-between ms-2">
                                            <h6 class="">Payment Settings</h6>
                                            <div>
                                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-2 mb-sm-0 mb-3">
                                        <span class="feeds avatar-circle avatar-circle-pink brround bg-pink-transparent"><i
                                                class="fe fe-bell text-pink"></i></span>
                                    </div>
                                    <div class="col-sm-10 ps-sm-0">
                                        <div class="d-flex align-items-end justify-content-between ms-2">
                                            <h6 class="">Notification Settings</h6>
                                            <div>
                                                <a href="javascript:void(0)"><i class="fe fe-settings me-1"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="side2">
                        <div class="list-group list-group-flush">
                            <div class="pt-3 fw-semibold ps-5">Today</div>
                            <div class="list-group-item d-flex align-items-center">
                                <div class="me-2">
                                    <span class="avatar avatar-md brround cover-image"
                                        data-bs-image-src="../assets/images/users/2.jpg"></span>
                                </div>
                                <div class="">
                                    <a href="chat.html">
                                        <div class="fw-semibold text-dark">Addie Minstra</div>
                                        <p class="mb-0 fs-12 text-muted"> Hey! there I' am available.... </p>
                                    </a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex align-items-center">
                                <div class="me-2">
                                    <span class="avatar avatar-md brround cover-image"
                                        data-bs-image-src="../assets/images/users/11.jpg"><span
                                            class="avatar-status bg-success"></span></span>
                                </div>
                                <div class="">
                                    <a href="chat.html">
                                        <div class="fw-semibold text-dark">Rose Bush</div>
                                        <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you </p>
                                    </a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex align-items-center">
                                <div class="me-2">
                                    <span class="avatar avatar-md brround cover-image"
                                        data-bs-image-src="../assets/images/users/10.jpg"></span>
                                </div>
                                <div class="">
                                    <a href="chat.html">
                                        <div class="fw-semibold text-dark">Claude Strophobia</div>
                                        <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project......
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex align-items-center">
                                <div class="me-2">
                                    <span class="avatar avatar-md brround cover-image"
                                        data-bs-image-src="../assets/images/users/13.jpg"></span>
                                </div>
                                <div class="">
                                    <a href="chat.html">
                                        <div class="fw-semibold text-dark">Eileen Dover</div>
                                        <p class="mb-0 fs-12 text-muted"> New product Launching... </p>
                                    </a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex align-items-center">
                                <div class="me-2">
                                    <span class="avatar avatar-md brround cover-image"
                                        data-bs-image-src="../assets/images/users/12.jpg"><span
                                            class="avatar-status bg-success"></span></span>
                                </div>
                                <div class="">
                                    <a href="chat.html">
                                        <div class="fw-semibold text-dark">Willie Findit</div>
                                        <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you </p>
                                    </a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex align-items-center">
                                <div class="me-2">
                                    <span class="avatar avatar-md brround cover-image"
                                        data-bs-image-src="../assets/images/users/15.jpg"></span>
                                </div>
                                <div class="">
                                    <a href="chat.html">
                                        <div class="fw-semibold text-dark">Manny Jah</div>
                                        <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project......
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex align-items-center">
                                <div class="me-2">
                                    <span class="avatar avatar-md brround cover-image"
                                        data-bs-image-src="../assets/images/users/4.jpg"></span>
                                </div>
                                <div class="">
                                    <a href="chat.html">
                                        <div class="fw-semibold text-dark">Cherry Blossom</div>
                                        <p class="mb-0 fs-12 text-muted"> Hey! there I' am available....</p>
                                    </a>
                                </div>
                            </div>
                            <div class="pt-3 fw-semibold ps-5">Yesterday</div>
                            <div class="list-group-item d-flex align-items-center">
                                <div class="me-2">
                                    <span class="avatar avatar-md brround cover-image"
                                        data-bs-image-src="../assets/images/users/7.jpg"><span
                                            class="avatar-status bg-success"></span></span>
                                </div>
                                <div class="">
                                    <a href="chat.html">
                                        <div class="fw-semibold text-dark">Simon Sais</div>
                                        <p class="mb-0 fs-12 text-muted">Schedule Realease...... </p>
                                    </a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex align-items-center">
                                <div class="me-2">
                                    <span class="avatar avatar-md brround cover-image"
                                        data-bs-image-src="../assets/images/users/9.jpg"></span>
                                </div>
                                <div class="">
                                    <a href="chat.html">
                                        <div class="fw-semibold text-dark">Laura Biding</div>
                                        <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project......
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex align-items-center">
                                <div class="me-2">
                                    <span class="avatar avatar-md brround cover-image"
                                        data-bs-image-src="../assets/images/users/2.jpg"><span
                                            class="avatar-status bg-success"></span></span>
                                </div>
                                <div class="">
                                    <a href="chat.html">
                                        <div class="fw-semibold text-dark">Addie Minstra</div>
                                        <p class="mb-0 fs-12 text-muted">Contact me for details....</p>
                                    </a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex align-items-center">
                                <div class="me-2">
                                    <span class="avatar avatar-md brround cover-image"
                                        data-bs-image-src="../assets/images/users/9.jpg"></span>
                                </div>
                                <div class="">
                                    <a href="chat.html">
                                        <div class="fw-semibold text-dark">Ivan Notheridiya</div>
                                        <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project......
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex align-items-center">
                                <div class="me-2">
                                    <span class="avatar avatar-md brround cover-image"
                                        data-bs-image-src="../assets/images/users/14.jpg"></span>
                                </div>
                                <div class="">
                                    <a href="chat.html">
                                        <div class="fw-semibold text-dark">Dulcie Veeta</div>
                                        <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you </p>
                                    </a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex align-items-center">
                                <div class="me-2">
                                    <span class="avatar avatar-md brround cover-image"
                                        data-bs-image-src="../assets/images/users/11.jpg"></span>
                                </div>
                                <div class="">
                                    <a href="chat.html">
                                        <div class="fw-semibold text-dark">Florinda Carasco</div>
                                        <p class="mb-0 fs-12 text-muted">New product Launching...</p>
                                    </a>
                                </div>
                            </div>
                            <div class="list-group-item d-flex align-items-center">
                                <div class="me-2">
                                    <span class="avatar avatar-md brround cover-image"
                                        data-bs-image-src="../assets/images/users/4.jpg"><span
                                            class="avatar-status bg-success"></span></span>
                                </div>
                                <div class="">
                                    <a href="chat.html">
                                        <div class="fw-semibold text-dark">Cherry Blossom</div>
                                        <p class="mb-0 fs-12 text-muted">cherryblossom@gmail.com</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="side3">
                        <ul class="task-list timeline-task">
                            <li class="d-sm-flex mt-4">
                                <div>
                                    <i class="task-icon1"></i>
                                    <h6 class="fw-semibold">Task Finished<span class="text-muted fs-11 mx-2 fw-normal">09
                                            July 2021</span></h6>
                                    <p class="text-muted fs-12">Adam Berry finished task on<a href="javascript:void(0)"
                                            class="fw-semibold"> Project
                                            Management</a></p>
                                </div>
                                <div class="ms-auto d-md-flex me-3">
                                    <a href="javascript:void(0)" class="text-muted me-2"><span
                                            class="fe fe-edit"></span></a>
                                    <a href="javascript:void(0)" class="text-muted"><span
                                            class="fe fe-trash-2"></span></a>
                                </div>
                            </li>
                            <li class="d-sm-flex">
                                <div>
                                    <i class="task-icon1"></i>
                                    <h6 class="fw-semibold">New Comment<span class="text-muted fs-11 mx-2 fw-normal">05
                                            July 2021</span></h6>
                                    <p class="text-muted fs-12">Victoria commented on Project <a href="javascript:void(0)"
                                            class="fw-semibold"> AngularJS
                                            Template</a></p>
                                </div>
                                <div class="ms-auto d-md-flex me-3">
                                    <a href="javascript:void(0)" class="text-muted me-2"><span
                                            class="fe fe-edit"></span></a>
                                    <a href="javascript:void(0)" class="text-muted"><span
                                            class="fe fe-trash-2"></span></a>
                                </div>
                            </li>
                            <li class="d-sm-flex">
                                <div>
                                    <i class="task-icon1"></i>
                                    <h6 class="fw-semibold">New Comment<span class="text-muted fs-11 mx-2 fw-normal">25
                                            June 2021</span></h6>
                                    <p class="text-muted fs-12">Victoria commented on Project <a href="javascript:void(0)"
                                            class="fw-semibold"> AngularJS
                                            Template</a></p>
                                </div>
                                <div class="ms-auto d-md-flex me-3">
                                    <a href="javascript:void(0)" class="text-muted me-2"><span
                                            class="fe fe-edit"></span></a>
                                    <a href="javascript:void(0)" class="text-muted"><span
                                            class="fe fe-trash-2"></span></a>
                                </div>
                            </li>
                            <li class="d-sm-flex">
                                <div>
                                    <i class="task-icon1"></i>
                                    <h6 class="fw-semibold">Task Overdue<span class="text-muted fs-11 mx-2 fw-normal">14
                                            June 2021</span></h6>
                                    <p class="text-muted mb-0 fs-12">Petey Cruiser finished task <a
                                            href="javascript:void(0)" class="fw-semibold"> Integrated
                                            management</a></p>
                                </div>
                                <div class="ms-auto d-md-flex me-3">
                                    <a href="javascript:void(0)" class="text-muted me-2"><span
                                            class="fe fe-edit"></span></a>
                                    <a href="javascript:void(0)" class="text-muted"><span
                                            class="fe fe-trash-2"></span></a>
                                </div>
                            </li>
                            <li class="d-sm-flex">
                                <div>
                                    <i class="task-icon1"></i>
                                    <h6 class="fw-semibold">Task Overdue<span class="text-muted fs-11 mx-2 fw-normal">29
                                            June 2021</span></h6>
                                    <p class="text-muted mb-0 fs-12">Petey Cruiser finished task <a
                                            href="javascript:void(0)" class="fw-semibold"> Integrated
                                            management</a></p>
                                </div>
                                <div class="ms-auto d-md-flex me-3">
                                    <a href="javascript:void(0)" class="text-muted me-2"><span
                                            class="fe fe-edit"></span></a>
                                    <a href="javascript:void(0)" class="text-muted"><span
                                            class="fe fe-trash-2"></span></a>
                                </div>
                            </li>
                            <li class="d-sm-flex">
                                <div>
                                    <i class="task-icon1"></i>
                                    <h6 class="fw-semibold">Task Finished<span class="text-muted fs-11 mx-2 fw-normal">09
                                            July 2021</span></h6>
                                    <p class="text-muted fs-12">Adam Berry finished task on<a href="javascript:void(0)"
                                            class="fw-semibold"> Project
                                            Management</a></p>
                                </div>
                                <div class="ms-auto d-md-flex me-3">
                                    <a href="javascript:void(0)" class="text-muted me-2"><span
                                            class="fe fe-edit"></span></a>
                                    <a href="javascript:void(0)" class="text-muted"><span
                                            class="fe fe-trash-2"></span></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/Sidebar-right-->


    {{-- Modal for Space creation --}}
    <div class="modal fade" id="createspace">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content country-select-modal">
                <div class="modal-header">
                    {{-- <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button> --}}
                </div>
                <div class="modal-body">
                    <!-- Folder Creation Form -->
                    <h2>Create Space</h2>
                    <form action="{{ route('folders.store', $folder->parent_id ?? null) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Space Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                        <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button"
                            data-bs-target="#option-selector" data-bs-toggle="modal">Cancel</button>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal for Folder creation --}}
    <div class="modal fade" id="createfolder">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content country-select-modal">
                <div class="modal-header">
                    {{-- <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button> --}}
                </div>
                <div class="modal-body">
                    <!-- Folder Creation Form -->
                    <h2>Create Folder</h2>
                    <form action="{{ route('folders.store', $folder->parent_id ?? null) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Folder Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                        <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button"
                            data-bs-target="#option-selector" data-bs-toggle="modal">Cancel</button>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal for File creation --}}
    <div class="modal fade" id="uploadfile">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content country-select-modal">
                <div class="modal-header">
                    {{-- <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button> --}}
                </div>
                <div class="modal-body">
                    <!-- Folder Creation Form -->
                    <h2>Upload a File</h2>
                    <form action="{{ route('folders.store', $folder->parent_id ?? null) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Folder Name</label>
                            <input type="file" name="filename" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Upload</button>
                        <button class="btn ripple btn-danger" data-bs-target="#option-selector" data-bs-toggle="modal"
                            type="button">Cancel</button>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="access-selector">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content country-select-modal">
                <div class="modal-header">
                    <h6 class="modal-title">Access Manager</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <ul class="row p-3">
                        <li class="col-lg-6 mb-6">
                            <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block active"
                                data-bs-target="#createspace" data-bs-toggle="modal">
                                <span class="country-selector"><i class="fa fa-user-plus me-3 language text-center"
                                        style="color: #6c5ffc;"></i></span>Add new Access
                            </a>
                        </li>
                        <li class="col-lg-6 mb-6">
                            <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block active"
                                data-bs-target="#createspace" data-bs-toggle="modal">
                                <span class="country-selector"><i class="fa fa-x me-3 language text-center"
                                        style="color: red;"></i></span>Manage Access
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>





    {{-- <div class="modal fade" id="access-selector">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content country-select-modal">
                <div class="modal-header">
                    <h6 class="modal-title">Give Access To</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <ul class="row p-3">
                        @if ($followers->isEmpty())
                            <li class="col-lg-12 mb-12">
                                <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block active"
                                    data-bs-target="#createspace" data-bs-toggle="modal">
                                    <span class="country-selector"><i class="fa fa-x me-3 language text-center"
                                            style="color: red;"></i></span>Nothing to Show
                                </a>
                            </li>
                        @else
                            @foreach ($followers as $follower)
                                <li class="col-lg-6 mb-2">
                                    <a href="javascript:void(0)" class="btn btn-country btn-lg btn-block active"
                                        data-bs-target="#createspace" data-bs-toggle="modal">
                                        <span class="country-selector"><i class="fa fa-user me-3 language"
                                                style="color: #6c5ffc;"></i></span>{{ $follower->name }}
                                    </a>
                                </li>
                            @endforeach
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div> --}}


@endsection

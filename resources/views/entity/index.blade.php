@extends('layouts.main')

@section('website-page-title', 'Entity')

@section('website-active-entity', 'active')

@section('website-main-section')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                {{-- <div class="card-body">
                    <div class="btn-list">
                        <button class="btn btn-primary off-canvas" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle right offcanvas</button>
                    </div>
                </div> --}}



                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Your Entity Tree</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Apps</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Your Entity Tree</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">
                                    Entity Tree
                                    <button class="btn btn-sm btn-danger p-1 mx-2" data-bs-target="#entityCreate"
                                        data-bs-toggle="modal" data-id="{{ Auth::id() }}">
                                        <i class="fe fe-plus"></i>
                                    </button>
                                </div>
                                {{-- <p class="mg-b-20 card-sub-title fs-12 text-muted">It is Very Easy to Customize
                                    and it uses in website apllication.</p> --}}

                                {{-- Actual Tree --}}
                                <div class="row">
                                    @php
                                        function renderEntityTree($entity, $groupedEntities, $visited = [])
                                        {
                                            $date = new DateTime($entity->created_at);
                                            $formattedDate = $date->format('d-m-Y');

                                            if (in_array($entity->id, $visited)) {
                                                return;
                                            }

                                            $visited[] = $entity->id;

                                            echo '<li data-id="' . $entity->id . '">';
                                            echo '<a href="javascript:void(0)" data-id="' .
                                                $entity->id .
                                                '">' .
                                                $entity->name .
                                                '</a>';
                                            echo '<ul>';
                                            echo '<li>';
                                            // echo '<form method="POST" action="' .
                                            //     route('login.auto', ['id' => $entity->id]) .
                                            //     '" style="display: inline;">' .
                                            //     csrf_field() . // Add CSRF token for security
                                            //     '<button type="submit" class="btn btn-sm mx-1" style="border: none; background: none; padding: 0;">' .
                                            //     '<i class="fe fe-eye" style="color: rgb(82, 82, 255);"></i>|' .
                                            //     '</button>' .
                                            //     '</form>';
                                            echo '<button type="submit" class="btn btn-sm mx-1" style="border: none; background: none; padding: 0;" data-bs-toggle="modal" data-bs-target="#extralargemodal" onclick="setEntityDetails(\'' .
                                                $entity->id .
                                                '\', \'' .
                                                $entity->name .
                                                '\', \'' .
                                                $formattedDate .
                                                '\');"><i class="fe fe-eye" style="color: rgb(82, 82, 255);"></i>|</button>';
                                            echo '<button class="btn btn-sm mx-1" data-bs-target="#subCreate" data-bs-toggle="modal" data-id="' .
                                                $entity->id .
                                                '" onclick="console.log(' .
                                                $entity->id .
                                                ');"><i class="fe fe-plus" style="color: rgb(255, 56, 56);"></i>|</button>';
                                            echo '<button class="btn btn-sm mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" data-id="' .
                                                $entity->name .
                                                '" onclick="setEntityName(\'' .
                                                $entity->name .
                                                '\'); setEntityID(\'' .
                                                $entity->id .
                                                '\');" aria-controls="offcanvasRight"><i class="fe fe-lock" style="color: rgb(234, 234, 0);"></i> | </button>';
                                            echo '<a href="#"><button class="btn btn-sm mx-1"><i class="fe fe-folder" style="color: rgb(234, 234, 0);"></i></button></a>';
                                            echo '</li>';
                                            echo '</ul>';

                                            if (isset($groupedEntities[$entity->id])) {
                                                echo '<ul>';
                                                foreach ($groupedEntities[$entity->id] as $childEntity) {
                                                    renderEntityTree($childEntity, $groupedEntities, $visited);
                                                }
                                                echo '</ul>';
                                            } else {
                                                echo '<ul><li>Nothing to show.</li></ul>';
                                            }

                                            echo '</li>';
                                        }
                                    @endphp

                                    <div class="col-lg-4">
                                        <ul id="tree1">
                                            @if (($userEntity && $userEntity->option === 'work') || $userEntity->option === 'entity')
                                                @php
                                                    renderEntityTree($userEntity, $groupedEntities);
                                                @endphp
                                            @elseif ($userEntity)
                                                @php
                                                    $rootEntities = array_filter($entities->toArray(), function (
                                                        $entity,
                                                    ) use ($userId) {
                                                        return $entity['parent_id'] == $userId;
                                                    });
                                                    foreach ($rootEntities as $entity) {
                                                        renderEntityTree((object) $entity, $groupedEntities);
                                                    }
                                                @endphp
                                            @else
                                                <li>Logged-in user not found.</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW CLOSED -->


                <!-- ROW OPEN -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mg-b-20">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">
                                    Demo Entity Tree
                                </div>
                                <div class="row">
                                    <!-- col -->
                                    <div class="col-lg-4">
                                        <ul id="treeview1">
                                            <li><a href="javascript:void(0)">Entity Name</a>
                                                <ul>
                                                    <li>Department - 1
                                                        <ul>
                                                            <li>Sub Department - 1</li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /col -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW CLOSED -->

            </div>
            <!-- CONTAINER END -->

        </div>
    </div>
    <!--app-content close-->
    </div>

    <!-- Sidebar-right -->
    <div class="sidebar sidebar-right sidebar-animate">
        <div class="panel panel-primary card mb-0 shadow-none border-0">
            <div class="tab-menu-heading border-0 d-flex p-3">
                <div class="card-title mb-0"><i class="fe fe-bell me-2"></i><span class=" pulse"></span>Notifications
                </div>
                <div class="card-options ms-auto">
                    <a href="javascript:void(0);" class="sidebar-icon text-end float-end me-3 mb-1"
                        data-bs-toggle="sidebar-right" data-target=".sidebar-right"><i class="fe fe-x text-white"></i></a>
                </div>
            </div>
            <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
                <div class="tabs-menu border-bottom">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li class=""><a href="#side1" class="active" data-bs-toggle="tab"><i
                                    class="fe fe-settings me-1"></i>Feeds</a></li>
                        <li><a href="#side2" data-bs-toggle="tab"><i class="fe fe-message-circle"></i> Chat</a>
                        </li>
                        <li><a href="#side3" data-bs-toggle="tab"><i class="fe fe-anchor me-1"></i>Timeline</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="side1">
                        <div class="p-3 fw-semibold ps-5">Feeds</div>
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

    <!-- Internal Dtree Treeview js -->
    <script src="../assets/plugins/dtree/dtree.js"></script>
    <script src="../assets/plugins/dtree/dtree1.js"></script>

    <!-- Internal Treeview js -->
    <script src="../assets/plugins/treeview/treeview.js"></script>



    {{-- Modal for Data Display --}}
    <div class="modal fade" id="extralargemodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="row row-sm">
                    <div class="col-xl-8 col-lg-12 col-md-12">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body p-3">
                                <a href="javascript:void(0)"><img src="../assets/images/media/files/img3.jpg"
                                        alt="img" class="br-5 w-100"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <h5 class="mb-3">File details</h5>
                                <div class="">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table-bordered text-nowrap">
                                                    <tbody>
                                                        <tr>
                                                            <th>Selected</th>
                                                            <td id="canvasTitle"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Created on </th>
                                                            <td id="canvasDate"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>ID</th>
                                                            <td id="canvasID"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Dimensions</th>
                                                            <td>1000 x 350</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Resolution Unit</th>
                                                            <td>1</td>
                                                        </tr>
                                                        <tr>
                                                            <th>File Type</th>
                                                            <td>jpg</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="mt-5 text-center">
                                                <a href="{{ route('login') }}"><button type="button"
                                                        class="btn btn-icon btn-info-light me-2 bradius"><i
                                                            class="fe fe-log-in"></i></button></a>
                                                <button type="button"
                                                    class="btn btn-icon  btn-danger-light me-2 bradius"><i
                                                        class="fe fe-trash"></i></button>
                                                <a href="{{ route('showFolder') }}"><button type="button"
                                                        class="btn btn-icon  btn-success-light me-2 bradius"><i
                                                            class="fe fe-folder fs-14"></i></button></a>
                                                <button type="button" class="btn btn-icon  btn-warning-light bradius"><i
                                                        class="fe fe-share-2 fs-14"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- Modal for Entity creation --}}
    <div class="modal fade" id="entityCreate">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content country-select-modal">
                <div class="modal-header">
                    {{-- <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button> --}}
                </div>
                <div class="modal-body">
                    <!-- Folder Creation Form -->
                    <h2>Create Entity</h2>
                    <form action="{{ route('entity.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Entity Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Entity Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" required>
                                <button class="btn btn-outline-success" type="button" id="togglePassword">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>

                        <input type="hidden" name="parent_id" id="user_id_input" value="">

                        <button type="submit" class="btn btn-primary">Create</button>
                        <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button"
                            data-bs-target="#option-selector" data-bs-toggle="modal">Cancel</button>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal for creation --}}
    <div class="modal fade" id="subCreate">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content country-select-modal">
                <div class="modal-header">
                    {{-- <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button> --}}
                </div>
                <div class="modal-body">
                    <!-- Folder Creation Form -->
                    <h2>Create</h2>
                    <form action="{{ route('entity.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" required>
                                <button class="btn btn-outline-success" type="button" id="togglePassword">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>

                        <input type="hidden" name="parent_id" id="parent_id_input" value="">

                        <button type="submit" class="btn btn-primary">Create</button>
                        <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button"
                            data-bs-target="#subCreate" data-bs-toggle="modal">Cancel</button>
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <!--Right Offcanvas-->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h4 id="offcanvasRightLabel">Manage Access</h4>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i
                    class="fe fe-x fs-18"></i></button>
        </div>
        <div class="offcanvas-body">
            <h4>Name: <span id="canvasTitle"></span> </h4>
            <div class="col-12 col-sm-12">
                <div class="card">
                    <div class="card-body pt-4">
                        <div class="grid-margin">
                            <div class="">
                                <div class="panel panel-primary">
                                    <div class="panel-body tabs-menu-body border-0 pt-0">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab5">
                                                <div class="table-responsive">
                                                    <table id="data-table" class="table table-bordered text-nowrap mb-0">
                                                        <thead class="border-top">
                                                            <tr>
                                                                <th class="bg-transparent border-bottom-0 text-center">Name
                                                                </th>
                                                                <th class="bg-transparent border-bottom-0 text-center"
                                                                    style="width: 5%;">
                                                                    Action</th>
                                                            </tr>
                                                        </thead>
                                                        @foreach ($followers as $follow)
                                                            <tbody class="text-center">
                                                                <tr class="border-bottom">
                                                                    <td class="text-center">
                                                                        <div class="mt-0 mt-sm-2 d-block">
                                                                            <h6 class="mb-0 fs-14 fw-semibold">
                                                                                {{ $follow->name }}
                                                                            </h6>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <form
                                                                            action="{{ route('access.store', $follow->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div class="g-2">
                                                                                <button type="submit"
                                                                                    class="btn text-primary btn-sm"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-original-title="Edit"
                                                                                    data-bs-follow_id="{{ $follow->id }}">
                                                                                    <span class="fas fa-key"></span>
                                                                                </button>

                                                                                <input type="hidden" name="access_of"
                                                                                    id="entity_id">
                                                                            </div>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        @endforeach


                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/Right Offcanvas-->



    <script>
        document.getElementById('subCreate').addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget;
            // Extract info from data-id attributes
            var parentId = button.getAttribute('data-id');
            // Update the modal's content.
            var parentIdInput = document.getElementById('parent_id_input');
            console.log(parent_id_input);
            parentIdInput.value = parentId;
        });

        function setEntityName(entityName) {
            document.getElementById('canvasTitle').innerText = entityName;
        }

        function setEntityDetails(entityID, entityName, entityDate) {
            document.getElementById('canvasTitle').innerText = entityName;
            document.getElementById('canvasID').innerText = entityID;
            document.getElementById('canvasDate').innerText = entityDate;
        }

        function setEntityID(entityID) {
            document.getElementById('entity_id').innerText = entityID;
        }


        document.getElementById('entityCreate').addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget;
            // Extract info from data-id attributes
            var userId = button.getAttribute('data-id');
            // Update the modal's content.
            var userIdInput = document.getElementById('user_id_input');
            console.log(user_id_input);
            userIdInput.value = userId;
        });


        document.addEventListener('DOMContentLoaded', function() {
            const entityListItems = document.querySelectorAll('#tree1 li');
            const entityAnchorTags = document.querySelectorAll('#tree1 a');

            entityListItems.forEach(item => {
                const entityId = item.dataset.id;
                if (entityId) {
                    console.log('Entity ID (li):', entityId);
                    // You can now use the entityId variable as needed.
                    // Example: Store it in an array, use it in an API call, etc.
                }
            });

            entityAnchorTags.forEach(anchor => {
                const entityId = anchor.dataset.id;
                if (entityId) {
                    console.log('Entity ID (a):', entityId);
                }
            });
        });
    </script>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePasswordButton = document.getElementById('togglePassword');

        togglePasswordButton.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
@endsection

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


@extends('layouts.main')

@section('website-page-title', 'Edit Profile')

@section('website-active-profile', 'active')

@section('website-main-section')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Edit Profile</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 OPEN -->
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Edit Password</div>
                            </div>
                            <div class="card-body">
                                <div class="text-center chat-image mb-5">
                                    <div class="avatar avatar-xxl chat-profile mb-3 brround">
                                        <a class="" href="profile.html"><img alt="avatar"
                                                src="../assets/images/users/7.jpg" class="brround"></a>
                                    </div>
                                    @if(Auth::check())
                                    <div class="main-chat-msg-name">
                                        <a href="profile.html">
                                            <h5 class="mb-1 text-dark fw-semibold">{{Auth::user()->name}}</h5>
                                        </a>
                                        <p class="text-muted mt-0 mb-0 pt-0 fs-13">{{Auth::user()->email}}</p>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Current Password</label>
                                    <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                        <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                            <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                        </a>
                                        <input class="input100 form-control" type="password" placeholder="Current Password"
                                            autocomplete="current-password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">New Password</label>
                                    <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                        <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                            <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                        </a>
                                        <input class="input100 form-control" type="password" placeholder="New Password"
                                            autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                        <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                            <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                        </a>
                                        <input class="input100 form-control" type="password" placeholder="Confirm Password"
                                            autocomplete="new-password">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <a href="javascript:void(0)" class="btn btn-primary">Update</a>
                                <a href="javascript:void(0)" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                        <div class="card panel-theme">
                            <div class="card-header">
                                <div class="float-start">
                                    <h3 class="card-title">Contact</h3>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body no-padding">
                                <ul class="list-group no-margin">
                                    <li class="list-group-item d-flex ps-3">
                                        <div class="social social-profile-buttons me-2">
                                            <a class="social-icon text-primary" href="javascript:void(0)"><i
                                                    class="fe fe-mail"></i></a>
                                        </div>
                                        <a href="javascript:void(0)" class="my-auto">support@demo.com</a>
                                    </li>
                                    <li class="list-group-item d-flex ps-3">
                                        <div class="social social-profile-buttons me-2">
                                            <a class="social-icon text-primary" href="javascript:void(0)"><i
                                                    class="fe fe-globe"></i></a>
                                        </div>
                                        <a href="javascript:void(0)" class="my-auto">www.abcd.com</a>
                                    </li>
                                    <li class="list-group-item d-flex ps-3">
                                        <div class="social social-profile-buttons me-2">
                                            <a class="social-icon text-primary" href="javascript:void(0)"><i
                                                    class="fe fe-phone"></i></a>
                                        </div>
                                        <a href="javascript:void(0)" class="my-auto">+125 5826 3658</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit Profile</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputname">First Name</label>
                                            <input type="text" class="form-control" id="exampleInputname"
                                                placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputname1">Last Name</label>
                                            <input type="text" class="form-control" id="exampleInputname1"
                                                placeholder="Enter Last Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Email address">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputnumber">Contact Number</label>
                                    <input type="number" class="form-control" id="exampleInputnumber"
                                        placeholder="Contact number">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">About Me</label>
                                    <textarea class="form-control" rows="6">My bio.........</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Website</label>
                                    <input class="form-control" placeholder="http://splink.com">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Date Of Birth</label>
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <select class="form-control select2 form-select">
                                                <option value="0">Date</option>
                                                <option value="1">01</option>
                                                <option value="2">02</option>
                                                <option value="3">03</option>
                                                <option value="4">04</option>
                                                <option value="5">05</option>
                                                <option value="6">06</option>
                                                <option value="7">07</option>
                                                <option value="8">08</option>
                                                <option value="9">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <select class="form-control select2 form-select">
                                                <option value="0">Mon</option>
                                                <option value="1">Jan</option>
                                                <option value="2">Feb</option>
                                                <option value="3">Mar</option>
                                                <option value="4">Apr</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">Aug</option>
                                                <option value="9">Sep</option>
                                                <option value="10">Oct</option>
                                                <option value="11">Nov</option>
                                                <option value="12">Dec</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <select class="form-control select2 form-select">
                                                <option value="0">Year</option>
                                                <option value="1">2018</option>
                                                <option value="2">2017</option>
                                                <option value="3">2016</option>
                                                <option value="4">2015</option>
                                                <option value="5">2014</option>
                                                <option value="6">2013</option>
                                                <option value="7">2102</option>
                                                <option value="8">2012</option>
                                                <option value="9">2011</option>
                                                <option value="10">2010</option>
                                                <option value="11">2009</option>
                                                <option value="12">2008</option>
                                                <option value="13">2007</option>
                                                <option value="14">2006</option>
                                                <option value="15">2005</option>
                                                <option value="16">2004</option>
                                                <option value="17">2003</option>
                                                <option value="18">2002</option>
                                                <option value="19">2001</option>
                                                <option value="20">1999</option>
                                                <option value="21">1998</option>
                                                <option value="22">1997</option>
                                                <option value="23">1996</option>
                                                <option value="24">1995</option>
                                                <option value="25">1994</option>
                                                <option value="26">1993</option>
                                                <option value="27">1992</option>
                                                <option value="28">1991</option>
                                                <option value="29">1990</option>
                                                <option value="30">1989</option>
                                                <option value="31">1988</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <a href="javascript:void(0)" class="btn btn-success my-1">Save</a>
                                <a href="javascript:void(0)" class="btn btn-danger my-1">Cancel</a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Delete Account</div>
                            </div>
                            <div class="card-body">
                                <p>Its Advisable for you to request your data to be sent to your Email.</p>
                                <label class="custom-control custom-checkbox mb-0">
                                    <input type="checkbox" class="custom-control-input" name="example-checkbox1"
                                        value="option1" checked>
                                    <span class="custom-control-label">Yes, Send my data to my Email.</span>
                                </label>
                            </div>
                            <div class="card-footer text-end">
                                <a href="javascript:void(0)" class="btn btn-primary my-1">Deactivate</a>
                                <a href="javascript:void(0)" class="btn btn-danger my-1">Delete Account</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW-1 CLOSED -->

            </div>
            <!--CONTAINER CLOSED -->

        </div>
    </div>
    <!--app-content close-->



    <!-- Sidebar-right -->
    <div class="sidebar sidebar-right sidebar-animate">
        <div class="panel panel-primary card mb-0 shadow-none border-0">
            <div class="tab-menu-heading border-0 d-flex p-3">
                <div class="card-title mb-0"><i class="fe fe-bell me-2"></i><span class=" pulse"></span>Notifications
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
                        <li class=""><a href="#side1" class="active" data-bs-toggle="tab"><i
                                    class="fe fe-settings me-1"></i>Feeds</a></li>
                        <li><a href="#side2" data-bs-toggle="tab"><i class="fe fe-message-circle"></i>
                                Chat</a></li>
                        <li><a href="#side3" data-bs-toggle="tab"><i class="fe fe-anchor me-1"></i>Timeline</a></li>
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
                                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                            data-target="#chatmodel">Addie Minstra</div>
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
                                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                            data-target="#chatmodel">Rose Bush</div>
                                        <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you
                                        </p>
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
                                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                            data-target="#chatmodel">Claude Strophobia</div>
                                        <p class="mb-0 fs-12 text-muted"> Hi we can explain our new
                                            project......
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
                                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                            data-target="#chatmodel">Eileen Dover</div>
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
                                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                            data-target="#chatmodel">Willie Findit</div>
                                        <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you
                                        </p>
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
                                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                            data-target="#chatmodel">Manny Jah</div>
                                        <p class="mb-0 fs-12 text-muted"> Hi we can explain our new
                                            project......
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
                                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                            data-target="#chatmodel">Cherry Blossom</div>
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
                                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                            data-target="#chatmodel">Simon Sais</div>
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
                                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                            data-target="#chatmodel">Laura Biding</div>
                                        <p class="mb-0 fs-12 text-muted"> Hi we can explain our new
                                            project......
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
                                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                            data-target="#chatmodel">Addie Minstra</div>
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
                                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                            data-target="#chatmodel">Ivan Notheridiya</div>
                                        <p class="mb-0 fs-12 text-muted"> Hi we can explain our new
                                            project......
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
                                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                            data-target="#chatmodel">Dulcie Veeta</div>
                                        <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you
                                        </p>
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
                                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                            data-target="#chatmodel">Florinda Carasco</div>
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
                                        <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                            data-target="#chatmodel">Cherry Blossom</div>
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
@endsection

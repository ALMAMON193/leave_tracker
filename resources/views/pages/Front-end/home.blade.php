@extends('layouts.app')
<style>
    body {
        background-color: #fbfbfb;
    }

    @media (min-width: 991.98px) {
        main {
            padding-left: 240px;
        }
    }

    /* Sidebar */
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        padding: 58px 0 0;
        /* Height of navbar */
        box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
        width: 240px;
        z-index: 600;
    }

    @media (max-width: 991.98px) {
        .sidebar {
            width: 100%;
        }
    }

    .sidebar .active {
        border-radius: 5px;
        box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
    }

    .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: 0.5rem;
        overflow-x: hidden;
        overflow-y: auto;
        /* Scrollable contents if viewport is shorter than content. */
    }

    .custom-card {
        border-left: 5px solid pink;
        transition: border-color 0.3s ease;
        /* Smooth transition effect */
    }

    .custom-card:hover {
        border-color: blue;
        /* Change border color on hover */
    }
</style>
@section('content')
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">

                    <a href="#" class="list-group-item list-group-item-action py-2 ripple active">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Dashboard</span>
                    </a>


                    <a href="{{ route('leave.request') }}" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-money-bill fa-fw me-3" id="requestManageLink"></i><span>Leave Manage</span></a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <div class="container-fluid">
                <!-- Navbar brand/logo -->
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/logo.png') }}" height="30" alt="Logo">
                </a>
                <!-- Navbar toggle button for small screens -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar links and user information -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">

                        <!-- User information -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('images/user.webp') }}" class="rounded-circle" height="30">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li>
                                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <a class="dropdown-item" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">Logout</a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <!-- End of User information -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar -->

        <!-- Navbar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main>
        <section class="py-8">
            <div class="container">
                <div class="bg-white rounded shadow overflow-hidden">
                    <div class="pt-4 pb-5 px-6 border-bottom border-secondary-light">
                        <h4 class="mb-0">Recent Leave Record</h4>
                    </div>
                    <div class="px-4 table-responsive">
                        <table class="table mb-0 table-borderless table-striped small">
                            <thead>
                                <tr class="text-secondary">
                                    <th>Transaction ID</th>
                                    <th>Date</th>
                                    <th>E-mail</th>
                                    <th>Subscription</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaveRequests as $request)
                                    <tr>
                                        <td class="py-3 px-4">{{ $request->type }}</td>
                                        <td class="py-3 px-4">{{ $request->start_date }}</td>
                                        <td class="py-3 px-4">{{ $request->end_date }}</td>
                                        <td class="py-3 px-4">{{ $request->reason }}</td>
                                        <td
                                            style="@if ($request->status == 'approved') background-color: #28a745; color: white;
                           @elseif ($request->status == 'rejected') background-color: #dc3545; color: white;
                           @else background-color: #ffc107; color: black; @endif">
                                            {{ $request->status }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </section>

    </main>
    <!--Main layout-->
@endsection

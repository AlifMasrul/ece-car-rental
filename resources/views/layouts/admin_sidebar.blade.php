<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Management
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCars"
            aria-expanded="true" aria-controls="collapseCars">
            <i class="fas fa-fw fa-car"></i>
            <span>Cars</span>
        </a>
        <div id="collapseCars" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Car Actions:</h6>
                <a class="collapse-item" href="{{ route('admin.cars.index') }}">View All Cars</a>
                <a class="collapse-item" href="{{ route('admin.cars.create') }}">Add New Car</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBookings"
            aria-expanded="true" aria-controls="collapseBookings">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Bookings</span>
        </a>
        <div id="collapseBookings" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Booking Actions:</h6>
                <a class="collapse-item" href="{{ route('admin.bookings.pending') }}">Pending Bookings</a>
                <a class="collapse-item" href="{{ route('admin.bookings.history') }}">Booking History</a>
                <a class="collapse-item" href="{{ route('admin.cancellations.pending') }}">Pending Cancellations</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
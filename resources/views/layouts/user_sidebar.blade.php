<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">User Panel</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Interface
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('cars.index') }}">
            <i class="fas fa-fw fa-car"></i>
            <span>Browse Cars</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('bookings.history') }}">
            <i class="fas fa-fw fa-history"></i>
            <span>Booking History</span></a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="{{ route('profile.pending-cancellations') }}">
        <i class="fas fa-fw fa-ban"></i>
        <span>Cancellation Requests</span></a>
</li>

        <hr class="sidebar-divider d-none d-md-block">

        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</ul>
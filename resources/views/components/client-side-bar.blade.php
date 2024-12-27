<style>
    .bg-gradient-dark-purple {
        background-color: #814ca7;
        background-image: linear-gradient(180deg, #814ca7 10%, #5d198e 100%);
        background-size: cover;
    }

</style>

<ul
    class="navbar-nav bg-gradient-dark-purple sidebar sidebar-dark accordion"
    id="accordionSidebar"
    >

    <!-- Sidebar - Brand -->
    <a
        class="sidebar-brand d-flex align-items-center justify-content-center"
        href={{ route('client') }}
    >
        <div class="sidebar-brand-text mx-3">Claps Dev</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('client') }}">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Home</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">Interface</div>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('client.portalIndex') }}">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a 
            class="nav-link collapsed" 
            href="#" 
            data-toggle="collapse" 
            data-target="#collapseClients" 
            aria-expanded="true" 
            aria-controls="collapseClients"
        >
            <i class="fas fa-fw fa-users"></i>
            <span>My Work-Space</span>
        </a>
        <div 
            id="collapseClients" 
            class="collapse" 
            aria-labelledby="headingClients" 
            data-parent="#accordionSidebar"
        >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">WorkSpace Options:</h6>
                <a class="collapse-item" href="{{ route('client.myProjects', ['id' => Auth::user()->id]) }}">My Projects</a>
                <a class="collapse-item" href="#">Coming Soon</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - projects Collapse Menu -->
    <li class="nav-item">
        <a
        class="nav-link collapsed"
        href="#"
        data-toggle="collapse"
        data-target="#collapseUtilities"
        aria-expanded="true"
        aria-controls="collapseUtilities"
        >
        <i class="fas fa-clipboard-list"></i>
        <span>Our Subscriptions</span>
        </a>
        <div
        id="collapseUtilities"
        class="collapse"
        aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar"
        >
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Subscriptions:</h6>
            <a class="collapse-item" href="">Comming Soon</a>
            <a class="collapse-item" href="">Comming Soon</a>
        </div>
        </div>
    </li>

    <!-- Nav Item - Tickets Collapse Menu -->
    <li class="nav-item">
        <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapseTickets"
            aria-expanded="true"
            aria-controls="collapseTickets"
        >
            <i class="fas fa-ticket-alt"></i>
            <span>Contact Us</span>
        </a>
        <div
            id="collapseTickets"
            class="collapse"
            aria-labelledby="headingTickets"
            data-parent="#accordionSidebar"
        >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Contact Options:</h6>
                <a class="collapse-item" href="">Support Tickets</a>
                <a class="collapse-item" href="">Schedule Meeting</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Sprint Management Collapse Menu -->
    <!-- <li class="nav-item">
        <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapseSprintManagement"
            aria-expanded="true"
            aria-controls="collapseSprintManagement"
        >
            <i class="fas fa-tasks"></i>
            <span>Sprint</span>
        </a>
        <div
            id="collapseSprintManagement"
            class="collapse"
            aria-labelledby="headingSprintManagement"
            data-parent="#accordionSidebar"
        >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Sprint:</h6>
                <a class="collapse-item" href="{{ route('sprint.empView') }}">View Sprint</a>
            </div>
        </div>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <!-- <div class="sidebar-heading">Addons</div> -->

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item">
        <a
        class="nav-link collapsed"
        href="#"
        data-toggle="collapse"
        data-target="#collapsePages"
        aria-expanded="true"
        aria-controls="collapsePages"
        >
        <i class="fas fa-fw fa-folder"></i>
        <span>Pages</span>
        </a>
        <div
        id="collapsePages"
        class="collapse"
        aria-labelledby="headingPages"
        data-parent="#accordionSidebar"
        >
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Workflow:</h6>
            <a class="collapse-item" href="{{route('calender.index')}}">Calender</a>
            <a class="collapse-item" href="">Meetings</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
        </div>
        </div>
    </li> -->

    <!-- Nav Item - Charts -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Charts</span></a
        >
    </li> -->

    <!-- Nav Item - Tables -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span></a
        >
    </li> -->

    <!-- Divider -->
    <!-- <hr class="sidebar-divider d-none d-md-block" /> -->

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    </ul>

    <x-logoutModule />
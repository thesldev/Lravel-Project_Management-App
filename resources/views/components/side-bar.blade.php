<ul
    class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
     id="accordionSidebar"
    >
    <!-- Sidebar - Brand -->
    <a
        class="sidebar-brand d-flex align-items-center justify-content-center"
        href={{ route('supAdmin') }}
    >
        <div class="sidebar-brand-text mx-3">Claps Dev</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('supAdmin') }}">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">Interface</div>

    <!-- Nav Item - clients Collapse Menu -->
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
            <span>Clients</span>
        </a>
        <div 
            id="collapseClients" 
            class="collapse" 
            aria-labelledby="headingClients" 
            data-parent="#accordionSidebar"
        >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Client Options:</h6>
                <a class="collapse-item" href="{{ route('client.index') }}">View All Clients</a>
                <a class="collapse-item" href="{{ route('client.create') }}">Add New Client</a>
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
        <span>Projects</span>
        </a>
        <div
        id="collapseUtilities"
        class="collapse"
        aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar"
        >
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Projects:</h6>
            <a class="collapse-item" href="{{route('projects.index')}}">View All Projects</a>
            <a class="collapse-item" href="{{route('project.create')}}">Add New Project</a>
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
            <span>Tickets</span>
        </a>
        <div
            id="collapseTickets"
            class="collapse"
            aria-labelledby="headingTickets"
            data-parent="#accordionSidebar"
        >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Tickets:</h6>
                <a class="collapse-item" href="{{route('board.index')}}">Manage Board</a>
                <a class="collapse-item" href="{{route('ticket.index')}}">Manage Ticket</a>
                <a class="collapse-item" href="{{route('status.status')}}">Add Ticket Status</a>
                <a class="collapse-item" href="{{route('type.index')}}">Add Ticket Types</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Employees Collapse Menu -->
    <li class="nav-item">
        <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapseEmployees"
            aria-expanded="true"
            aria-controls="collapseEmployees"
        >
            <i class="fas fa-user-friends"></i>
            <span>Employees</span>
        </a>
        <div
            id="collapseEmployees"
            class="collapse"
            aria-labelledby="headingEmployees"
            data-parent="#accordionSidebar"
        >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Employees:</h6>
                <a class="collapse-item" href="{{route('employee.index')}}">View All Employees</a>
                <a class="collapse-item" href="{{route('employee.create')}}">Add New Employee</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Sprint Management Collapse Menu -->
    <li class="nav-item">
        <a
            class="nav-link collapsed"
            href="#"
            data-toggle="collapse"
            data-target="#collapseSprintManagement"
            aria-expanded="true"
            aria-controls="collapseSprintManagement"
        >
            <i class="fas fa-tasks"></i>
            <span>Sprint Management</span>
        </a>
        <div
            id="collapseSprintManagement"
            class="collapse"
            aria-labelledby="headingSprintManagement"
            data-parent="#accordionSidebar"
        >
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Sprints:</h6>
                <a class="collapse-item" href="">View All Sprints</a>
                <a class="collapse-item" href="{{route('sprint.index')}}">Create New Sprint</a>
                <div class="dropdown-divider"></div>
                <h6 class="collapse-header">Backlog Management:</h6>
                <a class="collapse-item" href="">View Backlog</a>
                <a class="collapse-item" href="">Create New Issue</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">Addons</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
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
            <a class="collapse-item" href="register.html">Register</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
        </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Charts</span></a
        >
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span></a
        >
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    </ul>

    <x-logoutModule />
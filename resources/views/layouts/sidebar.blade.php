<ul class="navbar-nav bg-red-800 sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-text mx-3">BALAKARA sHARADHE</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('products') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Manage Students</span>
        </a>
    </li>

    <!-- Nav Item - Student Form -->
    <li class="nav-item relative">
        <a class="nav-link" href="javascript:void(0);">
            <i class="fas fa-fw fa-comments"></i>
            <span>Add Students</span>
        </a>
        <div class="absolute bg-white rounded-md shadow-lg transform -translate-x-1/2 left-1/2 hidden" style="width: 100%; max-width: 200px;">
            <a href="{{ route('lkg') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">LKG</a>
            <a href="{{ route('ukg') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">UKG</a>
            <a href="{{ route('nursery') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">NURSERY</a>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

<script>
    // JavaScript code to toggle the visibility of the dropdown on click
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggle = document.querySelector('.nav-item.relative');

        dropdownToggle.addEventListener('click', function(event) {
            // Prevents the default behavior of the anchor tag

            const dropdownMenu = this.querySelector('.absolute');
            dropdownMenu.classList.toggle('hidden');
        });
    });
</script>

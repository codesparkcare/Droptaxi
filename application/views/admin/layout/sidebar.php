<!-- Sidebar -->
<nav id="sidebar">
    <div class="sidebar-header">
        <div class="logo-icon"><i class="fa-solid fa-taxi"></i></div>
        <h5 class="mb-0 fw-bold">DropTaxi Admin</h5>
    </div>

    <ul class="sidebar-menu">
        <li class="menu-title">Main Navigation</li>
        <li>
            <a href="<?php echo base_url('admin/index'); ?>" class="<?= uri_string() == 'admin/index' || uri_string() == 'admin' ? 'active' : '' ?>">
                <i class="fa-solid fa-gauge"></i> Dashboard
            </a>
        </li>

        <li class="menu-title">Taxi Operations</li>
        <li>
            <a href="<?php echo base_url('admin/bookings'); ?>" class="<?= uri_string() == 'admin/bookings' ? 'active' : '' ?>">
                <i class="fa-solid fa-car"></i> Manage Bookings
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/vehicles'); ?>" class="<?= uri_string() == 'admin/vehicles' ? 'active' : '' ?>">
                <i class="fa-solid fa-sliders"></i> Vehicle Fleet & Tariffs
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/coupons'); ?>" class="<?= uri_string() == 'admin/coupons' ? 'active' : '' ?>">
                <i class="fa-solid fa-ticket"></i> Promo Coupons
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/enquiries'); ?>" class="<?= uri_string() == 'admin/enquiries' ? 'active' : '' ?>">
                <i class="fa-solid fa-envelope"></i> Customer Enquiries
            </a>
        </li>

        <li class="menu-title">System & Gateway</li>
        <li>
            <a href="<?php echo base_url('admin/settings'); ?>" class="<?= uri_string() == 'admin/settings' ? 'active' : '' ?>">
                <i class="fa-solid fa-gear"></i> SMTP & Razorpay Settings
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/logout'); ?>" class="text-danger">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
            </a>
        </li>
    </ul>
</nav>

<!-- Page Content Holder -->
<div id="content">

    <!-- Top Navbar -->
    <header class="top-navbar">
        <div>
            <button type="button" id="sidebarCollapse" class="navbar-btn">
                <i class="fa-solid fa-bars"></i>
            </button>
            <span class="ms-3 fw-medium" style="color: #64748b;">Welcome back, <strong>Super Admin</strong>!</span>
        </div>

        <div class="d-flex align-items-center gap-3">
            <a href="<?= base_url() ?>" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                <i class="fa-solid fa-globe me-1"></i> View Website
            </a>

            <div class="user-profile dropdown">
                <div class="d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="info text-end d-none d-md-flex">
                        <span class="name"><?= $this->session->userdata('admin_name') ?? 'Super Admin' ?></span>
                        <span class="role">Administrator</span>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Super+Admin&background=f59e0b&color=000" alt="Admin">
                </div>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                    <li><a class="dropdown-item py-2" href="<?= base_url('admin/settings') ?>"><i class="fa-solid fa-gear me-2"></i> Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item py-2 text-danger" href="<?= base_url('admin/logout') ?>"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </header>
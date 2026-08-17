<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DropTaxi - All Over Tamil Nadu Drop Taxi & Outstation Cab Service</title>
    <meta name="description" content="Book 24/7 Drop Taxi & Outstation Cabs across Tamil Nadu, Bangalore, Pondicherry. Lowest one-way rates starting at ₹14/km. No return fare!">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Animate CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-yellow: #f59e0b;
            --primary-yellow-hover: #d97706;
            --dark-navy: #0f172a;
            --secondary-dark: #1e293b;
            --accent-gold: #fbbf24;
            --light-bg: #f8fafc;
            --text-main: #334155;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            background-color: var(--light-bg);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6, .brand-font {
            font-family: 'Outfit', sans-serif;
        }

        /* Top Header Announcement Bar */
        .top-announcement {
            background-color: var(--dark-navy);
            color: #94a3b8;
            font-size: 0.85rem;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .top-announcement a {
            color: var(--accent-gold);
            text-decoration: none;
            font-weight: 600;
        }

        /* Navbar */
        .main-navbar {
            background-color: #ffffff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            padding: 12px 0;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .offcanvas {
            z-index: 1085 !important;
        }
        .offcanvas-backdrop {
            z-index: 1075 !important;
        }

        .navbar-brand .logo-badge {
            background: linear-gradient(135deg, var(--primary-yellow), var(--accent-gold));
            color: #000;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }

        .navbar-brand span {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--dark-navy);
            letter-spacing: -0.5px;
        }

        .nav-link {
            font-weight: 600;
            color: var(--dark-navy) !important;
            margin: 0 8px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--primary-yellow) !important;
        }

        .btn-brand-yellow {
            background: linear-gradient(135deg, var(--primary-yellow), #eab308);
            color: #000000 !important;
            font-weight: 700;
            padding: 10px 24px;
            border-radius: 50px;
            border: none;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.35);
            transition: all 0.3s ease;
        }

        .btn-brand-yellow:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.45);
            background: linear-gradient(135deg, #eab308, var(--primary-yellow-hover));
        }

        /* Mobile Header Actions Custom Styling */
        @media (max-width: 991.98px) {
            .header-call-btn {
                width: 38px;
                height: 38px;
                border-radius: 50% !important;
                padding: 0 !important;
                display: inline-flex !important;
                align-items: center;
                justify-content: center;
            }
            .header-icon-btn {
                width: 38px;
                height: 38px;
                padding: 0 !important;
                display: inline-flex !important;
                align-items: center;
                justify-content: center;
            }
            .btn-header-login {
                font-size: 0.85rem !important;
                padding: 6px 14px !important;
                border-radius: 50px !important;
            }
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.94), rgba(30, 41, 59, 0.9)), url('https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            padding: 70px 0 100px 0;
            color: #ffffff;
            position: relative;
        }

        .hero-badge {
            background: rgba(245, 158, 11, 0.15);
            color: var(--accent-gold);
            border: 1px solid rgba(245, 158, 11, 0.4);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            display: inline-block;
            margin-bottom: 20px;
        }

        /* Booking Engine Card */
        .booking-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            color: var(--text-main);
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .trip-tab-btn {
            border: none;
            background: #f1f5f9;
            color: var(--text-muted);
            font-weight: 700;
            padding: 12px 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
            width: 50%;
        }

        .trip-tab-btn.active {
            background: var(--dark-navy);
            color: var(--accent-gold);
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.2);
        }

        .form-control, .form-select {
            padding: 12px 16px;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            font-weight: 500;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-yellow);
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.15);
        }

        /* Vehicle Card Selector */
        .vehicle-select-card {
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            background: #f8fafc;
        }

        .vehicle-select-card.selected, .vehicle-select-card:hover {
            border-color: var(--primary-yellow);
            background: #fffbeb;
            transform: translateY(-2px);
        }

        .vehicle-select-card i {
            font-size: 1.8rem;
            color: var(--primary-yellow-hover);
        }

        /* Fare Summary Alert Box */
        .fare-estimate-box {
            background: linear-gradient(135deg, #fffbeb, #fef3c7);
            border: 1.5px dashed var(--primary-yellow);
            border-radius: 16px;
            padding: 20px;
        }

        /* Feature Badge */
        .feature-icon-box {
            width: 60px;
            height: 60px;
            background: rgba(245, 158, 11, 0.12);
            color: var(--primary-yellow-hover);
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 20px;
        }

        /* Pricing Card */
        .pricing-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
        }

        .pricing-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
            border-color: var(--primary-yellow);
        }

        .pricing-card.featured {
            border: 2px solid var(--primary-yellow);
            box-shadow: 0 15px 35px rgba(245, 158, 11, 0.15);
        }

        .featured-ribbon {
            position: absolute;
            top: -14px;
            right: 20px;
            background: var(--primary-yellow);
            color: #000;
            font-weight: 800;
            font-size: 0.75rem;
            padding: 4px 12px;
            border-radius: 50px;
            text-transform: uppercase;
        }

        /* Floating Action Buttons */
        .floating-action-btn {
            position: fixed;
            bottom: 25px;
            z-index: 9999;
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: #ffffff;
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }

        .floating-action-btn:hover {
            transform: scale(1.1);
            color: #ffffff;
        }

        .float-whatsapp {
            right: 25px;
            background-color: #25D366;
        }

        .float-call {
            right: 90px;
            background-color: #ef4444;
        }

        /* Footer */
        footer {
            background-color: var(--dark-navy);
            color: #94a3b8;
            padding: 70px 0 30px 0;
            border-top: 4px solid var(--primary-yellow);
        }

        footer h5 {
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 20px;
        }

        footer a {
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        footer a:hover {
            color: var(--accent-gold);
        }

        /* Google Places Autocomplete Styling */
        .pac-container {
            border-radius: 14px !important;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18) !important;
            border: 1px solid #e2e8f0 !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            margin-top: 6px !important;
            padding: 6px 0 !important;
            z-index: 9999 !important;
        }

        .pac-item {
            padding: 10px 16px !important;
            font-size: 0.9rem !important;
            cursor: pointer !important;
            border-top: 1px solid #f1f5f9 !important;
            color: #334155 !important;
        }

        .pac-item:first-child {
            border-top: none !important;
        }

        .pac-item:hover, .pac-item-selected {
            background-color: #fffbeb !important;
        }

        .pac-item-query {
            font-size: 0.95rem !important;
            font-weight: 700 !important;
            color: #0f172a !important;
        }
    </style>
</head>
<body>

    <!-- Top Announcement Bar -->
    <div class="top-announcement">
        <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <i class="fa-solid fa-headset me-2 text-warning"></i> 24x7 Customer Helpline: <a href="tel:<?= $settings['contact_phone'] ?? '+919876543210' ?>"><?= $settings['contact_phone'] ?? '+91 98765 43210' ?></a>
                <span class="ms-3 d-none d-md-inline"><i class="fa-solid fa-shield-halved me-1 text-success"></i> Safe & Sanitized Cabs</span>
            </div>
            <div>
                <span class="badge bg-warning text-dark font-weight-bold me-2"><i class="fa-solid fa-bolt me-1"></i> Lowest One-Way Fare</span>
                <span>No Return Charges!</span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <nav class="navbar navbar-expand-lg main-navbar sticky-top">
        <div class="container d-flex align-items-center justify-content-between">
            <a class="navbar-brand d-flex align-items-center gap-2 me-auto me-lg-4" href="<?= base_url() ?>">
                <div class="logo-badge"><i class="fa-solid fa-taxi"></i></div>
                <span>Drop<span class="text-warning">Taxi</span></span>
            </a>

            <!-- Header Action Items (Visible in Header Bar on Mobile & Desktop) -->
            <div class="d-flex align-items-center gap-1 gap-sm-2 order-lg-3 ms-auto me-2 me-lg-0">
                <!-- Customer Login / Account Button (Placed near 3-line hamburger menu on mobile) -->
                <div id="navbar-auth-container">
                    <?php $is_cust_logged = $this->session->userdata('customer_logged_in'); ?>
                    <?php if($is_cust_logged): ?>
                        <div class="dropdown">
                            <button class="btn btn-outline-warning rounded-pill px-2.5 px-md-3 py-1.5 py-md-2 dropdown-toggle font-weight-bold btn-header-login" type="button" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-user-circle me-1"></i> <span class="d-none d-sm-inline"><?= html_escape($this->session->userdata('customer_name')) ?></span><span class="d-inline d-sm-none">Account</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                <li class="px-3 py-2 extra-small text-muted border-bottom">
                                    <div><strong>Phone:</strong> <?= html_escape($this->session->userdata('customer_phone')) ?></div>
                                    <?php if($this->session->userdata('customer_email')): ?>
                                        <div><strong>Email:</strong> <?= html_escape($this->session->userdata('customer_email')) ?></div>
                                    <?php endif; ?>
                                </li>
                                <li><a class="dropdown-item py-2 text-danger" href="javascript:void(0)" onclick="customerLogout()"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Sign Out</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <button type="button" class="btn btn-outline-warning rounded-pill px-2.5 px-md-3 py-1.5 py-md-2 font-weight-bold btn-header-login" onclick="openCustomerAuthModal()">
                            <i class="fa-solid fa-user-lock me-1"></i> <span class="d-none d-lg-inline">Customer Sign In / OTP</span><span class="d-inline d-lg-none">Login</span>
                        </button>
                    <?php endif; ?>
                </div>

                <!-- WhatsApp Button (Icon only on mobile) -->
                <a href="https://wa.me/<?= $settings['whatsapp_number'] ?? '919876543210' ?>" target="_blank" class="btn btn-outline-dark rounded-circle p-2 header-icon-btn" title="WhatsApp Us">
                    <i class="fa-brands fa-whatsapp fs-5 text-success"></i>
                </a>

                <!-- Call Button (Icon only on mobile, 'Call Now' on desktop) -->
                <a href="tel:<?= $settings['contact_phone'] ?? '+919876543210' ?>" class="btn btn-brand-yellow header-call-btn" title="Call Now">
                    <i class="fa-solid fa-phone"></i><span class="d-none d-lg-inline ms-2">Call Now</span>
                </a>
            </div>

            <!-- 3-Line Hamburger Menu Toggler (Opens Left Side Navigation Drawer on Mobile) -->
            <button class="navbar-toggler border-0 order-lg-4 p-1 ms-1 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#leftSideNavDrawer" aria-controls="leftSideNavDrawer">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Desktop Navigation Menu Links -->
            <div class="collapse navbar-collapse order-lg-2" id="navbarMain">
                <ul class="navbar-menu navbar-nav mx-auto text-center py-2 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#booking-section">Book Taxi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tariffs">Tariff & Rates</a></li>
                    <li class="nav-item"><a class="nav-link" href="#why-us">Why Choose Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Left Side Navigation Offcanvas Drawer (Mobile View) -->
    <div class="offcanvas offcanvas-start shadow" tabindex="-1" id="leftSideNavDrawer" aria-labelledby="leftSideNavDrawerLabel" style="width: 290px; max-width: 85%;">
        <div class="offcanvas-header bg-dark text-white p-3">
            <div class="d-flex align-items-center gap-2" id="leftSideNavDrawerLabel">
                <div class="logo-badge"><i class="fa-solid fa-taxi text-dark"></i></div>
                <span class="fs-4 fw-extrabold text-white">Drop<span class="text-warning">Taxi</span></span>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0 d-flex flex-column justify-content-between">
            <div class="py-2">
                <div class="px-3 py-2 text-uppercase extra-small fw-bold text-muted border-bottom">Navigation</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link px-3 py-3 text-dark fw-bold border-bottom d-flex align-items-center justify-content-between" href="#booking-section" data-bs-dismiss="offcanvas">
                            <span><i class="fa-solid fa-taxi text-warning me-3"></i> Book Taxi</span>
                            <i class="fa-solid fa-chevron-right text-muted small"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-3 text-dark fw-bold border-bottom d-flex align-items-center justify-content-between" href="#tariffs" data-bs-dismiss="offcanvas">
                            <span><i class="fa-solid fa-tags text-warning me-3"></i> Tariff & Rates</span>
                            <i class="fa-solid fa-chevron-right text-muted small"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-3 text-dark fw-bold border-bottom d-flex align-items-center justify-content-between" href="#why-us" data-bs-dismiss="offcanvas">
                            <span><i class="fa-solid fa-shield-halved text-warning me-3"></i> Why Choose Us</span>
                            <i class="fa-solid fa-chevron-right text-muted small"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-3 text-dark fw-bold border-bottom d-flex align-items-center justify-content-between" href="#contact" data-bs-dismiss="offcanvas">
                            <span><i class="fa-solid fa-envelope text-warning me-3"></i> Contact</span>
                            <i class="fa-solid fa-chevron-right text-muted small"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Helpline & Quick Contact inside Left Nav Drawer -->
            <div class="p-3 bg-light border-top text-center">
                <div class="small text-muted mb-2"><i class="fa-solid fa-headset me-1 text-warning"></i> 24x7 Customer Helpline</div>
                <a href="tel:<?= $settings['contact_phone'] ?? '+919876543210' ?>" class="btn btn-warning w-100 fw-bold rounded-pill mb-2">
                    <i class="fa-solid fa-phone me-2"></i><?= $settings['contact_phone'] ?? '+91 98765 43210' ?>
                </a>
                <a href="https://wa.me/<?= $settings['whatsapp_number'] ?? '919876543210' ?>" target="_blank" class="btn btn-outline-success w-100 fw-bold rounded-pill">
                    <i class="fa-brands fa-whatsapp me-2"></i>WhatsApp Support
                </a>
            </div>
        </div>
    </div>

    <!-- Hero & Instant Booking Engine Section -->
    <section class="hero-section" id="booking-section">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6">
                    <div class="hero-badge animate__animated animate__fadeInDown">
                        <i class="fa-solid fa-star me-1"></i> #1 Rated Outstation Drop Taxi Service
                    </div>
                    <h1 class="display-4 fw-extrabold mb-4 text-white animate__animated animate__fadeInLeft">
                        Tamil Nadu's Lowest Rate <span class="text-warning">One Way Drop Taxi</span>
                    </h1>
                    <p class="fs-5 text-light opacity-90 mb-4 animate__animated animate__fadeInLeft animate__delay-1s">
                        Pay only for one-way distance! No return fare charges across Tamil Nadu, Bangalore, Pondicherry & Kerala.
                    </p>
                    
                    <div class="d-flex flex-wrap gap-4 text-light pt-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-circle-check text-warning fs-5"></i> <span>Zero Hidden Costs</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-circle-check text-warning fs-5"></i> <span>24/7 Instant Pickup</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-circle-check text-warning fs-5"></i> <span>Experienced Drivers</span>
                        </div>
                    </div>
                </div>

                <!-- Interactive Booking Form Widget -->
                <div class="col-lg-6">
                    <div class="booking-card animate__animated animate__fadeInRight">
                        <h4 class="fw-bold mb-3 text-dark text-center"><i class="fa-solid fa-calculator text-warning me-2"></i>Instant Fare & Booking</h4>

                        <!-- Trip Type Toggle -->
                        <div class="d-flex gap-2 mb-4">
                            <button type="button" class="trip-tab-btn active" id="btn-tab-oneway" onclick="setTripType('oneway')">
                                <i class="fa-solid fa-route me-1"></i> One Way Drop
                            </button>
                            <button type="button" class="trip-tab-btn" id="btn-tab-roundtrip" onclick="setTripType('roundtrip')">
                                <i class="fa-solid fa-arrows-rotate me-1"></i> Round Trip
                            </button>
                        </div>

                        <form id="taxiBookingForm">
                            <input type="hidden" name="trip_type" id="trip_type" value="oneway">
                            <input type="hidden" name="distance_km" id="distance_km" value="150">

                            <!-- Locations -->
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary small">Pickup Location</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-location-dot text-danger"></i></span>
                                        <input type="text" class="form-control" name="pickup_location" id="pickup_location" placeholder="e.g. Chennai Central" required onchange="calculateGoogleDistance()" oninput="calculateGoogleDistance()">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label fw-semibold text-secondary small mb-0">Drop Location</label>
                                        <div class="d-flex align-items-center gap-1">
                                            <span class="badge bg-warning text-dark font-weight-bold" id="disp-km-badge" style="font-size: 0.78rem; padding: 4px 8px;" title="Driving Distance">
                                                <i class="fa-solid fa-route me-1"></i><span id="disp-km-val">150</span> KM
                                            </span>
                                            <span class="badge bg-danger text-white font-weight-bold" id="disp-toll-badge" style="font-size: 0.78rem; padding: 4px 8px;" title="Estimated Toll Plazas & Price">
                                                <i class="fa-solid fa-road-barrier me-1"></i><span id="disp-toll-val">3</span> Tolls (Est. ₹<span id="disp-toll-price">255</span>)
                                            </span>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-flag-checkered text-success"></i></span>
                                        <input type="text" class="form-control" name="drop_location" id="drop_location" placeholder="e.g. Bangalore / Coimbatore" required onchange="calculateGoogleDistance()" oninput="calculateGoogleDistance()">
                                    </div>
                                </div>
                            </div>

                            <!-- Dates -->
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary small">Pickup Date</label>
                                    <input type="date" class="form-control" name="pickup_date" id="pickup_date" value="<?= date('Y-m-d') ?>" required onchange="calculateGoogleDistance()">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary small">Pickup Time</label>
                                    <input type="time" class="form-control" name="pickup_time" id="pickup_time" value="09:00" required>
                                </div>
                                <div class="col-md-12 d-none" id="return_date_container">
                                    <label class="form-label fw-semibold text-secondary small">Return Date</label>
                                    <input type="date" class="form-control" name="return_date" id="return_date" onchange="calculateGoogleDistance()">
                                </div>
                            </div>

                            <!-- Vehicle Selection Grid -->
                            <label class="form-label fw-semibold text-secondary small mb-2">Select Vehicle Type</label>
                            <div class="row g-2 mb-3">
                                <?php if(!empty($vehicles)): foreach($vehicles as $idx => $v): ?>
                                <div class="col-6 col-md-3">
                                    <div class="vehicle-select-card <?= $idx === 0 ? 'selected' : '' ?>" 
                                         id="card-<?= html_escape($v['type_key']) ?>" 
                                         onclick="selectVehicle('<?= html_escape($v['type_key']) ?>')"
                                         data-oneway="<?= floatval($v['per_km_oneway']) ?>"
                                         data-roundtrip="<?= floatval($v['per_km_roundtrip']) ?>"
                                         data-min-oneway="<?= intval($v['min_km_oneway']) ?>"
                                         data-min-roundtrip="<?= intval($v['min_km_roundtrip']) ?>">
                                        <?php 
                                            if($v['type_key']=='sedan') echo '<i class="fa-solid fa-car"></i>';
                                            else if($v['type_key']=='suv') echo '<i class="fa-solid fa-truck-monster"></i>';
                                            else if($v['type_key']=='innova') echo '<i class="fa-solid fa-van-shuttle"></i>';
                                            else echo '<i class="fa-solid fa-bus"></i>';
                                        ?>
                                        <div class="fw-bold mt-1 small"><?= html_escape($v['name']) ?></div>
                                        <div class="text-muted extra-small rate-text">₹<?= number_format($v['per_km_oneway'], 0) ?> / km</div>
                                        <div class="extra-small text-secondary min-km-text" style="font-size: 0.72rem;"><i class="fa-solid fa-gauge-high me-1"></i>Min <span class="min-val"><?= $v['min_km_oneway'] ?></span> KM</div>
                                    </div>
                                </div>
                                <?php endforeach; else: ?>
                                <div class="col-6 col-md-3">
                                    <div class="vehicle-select-card selected" id="card-sedan" onclick="selectVehicle('sedan')" data-oneway="14" data-roundtrip="13" data-min-oneway="130" data-min-roundtrip="250">
                                        <i class="fa-solid fa-car"></i>
                                        <div class="fw-bold mt-1 small">Sedan</div>
                                        <div class="text-muted extra-small rate-text">₹14 / km</div>
                                        <div class="extra-small text-secondary min-km-text" style="font-size: 0.72rem;"><i class="fa-solid fa-gauge-high me-1"></i>Min <span class="min-val">130</span> KM</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="vehicle-select-card" id="card-suv" onclick="selectVehicle('suv')" data-oneway="19" data-roundtrip="17" data-min-oneway="130" data-min-roundtrip="250">
                                        <i class="fa-solid fa-truck-monster"></i>
                                        <div class="fw-bold mt-1 small">SUV</div>
                                        <div class="text-muted extra-small rate-text">₹19 / km</div>
                                        <div class="extra-small text-secondary min-km-text" style="font-size: 0.72rem;"><i class="fa-solid fa-gauge-high me-1"></i>Min <span class="min-val">130</span> KM</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="vehicle-select-card" id="card-innova" onclick="selectVehicle('innova')" data-oneway="22" data-roundtrip="20" data-min-oneway="130" data-min-roundtrip="250">
                                        <i class="fa-solid fa-van-shuttle"></i>
                                        <div class="fw-bold mt-1 small">Innova</div>
                                        <div class="text-muted extra-small rate-text">₹22 / km</div>
                                        <div class="extra-small text-secondary min-km-text" style="font-size: 0.72rem;"><i class="fa-solid fa-gauge-high me-1"></i>Min <span class="min-val">130</span> KM</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="vehicle-select-card" id="card-tempo" onclick="selectVehicle('tempo')" data-oneway="28" data-roundtrip="25" data-min-oneway="150" data-min-roundtrip="300">
                                        <i class="fa-solid fa-bus"></i>
                                        <div class="fw-bold mt-1 small">Tempo</div>
                                        <div class="text-muted extra-small rate-text">₹28 / km</div>
                                        <div class="extra-small text-secondary min-km-text" style="font-size: 0.72rem;"><i class="fa-solid fa-gauge-high me-1"></i>Min <span class="min-val">150</span> KM</div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <input type="hidden" name="vehicle_type" id="vehicle_type" value="sedan">

                            <!-- Coupon Code Input Widget -->
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-ticket text-warning"></i></span>
                                    <input type="text" class="form-control text-uppercase font-monospace" name="coupon_code" id="coupon_code" placeholder="Have a coupon code? (e.g. SAVE100)" onchange="calculateGoogleDistance()">
                                    <button class="btn btn-outline-dark fw-bold" type="button" onclick="calculateGoogleDistance()">Apply</button>
                                </div>
                                <div id="coupon-alert-msg" class="extra-small mt-1 fw-bold d-none"></div>
                            </div>

                            <!-- Live Fare Estimate Box -->
                            <div class="fare-estimate-box mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-semibold text-secondary small">Est. Distance & Rate:</span>
                                    <span class="fw-bold text-dark" id="disp-km-rate">150 km @ ₹14/km</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-semibold text-secondary small">Est. Toll Gates & Fee:</span>
                                    <span class="fw-bold text-danger" id="disp-toll-gate-text"><i class="fa-solid fa-road-barrier me-1"></i><span id="disp-toll-count-text">3</span> Tolls (Est. ₹<span id="disp-toll-price-text">255</span>)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-semibold text-secondary small">Driver Batta:</span>
                                    <span class="fw-bold text-dark" id="disp-batta">₹300</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1 d-none" id="disp-coupon-row">
                                    <span class="fw-semibold text-success small"><i class="fa-solid fa-ticket me-1"></i>Coupon Discount (<span id="disp-coupon-code-text">SAVE100</span>):</span>
                                    <span class="fw-bold text-success">- ₹<span id="disp-discount-amount">100</span></span>
                                </div>
                                <hr class="my-2 text-warning">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-extrabold fs-6 text-dark">Estimated Total:</span>
                                    <span class="fw-extrabold fs-4 text-dark" id="disp-total-fare">₹2,400</span>
                                </div>
                                <div class="extra-small text-muted text-end mt-1">* Includes Est. Toll Fee. State Permit & Parking extra if applicable</div>
                            </div>

                            <!-- Passenger Details Container (Shown when logged in) -->
                            <div id="passenger-details-box" class="<?= $is_cust_logged ? '' : 'd-none' ?>">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label fw-semibold text-secondary small mb-0">Passenger Details</label>
                                    <span class="badge bg-success-subtle text-success border border-success extra-small"><i class="fa-solid fa-lock me-1"></i>Verified Profile (Non-editable)</span>
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control bg-light text-muted border-secondary-subtle" name="passenger_name" id="passenger_name" placeholder="Your Name *" value="<?= html_escape($this->session->userdata('customer_name') ?? '') ?>" readonly required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="tel" class="form-control bg-light text-muted border-secondary-subtle" name="passenger_phone" id="passenger_phone" placeholder="Phone Number *" value="<?= html_escape($this->session->userdata('customer_phone') ?? '') ?>" readonly required>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <input type="email" class="form-control bg-light text-muted border-secondary-subtle" name="passenger_email" id="passenger_email" placeholder="Email Address (for confirmation receipt)" value="<?= html_escape($this->session->userdata('customer_email') ?? '') ?>" readonly>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-brand-yellow w-100 py-3 text-uppercase font-weight-bold fs-6">
                                    <i class="fa-solid fa-taxi me-2"></i> Confirm Booking Now
                                </button>
                            </div>

                            <!-- Sign In Required Box (Shown when NOT logged in) -->
                            <div id="signin-required-box" class="card bg-warning-subtle border-warning rounded-4 p-3 mb-3 text-center <?= $is_cust_logged ? 'd-none' : '' ?>">
                                <div class="fw-bold text-dark mb-1 fs-6"><i class="fa-solid fa-shield-halved text-warning me-1"></i> Customer Verification Required</div>
                                <p class="small text-secondary mb-3">Please sign in with your Phone OTP to verify passenger details and confirm your ride.</p>
                                <button type="button" class="btn btn-warning w-100 py-3 font-weight-bold text-dark text-uppercase shadow-sm fs-6" onclick="openCustomerAuthModal()">
                                    <i class="fa-solid fa-mobile-screen-button me-2"></i> Sign In / Phone OTP to Book
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tariff Pricing Cards Section -->
    <section class="py-5 bg-white" id="tariffs">
        <div class="container py-4">
            <div class="text-center mb-5">
                <span class="badge bg-warning text-dark font-weight-bold text-uppercase px-3 py-2">Transparent Pricing</span>
                <h2 class="display-6 fw-bold mt-2">Cab Tariff & Rates</h2>
                <p class="text-muted">No hidden charges. Clear per kilometer breakdown for all vehicle types.</p>
            </div>

            <div class="row g-4">
                <?php if(!empty($vehicles)): foreach($vehicles as $v): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="pricing-card <?= $v['type_key'] === 'sedan' ? 'featured' : '' ?>">
                        <?php if($v['type_key'] === 'sedan'): ?>
                            <div class="featured-ribbon">Most Popular</div>
                        <?php endif; ?>
                        
                        <div class="feature-icon-box">
                            <?php 
                                if($v['type_key']=='sedan') echo '<i class="fa-solid fa-car"></i>';
                                else if($v['type_key']=='suv') echo '<i class="fa-solid fa-truck-monster"></i>';
                                else if($v['type_key']=='innova') echo '<i class="fa-solid fa-van-shuttle"></i>';
                                else echo '<i class="fa-solid fa-bus"></i>';
                            ?>
                        </div>

                        <h4 class="fw-bold text-dark"><?= html_escape($v['name']) ?></h4>
                        <p class="small text-muted mb-3"><?= html_escape($v['description']) ?></p>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <div class="p-2 bg-light rounded-3 border text-center">
                                    <div class="extra-small text-muted fw-bold text-uppercase" style="font-size: 0.68rem;">One Way</div>
                                    <div class="fs-4 fw-extrabold text-dark">₹<?= number_format($v['per_km_oneway'], 0) ?><span class="fs-6 fw-normal text-muted">/km</span></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-success-subtle rounded-3 border border-success-subtle text-center">
                                    <div class="extra-small text-success fw-bold text-uppercase" style="font-size: 0.68rem;">Round Trip</div>
                                    <div class="fs-4 fw-extrabold text-success">₹<?= number_format($v['per_km_roundtrip'], 0) ?><span class="fs-6 fw-normal text-muted">/km</span></div>
                                </div>
                            </div>
                        </div>

                        <ul class="list-unstyled small mb-4">
                            <li class="py-1"><i class="fa-solid fa-check text-success me-2"></i> Passenger Capacity: <strong><?= $v['capacity'] ?> Seater</strong></li>
                            <li class="py-1"><i class="fa-solid fa-check text-success me-2"></i> Min KM: <strong><?= $v['min_km_oneway'] ?> KM (1-Way) | <?= $v['min_km_roundtrip'] ?> KM (Round)</strong></li>
                            <li class="py-1"><i class="fa-solid fa-check text-success me-2"></i> Driver Batta: <strong>₹<?= number_format($v['driver_batta_oneway'], 0) ?> (1-Way) | ₹<?= number_format($v['driver_batta_roundtrip'], 0) ?> (Round)</strong></li>
                            <li class="py-1"><i class="fa-solid fa-check text-success me-2"></i> Clean AC Cabs & Fasttag Equipped</li>
                        </ul>

                        <a href="#booking-section" onclick="selectVehicle('<?= $v['type_key'] ?>')" class="btn btn-outline-dark w-100 rounded-pill font-weight-bold">
                            Book <?= $v['name'] ?>
                        </a>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-5 bg-white" id="why-us">
        <div class="container py-4">
            <div class="row align-items-center gy-4">
                <div class="col-lg-6">
                    <span class="badge bg-warning text-dark font-weight-bold text-uppercase px-3 py-2 mb-2">Our Promise</span>
                    <h2 class="display-6 fw-bold mb-4">Why Book Your Outstation Trip With DropTaxi?</h2>
                    
                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="feature-icon-box flex-shrink-0 mb-0">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Pay Only For One Way</h5>
                            <p class="text-muted small">No double fare! For one-way drop trips, we never charge return kilometer costs.</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="feature-icon-box flex-shrink-0 mb-0">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">24x7 Doorstep Pickup</h5>
                            <p class="text-muted small">On-time pickup from your exact doorstep anywhere in Tamil Nadu, day or night.</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3">
                        <div class="feature-icon-box flex-shrink-0 mb-0">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Clean Cabs & Polite Drivers</h5>
                            <p class="text-muted small">Well-maintained AC cabs with verified, courteous drivers knowledgeable in outstation routes.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?auto=format&fit=crop&w=800&q=80" alt="Taxi Cab Service" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact & Enquiry Section -->
    <section class="py-5 bg-dark text-white" id="contact">
        <div class="container py-4">
            <div class="row gy-4">
                <div class="col-lg-5">
                    <span class="badge bg-warning text-dark font-weight-bold text-uppercase px-3 py-2 mb-2">Get In Touch</span>
                    <h2 class="display-6 fw-bold mb-3">Have Questions? Contact Us</h2>
                    <p class="text-light opacity-75 mb-4">Our support desk operates 24/7 to assist with your bookings and corporate cab requirements.</p>

                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-warning text-dark rounded-circle p-3"><i class="fa-solid fa-phone fs-4"></i></div>
                        <div>
                            <div class="small text-warning">Call Helpline</div>
                            <div class="fw-bold fs-5"><?= $settings['contact_phone'] ?? '+91 98765 43210' ?></div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-success text-white rounded-circle p-3"><i class="fa-brands fa-whatsapp fs-4"></i></div>
                        <div>
                            <div class="small text-success">WhatsApp Chat</div>
                            <div class="fw-bold fs-5"><?= $settings['whatsapp_number'] ?? '+91 98765 43210' ?></div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary text-white rounded-circle p-3"><i class="fa-solid fa-envelope fs-4"></i></div>
                        <div>
                            <div class="small text-primary">Email Support</div>
                            <div class="fw-bold fs-5"><?= $settings['contact_email'] ?? 'info@droptaxi.com' ?></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="bg-secondary-dark p-4 p-md-5 rounded-4 border border-secondary">
                        <h4 class="fw-bold mb-4 text-white">Send Us An Enquiry</h4>
                        
                        <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success border-0 rounded-3 mb-4">
                                <i class="fa-solid fa-circle-check me-2"></i><?= $this->session->flashdata('success'); ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('welcome/save_enquiry') ?>" method="POST">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control bg-dark border-secondary text-white" name="name" placeholder="Full Name *" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="tel" class="form-control bg-dark border-secondary text-white" name="phone" placeholder="Phone Number *" required>
                                </div>
                                <div class="col-md-12">
                                    <input type="email" class="form-control bg-dark border-secondary text-white" name="email" placeholder="Email Address">
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control bg-dark border-secondary text-white" name="message" rows="4" placeholder="Your Message / Booking Query..."></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-brand-yellow px-5 py-3 w-100 font-weight-bold">
                                        Submit Enquiry
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row gy-4 mb-5">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="logo-badge"><i class="fa-solid fa-taxi"></i></div>
                        <span class="fs-4 fw-extrabold text-white">Drop<span class="text-warning">Taxi</span></span>
                    </div>
                    <p class="small text-muted">Tamil Nadu's premier one-way outstation taxi service. Reliable, punctual, and safe cab rides at the guaranteed lowest rates.</p>
                </div>
                
                <div class="col-6 col-lg-2">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#booking-section">Book Cab</a></li>
                        <li class="mb-2"><a href="#tariffs">Tariff Matrix</a></li>
                        <li class="mb-2"><a href="#why-us">Why Us</a></li>
                        <li class="mb-2"><a href="#contact">Contact</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-3">
                    <h5>Major Service Cities</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2">Chennai Drop Taxi</li>
                        <li class="mb-2">Coimbatore Outstation Taxi</li>
                        <li class="mb-2">Madurai & Trichy Drop Cabs</li>
                        <li class="mb-2">Bangalore & Pondicherry Cabs</li>
                    </ul>
                </div>

                <div class="col-lg-3">
                    <h5>Super Admin Portal</h5>
                    <p class="small text-muted">Manage fleet bookings, driver allocations & settings.</p>
                    <a href="<?= base_url('admin/login') ?>" class="btn btn-outline-warning btn-sm rounded-pill font-weight-bold px-3">
                        <i class="fa-solid fa-lock me-1"></i> Admin Login
                    </a>
                </div>
            </div>

            <hr class="border-secondary opacity-25">
            
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-center small text-muted pt-2">
                <div>&copy; <?= date('Y') ?> DropTaxi Services. All Rights Reserved.</div>
                <div>Designed for Fast Track Taxi Operations</div>
            </div>
        </div>
    </footer>

    <!-- Customer Phone OTP Modal -->
    <div class="modal fade" id="customerAuthModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header bg-dark text-white border-0 py-3">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-shield-halved text-warning me-2"></i>Customer Sign In / Phone OTP</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Step 1: Send OTP -->
                    <div id="otp-step-1">
                        <p class="text-secondary small mb-3">Sign in or register with your Name, Phone Number, and Email to verify your booking.</p>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Your Name *</label>
                            <input type="text" class="form-control" id="modal_cust_name" placeholder="Enter Full Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Phone Number *</label>
                            <input type="tel" class="form-control" id="modal_cust_phone" placeholder="10-digit mobile number" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Email Address (Optional)</label>
                            <input type="email" class="form-control" id="modal_cust_email" placeholder="email@domain.com">
                        </div>
                        <button type="button" class="btn btn-warning w-100 py-2 fw-bold text-dark" onclick="sendCustomerOtp()">
                            <i class="fa-solid fa-paper-plane me-1"></i> Send OTP Verification Code
                        </button>
                    </div>

                    <!-- Step 2: Verify OTP Code -->
                    <div id="otp-step-2" class="d-none">
                        <div class="alert alert-info border-0 rounded-3 small mb-3" id="otp-demo-notice">
                            <i class="fa-solid fa-bell me-1"></i> Demo OTP sent to <strong id="otp_target_phone"></strong>. Code: <strong id="otp_demo_code" class="fs-5 text-dark font-monospace">1234</strong>
                        </div>
                        <p class="text-secondary small mb-3">Please enter the 4-digit verification code sent to your phone number.</p>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Enter 4-Digit OTP Code *</label>
                            <input type="text" class="form-control text-center font-monospace fs-4 fw-bold tracking-wider" id="modal_otp_code" placeholder="----" maxlength="4" required>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-light w-50 py-2" onclick="showOtpStep1()">&larr; Back</button>
                            <button type="button" class="btn btn-success w-50 py-2 fw-bold" onclick="verifyCustomerOtp()">Verify & Sign In</button>
                        </div>
                    </div>

                    <div id="auth-alert-msg" class="alert d-none mt-3 mb-0 small"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Sticky Action Buttons -->
    <a href="tel:<?= $settings['contact_phone'] ?? '+919876543210' ?>" class="floating-action-btn float-call" title="Call Us Now">
        <i class="fa-solid fa-phone"></i>
    </a>
    <a href="https://wa.me/<?= $settings['whatsapp_number'] ?? '919876543210' ?>" target="_blank" class="floating-action-btn float-whatsapp" title="WhatsApp Us">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Maps JS API with Places library -->
    <?php $gmap_key = !empty($settings['google_map_key']) ? $settings['google_map_key'] : 'AIzaSyDEO3zPEcZiGQ2zM5qcDvPqLbHgg9WFPbQ'; ?>
    <?php if (!empty($gmap_key)): ?>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?= html_escape($gmap_key) ?>&libraries=places&callback=initGooglePlaces" async defer></script>
    <?php endif; ?>

    <script>
        var currentTripType = 'oneway';
        var currentVehicle = 'sedan';
        var pickupAutocomplete, dropAutocomplete;

        function initGooglePlaces() {
            var pickupInput = document.getElementById('pickup_location');
            var dropInput = document.getElementById('drop_location');

            if (pickupInput && dropInput && typeof google !== 'undefined' && google.maps && google.maps.places) {
                var options = {
                    types: [],
                    componentRestrictions: { country: 'in' }
                };

                pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput, options);
                dropAutocomplete = new google.maps.places.Autocomplete(dropInput, options);

                pickupAutocomplete.addListener('place_changed', function() {
                    calculateGoogleDistance();
                });

                dropAutocomplete.addListener('place_changed', function() {
                    calculateGoogleDistance();
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (typeof google !== 'undefined' && google.maps && google.maps.places) {
                initGooglePlaces();
            }
        });

        function calculateGoogleDistance() {
            var pickup = document.getElementById('pickup_location').value.trim();
            var drop = document.getElementById('drop_location').value.trim();

            if (!pickup || !drop) {
                calculateFare();
                return;
            }

            if (typeof google !== 'undefined' && google.maps && google.maps.DistanceMatrixService) {
                var service = new google.maps.DistanceMatrixService();
                service.getDistanceMatrix({
                    origins: [pickup],
                    destinations: [drop],
                    travelMode: google.maps.TravelMode.DRIVING,
                    unitSystem: google.maps.UnitSystem.METRIC
                }, function(response, status) {
                    if (status === 'OK' && response.rows && response.rows[0] && response.rows[0].elements && response.rows[0].elements[0] && response.rows[0].elements[0].status === 'OK') {
                        var distanceMeters = response.rows[0].elements[0].distance.value;
                        var distanceKm = Math.round(distanceMeters / 1000);
                        if (distanceKm < 1) distanceKm = 1;
                        document.getElementById('distance_km').value = distanceKm;
                        fetchFareForDistance(distanceKm);
                    } else {
                        calculateFare();
                    }
                });
            } else {
                calculateFare();
            }
        }

        function updateTollDisplay(dist) {
            var pickup = document.getElementById('pickup_location').value.trim();
            var drop = document.getElementById('drop_location').value.trim();

            var tollCount = 0;
            if (dist > 40) {
                tollCount = Math.round(dist / 55);
                if (tollCount < 1) tollCount = 1;
            }

            var tollValEl = document.getElementById('disp-toll-val');
            var tollCountTextEl = document.getElementById('disp-toll-count-text');
            if (tollValEl) tollValEl.innerText = tollCount;
            if (tollCountTextEl) tollCountTextEl.innerText = tollCount;

            if (pickup && drop && typeof google !== 'undefined' && google.maps && google.maps.DirectionsService) {
                var directionsService = new google.maps.DirectionsService();
                directionsService.route({
                    origin: pickup,
                    destination: drop,
                    travelMode: google.maps.TravelMode.DRIVING
                }, function(result, status) {
                    if (status === 'OK' && result.routes && result.routes[0] && result.routes[0].legs && result.routes[0].legs[0]) {
                        var leg = result.routes[0].legs[0];
                        var stepTolls = 0;
                        (leg.steps || []).forEach(function(s) {
                            if (s.instructions && s.instructions.toLowerCase().includes('toll')) {
                                stepTolls++;
                            }
                        });
                        if (stepTolls > tollCount) {
                            tollCount = stepTolls;
                        }
                    }
                    if (tollValEl) tollValEl.innerText = tollCount;
                    if (tollCountTextEl) tollCountTextEl.innerText = tollCount;
                });
            }
        }

        function fetchFareForDistance(dist) {
            var pickupDate = document.getElementById('pickup_date') ? document.getElementById('pickup_date').value : '';
            var returnDate = document.getElementById('return_date') ? document.getElementById('return_date').value : '';
            var couponCode = document.getElementById('coupon_code') ? document.getElementById('coupon_code').value.trim() : '';

            var formData = new FormData();
            formData.append('trip_type', currentTripType);
            formData.append('vehicle_type', currentVehicle);
            formData.append('distance_km', dist);
            formData.append('pickup_date', pickupDate);
            formData.append('return_date', returnDate);
            formData.append('coupon_code', couponCode);

            fetch('<?= base_url("welcome/calculate_fare") ?>', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    var kmValEl = document.getElementById('disp-km-val');
                    if (kmValEl) {
                        kmValEl.innerText = (currentTripType === 'roundtrip') ? (dist * 2) : dist;
                    }

                    document.getElementById('disp-km-rate').innerText = data.billable_km + ' km @ ₹' + data.per_km_rate + '/km';
                    document.getElementById('disp-batta').innerText = '₹' + data.driver_batta;
                    document.getElementById('disp-total-fare').innerText = '₹' + data.estimated_total.toLocaleString('en-IN');

                    var tollValEl = document.getElementById('disp-toll-val');
                    var tollCountTextEl = document.getElementById('disp-toll-count-text');
                    var tollPriceEl = document.getElementById('disp-toll-price');
                    var tollPriceTextEl = document.getElementById('disp-toll-price-text');

                    if (tollValEl) tollValEl.innerText = data.toll_count;
                    if (tollCountTextEl) tollCountTextEl.innerText = data.toll_count;
                    if (tollPriceEl) tollPriceEl.innerText = (data.estimated_toll_fee || 0).toLocaleString('en-IN');
                    if (tollPriceTextEl) tollPriceTextEl.innerText = (data.estimated_toll_fee || 0).toLocaleString('en-IN');

                    // Handle Coupon Display & Alerts
                    var couponRow = document.getElementById('disp-coupon-row');
                    var couponAlert = document.getElementById('coupon-alert-msg');
                    var couponCodeText = document.getElementById('disp-coupon-code-text');
                    var discountAmountEl = document.getElementById('disp-discount-amount');

                    if (data.coupon_applied) {
                        if (couponRow) couponRow.classList.remove('d-none');
                        if (couponCodeText) couponCodeText.innerText = data.coupon_code;
                        if (discountAmountEl) discountAmountEl.innerText = data.discount_amount.toLocaleString('en-IN');

                        if (couponAlert && couponCode) {
                            couponAlert.className = 'extra-small mt-1 fw-bold text-success';
                            couponAlert.innerText = '✓ ' + data.coupon_message;
                            couponAlert.classList.remove('d-none');
                        }
                    } else {
                        if (couponRow) couponRow.classList.add('d-none');
                        if (couponAlert && couponCode) {
                            couponAlert.className = 'extra-small mt-1 fw-bold text-danger';
                            couponAlert.innerText = '✕ ' + (data.coupon_message || 'Invalid coupon code');
                            couponAlert.classList.remove('d-none');
                        } else if (couponAlert) {
                            couponAlert.classList.add('d-none');
                        }
                    }
                }
            });
        }

        function updateVehicleCardRates(type) {
            var cards = document.querySelectorAll('.vehicle-select-card');
            cards.forEach(function(card) {
                var rateTextEl = card.querySelector('.rate-text') || card.querySelector('.text-muted');
                if (rateTextEl) {
                    var rate = (type === 'roundtrip') ? card.getAttribute('data-roundtrip') : card.getAttribute('data-oneway');
                    if (rate) {
                        rateTextEl.innerHTML = '<strong>₹' + parseFloat(rate) + '</strong> / km';
                    }
                }

                var minValEl = card.querySelector('.min-val');
                if (minValEl) {
                    var minKm = (type === 'roundtrip') ? card.getAttribute('data-min-roundtrip') : card.getAttribute('data-min-oneway');
                    if (minKm) {
                        minValEl.innerText = minKm;
                    }
                }
            });
        }

        function setTripType(type) {
            currentTripType = type;
            document.getElementById('trip_type').value = type;
            
            var btnOneway = document.getElementById('btn-tab-oneway');
            var btnRound = document.getElementById('btn-tab-roundtrip');
            var retDateCont = document.getElementById('return_date_container');

            if (type === 'oneway') {
                btnOneway.classList.add('active');
                btnRound.classList.remove('active');
                retDateCont.classList.add('d-none');
            } else {
                btnRound.classList.add('active');
                btnOneway.classList.remove('active');
                retDateCont.classList.remove('d-none');
            }
            updateVehicleCardRates(type);
            calculateGoogleDistance();
        }

        function selectVehicle(type) {
            currentVehicle = type;
            document.getElementById('vehicle_type').value = type;

            var cards = ['sedan', 'suv', 'innova', 'tempo'];
            cards.forEach(function(c) {
                var el = document.getElementById('card-' + c);
                if (el) {
                    if (c === type) {
                        el.classList.add('selected');
                    } else {
                        el.classList.remove('selected');
                    }
                }
            });
            calculateGoogleDistance();
        }

        function setRoute(pickup, drop) {
            document.getElementById('pickup_location').value = pickup;
            document.getElementById('drop_location').value = drop;
            document.getElementById('booking-section').scrollIntoView({ behavior: 'smooth' });
            calculateGoogleDistance();
        }

        function calculateFare() {
            var pickup = document.getElementById('pickup_location').value;
            var drop = document.getElementById('drop_location').value;
            var distance = 150; // Default estimate if distance API is offline

            // Basic route distance heuristic for demonstration
            if (pickup.toLowerCase().includes('chennai') && drop.toLowerCase().includes('bangalore')) distance = 350;
            else if (pickup.toLowerCase().includes('chennai') && drop.toLowerCase().includes('coimbatore')) distance = 500;
            else if (pickup.toLowerCase().includes('chennai') && drop.toLowerCase().includes('pondicherry')) distance = 150;
            else if (pickup.toLowerCase().includes('chennai') && drop.toLowerCase().includes('madurai')) distance = 460;
            else if (pickup.toLowerCase().includes('chennai') && drop.toLowerCase().includes('trichy')) distance = 330;

            document.getElementById('distance_km').value = distance;
            fetchFareForDistance(distance);
        }

        document.getElementById('taxiBookingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            var form = this;
            var formData = new FormData(form);

            fetch('<?= base_url("welcome/create_booking") ?>', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    window.location.href = data.redirect_url;
                } else {
                    alert(data.message || 'Error creating booking.');
                }
            })
            .catch(err => {
                alert('Network error. Please try again.');
            });
        });

        function openCustomerAuthModal() {
            saveDraftBookingForm();
            var pName = document.getElementById('passenger_name') ? document.getElementById('passenger_name').value : '';
            var pPhone = document.getElementById('passenger_phone') ? document.getElementById('passenger_phone').value : '';
            var pEmail = document.getElementById('passenger_email') ? document.getElementById('passenger_email').value : '';

            if (pName) document.getElementById('modal_cust_name').value = pName;
            if (pPhone) document.getElementById('modal_cust_phone').value = pPhone;
            if (pEmail) document.getElementById('modal_cust_email').value = pEmail;

            var modal = new bootstrap.Modal(document.getElementById('customerAuthModal'));
            modal.show();
        }

        function showOtpStep1() {
            document.getElementById('otp-step-1').classList.remove('d-none');
            document.getElementById('otp-step-2').classList.add('d-none');
            document.getElementById('auth-alert-msg').classList.add('d-none');
        }

        function sendCustomerOtp() {
            saveDraftBookingForm();
            var name = document.getElementById('modal_cust_name').value.trim();
            var phone = document.getElementById('modal_cust_phone').value.trim();
            var email = document.getElementById('modal_cust_email').value.trim();
            var alertEl = document.getElementById('auth-alert-msg');

            if (!phone) {
                alertEl.className = 'alert alert-danger mt-3 mb-0 small';
                alertEl.innerText = 'Please enter a valid phone number.';
                alertEl.classList.remove('d-none');
                return;
            }

            var formData = new FormData();
            formData.append('name', name);
            formData.append('phone', phone);
            formData.append('email', email);

            fetch('<?= base_url("welcome/send_otp") ?>', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    document.getElementById('otp_target_phone').innerText = phone;
                    document.getElementById('otp_demo_code').innerText = data.otp;
                    document.getElementById('otp-step-1').classList.add('d-none');
                    document.getElementById('otp-step-2').classList.remove('d-none');
                    alertEl.classList.add('d-none');
                } else {
                    alertEl.className = 'alert alert-danger mt-3 mb-0 small';
                    alertEl.innerText = data.message || 'Error sending OTP.';
                    alertEl.classList.remove('d-none');
                }
            });
        }

        function verifyCustomerOtp() {
            var phone = document.getElementById('modal_cust_phone').value.trim();
            var otp = document.getElementById('modal_otp_code').value.trim();
            var alertEl = document.getElementById('auth-alert-msg');

            if (!otp) {
                alertEl.className = 'alert alert-danger mt-3 mb-0 small';
                alertEl.innerText = 'Please enter the 4-digit OTP code.';
                alertEl.classList.remove('d-none');
                return;
            }

            var formData = new FormData();
            formData.append('phone', phone);
            formData.append('otp', otp);

            fetch('<?= base_url("welcome/verify_otp") ?>', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status && data.customer) {
                    alertEl.className = 'alert alert-success mt-3 mb-0 small';
                    alertEl.innerText = 'Phone verified successfully!';
                    alertEl.classList.remove('d-none');

                    var cust = data.customer;

                    // Fill passenger fields
                    var pName = document.getElementById('passenger_name');
                    var pPhone = document.getElementById('passenger_phone');
                    var pEmail = document.getElementById('passenger_email');

                    if (pName) { pName.value = cust.name; pName.readOnly = true; }
                    if (pPhone) { pPhone.value = cust.phone; pPhone.readOnly = true; }
                    if (pEmail) { pEmail.value = cust.email || ''; pEmail.readOnly = true; }

                    // Toggle booking form boxes dynamically without page reload!
                    var signinBox = document.getElementById('signin-required-box');
                    var detailsBox = document.getElementById('passenger-details-box');
                    if (signinBox) signinBox.classList.add('d-none');
                    if (detailsBox) detailsBox.classList.remove('d-none');

                    // Update top navbar dropdown dynamically
                    var navAuth = document.getElementById('navbar-auth-container');
                    if (navAuth) {
                        navAuth.innerHTML = `
                            <div class="dropdown">
                                <button class="btn btn-outline-warning rounded-pill px-3 py-2 dropdown-toggle font-weight-bold" type="button" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-user-circle me-1"></i> ${escapeHtml(cust.name)}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                    <li class="px-3 py-2 extra-small text-muted border-bottom">
                                        <div><strong>Phone:</strong> ${escapeHtml(cust.phone)}</div>
                                        ${cust.email ? `<div><strong>Email:</strong> ${escapeHtml(cust.email)}</div>` : ''}
                                    </li>
                                    <li><a class="dropdown-item py-2 text-danger" href="javascript:void(0)" onclick="customerLogout()"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Sign Out</a></li>
                                </ul>
                            </div>
                            <a href="https://wa.me/<?= $settings['whatsapp_number'] ?? '919876543210' ?>" target="_blank" class="btn btn-outline-dark rounded-circle p-2" title="WhatsApp Us">
                                <i class="fa-brands fa-whatsapp fs-5 text-success"></i>
                            </a>
                            <a href="tel:<?= $settings['contact_phone'] ?? '+919876543210' ?>" class="btn btn-brand-yellow">
                                <i class="fa-solid fa-phone me-2"></i>Call Now
                            </a>
                        `;
                    }

                    // Restore draft booking form selections
                    restoreDraftBookingForm();

                    // Hide auth modal after short delay
                    setTimeout(function() {
                        var modalEl = document.getElementById('customerAuthModal');
                        var modal = bootstrap.Modal.getInstance(modalEl);
                        if (modal) modal.hide();
                    }, 600);
                } else {
                    alertEl.className = 'alert alert-danger mt-3 mb-0 small';
                    alertEl.innerText = data.message || 'OTP Verification failed.';
                    alertEl.classList.remove('d-none');
                }
            });
        }

        function customerLogout() {
            sessionStorage.removeItem('droptaxi_draft_booking');
            fetch('<?= base_url("welcome/customer_logout") ?>')
            .then(res => res.json())
            .then(data => {
                window.location.reload();
            });
        }

        function saveDraftBookingForm() {
            var draft = {
                trip_type: document.getElementById('trip_type') ? document.getElementById('trip_type').value : '',
                pickup_location: document.getElementById('pickup_location') ? document.getElementById('pickup_location').value : '',
                drop_location: document.getElementById('drop_location') ? document.getElementById('drop_location').value : '',
                pickup_date: document.getElementById('pickup_date') ? document.getElementById('pickup_date').value : '',
                pickup_time: document.getElementById('pickup_time') ? document.getElementById('pickup_time').value : '',
                return_date: document.getElementById('return_date') ? document.getElementById('return_date').value : '',
                vehicle_type: document.getElementById('vehicle_type') ? document.getElementById('vehicle_type').value : '',
                coupon_code: document.getElementById('coupon_code') ? document.getElementById('coupon_code').value : '',
                distance_km: document.getElementById('distance_km') ? document.getElementById('distance_km').value : ''
            };
            sessionStorage.setItem('droptaxi_draft_booking', JSON.stringify(draft));
        }

        function restoreDraftBookingForm() {
            var saved = sessionStorage.getItem('droptaxi_draft_booking');
            if (!saved) return;
            try {
                var draft = JSON.parse(saved);
                if (draft.trip_type && typeof setTripType === 'function') setTripType(draft.trip_type);
                if (draft.pickup_location && document.getElementById('pickup_location')) document.getElementById('pickup_location').value = draft.pickup_location;
                if (draft.drop_location && document.getElementById('drop_location')) document.getElementById('drop_location').value = draft.drop_location;
                if (draft.pickup_date && document.getElementById('pickup_date')) document.getElementById('pickup_date').value = draft.pickup_date;
                if (draft.pickup_time && document.getElementById('pickup_time')) document.getElementById('pickup_time').value = draft.pickup_time;
                if (draft.return_date && document.getElementById('return_date')) document.getElementById('return_date').value = draft.return_date;
                if (draft.coupon_code && document.getElementById('coupon_code')) document.getElementById('coupon_code').value = draft.coupon_code;

                if (draft.vehicle_type && typeof selectVehicle === 'function') {
                    selectVehicle(draft.vehicle_type);
                }
                if (draft.distance_km && typeof calculateFare === 'function') {
                    calculateFare();
                }
            } catch(e) {
                console.error('Error restoring draft booking:', e);
            }
        }

        function escapeHtml(text) {
            if (!text) return '';
            return text.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }

        document.addEventListener('DOMContentLoaded', function() {
            restoreDraftBookingForm();
        });
    </script>
</body>
</html>
    </script>
</body>
</html>

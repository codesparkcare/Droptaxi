<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= html_escape($settings['home_meta_title'] ?? 'DropTaxi | Best One Way Drop Taxi & Outstation Cabs in Tamil Nadu') ?></title>
    <meta name="keywords" content="<?= html_escape($settings['home_meta_keywords'] ?? 'taxi booking, one way drop taxi, two way drop taxi, near by droptaxi, online taxi, outstation drop taxi, drop taxi chennai, drop taxi madurai, drop taxi coimbatore, drop taxi tirunelveli, drop taxi trichy, drop taxi salem, intercity cab booking') ?>">
    <meta name="description" content="<?= html_escape($settings['home_meta_description'] ?? 'Book reliable One Way Drop Taxi & Outstation Cabs across Tamil Nadu, Bangalore & Pondicherry. Pay only for one way. Lowest per km rates, zero hidden charges, 24x7 verified drivers.') ?>">
    <link rel="canonical" href="<?= base_url() ?>">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">

    <!-- OpenGraph & Twitter Cards -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= base_url() ?>">
    <meta property="og:title" content="<?= html_escape($settings['home_meta_title'] ?? 'DropTaxi | Best One Way Drop Taxi & Outstation Cabs in Tamil Nadu') ?>">
    <meta property="og:description" content="<?= html_escape($settings['home_meta_description'] ?? 'Book reliable One Way Drop Taxi & Outstation Cabs across Tamil Nadu, Bangalore & Pondicherry. Pay only for one way. Lowest per km rates, zero hidden charges, 24x7 verified drivers.') ?>">
    <meta property="og:image" content="<?= base_url($settings['og_image'] ?? 'assets/images/og-banner.jpg') ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= html_escape($settings['home_meta_title'] ?? 'DropTaxi | Best One Way Drop Taxi & Outstation Cabs in Tamil Nadu') ?>">
    <meta name="twitter:description" content="<?= html_escape($settings['home_meta_description'] ?? 'Book reliable One Way Drop Taxi & Outstation Cabs across Tamil Nadu...') ?>">
    <meta name="twitter:image" content="<?= base_url($settings['og_image'] ?? 'assets/images/og-banner.jpg') ?>">

    <!-- Google Structured Data (JSON-LD: TaxiService & LocalBusiness & FAQPage) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "TaxiService",
          "@id": "<?= base_url() ?>#taxiservice",
          "name": "DropTaxi - One Way Drop Taxi & Outstation Cabs",
          "url": "<?= base_url() ?>",
          "image": "<?= base_url($settings['og_image'] ?? 'assets/images/og-banner.jpg') ?>",
          "description": "Premier One Way Drop Taxi and Outstation Cab Booking Service in Tamil Nadu, Bangalore & Pondicherry. Save up to 40% with zero return charges.",
          "provider": {
            "@type": "LocalBusiness",
            "name": "DropTaxi Services",
            "telephone": "<?= html_escape($settings['contact_phone'] ?? '+91 98765 43210') ?>",
            "email": "<?= html_escape($settings['contact_email'] ?? 'info@droptaxi.com') ?>",
            "priceRange": "₹14 - ₹28 per km",
            "address": {
              "@type": "PostalAddress",
              "addressRegion": "Tamil Nadu",
              "addressCountry": "IN"
            },
            "aggregateRating": {
              "@type": "AggregateRating",
              "ratingValue": "4.9",
              "reviewCount": "4850",
              "bestRating": "5",
              "worstRating": "1"
            }
          },
          "areaServed": [
            { "@type": "State", "name": "Tamil Nadu" },
            { "@type": "State", "name": "Karnataka" },
            { "@type": "State", "name": "Kerala" },
            { "@type": "State", "name": "Puducherry" }
          ],
          "serviceType": [
            "One Way Drop Taxi",
            "Outstation Taxi Booking",
            "Two Way Outstation Cab",
            "Airport Drop Taxi",
            "Intercity Online Taxi"
          ]
        },
        {
          "@type": "FAQPage",
          "mainEntity": [
            {
              "@type": "Question",
              "name": "What is One Way Drop Taxi and how does it save money?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "With One Way Drop Taxi, you only pay for the exact distance travelled from your pickup to drop destination. Unlike traditional cabs, there are zero return distance charges, saving up to 40% on outstation travel."
              }
            },
            {
              "@type": "Question",
              "name": "How can I book a drop taxi online?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Simply enter your pickup and drop locations on our website to see the instant distance and fare calculation. Select your preferred vehicle (Sedan, SUV, Innova), enter your trip details, and confirm your booking in under 2 minutes."
              }
            },
            {
              "@type": "Question",
              "name": "Are tolls and driver allowances included in the fare?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes! DropTaxi provides completely transparent upfront billing with driver allowance (driver batta) and estimated highway tolls calculated before you book."
              }
            }
          ]
        }
      ]
    }
    </script>
    
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

        /* Smart Custom Autocomplete Dropdown */
        .autocomplete-wrapper {
            position: relative;
            width: 100%;
        }

        .custom-autocomplete-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.18), 0 4px 10px rgba(15, 23, 42, 0.06);
            border: 1px solid #e2e8f0;
            max-height: 290px;
            overflow-y: auto;
            z-index: 9999;
            margin-top: 5px;
            padding: 6px 0;
            display: none;
        }

        .custom-autocomplete-dropdown.show {
            display: block;
            animation: fadeInDown 0.18s ease-out;
        }

        .autocomplete-item {
            padding: 9px 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.15s ease;
            border-bottom: 1px solid #f8fafc;
        }

        .autocomplete-item:last-child {
            border-bottom: none;
        }

        .autocomplete-item:hover, .autocomplete-item.active {
            background-color: #fffbeb;
        }

        .autocomplete-item .item-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f59e0b;
            font-size: 0.85rem;
            flex-shrink: 0;
            transition: all 0.15s ease;
        }

        .autocomplete-item:hover .item-icon, .autocomplete-item.active .item-icon {
            background: #fef3c7;
            color: #d97706;
            transform: scale(1.05);
        }

        .autocomplete-item .item-content {
            flex-grow: 1;
            overflow: hidden;
            text-align: left;
        }

        .autocomplete-item .main-text {
            font-size: 0.9rem;
            font-weight: 700;
            color: #1e293b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.3;
        }

        .autocomplete-item .main-text mark {
            background: #fef08a;
            color: #0f172a;
            padding: 1px 2px;
            border-radius: 3px;
            font-weight: 800;
        }

        .autocomplete-item .secondary-text {
            font-size: 0.76rem;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-top: 1px;
        }

        .autocomplete-empty {
            padding: 14px 16px;
            text-align: center;
            font-size: 0.84rem;
            color: #94a3b8;
        }

        .autocomplete-loading {
            padding: 12px;
            text-align: center;
            font-size: 0.82rem;
            color: #d97706;
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

            <!-- Header Action Items (Visible in Header Bar) -->
            <div class="d-flex align-items-center gap-1 gap-sm-2 order-lg-3 ms-auto me-2 me-lg-0">
                <!-- Customer Login / Account Button (Placed near 3-line hamburger menu) -->
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
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('blog') ?>">Blog & Guides</a></li>
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
                        <a class="nav-link px-3 py-3 text-dark fw-bold border-bottom d-flex align-items-center justify-content-between" href="<?= base_url('blog') ?>">
                            <span><i class="fa-solid fa-newspaper text-warning me-3"></i> Travel Blog & Guides</span>
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
                            <input type="hidden" name="distance_km" id="distance_km" value="">

                            <!-- Datalist of Top South India & Tamil Nadu Cities / Hubs -->
                            <datalist id="tn_popular_places">
                                <option value="Chennai, Tamil Nadu, India"></option>
                                <option value="Chennai Central Railway Station, Chennai"></option>
                                <option value="Chennai International Airport (MAA)"></option>
                                <option value="Tirunelveli, Tamil Nadu, India"></option>
                                <option value="Tirunelveli Junction, Tirunelveli"></option>
                                <option value="Madurai, Tamil Nadu, India"></option>
                                <option value="Madurai Junction Railway Station"></option>
                                <option value="Coimbatore, Tamil Nadu, India"></option>
                                <option value="Coimbatore International Airport (CJB)"></option>
                                <option value="Trichy (Tiruchirappalli), Tamil Nadu"></option>
                                <option value="Salem, Tamil Nadu, India"></option>
                                <option value="Bangalore (Bengaluru), Karnataka, India"></option>
                                <option value="Kempegowda International Airport (BLR)"></option>
                                <option value="Pondicherry (Puducherry), India"></option>
                                <option value="Kanyakumari, Tamil Nadu, India"></option>
                                <option value="Nagercoil, Tamil Nadu, India"></option>
                                <option value="Thoothukudi (Tuticorin), Tamil Nadu"></option>
                                <option value="Tiruppur, Tamil Nadu, India"></option>
                                <option value="Erode, Tamil Nadu, India"></option>
                                <option value="Thanjavur, Tamil Nadu, India"></option>
                                <option value="Dindigul, Tamil Nadu, India"></option>
                                <option value="Vellore, Tamil Nadu, India"></option>
                                <option value="Tenkasi, Tamil Nadu, India"></option>
                                <option value="Courtallam, Tamil Nadu, India"></option>
                                <option value="Ooty (Udhagamandalam), Tamil Nadu"></option>
                                <option value="Kodaikanal, Tamil Nadu, India"></option>
                                <option value="Rameswaram, Tamil Nadu, India"></option>
                                <option value="Tirupati, Andhra Pradesh, India"></option>
                                <option value="Hosur, Tamil Nadu, India"></option>
                                <option value="Kumbakonam, Tamil Nadu, India"></option>
                                <option value="Tiruvannamalai, Tamil Nadu, India"></option>
                                <option value="Nagapattinam, Tamil Nadu, India"></option>
                                <option value="Velankanni, Tamil Nadu, India"></option>
                            </datalist>

                            <!-- Locations -->
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary small">Pickup Location</label>
                                    <div class="autocomplete-wrapper position-relative">
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fa-solid fa-location-dot text-danger"></i></span>
                                            <input type="text" class="form-control location-autocomplete-input" name="pickup_location" id="pickup_location" placeholder="e.g. Melapalayam / Chennai Central" required autocomplete="off">
                                        </div>
                                        <div class="custom-autocomplete-dropdown" id="pickup_autocomplete_dropdown"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label fw-semibold text-secondary small mb-0">Drop Location</label>
                                        <div class="d-flex align-items-center gap-1">
                                            <span class="badge bg-warning text-dark font-weight-bold" id="disp-km-badge" style="font-size: 0.78rem; padding: 4px 8px;" title="Driving Distance">
                                                <i class="fa-solid fa-route me-1"></i><span id="disp-km-val">--</span> KM
                                            </span>
                                            <span class="badge bg-danger text-white font-weight-bold" id="disp-toll-badge" style="font-size: 0.78rem; padding: 4px 8px;" title="Estimated Toll Plazas & Price">
                                                <i class="fa-solid fa-road-barrier me-1"></i><span id="disp-toll-val">--</span> Tolls (Est. ₹<span id="disp-toll-price">0</span>)
                                            </span>
                                        </div>
                                    </div>
                                    <div class="autocomplete-wrapper position-relative">
                                        <div class="input-group">
                                            <span class="input-group-text bg-light"><i class="fa-solid fa-flag-checkered text-success"></i></span>
                                            <input type="text" class="form-control location-autocomplete-input" name="drop_location" id="drop_location" placeholder="e.g. Tirunelveli / Bangalore" required autocomplete="off">
                                        </div>
                                        <div class="custom-autocomplete-dropdown" id="drop_autocomplete_dropdown"></div>
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
                                    <span class="fw-bold text-dark" id="disp-km-rate">-- km @ ₹14/km</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-semibold text-secondary small">Est. Toll Gates & Fee:</span>
                                    <span class="fw-bold text-danger" id="disp-toll-gate-text"><i class="fa-solid fa-road-barrier me-1"></i><span id="disp-toll-count-text">--</span> Tolls (Est. ₹<span id="disp-toll-price-text">0</span>)</span>
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
                                    <span class="fw-extrabold fs-4 text-dark" id="disp-total-fare">₹0</span>
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

    <!-- Latest SEO Blogs & Travel Guides Section -->
    <?php if (!empty($recent_blogs)): ?>
    <section class="py-5 bg-white border-top border-bottom" id="blogs">
        <div class="container py-4">
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-4 gap-3">
                <div>
                    <div class="section-title mb-1">Travel Advice & Guides</div>
                    <h2 class="section-heading mb-0">Latest Outstation Taxi News & Tips</h2>
                </div>
                <a href="<?= base_url('blog') ?>" class="btn btn-outline-dark rounded-pill px-4 fw-bold">
                    View All Articles <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="row g-4">
                <?php foreach ($recent_blogs as $b): ?>
                    <div class="col-md-4">
                        <div class="card h-100 border rounded-4 shadow-sm overflow-hidden d-flex flex-column" style="transition: transform 0.3s ease;">
                            <a href="<?= base_url('blog/' . $b['slug']) ?>" class="d-block position-relative">
                                <?php if (!empty($b['featured_image'])): ?>
                                    <img src="<?= base_url($b['featured_image']) ?>" class="w-100" style="height: 190px; object-fit: cover;" alt="<?= html_escape($b['title']) ?>" loading="lazy">
                                <?php else: ?>
                                    <div class="w-100 bg-dark d-flex align-items-center justify-content-center text-white" style="height: 190px;">
                                        <i class="fa-solid fa-car-side fa-3x text-warning"></i>
                                    </div>
                                <?php endif; ?>
                                <span class="position-absolute top-0 start-0 m-3 badge bg-warning text-dark fw-bold rounded-pill px-3 py-1">
                                    <?= html_escape($b['category'] ?? 'Travel Guide') ?>
                                </span>
                            </a>
                            <div class="p-4 d-flex flex-column flex-grow-1">
                                <div class="extra-small text-muted mb-2">
                                    <i class="fa-regular fa-calendar me-1"></i><?= date('M d, Y', strtotime($b['created_at'])) ?>
                                </div>
                                <h5 class="fw-bold mb-2">
                                    <a href="<?= base_url('blog/' . $b['slug']) ?>" class="text-dark text-decoration-none">
                                        <?= html_escape($b['title']) ?>
                                    </a>
                                </h5>
                                <p class="small text-muted flex-grow-1 mb-3">
                                    <?= html_escape($b['excerpt'] ?: substr(strip_tags($b['content']), 0, 110) . '...') ?>
                                </p>
                                <a href="<?= base_url('blog/' . $b['slug']) ?>" class="fw-bold text-warning text-decoration-none small mt-auto">
                                    Read Full Guide <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

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
                        <li class="mb-2"><a href="<?= base_url('blog') ?>">Travel Blog</a></li>
                        <li class="mb-2"><a href="<?= base_url('sitemap.xml') ?>" target="_blank">XML Sitemap</a></li>
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
    <?php $gmap_key = !empty($settings['google_map_key']) ? trim($settings['google_map_key']) : ''; ?>
    <?php if (!empty($gmap_key)): ?>
        <script src="https://maps.googleapis.com/maps/api/js?key=<?= html_escape($gmap_key) ?>&libraries=places&callback=initGooglePlaces" async defer></script>
    <?php endif; ?>

    <script>
        var currentTripType = 'oneway';
        var currentVehicle = 'sedan';
        var pickupAutocomplete, dropAutocomplete;

        var directRouteMatrix = {
            'chennai___tirunelveli': 625,
            'chennai___nellai': 625,
            'chennai___bangalore': 350,
            'chennai___bengaluru': 350,
            'chennai___coimbatore': 510,
            'chennai___madurai': 465,
            'chennai___trichy': 330,
            'chennai___tiruchirappalli': 330,
            'chennai___salem': 345,
            'chennai___pondicherry': 155,
            'chennai___puducherry': 155,
            'chennai___kanyakumari': 705,
            'chennai___nagercoil': 695,
            'chennai___thoothukudi': 600,
            'chennai___tuticorin': 600,
            'chennai___vellore': 140,
            'chennai___erode': 430,
            'chennai___tiruppur': 470,
            'chennai___thanjavur': 345,
            'chennai___dindigul': 425,
            'chennai___tiruvannamalai': 195,
            'chennai___kumbakonam': 295,
            'chennai___tenkasi': 650,
            'chennai___courtallam': 655,
            'chennai___ooty': 555,
            'chennai___kodaikanal': 525,
            'chennai___rameswaram': 560,
            'chennai___tirupati': 135,
            'chennai___hosur': 305,
            'chennai___cuddalore': 185,
            'chennai___karur': 395,
            'chennai___theni': 495,
            'chennai___sivakasi': 540,
            'chennai___virudhunagar': 510,
            'chennai___nagapattinam': 320,
            'chennai___velankanni': 330,
            'chennai___tiruchendur': 640,
            'bangalore___coimbatore': 365,
            'bangalore___madurai': 435,
            'bangalore___tirunelveli': 595,
            'bangalore___trichy': 335,
            'bangalore___salem': 205,
            'bangalore___pondicherry': 310,
            'coimbatore___madurai': 215,
            'coimbatore___tirunelveli': 365,
            'coimbatore___trichy': 215,
            'coimbatore___salem': 165,
            'coimbatore___ooty': 85,
            'madurai___tirunelveli': 160,
            'madurai___trichy': 135,
            'madurai___salem': 235,
            'madurai___kanyakumari': 240,
            'madurai___rameswaram': 170,
            'madurai___kodaikanal': 115,
            'madurai___theni': 75,
            'tirunelveli___kanyakumari': 85,
            'tirunelveli___nagercoil': 75,
            'tirunelveli___thoothukudi': 50,
            'tirunelveli___tenkasi': 55,
            'tirunelveli___courtallam': 60,
            'tirunelveli___trivandrum': 145,
            'trichy___thanjavur': 55,
            'trichy___kumbakonam': 90,
            'salem___erode': 65,
            'salem___yercaud': 30
        };

        var cityCoordinates = {
            'chennai': {lat: 13.0827, lng: 80.2707},
            'tirunelveli': {lat: 8.7139, lng: 77.7567},
            'nellai': {lat: 8.7139, lng: 77.7567},
            'madurai': {lat: 9.9252, lng: 78.1198},
            'coimbatore': {lat: 11.0168, lng: 76.9558},
            'trichy': {lat: 10.7905, lng: 78.7047},
            'tiruchirappalli': {lat: 10.7905, lng: 78.7047},
            'salem': {lat: 11.6643, lng: 78.1460},
            'bangalore': {lat: 12.9716, lng: 77.5946},
            'bengaluru': {lat: 12.9716, lng: 77.5946},
            'pondicherry': {lat: 11.9416, lng: 79.8083},
            'puducherry': {lat: 11.9416, lng: 79.8083},
            'nagercoil': {lat: 8.1833, lng: 77.4119},
            'kanyakumari': {lat: 8.0883, lng: 77.5385},
            'tuticorin': {lat: 8.7642, lng: 78.1348},
            'thoothukudi': {lat: 8.7642, lng: 78.1348},
            'tiruppur': {lat: 11.1085, lng: 77.3411},
            'erode': {lat: 11.3410, lng: 77.7172},
            'thanjavur': {lat: 10.7870, lng: 79.1378},
            'tanjore': {lat: 10.7870, lng: 79.1378},
            'dindigul': {lat: 10.3673, lng: 77.9803},
            'vellore': {lat: 12.9165, lng: 79.1325},
            'tiruvannamalai': {lat: 12.2253, lng: 79.0747},
            'kanchipuram': {lat: 12.8342, lng: 79.7036},
            'cuddalore': {lat: 11.7480, lng: 79.7714},
            'kumbakonam': {lat: 10.9601, lng: 79.3845},
            'karur': {lat: 10.9601, lng: 78.0766},
            'theni': {lat: 10.0104, lng: 77.4768},
            'sivakasi': {lat: 9.4533, lng: 77.7971},
            'virudhunagar': {lat: 9.5680, lng: 77.9624},
            'tenkasi': {lat: 8.9594, lng: 77.3152},
            'courtallam': {lat: 8.9328, lng: 77.2743},
            'kutralam': {lat: 8.9328, lng: 77.2743},
            'karaikudi': {lat: 10.0667, lng: 78.7833},
            'ramanathapuram': {lat: 9.3639, lng: 78.8395},
            'rameswaram': {lat: 9.2876, lng: 79.3129},
            'nagapattinam': {lat: 10.7672, lng: 79.8449},
            'velankanni': {lat: 10.6807, lng: 79.8433},
            'hosur': {lat: 12.7409, lng: 77.8253},
            'krishnagiri': {lat: 12.5186, lng: 78.2137},
            'dharmapuri': {lat: 12.1211, lng: 78.1582},
            'ooty': {lat: 11.4102, lng: 76.6950},
            'kodaikanal': {lat: 10.2381, lng: 77.4892},
            'pollachi': {lat: 10.6582, lng: 77.0088},
            'namakkal': {lat: 11.2189, lng: 78.1674},
            'pudukkottai': {lat: 10.3797, lng: 78.8208},
            'chengalpattu': {lat: 12.6841, lng: 79.9836},
            'villupuram': {lat: 11.9401, lng: 79.4861},
            'mayiladuthurai': {lat: 11.1075, lng: 79.6524},
            'tiruvarur': {lat: 10.7725, lng: 79.6365},
            'tiruchendur': {lat: 8.4958, lng: 78.1218},
            'sankarankovil': {lat: 9.1714, lng: 77.5326},
            'kovilpatti': {lat: 9.1751, lng: 77.8687},
            'rajapalayam': {lat: 9.4532, lng: 77.5539},
            'srivilliputhur': {lat: 9.5107, lng: 77.6335},
            'tirupati': {lat: 13.6288, lng: 79.4192},
            'mysore': {lat: 12.2958, lng: 76.6394},
            'kochi': {lat: 9.9312, lng: 76.2673},
            'trivandrum': {lat: 8.5241, lng: 76.9366}
        };

        function resetFareDisplay() {
            var kmValEl = document.getElementById('disp-km-val');
            if (kmValEl) kmValEl.innerText = '--';

            var tollValEl = document.getElementById('disp-toll-val');
            if (tollValEl) tollValEl.innerText = '--';

            var tollPriceEl = document.getElementById('disp-toll-price');
            if (tollPriceEl) tollPriceEl.innerText = '0';

            var tollCountTextEl = document.getElementById('disp-toll-count-text');
            if (tollCountTextEl) tollCountTextEl.innerText = '--';

            var tollPriceTextEl = document.getElementById('disp-toll-price-text');
            if (tollPriceTextEl) tollPriceTextEl.innerText = '0';

            var kmRateEl = document.getElementById('disp-km-rate');
            if (kmRateEl) {
                var rate = currentVehicle === 'sedan' ? 14 : (currentVehicle === 'suv' ? 19 : (currentVehicle === 'innova' ? 22 : 28));
                kmRateEl.innerText = '-- km @ ₹' + rate + '/km';
            }

            var battaEl = document.getElementById('disp-batta');
            if (battaEl) battaEl.innerText = '₹300';

            var totalEl = document.getElementById('disp-total-fare');
            if (totalEl) totalEl.innerText = '₹0';

            var distInput = document.getElementById('distance_km');
            if (distInput) distInput.value = '';
        }

        function updateLiveFareUI(dist) {
            if (!dist || dist <= 0) {
                resetFareDisplay();
                return;
            }

            var kmValEl = document.getElementById('disp-km-val');
            if (kmValEl) kmValEl.innerText = (currentTripType === 'roundtrip') ? (dist * 2) : dist;

            var effectiveKm = (currentTripType === 'roundtrip') ? (dist * 2) : dist;
            var rate = 14;
            var minKm = 130;
            var batta = 300;
            if (currentVehicle === 'suv') {
                rate = (currentTripType === 'roundtrip') ? 17 : 19;
                minKm = (currentTripType === 'roundtrip') ? 250 : 130;
                batta = (currentTripType === 'roundtrip') ? 500 : 400;
            } else if (currentVehicle === 'innova') {
                rate = (currentTripType === 'roundtrip') ? 20 : 22;
                minKm = (currentTripType === 'roundtrip') ? 250 : 130;
                batta = (currentTripType === 'roundtrip') ? 500 : 400;
            } else if (currentVehicle === 'tempo') {
                rate = (currentTripType === 'roundtrip') ? 25 : 28;
                minKm = (currentTripType === 'roundtrip') ? 300 : 150;
                batta = (currentTripType === 'roundtrip') ? 700 : 600;
            } else {
                rate = (currentTripType === 'roundtrip') ? 13 : 14;
                minKm = (currentTripType === 'roundtrip') ? 250 : 130;
                batta = (currentTripType === 'roundtrip') ? 400 : 300;
            }

            var tollCount = 0;
            var tollFee = 0;
            if (dist > 40) {
                var oneWayTolls = Math.max(1, Math.round(dist / 55));
                var tollRate = (currentVehicle === 'tempo') ? 140 : ((currentVehicle === 'innova') ? 115 : ((currentVehicle === 'suv') ? 105 : 85));
                tollCount = (currentTripType === 'roundtrip') ? (oneWayTolls * 2) : oneWayTolls;
                tollFee = tollCount * tollRate;
            }

            var billableKm = Math.max(effectiveKm, minKm);
            var kmCharge = billableKm * rate;
            var total = kmCharge + batta + tollFee;

            var tollValEl = document.getElementById('disp-toll-val');
            if (tollValEl) tollValEl.innerText = tollCount;

            var tollPriceEl = document.getElementById('disp-toll-price');
            if (tollPriceEl) tollPriceEl.innerText = tollFee.toLocaleString('en-IN');

            var tollCountTextEl = document.getElementById('disp-toll-count-text');
            if (tollCountTextEl) tollCountTextEl.innerText = tollCount;

            var tollPriceTextEl = document.getElementById('disp-toll-price-text');
            if (tollPriceTextEl) tollPriceTextEl.innerText = tollFee.toLocaleString('en-IN');

            var kmRateEl = document.getElementById('disp-km-rate');
            if (kmRateEl) kmRateEl.innerText = billableKm + ' km @ ₹' + rate + '/km';

            var battaEl = document.getElementById('disp-batta');
            if (battaEl) battaEl.innerText = '₹' + batta;

            var totalEl = document.getElementById('disp-total-fare');
            if (totalEl) totalEl.innerText = '₹' + total.toLocaleString('en-IN');
        }

        var areaToCity = {
            'melapalayam': 'tirunelveli',
            'palayamkottai': 'tirunelveli',
            'pettai': 'tirunelveli',
            'thatchanallur': 'tirunelveli',
            'vannarpettai': 'tirunelveli',
            'samathanapuram': 'tirunelveli',
            'perumalpuram': 'tirunelveli',
            'high ground': 'tirunelveli',
            'ktc nagar': 'tirunelveli',
            'maharaja nagar': 'tirunelveli',
            'ngo colony': 'tirunelveli',
            'reddiarpatti': 'tirunelveli',
            'ambasamudram': 'tirunelveli',
            'kallidaikurichi': 'tirunelveli',
            'cheranmahadevi': 'tirunelveli',
            'kalakkad': 'tirunelveli',
            'nanguneri': 'tirunelveli',
            'valliyur': 'tirunelveli',
            'tisayanvilai': 'tirunelveli',
            'radhapuram': 'tirunelveli',
            'kudankulam': 'tirunelveli',
            'sankarankovil': 'sankarankovil',
            'alangulam': 'tenkasi',
            'surandai': 'tenkasi',
            'kadayanallur': 'tenkasi',
            'puliyangudi': 'tenkasi',
            'sengottai': 'tenkasi',
            'sivagiri': 'tenkasi',
            'kutralam': 'courtallam',
            'villapuram': 'madurai',
            'avaniyapuram': 'madurai',
            'munichalai': 'madurai',
            'sellur': 'madurai',
            'anaiyur': 'madurai',
            'kochadai': 'madurai',
            'ss colony': 'madurai',
            'ponmeni': 'madurai',
            'pasumalai': 'madurai',
            'othakadai': 'madurai',
            'tirumangalam': 'madurai',
            'thirumangalam': 'madurai',
            'mattuthavani': 'madurai',
            'periyar bus stand': 'madurai',
            'arappalayam': 'madurai',
            'goripalayam': 'madurai',
            'simmakkal': 'madurai',
            'teppakulam': 'madurai',
            'thiruparankundram': 'madurai',
            'thirunagar': 'madurai',
            'anna nagar': 'chennai',
            't. nagar': 'chennai',
            't nagar': 'chennai',
            'thyagaraya nagar': 'chennai',
            'velachery': 'chennai',
            'guindy': 'chennai',
            'tambaram': 'chennai',
            'chromepet': 'chennai',
            'pallavaram': 'chennai',
            'porur': 'chennai',
            'poonamallee': 'chennai',
            'medavakkam': 'chennai',
            'sholinganallur': 'chennai',
            'omr': 'chennai',
            'perungudi': 'chennai',
            'thoraipakkam': 'chennai',
            'navallur': 'chennai',
            'siruseri': 'chennai',
            'adyar': 'chennai',
            'besant nagar': 'chennai',
            'thiruvanmiyur': 'chennai',
            'mylapore': 'chennai',
            'nungambakkam': 'chennai',
            'alwarpet': 'chennai',
            'vadapalani': 'chennai',
            'ashok nagar': 'chennai',
            'saidapet': 'chennai',
            'perambur': 'chennai',
            'ambattur': 'chennai',
            'avadi': 'chennai',
            'kolathur': 'chennai',
            'madhavaram': 'chennai',
            'koyambedu': 'chennai',
            'kilambakkam': 'chennai',
            'gandhipuram': 'coimbatore',
            'r.s. puram': 'coimbatore',
            'rs puram': 'coimbatore',
            'peelamedu': 'coimbatore',
            'singanallur': 'coimbatore',
            'saravanampatti': 'coimbatore',
            'ganapathy': 'coimbatore',
            'ukkadam': 'coimbatore',
            'saibaba colony': 'coimbatore',
            'thudiyalur': 'coimbatore',
            'srirangam': 'trichy',
            'thillai nagar': 'trichy',
            'cantonment': 'trichy',
            'chatram': 'trichy',
            'thuvakudi': 'trichy',
            'suramangalam': 'salem',
            'fairlands': 'salem',
            'hasthampatti': 'salem',
            'meyyanur': 'salem',
            'majestic': 'bangalore',
            'indiranagar': 'bangalore',
            'koramangala': 'bangalore',
            'whitefield': 'bangalore',
            'hsr layout': 'bangalore',
            'electronic city': 'bangalore',
            'jayanagar': 'bangalore',
            'btm layout': 'bangalore',
            'marathahalli': 'bangalore',
            'yelahanka': 'bangalore'
        };

        var curatedPlaces = [
            // Madurai Area Localities & Hubs
            {main_text: 'Villapuram', secondary_text: 'Madurai, Tamil Nadu', type: 'area'},
            {main_text: 'Villapuram Housing Board', secondary_text: 'Villapuram, Madurai, Tamil Nadu', type: 'area'},
            {main_text: 'Avaniyapuram', secondary_text: 'Madurai, Tamil Nadu', type: 'area'},
            {main_text: 'Madurai Junction Railway Station', secondary_text: 'Madurai, Tamil Nadu', type: 'rail'},
            {main_text: 'Mattuthavani Integrated Bus Terminus (MIBT)', secondary_text: 'Madurai, Tamil Nadu', type: 'bus'},
            {main_text: 'Periyar Bus Stand', secondary_text: 'Madurai, Tamil Nadu', type: 'bus'},
            {main_text: 'Arappalayam Bus Stand', secondary_text: 'Madurai, Tamil Nadu', type: 'bus'},
            {main_text: 'Goripalayam', secondary_text: 'Madurai, Tamil Nadu', type: 'area'},
            {main_text: 'Simmakkal', secondary_text: 'Madurai, Tamil Nadu', type: 'area'},
            {main_text: 'Anna Nagar Madurai', secondary_text: 'Madurai, Tamil Nadu', type: 'area'},
            {main_text: 'K.K. Nagar Madurai', secondary_text: 'Madurai, Tamil Nadu', type: 'area'},
            {main_text: 'Teppakulam & Vandiyur', secondary_text: 'Madurai, Tamil Nadu', type: 'area'},
            {main_text: 'Thiruparankundram', secondary_text: 'Madurai, Tamil Nadu', type: 'area'},
            {main_text: 'Thirunagar', secondary_text: 'Madurai, Tamil Nadu', type: 'area'},
            {main_text: 'Munichalai', secondary_text: 'Madurai, Tamil Nadu', type: 'area'},
            {main_text: 'Sellur', secondary_text: 'Madurai, Tamil Nadu', type: 'area'},
            {main_text: 'Anaiyur', secondary_text: 'Madurai, Tamil Nadu', type: 'area'},
            {main_text: 'Kochadai', secondary_text: 'Madurai, Tamil Nadu', type: 'area'},
            {main_text: 'SS Colony & Ponmeni', secondary_text: 'Madurai, Tamil Nadu', type: 'area'},
            {main_text: 'Pasumalai', secondary_text: 'Madurai, Tamil Nadu', type: 'area'},
            {main_text: 'Othakadai', secondary_text: 'Madurai, Tamil Nadu', type: 'area'},
            {main_text: 'Tirumangalam Bus Stand', secondary_text: 'Madurai District, Tamil Nadu', type: 'bus'},
            {main_text: 'Madurai International Airport (IXM)', secondary_text: 'Perungudi, Madurai, Tamil Nadu', type: 'air'},
            {main_text: 'Melur Bus Stand', secondary_text: 'Madurai District, Tamil Nadu', type: 'bus'},
            {main_text: 'Usilampatti', secondary_text: 'Madurai District, Tamil Nadu', type: 'area'},
            {main_text: 'Vadipatti', secondary_text: 'Madurai District, Tamil Nadu', type: 'area'},

            // Tirunelveli & Nellai Area Localities
            {main_text: 'Melapalayam', secondary_text: 'Tirunelveli, Tamil Nadu', type: 'area'},
            {main_text: 'Melapalayam Bus Stand', secondary_text: 'Melapalayam, Tirunelveli, Tamil Nadu', type: 'bus'},
            {main_text: 'Palayamkottai', secondary_text: 'Tirunelveli, Tamil Nadu', type: 'area'},
            {main_text: 'Palayamkottai Bus Stand', secondary_text: 'Palayamkottai, Tirunelveli, Tamil Nadu', type: 'bus'},
            {main_text: 'Tirunelveli Junction Railway Station', secondary_text: 'Tirunelveli, Tamil Nadu', type: 'rail'},
            {main_text: 'Tirunelveli Town', secondary_text: 'Tirunelveli, Tamil Nadu', type: 'area'},
            {main_text: 'Tirunelveli New Bus Stand (Vaeinthankulam)', secondary_text: 'Tirunelveli, Tamil Nadu', type: 'bus'},
            {main_text: 'Pettai', secondary_text: 'Tirunelveli, Tamil Nadu', type: 'area'},
            {main_text: 'Thatchanallur', secondary_text: 'Tirunelveli, Tamil Nadu', type: 'area'},
            {main_text: 'Vannarpettai', secondary_text: 'Tirunelveli, Tamil Nadu', type: 'area'},
            {main_text: 'Samathanapuram', secondary_text: 'Palayamkottai, Tirunelveli, Tamil Nadu', type: 'area'},
            {main_text: 'Perumalpuram', secondary_text: 'Tirunelveli, Tamil Nadu', type: 'area'},
            {main_text: 'High Ground', secondary_text: 'Palayamkottai, Tirunelveli, Tamil Nadu', type: 'area'},
            {main_text: 'Maharaja Nagar', secondary_text: 'Palayamkottai, Tirunelveli, Tamil Nadu', type: 'area'},
            {main_text: 'NGO Colony', secondary_text: 'Tirunelveli, Tamil Nadu', type: 'area'},
            {main_text: 'KTC Nagar', secondary_text: 'Palayamkottai, Tirunelveli, Tamil Nadu', type: 'area'},
            {main_text: 'Reddiarpatti', secondary_text: 'Tirunelveli, Tamil Nadu', type: 'area'},
            {main_text: 'Ambasamudram', secondary_text: 'Tirunelveli District, Tamil Nadu', type: 'area'},
            {main_text: 'Kallidaikurichi', secondary_text: 'Tirunelveli District, Tamil Nadu', type: 'area'},
            {main_text: 'Cheranmahadevi', secondary_text: 'Tirunelveli District, Tamil Nadu', type: 'area'},
            {main_text: 'Kalakkad', secondary_text: 'Tirunelveli District, Tamil Nadu', type: 'area'},
            {main_text: 'Nanguneri', secondary_text: 'Tirunelveli District, Tamil Nadu', type: 'area'},
            {main_text: 'Valliyur', secondary_text: 'Tirunelveli District, Tamil Nadu', type: 'area'},
            {main_text: 'Radhapuram', secondary_text: 'Tirunelveli District, Tamil Nadu', type: 'area'},
            {main_text: 'Kudankulam', secondary_text: 'Tirunelveli District, Tamil Nadu', type: 'area'},
            {main_text: 'Tisayanvilai', secondary_text: 'Tirunelveli District, Tamil Nadu', type: 'area'},
            {main_text: 'Alangulam', secondary_text: 'Tenkasi District, Tamil Nadu', type: 'area'},
            {main_text: 'Surandai', secondary_text: 'Tenkasi District, Tamil Nadu', type: 'area'},
            {main_text: 'Tenkasi Junction Railway Station', secondary_text: 'Tenkasi, Tamil Nadu', type: 'rail'},
            {main_text: 'Courtallam (Kutralam)', secondary_text: 'Tenkasi, Tamil Nadu', type: 'area'},
            {main_text: 'Sengottai', secondary_text: 'Tenkasi District, Tamil Nadu', type: 'area'},
            {main_text: 'Kadayanallur', secondary_text: 'Tenkasi District, Tamil Nadu', type: 'area'},
            {main_text: 'Puliyangudi', secondary_text: 'Tenkasi District, Tamil Nadu', type: 'area'},
            {main_text: 'Sankarankovil', secondary_text: 'Tenkasi District, Tamil Nadu', type: 'area'},
            {main_text: 'Sivagiri', secondary_text: 'Tenkasi District, Tamil Nadu', type: 'area'},

            // Chennai Area Localities & Hubs
            {main_text: 'Chennai Central Railway Station (MAS)', secondary_text: 'Periyamet, Chennai, Tamil Nadu', type: 'rail'},
            {main_text: 'Chennai Egmore Railway Station (MS)', secondary_text: 'Egmore, Chennai, Tamil Nadu', type: 'rail'},
            {main_text: 'Chennai International Airport (MAA)', secondary_text: 'Meenambakkam, Chennai, Tamil Nadu', type: 'air'},
            {main_text: 'CMBT Koyambedu Bus Terminus', secondary_text: 'Koyambedu, Chennai, Tamil Nadu', type: 'bus'},
            {main_text: 'Kilambakkam KCBT Bus Terminus', secondary_text: 'Kilambakkam, Vandalur, Chennai', type: 'bus'},
            {main_text: 'T. Nagar (Thyagaraya Nagar)', secondary_text: 'Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Anna Nagar', secondary_text: 'Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Velachery', secondary_text: 'Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Guindy Railway Station / Metro', secondary_text: 'Guindy, Chennai, Tamil Nadu', type: 'rail'},
            {main_text: 'Tambaram Railway Station & Bus Stand', secondary_text: 'Tambaram, Chennai, Tamil Nadu', type: 'rail'},
            {main_text: 'Chromepet', secondary_text: 'Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Pallavaram', secondary_text: 'Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Porur Junction', secondary_text: 'Porur, Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Poonamallee Bus Stand', secondary_text: 'Poonamallee, Chennai, Tamil Nadu', type: 'bus'},
            {main_text: 'OMR (Old Mahabalipuram Road)', secondary_text: 'IT Corridor, Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Sholinganallur Junction', secondary_text: 'OMR, Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Perungudi / Kandanchavadi', secondary_text: 'OMR, Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Thoraipakkam', secondary_text: 'OMR, Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Navallur', secondary_text: 'OMR, Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Siruseri SIPCOT IT Park', secondary_text: 'Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Medavakkam Junction', secondary_text: 'Medavakkam, Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Adyar', secondary_text: 'Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Besant Nagar (Elliot\'s Beach)', secondary_text: 'Adyar, Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Thiruvanmiyur', secondary_text: 'Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Mylapore', secondary_text: 'Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Nungambakkam', secondary_text: 'Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Alwarpet', secondary_text: 'Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Vadapalani Metro & Bus Depot', secondary_text: 'Vadapalani, Chennai, Tamil Nadu', type: 'bus'},
            {main_text: 'Ashok Nagar', secondary_text: 'Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'K.K. Nagar', secondary_text: 'Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Saidapet', secondary_text: 'Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Perambur Railway Station', secondary_text: 'Perambur, Chennai, Tamil Nadu', type: 'rail'},
            {main_text: 'Ambattur Industrial Estate', secondary_text: 'Ambattur, Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Avadi Railway Station / Bus Stand', secondary_text: 'Avadi, Chennai, Tamil Nadu', type: 'rail'},
            {main_text: 'Kolathur', secondary_text: 'Chennai, Tamil Nadu', type: 'area'},
            {main_text: 'Madhavaram MMBT Bus Terminus', secondary_text: 'Madhavaram, Chennai, Tamil Nadu', type: 'bus'},
            {main_text: 'Sriperumbudur Industrial Hub', secondary_text: 'Kanchipuram District, Tamil Nadu', type: 'area'},
            {main_text: 'Chengalpattu Junction', secondary_text: 'Chengalpattu, Tamil Nadu', type: 'rail'},
            {main_text: 'Mahabalipuram (Mamallapuram)', secondary_text: 'Chengalpattu District, Tamil Nadu', type: 'area'},

            // Coimbatore Area Localities
            {main_text: 'Coimbatore Junction Railway Station', secondary_text: 'Gopalapuram, Coimbatore, Tamil Nadu', type: 'rail'},
            {main_text: 'Coimbatore International Airport (CJB)', secondary_text: 'Peelamedu, Coimbatore, Tamil Nadu', type: 'air'},
            {main_text: 'Gandhipuram Central Bus Stand', secondary_text: 'Gandhipuram, Coimbatore, Tamil Nadu', type: 'bus'},
            {main_text: 'R.S. Puram (Rathinasabapathy Puram)', secondary_text: 'Coimbatore, Tamil Nadu', type: 'area'},
            {main_text: 'Peelamedu / PSG Tech', secondary_text: 'Coimbatore, Tamil Nadu', type: 'area'},
            {main_text: 'Singanallur Bus Stand', secondary_text: 'Singanallur, Coimbatore, Tamil Nadu', type: 'bus'},
            {main_text: 'Saravanampatti IT Corridor', secondary_text: 'Coimbatore, Tamil Nadu', type: 'area'},
            {main_text: 'Ganapathy', secondary_text: 'Coimbatore, Tamil Nadu', type: 'area'},
            {main_text: 'Ukkadam Bus Stand', secondary_text: 'Ukkadam, Coimbatore, Tamil Nadu', type: 'bus'},
            {main_text: 'Saibaba Colony', secondary_text: 'Coimbatore, Tamil Nadu', type: 'area'},
            {main_text: 'Thudiyalur', secondary_text: 'Coimbatore, Tamil Nadu', type: 'area'},
            {main_text: 'Pollachi Junction & Bus Stand', secondary_text: 'Pollachi, Coimbatore, Tamil Nadu', type: 'bus'},
            {main_text: 'Mettupalayam Railway Station', secondary_text: 'Mettupalayam, Coimbatore, Tamil Nadu', type: 'rail'},

            // Trichy Area Localities
            {main_text: 'Trichy Junction Railway Station (TPJ)', secondary_text: 'Tiruchirappalli, Tamil Nadu', type: 'rail'},
            {main_text: 'Trichy Central Bus Stand', secondary_text: 'Cantonment, Tiruchirappalli, Tamil Nadu', type: 'bus'},
            {main_text: 'Chatram Bus Stand', secondary_text: 'Tiruchirappalli, Tamil Nadu', type: 'bus'},
            {main_text: 'Srirangam Temple & Railway Station', secondary_text: 'Srirangam, Tiruchirappalli, Tamil Nadu', type: 'rail'},
            {main_text: 'Thillai Nagar', secondary_text: 'Tiruchirappalli, Tamil Nadu', type: 'area'},
            {main_text: 'K.K. Nagar Trichy', secondary_text: 'Tiruchirappalli, Tamil Nadu', type: 'area'},
            {main_text: 'Tiruchirappalli International Airport (TRZ)', secondary_text: 'Airport, Tiruchirappalli, Tamil Nadu', type: 'air'},
            {main_text: 'Thuvakudi / NIT Trichy', secondary_text: 'Tiruchirappalli, Tamil Nadu', type: 'area'},

            // Salem Area Localities
            {main_text: 'Salem Junction Railway Station', secondary_text: 'Suramangalam, Salem, Tamil Nadu', type: 'rail'},
            {main_text: 'Salem New Bus Stand (Central Bus Stand)', secondary_text: 'Meyyanur, Salem, Tamil Nadu', type: 'bus'},
            {main_text: 'Fairlands', secondary_text: 'Salem, Tamil Nadu', type: 'area'},
            {main_text: 'Hasthampatti', secondary_text: 'Salem, Tamil Nadu', type: 'area'},
            {main_text: 'Suramangalam', secondary_text: 'Salem, Tamil Nadu', type: 'area'},
            {main_text: 'Yercaud Hills', secondary_text: 'Salem District, Tamil Nadu', type: 'area'},

            // Bengaluru / Bangalore
            {main_text: 'Bangalore City Railway Station (KSR Majestic)', secondary_text: 'Kempegowda, Bengaluru, Karnataka', type: 'rail'},
            {main_text: 'Kempegowda International Airport (BLR)', secondary_text: 'Devanahalli, Bengaluru, Karnataka', type: 'air'},
            {main_text: 'Indiranagar Metro Station', secondary_text: 'Indiranagar, Bengaluru, Karnataka', type: 'rail'},
            {main_text: 'Koramangala', secondary_text: 'Bengaluru, Karnataka', type: 'area'},
            {main_text: 'Whitefield / ITPL', secondary_text: 'Bengaluru, Karnataka', type: 'area'},
            {main_text: 'HSR Layout', secondary_text: 'Bengaluru, Karnataka', type: 'area'},
            {main_text: 'Electronic City Phase 1 & 2', secondary_text: 'Hosur Road, Bengaluru, Karnataka', type: 'area'},
            {main_text: 'Jayanagar', secondary_text: 'Bengaluru, Karnataka', type: 'area'},
            {main_text: 'BTM Layout', secondary_text: 'Bengaluru, Karnataka', type: 'area'},
            {main_text: 'Marathahalli', secondary_text: 'Bengaluru, Karnataka', type: 'area'},
            {main_text: 'Yelahanka', secondary_text: 'Bengaluru, Karnataka', type: 'area'},
            {main_text: 'Hosur Bus Stand & Railway Station', secondary_text: 'Hosur, Krishnagiri District, Tamil Nadu', type: 'bus'},

            // South & Central Tamil Nadu Hubs
            {main_text: 'Thoothukudi (Tuticorin) New Bus Stand', secondary_text: 'Thoothukudi, Tamil Nadu', type: 'bus'},
            {main_text: 'Thoothukudi Railway Station', secondary_text: 'Thoothukudi, Tamil Nadu', type: 'rail'},
            {main_text: 'Kayalpattinam', secondary_text: 'Thoothukudi District, Tamil Nadu', type: 'area'},
            {main_text: 'Tiruchendur Murugan Temple & Beach', secondary_text: 'Tiruchendur, Thoothukudi, Tamil Nadu', type: 'area'},
            {main_text: 'Kovilpatti Bus Stand & Railway Station', secondary_text: 'Kovilpatti, Thoothukudi, Tamil Nadu', type: 'bus'},
            {main_text: 'Nagercoil Junction Railway Station', secondary_text: 'Nagercoil, Kanyakumari District, Tamil Nadu', type: 'rail'},
            {main_text: 'Kanyakumari Beach & Cape Comorin', secondary_text: 'Kanyakumari, Tamil Nadu', type: 'area'},
            {main_text: 'Marthandam', secondary_text: 'Kanyakumari District, Tamil Nadu', type: 'area'},
            {main_text: 'Thuckalay', secondary_text: 'Kanyakumari District, Tamil Nadu', type: 'area'},
            {main_text: 'Trivandrum Central Railway Station (TVC)', secondary_text: 'Thiruvananthapuram, Kerala', type: 'rail'},
            {main_text: 'Trivandrum International Airport (TRV)', secondary_text: 'Thiruvananthapuram, Kerala', type: 'air'},
            {main_text: 'Pondicherry (Puducherry) Beach Road', secondary_text: 'White Town, Puducherry', type: 'area'},
            {main_text: 'Auroville', secondary_text: 'Puducherry / Villupuram', type: 'area'},
            {main_text: 'Vellore New Bus Stand', secondary_text: 'Vellore, Tamil Nadu', type: 'bus'},
            {main_text: 'Katpadi Junction Railway Station', secondary_text: 'Vellore, Tamil Nadu', type: 'rail'},
            {main_text: 'Tiruvannamalai Annamalaiyar Temple', secondary_text: 'Tiruvannamalai, Tamil Nadu', type: 'area'},
            {main_text: 'Kumbakonam Mahamaham Tank', secondary_text: 'Kumbakonam, Thanjavur, Tamil Nadu', type: 'area'},
            {main_text: 'Thanjavur Brihadeeswarar Temple', secondary_text: 'Thanjavur, Tamil Nadu', type: 'area'},
            {main_text: 'Nagapattinam Port', secondary_text: 'Nagapattinam, Tamil Nadu', type: 'area'},
            {main_text: 'Velankanni Basilica of Our Lady of Good Health', secondary_text: 'Velankanni, Nagapattinam, Tamil Nadu', type: 'area'},
            {main_text: 'Rameswaram Ramanathaswamy Temple', secondary_text: 'Rameswaram, Ramanathapuram, Tamil Nadu', type: 'area'},
            {main_text: 'Dindigul Junction & Rock Fort', secondary_text: 'Dindigul, Tamil Nadu', type: 'rail'},
            {main_text: 'Kodaikanal Lake & Bus Stand', secondary_text: 'Kodaikanal, Dindigul, Tamil Nadu', type: 'area'},
            {main_text: 'Ooty (Udhagamandalam) Charing Cross', secondary_text: 'Ooty, Nilgiris, Tamil Nadu', type: 'area'},
            {main_text: 'Coonoor Sim\'s Park', secondary_text: 'Coonoor, Nilgiris, Tamil Nadu', type: 'area'},
            {main_text: 'Tiruppur Old / New Bus Stand', secondary_text: 'Tiruppur, Tamil Nadu', type: 'bus'},
            {main_text: 'Erode Central Bus Stand & Railway Station', secondary_text: 'Erode, Tamil Nadu', type: 'bus'},
            {main_text: 'Karur Bus Stand & Railway Station', secondary_text: 'Karur, Tamil Nadu', type: 'bus'},
            {main_text: 'Namakkal Bus Stand', secondary_text: 'Namakkal, Tamil Nadu', type: 'bus'},
            {main_text: 'Rajapalayam', secondary_text: 'Virudhunagar District, Tamil Nadu', type: 'area'},
            {main_text: 'Srivilliputhur Andal Temple', secondary_text: 'Virudhunagar District, Tamil Nadu', type: 'area'},
            {main_text: 'Sivakasi Bus Stand', secondary_text: 'Virudhunagar District, Tamil Nadu', type: 'bus'},
            {main_text: 'Virudhunagar Junction', secondary_text: 'Virudhunagar, Tamil Nadu', type: 'rail'},
            {main_text: 'Theni Bus Stand', secondary_text: 'Theni, Tamil Nadu', type: 'bus'},
            {main_text: 'Karaikudi Bus Stand & Railway Station', secondary_text: 'Sivaganga District, Tamil Nadu', type: 'rail'},
            {main_text: 'Pudukkottai Bus Stand', secondary_text: 'Pudukkottai, Tamil Nadu', type: 'bus'},
            {main_text: 'Cuddalore Port & Bus Stand', secondary_text: 'Cuddalore, Tamil Nadu', type: 'bus'},
            {main_text: 'Neyveli Township', secondary_text: 'Cuddalore District, Tamil Nadu', type: 'area'},
            {main_text: 'Chidambaram Nataraja Temple', secondary_text: 'Chidambaram, Cuddalore, Tamil Nadu', type: 'area'},
            {main_text: 'Villupuram Junction Railway Station', secondary_text: 'Villupuram, Tamil Nadu', type: 'rail'},
            {main_text: 'Kanchipuram Kamakshi Amman Temple', secondary_text: 'Kanchipuram, Tamil Nadu', type: 'area'},
            {main_text: 'Tirupati Railway Station & Alipiri', secondary_text: 'Tirupati, Andhra Pradesh', type: 'rail'}
        ];

        function getPlaceIcon(type, name) {
            var n = (name || '').toLowerCase();
            if (type === 'rail' || n.includes('station') || n.includes('junction') || n.includes('metro')) {
                return '<i class="fa-solid fa-train"></i>';
            }
            if (type === 'air' || n.includes('airport')) {
                return '<i class="fa-solid fa-plane-departure"></i>';
            }
            if (type === 'bus' || n.includes('bus stand') || n.includes('terminus') || n.includes('depot')) {
                return '<i class="fa-solid fa-bus"></i>';
            }
            return '<i class="fa-solid fa-location-dot"></i>';
        }

        function escapeHtml(str) {
            return (str || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }

        function normalizePhonetic(str) {
            if (!str) return '';
            return str.toLowerCase()
                .replace(/au/g, 'u')
                .replace(/oo/g, 'u')
                .replace(/ee/g, 'i')
                .replace(/ai/g, 'y')
                .replace(/dh/g, 'd')
                .replace(/th/g, 't')
                .replace(/gh/g, 'g')
                .replace(/kh/g, 'k')
                .replace(/bh/g, 'b')
                .replace(/ph/g, 'p')
                .replace(/ch/g, 'c')
                .replace(/sh/g, 's')
                .replace(/zh/g, 'z')
                .replace(/ll/g, 'l')
                .replace(/pp/g, 'p')
                .replace(/tt/g, 't')
                .replace(/rr/g, 'r')
                .replace(/mm/g, 'm')
                .replace(/nn/g, 'n')
                .replace(/[^a-z0-9]/g, '');
        }

        function levenshteinDistance(a, b) {
            if (a.length === 0) return b.length;
            if (b.length === 0) return a.length;
            var matrix = [];
            for (var i = 0; i <= b.length; i++) { matrix[i] = [i]; }
            for (var j = 0; j <= a.length; j++) { matrix[0][j] = j; }
            for (var i = 1; i <= b.length; i++) {
                for (var j = 1; j <= a.length; j++) {
                    if (b.charAt(i - 1) === a.charAt(j - 1)) {
                        matrix[i][j] = matrix[i - 1][j - 1];
                    } else {
                        matrix[i][j] = Math.min(
                            matrix[i - 1][j - 1] + 1,
                            matrix[i][j - 1] + 1,
                            matrix[i - 1][j] + 1
                        );
                    }
                }
            }
            return matrix[b.length][a.length];
        }

        function tokenFuzzyMatch(qToken, targetStr, targetWords) {
            if (targetStr.indexOf(qToken) !== -1) return { match: true, score: 1 };

            var qNorm = normalizePhonetic(qToken);
            var targetNorm = normalizePhonetic(targetStr);
            if (qNorm.length >= 3 && targetNorm.indexOf(qNorm) !== -1) {
                return { match: true, score: 2 };
            }

            if (qToken.length >= 4) {
                for (var i = 0; i < targetWords.length; i++) {
                    var w = targetWords[i];
                    if (w.length < 3) continue;
                    var dist = levenshteinDistance(qToken, w);
                    var maxAllowedDist = (qToken.length <= 6) ? 1 : 2;
                    if (dist <= maxAllowedDist) {
                        return { match: true, score: 3 + dist };
                    }
                    var wNorm = normalizePhonetic(w);
                    if (wNorm.length >= 3 && levenshteinDistance(qNorm, wNorm) <= 1) {
                        return { match: true, score: 3 };
                    }
                }
            }

            return { match: false, score: 99 };
        }

        function highlightMatch(text, query) {
            if (!query || !text) return text;
            var tokens = query.trim().split(/\s+/).filter(function(t) { return t.length > 0; });
            if (tokens.length === 0) return text;
            var patterns = [];
            tokens.forEach(function(t) {
                patterns.push(t.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'));
                var norm = normalizePhonetic(t);
                if (norm.length >= 3) {
                    patterns.push(norm.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'));
                }
            });
            var reg = new RegExp('(' + patterns.join('|') + ')', 'gi');
            return text.replace(reg, '<mark>$1</mark>');
        }

        function setupCustomAutocomplete(inputId, dropdownId) {
            var input = document.getElementById(inputId);
            var dropdown = document.getElementById(dropdownId);
            if (!input || !dropdown) return;

            var activeIndex = -1;
            var debounceTimer = null;
            var currentItems = [];

            function renderDropdown(items, query) {
                currentItems = items;
                activeIndex = -1;
                if (!items || items.length === 0) {
                    dropdown.innerHTML = '<div class="autocomplete-empty"><i class="fa-solid fa-map-pin me-1 text-muted"></i> No matching location found. You can still type custom location.</div>';
                    dropdown.classList.add('show');
                    return;
                }

                var html = '';
                items.forEach(function(item, idx) {
                    var icon = getPlaceIcon(item.type, item.main_text);
                    var mainHighlighted = highlightMatch(item.main_text, query);
                    var secHighlighted = highlightMatch(item.secondary_text, query);
                    var fullValue = item.description || (item.main_text + ', ' + item.secondary_text);
                    
                    html += '<div class="autocomplete-item" data-index="' + idx + '" data-value="' + fullValue.replace(/"/g, '&quot;') + '">';
                    html += '  <div class="item-icon">' + icon + '</div>';
                    html += '  <div class="item-content">';
                    html += '    <div class="main-text">' + mainHighlighted + '</div>';
                    html += '    <div class="secondary-text">' + secHighlighted + '</div>';
                    html += '  </div>';
                    html += '</div>';
                });

                dropdown.innerHTML = html;
                dropdown.classList.add('show');

                // Attach click listeners to items
                var itemEls = dropdown.querySelectorAll('.autocomplete-item');
                itemEls.forEach(function(el) {
                    el.addEventListener('mousedown', function(e) {
                        e.preventDefault(); // Prevent blur before selection
                        selectItem(el.getAttribute('data-value'));
                    });
                });
            }

            function selectItem(val) {
                input.value = val;
                dropdown.classList.remove('show');
                activeIndex = -1;
                calculateGoogleDistance();
            }

            function filterLocalPlaces(q) {
                if (!q) return curatedPlaces.slice(0, 8);
                var qClean = q.trim().toLowerCase();
                var qTokens = qClean.split(/\s+/).filter(function(t) { return t.length > 0; });
                if (qTokens.length === 0) return curatedPlaces.slice(0, 8);

                var matches = [];
                for (var i = 0; i < curatedPlaces.length; i++) {
                    var p = curatedPlaces[i];
                    var mainLower = p.main_text.toLowerCase();
                    var secLower = (p.secondary_text || '').toLowerCase();
                    var fullStr = mainLower + ' ' + secLower;
                    var targetWords = fullStr.split(/[\s,()/-]+/).filter(function(w) { return w.length > 0; });

                    var allTokensMatch = true;
                    var totalScore = 0;

                    for (var t = 0; t < qTokens.length; t++) {
                        var res = tokenFuzzyMatch(qTokens[t], fullStr, targetWords);
                        if (!res.match) {
                            allTokensMatch = false;
                            break;
                        }
                        totalScore += res.score;
                    }

                    if (allTokensMatch) {
                        if (mainLower === qClean) totalScore -= 10;
                        else if (mainLower.startsWith(qClean)) totalScore -= 5;
                        else if (fullStr.indexOf(qClean) !== -1) totalScore -= 3;

                        matches.push({
                            score: totalScore,
                            main_text: p.main_text,
                            secondary_text: p.secondary_text,
                            type: p.type,
                            description: p.main_text + ', ' + p.secondary_text
                        });
                    }
                }
                matches.sort(function(a, b) { return a.score - b.score; });
                return matches.slice(0, 10);
            }

            function fetchLivePlaces(q) {
                var qTrim = q.trim();
                var localMatches = filterLocalPlaces(qTrim);

                if (localMatches.length > 0) {
                    renderDropdown(localMatches, qTrim);
                } else if (qTrim.length >= 2) {
                    // Show subtle searching loader instead of "No matching location found" while backend is querying
                    dropdown.innerHTML = '<div class="autocomplete-loading"><i class="fa-solid fa-circle-notch fa-spin me-2"></i>Searching for "<b>' + escapeHtml(qTrim) + '</b>"...</div>';
                    dropdown.classList.add('show');
                } else {
                    renderDropdown([], qTrim);
                }

                if (qTrim.length >= 2) {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function() {
                        fetch('<?= base_url("welcome/places_autocomplete") ?>?input=' + encodeURIComponent(qTrim))
                            .then(res => res.json())
                            .then(data => {
                                if (data && data.status && data.predictions && data.predictions.length > 0) {
                                    var combined = [];
                                    var seen = {};
                                    // Add server results first
                                    data.predictions.forEach(function(p) {
                                        var k = (p.main_text + ' ' + (p.secondary_text || '')).toLowerCase().trim();
                                        if (!seen[k]) {
                                            seen[k] = true;
                                            combined.push({
                                                main_text: p.main_text,
                                                secondary_text: p.secondary_text || '',
                                                description: p.description || (p.main_text + ', ' + p.secondary_text),
                                                type: (p.place_id && p.place_id.startsWith('osm')) ? 'area' : (p.type || 'area')
                                            });
                                        }
                                    });
                                    // Add any local matches not yet seen
                                    localMatches.forEach(function(p) {
                                        var k = (p.main_text + ' ' + (p.secondary_text || '')).toLowerCase().trim();
                                        if (!seen[k]) {
                                            seen[k] = true;
                                            combined.push(p);
                                        }
                                    });
                                    renderDropdown(combined.slice(0, 10), qTrim);
                                } else {
                                    if (localMatches.length === 0) {
                                        renderDropdown([], qTrim);
                                    }
                                }
                            })
                            .catch(function() {
                                if (localMatches.length === 0) {
                                    renderDropdown([], qTrim);
                                }
                            });
                    }, 150);
                }
            }

            input.addEventListener('focus', function() {
                var q = this.value.trim();
                fetchLivePlaces(q);
            });

            input.addEventListener('input', function() {
                var q = this.value.trim();
                fetchLivePlaces(q);
                calculateFare();
            });

            input.addEventListener('keydown', function(e) {
                var itemEls = dropdown.querySelectorAll('.autocomplete-item');
                if (!dropdown.classList.contains('show') || itemEls.length === 0) return;

                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    activeIndex = (activeIndex + 1) % itemEls.length;
                    highlightActiveItem(itemEls);
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    activeIndex = (activeIndex - 1 + itemEls.length) % itemEls.length;
                    highlightActiveItem(itemEls);
                } else if (e.key === 'Enter') {
                    if (activeIndex >= 0 && activeIndex < itemEls.length) {
                        e.preventDefault();
                        selectItem(itemEls[activeIndex].getAttribute('data-value'));
                    }
                } else if (e.key === 'Escape') {
                    dropdown.classList.remove('show');
                }
            });

            function highlightActiveItem(itemEls) {
                itemEls.forEach(function(el, idx) {
                    if (idx === activeIndex) {
                        el.classList.add('active');
                        el.scrollIntoView({ block: 'nearest' });
                    } else {
                        el.classList.remove('active');
                    }
                });
            }

            input.addEventListener('blur', function() {
                setTimeout(function() {
                    dropdown.classList.remove('show');
                }, 200);
            });
        }

        // Close dropdowns on outside click
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.autocomplete-wrapper')) {
                document.querySelectorAll('.custom-autocomplete-dropdown').forEach(function(d) {
                    d.classList.remove('show');
                });
            }
        });

        function calculateFare() {
            var pickup = (document.getElementById('pickup_location') ? document.getElementById('pickup_location').value : '').toLowerCase().trim();
            var drop = (document.getElementById('drop_location') ? document.getElementById('drop_location').value : '').toLowerCase().trim();

            if (!pickup || !drop) {
                resetFareDisplay();
                return;
            }

            var foundP = null;
            var foundD = null;

            // Check area/suburb mappings first (e.g. melapalayam -> tirunelveli)
            for (var area in areaToCity) {
                if (!foundP && pickup.includes(area)) {
                    foundP = areaToCity[area];
                }
                if (!foundD && drop.includes(area)) {
                    foundD = areaToCity[area];
                }
            }

            // Then check direct city coordinates
            for (var city in cityCoordinates) {
                if (!foundP && pickup.includes(city)) {
                    foundP = city;
                }
                if (!foundD && drop.includes(city)) {
                    foundD = city;
                }
            }

            var distance = 0;
            if (foundP && foundD) {
                var p1 = foundP + '___' + foundD;
                var p2 = foundD + '___' + foundP;

                if (directRouteMatrix[p1]) {
                    distance = directRouteMatrix[p1];
                } else if (directRouteMatrix[p2]) {
                    distance = directRouteMatrix[p2];
                } else if (cityCoordinates[foundP] && cityCoordinates[foundD]) {
                    var lat1 = cityCoordinates[foundP].lat;
                    var lon1 = cityCoordinates[foundP].lng;
                    var lat2 = cityCoordinates[foundD].lat;
                    var lon2 = cityCoordinates[foundD].lng;

                    var R = 6371;
                    var dLat = (lat2 - lat1) * Math.PI / 180;
                    var dLon = (lon2 - lon1) * Math.PI / 180;
                    var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                            Math.sin(dLon / 2) * Math.sin(dLon / 2);
                    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                    var straightDist = R * c;
                    distance = Math.max(20, Math.round(straightDist * 1.25));
                }
            } else {
                distance = 150; // Fallback only for unrecognized custom addresses
            }

            document.getElementById('distance_km').value = distance;
            
            // Synchronously update the UI immediately without waiting for network!
            updateLiveFareUI(distance);

            // Also call backend to calculate fare and coupons
            fetchFareForDistance(distance);

            // Also asynchronously verify with backend endpoint
            var pForm = new FormData();
            pForm.append('pickup', pickup);
            pForm.append('drop', drop);
            fetch('<?= base_url("welcome/get_distance") ?>', {
                method: 'POST',
                body: pForm
            })
            .then(res => res.json())
            .then(data => {
                if (data.status && data.distance_km && data.distance_km !== distance) {
                    document.getElementById('distance_km').value = data.distance_km;
                    updateLiveFareUI(data.distance_km);
                    fetchFareForDistance(data.distance_km);
                }
            })
            .catch(function() {});
        }

        document.addEventListener('DOMContentLoaded', function() {
            var pickupInput = document.getElementById('pickup_location');
            var dropInput = document.getElementById('drop_location');

            // Setup Custom Autocomplete Engine
            setupCustomAutocomplete('pickup_location', 'pickup_autocomplete_dropdown');
            setupCustomAutocomplete('drop_location', 'drop_autocomplete_dropdown');

            ['input', 'change', 'keyup', 'blur', 'paste'].forEach(function(evt) {
                if (pickupInput) pickupInput.addEventListener(evt, calculateFare);
                if (dropInput) dropInput.addEventListener(evt, calculateFare);
            });
        });

        function initGooglePlaces() {
            var pInput = document.getElementById('pickup_location');
            var dInput = document.getElementById('drop_location');
            var options = {
                componentRestrictions: { country: 'in' },
                fields: ['formatted_address', 'name', 'geometry']
            };
            if (pInput && typeof google !== 'undefined' && google.maps && google.maps.places) {
                try {
                    pickupAutocomplete = new google.maps.places.Autocomplete(pInput, options);
                    pickupAutocomplete.addListener('place_changed', function() {
                        calculateGoogleDistance();
                    });
                } catch(e) {}
            }
            if (dInput && typeof google !== 'undefined' && google.maps && google.maps.places) {
                try {
                    dropAutocomplete = new google.maps.places.Autocomplete(dInput, options);
                    dropAutocomplete.addListener('place_changed', function() {
                        calculateGoogleDistance();
                    });
                } catch(e) {}
            }
        }

        function calculateGoogleDistance() {
            var pickup = (document.getElementById('pickup_location') ? document.getElementById('pickup_location').value : '').trim();
            var drop = (document.getElementById('drop_location') ? document.getElementById('drop_location').value : '').trim();

            if (!pickup || !drop) {
                calculateFare();
                return;
            }

            // Always calculate fare immediately first
            calculateFare();

            if (typeof google !== 'undefined' && google.maps && google.maps.DistanceMatrixService) {
                try {
                    var service = new google.maps.DistanceMatrixService();
                    service.getDistanceMatrix({
                        origins: [pickup],
                        destinations: [drop],
                        travelMode: google.maps.TravelMode.DRIVING,
                        unitSystem: google.maps.UnitSystem.METRIC
                    }, function(response, status) {
                        if (status === 'OK' && response && response.rows && response.rows[0] && response.rows[0].elements && response.rows[0].elements[0] && response.rows[0].elements[0].status === 'OK') {
                            var distanceMeters = response.rows[0].elements[0].distance.value;
                            var distanceKm = Math.round(distanceMeters / 1000);
                            if (distanceKm < 1) distanceKm = 1;
                            document.getElementById('distance_km').value = distanceKm;
                            fetchFareForDistance(distanceKm);
                        }
                    });
                } catch(e) {
                    console.log('Google Distance Matrix offline, using smart matrix.');
                }
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

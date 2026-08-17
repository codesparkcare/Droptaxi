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
            sticky: top;
            z-index: 1050;
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
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?= base_url() ?>">
                <div class="logo-badge"><i class="fa-solid fa-taxi"></i></div>
                <span>Drop<span class="text-warning">Taxi</span></span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-menu navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="#booking-section">Book Taxi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tariffs">Tariff & Rates</a></li>
                    <li class="nav-item"><a class="nav-link" href="#why-us">Why Choose Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <a href="https://wa.me/<?= $settings['whatsapp_number'] ?? '919876543210' ?>" target="_blank" class="btn btn-outline-dark rounded-circle p-2" title="WhatsApp Us">
                        <i class="fa-brands fa-whatsapp fs-5 text-success"></i>
                    </a>
                    <a href="tel:<?= $settings['contact_phone'] ?? '+919876543210' ?>" class="btn btn-brand-yellow">
                        <i class="fa-solid fa-phone me-2"></i>Call Now
                    </a>
                </div>
            </div>
        </div>
    </nav>

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
                                <div class="col-6 col-md-3">
                                    <div class="vehicle-select-card selected" id="card-sedan" onclick="selectVehicle('sedan')">
                                        <i class="fa-solid fa-car"></i>
                                        <div class="fw-bold mt-1 small">Sedan</div>
                                        <div class="text-muted extra-small">₹14 / km</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="vehicle-select-card" id="card-suv" onclick="selectVehicle('suv')">
                                        <i class="fa-solid fa-truck-monster"></i>
                                        <div class="fw-bold mt-1 small">SUV</div>
                                        <div class="text-muted extra-small">₹19 / km</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="vehicle-select-card" id="card-innova" onclick="selectVehicle('innova')">
                                        <i class="fa-solid fa-van-shuttle"></i>
                                        <div class="fw-bold mt-1 small">Innova</div>
                                        <div class="text-muted extra-small">₹22 / km</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="vehicle-select-card" id="card-tempo" onclick="selectVehicle('tempo')">
                                        <i class="fa-solid fa-bus"></i>
                                        <div class="fw-bold mt-1 small">Tempo</div>
                                        <div class="text-muted extra-small">₹28 / km</div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="vehicle_type" id="vehicle_type" value="sedan">

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
                                <div class="extra-small text-muted text-end mt-1">* Toll, State Permit & Parking extra if applicable</div>
                            </div>

                            <!-- Coupon Code Input Widget -->
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-ticket text-warning"></i></span>
                                    <input type="text" class="form-control text-uppercase font-monospace" name="coupon_code" id="coupon_code" placeholder="Have a coupon code? (e.g. SAVE100)" onchange="calculateGoogleDistance()">
                                    <button class="btn btn-outline-dark fw-bold" type="button" onclick="calculateGoogleDistance()">Apply</button>
                                </div>
                                <div id="coupon-alert-msg" class="extra-small mt-1 fw-bold d-none"></div>
                            </div>

                            <!-- Passenger Details -->
                            <div class="row g-2 mb-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="passenger_name" placeholder="Your Name *" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="tel" class="form-control" name="passenger_phone" placeholder="Phone Number *" required>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <input type="email" class="form-control" name="passenger_email" placeholder="Email Address (for confirmation receipt)">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-brand-yellow w-100 py-3 text-uppercase font-weight-bold fs-6">
                                <i class="fa-solid fa-taxi me-2"></i> Confirm Booking Now
                            </button>
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

                        <div class="d-flex align-items-baseline gap-1 mb-3">
                            <span class="fs-2 fw-extrabold text-dark">₹<?= number_format($v['per_km_oneway'], 0) ?></span>
                            <span class="text-muted fw-semibold">/ km (One Way)</span>
                        </div>

                        <ul class="list-unstyled small mb-4">
                            <li class="py-1"><i class="fa-solid fa-check text-success me-2"></i> Round Trip Rate: <strong>₹<?= $v['per_km_roundtrip'] ?>/km</strong></li>
                            <li class="py-1"><i class="fa-solid fa-check text-success me-2"></i> Capacity: <strong><?= $v['capacity'] ?> Passengers</strong></li>
                            <li class="py-1"><i class="fa-solid fa-check text-success me-2"></i> Driver Batta: <strong>₹<?= $v['driver_batta_oneway'] ?>/day</strong></li>
                            <li class="py-1"><i class="fa-solid fa-check text-success me-2"></i> Min Coverage: <strong><?= $v['min_km_oneway'] ?> KM</strong></li>
                            <li class="py-1"><i class="fa-solid fa-check text-success me-2"></i> AC & Music System</li>
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
    </script>
</body>
</html>

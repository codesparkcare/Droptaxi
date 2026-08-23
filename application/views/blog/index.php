<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= html_escape($meta_title) ?></title>
    <meta name="keywords" content="<?= html_escape($meta_keywords) ?>">
    <meta name="description" content="<?= html_escape($meta_description) ?>">
    <link rel="canonical" href="<?= $canonical_url ?>">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">

    <!-- OpenGraph / Twitter Cards -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $canonical_url ?>">
    <meta property="og:title" content="<?= html_escape($meta_title) ?>">
    <meta property="og:description" content="<?= html_escape($meta_description) ?>">
    <meta property="og:image" content="<?= base_url($settings['og_image'] ?? 'assets/images/og-banner.jpg') ?>">

    <!-- Bootstrap 5 & FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- JSON-LD Breadcrumb Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "Home",
        "item": "<?= base_url() ?>"
      },{
        "@type": "ListItem",
        "position": 2,
        "name": "Blog",
        "item": "<?= base_url('blog') ?>"
      }]
    }
    </script>

    <style>
        :root {
            --brand-yellow: #f59e0b;
            --brand-dark: #0f172a;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--brand-dark);
        }
        .btn-brand-yellow {
            background-color: var(--brand-yellow);
            color: #000;
            font-weight: 700;
            border-radius: 50px;
            padding: 10px 24px;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-brand-yellow:hover {
            background-color: #d97706;
            color: #000;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
        }
        .hero-banner {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #fff;
            padding: 70px 0 50px;
            border-radius: 0 0 30px 30px;
        }
        .blog-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px rgba(15, 23, 42, 0.08);
            border-color: #cbd5e1;
        }
        .blog-card-img {
            height: 220px;
            width: 100%;
            object-fit: cover;
        }
        .badge-category {
            background: #fef3c7;
            color: #92400e;
            font-size: 0.75rem;
            font-weight: 700;
            border-radius: 20px;
            padding: 6px 14px;
        }
        .sticky-sidebar {
            position: -webkit-sticky;
            position: sticky;
            top: 90px;
        }
        .footer-bg {
            background-color: #0f172a;
            color: #94a3b8;
            padding: 60px 0 30px;
        }
    </style>
</head>
<body>

    <!-- Top Info Bar -->
    <div class="bg-dark text-white py-2 small border-bottom border-secondary border-opacity-25">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <i class="fa-solid fa-phone text-warning me-2"></i>24x7 Helpline: <strong><?= html_escape($settings['contact_phone'] ?? '+91 98765 43210') ?></strong>
                <span class="ms-3 d-none d-md-inline text-muted"><i class="fa-solid fa-shield-halved text-success me-1"></i> Safe & Sanitized Cabs</span>
            </div>
            <div>
                <a href="<?= base_url() ?>" class="text-white text-decoration-none me-3"><i class="fa-solid fa-taxi text-warning me-1"></i> Book Taxi</a>
                <a href="https://wa.me/<?= html_escape($settings['whatsapp_number'] ?? '919876543210') ?>" target="_blank" class="text-success text-decoration-none fw-bold">
                    <i class="fa-brands fa-whatsapp"></i> WhatsApp
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?= base_url() ?>">
                <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="fa-solid fa-taxi"></i>
                </div>
                <span>Drop<span class="text-warning">Taxi</span></span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center gap-3">
                    <li class="nav-item"><a class="nav-link fw-semibold" href="<?= base_url() ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="<?= base_url() ?>#tariffs">Tariff Plans</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="<?= base_url() ?>#routes">Popular Routes</a></li>
                    <li class="nav-item"><a class="nav-link fw-bold text-warning active" href="<?= base_url('blog') ?>">Blog & Guides</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold" href="<?= base_url() ?>#contact">Contact</a></li>
                    <li class="nav-item ms-lg-2">
                        <a href="<?= base_url() ?>" class="btn btn-brand-yellow">
                            <i class="fa-solid fa-calendar-check me-2"></i>Book Cab Now
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Banner -->
    <section class="hero-banner text-center">
        <div class="container">
            <div class="badge bg-warning text-dark rounded-pill px-3 py-2 fw-bold mb-3">
                <i class="fa-solid fa-compass me-1"></i> Travel & Route Guides
            </div>
            <h1 class="display-5 fw-bold mb-3">DropTaxi Blog & Travel Advice</h1>
            <p class="lead text-light text-opacity-75 mx-auto" style="max-width: 680px;">
                Expert advice on one-way drop taxis, outstation routes, fare-saving hacks, and seamless highway travel across Tamil Nadu & South India.
            </p>
        </div>
    </section>

    <!-- Main Content Container -->
    <div class="container py-5">
        <div class="row g-4">
            
            <!-- Blog Posts Grid (Left Column) -->
            <div class="col-lg-8">
                <?php if (empty($blogs)): ?>
                    <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                        <i class="fa-regular fa-newspaper fa-3x text-muted mb-3"></i>
                        <h4 class="fw-bold text-dark">No Articles Published Yet</h4>
                        <p class="text-secondary">Check back soon for travel guides, route tips, and outstation taxi news.</p>
                        <a href="<?= base_url() ?>" class="btn btn-warning rounded-pill px-4 mx-auto fw-bold">Book a Taxi</a>
                    </div>
                <?php else: ?>
                    <div class="row g-4">
                        <?php foreach ($blogs as $b): ?>
                            <div class="col-md-6">
                                <article class="blog-card">
                                    <a href="<?= base_url('blog/' . $b['slug']) ?>" class="d-block position-relative">
                                        <?php if (!empty($b['featured_image'])): ?>
                                            <img src="<?= base_url($b['featured_image']) ?>" class="blog-card-img" alt="<?= html_escape($b['title']) ?>" loading="lazy">
                                        <?php else: ?>
                                            <div class="blog-card-img bg-dark d-flex align-items-center justify-content-center text-white text-opacity-50">
                                                <i class="fa-solid fa-car-side fa-3x text-warning"></i>
                                            </div>
                                        <?php endif; ?>
                                        <span class="position-absolute top-0 start-0 m-3 badge badge-category shadow-sm">
                                            <?= html_escape($b['category'] ?? 'Travel Guide') ?>
                                        </span>
                                    </a>
                                    
                                    <div class="p-4 d-flex flex-column flex-grow-1">
                                        <div class="extra-small text-muted mb-2 d-flex align-items-center gap-3">
                                            <span><i class="fa-regular fa-calendar me-1"></i><?= date('M d, Y', strtotime($b['created_at'])) ?></span>
                                            <span><i class="fa-regular fa-eye me-1"></i><?= number_format($b['views']) ?> views</span>
                                        </div>

                                        <h5 class="fw-bold mb-3 text-dark">
                                            <a href="<?= base_url('blog/' . $b['slug']) ?>" class="text-dark text-decoration-none">
                                                <?= html_escape($b['title']) ?>
                                            </a>
                                        </h5>

                                        <p class="text-secondary small flex-grow-1 mb-4" style="line-height: 1.6;">
                                            <?= html_escape($b['excerpt'] ?: substr(strip_tags($b['content']), 0, 120) . '...') ?>
                                        </p>

                                        <div class="d-flex align-items-center justify-content-between pt-3 border-top border-light">
                                            <span class="small fw-semibold text-muted">
                                                <i class="fa-regular fa-user me-1 text-warning"></i><?= html_escape($b['author'] ?? 'DropTaxi') ?>
                                            </span>
                                            <a href="<?= base_url('blog/' . $b['slug']) ?>" class="fw-bold text-warning text-decoration-none small">
                                                Read Guide <i class="fa-solid fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sticky Sidebar (Right Column) -->
            <div class="col-lg-4">
                <div class="sticky-sidebar">

                    <!-- Instant Booking CTA Box -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
                        <div class="badge bg-warning text-dark rounded-pill px-3 py-1 fw-bold mb-2">
                            <i class="fa-solid fa-bolt me-1"></i> 40% Cheaper One-Way Fares
                        </div>
                        <h5 class="fw-bold mb-2">Need an Outstation Cab?</h5>
                        <p class="small text-white text-opacity-75 mb-3">
                            Instant online taxi booking with live distance calculation and verified AC vehicles.
                        </p>
                        <a href="<?= base_url() ?>" class="btn btn-warning w-100 fw-bold py-2 rounded-pill shadow-sm">
                            <i class="fa-solid fa-calculator me-2"></i>Calculate Fare & Book
                        </a>
                    </div>

                    <!-- 24x7 Call Box -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 1.3rem;">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <div class="extra-small text-muted text-uppercase fw-bold">Emergency & Scheduled Booking</div>
                                <a href="tel:<?= html_escape($settings['contact_phone'] ?? '+91 98765 43210') ?>" class="h5 fw-bold text-dark text-decoration-none mb-0">
                                    <?= html_escape($settings['contact_phone'] ?? '+91 98765 43210') ?>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Popular Outstation Routes List -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                        <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-route text-warning me-2"></i>Popular Drop Taxi Routes</h6>
                        <ul class="list-unstyled mb-0 small">
                            <li class="py-2 border-bottom d-flex justify-content-between">
                                <a href="<?= base_url() ?>" class="text-dark text-decoration-none">Chennai to Madurai Drop Taxi</a>
                                <span class="fw-bold text-warning">₹14/km</span>
                            </li>
                            <li class="py-2 border-bottom d-flex justify-content-between">
                                <a href="<?= base_url() ?>" class="text-dark text-decoration-none">Chennai to Bangalore Taxi</a>
                                <span class="fw-bold text-warning">₹14/km</span>
                            </li>
                            <li class="py-2 border-bottom d-flex justify-content-between">
                                <a href="<?= base_url() ?>" class="text-dark text-decoration-none">Coimbatore to Chennai Cab</a>
                                <span class="fw-bold text-warning">₹14/km</span>
                            </li>
                            <li class="py-2 border-bottom d-flex justify-content-between">
                                <a href="<?= base_url() ?>" class="text-dark text-decoration-none">Madurai to Tirunelveli Taxi</a>
                                <span class="fw-bold text-warning">₹14/km</span>
                            </li>
                            <li class="py-2 d-flex justify-content-between">
                                <a href="<?= base_url() ?>" class="text-dark text-decoration-none">Trichy to Chennai Drop Taxi</a>
                                <span class="fw-bold text-warning">₹14/km</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-bg">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-4">
                    <h5 class="fw-bold text-white mb-3">Drop<span class="text-warning">Taxi</span></h5>
                    <p class="small text-muted">
                        Tamil Nadu's premier one-way drop taxi and outstation cab booking service. Pay only for one way with zero return charges and verified chauffeurs.
                    </p>
                </div>
                <div class="col-lg-4">
                    <h6 class="text-white fw-bold mb-3">Quick Links</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="<?= base_url() ?>" class="text-muted text-decoration-none">Book Online Taxi</a></li>
                        <li class="mb-2"><a href="<?= base_url('blog') ?>" class="text-muted text-decoration-none">Travel Blog & Articles</a></li>
                        <li class="mb-2"><a href="<?= base_url('sitemap.xml') ?>" target="_blank" class="text-muted text-decoration-none">XML Sitemap</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6 class="text-white fw-bold mb-3">24x7 Customer Support</h6>
                    <p class="small text-muted mb-2"><i class="fa-solid fa-phone text-warning me-2"></i><?= html_escape($settings['contact_phone'] ?? '+91 98765 43210') ?></p>
                    <p class="small text-muted"><i class="fa-solid fa-envelope text-warning me-2"></i><?= html_escape($settings['contact_email'] ?? 'info@droptaxi.com') ?></p>
                </div>
            </div>
            <div class="border-top border-secondary border-opacity-25 pt-4 text-center small text-muted">
                &copy; <?= date('Y') ?> DropTaxi Services. All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

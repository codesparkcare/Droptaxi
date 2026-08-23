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

    <!-- OpenGraph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?= $canonical_url ?>">
    <meta property="og:title" content="<?= html_escape($meta_title) ?>">
    <meta property="og:description" content="<?= html_escape($meta_description) ?>">
    <meta property="og:image" content="<?= $og_image ?>">
    <meta property="article:published_time" content="<?= date('c', strtotime($blog['created_at'])) ?>">
    <meta property="article:modified_time" content="<?= date('c', strtotime($blog['updated_at'])) ?>">
    <meta property="article:section" content="<?= html_escape($blog['category'] ?? 'Travel Guide') ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= html_escape($meta_title) ?>">
    <meta name="twitter:description" content="<?= html_escape($meta_description) ?>">
    <meta name="twitter:image" content="<?= $og_image ?>">

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
      },{
        "@type": "ListItem",
        "position": 3,
        "name": "<?= addslashes($blog['title']) ?>",
        "item": "<?= $canonical_url ?>"
      }]
    }
    </script>

    <!-- JSON-LD BlogPosting Schema for Google Rich Results -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BlogPosting",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?= $canonical_url ?>"
      },
      "headline": "<?= addslashes($blog['title']) ?>",
      "description": "<?= addslashes($meta_description) ?>",
      "image": "<?= $og_image ?>",
      "author": {
        "@type": "Person",
        "name": "<?= addslashes($blog['author'] ?? 'DropTaxi Editorial') ?>"
      },
      "publisher": {
        "@type": "Organization",
        "name": "DropTaxi",
        "logo": {
          "@type": "ImageObject",
          "url": "<?= base_url('assets/images/logo.png') ?>"
        }
      },
      "datePublished": "<?= date('c', strtotime($blog['created_at'])) ?>",
      "dateModified": "<?= date('c', strtotime($blog['updated_at'])) ?>"
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
        .article-content {
            font-size: 1.08rem;
            line-height: 1.85;
            color: #334155;
        }
        .article-content h2 {
            font-size: 1.65rem;
            font-weight: 800;
            color: #0f172a;
            margin-top: 2rem;
            margin-bottom: 1rem;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 0.5rem;
        }
        .article-content h3 {
            font-size: 1.35rem;
            font-weight: 700;
            color: #1e293b;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }
        .article-content p {
            margin-bottom: 1.25rem;
        }
        .article-content ul, .article-content ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }
        .article-content li {
            margin-bottom: 0.5rem;
        }
        .article-content blockquote {
            border-left: 4px solid var(--brand-yellow);
            padding: 1rem 1.5rem;
            background-color: #fffbeb;
            border-radius: 0 12px 12px 0;
            font-style: italic;
            margin: 1.5rem 0;
        }
        .share-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            transition: all 0.2s;
        }
        .share-btn:hover {
            transform: scale(1.1);
            color: #fff;
        }
        .share-wa { background: #25D366; }
        .share-tw { background: #1DA1F2; }
        .share-fb { background: #1877F2; }
        .share-li { background: #0A66C2; }
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
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-4 text-dark" href="<?= base_url() ?>">
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
                    <li class="nav-item"><a class="nav-link fw-bold text-warning" href="<?= base_url('blog') ?>">Blog</a></li>
                    <li class="nav-item ms-lg-2">
                        <a href="<?= base_url() ?>" class="btn btn-brand-yellow">
                            <i class="fa-solid fa-calendar-check me-2"></i>Book Cab Now
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Article Body -->
    <main class="container py-5">
        
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i>Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('blog') ?>" class="text-decoration-none text-muted">Blog</a></li>
                <li class="breadcrumb-item active text-truncate text-dark fw-semibold" style="max-width: 300px;" aria-current="page"><?= html_escape($blog['title']) ?></li>
            </ol>
        </nav>

        <div class="row g-4">
            
            <!-- Article Container (Left Column) -->
            <div class="col-lg-8">
                <article class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    
                    <!-- Category & Meta -->
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">
                            <i class="fa-solid fa-tag me-1"></i><?= html_escape($blog['category'] ?? 'Travel Guide') ?>
                        </span>
                        <div class="extra-small text-muted d-flex align-items-center gap-3">
                            <span><i class="fa-regular fa-calendar me-1"></i><?= date('M d, Y', strtotime($blog['created_at'])) ?></span>
                            <span><i class="fa-regular fa-user me-1"></i><?= html_escape($blog['author'] ?? 'DropTaxi Editorial') ?></span>
                            <span><i class="fa-regular fa-eye me-1"></i><?= number_format($blog['views']) ?> views</span>
                        </div>
                    </div>

                    <!-- Article Title -->
                    <h1 class="fw-bold text-dark mb-4 display-6" style="line-height: 1.3;">
                        <?= html_escape($blog['title']) ?>
                    </h1>

                    <!-- Featured Image -->
                    <?php if (!empty($blog['featured_image'])): ?>
                        <div class="mb-4">
                            <img src="<?= base_url($blog['featured_image']) ?>" class="img-fluid rounded-4 shadow-sm w-100" style="max-height: 420px; object-fit: cover;" alt="<?= html_escape($blog['title']) ?>">
                        </div>
                    <?php endif; ?>

                    <!-- Social Share Bar Top -->
                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4 border">
                        <span class="small fw-bold text-dark"><i class="fa-solid fa-share-nodes me-2 text-warning"></i>Share this Guide:</span>
                        <div class="d-flex gap-2">
                            <a href="https://api.whatsapp.com/send?text=<?= urlencode($blog['title'] . ' ' . $canonical_url) ?>" target="_blank" class="share-btn share-wa" title="Share on WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                            <a href="https://twitter.com/intent/tweet?text=<?= urlencode($blog['title']) ?>&url=<?= urlencode($canonical_url) ?>" target="_blank" class="share-btn share-tw" title="Share on Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($canonical_url) ?>" target="_blank" class="share-btn share-fb" title="Share on Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode($canonical_url) ?>" target="_blank" class="share-btn share-li" title="Share on LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                            <button onclick="navigator.clipboard.writeText('<?= $canonical_url ?>'); alert('Link copied to clipboard!');" class="share-btn bg-secondary" title="Copy Link"><i class="fa-solid fa-link"></i></button>
                        </div>
                    </div>

                    <!-- Main HTML Content -->
                    <div class="article-content">
                        <?= $blog['content'] ?>
                    </div>

                    <!-- Bottom Taxi Booking CTA Banner -->
                    <div class="card border-0 rounded-4 p-4 mt-5 text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
                        <div class="row align-items-center g-3">
                            <div class="col-md-8">
                                <span class="badge bg-warning text-dark rounded-pill px-3 py-1 fw-bold mb-2">Book Online & Save 40%</span>
                                <h4 class="fw-bold mb-1">Ready for Your Next Outstation Journey?</h4>
                                <p class="small text-light text-opacity-75 mb-0">Pay only for one-way distance with 24x7 doorstep pickup across Tamil Nadu.</p>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <a href="<?= base_url() ?>" class="btn btn-warning fw-bold px-4 py-2 rounded-pill shadow">
                                    <i class="fa-solid fa-taxi me-2"></i>Book Cab Now
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Target Keywords Tags -->
                    <?php if (!empty($blog['meta_keywords'])): ?>
                        <div class="pt-4 mt-4 border-top">
                            <div class="small fw-bold text-muted mb-2"><i class="fa-solid fa-tags text-warning me-1"></i>Related Topics:</div>
                            <div class="d-flex flex-wrap gap-2">
                                <?php foreach (explode(',', $blog['meta_keywords']) as $tag): ?>
                                    <span class="badge bg-light text-secondary border fw-normal py-2 px-3"><?= html_escape(trim($tag)) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </article>
            </div>

            <!-- Sidebar (Right Column) -->
            <div class="col-lg-4">
                <div class="sticky-sidebar">

                    <!-- Instant Booking Calculator Widget -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 text-white" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
                        <h5 class="fw-bold mb-2"><i class="fa-solid fa-calculator text-warning me-2"></i>Instant Fare Calculator</h5>
                        <p class="small text-white text-opacity-75 mb-3">Check driving distance & transparent one-way taxi fare immediately.</p>
                        <a href="<?= base_url() ?>" class="btn btn-warning w-100 fw-bold py-2 rounded-pill shadow-sm">
                            <i class="fa-solid fa-car me-2"></i>Calculate My Trip Fare
                        </a>
                    </div>

                    <!-- 24x7 Hotline Box -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 1.3rem;">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <div class="extra-small text-muted text-uppercase fw-bold">Instant Cab Booking Helpline</div>
                                <a href="tel:<?= html_escape($settings['contact_phone'] ?? '+91 98765 43210') ?>" class="h5 fw-bold text-dark text-decoration-none mb-0">
                                    <?= html_escape($settings['contact_phone'] ?? '+91 98765 43210') ?>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Recent SEO Articles -->
                    <?php if (!empty($recent_blogs)): ?>
                        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                            <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-newspaper text-warning me-2"></i>Related Travel Guides</h6>
                            <div class="d-flex flex-column gap-3">
                                <?php foreach ($recent_blogs as $rb): ?>
                                    <div class="d-flex gap-3 align-items-center">
                                        <?php if (!empty($rb['featured_image'])): ?>
                                            <img src="<?= base_url($rb['featured_image']) ?>" class="rounded-3" style="width: 60px; height: 60px; object-fit: cover;" alt="Thumbnail">
                                        <?php else: ?>
                                            <div class="rounded-3 bg-light d-flex align-items-center justify-content-center text-muted" style="width: 60px; height: 60px;">
                                                <i class="fa-regular fa-newspaper"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <h6 class="mb-1" style="font-size: 0.9rem;">
                                                <a href="<?= base_url('blog/' . $rb['slug']) ?>" class="text-dark text-decoration-none fw-bold line-clamp-2">
                                                    <?= html_escape($rb['title']) ?>
                                                </a>
                                            </h6>
                                            <div class="extra-small text-muted"><?= date('M d, Y', strtotime($rb['created_at'])) ?></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </main>

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

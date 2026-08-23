<div class="container-fluid p-4">
    <!-- Breadcrumb & Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="fa-solid fa-newspaper text-info me-2"></i>SEO & Blog Management
            </h4>
            <p class="text-secondary small mb-0">Publish high-ranking articles, manage SEO meta titles, keywords, and boost Google search visibility.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('sitemap.xml') ?>" target="_blank" class="btn btn-outline-warning btn-sm fw-semibold rounded-pill px-3">
                <i class="fa-solid fa-sitemap me-1"></i> View Sitemap.xml
            </a>
            <a href="<?= base_url('admin/add_blog') ?>" class="btn btn-warning btn-sm fw-bold rounded-pill px-3">
                <i class="fa-solid fa-plus me-1"></i> Write New Article
            </a>
        </div>
    </div>

    <!-- Flash Alerts -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i><?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
            <i class="fa-solid fa-circle-exclamation me-2"></i><?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Blog Posts Table -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0 text-dark">Published & Draft Articles (<?= count($blogs) ?>)</h6>
            <span class="badge bg-light text-dark fw-normal">Auto-indexed in Sitemap</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light small text-uppercase text-secondary">
                    <tr>
                        <th class="ps-4" style="width: 50px;">#</th>
                        <th>Article Details</th>
                        <th>Category</th>
                        <th>SEO Target Keywords</th>
                        <th>Views</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="small">
                    <?php if (empty($blogs)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fa-regular fa-newspaper fa-2x mb-2 d-block text-secondary"></i>
                                No blog posts found. Click "Write New Article" to start your SEO strategy!
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($blogs as $idx => $b): ?>
                            <tr>
                                <td class="ps-4 text-muted"><?= $idx + 1 ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <?php if (!empty($b['featured_image'])): ?>
                                            <img src="<?= base_url($b['featured_image']) ?>" class="rounded-3" style="width: 50px; height: 50px; object-fit: cover;" alt="Thumbnail">
                                        <?php else: ?>
                                            <div class="rounded-3 bg-light d-flex align-items-center justify-content-center text-muted" style="width: 50px; height: 50px;">
                                                <i class="fa-regular fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <div class="fw-bold text-dark"><?= html_escape($b['title']) ?></div>
                                            <div class="text-muted extra-small">
                                                <span class="font-monospace text-primary">/blog/<?= html_escape($b['slug']) ?></span>
                                                &bull; <?= date('M d, Y', strtotime($b['created_at'])) ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border fw-normal"><?= html_escape($b['category'] ?? 'Travel Guide') ?></span>
                                </td>
                                <td style="max-width: 250px;">
                                    <?php if (!empty($b['meta_keywords'])): ?>
                                        <div class="text-truncate text-muted extra-small" title="<?= html_escape($b['meta_keywords']) ?>">
                                            <i class="fa-solid fa-tags text-warning me-1"></i><?= html_escape($b['meta_keywords']) ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted extra-small">None</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-info-subtle text-info fw-semibold">
                                        <i class="fa-regular fa-eye me-1"></i><?= number_format($b['views']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/toggle_blog_status/' . $b['id']) ?>" class="badge text-decoration-none <?= $b['status'] === 'published' ? 'bg-success text-white' : 'bg-secondary text-white' ?>" title="Click to toggle">
                                        <?= ucfirst($b['status']) ?>
                                    </a>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('blog/' . $b['slug']) ?>" target="_blank" class="btn btn-outline-secondary" title="View Live Page">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
                                        <a href="<?= base_url('admin/edit_blog/' . $b['id']) ?>" class="btn btn-outline-primary" title="Edit Post & SEO">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="<?= base_url('admin/delete_blog/' . $b['id']) ?>" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this blog article?');" title="Delete Post">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

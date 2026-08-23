<div class="container-fluid p-4">
    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="fa-solid fa-pen-nib text-warning me-2"></i><?= $blog ? 'Edit Blog Article' : 'Create New SEO Article' ?>
            </h4>
            <p class="text-secondary small mb-0">Craft engaging articles with rich meta tags to rank #1 on Google search results.</p>
        </div>
        <a href="<?= base_url('admin/blogs') ?>" class="btn btn-outline-secondary btn-sm fw-semibold rounded-pill px-3">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Blog List
        </a>
    </div>

    <!-- Form -->
    <form action="<?= $blog ? base_url('admin/edit_blog/' . $blog['id']) : base_url('admin/add_blog') ?>" method="POST" enctype="multipart/form-data">
        <div class="row g-4">
            
            <!-- Left Column: Content & Body -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-file-lines text-primary me-2"></i>Article Information</h6>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Article Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" id="blog_title" value="<?= html_escape($blog['title'] ?? '') ?>" placeholder="e.g. Benefits of One Way Drop Taxi in Tamil Nadu: Save 40%" required onkeyup="autoGenerateSlug(this.value)">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">URL Slug (Permalink) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted small"><?= base_url('blog/') ?></span>
                            <input type="text" class="form-control font-monospace" name="slug" id="blog_slug" value="<?= html_escape($blog['slug'] ?? '') ?>" placeholder="benefits-of-one-way-drop-taxi" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Category</label>
                            <input type="text" class="form-control" name="category" value="<?= html_escape($blog['category'] ?? 'Travel Guide') ?>" placeholder="e.g. Travel Guide, Outstation Tips, Route Guides">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Author Name</label>
                            <input type="text" class="form-control" name="author" value="<?= html_escape($blog['author'] ?? 'DropTaxi Editorial') ?>" placeholder="DropTaxi Editorial">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Short Summary / Excerpt</label>
                        <textarea class="form-control" name="excerpt" rows="2" placeholder="Brief 1-2 sentence overview shown in blog cards and social shares..."><?= html_escape($blog['excerpt'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Full Article Content (HTML allowed) <span class="text-danger">*</span></label>
                        <textarea class="form-control font-monospace" name="content" rows="14" placeholder="Write full HTML blog post with headings (<h2>, <h3>), paragraphs (<p>), bullet points (<ul>, <li>), and call-to-actions..." required><?= html_escape($blog['content'] ?? '') ?></textarea>
                        <div class="form-text small text-muted">Supports full semantic HTML tags: <code>&lt;h2&gt;</code>, <code>&lt;h3&gt;</code>, <code>&lt;p&gt;</code>, <code>&lt;ul&gt;</code>, <code>&lt;strong&gt;</code>, <code>&lt;blockquote&gt;</code>.</div>
                    </div>
                </div>

                <!-- Google SEO Meta Box -->
                <div class="card border-0 shadow-sm rounded-4 p-4" style="border-left: 5px solid #f59e0b !important;">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="fw-bold text-dark mb-0"><i class="fa-brands fa-google text-danger me-2"></i>Search Engine Optimization (SEO Meta Tags)</h6>
                        <span class="badge bg-warning-subtle text-dark border"><i class="fa-solid fa-bullseye me-1"></i>Rank #1 on Google</span>
                    </div>
                    <p class="text-secondary small mb-4">Customize how Google and other search engines display this article in search result snippets.</p>

                    <!-- Google Snippet Live Preview -->
                    <div class="p-3 bg-light rounded-3 mb-4 border">
                        <div class="extra-small text-muted mb-1"><i class="fa-solid fa-magnifying-glass me-1"></i>Google Search Result Preview</div>
                        <div class="fw-bold text-primary fs-6" id="preview_meta_title"><?= html_escape($blog['meta_title'] ?? ($blog['title'] ?? 'Article Title Preview | DropTaxi')) ?></div>
                        <div class="text-success extra-small mb-1 font-monospace" id="preview_meta_url"><?= base_url('blog/' . ($blog['slug'] ?? 'example-slug')) ?></div>
                        <div class="text-secondary small" id="preview_meta_desc"><?= html_escape($blog['meta_description'] ?? ($blog['excerpt'] ?? 'Article description preview that appears below the title in Google search results...')) ?></div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label class="form-label fw-semibold small">Custom Meta Title</label>
                            <span class="extra-small text-muted" id="meta_title_count">0 / 60 chars</span>
                        </div>
                        <input type="text" class="form-control" name="meta_title" id="meta_title_input" value="<?= html_escape($blog['meta_title'] ?? '') ?>" placeholder="e.g. Best One Way Drop Taxi in Tamil Nadu | Save 40% Online" oninput="updateGooglePreview()">
                        <div class="form-text extra-small text-muted">Optimal length: 50-60 characters for best Google CTR.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Target SEO Keywords (Comma Separated)</label>
                        <input type="text" class="form-control" name="meta_keywords" value="<?= html_escape($blog['meta_keywords'] ?? '') ?>" placeholder="e.g. one way drop taxi, taxi booking, near by droptaxi, online taxi, outstation drop taxi">
                        <div class="form-text extra-small text-muted">Keywords searched by users on Google.</div>
                    </div>

                    <div class="mb-0">
                        <div class="d-flex justify-content-between">
                            <label class="form-label fw-semibold small">Meta Description</label>
                            <span class="extra-small text-muted" id="meta_desc_count">0 / 160 chars</span>
                        </div>
                        <textarea class="form-control" name="meta_description" id="meta_desc_input" rows="3" placeholder="Compelling 150-160 character description with high-converting call to action..." oninput="updateGooglePreview()"><?= html_escape($blog['meta_description'] ?? '') ?></textarea>
                        <div class="form-text extra-small text-muted">Optimal length: 140-160 characters.</div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Publishing & Image -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-paper-plane text-success me-2"></i>Publishing Status</h6>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Status</label>
                        <select class="form-select" name="status">
                            <option value="published" <?= (isset($blog['status']) && $blog['status'] === 'published') || !$blog ? 'selected' : '' ?>>Published (Public & Indexed)</option>
                            <option value="draft" <?= isset($blog['status']) && $blog['status'] === 'draft' ? 'selected' : '' ?>>Draft (Hidden)</option>
                        </select>
                    </div>

                    <?php if ($blog): ?>
                        <div class="small text-muted mb-3 border-top pt-3">
                            <div><strong>Created:</strong> <?= date('M d, Y H:i', strtotime($blog['created_at'])) ?></div>
                            <div><strong>Last Updated:</strong> <?= date('M d, Y H:i', strtotime($blog['updated_at'])) ?></div>
                            <div><strong>Total Views:</strong> <span class="badge bg-info-subtle text-info"><?= number_format($blog['views']) ?></span></div>
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-warning w-100 fw-bold py-2">
                        <i class="fa-solid fa-floppy-disk me-2"></i><?= $blog ? 'Save Changes' : 'Publish Article' ?>
                    </button>
                </div>

                <!-- Featured Image Card -->
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-image text-warning me-2"></i>Featured Banner Image</h6>

                    <?php if (!empty($blog['featured_image'])): ?>
                        <div class="mb-3 text-center">
                            <img src="<?= base_url($blog['featured_image']) ?>" class="img-fluid rounded-3 shadow-sm border" style="max-height: 180px; width: 100%; object-fit: cover;" alt="Current Banner">
                            <div class="extra-small text-muted mt-1">Current Image</div>
                        </div>
                    <?php endif; ?>

                    <div class="mb-0">
                        <label class="form-label fw-semibold small">Upload New Image (JPG, PNG, WEBP)</label>
                        <input type="file" class="form-control form-control-sm" name="featured_image" accept="image/*">
                        <div class="form-text extra-small text-muted">Recommended size: 1200x630 px (ideal for OpenGraph / Facebook / Twitter cards).</div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
function autoGenerateSlug(title) {
    var slugInput = document.getElementById('blog_slug');
    if (!<?= $blog ? 'true' : 'false' ?> || !slugInput.value) {
        var slug = title.toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .trim()
            .replace(/\s+/g, '-');
        slugInput.value = slug;
        updateGooglePreview();
    }
}

function updateGooglePreview() {
    var title = document.getElementById('meta_title_input').value || document.getElementById('blog_title').value || 'Article Title Preview | DropTaxi';
    var desc = document.getElementById('meta_desc_input').value || 'Article description preview that appears below the title in Google search results...';
    var slug = document.getElementById('blog_slug').value || 'example-slug';

    document.getElementById('preview_meta_title').innerText = title;
    document.getElementById('preview_meta_desc').innerText = desc;
    document.getElementById('preview_meta_url').innerText = '<?= base_url('blog/') ?>' + slug;

    document.getElementById('meta_title_count').innerText = (document.getElementById('meta_title_input').value.length) + ' / 60 chars';
    document.getElementById('meta_desc_count').innerText = (document.getElementById('meta_desc_input').value.length) + ' / 160 chars';
}

document.addEventListener('DOMContentLoaded', function() {
    updateGooglePreview();
});
</script>

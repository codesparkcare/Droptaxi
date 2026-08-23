<div class="p-4 p-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold fs-4 mb-1 text-dark">System & Gateway Settings</h3>
            <p class="text-secondary mb-0 fs-6">Configure SMTP Email server, Razorpay Payment Gateway keys, and company contact details.</p>
        </div>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success border-0 rounded-3 mb-4"><i class="fa-solid fa-circle-check me-2"></i><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger border-0 rounded-3 mb-4"><i class="fa-solid fa-circle-exclamation me-2"></i><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 pt-4 px-4">
            <ul class="nav nav-tabs card-header-tabs border-0" id="settingsTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active fw-bold text-dark" id="smtp-tab" data-bs-toggle="tab" data-bs-target="#smtp-pane">
                        <i class="fa-solid fa-envelope me-2 text-primary"></i>SMTP Email Settings
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link fw-bold text-dark" id="razorpay-tab" data-bs-toggle="tab" data-bs-target="#razorpay-pane">
                        <i class="fa-solid fa-credit-card me-2 text-warning"></i>Razorpay Payment Gateway
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link fw-bold text-dark" id="gmaps-tab" data-bs-toggle="tab" data-bs-target="#gmaps-pane">
                        <i class="fa-solid fa-map-location-dot me-2 text-danger"></i>Google Maps API
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link fw-bold text-dark" id="general-tab" data-bs-toggle="tab" data-bs-target="#general-pane">
                        <i class="fa-solid fa-building me-2 text-success"></i>Company & Contact Info
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link fw-bold text-dark" id="migration-tab" data-bs-toggle="tab" data-bs-target="#migration-pane">
                        <i class="fa-solid fa-database me-2 text-info"></i>Database Sync & Migration
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body p-4 p-md-5">
            <div class="tab-content" id="settingsTabsContent">
                
                <!-- SMTP Settings Tab -->
                <div class="tab-pane fade show active" id="smtp-pane">
                    <h5 class="fw-bold text-dark mb-3">SMTP Mail Server Credentials</h5>
                    <p class="text-secondary small mb-4">Configure SMTP credentials to automatically send HTML booking confirmation emails to passengers and admin notifications.</p>

                    <form action="<?= base_url('admin/save_settings') ?>" method="POST">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">SMTP Host</label>
                                <input type="text" class="form-control" name="smtp_host" value="<?= html_escape($settings['smtp_host'] ?? 'smtp.gmail.com') ?>" placeholder="smtp.gmail.com">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-semibold">SMTP Port</label>
                                <input type="number" class="form-control" name="smtp_port" value="<?= html_escape($settings['smtp_port'] ?? '587') ?>" placeholder="587">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-semibold">Encryption</label>
                                <select class="form-select" name="smtp_crypto">
                                    <option value="tls" <?= ($settings['smtp_crypto'] ?? '')=='tls'?'selected':'' ?>>TLS (Port 587)</option>
                                    <option value="ssl" <?= ($settings['smtp_crypto'] ?? '')=='ssl'?'selected':'' ?>>SSL (Port 465)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">SMTP Username / Email</label>
                                <input type="text" class="form-control" name="smtp_user" value="<?= html_escape($settings['smtp_user'] ?? '') ?>" placeholder="your-email@gmail.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">SMTP Password / App Password</label>
                                <input type="password" class="form-control" name="smtp_pass" value="<?= html_escape($settings['smtp_pass'] ?? '') ?>" placeholder="••••••••••••••••">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Sender From Email</label>
                                <input type="email" class="form-control" name="smtp_from_email" value="<?= html_escape($settings['smtp_from_email'] ?? 'noreply@droptaxi.com') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Sender From Name</label>
                                <input type="text" class="form-control" name="smtp_from_name" value="<?= html_escape($settings['smtp_from_name'] ?? 'DropTaxi Booking Service') ?>">
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold">
                                <i class="fa-solid fa-floppy-disk me-2"></i>Save SMTP Settings
                            </button>
                        </div>
                    </form>

                    <hr class="my-5">

                    <!-- Send Test Email Tool -->
                    <div class="bg-light p-4 rounded-4">
                        <h6 class="fw-bold text-dark mb-2"><i class="fa-solid fa-paper-plane text-primary me-2"></i>Test SMTP Email Connection</h6>
                        <p class="text-secondary small mb-3">Send a test email to verify your SMTP server connection.</p>
                        
                        <form action="<?= base_url('admin/send_test_email') ?>" method="POST" class="row g-2 align-items-center">
                            <div class="col-md-8">
                                <input type="email" class="form-control" name="test_email" placeholder="Enter recipient email address..." required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-outline-primary w-100 font-weight-bold">
                                    Send Test Email
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Razorpay Settings Tab -->
                <div class="tab-pane fade" id="razorpay-pane">
                    <h5 class="fw-bold text-dark mb-3">Razorpay Payment Gateway API Keys</h5>
                    <p class="text-secondary small mb-4">Enter your Razorpay API Key ID and Key Secret to enable online payment checkout for taxi bookings.</p>

                    <form action="<?= base_url('admin/save_settings') ?>" method="POST">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Razorpay Key ID</label>
                                <input type="text" class="form-control" name="razorpay_key_id" value="<?= html_escape($settings['razorpay_key_id'] ?? '') ?>" placeholder="rzp_live_xxxxxxxx">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Razorpay Key Secret</label>
                                <input type="password" class="form-control" name="razorpay_key_secret" value="<?= html_escape($settings['razorpay_key_secret'] ?? '') ?>" placeholder="••••••••••••••••">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Gateway Status</label>
                                <select class="form-select" name="razorpay_enabled">
                                    <option value="1" <?= ($settings['razorpay_enabled'] ?? '1')=='1'?'selected':'' ?>>Enabled (Active Checkout)</option>
                                    <option value="0" <?= ($settings['razorpay_enabled'] ?? '1')=='0'?'selected':'' ?>>Disabled</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning px-4 py-2 font-weight-bold text-dark">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Save Razorpay Keys
                        </button>
                    </form>
                </div>

                <!-- Google Maps API Tab -->
                <div class="tab-pane fade" id="gmaps-pane">
                    <h5 class="fw-bold text-dark mb-3">Google Maps & Places API Key</h5>
                    <p class="text-secondary small mb-4">Configure your Google Maps API Key to enable automatic location autocomplete suggestions for Pickup & Drop locations, and live driving distance calculations.</p>

                    <form action="<?= base_url('admin/save_settings') ?>" method="POST">
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label class="form-label small fw-semibold">Google Maps API Key</label>
                                <input type="text" class="form-control font-monospace" name="google_map_key" value="<?= html_escape($settings['google_map_key'] ?? '') ?>" placeholder="AIzaSy...">
                                <div class="form-text mt-2 text-muted">
                                    <i class="fa-solid fa-circle-info text-primary me-1"></i>
                                    Make sure your Google Cloud API key has <strong>Places API</strong> and <strong>Distance Matrix API</strong> enabled.
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger px-4 py-2 font-weight-bold">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Save Google Maps Key
                        </button>
                    </form>
                </div>

                <!-- General Info Tab -->
                <div class="tab-pane fade" id="general-pane">
                    <h5 class="fw-bold text-dark mb-3">Company Info & Contact Numbers</h5>
                    <p class="text-secondary small mb-4">Update phone numbers and branding displayed on the website header and footer.</p>

                    <form action="<?= base_url('admin/save_settings') ?>" method="POST">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Website Title</label>
                                <input type="text" class="form-control" name="site_title" value="<?= html_escape($settings['site_title'] ?? 'DropTaxi Services') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Helpline Phone</label>
                                <input type="text" class="form-control" name="contact_phone" value="<?= html_escape($settings['contact_phone'] ?? '+91 98765 43210') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">WhatsApp Number (with country code)</label>
                                <input type="text" class="form-control" name="whatsapp_number" value="<?= html_escape($settings['whatsapp_number'] ?? '919876543210') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Support Email</label>
                                <input type="email" class="form-control" name="contact_email" value="<?= html_escape($settings['contact_email'] ?? 'info@droptaxi.com') ?>">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success px-4 py-2 font-weight-bold">
                            <i class="fa-solid fa-floppy-disk me-2"></i>Save Company Info
                        </button>
                    </form>
                </div>

                <!-- Database Migration & Schema Sync Tab -->
                <div class="tab-pane fade" id="migration-pane">
                    <h5 class="fw-bold text-dark mb-3">Database Auto-Migration & Schema Sync</h5>
                    <p class="text-secondary small mb-4">Run automated database migrations, create missing tables, add new columns, and synchronize default settings across local and live production environments.</p>

                    <div class="card bg-light border-0 p-4 mb-4" style="border-radius: 12px;">
                        <h6 class="fw-bold text-dark mb-2"><i class="fa-solid fa-link text-primary me-2"></i>Direct Migration URL</h6>
                        <p class="small text-muted mb-2">Whenever you deploy code to your live server via Git, you can run database updates instantly by visiting this URL in your browser:</p>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control font-monospace bg-white" readonly value="<?= base_url('migrate?key=droptaxi2026') ?>">
                            <a href="<?= base_url('migrate?key=droptaxi2026') ?>" target="_blank" class="btn btn-outline-primary fw-semibold">
                                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Open URL
                            </a>
                        </div>
                        <div class="small text-secondary">
                            <i class="fa-solid fa-shield-halved text-success me-1"></i>
                            <strong>Protected:</strong> Requires Admin Login or the secret key <code>key=droptaxi2026</code>.
                        </div>
                    </div>

                    <a href="<?= base_url('migrate') ?>" target="_blank" class="btn btn-info px-4 py-2 font-weight-bold text-white">
                        <i class="fa-solid fa-rotate me-2"></i>Run Database Migration & Sync Now
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

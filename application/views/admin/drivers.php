<div class="p-4 p-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold fs-4 mb-1 text-dark">Driver Management</h3>
            <p class="text-secondary mb-0 fs-6">Manage drivers, documents, verification status, and account access.</p>
        </div>
        <button class="btn btn-primary px-4 py-2 fw-bold rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#addDriverModal">
            <i class="fa-solid fa-plus me-2"></i>Add New Driver
        </button>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success border-0 rounded-3 mb-4 shadow-sm"><i class="fa-solid fa-circle-check me-2"></i><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger border-0 rounded-3 mb-4 shadow-sm"><i class="fa-solid fa-circle-xmark me-2"></i><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>

    <!-- Stats Cards Grid -->
    <div class="row g-3 g-xl-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-20 text-primary p-3 rounded-4 fs-3">
                        <i class="fa-solid fa-id-card-clip"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-semibold">Total Drivers</div>
                        <h3 class="fw-bold mb-0 text-dark"><?= number_format($total_drivers) ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-20 text-success p-3 rounded-4 fs-3">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-semibold">Active Drivers</div>
                        <h3 class="fw-bold mb-0 text-dark">
                            <?php 
                                $active = 0;
                                if(!empty($drivers)) {
                                    foreach($drivers as $d) { if($d['status'] === 'active') $active++; }
                                }
                                echo number_format($active);
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-info bg-opacity-20 text-info p-3 rounded-4 fs-3">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-semibold">Verified Drivers</div>
                        <h3 class="fw-bold mb-0 text-dark">
                            <?php 
                                $verified = 0;
                                if(!empty($drivers)) {
                                    foreach($drivers as $d) { if(!empty($d['is_verified'])) $verified++; }
                                }
                                echo number_format($verified);
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-warning bg-opacity-20 text-warning p-3 rounded-4 fs-3">
                        <i class="fa-solid fa-phone-volume"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-semibold">Phone Verified</div>
                        <h3 class="fw-bold mb-0 text-dark">
                            <?php 
                                $phone_v = 0;
                                if(!empty($drivers)) {
                                    foreach($drivers as $d) { if(!empty($d['is_phone_verified'])) $phone_v++; }
                                }
                                echo number_format($phone_v);
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Driver Data Table Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-secondary fw-semibold border-0">Driver ID</th>
                            <th class="text-secondary fw-semibold border-0">Driver Info</th>
                            <th class="text-secondary fw-semibold border-0">Phone Number</th>
                            <th class="text-secondary fw-semibold border-0">Documents</th>
                            <th class="text-secondary fw-semibold border-0">Phone Verified</th>
                            <th class="text-secondary fw-semibold border-0">Verified</th>
                            <th class="text-secondary fw-semibold border-0">Status</th>
                            <th class="text-secondary fw-semibold border-0">Joined Date</th>
                            <th class="text-secondary fw-semibold border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($drivers)): foreach($drivers as $d): ?>
                        <tr>
                            <td class="fw-bold text-dark">#DRV<?= sprintf("%04d", $d['id']) ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width:38px;height:38px;font-size:0.9rem;">
                                        <i class="fa-solid fa-user-tie"></i>
                                    </div>
                                    <div class="fw-bold text-dark"><?= html_escape($d['name']) ?></div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-semibold text-dark"><i class="fa-solid fa-phone me-1 text-muted"></i><?= html_escape($d['phone']) ?></span>
                            </td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    <?php if(!empty($d['licence_doc'])): ?>
                                        <a href="<?= base_url($d['licence_doc']) ?>" target="_blank" class="badge bg-light text-dark border" title="Driving Licence" data-bs-toggle="tooltip">
                                            <i class="fa-solid fa-id-card text-primary me-1"></i>Licence
                                        </a>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted border"><i class="fa-solid fa-id-card me-1"></i>Licence</span>
                                    <?php endif; ?>

                                    <?php if(!empty($d['aadhar_doc'])): ?>
                                        <a href="<?= base_url($d['aadhar_doc']) ?>" target="_blank" class="badge bg-light text-dark border" title="Aadhaar Card" data-bs-toggle="tooltip">
                                            <i class="fa-solid fa-fingerprint text-success me-1"></i>Aadhaar
                                        </a>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted border"><i class="fa-solid fa-fingerprint me-1"></i>Aadhaar</span>
                                    <?php endif; ?>

                                    <?php if(!empty($d['pan_card_doc'])): ?>
                                        <a href="<?= base_url($d['pan_card_doc']) ?>" target="_blank" class="badge bg-light text-dark border" title="PAN Card" data-bs-toggle="tooltip">
                                            <i class="fa-solid fa-credit-card text-warning me-1"></i>PAN
                                        </a>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted border"><i class="fa-solid fa-credit-card me-1"></i>PAN</span>
                                    <?php endif; ?>

                                    <?php if(!empty($d['bank_account_doc'])): ?>
                                        <a href="<?= base_url($d['bank_account_doc']) ?>" target="_blank" class="badge bg-light text-dark border" title="Bank Document" data-bs-toggle="tooltip">
                                            <i class="fa-solid fa-building-columns text-info me-1"></i>Bank
                                        </a>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted border"><i class="fa-solid fa-building-columns me-1"></i>Bank</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <!-- Phone Verified Toggle -->
                                <form action="<?= base_url('admin/toggle_driver_verification') ?>" method="POST" class="d-inline">
                                    <input type="hidden" name="driver_id" value="<?= $d['id'] ?>">
                                    <input type="hidden" name="field" value="is_phone_verified">
                                    <input type="hidden" name="value" value="<?= $d['is_phone_verified'] ? 0 : 1 ?>">
                                    <button type="submit" class="btn btn-sm p-0 border-0 bg-transparent" title="Click to toggle phone verification">
                                        <?php if(!empty($d['is_phone_verified'])): ?>
                                            <span class="badge bg-success"><i class="fa-solid fa-circle-check me-1"></i>VERIFIED</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><i class="fa-solid fa-circle-xmark me-1"></i>UNVERIFIED</span>
                                        <?php endif; ?>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <!-- Verified ON/OFF Toggle -->
                                <form action="<?= base_url('admin/toggle_driver_verification') ?>" method="POST" class="d-inline">
                                    <input type="hidden" name="driver_id" value="<?= $d['id'] ?>">
                                    <input type="hidden" name="field" value="is_verified">
                                    <input type="hidden" name="value" value="<?= $d['is_verified'] ? 0 : 1 ?>">
                                    <button type="submit" class="btn btn-sm p-0 border-0 bg-transparent" title="Click to toggle verified status">
                                        <?php if(!empty($d['is_verified'])): ?>
                                            <span class="badge bg-success"><i class="fa-solid fa-toggle-on me-1"></i>ON</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger"><i class="fa-solid fa-toggle-off me-1"></i>OFF</span>
                                        <?php endif; ?>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <?php if($d['status'] === 'active'): ?>
                                    <span class="badge bg-success">ACTIVE</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">INACTIVE</span>
                                <?php endif; ?>
                            </td>
                            <td class="small text-secondary">
                                <?= !empty($d['created_at']) ? date('d M Y, h:i A', strtotime($d['created_at'])) : 'N/A' ?>
                            </td>
                            <td class="text-end">
                                <div class="d-flex gap-1 justify-content-end">
                                    <!-- Edit Button -->
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editDriverModal_<?= $d['id'] ?>" title="Edit Driver">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <!-- Status Toggle -->
                                    <button class="btn btn-sm <?= $d['status']==='active' ? 'btn-outline-warning' : 'btn-outline-success' ?>" data-bs-toggle="modal" data-bs-target="#statusDriverModal_<?= $d['id'] ?>" title="Toggle Status">
                                        <i class="fa-solid <?= $d['status']==='active' ? 'fa-user-slash' : 'fa-user-check' ?>"></i>
                                    </button>
                                    <!-- Delete Button -->
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteDriverModal_<?= $d['id'] ?>" title="Delete Driver">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Driver Modal -->
                        <div class="modal fade" id="editDriverModal_<?= $d['id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-light border-0">
                                        <h5 class="modal-title fw-bold text-dark"><i class="fa-solid fa-pen-to-square me-2 text-primary"></i>Edit Driver — <?= html_escape($d['name']) ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="<?= base_url('admin/save_driver') ?>" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body p-4">
                                            <input type="hidden" name="id" value="<?= $d['id'] ?>">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Driver Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="name" value="<?= html_escape($d['name']) ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Phone Number <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="phone" value="<?= html_escape($d['phone']) ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">
                                                        <i class="fa-solid fa-id-card text-primary me-1"></i>Driving Licence
                                                        <?php if(!empty($d['licence_doc'])): ?>
                                                            <a href="<?= base_url($d['licence_doc']) ?>" target="_blank" class="ms-1 text-success small"><i class="fa-solid fa-eye"></i> View Current</a>
                                                        <?php endif; ?>
                                                    </label>
                                                    <input type="file" class="form-control form-control-sm" name="licence_doc" accept=".jpg,.jpeg,.png,.pdf,.webp">
                                                    <div class="form-text">Leave empty to keep existing file</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">
                                                        <i class="fa-solid fa-fingerprint text-success me-1"></i>Aadhaar Card
                                                        <?php if(!empty($d['aadhar_doc'])): ?>
                                                            <a href="<?= base_url($d['aadhar_doc']) ?>" target="_blank" class="ms-1 text-success small"><i class="fa-solid fa-eye"></i> View Current</a>
                                                        <?php endif; ?>
                                                    </label>
                                                    <input type="file" class="form-control form-control-sm" name="aadhar_doc" accept=".jpg,.jpeg,.png,.pdf,.webp">
                                                    <div class="form-text">Leave empty to keep existing file</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">
                                                        <i class="fa-solid fa-credit-card text-warning me-1"></i>PAN Card
                                                        <?php if(!empty($d['pan_card_doc'])): ?>
                                                            <a href="<?= base_url($d['pan_card_doc']) ?>" target="_blank" class="ms-1 text-success small"><i class="fa-solid fa-eye"></i> View Current</a>
                                                        <?php endif; ?>
                                                    </label>
                                                    <input type="file" class="form-control form-control-sm" name="pan_card_doc" accept=".jpg,.jpeg,.png,.pdf,.webp">
                                                    <div class="form-text">Leave empty to keep existing file</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">
                                                        <i class="fa-solid fa-building-columns text-info me-1"></i>Bank Account Document
                                                        <?php if(!empty($d['bank_account_doc'])): ?>
                                                            <a href="<?= base_url($d['bank_account_doc']) ?>" target="_blank" class="ms-1 text-success small"><i class="fa-solid fa-eye"></i> View Current</a>
                                                        <?php endif; ?>
                                                    </label>
                                                    <input type="file" class="form-control form-control-sm" name="bank_account_doc" accept=".jpg,.jpeg,.png,.pdf,.webp">
                                                    <div class="form-text">Leave empty to keep existing file</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light border-0">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary px-4 fw-bold"><i class="fa-solid fa-floppy-disk me-1"></i>Update Driver</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Status Toggle Modal -->
                        <div class="modal fade" id="statusDriverModal_<?= $d['id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-light border-0">
                                        <h5 class="modal-title fw-bold text-dark">Update Driver Status — <?= html_escape($d['name']) ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="<?= base_url('admin/update_driver_status') ?>" method="POST">
                                        <div class="modal-body p-4">
                                            <input type="hidden" name="driver_id" value="<?= $d['id'] ?>">
                                            
                                            <p class="mb-3">Driver: <strong><?= html_escape($d['name']) ?></strong> (<?= html_escape($d['phone']) ?>)</p>
                                            
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Account Status</label>
                                                <select class="form-select" name="status">
                                                    <option value="active" <?= $d['status']==='active'?'selected':'' ?>>Active (Can receive ride assignments)</option>
                                                    <option value="inactive" <?= $d['status']==='inactive'?'selected':'' ?>>Inactive (Disabled from assignments)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light border-0">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary px-4 fw-bold">Save Status</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteDriverModal_<?= $d['id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-danger text-white border-0">
                                        <h5 class="modal-title fw-bold"><i class="fa-solid fa-triangle-exclamation me-2"></i>Delete Driver</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <p class="mb-2">Are you sure you want to permanently delete this driver?</p>
                                        <div class="bg-light rounded-3 p-3">
                                            <strong><?= html_escape($d['name']) ?></strong><br>
                                            <span class="text-muted small"><i class="fa-solid fa-phone me-1"></i><?= html_escape($d['phone']) ?></span>
                                        </div>
                                        <p class="text-danger small mt-3 mb-0"><i class="fa-solid fa-circle-exclamation me-1"></i>This action cannot be undone. All uploaded documents will also be deleted.</p>
                                    </div>
                                    <div class="modal-footer bg-light border-0">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                        <a href="<?= base_url('admin/delete_driver/' . $d['id']) ?>" class="btn btn-danger px-4 fw-bold"><i class="fa-solid fa-trash me-1"></i>Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted py-5">
                                <div class="py-3">
                                    <i class="fa-solid fa-id-card-clip fs-1 text-muted mb-3 d-block opacity-50"></i>
                                    <p class="fw-semibold mb-1">No drivers registered yet</p>
                                    <p class="small text-muted mb-0">Click "Add New Driver" to get started.</p>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add New Driver Modal -->
<div class="modal fade" id="addDriverModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light border-0">
                <h5 class="modal-title fw-bold text-dark"><i class="fa-solid fa-user-plus me-2 text-primary"></i>Add New Driver</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/save_driver') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Driver Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter driver's full name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" placeholder="e.g. 9876543210" required>
                        </div>

                        <div class="col-12"><hr class="my-1"><p class="small fw-semibold text-secondary mb-0"><i class="fa-solid fa-file-arrow-up me-1"></i>Upload Documents (JPG, PNG, PDF — Max 5MB each)</p></div>

                        <div class="col-md-6">
                            <label class="form-label small fw-semibold"><i class="fa-solid fa-id-card text-primary me-1"></i>Driving Licence</label>
                            <input type="file" class="form-control form-control-sm" name="licence_doc" accept=".jpg,.jpeg,.png,.pdf,.webp">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold"><i class="fa-solid fa-fingerprint text-success me-1"></i>Aadhaar Card</label>
                            <input type="file" class="form-control form-control-sm" name="aadhar_doc" accept=".jpg,.jpeg,.png,.pdf,.webp">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold"><i class="fa-solid fa-credit-card text-warning me-1"></i>PAN Card</label>
                            <input type="file" class="form-control form-control-sm" name="pan_card_doc" accept=".jpg,.jpeg,.png,.pdf,.webp">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold"><i class="fa-solid fa-building-columns text-info me-1"></i>Bank Account Document</label>
                            <input type="file" class="form-control form-control-sm" name="bank_account_doc" accept=".jpg,.jpeg,.png,.pdf,.webp">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold"><i class="fa-solid fa-plus me-1"></i>Add Driver</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Initialize Bootstrap Tooltips -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(el) { return new bootstrap.Tooltip(el); });
});
</script>

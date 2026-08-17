<div class="p-4 p-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold fs-4 mb-1 text-dark">Customer Directory & Management</h3>
            <p class="text-secondary mb-0 fs-6">Manage registered passengers, phone OTP verification statuses, and account access.</p>
        </div>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success border-0 rounded-3 mb-4 shadow-sm"><i class="fa-solid fa-circle-check me-2"></i><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>

    <!-- Stats Cards Grid -->
    <div class="row g-3 g-xl-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-20 text-primary p-3 rounded-4 fs-3">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-semibold">Total Passengers</div>
                        <h3 class="fw-bold mb-0 text-dark"><?= number_format($total_customers) ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-20 text-success p-3 rounded-4 fs-3">
                        <i class="fa-solid fa-shield-check"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-semibold">Verified Phone Accounts</div>
                        <h3 class="fw-bold mb-0 text-dark">
                            <?php 
                                $verified = 0;
                                if(!empty($customers)) {
                                    foreach($customers as $c) { if(!empty($c['is_verified'])) $verified++; }
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
                    <div class="bg-info bg-opacity-20 text-info p-3 rounded-4 fs-3">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-semibold">Active Accounts</div>
                        <h3 class="fw-bold mb-0 text-dark">
                            <?php 
                                $active = 0;
                                if(!empty($customers)) {
                                    foreach($customers as $c) { if($c['status'] === 'active') $active++; }
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
                    <div class="bg-danger bg-opacity-20 text-danger p-3 rounded-4 fs-3">
                        <i class="fa-solid fa-user-slash"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-semibold">Blocked Accounts</div>
                        <h3 class="fw-bold mb-0 text-dark">
                            <?php 
                                $blocked = 0;
                                if(!empty($customers)) {
                                    foreach($customers as $c) { if($c['status'] === 'blocked') $blocked++; }
                                }
                                echo number_format($blocked);
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Directory Data Table Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-secondary fw-semibold border-0">Customer ID</th>
                            <th class="text-secondary fw-semibold border-0">Passenger Info</th>
                            <th class="text-secondary fw-semibold border-0">Phone Number</th>
                            <th class="text-secondary fw-semibold border-0">Rides Count</th>
                            <th class="text-secondary fw-semibold border-0">OTP Verified</th>
                            <th class="text-secondary fw-semibold border-0">Account Status</th>
                            <th class="text-secondary fw-semibold border-0">Registered Date</th>
                            <th class="text-secondary fw-semibold border-0 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($customers)): foreach($customers as $c): ?>
                        <tr>
                            <td class="fw-bold text-dark">#CUST<?= sprintf("%04d", $c['id']) ?></td>
                            <td>
                                <div class="fw-bold text-dark"><?= html_escape($c['name']) ?></div>
                                <?php if(!empty($c['email'])): ?>
                                    <div class="small text-muted"><i class="fa-solid fa-envelope me-1"></i><?= html_escape($c['email']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="fw-semibold text-dark"><i class="fa-solid fa-phone me-1 text-muted"></i><?= html_escape($c['phone']) ?></span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border fw-bold px-3 py-1">
                                    <i class="fa-solid fa-taxi me-1 text-warning"></i>
                                    <?= $this->Customer_model->get_customer_bookings_count($c['phone']) ?> Rides
                                </span>
                            </td>
                            <td>
                                <?php if(!empty($c['is_verified'])): ?>
                                    <span class="badge bg-success"><i class="fa-solid fa-circle-check me-1"></i>VERIFIED</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark"><i class="fa-solid fa-clock me-1"></i>UNVERIFIED</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($c['status'] === 'active'): ?>
                                    <span class="badge bg-success">ACTIVE</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">BLOCKED</span>
                                <?php endif; ?>
                            </td>
                            <td class="small text-secondary">
                                <?= !empty($c['created_at']) ? date('d M Y, h:i A', strtotime($c['created_at'])) : 'N/A' ?>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm <?= $c['status']==='active' ? 'btn-outline-danger' : 'btn-outline-success' ?>" data-bs-toggle="modal" data-bs-target="#statusCustomerModal_<?= $c['id'] ?>">
                                    <i class="fa-solid <?= $c['status']==='active' ? 'fa-user-slash' : 'fa-user-check' ?> me-1"></i>
                                    <?= $c['status']==='active' ? 'Block' : 'Unblock' ?>
                                </button>
                            </td>
                        </tr>

                        <!-- Status Modal -->
                        <div class="modal fade" id="statusCustomerModal_<?= $c['id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-light border-0">
                                        <h5 class="modal-title fw-bold text-dark">Update Access Status - <?= html_escape($c['name']) ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="<?= base_url('admin/update_customer_status') ?>" method="POST">
                                        <div class="modal-body p-4">
                                            <input type="hidden" name="customer_id" value="<?= $c['id'] ?>">
                                            
                                            <p class="mb-3">Customer: <strong><?= html_escape($c['name']) ?></strong> (<?= html_escape($c['phone']) ?>)</p>
                                            
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Account Status</label>
                                                <select class="form-select" name="status">
                                                    <option value="active" <?= $c['status']==='active'?'selected':'' ?>>Active (Allowed to book rides)</option>
                                                    <option value="blocked" <?= $c['status']==='blocked'?'selected':'' ?>>Blocked (Prevent booking)</option>
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
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No registered customers found yet.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="p-4 p-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold fs-4 mb-1 text-dark">Promo Coupon Codes</h3>
            <p class="text-secondary mb-0 fs-6">Manage promotional discount codes and special offer vouchers for passengers.</p>
        </div>
        <div>
            <button class="btn btn-primary d-inline-flex align-items-center gap-2 px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addCouponModal">
                <i class="fa-solid fa-plus"></i> Create Coupon
            </button>
        </div>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success border-0 rounded-3 mb-4"><i class="fa-solid fa-circle-check me-2"></i><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-secondary fw-semibold border-0">Coupon Code</th>
                            <th class="text-secondary fw-semibold border-0">Discount Type</th>
                            <th class="text-secondary fw-semibold border-0">Discount Value</th>
                            <th class="text-secondary fw-semibold border-0">Min Booking Fare</th>
                            <th class="text-secondary fw-semibold border-0">Expiry Date</th>
                            <th class="text-secondary fw-semibold border-0">Status</th>
                            <th class="text-secondary fw-semibold border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($coupons)): foreach($coupons as $c): ?>
                        <tr>
                            <td><code class="bg-warning-subtle text-dark fs-6 font-monospace fw-bold px-3 py-1 rounded-pill"><i class="fa-solid fa-ticket me-1 text-warning"></i><?= html_escape($c['code']) ?></code></td>
                            <td>
                                <span class="badge <?= $c['discount_type']=='flat'?'bg-primary':'bg-info text-dark' ?> text-uppercase">
                                    <?= $c['discount_type']=='flat'?'Flat Amount':'Percentage' ?>
                                </span>
                            </td>
                            <td class="fw-bold text-success">
                                <?= $c['discount_type']=='flat'?'₹'.number_format($c['discount_value'], 2) : floatval($c['discount_value']).'%' ?>
                            </td>
                            <td class="text-muted fw-semibold">₹<?= number_format($c['min_order_amount'], 2) ?></td>
                            <td class="small text-secondary">
                                <?= !empty($c['expiry_date']) ? date('d M Y', strtotime($c['expiry_date'])) : '<span class="text-muted">No Expiry</span>' ?>
                            </td>
                            <td>
                                <span class="badge <?= $c['status']=='active'?'bg-success':'bg-secondary' ?>"><?= strtoupper($c['status']) ?></span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary border-0 me-1" data-bs-toggle="modal" data-bs-target="#editCouponModal_<?= $c['id'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                <a href="<?= base_url('admin/delete_coupon/' . $c['id']) ?>" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Are you sure you want to delete coupon <?= html_escape($c['code']) ?>?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Edit Coupon Modal -->
                        <div class="modal fade" id="editCouponModal_<?= $c['id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-light border-0">
                                        <h5 class="modal-title fw-bold text-dark">Edit Coupon - <?= html_escape($c['code']) ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="<?= base_url('admin/save_coupon') ?>" method="POST">
                                        <div class="modal-body p-4">
                                            <input type="hidden" name="id" value="<?= $c['id'] ?>">

                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Coupon Code</label>
                                                <input type="text" class="form-control text-uppercase font-monospace" name="code" value="<?= html_escape($c['code']) ?>" required>
                                            </div>

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Discount Type</label>
                                                    <select class="form-select" name="discount_type">
                                                        <option value="flat" <?= $c['discount_type']=='flat'?'selected':'' ?>>Flat Amount (₹)</option>
                                                        <option value="percent" <?= $c['discount_type']=='percent'?'selected':'' ?>>Percentage (%)</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Discount Value</label>
                                                    <input type="number" step="0.01" class="form-control" name="discount_value" value="<?= $c['discount_value'] ?>" required>
                                                </div>
                                            </div>

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Min Booking Fare (₹)</label>
                                                    <input type="number" step="1" class="form-control" name="min_order_amount" value="<?= $c['min_order_amount'] ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Status</label>
                                                    <select class="form-select" name="status">
                                                        <option value="active" <?= $c['status']=='active'?'selected':'' ?>>Active</option>
                                                        <option value="inactive" <?= $c['status']=='inactive'?'selected':'' ?>>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Expiry Date (Optional)</label>
                                                <input type="date" class="form-control" name="expiry_date" value="<?= $c['expiry_date'] ?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 bg-light">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary px-4 fw-bold">Update Coupon</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No coupon codes found. Click "Create Coupon" to add one!</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Coupon Modal -->
<div class="modal fade" id="addCouponModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light border-0">
                <h5 class="modal-title fw-bold text-dark">Create New Promo Coupon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/save_coupon') ?>" method="POST">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Coupon Code</label>
                        <input type="text" class="form-control text-uppercase font-monospace" name="code" placeholder="e.g. SAVE100" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Discount Type</label>
                            <select class="form-select" name="discount_type">
                                <option value="flat">Flat Amount (₹)</option>
                                <option value="percent">Percentage (%)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Discount Value</label>
                            <input type="number" step="0.01" class="form-control" name="discount_value" placeholder="100" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Min Booking Fare (₹)</label>
                            <input type="number" step="1" class="form-control" name="min_order_amount" value="500" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Status</label>
                            <select class="form-select" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Expiry Date (Optional)</label>
                        <input type="date" class="form-control" name="expiry_date">
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">Create Coupon</button>
                </div>
            </form>
        </div>
    </div>
</div>

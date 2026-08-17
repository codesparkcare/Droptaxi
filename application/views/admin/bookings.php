<div class="p-4 p-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold fs-4 mb-1 text-dark">Manage Taxi Bookings</h3>
            <p class="text-secondary mb-0 fs-6">View, filter, edit status, and update fare breakdowns for all rides.</p>
        </div>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success border-0 rounded-3 mb-4"><i class="fa-solid fa-circle-check me-2"></i><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>

    <!-- Status Filters Bar -->
    <div class="mb-4 d-flex gap-2 flex-wrap">
        <a href="<?= base_url('admin/bookings') ?>" class="btn btn-sm <?= empty($selected_status) ? 'btn-dark' : 'btn-outline-secondary' ?> rounded-pill px-3">All Rides</a>
        <a href="<?= base_url('admin/bookings?status=new') ?>" class="btn btn-sm <?= $selected_status=='new' ? 'btn-primary' : 'btn-outline-primary' ?> rounded-pill px-3">New</a>
        <a href="<?= base_url('admin/bookings?status=confirmed') ?>" class="btn btn-sm <?= $selected_status=='confirmed' ? 'btn-success' : 'btn-outline-success' ?> rounded-pill px-3">Confirmed</a>
        <a href="<?= base_url('admin/bookings?status=assigned') ?>" class="btn btn-sm <?= $selected_status=='assigned' ? 'btn-info text-white' : 'btn-outline-info' ?> rounded-pill px-3">Driver Assigned</a>
        <a href="<?= base_url('admin/bookings?status=completed') ?>" class="btn btn-sm <?= $selected_status=='completed' ? 'btn-dark' : 'btn-outline-dark' ?> rounded-pill px-3">Completed</a>
        <a href="<?= base_url('admin/bookings?status=cancelled') ?>" class="btn btn-sm <?= $selected_status=='cancelled' ? 'btn-danger' : 'btn-outline-danger' ?> rounded-pill px-3">Cancelled</a>
    </div>

    <!-- Data Table Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-secondary fw-semibold border-0">Booking ID</th>
                            <th class="text-secondary fw-semibold border-0">Passenger</th>
                            <th class="text-secondary fw-semibold border-0">Route & Trip</th>
                            <th class="text-secondary fw-semibold border-0">Pickup Date</th>
                            <th class="text-secondary fw-semibold border-0">Vehicle</th>
                            <th class="text-secondary fw-semibold border-0">Fare Details</th>
                            <th class="text-secondary fw-semibold border-0">Payment</th>
                            <th class="text-secondary fw-semibold border-0">Status</th>
                            <th class="text-secondary fw-semibold border-0 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($bookings)): foreach($bookings as $b): ?>
                        <tr>
                            <td class="fw-bold text-dark"><?= html_escape($b['booking_id']) ?></td>
                            <td>
                                <div class="fw-bold text-dark"><?= html_escape($b['passenger_name']) ?></div>
                                <div class="small text-muted"><i class="fa-solid fa-phone me-1"></i><?= html_escape($b['passenger_phone']) ?></div>
                                <?php if($b['passenger_email']): ?>
                                    <div class="extra-small text-muted"><i class="fa-solid fa-envelope me-1"></i><?= html_escape($b['passenger_email']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark small"><?= html_escape($b['pickup_location']) ?> &rarr; <?= html_escape($b['drop_location']) ?></div>
                                <div class="extra-small text-muted"><?= html_escape($b['trip_type']) ?> (<?= $b['distance_km'] ?> km)</div>
                            </td>
                            <td class="small">
                                <div class="fw-semibold"><?= html_escape($b['pickup_date']) ?></div>
                                <div class="text-muted"><?= html_escape($b['pickup_time']) ?></div>
                            </td>
                            <td class="small fw-semibold"><?= html_escape($b['vehicle_name']) ?></td>
                            <td>
                                <div class="fw-bold text-dark">₹<?= number_format($b['estimated_fare'], 2) ?></div>
                                <div class="extra-small text-muted">Batta: ₹<?= number_format($b['driver_batta'], 0) ?> | Toll: ₹<?= number_format($b['toll_fee'], 0) ?></div>
                            </td>
                            <td>
                                <span class="badge <?= $b['payment_status'] === 'paid' ? 'bg-success' : 'bg-warning text-dark' ?>">
                                    <?= strtoupper($b['payment_status']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-dark"><?= strtoupper($b['booking_status']) ?></span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary border-0 me-1" title="Update Status" data-bs-toggle="modal" data-bs-target="#statusModal_<?= $b['booking_id'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success border-0" title="Edit Fare Breakdown" data-bs-toggle="modal" data-bs-target="#fareModal_<?= $b['booking_id'] ?>">
                                    <i class="fa-solid fa-receipt"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Status Modal -->
                        <div class="modal fade" id="statusModal_<?= $b['booking_id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-light border-0">
                                        <h5 class="modal-title fw-bold text-dark">Update Ride Status - <?= $b['booking_id'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="<?= base_url('admin/update_booking_status') ?>" method="POST">
                                        <div class="modal-body p-4">
                                            <input type="hidden" name="booking_id" value="<?= $b['booking_id'] ?>">
                                            
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Ride Status</label>
                                                <select class="form-select" name="booking_status">
                                                    <option value="new" <?= $b['booking_status']=='new'?'selected':'' ?>>New</option>
                                                    <option value="confirmed" <?= $b['booking_status']=='confirmed'?'selected':'' ?>>Confirmed</option>
                                                    <option value="assigned" <?= $b['booking_status']=='assigned'?'selected':'' ?>>Driver Assigned</option>
                                                    <option value="completed" <?= $b['booking_status']=='completed'?'selected':'' ?>>Completed</option>
                                                    <option value="cancelled" <?= $b['booking_status']=='cancelled'?'selected':'' ?>>Cancelled</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Payment Status</label>
                                                <select class="form-select" name="payment_status">
                                                    <option value="pending" <?= $b['payment_status']=='pending'?'selected':'' ?>>Pending</option>
                                                    <option value="paid" <?= $b['payment_status']=='paid'?'selected':'' ?>>Paid</option>
                                                    <option value="failed" <?= $b['payment_status']=='failed'?'selected':'' ?>>Failed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light border-0">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Fare Breakdown Modal -->
                        <div class="modal fade" id="fareModal_<?= $b['booking_id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-light border-0">
                                        <h5 class="modal-title fw-bold text-dark">Edit Fare Breakdown - <?= $b['booking_id'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="<?= base_url('admin/update_fare_details') ?>" method="POST">
                                        <div class="modal-body p-4">
                                            <input type="hidden" name="booking_id" value="<?= $b['booking_id'] ?>">
                                            
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Driver Batta (₹)</label>
                                                <input type="number" step="0.01" class="form-control" name="driver_batta" value="<?= $b['driver_batta'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">State Permit Fee (₹)</label>
                                                <input type="number" step="0.01" class="form-control" name="permit_fee" value="<?= $b['permit_fee'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Toll / Parking Charges (₹)</label>
                                                <input type="number" step="0.01" class="form-control" name="toll_fee" value="<?= $b['toll_fee'] ?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light border-0">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success px-4">Recalculate & Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; else: ?>
                        <tr><td colspan="9" class="text-center text-muted py-4">No bookings found for selected filter.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

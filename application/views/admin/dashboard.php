<div class="p-4 p-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold fs-4 mb-1 text-dark">Super Admin Dashboard</h3>
            <p class="text-secondary mb-0 fs-6">Overview of DropTaxi rides, Driver Batta (allowance), revenue, and active enquiries.</p>
        </div>
        <div>
            <a href="<?= base_url('admin/bookings') ?>" class="btn btn-primary d-inline-flex align-items-center gap-2 px-4 shadow-sm">
                <i class="fa-solid fa-car"></i> View All Bookings
            </a>
        </div>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success border-0 rounded-3 mb-4 shadow-sm"><i class="fa-solid fa-circle-check me-2"></i><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>

    <!-- Stats Cards Grid -->
    <div class="row g-3 g-xl-4 mb-5">
        <div class="col-sm-6 col-xl">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-warning bg-opacity-20 text-warning p-3 rounded-4 fs-3">
                        <i class="fa-solid fa-taxi"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-semibold">Total Bookings</div>
                        <h3 class="fw-bold mb-0 text-dark"><?= number_format($total_bookings) ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-20 text-success p-3 rounded-4 fs-3">
                        <i class="fa-solid fa-indian-rupee-sign"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-semibold">Total Revenue</div>
                        <h3 class="fw-bold mb-0 text-dark">₹<?= number_format($total_revenue, 2) ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Driver Batta (Betta) Stat Card -->
        <div class="col-sm-6 col-xl">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100 border-start border-4 border-info">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-info bg-opacity-20 text-info p-3 rounded-4 fs-3">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-semibold">Total Driver Batta</div>
                        <h3 class="fw-bold mb-0 text-dark">₹<?= number_format($total_driver_batta, 2) ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-20 text-primary p-3 rounded-4 fs-3">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-semibold">New Rides</div>
                        <h3 class="fw-bold mb-0 text-dark"><?= number_format($new_bookings) ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-danger bg-opacity-20 text-danger p-3 rounded-4 fs-3">
                        <i class="fa-solid fa-envelope-open-text"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-semibold">Unread Enquiries</div>
                        <h3 class="fw-bold mb-0 text-dark"><?= number_format($unread_enquiries) ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Driver Batta & Minimum KM Tariff Quick Reference Card -->
    <?php if(!empty($vehicles)): ?>
    <div class="card border-0 shadow-sm rounded-4 mb-5 bg-white">
        <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-sliders text-info me-2"></i>Driver Batta & Minimum KM Tariffs</h5>
                <p class="text-muted small mb-0">Dynamic rates, Driver Batta (Betta), and Minimum KM coverage configured per vehicle</p>
            </div>
            <a href="<?= base_url('admin/vehicles') ?>" class="btn btn-sm btn-outline-info rounded-pill px-3">
                <i class="fa-solid fa-pen-to-square me-1"></i> Edit Tariffs & Min KM
            </a>
        </div>
        <div class="card-body p-4 pt-0">
            <div class="row g-3">
                <?php foreach($vehicles as $v): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="p-3 bg-light rounded-4 border">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="fw-bold text-dark"><?= html_escape($v['name']) ?></span>
                            <span class="badge bg-secondary extra-small"><?= strtoupper(html_escape($v['type_key'])) ?></span>
                        </div>
                        <div class="d-flex justify-content-between extra-small text-secondary border-bottom pb-1 mb-1">
                            <span>One Way Rate:</span>
                            <strong class="text-primary">₹<?= number_format($v['per_km_oneway'], 0) ?>/km (Min <?= $v['min_km_oneway'] ?> KM)</strong>
                        </div>
                        <div class="d-flex justify-content-between extra-small text-secondary border-bottom pb-1 mb-1">
                            <span>Round Trip Rate:</span>
                            <strong class="text-success">₹<?= number_format($v['per_km_roundtrip'], 0) ?>/km (Min <?= $v['min_km_roundtrip'] ?> KM)</strong>
                        </div>
                        <div class="d-flex justify-content-between extra-small text-secondary border-bottom pb-1 mb-1">
                            <span>One Way Batta:</span>
                            <strong class="text-dark">₹<?= number_format($v['driver_batta_oneway'], 0) ?></strong>
                        </div>
                        <div class="d-flex justify-content-between extra-small text-secondary">
                            <span>Round Trip Batta:</span>
                            <strong class="text-dark">₹<?= number_format($v['driver_batta_roundtrip'], 0) ?></strong>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Recent Bookings Table Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-clock-history text-warning me-2"></i>Recent Bookings</h5>
            <a href="<?= base_url('admin/bookings') ?>" class="small fw-bold text-primary text-decoration-none">View All &rarr;</a>
        </div>
        <div class="card-body p-4 pt-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-secondary fw-semibold border-0">Booking ID</th>
                            <th class="text-secondary fw-semibold border-0">Passenger</th>
                            <th class="text-secondary fw-semibold border-0">Route</th>
                            <th class="text-secondary fw-semibold border-0">Pickup Date</th>
                            <th class="text-secondary fw-semibold border-0">Vehicle</th>
                            <th class="text-secondary fw-semibold border-0">Driver Batta</th>
                            <th class="text-secondary fw-semibold border-0">Est. Fare</th>
                            <th class="text-secondary fw-semibold border-0">Payment</th>
                            <th class="text-secondary fw-semibold border-0">Status</th>
                            <th class="text-secondary fw-semibold border-0 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($recent_bookings)): foreach($recent_bookings as $b): ?>
                        <tr>
                            <td class="fw-bold text-dark"><?= html_escape($b['booking_id']) ?></td>
                            <td>
                                <div class="fw-semibold text-dark"><?= html_escape($b['passenger_name']) ?></div>
                                <div class="extra-small text-muted"><?= html_escape($b['passenger_phone']) ?></div>
                            </td>
                            <td>
                                <div class="small fw-semibold"><?= html_escape($b['pickup_location']) ?> &rarr; <?= html_escape($b['drop_location']) ?></div>
                                <div class="extra-small text-muted"><?= html_escape($b['trip_type']) ?> (<?= $b['distance_km'] ?> km)</div>
                            </td>
                            <td class="small"><?= html_escape($b['pickup_date']) ?> <?= html_escape($b['pickup_time']) ?></td>
                            <td class="small fw-semibold"><?= html_escape($b['vehicle_name']) ?></td>
                            <td>
                                <span class="badge bg-info text-dark fw-bold px-2 py-1">
                                    ₹<?= number_format($b['driver_batta'], 2) ?>
                                </span>
                            </td>
                            <td class="fw-bold text-dark">₹<?= number_format($b['estimated_fare'], 2) ?></td>
                            <td>
                                <span class="badge <?= $b['payment_status'] === 'paid' ? 'bg-success' : 'bg-warning text-dark' ?>">
                                    <?= strtoupper($b['payment_status']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary"><?= strtoupper($b['booking_status']) ?></span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary border-0 me-1" title="Update Status" data-bs-toggle="modal" data-bs-target="#dashStatusModal_<?= $b['booking_id'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info border-0" title="Edit Driver Batta & Fare" data-bs-toggle="modal" data-bs-target="#dashFareModal_<?= $b['booking_id'] ?>">
                                    <i class="fa-solid fa-id-card"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Status Modal -->
                        <div class="modal fade" id="dashStatusModal_<?= $b['booking_id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-light border-0">
                                        <h5 class="modal-title fw-bold text-dark">Update Ride Status - <?= $b['booking_id'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="<?= base_url('admin/update_booking_status') ?>" method="POST">
                                        <div class="modal-body p-4">
                                            <input type="hidden" name="booking_id" value="<?= $b['booking_id'] ?>">
                                            <input type="hidden" name="redirect_to" value="admin/index">
                                            
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

                        <!-- Driver Batta & Fare Modal -->
                        <div class="modal fade" id="dashFareModal_<?= $b['booking_id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-light border-0">
                                        <h5 class="modal-title fw-bold text-dark"><i class="fa-solid fa-id-card text-info me-2"></i>Edit Driver Batta & Fare - <?= $b['booking_id'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="<?= base_url('admin/update_fare_details') ?>" method="POST">
                                        <div class="modal-body p-4">
                                            <input type="hidden" name="booking_id" value="<?= $b['booking_id'] ?>">
                                            <input type="hidden" name="redirect_to" value="admin/index">
                                            
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold text-dark">Driver Batta (Betta / Allowance) (₹)</label>
                                                <input type="number" step="0.01" class="form-control fw-bold border-info" name="driver_batta" value="<?= $b['driver_batta'] ?>" required>
                                                <div class="form-text extra-small">Adjust the driver allowance for this booking.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold text-dark">State Permit Fee (₹)</label>
                                                <input type="number" step="0.01" class="form-control" name="permit_fee" value="<?= $b['permit_fee'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold text-dark">Toll / Parking Charges (₹)</label>
                                                <input type="number" step="0.01" class="form-control" name="toll_fee" value="<?= $b['toll_fee'] ?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light border-0">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-info text-white px-4">Update Fare & Batta</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; else: ?>
                        <tr><td colspan="10" class="text-center text-muted py-4">No recent bookings found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


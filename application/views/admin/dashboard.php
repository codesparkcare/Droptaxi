<div class="p-4 p-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold fs-4 mb-1 text-dark">Super Admin Dashboard</h3>
            <p class="text-secondary mb-0 fs-6">Overview of DropTaxi rides, revenue, and active enquiries.</p>
        </div>
        <div>
            <a href="<?= base_url('admin/bookings') ?>" class="btn btn-primary d-inline-flex align-items-center gap-2 px-4 shadow-sm">
                <i class="fa-solid fa-car"></i> View All Bookings
            </a>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="row g-4 mb-5">
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
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

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
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

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
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

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
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
                            <th class="text-secondary fw-semibold border-0">Est. Fare</th>
                            <th class="text-secondary fw-semibold border-0">Payment</th>
                            <th class="text-secondary fw-semibold border-0">Status</th>
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
                                <div class="extra-small text-muted"><?= html_escape($b['trip_type']) ?></div>
                            </td>
                            <td class="small"><?= html_escape($b['pickup_date']) ?> <?= html_escape($b['pickup_time']) ?></td>
                            <td class="small fw-semibold"><?= html_escape($b['vehicle_name']) ?></td>
                            <td class="fw-bold text-dark">₹<?= number_format($b['estimated_fare'], 2) ?></td>
                            <td>
                                <span class="badge <?= $b['payment_status'] === 'paid' ? 'bg-success' : 'bg-warning text-dark' ?>">
                                    <?= strtoupper($b['payment_status']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary"><?= strtoupper($b['booking_status']) ?></span>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="8" class="text-center text-muted py-4">No recent bookings found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

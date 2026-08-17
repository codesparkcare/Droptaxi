<div class="p-4 p-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold fs-4 mb-1 text-dark">Vehicle Fleet & Tariff Management</h3>
            <p class="text-secondary mb-0 fs-6">Configure per-kilometer rates, driver batta, and minimum distance rules.</p>
        </div>
        <div>
            <button class="btn btn-primary d-inline-flex align-items-center gap-2 px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addVehicleModal">
                <i class="fa-solid fa-plus"></i> Add Vehicle
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
                            <th class="text-secondary fw-semibold border-0">Vehicle Name</th>
                            <th class="text-secondary fw-semibold border-0">Type Key</th>
                            <th class="text-secondary fw-semibold border-0">Capacity</th>
                            <th class="text-secondary fw-semibold border-0">One Way Rate</th>
                            <th class="text-secondary fw-semibold border-0">Round Trip Rate</th>
                            <th class="text-secondary fw-semibold border-0">Driver Batta</th>
                            <th class="text-secondary fw-semibold border-0">Min KM</th>
                            <th class="text-secondary fw-semibold border-0">Status</th>
                            <th class="text-secondary fw-semibold border-0 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($vehicles)): foreach($vehicles as $v): ?>
                        <tr>
                            <td class="fw-bold text-dark"><?= html_escape($v['name']) ?></td>
                            <td><code class="bg-light px-2 py-1 rounded"><?= html_escape($v['type_key']) ?></code></td>
                            <td><i class="fa-solid fa-users me-1 text-muted"></i><?= $v['capacity'] ?> Seater</td>
                            <td class="fw-bold text-primary">₹<?= number_format($v['per_km_oneway'], 2) ?> / KM</td>
                            <td class="fw-bold text-success">₹<?= number_format($v['per_km_roundtrip'], 2) ?> / KM</td>
                            <td class="small text-dark">₹<?= $v['driver_batta_oneway'] ?> (1-way) / ₹<?= $v['driver_batta_roundtrip'] ?> (Round)</td>
                            <td class="small text-secondary"><?= $v['min_km_oneway'] ?> KM (1-way) / <?= $v['min_km_roundtrip'] ?> KM (Round)</td>
                            <td><span class="badge <?= $v['status']=='active'?'bg-success':'bg-secondary' ?>"><?= strtoupper($v['status']) ?></span></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="modal" data-bs-target="#editVehicleModal_<?= $v['id'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit Tariff
                                </button>
                            </td>
                        </tr>

                        <!-- Edit Vehicle Tariff Modal -->
                        <div class="modal fade" id="editVehicleModal_<?= $v['id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-light border-0">
                                        <h5 class="modal-title fw-bold text-dark">Edit Tariff - <?= html_escape($v['name']) ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="<?= base_url('admin/save_vehicle') ?>" method="POST">
                                        <div class="modal-body p-4">
                                            <input type="hidden" name="id" value="<?= $v['id'] ?>">

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Vehicle Name</label>
                                                    <input type="text" class="form-control" name="name" value="<?= html_escape($v['name']) ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Type Key</label>
                                                    <input type="text" class="form-control" name="type_key" value="<?= html_escape($v['type_key']) ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Per KM Rate (One Way Drop)</label>
                                                    <input type="number" step="0.5" class="form-control" name="per_km_oneway" value="<?= $v['per_km_oneway'] ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Per KM Rate (Round Trip)</label>
                                                    <input type="number" step="0.5" class="form-control" name="per_km_roundtrip" value="<?= $v['per_km_roundtrip'] ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Driver Batta (One Way)</label>
                                                    <input type="number" class="form-control" name="driver_batta_oneway" value="<?= $v['driver_batta_oneway'] ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Driver Batta (Round Trip)</label>
                                                    <input type="number" class="form-control" name="driver_batta_roundtrip" value="<?= $v['driver_batta_roundtrip'] ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Minimum KM (One Way)</label>
                                                    <input type="number" class="form-control" name="min_km_oneway" value="<?= $v['min_km_oneway'] ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Minimum KM (Round Trip)</label>
                                                    <input type="number" class="form-control" name="min_km_roundtrip" value="<?= $v['min_km_roundtrip'] ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Seating Capacity</label>
                                                    <input type="number" class="form-control" name="capacity" value="<?= $v['capacity'] ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Status</label>
                                                    <select class="form-select" name="status">
                                                        <option value="active" <?= $v['status']=='active'?'selected':'' ?>>Active</option>
                                                        <option value="inactive" <?= $v['status']=='inactive'?'selected':'' ?>>Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label small fw-semibold">Description</label>
                                                    <textarea class="form-control" name="description" rows="2"><?= html_escape($v['description']) ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light border-0">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary px-4">Update Tariff</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; else: ?>
                        <tr><td colspan="9" class="text-center text-muted py-4">No vehicles found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Vehicle Modal -->
<div class="modal fade" id="addVehicleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light border-0">
                <h5 class="modal-title fw-bold text-dark">Add New Vehicle Tariff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('admin/save_vehicle') ?>" method="POST">
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Vehicle Name</label>
                            <input type="text" class="form-control" name="name" placeholder="e.g. Luxury SUV" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Type Key</label>
                            <input type="text" class="form-control" name="type_key" placeholder="e.g. luxury_suv" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Per KM Rate (One Way)</label>
                            <input type="number" step="0.5" class="form-control" name="per_km_oneway" placeholder="15" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Per KM Rate (Round Trip)</label>
                            <input type="number" step="0.5" class="form-control" name="per_km_roundtrip" placeholder="13" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Driver Batta (One Way)</label>
                            <input type="number" class="form-control" name="driver_batta_oneway" value="300" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Driver Batta (Round Trip)</label>
                            <input type="number" class="form-control" name="driver_batta_roundtrip" value="400" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Minimum KM (One Way)</label>
                            <input type="number" class="form-control" name="min_km_oneway" value="130" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Minimum KM (Round Trip)</label>
                            <input type="number" class="form-control" name="min_km_roundtrip" value="250" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Seating Capacity</label>
                            <input type="number" class="form-control" name="capacity" value="4" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Status</label>
                            <select class="form-select" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-semibold">Description</label>
                            <textarea class="form-control" name="description" rows="2" placeholder="Brief vehicle description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Save Vehicle</button>
                </div>
            </form>
        </div>
    </div>
</div>

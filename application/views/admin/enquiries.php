<div class="p-4 p-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold fs-4 mb-1 text-dark">Customer Enquiries</h3>
            <p class="text-secondary mb-0 fs-6">Messages and queries submitted through the public website contact form.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-secondary fw-semibold border-0">Date</th>
                            <th class="text-secondary fw-semibold border-0">Customer Name</th>
                            <th class="text-secondary fw-semibold border-0">Phone & Email</th>
                            <th class="text-secondary fw-semibold border-0">Subject</th>
                            <th class="text-secondary fw-semibold border-0">Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($enquiries)): foreach($enquiries as $e): ?>
                        <tr>
                            <td class="small text-secondary"><?= date('M d, Y g:i A', strtotime($e['created_at'])) ?></td>
                            <td class="fw-bold text-dark"><?= html_escape($e['name']) ?></td>
                            <td class="small">
                                <div class="fw-semibold text-dark"><i class="fa-solid fa-phone me-1 text-muted"></i><?= html_escape($e['phone']) ?></div>
                                <?php if($e['email']): ?><div class="text-muted"><i class="fa-solid fa-envelope me-1 text-muted"></i><?= html_escape($e['email']) ?></div><?php endif; ?>
                            </td>
                            <td class="small fw-semibold"><?= html_escape($e['subject']) ?></td>
                            <td class="small text-secondary"><?= nl2br(html_escape($e['message'])) ?></td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center text-muted py-4">No customer enquiries found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

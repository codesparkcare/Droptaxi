<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - <?= html_escape($booking['booking_id']) ?> | DropTaxi</title>
    
    <!-- Google Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Razorpay JS Checkout Library -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }

        h1, h2, h3, h4, h5 { font-family: 'Outfit', sans-serif; }

        .confirmation-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .header-banner {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: #ffffff;
            padding: 40px;
            text-align: center;
        }

        .badge-status {
            font-size: 0.85rem;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 50px;
        }

        .badge-pending { background-color: #fef3c7; color: #d97706; }
        .badge-paid { background-color: #dcfce7; color: #15803d; }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-4">
                    <a href="<?= base_url() ?>" class="text-decoration-none">
                        <h2 class="fw-extrabold text-dark"><i class="fa-solid fa-taxi text-warning me-2"></i>Drop<span class="text-warning">Taxi</span></h2>
                    </a>
                </div>

                <div class="confirmation-card">
                    <div class="header-banner">
                        <div class="text-warning fs-1 mb-2"><i class="fa-solid fa-circle-check"></i></div>
                        <h3 class="fw-bold mb-1">Booking Confirmed!</h3>
                        <p class="text-light opacity-75 mb-0">Booking Reference: <strong><?= html_escape($booking['booking_id']) ?></strong></p>
                    </div>

                    <div class="p-4 p-md-5">
                        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                            <div>
                                <span class="text-muted small">Status:</span>
                                <span class="badge-status badge-pending ms-2" id="disp-booking-status"><?= strtoupper($booking['booking_status']) ?></span>
                            </div>
                            <div>
                                <span class="text-muted small">Payment Status:</span>
                                <span class="badge-status <?= $booking['payment_status'] === 'paid' ? 'badge-paid' : 'badge-pending' ?> ms-2" id="disp-payment-status">
                                    <?= strtoupper($booking['payment_status']) ?>
                                </span>
                            </div>
                        </div>

                        <!-- Trip Summary Table -->
                        <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-route text-warning me-2"></i>Trip Details</h5>
                        <table class="table table-bordered align-middle mb-4">
                            <tbody>
                                <tr>
                                    <th class="bg-light w-35 text-secondary">Trip Type</th>
                                    <td class="fw-semibold text-dark"><?= html_escape($booking['trip_type']) ?></td>
                                </tr>
                                <tr>
                                    <th class="bg-light text-secondary">Pickup Location</th>
                                    <td class="fw-semibold text-dark"><?= html_escape($booking['pickup_location']) ?></td>
                                </tr>
                                <tr>
                                    <th class="bg-light text-secondary">Drop Location</th>
                                    <td class="fw-semibold text-dark"><?= html_escape($booking['drop_location']) ?></td>
                                </tr>
                                <tr>
                                    <th class="bg-light text-secondary">Pickup Date & Time</th>
                                    <td class="fw-semibold text-dark"><?= html_escape($booking['pickup_date']) ?> at <?= html_escape($booking['pickup_time']) ?></td>
                                </tr>
                                <tr>
                                    <th class="bg-light text-secondary">Vehicle Selected</th>
                                    <td class="fw-semibold text-dark"><?= html_escape($booking['vehicle_name']) ?></td>
                                </tr>
                                <tr>
                                    <th class="bg-light text-secondary">Passenger Name</th>
                                    <td class="fw-semibold text-dark"><?= html_escape($booking['passenger_name']) ?> (<?= html_escape($booking['passenger_phone']) ?>)</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Fare Breakdown Table -->
                        <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-receipt text-warning me-2"></i>Fare Breakdown</h5>
                        <div class="bg-light p-4 rounded-4 mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary">Estimated Distance:</span>
                                <span class="fw-semibold text-dark"><?= $booking['distance_km'] ?> KM</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary">Per KM Rate:</span>
                                <span class="fw-semibold text-dark">₹<?= number_format($booking['per_km_rate'], 2) ?> / KM</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary">Driver Batta:</span>
                                <span class="fw-semibold text-dark">₹<?= number_format($booking['driver_batta'], 2) ?></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center fs-5">
                                <span class="fw-bold text-dark">Total Estimated Fare:</span>
                                <span class="fw-extrabold text-success fs-3">₹<?= number_format($booking['estimated_fare'], 2) ?></span>
                            </div>
                        </div>

                        <!-- Action Buttons / Razorpay Online Payment -->
                        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between">
                            <a href="<?= base_url() ?>" class="btn btn-outline-secondary px-4 py-3 rounded-pill fw-bold">
                                <i class="fa-solid fa-arrow-left me-2"></i>Back To Home
                            </a>

                            <?php if($booking['payment_status'] !== 'paid'): ?>
                                <button type="button" class="btn btn-warning px-5 py-3 rounded-pill fw-bold text-dark shadow-sm" onclick="payWithRazorpay()">
                                    <i class="fa-solid fa-credit-card me-2"></i>Pay Online (Razorpay)
                                </button>
                            <?php else: ?>
                                <button type="button" class="btn btn-success px-5 py-3 rounded-pill fw-bold disabled">
                                    <i class="fa-solid fa-circle-check me-2"></i>Payment Verified (Paid)
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function payWithRazorpay() {
            var formData = new FormData();
            formData.append('booking_id', '<?= $booking['booking_id'] ?>');

            fetch('<?= base_url("welcome/create_razorpay_order") ?>', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    var options = {
                        "key": data.key_id,
                        "amount": data.amount,
                        "currency": "INR",
                        "name": "DropTaxi Services",
                        "description": "Taxi Ride Payment - <?= $booking['booking_id'] ?>",
                        "order_id": data.order_id,
                        "handler": function (response){
                            verifyRazorpayPayment(response.razorpay_order_id, response.razorpay_payment_id, response.razorpay_signature);
                        },
                        "prefill": {
                            "name": data.passenger_name,
                            "email": data.passenger_email,
                            "contact": data.passenger_phone
                        },
                        "theme": { "color": "#f59e0b" }
                    };
                    var rzp = new Razorpay(options);
                    rzp.open();
                } else {
                    alert(data.message || 'Error initializing Razorpay payment.');
                }
            });
        }

        function verifyRazorpayPayment(order_id, payment_id, signature) {
            var formData = new FormData();
            formData.append('booking_id', '<?= $booking['booking_id'] ?>');
            formData.append('razorpay_order_id', order_id);
            formData.append('razorpay_payment_id', payment_id);
            formData.append('razorpay_signature', signature);

            fetch('<?= base_url("welcome/verify_payment") ?>', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    alert('Payment successful! Your booking is confirmed.');
                    window.location.reload();
                } else {
                    alert('Payment verification failed.');
                }
            });
        }
    </script>
</body>
</html>

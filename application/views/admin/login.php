<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Login | DropTaxi</title>
    <!-- Google Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
        }

        h1, h2, h3, h4, .brand-font { font-family: 'Outfit', sans-serif; }

        .login-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .logo-icon-box {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #f59e0b, #eab308);
            color: #000;
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
        }

        .form-control {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ffffff;
            border-radius: 12px;
            padding: 12px 16px;
        }

        .form-control:focus {
            background: rgba(15, 23, 42, 0.8);
            border-color: #f59e0b;
            color: #ffffff;
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.2);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b, #eab308);
            color: #000000;
            font-weight: 700;
            border: none;
            padding: 12px;
            border-radius: 12px;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #eab308, #d97706);
            color: #000000;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="text-center mb-4">
            <div class="logo-icon-box mb-3"><i class="fa-solid fa-taxi"></i></div>
            <h3 class="fw-bold mb-1">DropTaxi Admin</h3>
            <p class="text-secondary small mb-0">Super Admin Portal Access</p>
        </div>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger bg-danger bg-opacity-20 border-danger text-danger text-center rounded-3 p-2 small mb-3">
                <i class="fa-solid fa-circle-exclamation me-1"></i><?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/login') ?>" method="POST">
            <div class="mb-3">
                <label class="form-label small text-secondary fw-semibold">Username or Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" name="username" placeholder="admin" required value="admin">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small text-secondary fw-semibold">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" class="form-control" name="password" placeholder="••••••••" required value="admin123">
                </div>
            </div>

            <button type="submit" class="btn btn-warning w-100 py-3 font-weight-bold">
                <i class="fa-solid fa-right-to-bracket me-2"></i>Login to Dashboard
            </button>
        </form>

        <div class="text-center mt-4 extra-small text-secondary">
            Default Login: <strong>admin</strong> / <strong>admin123</strong>
        </div>
    </div>

</body>
</html>

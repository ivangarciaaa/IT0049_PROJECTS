<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<section class="login-section section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <div class="card login-card border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="login-icon mx-auto mb-3">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <h1 class="h2 fw-bold text-primary-custom">Welcome Back</h1>
                            <p class="text-muted mb-0">Open the customer account dashboard</p>
                        </div>

                        <?php if (! empty($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="fas fa-circle-exclamation me-2"></i><?= esc($error) ?>
                            </div>
                        <?php endif; ?>

                        <?php if (! empty($success)): ?>
                            <div class="alert alert-success" role="status">
                                <i class="fas fa-circle-check me-2"></i><?= esc($success) ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="<?= base_url('login') ?>">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="login_email" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control form-control-lg" id="login_email" name="email"
                                    placeholder="name@example.com" value="<?= esc(old('email')) ?>" autocomplete="email" required autofocus>
                            </div>
                            <div class="mb-4">
                                <label for="login_password" class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control form-control-lg" id="login_password" name="password"
                                    placeholder="Enter password" autocomplete="current-password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-sign-in-alt me-2"></i>Login to Dashboard
                            </button>
                            <p class="small text-muted text-center mt-3 mb-0">
                                Use the email and password created during registration.
                                <a href="<?= base_url('register') ?>">Create an account</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

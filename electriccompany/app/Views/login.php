<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<section class="login-section login-experience">
    <div class="login-ambient" aria-hidden="true">
        <span class="login-orb login-orb-one"></span>
        <span class="login-orb login-orb-two"></span>
        <span class="login-grid"></span>
    </div>

    <div class="container login-stage">
        <div class="login-shell" data-login-shell>
            <aside class="login-brand-panel">
                <div class="login-brand-top">
                    <a class="login-brand" href="<?= base_url() ?>" aria-label="Puihaha Electric home">
                        <span class="login-brand-mark"><i class="fas fa-bolt"></i></span>
                        <span>Puihaha Electric</span>
                    </a>
                    <span class="login-secure-pill"><i class="fas fa-shield-halved"></i> Secure portal</span>
                </div>

                <div class="login-brand-copy">
                    <p class="login-kicker">Customer command center</p>
                    <h2>Powering every connection.</h2>
                    <p>Access service accounts, review customer details, and keep operations moving from one secure dashboard.</p>
                </div>

                <div class="login-energy-visual" aria-hidden="true">
                    <span class="energy-ring energy-ring-one"></span>
                    <span class="energy-ring energy-ring-two"></span>
                    <span class="energy-core"><i class="fas fa-bolt"></i></span>
                    <span class="energy-node energy-node-one"></span>
                    <span class="energy-node energy-node-two"></span>
                    <span class="energy-node energy-node-three"></span>
                </div>

                <div class="login-benefits" aria-label="Portal benefits">
                    <span><i class="fas fa-circle-check"></i> Protected access</span>
                    <span><i class="fas fa-bolt"></i> Fast account tools</span>
                    <span><i class="fas fa-headset"></i> Reliable support</span>
                </div>
            </aside>

            <div class="login-form-panel">
                <a class="login-back-link" href="<?= base_url() ?>">
                    <i class="fas fa-arrow-left"></i> Back to website
                </a>

                <div class="login-heading">
                    <span class="login-mobile-icon"><i class="fas fa-bolt"></i></span>
                    <p class="login-kicker">Welcome back</p>
                    <h1>Sign in to your account</h1>
                    <p>Enter the credentials you created during registration.</p>
                </div>

                <?php if (! empty($error)): ?>
                    <div class="alert alert-danger login-alert" role="alert">
                        <i class="fas fa-circle-exclamation"></i>
                        <span><?= esc($error) ?></span>
                    </div>
                <?php endif; ?>

                <?php if (! empty($success)): ?>
                    <div class="alert alert-success login-alert" role="status">
                        <i class="fas fa-circle-check"></i>
                        <span><?= esc($success) ?></span>
                    </div>
                <?php endif; ?>

                <form class="login-form" method="post" action="<?= base_url('login') ?>">
                    <?= csrf_field() ?>

                    <div class="login-field">
                        <label for="login_email">Email address</label>
                        <div class="login-input-wrap">
                            <i class="fas fa-envelope login-input-icon" aria-hidden="true"></i>
                            <input type="email" class="form-control" id="login_email" name="email"
                                placeholder="name@example.com" value="<?= esc(old('email')) ?>"
                                autocomplete="email" required autofocus>
                            <span class="login-field-status" aria-hidden="true"><i class="fas fa-check"></i></span>
                        </div>
                    </div>

                    <div class="login-field">
                        <label for="login_password">Password</label>
                        <div class="login-input-wrap">
                            <i class="fas fa-lock login-input-icon" aria-hidden="true"></i>
                            <input type="password" class="form-control" id="login_password" name="password"
                                placeholder="Enter your password" autocomplete="current-password"
                                data-strength="off" required>
                            <button class="login-password-toggle" type="button" data-password-toggle
                                aria-label="Show password" aria-pressed="false">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    <div class="login-security-note">
                        <i class="fas fa-lock"></i>
                        <span>Your sign-in is protected by an encrypted session.</span>
                    </div>

                    <button type="submit" class="btn login-submit">
                        <span>Enter Dashboard</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>

                    <p class="login-register-copy">
                        New to Puihaha Electric?
                        <a href="<?= base_url('register') ?>">Create your account <i class="fas fa-arrow-right"></i></a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

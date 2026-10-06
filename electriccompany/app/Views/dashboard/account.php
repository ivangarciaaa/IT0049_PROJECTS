<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<section class="dashboard-section section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <p class="dashboard-eyebrow mb-1">Customer Account</p>
                        <h1 class="display-6 fw-bold text-primary-custom mb-0"><?= esc($account['account_number']) ?></h1>
                    </div>
                    <div class="d-flex flex-wrap gap-2 account-page-actions">
                        <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                        </a>
                        <a href="<?= base_url('dashboard/account/' . $account['id'] . '/edit') ?>" class="btn btn-primary">
                            <i class="fas fa-pen me-2"></i>Edit
                        </a>
                        <form method="post" action="<?= base_url('dashboard/account/' . $account['id'] . '/delete') ?>"
                            onsubmit="return confirm('Delete this customer account? This action cannot be undone.');">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fas fa-trash me-2"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>

                <?php if (! empty($success)): ?>
                    <div class="alert alert-success" role="status">
                        <i class="fas fa-circle-check me-2"></i><?= esc($success) ?>
                    </div>
                <?php endif; ?>

                <?php if (! empty($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-circle-exclamation me-2"></i><?= esc($error) ?>
                    </div>
                <?php endif; ?>

                <div class="card dashboard-panel account-detail-card border-0">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
                            <div>
                                <h2 class="h3 fw-bold mb-1"><?= esc($account['customer_name']) ?></h2>
                                <p class="text-muted mb-0"><?= esc($account['address']) ?></p>
                            </div>
                            <span class="account-status status-<?= esc($account['status']) ?>"><?= ucfirst(esc($account['status'])) ?></span>
                        </div>

                        <div class="row g-4">
                            <?php
                            $details = [
                                ['Meter Number', $account['meter_number'], 'fa-gauge-high'],
                                ['Connection Type', ucfirst($account['connection_type']), 'fa-plug'],
                                ['Phone', $account['phone'], 'fa-phone'],
                                ['Email', $account['email'], 'fa-envelope'],
                                ['Created', date('F j, Y', strtotime($account['created_at'])), 'fa-calendar-plus'],
                                ['Last Updated', date('F j, Y', strtotime($account['updated_at'])), 'fa-calendar-check'],
                            ];
                            ?>
                            <?php foreach ($details as [$label, $value, $icon]): ?>
                                <div class="col-md-6">
                                    <div class="account-detail-item">
                                        <i class="fas <?= esc($icon) ?>"></i>
                                        <div>
                                            <span><?= esc($label) ?></span>
                                            <strong><?= esc($value) ?></strong>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

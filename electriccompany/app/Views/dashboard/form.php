<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php
$fieldValue = static function (string $field) use ($account): string {
    $oldValue = old($field);
    if ($oldValue !== null) {
        return (string) $oldValue;
    }

    return (string) ($account[$field] ?? '');
};
?>

<section class="dashboard-section section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <p class="dashboard-eyebrow mb-1">Customer Management</p>
                        <h1 class="display-6 fw-bold text-primary-custom mb-1"><?= esc($formTitle) ?></h1>
                        <p class="text-muted mb-0"><?= esc($formDescription) ?></p>
                    </div>
                    <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                    </a>
                </div>

                <?php if (! empty($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-circle-exclamation me-2"></i><?= esc($error) ?>
                    </div>
                <?php endif; ?>

                <?php if ($validation !== []): ?>
                    <div class="alert alert-danger" role="alert">
                        <p class="fw-semibold mb-2">Please correct the following:</p>
                        <ul class="mb-0">
                            <?php foreach ($validation as $message): ?>
                                <li><?= esc($message) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="card dashboard-panel account-form-card border-0">
                    <div class="card-body p-4 p-lg-5">
                        <form method="post" action="<?= esc($formAction) ?>">
                            <?= csrf_field() ?>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="account_number" class="form-label fw-semibold">Account Number *</label>
                                    <input type="text" class="form-control<?= isset($validation['account_number']) ? ' is-invalid' : '' ?>"
                                        id="account_number" name="account_number" maxlength="50" required
                                        placeholder="EC-2024-0001" value="<?= esc($fieldValue('account_number')) ?>">
                                    <?php if (isset($validation['account_number'])): ?>
                                        <div class="invalid-feedback"><?= esc($validation['account_number']) ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="meter_number" class="form-label fw-semibold">Meter Number</label>
                                    <input type="text" class="form-control<?= isset($validation['meter_number']) ? ' is-invalid' : '' ?>"
                                        id="meter_number" name="meter_number" maxlength="50"
                                        placeholder="MTR-001" value="<?= esc($fieldValue('meter_number')) ?>">
                                    <?php if (isset($validation['meter_number'])): ?>
                                        <div class="invalid-feedback"><?= esc($validation['meter_number']) ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12">
                                    <label for="customer_name" class="form-label fw-semibold">Customer Name *</label>
                                    <input type="text" class="form-control<?= isset($validation['customer_name']) ? ' is-invalid' : '' ?>"
                                        id="customer_name" name="customer_name" maxlength="150" required
                                        value="<?= esc($fieldValue('customer_name')) ?>">
                                    <?php if (isset($validation['customer_name'])): ?>
                                        <div class="invalid-feedback"><?= esc($validation['customer_name']) ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12">
                                    <label for="address" class="form-label fw-semibold">Service Address *</label>
                                    <textarea class="form-control<?= isset($validation['address']) ? ' is-invalid' : '' ?>"
                                        id="address" name="address" rows="3" maxlength="500" required><?= esc($fieldValue('address')) ?></textarea>
                                    <?php if (isset($validation['address'])): ?>
                                        <div class="invalid-feedback"><?= esc($validation['address']) ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold">Email Address</label>
                                    <input type="email" class="form-control<?= isset($validation['email']) ? ' is-invalid' : '' ?>"
                                        id="email" name="email" maxlength="100" placeholder="customer@example.com"
                                        value="<?= esc($fieldValue('email')) ?>">
                                    <?php if (isset($validation['email'])): ?>
                                        <div class="invalid-feedback"><?= esc($validation['email']) ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label fw-semibold">Phone Number</label>
                                    <input type="tel" class="form-control<?= isset($validation['phone']) ? ' is-invalid' : '' ?>"
                                        id="phone" name="phone" maxlength="20" value="<?= esc($fieldValue('phone')) ?>">
                                    <?php if (isset($validation['phone'])): ?>
                                        <div class="invalid-feedback"><?= esc($validation['phone']) ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="connection_type" class="form-label fw-semibold">Connection Type *</label>
                                    <select class="form-select<?= isset($validation['connection_type']) ? ' is-invalid' : '' ?>"
                                        id="connection_type" name="connection_type" required>
                                        <?php $selectedType = $fieldValue('connection_type') ?: 'residential'; ?>
                                        <?php foreach (['residential', 'commercial', 'industrial'] as $type): ?>
                                            <option value="<?= $type ?>" <?= $selectedType === $type ? 'selected' : '' ?>><?= ucfirst($type) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (isset($validation['connection_type'])): ?>
                                        <div class="invalid-feedback"><?= esc($validation['connection_type']) ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label fw-semibold">Status *</label>
                                    <select class="form-select<?= isset($validation['status']) ? ' is-invalid' : '' ?>"
                                        id="status" name="status" required>
                                        <?php $selectedStatus = $fieldValue('status') ?: 'active'; ?>
                                        <?php foreach (['active', 'inactive', 'suspended'] as $status): ?>
                                            <option value="<?= $status ?>" <?= $selectedStatus === $status ? 'selected' : '' ?>><?= ucfirst($status) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (isset($validation['status'])): ?>
                                        <div class="invalid-feedback"><?= esc($validation['status']) ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="account-form-actions d-flex flex-wrap justify-content-end gap-2 mt-4 pt-3">
                                <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i><?= esc($submitLabel) ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

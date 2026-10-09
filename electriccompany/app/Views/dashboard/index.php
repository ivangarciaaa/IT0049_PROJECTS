<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<section class="dashboard-section section-padding">
    <div class="container">
        <div class="dashboard-heading d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <p class="dashboard-eyebrow mb-1">Customer Management</p>
                <h1 class="dashboard-title mb-1">Account Dashboard</h1>
                <p class="text-muted mb-0">Browse and review Puihaha Electric customer accounts.</p>
            </div>
            <div class="dashboard-session-actions">
                <span class="dashboard-user">
                    <i class="fas fa-user-circle"></i>
                    Signed in as <strong><?= esc($displayName) ?></strong>
                </span>
                <div class="d-flex flex-wrap gap-2">
                    <a href="<?= base_url('dashboard/account/new') ?>" class="btn dashboard-primary-action">
                        <i class="fas fa-plus me-2"></i>Add Account
                    </a>
                    <a href="<?= base_url() ?>" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Website
                    </a>
                    <form method="post" action="<?= base_url('logout') ?>">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </button>
                    </form>
                </div>
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

        <div class="row g-4 mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="dashboard-stat stat-total">
                    <span class="dashboard-stat-icon"><i class="fas fa-users"></i></span>
                    <span class="dashboard-stat-copy">
                        <span>Total Accounts</span>
                        <strong><?= esc($totalAccounts) ?></strong>
                    </span>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="dashboard-stat stat-active">
                    <span class="dashboard-stat-icon"><i class="fas fa-circle-check"></i></span>
                    <span class="dashboard-stat-copy">
                        <span>Active</span>
                        <strong><?= esc($activeAccounts) ?></strong>
                    </span>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="dashboard-stat stat-inactive">
                    <span class="dashboard-stat-icon"><i class="fas fa-circle-pause"></i></span>
                    <span class="dashboard-stat-copy">
                        <span>Inactive</span>
                        <strong><?= esc($inactiveAccounts) ?></strong>
                    </span>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="dashboard-stat stat-suspended">
                    <span class="dashboard-stat-icon"><i class="fas fa-clock"></i></span>
                    <span class="dashboard-stat-copy">
                        <span>Suspended</span>
                        <strong><?= esc($suspendedAccounts) ?></strong>
                    </span>
                </div>
            </div>
        </div>

        <div class="card dashboard-panel border-0 mb-4">
            <div class="card-body p-4">
                <form method="get" action="<?= base_url('dashboard') ?>">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-5">
                            <label for="search" class="form-label fw-semibold">Search accounts</label>
                            <input type="search" class="form-control" id="search" name="search"
                                placeholder="Name, account, email, or phone" value="<?= esc($searchKeyword) ?>">
                        </div>
                        <div class="col-sm-6 col-lg-2">
                            <label for="status" class="form-label fw-semibold">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="">All statuses</option>
                                <?php foreach (['active', 'inactive', 'suspended'] as $status): ?>
                                    <option value="<?= $status ?>" <?= $filterStatus === $status ? 'selected' : '' ?>>
                                        <?= ucfirst($status) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-sm-6 col-lg-2">
                            <label for="type" class="form-label fw-semibold">Type</label>
                            <select class="form-select" id="type" name="type">
                                <option value="">All types</option>
                                <?php foreach (['residential', 'commercial', 'industrial'] as $type): ?>
                                    <option value="<?= $type ?>" <?= $filterType === $type ? 'selected' : '' ?>>
                                        <?= ucfirst($type) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-lg-3 d-flex gap-2">
                            <button type="submit" class="btn dashboard-primary-action flex-grow-1">
                                <i class="fas fa-search me-2"></i>Search
                            </button>
                            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-secondary" aria-label="Clear filters">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card dashboard-panel border-0">
            <div class="table-responsive">
                <table class="table dashboard-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Account</th>
                            <th>Customer</th>
                            <th>Contact</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($accounts === []): ?>
                            <tr>
                                <td colspan="6" class="dashboard-empty text-center text-muted py-5">No customer accounts found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($accounts as $account): ?>
                                <tr>
                                    <td data-label="Account" class="fw-semibold text-primary-custom"><?= esc($account['account_number']) ?></td>
                                    <td data-label="Customer">
                                        <strong class="d-block"><?= esc($account['customer_name']) ?></strong>
                                        <small class="text-muted"><?= esc($account['meter_number']) ?></small>
                                    </td>
                                    <td data-label="Contact">
                                        <span class="d-block"><?= esc($account['email']) ?></span>
                                        <small class="text-muted"><?= esc($account['phone']) ?></small>
                                    </td>
                                    <td data-label="Type"><span class="account-type"><?= ucfirst(esc($account['connection_type'])) ?></span></td>
                                    <td data-label="Status"><span class="account-status status-<?= esc($account['status']) ?>"><?= ucfirst(esc($account['status'])) ?></span></td>
                                    <td data-label="Action" class="dashboard-action text-end">
                                        <div class="dashboard-action-buttons">
                                            <a href="<?= base_url('dashboard/account/' . $account['id']) ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye me-1"></i>View
                                            </a>
                                            <a href="<?= base_url('dashboard/account/' . $account['id'] . '/edit') ?>" class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-pen me-1"></i>Edit
                                            </a>
                                            <form method="post" action="<?= base_url('dashboard/account/' . $account['id'] . '/delete') ?>"
                                                onsubmit="return confirm('Delete account <?= esc($account['account_number'], 'js') ?>? This action cannot be undone.');">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash me-1"></i>Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
            <?php if ($pager->getPageCount() > 1): ?>
                <div class="dashboard-pagination d-flex flex-wrap justify-content-between align-items-center gap-3 p-4">
                    <span class="text-muted small">Page <?= $pager->getCurrentPage() ?> of <?= $pager->getPageCount() ?></span>
                    <?= $pager->links() ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

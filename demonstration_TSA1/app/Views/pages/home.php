<?= $this->include('layouts/header') ?>

<section class="hero">
    <div>
        <p class="eyebrow">CodeIgniter POS Foundations</p>
        <h1>A simpler way to manage your store.</h1>
        <p class="lead">Cornerstone POS brings customer and staff account information together in one clean, easy-to-use workspace.</p>
        <div class="button-row">
            <a class="button" href="<?= base_url('customers') ?>">View customers</a>
            <a class="button secondary" href="<?= base_url('users') ?>">View users</a>
        </div>
    </div>
    <aside class="hero-card" aria-label="System summary">
        <h2>System overview</h2>
        <div class="metric"><span>Application pages</span><strong>4</strong></div>
        <div class="metric"><span>Customer records</span><strong>5</strong></div>
        <div class="metric"><span>User records</span><strong>5</strong></div>
        <div class="metric"><span>Current data source</span><strong>Arrays</strong></div>
    </aside>
</section>

<?= $this->include('layouts/footer') ?>

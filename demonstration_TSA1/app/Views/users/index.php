<?= $this->include('layouts/header') ?>

<section class="page-heading">
    <p class="eyebrow">Staff directory</p>
    <h1>User Accounts</h1>
    <p class="lead">A temporary staff listing supplied by a static PHP array in the Users controller.</p>
</section>
<section class="table-card" aria-labelledby="user-table-title">
    <div class="table-scroll">
        <table>
            <caption id="user-table-title" style="position:absolute;left:-9999px">User account records</caption>
            <thead><tr><th scope="col">#</th><th scope="col">Username</th><th scope="col">Full name</th><th scope="col">Role</th></tr></thead>
            <tbody>
            <?php foreach ($users as $index => $user): ?>
                <tr>
                    <td><?= esc($index + 1) ?></td>
                    <td><strong><?= esc($user['username']) ?></strong></td>
                    <td><?= esc($user['full_name']) ?></td>
                    <td><span class="badge"><?= esc($user['role']) ?></span></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</section>

<?= $this->include('layouts/footer') ?>

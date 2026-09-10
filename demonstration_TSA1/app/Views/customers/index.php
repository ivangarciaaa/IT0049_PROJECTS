<?= $this->include('layouts/header') ?>

<section class="page-heading">
    <p class="eyebrow">Accounts directory</p>
    <h1>Customer Accounts</h1>
    <p class="lead">A temporary customer listing supplied by a static PHP array in the Customers controller.</p>
</section>
<section class="table-card" aria-labelledby="customer-table-title">
    <div class="table-scroll">
        <table>
            <caption id="customer-table-title" style="position:absolute;left:-9999px">Customer account records</caption>
            <thead><tr><th scope="col">#</th><th scope="col">Full name</th><th scope="col">Email address</th><th scope="col">Phone number</th></tr></thead>
            <tbody>
            <?php foreach ($customers as $index => $customer): ?>
                <tr>
                    <td><?= esc($index + 1) ?></td>
                    <td><strong><?= esc($customer['full_name']) ?></strong></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone']) ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</section>

<?= $this->include('layouts/footer') ?>

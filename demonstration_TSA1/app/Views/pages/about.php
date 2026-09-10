<?= $this->include('layouts/header') ?>

<section class="page-heading">
    <p class="eyebrow">About the project</p>
    <h1>Built on clear MVC foundations.</h1>
    <p class="lead">This first POS version demonstrates how CodeIgniter routes a request to a controller and renders the result through a view.</p>
</section>
<article class="content-card">
    <h2>Project purpose</h2>
    <p>Cornerstone POS is a four-page learning application. Its customer and user account pages use static PHP arrays as temporary data sources before database integration is introduced.</p>
    <p>The project separates request handling from presentation: routes define the available URLs, controllers prepare page data, and views generate the HTML shown in the browser.</p>
</article>

<?= $this->include('layouts/footer') ?>

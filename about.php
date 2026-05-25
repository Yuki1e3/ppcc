<?php
require_once __DIR__ . '/includes/functions.php';

render_header('about.php', 'About');
?>

<main>
    <section class="page-hero image-hero" style="--hero-img:url('https://images.unsplash.com/photo-1478147427282-58a87a120781?auto=format&fit=crop&w=1800&q=80')">
        <div class="container">
            <p class="section-label">Who We Are</p>
            <h1><?= e(setting('about_title', 'Rooted in Faith, Growing in Love')) ?></h1>
            <p><?= e(setting('tagline')) ?></p>
        </div>
    </section>

    <section>
        <div class="container about-story">
            <div class="about-mark">01</div>
            <div>
                <p class="section-label">Our Story</p>
                <h2 class="section-title">A local church with open hands.</h2>
            </div>
            <p><?= nl2br(e(setting('about_body'))) ?></p>
        </div>
    </section>

    <section class="section-soft">
        <div class="container values wide">
            <div class="value"><strong>Faith</strong><p>Anchored in God's Word and prayer.</p></div>
            <div class="value"><strong>Love</strong><p>Serving neighbors with compassion.</p></div>
            <div class="value"><strong>Growth</strong><p>Disciples growing together in Christ.</p></div>
            <div class="value"><strong>Community</strong><p>United as one family in worship and service.</p></div>
        </div>
    </section>
</main>

<?php render_footer(); ?>

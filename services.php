<?php
require_once __DIR__ . '/includes/functions.php';

$service = current_service();
$announcements = active_announcements();
render_header('services.php', 'Services');
?>

<main>
    <section class="page-hero mini-hero">
        <div class="container">
            <p class="section-label">Sunday Service</p>
            <h1>Worship, prayer, and a place to belong.</h1>
            <p><?= e(setting('tagline')) ?></p>
        </div>
    </section>

    <section>
        <div class="container service-detail-layout">
            <div class="service-poster large">
                <span><?= e($service['schedule_note']) ?></span>
                <strong><?= e($service['service_time']) ?></strong>
                <p><?= e($service['location_name']) ?><br><?= e($service['address']) ?></p>
            </div>
            <div class="panel editorial-panel">
                <p class="section-label">Message</p>
                <h2><?= e($service['topic'] ?: $service['title']) ?></h2>
                <p>Speaker: <?= e($service['speaker'] ?: 'PPCC Pastoral Team') ?></p>
                <p>We gather every Sunday for worship, Scripture, prayer, music, and fellowship. Visitors and families are always welcome.</p>
            </div>
        </div>
    </section>

    <section class="section-soft">
        <div class="container">
            <div class="section-head">
                <p class="section-label">Announcements</p>
                <h2 class="section-title">Notes for this week</h2>
            </div>
            <div class="notice-grid">
                <?php foreach ($announcements as $ann): ?>
                    <article class="notice-card">
                        <span><?= e($ann['priority']) ?></span>
                        <h3><?= e($ann['title']) ?></h3>
                        <p><?= e($ann['body']) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php render_footer(); ?>

<?php
require_once __DIR__ . '/includes/functions.php';

$slides = db()->query('SELECT * FROM hero_slides WHERE is_active = 1 ORDER BY sort_order ASC, id DESC')->fetchAll();
$service = current_service();
$announcements = active_announcements();
$events = upcoming_events();
$gallery = array_slice(public_gallery(), 0, 6);

render_header('index.php', 'Home');
?>

<header class="home-hero" id="hero">
    <div class="hero-track" id="heroTrack">
        <?php foreach ($slides ?: [] as $slide): ?>
            <article class="home-slide">
                <div class="home-slide-bg" style="background-image:url('<?= e(media_src($slide['image_url']) ?: 'https://images.unsplash.com/photo-1507692049790-de58290a4334?auto=format&fit=crop&w=1800&q=80') ?>')"></div>
                <div class="container hero-stage">
                    <div class="hero-note">PPCC</div>
                    <div class="hero-copy">
                        <span class="eyebrow"><?= e($slide['tag'] ?: 'Welcome Home') ?></span>
                        <h1><?= e($slide['title']) ?></h1>
                        <?php if ($slide['subtitle']): ?><p><?= e($slide['subtitle']) ?></p><?php endif; ?>
                        <div class="hero-actions">
                            <a class="btn" href="<?= e(url('services.php')) ?>"><?= e($slide['button_label'] ?: 'Visit Sunday') ?></a>
                            <a class="text-link" href="<?= e(url('events.php')) ?>">Events</a>
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
    <?php if (count($slides) > 1): ?>
        <button class="hero-arrow prev" type="button" onclick="moveHero(-1)" aria-label="Previous slide">&#8249;</button>
        <button class="hero-arrow next" type="button" onclick="moveHero(1)" aria-label="Next slide">&#8250;</button>
    <?php endif; ?>
</header>

<main>
    <section class="section-soft">
        <div class="container service-feature">
            <div class="section-kicker">
                <p class="section-label">This Sunday</p>
                <h2 class="section-title"><?= e($service['title']) ?></h2>
                <p class="section-sub">Worship, prayer, and community.</p>
            </div>
            <div class="service-poster">
                <span><?= e($service['schedule_note']) ?></span>
                <strong><?= e($service['service_time']) ?></strong>
                <p><?= e($service['location_name']) ?><br><?= e($service['address']) ?></p>
                <a class="btn secondary" href="<?= e(url('services.php')) ?>">Service Details</a>
            </div>
            <div class="service-note">
                <h3><?= e($service['topic'] ?: 'Growing Together in Faith') ?></h3>
                <p><?= e($service['speaker'] ?: 'PPCC Pastoral Team') ?></p>
                <?php if ($announcements): ?>
                    <div class="announcement compact">
                        <h4><?= e($announcements[0]['title']) ?></h4>
                        <p><?= e($announcements[0]['body']) ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section>
        <div class="container split-editorial">
            <div>
                <p class="section-label">Upcoming</p>
                <h2 class="section-title">Gather with us.</h2>
                <a class="text-link" href="<?= e(url('events.php')) ?>">View all events</a>
            </div>
            <div class="event-stack">
                <?php foreach (array_slice($events, 0, 3) as $event): $dt = new DateTime($event['event_date']); ?>
                    <article class="event-card lifted">
                        <div class="datebox"><div><strong><?= e($dt->format('d')) ?></strong><span><?= e($dt->format('M')) ?></span></div></div>
                        <div>
                            <span class="badge"><?= e(ucfirst($event['event_type'])) ?></span>
                            <h4><?= e($event['name']) ?></h4>
                            <p><?= e($dt->format('F j, Y')) ?><?= $event['event_time'] ? ' at ' . e(date('g:i A', strtotime($event['event_time']))) : '' ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="gallery-band">
        <div class="container">
            <div class="gallery-band-head">
                <div>
                    <p class="section-label">Gallery</p>
                    <h2 class="section-title">Life at PPCC.</h2>
                </div>
                <a class="btn" href="<?= e(url('gallery.php')) ?>">Open Gallery</a>
            </div>
            <div class="gallery-strip">
                <?php foreach ($gallery as $photo): ?>
                    <figure>
                        <img src="<?= e(url($photo['image_path'])) ?>" alt="<?= e($photo['caption']) ?>">
                        <figcaption><?= e($photo['caption']) ?></figcaption>
                    </figure>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="final-cta">
        <div class="container cta-inner">
            <p class="section-label">Visit PPCC</p>
            <h2>Come as you are.</h2>
            <a class="btn" href="<?= e(url('contact.php')) ?>">Get Directions</a>
        </div>
    </section>
</main>

<script>
let heroIndex = 0;
function moveHero(step) {
    const track = document.getElementById('heroTrack');
    const total = track.children.length;
    if (!total) return;
    heroIndex = (heroIndex + step + total) % total;
    track.style.transform = `translateX(-${heroIndex * 100}%)`;
}
setInterval(() => moveHero(1), 8000);
</script>

<?php render_footer(); ?>

<?php
require_once __DIR__ . '/includes/functions.php';

$announcements = active_announcements();
render_header('announcements.php', 'Announcements');
?>

<main>
    <section class="page-hero mini-hero">
        <div class="container">
            <p class="section-label">Church Board</p>
            <h1>Important updates from PPCC.</h1>
            <p>Read the latest notes, reminders, and ministry announcements.</p>
        </div>
    </section>

    <section>
        <div class="container notice-list">
            <?php foreach ($announcements as $ann): ?>
                <article class="notice-row">
                    <div>
                        <span class="badge"><?= e($ann['priority']) ?></span>
                        <h2><?= e($ann['title']) ?></h2>
                    </div>
                    <p><?= e($ann['body']) ?></p>
                    <time><?= e($ann['announce_date'] ?: date('Y-m-d', strtotime($ann['created_at']))) ?></time>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php render_footer(); ?>

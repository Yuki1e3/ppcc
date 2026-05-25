<?php
require_once __DIR__ . '/includes/functions.php';

$category = $_GET['category'] ?? 'all';
$gallery = public_gallery($category);
$categories = [
    'all' => 'All Moments',
    'worship' => 'Worship',
    'feeding' => 'Feeding',
    'fellowship' => 'Fellowship',
    'youth' => 'Youth',
    'outreach' => 'Outreach',
];
render_header('gallery.php', 'Gallery');
?>

<main>
    <section class="page-hero gallery-hero">
        <div class="container">
            <p class="section-label">Community Gallery</p>
            <h1>Small moments, lasting grace.</h1>
            <p>Browse worship, outreach, fellowship, youth, and feeding program photos.</p>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="gallery-tabs">
                <?php foreach ($categories as $key => $label): ?>
                    <a class="tab <?= $category === $key ? 'active' : '' ?>" href="<?= e(url('gallery.php?category=' . $key)) ?>"><?= e($label) ?></a>
                <?php endforeach; ?>
            </div>
            <div class="gallery-grid art-grid">
                <?php foreach ($gallery as $photo): ?>
                    <figure class="gallery-item" onclick="openLightbox('<?= e(url($photo['image_path'])) ?>', '<?= e($photo['caption']) ?>')">
                        <img src="<?= e(url($photo['image_path'])) ?>" alt="<?= e($photo['caption']) ?>">
                        <span><?= e($photo['caption']) ?></span>
                    </figure>
                <?php endforeach; ?>
            </div>
            <?php if (!$gallery): ?><div class="panel">No photos in this category yet.</div><?php endif; ?>
        </div>
    </section>
</main>

<dialog id="lightbox" onclick="this.close()">
    <img id="lightboxImg" alt="" style="max-width:90vw;max-height:84vh;border-radius:8px">
</dialog>
<script>
function openLightbox(src, alt) {
    const dlg = document.getElementById('lightbox');
    const img = document.getElementById('lightboxImg');
    img.src = src;
    img.alt = alt;
    dlg.showModal();
}
</script>

<?php render_footer(); ?>

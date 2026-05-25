<?php
require_once __DIR__ . '/includes/functions.php';

render_header('contact.php', 'Contact');
?>

<main>
    <section class="page-hero mini-hero">
        <div class="container">
            <p class="section-label">Visit Us</p>
            <h1>We would love to meet you.</h1>
            <p>Find PPCC, send a message, or connect with us online.</p>
        </div>
    </section>

    <section>
        <div class="container contact-layout">
            <div class="contact-card">
                <p class="section-label">Address</p>
                <h2><?= e(setting('contact_address')) ?></h2>
                <p><?= e(setting('contact_phone')) ?></p>
                <a class="text-link" href="mailto:<?= e(setting('contact_email')) ?>"><?= e(setting('contact_email')) ?></a>
            </div>
            <form class="contact-card" method="post" action="mailto:<?= e(setting('contact_email')) ?>" enctype="text/plain">
                <label>Your Name</label>
                <input name="name" required>
                <label>Email</label>
                <input name="email" type="email" required>
                <label>Message</label>
                <textarea name="message" required></textarea>
                <div class="form-actions"><button class="btn" type="submit">Send Message</button></div>
            </form>
        </div>
    </section>
</main>

<?php render_footer(); ?>

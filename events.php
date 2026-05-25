<?php
require_once __DIR__ . '/includes/functions.php';

$events = db()->query('SELECT * FROM events ORDER BY event_date ASC, event_time ASC')->fetchAll();
$allEvents = db()->query('SELECT name, event_date FROM events ORDER BY event_date ASC')->fetchAll();
render_header('events.php', 'Events');
?>

<main>
    <section class="page-hero image-hero" style="--hero-img:url('https://images.unsplash.com/photo-1491438590914-bc09fcaaf77a?auto=format&fit=crop&w=1800&q=80')">
        <div class="container">
            <p class="section-label">Calendar</p>
            <h1>Gatherings that move faith into action.</h1>
            <p>See worship, fellowship, youth, and outreach schedules in one place.</p>
        </div>
    </section>

    <section>
        <div class="container events-layout">
            <div class="panel calendar">
                <div class="calendar-head">
                    <button type="button" onclick="changeMonth(-1)">&#8249;</button>
                    <h3 id="calendarTitle"></h3>
                    <button type="button" onclick="changeMonth(1)">&#8250;</button>
                </div>
                <div class="weekdays"><span>Sun</span><span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span></div>
                <div class="days" id="calendarDays"></div>
            </div>
            <div class="event-list">
                <?php foreach ($events as $event): $dt = new DateTime($event['event_date']); ?>
                    <article class="event-card">
                        <div class="datebox"><div><strong><?= e($dt->format('d')) ?></strong><span><?= e($dt->format('M')) ?></span></div></div>
                        <div>
                            <span class="badge"><?= e(ucfirst($event['event_type'])) ?></span>
                            <h4><?= e($event['name']) ?></h4>
                            <p><?= e($dt->format('F j, Y')) ?><?= $event['event_time'] ? ' at ' . e(date('g:i A', strtotime($event['event_time']))) : '' ?></p>
                            <p><?= e($event['location']) ?></p>
                            <?php if ($event['description']): ?><p><?= e($event['description']) ?></p><?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<script>
const events = <?= json_encode($allEvents, JSON_THROW_ON_ERROR) ?>;
const title = document.getElementById('calendarTitle');
const days = document.getElementById('calendarDays');
let cal = new Date();
function renderCalendar() {
    const year = cal.getFullYear();
    const month = cal.getMonth();
    const first = new Date(year, month, 1).getDay();
    const count = new Date(year, month + 1, 0).getDate();
    const today = new Date();
    const eventDays = new Set(events.filter(e => {
        const d = new Date(e.event_date + 'T00:00:00');
        return d.getFullYear() === year && d.getMonth() === month;
    }).map(e => new Date(e.event_date + 'T00:00:00').getDate()));
    title.textContent = cal.toLocaleString('en', { month: 'long', year: 'numeric' });
    days.innerHTML = '';
    for (let i = 0; i < first; i++) days.insertAdjacentHTML('beforeend', '<div></div>');
    for (let d = 1; d <= count; d++) {
        const cls = ['day'];
        if (today.getFullYear() === year && today.getMonth() === month && today.getDate() === d) cls.push('today');
        if (eventDays.has(d)) cls.push('event');
        days.insertAdjacentHTML('beforeend', `<div class="${cls.join(' ')}">${d}</div>`);
    }
}
function changeMonth(step) {
    cal = new Date(cal.getFullYear(), cal.getMonth() + step, 1);
    renderCalendar();
}
renderCalendar();
</script>

<?php render_footer(); ?>

<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = null; // homepage gebruikt de standaardtitel
$sliderImages = glob(__DIR__ . '/assets/img/slider/*.jpg');
require __DIR__ . '/includes/header.php';
?>

<!-- Hero met diavoorstelling -->
<section class="hero">
    <div class="hero-slides">
        <?php foreach ($sliderImages as $i => $img): $rel = 'assets/img/slider/' . basename($img); ?>
            <div class="hero-slide<?= $i === 0 ? ' is-active' : '' ?>" style="background-image:url('<?= e($rel) ?>')"></div>
        <?php endforeach; ?>
    </div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <p class="hero-kicker">Architectenbureau Studio Vendrig</p>
        <h1>Wij cre&euml;ren de<br>juiste omgeving</h1>
        <div class="hero-diensten">
            <?php foreach (DIENSTEN as $i => $dienst): ?>
                <span class="dienst dienst-<?= $i ?>"><?= e($dienst) ?></span>
            <?php endforeach; ?>
        </div>
        <a class="btn btn-light" href="projecten.php">Bekijk onze projecten</a>
    </div>
    <div class="hero-dots">
        <?php foreach ($sliderImages as $i => $img): ?>
            <button class="hero-dot<?= $i === 0 ? ' is-active' : '' ?>" data-slide="<?= $i ?>" aria-label="Dia <?= $i + 1 ?>"></button>
        <?php endforeach; ?>
    </div>
</section>

<!-- Introductie -->
<section class="section intro">
    <div class="container narrow center">
        <p class="section-kicker">Sinds 2005</p>
        <h2>Ontwerp, engineering en uitvoering, onlosmakelijk verbonden</h2>
        <p class="lead">Studio Vendrig cre&euml;ert voor u de juiste omgeving. Van kleine tot grootschalige
        projecten, van woningbouw tot gezondheidszorg, van aanbouw en verbouw tot nieuwbouw &mdash;
        met knowhow op het gebied van bouwkunst, bouwtechniek en projectmanagement.</p>
        <a class="btn btn-outline" href="studio.php">Over de studio</a>
    </div>
</section>

<!-- Uitgelichte projecten -->
<section class="section section-alt">
    <div class="container">
        <div class="section-head">
            <div>
                <p class="section-kicker">Portfolio</p>
                <h2>Uitgelichte projecten</h2>
            </div>
            <a class="btn btn-outline" href="projecten.php">Alle projecten</a>
        </div>
        <div class="project-grid">
            <?php
            $featured = [8, 3, 2, 14, 4, 9];
            foreach ($featured as $fid):
                $p = project_by_id($fid);
                if (!$p || !$p['images']) continue;
            ?>
            <a class="project-card" href="project.php?id=<?= $p['id'] ?>">
                <div class="project-card-img">
                    <img src="<?= e($p['images'][0]['file']) ?>" alt="<?= e($p['title']) ?>" loading="lazy">
                </div>
                <div class="project-card-body">
                    <span class="project-card-cat"><?= e($p['category']) ?></span>
                    <h3><?= e($p['title']) ?></h3>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Nieuws -->
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <p class="section-kicker">Actueel</p>
                <h2>Recente berichten</h2>
            </div>
            <a class="btn btn-outline" href="nieuws.php">Al het nieuws</a>
        </div>
        <div class="news-grid">
            <?php foreach (news_items() as $n): ?>
            <a class="news-card" href="nieuws.php?id=<?= $n['id'] ?>">
                <div class="news-card-img">
                    <img src="<?= e($n['image']) ?>" alt="" loading="lazy">
                </div>
                <div class="news-card-body">
                    <span class="news-date"><?= e($n['date']) ?></span>
                    <h3><?= e($n['title']) ?></h3>
                    <p><?= e($n['summary']) ?></p>
                    <span class="read-more">Lees meer &rarr;</span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Contact-band -->
<section class="cta-band">
    <div class="container center">
        <h2>Een bouwplan of ontwerpvraag?</h2>
        <p>Van initiatief tot en met oplevering &mdash; wij denken graag met u mee.</p>
        <a class="btn btn-light" href="contact.php">Neem contact op</a>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

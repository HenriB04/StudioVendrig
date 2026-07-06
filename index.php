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
        projecten, van woningbouw tot gezondheidszorg, van aanbouw en verbouw tot nieuwbouw.
        Altijd met knowhow op het gebied van bouwkunst, bouwtechniek en projectmanagement.</p>
        <a class="btn btn-outline" href="studio.php">Over de studio</a>
    </div>
</section>

<!-- Scrollanimatie: een huis dat wordt opgebouwd terwijl je scrollt -->
<section class="bouw-section" id="bouwSection">
    <div class="bouw-sticky">
        <div class="container center">
            <p class="section-kicker">Van schets tot sleutel</p>
            <h2>Zo bouwen wij uw droom</h2>
            <div class="bouw-fases">
                <span class="bouw-fase bouw-fase-0">Ontwerp</span>
                <span class="bouw-fase bouw-fase-1">Technische uitwerking</span>
                <span class="bouw-fase bouw-fase-2">Realisatie</span>
            </div>
        </div>
        <svg id="huisSvg" viewBox="0 0 800 500" xmlns="http://www.w3.org/2000/svg" aria-label="Van schets via technische tekening naar gebouwd huis">
            <!-- Vlakken die bij de oplevering inkleuren -->
            <g class="huis-vlakken" opacity="0">
                <rect x="240" y="270" width="320" height="160" fill="#ffffff"/>
                <polygon points="215,288 400,155 585,288" fill="#ece6dd"/>
                <rect x="330" y="330" width="60" height="100" fill="#0066b3" opacity=".85"/>
                <rect x="255" y="340" width="60" height="70" fill="#dcebf6"/>
                <rect x="430" y="340" width="90" height="70" fill="#dcebf6"/>
                <rect x="375" y="205" width="50" height="50" fill="#dcebf6"/>
                <circle cx="150" cy="340" r="38" fill="#e2e8d9"/>
            </g>

            <!-- Fase 1 · Ontwerp: de schets van de architect (dunne potloodlijnen) -->
            <g class="schets-groep" fill="none" stroke="#a9a294" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path class="huis-pad" data-van="0"   data-tot=".07" d="M80 430 H720"/>
                <path class="huis-pad" data-van=".05" data-tot=".15" d="M240 430 V270 M560 430 V270 M215 288 L400 155 L585 288"/>
                <path class="huis-pad" data-van=".13" data-tot=".21" d="M330 430 V330 H390 V430 M255 340 H315 V410 H255 Z M430 340 H520 V410 H430 Z"/>
                <path class="huis-pad" data-van=".19" data-tot=".27" d="M375 205 H425 V255 H375 Z M470 207 V150 H504 V232"/>
            </g>

            <!-- Fase 2 · Technische uitwerking: maatvoering op de tekening (blauw) -->
            <g class="maat-groep" fill="none" stroke="#0066b3" stroke-width="1.5" stroke-linecap="round">
                <path class="huis-pad" data-van=".30" data-tot=".38" d="M240 452 v16 M560 452 v16 M240 460 H560"/>
                <path class="huis-pad" data-van=".36" data-tot=".44" d="M604 430 h16 M604 270 h16 M612 430 V270"/>
                <path class="huis-pad" data-van=".42" data-tot=".50" d="M400 148 V120 M370 134 h60"/>
                <text class="huis-fade" data-van=".33" data-tot=".41" x="400" y="484" text-anchor="middle" fill="#0066b3" stroke="none" font-family="Jost, sans-serif" font-size="19" opacity="0">8.400</text>
                <text class="huis-fade" data-van=".39" data-tot=".47" x="630" y="355" fill="#0066b3" stroke="none" font-family="Jost, sans-serif" font-size="19" opacity="0">4.800</text>
                <text class="huis-fade" data-van=".45" data-tot=".53" x="400" y="112" text-anchor="middle" fill="#0066b3" stroke="none" font-family="Jost, sans-serif" font-size="19" opacity="0">nok 9.2m</text>
            </g>

            <!-- Fase 3 · Realisatie: het huis wordt gebouwd, in bouwvolgorde (dikke lijnen) -->
            <g class="bouw-groep" fill="none" stroke="#1c1c1c" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <path class="huis-pad" data-van=".55" data-tot=".62" d="M80 430 H720"/>
                <path class="huis-pad" data-van=".57" data-tot=".62" d="M220 430 v12 h360 v-12"/>
                <path class="huis-pad" data-van=".60" data-tot=".67" d="M240 430 V270"/>
                <path class="huis-pad" data-van=".60" data-tot=".67" d="M560 430 V270"/>
                <path class="huis-pad" data-van=".66" data-tot=".73" d="M215 288 L400 155 L585 288"/>
                <path class="huis-pad" data-van=".72" data-tot=".76" d="M470 207 V150 H504 V232"/>
                <path class="huis-pad" data-van=".75" data-tot=".80" d="M330 430 V330 H390 V430"/>
                <path class="huis-pad" data-van=".78" data-tot=".84" d="M255 340 H315 V410 H255 Z M430 340 H520 V410 H430 Z"/>
                <path class="huis-pad" data-van=".81" data-tot=".86" d="M375 205 H425 V255 H375 Z"/>
                <path class="huis-pad" data-van=".84" data-tot=".89" d="M285 340 V410 M255 375 H315 M475 340 V410 M430 375 H520 M400 205 V255 M375 230 H425"/>
                <circle class="huis-pad" data-van=".87" data-tot=".90" cx="380" cy="385" r="4"/>
                <path class="huis-pad" data-van=".88" data-tot=".93" d="M150 430 V378"/>
                <circle class="huis-pad" data-van=".89" data-tot=".94" cx="150" cy="340" r="38"/>
                <path class="huis-pad" data-van=".91" data-tot=".95" d="M625 430 q22 -38 48 0 M665 430 q18 -28 38 0"/>
            </g>
        </svg>
        <p class="bouw-klaar">Oplevering</p>
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
        <p>Van initiatief tot en met de oplevering denken wij graag met u mee.</p>
        <a class="btn btn-light" href="contact.php">Neem contact op</a>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

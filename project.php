<?php
require_once __DIR__ . '/includes/functions.php';

$project = project_by_id((int)($_GET['id'] ?? 0));
if (!$project) {
    http_response_code(404);
    $pageTitle = 'Project niet gevonden';
    require __DIR__ . '/includes/header.php';
    echo '<section class="section"><div class="container center"><h1>Project niet gevonden</h1>'
       . '<p class="lead">Het opgevraagde project bestaat niet.</p>'
       . '<a class="btn btn-outline" href="projecten.php">Terug naar projecten</a></div></section>';
    require __DIR__ . '/includes/footer.php';
    exit;
}

$pageTitle = $project['title'];
require __DIR__ . '/includes/header.php';
?>

<?php if ($project['images']): ?>
<section class="project-hero" style="background-image:url('<?= e($project['images'][0]['file']) ?>')">
    <div class="hero-overlay"></div>
    <div class="project-hero-content">
        <span class="project-card-cat on-dark"><?= e($project['category']) ?></span>
        <h1><?= e($project['title']) ?></h1>
    </div>
</section>
<?php else: ?>
<section class="page-hero">
    <div class="container">
        <span class="project-card-cat"><?= e($project['category']) ?></span>
        <h1><?= e($project['title']) ?></h1>
    </div>
</section>
<?php endif; ?>

<section class="section">
    <div class="container project-detail">
        <div class="project-info">
            <?php if (trim($project['description']) !== ''): ?>
                <div class="rich-text"><?= $project['description'] ?></div>
            <?php else: ?>
                <div class="rich-text">
                    <p><em>Dit project is momenteel in uitvoering. Meer informatie volgt binnenkort.</em></p>
                </div>
            <?php endif; ?>
            <a class="btn btn-outline" href="projecten.php">&larr; Terug naar projecten</a>
        </div>

        <?php if ($project['images']): ?>
        <div class="project-gallery">
            <?php foreach ($project['images'] as $i => $img): ?>
            <figure class="gallery-item">
                <a href="<?= e($img['file']) ?>" class="gallery-link" data-caption="<?= e($img['name']) ?>">
                    <img src="<?= e($img['file']) ?>" alt="<?= e($img['name']) ?>" loading="lazy">
                </a>
                <?php if ($img['name'] !== ''): ?>
                    <figcaption><?= e($img['name']) ?></figcaption>
                <?php endif; ?>
            </figure>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

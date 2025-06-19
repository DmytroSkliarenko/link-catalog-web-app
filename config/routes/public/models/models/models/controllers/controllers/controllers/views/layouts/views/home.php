<div class="row">
    <div class="col-md-8">
        <h1>Каталог посилань</h1>
        
        <?php if (!empty($tagName)): ?>
            <p class="lead">Фільтр за тегом: <strong><?= htmlspecialchars($tagName) ?></strong></p>
            <a href="/link-catalog/public/" class="btn btn-secondary mb-3">Показати всі</a>
        <?php endif; ?>

        <?php if (empty($links)): ?>
            <div class="alert alert-info">
                Поки що немає доданих посилань.
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($links as $link): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="<?= htmlspecialchars($link['url']) ?>" target="_blank" class="text-decoration-none">
                                        <?= htmlspecialchars($link['title']) ?>
                                    </a>
                                </h5>
                                <p class="card-text"><?= htmlspecialchars($link['description']) ?></p>
                                <small class="text-muted">
                                    Автор: <?= htmlspecialchars($link['author_name'] ?? 'Невідомо') ?> | 
                                    <?= date('d.m.Y H:i', strtotime($link['created_at'])) ?>
                                </small>
                                <?php if ($link['status'] === 'archived'): ?>
                                    <span class="badge bg-warning">Архівне</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="col-md-4">
        <h4>Фільтр за тегами</h4>
        <?php if (empty($tags)): ?>
            <p>Теги ще не додані.</p>
        <?php else: ?>
            <div class="d-flex flex-wrap gap-2">
                <?php foreach ($tags as $tag): ?>
                    <a href="/link-catalog/public/filter?tag=<?= urlencode($tag['name']) ?>" 
                       class="btn btn-outline-primary btn-sm">
                        <?= htmlspecialchars($tag['name']) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

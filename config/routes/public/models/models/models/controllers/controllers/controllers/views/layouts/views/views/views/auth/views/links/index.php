<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Управління посиланнями</h1>
    <a href="/link-catalog/public/admin/links/create" class="btn btn-success">Додати нове посилання</a>
</div>

<?php if (empty($links)): ?>
    <div class="alert alert-info">
        Поки що немає доданих посилань.
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Назва</th>
                    <th>URL</th>
                    <th>Автор</th>
                    <th>Статус</th>
                    <th>Дата створення</th>
                    <th>Дії</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($links as $link): ?>
                    <tr>
                        <td><?= $link['id'] ?></td>
                        <td><?= htmlspecialchars($link['title']) ?></td>
                        <td>
                            <a href="<?= htmlspecialchars($link['url']) ?>" target="_blank" class="text-truncate d-inline-block" style="max-width: 200px;">
                                <?= htmlspecialchars($link['url']) ?>
                            </a>
                        </td>
                        <td><?= htmlspecialchars($link['author_name'] ?? 'Невідомо') ?></td>
                        <td>
                            <?php if ($link['status'] === 'active'): ?>
                                <span class="badge bg-success">Активне</span>
                            <?php else: ?>
                                <span class="badge bg-warning">Архівне</span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d.m.Y H:i', strtotime($link['created_at'])) ?></td>
                        <td>
                            <a href="/link-catalog/public/admin/links/edit?id=<?= $link['id'] ?>" class="btn btn-sm btn-primary">Редагувати</a>
                            <a href="/link-catalog/public/admin/links/delete?id=<?= $link['id'] ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Ви впевнені, що хочете видалити це посилання?')">Видалити</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

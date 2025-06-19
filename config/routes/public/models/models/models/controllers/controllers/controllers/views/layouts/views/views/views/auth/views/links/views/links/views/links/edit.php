<div class="row">
    <div class="col-md-8">
        <h1>Редагувати посилання</h1>
        
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="id" value="<?= $link['id'] ?>">
            
            <div class="mb-3">
                <label for="title" class="form-label">Назва посилання:</label>
                <input type="text" class="form-control" id="title" name="title" 
                       value="<?= htmlspecialchars($link['title']) ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="url" class="form-label">URL:</label>
                <input type="url" class="form-control" id="url" name="url" 
                       value="<?= htmlspecialchars($link['url']) ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Опис:</label>
                <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($link['description']) ?></textarea>
            </div>
            
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Зберегти зміни</button>
                <a href="/link-catalog/public/admin/links" class="btn btn-secondary">Скасувати</a>
            </div>
        </form>
    </div>
</div>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Каталог посилань' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/link-catalog/public/">Каталог посилань</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/link-catalog/public/">Головна</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/link-catalog/public/about">Про додаток</a>
                    </li>
                    <?php if (isAuthenticated()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/link-catalog/public/admin/links">Управління</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <?php if (isAuthenticated()): ?>
                        <li class="nav-item">
                            <span class="navbar-text me-3">Привіт, <?= $_SESSION['username'] ?>!</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/link-catalog/public/logout">Вихід</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/link-catalog/public/login">Вхід</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?= $content ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

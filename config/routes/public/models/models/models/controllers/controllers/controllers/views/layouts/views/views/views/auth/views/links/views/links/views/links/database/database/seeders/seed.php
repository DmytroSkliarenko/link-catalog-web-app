<?php
require_once '../../config/database.php';

// Додати тестового користувача
$hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
$stmt = $db->prepare("INSERT IGNORE INTO users (username, password, email) VALUES (?, ?, ?)");
$stmt->execute(['admin', $hashedPassword, 'admin@example.com']);

// Додати пункти меню
$menuItems = [
    ['Головна', '/link-catalog/public/', 1],
    ['Про додаток', '/link-catalog/public/about', 2]
];

$stmt = $db->prepare("INSERT IGNORE INTO menu_items (title, url, order_index) VALUES (?, ?, ?)");
foreach ($menuItems as $item) {
    $stmt->execute($item);
}

// Додати тестові теги
$tags = ['Освіта', 'Розробка', 'Новини', 'Розваги', 'Спорт'];
$stmt = $db->prepare("INSERT IGNORE INTO tags (name) VALUES (?)");
foreach ($tags as $tag) {
    $stmt->execute([$tag]);
}

// Додати тестові посилання
$links = [
    ['https://google.com', 'Google', 'Найпопулярніша пошукова система', 1],
    ['https://github.com', 'GitHub', 'Платформа для розробників', 1],
    ['https://stackoverflow.com', 'Stack Overflow', 'Питання та відповіді для програмістів', 1],
    ['https://w3schools.com', 'W3Schools', 'Навчальні матеріали з веб-розробки', 1],
    ['https://mozilla.org', 'Mozilla', 'Розробник браузера Firefox', 1]
];

$stmt = $db->prepare("INSERT INTO links (url, title, description, author_id) VALUES (?, ?, ?, ?)");
foreach ($links as $link) {
    $stmt->execute($link);
}

echo "Тестові дані успішно додані!";
?>

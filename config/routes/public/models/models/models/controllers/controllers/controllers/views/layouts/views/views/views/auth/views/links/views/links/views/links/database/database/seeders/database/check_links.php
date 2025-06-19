<?php
require_once '../config/database.php';
require_once '../models/Link.php';

$linkModel = new Link($db);
$links = $linkModel->getAll();

echo "<h2>Перевірка доступності посилань</h2>";

foreach ($links as $link) {
    echo "<p>Перевіряю: " . htmlspecialchars($link['title']) . " (" . htmlspecialchars($link['url']) . ")";
    
    $isActive = $linkModel->checkUrlStatus($link['url']);
    $newStatus = $isActive ? 'active' : 'archived';
    
    if ($link['status'] !== $newStatus) {
        $linkModel->updateStatus($link['id'], $newStatus);
        echo " - <strong>Статус змінено на: $newStatus</strong>";
    } else {
        echo " - Статус залишається: " . $link['status'];
    }
    
    echo "</p>";
}

echo "<p><strong>Перевірка завершена!</strong></p>";
echo '<p><a href="/link-catalog/public/">Повернутися на головну</a></p>';
?>

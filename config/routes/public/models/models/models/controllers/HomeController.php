<?php
require_once '../models/Link.php';
require_once '../models/Tag.php';

function showHome() {
    global $db;
    $linkModel = new Link($db);
    $tagModel = new Tag($db);
    
    $links = $linkModel->getAll();
    $tags = $tagModel->getAll();
    
    $title = "Головна сторінка";
    $content = renderView('../views/home.php', compact('links', 'tags'));
    include '../views/layouts/main.php';
}

function showAbout() {
    $title = "Про додаток";
    $content = renderView('../views/about.php');
    include '../views/layouts/main.php';
}

function showFilteredLinks() {
    global $db;
    $linkModel = new Link($db);
    $tagModel = new Tag($db);
    
    $tagName = $_GET['tag'] ?? '';
    $links = $tagName ? $linkModel->getByTag($tagName) : $linkModel->getAll();
    $tags = $tagModel->getAll();
    
    $title = $tagName ? "Посилання з тегом: $tagName" : "Всі посилання";
    $content = renderView('../views/home.php', compact('links', 'tags', 'tagName'));
    include '../views/layouts/main.php';
}

function renderView($viewPath, $data = []) {
    extract($data);
    ob_start();
    include $viewPath;
    return ob_get_clean();
}
?>

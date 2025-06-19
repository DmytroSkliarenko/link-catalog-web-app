<?php
require_once '../models/Link.php';
require_once '../models/Tag.php';

function showLinksTable() {
    if (!isAuthenticated()) {
        header('Location: /link-catalog/public/login');
        exit;
    }
    
    global $db;
    $linkModel = new Link($db);
    $links = $linkModel->getAll();
    
    $title = "Управління посиланнями";
    $content = renderView('../views/links/index.php', compact('links'));
    include '../views/layouts/main.php';
}

function showCreateLink() {
    if (!isAuthenticated()) {
        header('Location: /link-catalog/public/login');
        exit;
    }
    
    $title = "Додати нове посилання";
    $content = renderView('../views/links/create.php');
    include '../views/layouts/main.php';
}

function processCreateLink() {
    if (!isAuthenticated()) {
        header('Location: /link-catalog/public/login');
        exit;
    }
    
    global $db;
    $linkModel = new Link($db);
    
    $data = [
        'url' => $_POST['url'] ?? '',
        'title' => $_POST['title'] ?? '',
        'description' => $_POST['description'] ?? '',
        'author_id' => $_SESSION['user_id']
    ];
    
    if ($linkModel->create($data)) {
        header('Location: /link-catalog/public/admin/links');
        exit;
    } else {
        $error = "Помилка при створенні посилання";
        $title = "Додати нове посилання";
        $content = renderView('../views/links/create.php', compact('error'));
        include '../views/layouts/main.php';
    }
}

function showEditLink() {
    if (!isAuthenticated()) {
        header('Location: /link-catalog/public/login');
        exit;
    }
    
    global $db;
    $linkModel = new Link($db);
    $id = $_GET['id'] ?? 0;
    $link = $linkModel->getById($id);
    
    if (!$link) {
        header('Location: /link-catalog/public/admin/links');
        exit;
    }
    
    $title = "Редагувати посилання";
    $content = renderView('../views/links/edit.php', compact('link'));
    include '../views/layouts/main.php';
}

function processEditLink() {
    if (!isAuthenticated()) {
        header('Location: /link-catalog/public/login');
        exit;
    }
    
    global $db;
    $linkModel = new Link($db);
    $id = $_POST['id'] ?? 0;
    
    $data = [
        'url' => $_POST['url'] ?? '',
        'title' => $_POST['title'] ?? '',
        'description' => $_POST['description'] ?? ''
    ];
    
    if ($linkModel->update($id, $data)) {
        header('Location: /link-catalog/public/admin/links');
        exit;
    } else {
        $error = "Помилка при оновленні посилання";
        $link = $linkModel->getById($id);
        $title = "Редагувати посилання";
        $content = renderView('../views/links/edit.php', compact('link', 'error'));
        include '../views/layouts/main.php';
    }
}

function processDeleteLink() {
    if (!isAuthenticated()) {
        header('Location: /link-catalog/public/login');
        exit;
    }
    
    global $db;
    $linkModel = new Link($db);
    $id = $_GET['id'] ?? 0;
    
    $linkModel->delete($id);
    header('Location: /link-catalog/public/admin/links');
    exit;
}

function renderView($viewPath, $data = []) {
    extract($data);
    ob_start();
    include $viewPath;
    return ob_get_clean();
}
?>

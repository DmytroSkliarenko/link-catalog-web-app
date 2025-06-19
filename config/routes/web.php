<?php
function handleRoute($uri, $method) {
    switch ($uri) {
        case '/':
        case '':
            require '../controllers/HomeController.php';
            showHome();
            break;
        case '/about':
            require '../controllers/HomeController.php';
            showAbout();
            break;
        case '/login':
            require '../controllers/AuthController.php';
            if ($method === 'POST') {
                processLogin();
            } else {
                showLogin();
            }
            break;
        case '/logout':
            require '../controllers/AuthController.php';
            processLogout();
            break;
        case '/admin/links':
            require '../controllers/LinkController.php';
            showLinksTable();
            break;
        case '/admin/links/create':
            require '../controllers/LinkController.php';
            if ($method === 'POST') {
                processCreateLink();
            } else {
                showCreateLink();
            }
            break;
        case '/admin/links/edit':
            require '../controllers/LinkController.php';
            if ($method === 'POST') {
                processEditLink();
            } else {
                showEditLink();
            }
            break;
        case '/admin/links/delete':
            require '../controllers/LinkController.php';
            processDeleteLink();
            break;
        case '/filter':
            require '../controllers/HomeController.php';
            showFilteredLinks();
            break;
        default:
            http_response_code(404);
            echo "Сторінка не знайдена";
    }
}
?>

<?php
session_start();
require_once '../config/database.php';
require_once '../routes/web.php';

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_uri = str_replace('/link-catalog/public', '', $request_uri);
$request_method = $_SERVER['REQUEST_METHOD'];

handleRoute($request_uri, $request_method);
?>

<?php

use Application\Models\errors\E404Exception;
use Application\Models\errors\E403Exception;

require_once __DIR__ . '/autoload.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = explode('/', $path);

$ctrl = !empty($path[1]) ? ucfirst($path[1]) : 'News';
$ctrl = 'Application\\Controllers\\' . $ctrl . 'Controller';
$act = !empty($path[2]) ? ucfirst($path[2]) : 'ShowAll';
$act = 'action' . $act;
$_GET['id'] = $path[3];

$controller = new $ctrl;
try {
    $controller->$act();
} catch (E404Exception $exc) {
    http_response_code(404);
    $controller->actionShowError($exc->getMessage());
} catch (E403Exception $exc403) {
    http_response_code(403);
    $controller->actionShowError($exc403->getMessage());
}


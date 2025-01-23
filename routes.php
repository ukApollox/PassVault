<?php
$page = basename($_SERVER['REQUEST_URI'] ?? '');

$viewDir = "views";

switch ($page) {
    case 'jamie_test':
    case 'home':
    case 'index':
        require $viewDir . '/home.php';
        break;
    case 'sign-in':
        require $viewDir . '/sign-in.php';
        break;
    case 'sign-up':
        require $viewDir . '/sign-up.php';
        break;
    case 'passwords':
        require $viewDir . '/passwords.php';
        break;
    case 'add-password':
        require $viewDir . '/add-password.php';
        break;
    case 'security':
        require $viewDir . '/security.php';
        break;
    case 'sign-out':
        require 'models/sign-out.php';
        break;
    default:
        http_response_code(404);
        require $viewDir . '/404.php';
}
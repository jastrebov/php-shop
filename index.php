<?php

// Front Controller
// Подключение файлов системы
require_once($_SERVER['DOCUMENT_ROOT'] . '/components/Autoload.php');

// Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();

// Вызов Router
$router = new Router();
$router->run();




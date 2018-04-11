<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';

use \App\Core\NotFound;
use \App\Core\Bootstrap;

$app = new Bootstrap();

try {
    $app->run();
} catch (NotFound $e) {
    require '../errors/404.php';
} catch (Exception $e) {
    echo $e->getMessage();
}

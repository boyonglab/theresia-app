<?php
$app = new \Boyonglab\Theresia\Core\App();

require_once __DIR__ .'/app/config.php';
require_once __DIR__ .'/app/services.php';
require_once __DIR__ .'/app/routes.php';

$app->run();
?>
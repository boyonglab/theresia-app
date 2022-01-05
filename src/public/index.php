<?php

require_once '../app/config.php';
require  '../../vendor/autoload.php';

$app = new \Boyonglab\Theresia\Core\App();


$app->router->get('/', function() use($app) {
   $app->view('welcome');
});

$app->router->get('/{slug}', function($slug) use($app) {
 

});

$app->router->get('/api', function() use($app) {

    $app->json(["msg" => "Welcome"]);

});

$app->router->post('/api', function() use($app) {

    $app->json($app->request->getJson(), 201);

});



 $app->run();
?>

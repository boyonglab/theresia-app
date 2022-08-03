<?php
$app->get('router')->get('/', function() use($app) {
    $app->view('welcome');
 });
 
 $app->get('router')->get('/{slug}', function($slug) use($app) {
   echo "Param: $slug";

 });
 
 $app->get('router')->get('/api', function() use($app, $config) {
     $app->json(["api_key" => $config['api']['key']]);
 });
 
 $app->get('router')->post('/api', function() use($app) {
     $app->json($app->request->getJson(), 201);
 });
?>
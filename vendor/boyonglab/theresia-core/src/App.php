<?php
namespace Boyonglab\Theresia\Core;
use Pimple\Container;



use Boyonglab\Theresia\Core\Http\Request;
use Boyonglab\Theresia\Core\Http\Response;
use Boyonglab\Theresia\Core\Http\Router;
use Boyonglab\Theresia\Core\View\Renderer;
use Boyonglab\Theresia\Core\Config;

class App {
  protected $service;

  public function __construct()
  {
     $this->service = new Container();
     $this->service['request'] = new Request();
     $this->service['response'] = new Response();
     $this->service['router'] = new Router($this->service['request']);
     $this->service['renderer'] = new Renderer();
     $this->service['config'] = new Config();
  }

  public function set($name, $obj) {
    $this->service[$name] = $obj;

  }

  public function get($name) {
    return $this->service[$name];
  }

  public function view($path, $params=[]){
       echo  $this->service['renderer']->html($path, $params);

  }
  
  public function json($data, $status = 200)
  {   
      echo $this->service['response']->json($data, $status);
  }

  public function run()
  {
      try {
        $this->service['router']->run();
      } catch (\Exception $e) {
        if ($e->getMessage() == '404') {
          echo '404';
        }
      }
  }
}

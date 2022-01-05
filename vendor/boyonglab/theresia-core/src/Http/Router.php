<?php
namespace Boyonglab\Theresia\Core\Http;

class Router
{
    /**
     * The request we're working with.
     *
     * @var string
     */
    public $request;

    private $httpMethods = ['get', 'post', 'put', 'delete'];

    /**
     * The $routePaths array will contain our URI's.
     * @var array
     */
    public $routePaths = [];

    // The folling is a list of array containing uri's and callbacks based on request methods.
    public $routes = [];

    /**
     * For this example, the constructor will be responsible
     * for parsing the request.
     *
     * @param array $request
     */
    public function __construct($request)
    {
        /**
         * This is a very (VERY) simple example of parsing
         * the request. We use the $_SERVER superglobal to
         * grab the URI.
         */
        $this->request = $request;
    }

    public function __call($func, $params) {

      if(in_array($func, $this->httpMethods)) {
          $uri = $params[0];
          $pt = stripos ($uri, '{');

          if($pt) {
              $struct = substr($uri, 0, $pt - 1) . str_repeat('/(.*)', substr_count($uri, '{')) ;
              $struct = str_replace('/', '\/', $struct);
              $regx = '/^' . $struct . '/';
              // preg_match($regx, '/survey/ok/good', $output);
              $uri = $regx;
          }

          $this->routes[$func][$uri] = $params[1];

      }

    }

    /**
     * Add a route and callback to our $routes array.
     *
     * @param string   $uri
     * @param Callable $fn
     */
    public function addRoute(string $uri, \Closure $fn) : void
    {
        $this->routes[$uri] = $fn;
    }

    /**
     * Check if  $routes array has method.
     * @return boolean
     */
    public function hasMethod() : bool
    {
       return  array_key_exists($this->request->getMethod(), $this->routes);
    }
/*
    public function get(string $uri, \Closure $fn) : void
    {
        $this->routes['get'][$uri] = $fn;
    }
*/
    /**
     * Determine is the requested route exists in our
     * routes array.
     *
     * @param  string  $uri
     * @return bool
     */
    public function hasRoute(string $uri) : bool
    {
       return  $this->hasMethod() ? 
              array_key_exists($uri, $this->routes[$this->request->getMethod()]) :
              false;
    }

    /**
     * Run the router.
     *
     * @return mixed
     */
    public function run()
    {   
        if(!$this->hasMethod()) {
            throw new \Exception('404');
        }

        if($this->hasRoute($this->request->getPath())) {
            $this->routes[$this->request->getMethod()][$this->request->getPath()]->call($this);
        } else {
          $result = [];
          $keys = array_filter(array_keys($this->routes[$this->request->getMethod()]), function($data) {
            return substr_count($data, '(.*)') > 0;
          });

          foreach($keys as $key) {
              $match = preg_match($key, $this->request->getPath(), $output);
              if($match == 1) {
                $result['uri'] = $key;
                $result['output'] = $output;
                $result['params_count'] = substr_count($key, '(.*)');
              }
          }

          $display = null;
		  
          if (count($result) > 0) {
            $args = $result['output'];
            unset($args[0]);
            $this->routes[$this->request->getMethod()][$result['uri']]->call($this, ...$args);
          } else {
            throw new \Exception('404');
          }
          

        }
    }
}

/**
 * Create a new router instance.
 */
// $router = new Router($_SERVER);

/**
 * Add a "hello" route that prints to the screen.
 */
/*$router->addRoute('hello', function() {
    echo 'Well, hello there!!';
});
*/

/**
 * Run it!
 */
//$router->run();

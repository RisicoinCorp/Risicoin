<?php
/**
 * Router
 * Create and collect routes
 *
 * @package Lib
 */

namespace Router\Router;

use Router\Router\Route,
	Router\Router\Request as Req,
	Router\Router\Response as Res,
	Router\Exceptions\RouterException as RException;

class Router {

	/**
	 * Routes collector
	 * @var Array
	 */
	private $routes = array();

	/**
	 * Parameters
	 * @var Array
	 */
	private $params = array(
		'BASE_URL' => '/',
		'CASE_SENSITIVE' => false
	);

	/**
	 * Callable for 400 error (Bad Request)
	 * @var Closure
	 */
	private $err400;

	/**
	 * Callable for 404 error (Not Found)
	 * @var Closure
	 */
	private $err404;

	/**
	 * Callable for 405 error (Method Not Allowed)
	 * @var Closure
	 */
	private $err405;


	/**
	 * Constructor of the router, the routes collector
	 * @param Array $params (CASE_SENSITIVE)
	 * @return void
	 */
	public function __construct($params = null) {

		$this->err400 = function(Req $req, Res $res) {
			$res->setStatus(400);
			echo '<h1>Bad Request</h1><p>Your browser sent a request that this server could not understand ('.$req->getMethod().'). Additionnaly, the requested URL was not found.</p>';
		};

		$this->err404 = function(Req $req, Res $res) {
			$res->setStatus(404);
			echo '<h1>Not Found</h1><p>The requested URL '.$req->getUri().' was not found on this server.</p>';
		};

		$this->err405 = function(Req $req, Res $res) {
			$res->setStatus(405);
			echo '<h1>Method Not Allowed</h1><p>The requested method '.$req->getMethod().' is not allowed for URL '.$req->getPath().'.</p>';
		};

		if(!$params) return;
		
		foreach($params as $key => $value) {
			$this->setParam($key, $value);
		}

	}


	/**
	 * Set a parameter of the router
	 * @param String $key
	 * @param mixed $value
	 * @return Router
	 *
	 * @throws RouterException
	 */
	public function setParam( $key, $value) {

		if($key == '400' || $key == '404' || $key == '405') {
			if(!is_callable($value))
				throw new RException('Need a closure or a callback function in second parameter.');
		}
		
		switch ($key) {
			case '400':
				$this->err400 = $value;
				break;
			case '404':
				$this->err404 = $value;
				break;
			case '405':
				$this->err405 = $value;
				break;
			default:
				$this->params[$key] = $value;
				break;
		}

		return $this;

	}


	/**
	 * Get the parameter of the router
	 * @param String
	 * @return mixed
	 */
	public function getParam($key) {

		switch ($key) {
			case '400':
				return $this->err400;
			case '404':
				return $this->err404;
			case '405':
				return $this->err405;
			default:
				return $this->params[$key];
		}

	}

	/**
	 * Routing
	 */

	/**
	 * Create and collect a new Route with HEAD request
	 * @param String $path
	 * @param mixed $callback callback or closure function
	 * @return Route
	 *
	 * @throws RouteException If the second parameter isn't a closure or a callable
	 */
	public function head($path, $callback) {

		if(!is_callable($callback))
			throw new RException('Need a closure or a callback function in second parameter.');

		$route = new Route('HEAD', $path, $callback);
		array_push($this->routes, $route);

		return $route;

	}


	/**
	 * Create and collect a new Route with GET request
	 * @param String $path
	 * @param mixed $callback callback or closure function
	 * @return Route
	 *
	 * @throws RouteException If the second parameter isn't a closure or a callable
	 */
	public function get( $path, $callback)  {

		if(!is_callable($callback))
			throw new RException('Need a closure or a callback function in second parameter.');

		$route = new Route('GET', $path, $callback);
		array_push($this->routes, $route);

		return $route;

	}


	/**
	 * Create and collect a new Route with POST request
	 * @param String $path
	 * @param mixed $callback callback or closure function
	 * @return Route
	 *
	 * @throws RouteException If the second parameter isn't a closure or a callable
	 */
	public function post( $path, $callback)  {

		if(!is_callable($callback))
			throw new RException('Need a closure or a callback function in second parameter.');

		$route = new Route('POST', $path, $callback);
		array_push($this->routes, $route);

		return $route;

	}


	/**
	 * Create and collect a new Route with PUT request
	 * @param String $path
	 * @param mixed $callback callback or closure function
	 * @return Route
	 *
	 * @throws RouteException If the second parameter isn't a closure or a callable
	 */
	public function put($path, $callback)  {

		if(!is_callable($callback))
			throw new RException('Need a closure or a callback function in second parameter.');

		$route = new Route('PUT', $path, $callback);
		array_push($this->routes, $route);

		return $route;

	}


	/**
	 * Create and collect a new Route with DELETE request
	 * @param String $path
	 * @param mixed $callback callback or closure function
	 * @return Route
	 *
	 * @throws RouteException If the second parameter isn't a closure or a callable
	 */
	public function delete($path, $callback) {

		if(!is_callable($callback))
			throw new RException('Need a closure or a callback function in second parameter.');

		$route = new Route('DELETE', $path, $callback);
		array_push($this->routes, $route);

		return $route;

	}


	/**
	 * Create routes with other methods and the same path
	 * @param String $path
	 * @param Array $methods
	 * @example $routes = $app->route('/', [
	 *				['GET',  function($req, $res){}],
	 *				['POST', function($req, $res){}]
	 *			]);
	 * @return Array The same order in the array $methods
	 *
	 * @throws RouteException If the parameter in array aren't a closure or a callable
	 */
	public function route( $path,  $methods)  {

		$return = array();

		foreach($methods as $each) {
			if(!is_string($each['0']) && !is_callable($each['1']))
				throw new RException('Need a path and a function in parameters : Router::route($path, [[$method, $callable],...])');
			$route = new Route($each['0'], $path, $each['1']);
			array_push($return, $route);
			array_push($this->routes, $route);
		}

		return $return;

	}


	/**
	 * Load a JSON file and create routes
	 * @param String $path
	 * @return Router
	 *
	 * @throws RouteException
	 */
	public function load( $path) {

	}
	

	/**
	 * Run the router, use the route asked
	 * @param void
	 * @return void
	 *
	 * @throws RouteException
	 */
	public function run() {

		$case = $this->getParam('CASE_SENSITIVE');
		$method = Req::getMethod();
		$url = rtrim($this->getParam('BASE_URL'), '/') . Req::getPath();

		$found = false;

		foreach($this->routes as $route) {
			if($route->match($url, $case) && $method == $route->getMethod()) {
				$route->call();
				$found = true;
				break;
			}
		}

		if(!$found) {
			$methods = array();
			$methodsDefault = ['GET', 'HEAD', 'POST', 'PUT', 'DELETE'];

			foreach($this->routes as $route) {
				array_push($methods, $route->getMethod());

				if($route->match($url, $case) && $method != $route->getMethod()) {
					call_user_func($this->err405, new Req([]), new Res);
					return;
				}
			}

			if(!in_array($method, $methods) && !in_array($method, $methodsDefault))
				call_user_func($this->err400, new Req([]), new Res);
			else
				call_user_func($this->err404, new Req([]), new Res);
		}

	}

}
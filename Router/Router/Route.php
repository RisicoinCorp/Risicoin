<?php
/**
 * Instances of routes
 *
 * @package Lib
 */

namespace Router\Router;

use Router\Router\Route,
	Router\Router\Request as Req,
	Router\Router\Response as Res;

class Route {

	/**
	 * Request method
	 * @var String
	 */
	private $method;


	/**
	 * URL, path
	 * @var String
	 */
	private $url;


	/**
	 * URL, path
	 * @var String
	 */
	private $callable;


	/**
	 * Parameters (matches) used for the callback
	 * @var Array
	 */
	private $slugs = array();


	/**
	 * Regex for the parameters => regex()
	 * Stocked in the same order as the parameters in the URL
	 * @var Array
	 */
	private $regex = array();


	/**
	 * Constructor
	 * @param void
	 * @return void
	 */
	public function __construct( $method,  $url,  $callback) {

		$this->method = $method;
		$this->url = $url;
		$this->callable = $callback;

	}


	/**
	 * Return the request method of the route
	 * @param void
	 * @return String
	 */
	public function getMethod() {

		return $this->method;

	}


	/**
	 * Return the path of the route
	 * @param void
	 * @return String
	 */
	public function getPath() {

		return $this->url;

	}


	/**
	 * Call the callback function of the route
	 * @param mixed
	 * @return void
	 */
	public function call() {

		call_user_func_array($this->callable, array(
			new Req($this->slugs),
			new Res()
		));

	}


	/**
	 * Add arguments for the parameters in the URL like if he must be an integer
	 * @param String $regex
	 * @return Route
	 */
	public function regex($regex) {

		array_push($this->regex, $regex);

		return $this;
		
	}


	/**
	 * Parse a regex  : delete if needed the first and last character and add parenthesis
	 * @param String $reg
	 * @return String
	 */
	private function preg( $reg)  {

		if($reg['0'] == $reg[strlen($reg)-1] && ($reg['0'] == '/' || $reg['0'] == '#'))
			$reg = trim($reg, $reg['0']);
		if($reg['0'] != '(')
			$reg = '('.$reg;
		if($reg[strlen($reg)-1] != ')')
			$reg .= ')';
		return $reg;

	}


	/**
	 * Match the parameters in the URL
	 * @param String $url
	 * @param Boolean $case Case sensitive
	 * @return Boolean
	 */
	public function match( $url,  $case) {

		if($case) 	$case = '';
		else 		$case = 'i';

		//Parameters name
		preg_match_all('/{([\w]+)}/', $this->url, $params);
		$params = $params['1'];

		//Replace default regex and brackets
		$path = preg_replace('/{([\w]+)}/', '([^/{}]+)', $this->url);
		$path = str_replace('\{', '{', $path);
		$path = str_replace('\}', '}', $path);

		//Add the regex if needed (regex array and params array not empty)
		$isNotEmpty = !empty($this->regex) || !empty($params);
		if($isNotEmpty) {
			//Explode the path
			$arrayPath = explode('([^/{}]+)', $path);
			$c = count($arrayPath);
			$path = '';

			//Between each '([^/{}]+)' add the path and the regex
			for($i = 0; $i<$c; $i++) {
				$path .= $arrayPath[$i];

				//The end of the path exploded is ""
				if($c-1 != $i) {
					if(isset($this->regex[$i]))
						$path .= $this->preg($this->regex[$i]);
					elseif(empty($this->regex))
						$path .= '([^/{}]+)';
					else
						$path .= $this->preg($this->regex[0]);
				}
			}
		}

		//Create global regex to match url
		$reg = "#^$path$#$case";

		if(!preg_match($reg, $url, $matches))
			return false;

		//Create an array with the parameters name and the value
		if($isNotEmpty) {
			array_shift($matches);
			$c = count($params);

			for($i = 0; $i<$c; $i++) {
				$slugs[$params[$i]] = $matches[$i];
			}
		} else
			$slugs = array();

		$this->slugs = $slugs;

		return true;

	}
	
}
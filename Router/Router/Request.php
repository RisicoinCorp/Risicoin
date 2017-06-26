<?php
/**
 * listening, listing requests
 *
 * @package Lib
 */

namespace Router\Router;

class Request {

	/**
	 * Parameters in URL used with the route
	 * @var Array
	 */
	private $slugs = array();


	/**
	 * Constructor
	 * @param Array
	 * @return void
	 */
	public function __construct( $slugs) {

		$this->slugs = $slugs;

	}


	/**
	 * Return an array of parameters sent
	 * @param void
	 * @return array
	 */
	private function getBodyParams()  {

		$body = explode('&', $this->getBody());

		foreach($body as $value) {
			$values = explode('=', $value);

			if(isset($values['1']) && $values['0'] != '') 
				$return[$values['0']] = $values['1'];

			elseif($values['0'] != '')
				$return[$values['0']] = '';
		}

		return $return;

	}


	/**
	 * Return the value of the key, or an array ; if doesn't exist return null
	 * @param mixed
	 * @return mixed
	 */
	public function getBodyParam($param = null) {

		if(isset($param) && isset($this->getBodyParams()[$param]))
			return $this->getBodyParams()[$param];

		elseif(isset($param) && !isset($this->getBodyParams()[$param]))
			return;

		else
			return $this->getBodyParams();

	}


	/**
	 * Return if the parameter exists
	 * @param String
	 * @return bool
	 */
	public function is_bodyParam($param) {

		return isset($this->getBodyParams()[$param]);

	}


	/**
	 * Return the body request
	 * @param void
	 * @return String
	 */
	public function getBody() {

		return file_get_contents('php://input');

	}


	/**
	 * Return the value of the key, or an array ; if doesn't exist return null
	 * @param mixed
	 * @return mixed
	 */
	public function getFileParam($param = null) {

		if(isset($param) && isset($_FILES[$param]))
			return $_FILES[$param];

		elseif(isset($param) && !isset($_FILES[$param]))
			return;

		else
			return $_FILES;

	}


	/**
	 * Return only the path in the site
	 * @param void
	 * @return String
	 * @static
	 */
	public static function getPath() {

		return explode('?', urldecode($_SERVER['REQUEST_URI']))['0'];

	}


	/**
	 * Return the URI
	 * @param void
	 * @return String
	 */
	public function getUri() {

		return urldecode($_SERVER['REQUEST_URI']);

	}


	/**
	 * Return the value of the key, or an array ; if doesn't exist return null
	 * @param mixed
	 * @return mixed
	 */
	public function getUrlParam($param = null) {

		if(isset($param) && isset($_GET[$param]))
			return $_GET[$param];

		elseif(isset($param) && !isset($_GET[$param]))
			return;

		else
			return $_GET;

	}


	/**
	 * Return if the parameter in the URL exists
	 * @param String
	 * @return bool
	 */
	public function is_urlParam($param) {

		return isset($_GET[$param]);

	}


	/**
	 * Return the value of the slug
	 * @param String
	 * @return mixed
	 */
	public function getRouteParam($slug = null) {

		if(isset($slug) && isset($this->slugs[$slug]))
			return $this->slugs[$slug];

		elseif(isset($slug) && !isset($this->slugs[$slug]))
			return;

		else
			return $this->slugs;

	}


	/**
	 * Return the method used
	 * @param void
	 * @return String
	 * @static
	 */
	public static function getMethod()  {

		return $_SERVER['REQUEST_METHOD'];

	}


	/**
	 * Return the value of the key, or an array of the requests headers sent; if doesn't exist return null
	 * @param mixed
	 * @return mixed
	 */
	public function getHeader($param = null) {

		if(isset($param) && isset(getallheaders()[$param]))
			return getallheaders()[$param];

		elseif(isset($param) && !isset($_GET[$param]))
			return;

		else
			return getallheaders();

	}


	/**
	 * See if a header sent exists
	 * @param String
	 * @return bool
	 */
	public function has_header( $header) {

		foreach(getallheaders() as $head => $value) {
			if($head == $header)
				return true;
		}
		return false;

	}


	/**
	 * Return the user agent 
	 * @param void
	 * @return String
	 */
	public function getUserAgent() {

		return $_SERVER['HTTP_USER_AGENT'];

	}


	/**
	 * Return the HTTP protocol
	 * @param void
	 * @return String
	 * @static
	 */
	public static function getProtocol() {

		return $_SERVER['SERVER_PROTOCOL'];

	}


	/**
	 * Return the request time of the beginning of the request
	 * @param void
	 * @return int
	 */
	public function getTime() {

		return $_SERVER['REQUEST_TIME'];

	}


	/**
	 * See if a header XHR is sent
	 * @param void
	 * @return bool
	 */
	public function is_ajax() {

		return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XmlHttpRequest');
	
	}


	/**
	 * Return the IP of the client
	 * @param void
	 * @return String
	 * @static
	 */
	public static function getIp()  {

		return $_SERVER['HTTP_CLIENT_IP'] ? $_SERVER['HTTP_CLIENT_IP'] : ($_SERVER['HTTP_X_FORWARDED_FOR'] ? $_SERVER['HTTP_X_FORWARDED_FOR'] : ($_SERVER['REMOTE_ADDR'] ? $_SERVER['REMOTE_ADDR'] : '::1'));
	
	}


	/**
	 * Return the value of the key, or an array of the cookies sent; if doesn't exist return null
	 * @param mixed
	 * @return mixed
	 */
	public function getCookie($param = null) {

		if(isset($param) && isset($_COOKIE[$param]))
			return $_COOKIE[$param];

		elseif(isset($param) && !isset($_COOKIE[$param]))
			return;

		else
			return $_COOKIE;

	}


	/**
	 * See if a cookie sent exists
	 * @param String $param
	 * @return bool
	 */
	public function has_cookie( $param) {

		foreach($_COOKIE as $cookie => $value) {
			if($cookie == $param)
				return true;
		}
		return false;

	}


	/**
	 * Return the value of the key, or an array of the cookie session; if doesn't exist return null
	 * @param mixed
	 * @return mixed
	 */
	public function getSession($param = null) {

		if(isset($param) && isset($_SESSION[$param]))
			return $_SESSION[$param];

		elseif(isset($param) && !isset($_SESSION[$param]))
			return;

		else
			return $_SESSION;

	}


	/**
	 * See if a session parameter sent exists
	 * @param String $param
	 * @return bool
	 */
	public function has_session( $param) {

		foreach($_SESSION as $sesskey => $value) {
			if($sesskey == $param)
				return true;
		}
		return false;

	}

}
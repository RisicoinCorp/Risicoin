<?php
/**
 * Send responses
 *
 * @package Lib
 */

namespace Router\Router;

use Router\Router\Request;

class Response {

	/**
	 * Status codes
	 * @var Array
	 */
	private $status_codes = array(
		//Information
		'100' => 'Continue',
		'101' => 'Switching Protocols',
		'102' => 'Processing',
		//Success
		'200' => 'OK',
		'201' => 'Created',
		'202' => 'Accepted',
		'203' => 'Non-Authoritative',
		'204' => 'No Content',
		'205' => 'Reset Content',
		'206' => 'Partial Content',
		'207' => 'Multi-Status',
		'210' => 'Content Different',
		'226' => 'IM Used',
		//Redirection
		'300' => 'Multiple Choices',
		'301' => 'Moved Permanently',
		'302' => 'Moved Temporarily',
		'303' => 'See Other',
		'304' => 'Not Modified',
		'305' => 'Use Proxy',
		'306' => '',
		'307' => 'Temporary Redirect',
		'308' => 'Permanent Redirect',
		'310' => 'Too many Redirects',
		//Client error
		'400' => 'Bad Request',
		'401' => 'Unauthorized',
		'402' => 'Payment Required',
		'403' => 'Forbidden',
		'404' => 'Not Found',
		'405' => 'Method Not Allowed',
		'406' => 'Not Acceptable',
		'407' => 'Proxy Authentication Required',
		'408' => 'Request Time-out',
		'409' => 'Conflict',
		'410' => 'Gone',
		'411' => 'Length Required',
		'412' => 'Precondition Failed',
		'413' => 'Request Entity Too Large',
		'414' => 'Request-URI Too Long',
		'415' => 'Unsupported Media Type',
		'416' => 'Requested range unsatisfiable',
		'417' => 'Expectation failed',
		'418' => 'I’m a teapot',
		'421' => 'Bad mapping / Misdirected Request',
		'422' => 'Unprocessable entity',
		'423' => 'Locked',
		'424' => 'Method failure',
		'425' => 'Unordered Collection',
		'426' => 'Upgrade Required',
		'428' => 'Precondition Required',
		'429' => 'Too Many Requests',
		'431' => 'Request Header Fields Too Large',
		'449' => 'Retry With',
		'450' => 'Blocked by Windows Parental Controls',
		'451' => 'Unavailable For Legal Reasons',
		//Server error
		'500' => 'Internal Server Error',
		'501' => 'Not Implemented',
		'502' => 'Bad Gateway ou Proxy Error',
		'503' => 'Service Unavailable',
		'504' => 'Gateway Time-out',
		'505' => 'HTTP Version not supported',
		'506' => 'Variant also negociate',
		'507' => 'Insufficient storage',
		'508' => 'Loop detected',
		'509' => 'Bandwidth Limit Exceeded',
		'510' => 'Not extended',
		'511' => 'Network authentication required',
		'520' => 'Web server is returning an unknown error'
	);


	/**
	 * Send HTTP header for the response
	 * @param array $param key + value
	 * @example setHeader(['Location' => '/']);
	 * @return Response
	 */
	public static function setHeader( $param) {

		foreach($param as $key => $value)
			header("$key: $value");
		return $this;

	}


	/**
	 * Redirection
	 * @param String link
	 * @return Response
	 */
	public function redirect( $param) {

		header('Location: '.$param);
		return $this;

	}


	/**
	 * Send an HTTP status
	 * @param int
	 * @return Response
	 */
	public function setStatus( $code) {

		foreach($this->status_codes as $key => $value) {
			if($key == $code)
				header(Request::getProtocol() . ' ' . $key . ' ' . $value);
		}
		return $this;

	}


	/**
	 * Set session variables
	 * @param array $param key + value
	 * @example setSession(['age' => '15']);
	 * @return Response
	 */
	public function setSession( $param) {

		foreach($param as $key => $value)
			$_SESSION[$key] = $value;
		return $this;

	}


	/**
	 * Unset a session variable
	 * @param mixed $key
	 * @return true if succeded
	 */
	public function unsetSession($key) {

		if(isset($_SESSION[$key])) {
			unset($_SESSION[$key]);
			return true;
		} else {
			return false;
		}

	}


	/**
	 * Destroy the current session
	 * @param void
	 * @return Response
	 */
	public function destroySession() {

		session_unset();
		session_destroy();

		return $this;

	}


	/**
	 * Send a cookie header
	 * @param String $name
	 * @param mixed $value 												 Default = null
	 * @param int $expiration	Expiration date (timestamp)				 Default = 0
	 * @param String $path		Path of the site were the cookie is used Default = '/'
	 * @param String domain		Domain were the cookie is used (site)	 Default = ''
	 * @param bool $secure		If the cookie is used with HTTPS 		 Default = false
	 * @param bool $httponly	Accessible only through HTTP 			 Default = true
	 *
	 * @example Response::setCookie('cookie', 'foo', time()+60*60*24, '/', 'example.com', false, true);
	 */
	public function setCookie( $name, $value = null, $expiration = 0, $path = '/', $domain = '', $secure = false, $httponly = true) {

		setcookie($name, $value, $expiration, $path, $domain, $secure, $httponly);

		return $this;

	}

}
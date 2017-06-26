<?php
/**
 * Kernel of the framework
 *
 * @package Lib
 */

namespace Router;

abstract class Kernel {

	/**
	 * Autoloader for loading classes
	 * @param String
	 * @return void
	 * @static
	 */
	private static function autoloader($class) {

		$thisClass = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
		$baseDir = rtrim(__DIR__, '/');
		$class = ltrim($class, '\\');

		if(substr($baseDir, -strlen($thisClass)) === $thisClass) {
			$baseDir = substr($baseDir, 0, -strlen($thisClass));
			$baseDir = rtrim($baseDir, DIRECTORY_SEPARATOR);
		}

		$last = strripos($baseDir, DIRECTORY_SEPARATOR);
		$baseDir = substr($baseDir, 0, $last) . DIRECTORY_SEPARATOR;

		$classLoad = $baseDir;
		$namespace = '';

		if($last = strripos($class, '\\')) {
			$namespace  = substr($class, 0, $last);
			$class      = substr($class, $last + 1);
			$classLoad .= str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
		}

		$classLoad .= str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';

		if(file_exists($classLoad))
			require $classLoad;

	}


	/**
	 * Registerer for the autoloader, start session
	 * @param void
	 * @return void
	 * @static
	 */
	public static function run() {

		session_start();
		spl_autoload_register(__NAMESPACE__ . '\\Kernel::autoloader');

	}

}

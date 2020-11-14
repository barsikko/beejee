<?php 

namespace BeeJee\Core;

use BeeJee\Controller\IndexController;

class Router
{
	static function route()
	{

		$routes = explode('/', $_SERVER['REQUEST_URI']);

		if (preg_match('/\?.+/', $routes[1])){
			$routes[1] = preg_replace('/\?.+/', '', $routes[1]);
		}

		if (empty($routes[1])){
			(new IndexController)->index();
			die();
		} 

		$controller_object = 'BeeJee\Controller\\'.ucfirst($routes[1]).'Controller';

		$action = (empty($routes[2])) ? 'index' : $routes[2];


		if (class_exists($controller_object))
		{
			$controller = new $controller_object();
		} 
		if (method_exists($controller_object, $action)){
				$controller->$action();
				}
		else static::error404();

	}

	static function error404()
	{
		print_r('Ошибка нет такой страницы');

		return header('HTTP/1.1 404 Not Found');
	}

}
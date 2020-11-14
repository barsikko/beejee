<?php 

namespace BeeJee\Core;

class View
{
	public static function render($file, $args = [], $links = [])
	{
		session_start();
		ob_start();
		$auth = static::Auth();
		require('BeeJee/Views/base.php');
		require('BeeJee/Views/'.$file.'.php');
		ob_end_flush();	
	}

	public static function redirect($adr)
	{
		return header('Location: '.$adr);
	}

	private static function Auth(){
		if (isset($_SESSION['name']) && $_SESSION['name'] == 'admin'){
			return true;
		} else return false;
	}
}


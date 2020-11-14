<?php 

namespace BeeJee\Controller;

use BeeJee\Core\Controller;

class LoginController extends Controller
{

	public function index(){
		$this->view::render('login');
	}

	public function login() {
		$login = $_POST['login'];
		$password = $_POST['password'];

		if ($login == 'admin' && $password == '123')
		{
			session_start();
			$_SESSION['name'] = $login;
			$this->view::redirect('/');
		} else {	
			session_start();
			$_SESSION['error'] = 'неверный логин или пароль';
			$this->view::redirect('/login');
		}
	}

	public function logout() {
		session_start();
		unset($_SESSION['name']);
		$this->view::redirect('/');
	}
}
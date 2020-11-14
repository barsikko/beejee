<?php 

namespace BeeJee\Controller;

use BeeJee\Core\Controller;
use BeeJee\Helpers\Pagination;

class IndexController extends Controller
{


	public function index()
	{
	
		$countPages = $this->data->getCount();
		$currPage = $_GET['page'] ?? 1;

		$links = new Pagination($countPages, $currPage, 3, '?page=');

		$data = $this->data::showTasks($_GET);

		$this->view::render('index', $data, $links);
	}

	public function add()
	{
		$data = [
			'login' => trim(htmlspecialchars($_POST['login'])),
			'email' => trim(htmlspecialchars($_POST['email'])),
			'task_name' => trim(htmlspecialchars($_POST['task_name']))
		];

		$this->data::addData($data);

		session_start();
		$_SESSION['success'] = 'Запись добавлена';
		$this->view::redirect('/');
	}

	public function update()
	{
		$data = [
			'id' => (int)$_POST['id'],
			'login' => trim(htmlspecialchars($_POST['login'])),
			'email' => trim(htmlspecialchars($_POST['email'])),
			'task_name' => trim(htmlspecialchars($_POST['task_name'])),
			'verified' => (isset($_POST['checked']) && $_POST['checked'] == 'on') ? 1 : 0 ];

		session_start();		
		if ($_SESSION['name'] == 'admin'){
			$this->data::updateData($data);
			$this->view::redirect('/');
		} else {
			$_SESSION['error'] = 'Вы не авторизованы';
			$this->view::redirect('/login');
		}
	
	}

}
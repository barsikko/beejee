<?php 

namespace BeeJee\Core;

use BeeJee\Core\View;
use BeeJee\Models\Data;



abstract class Controller 
{
	public $view; 
	public $data;

	public function __construct()
	{
		$this->view = new View();
		$this->data = new Data();

	}
}
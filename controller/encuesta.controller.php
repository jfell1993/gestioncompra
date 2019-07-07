<?php
require_once 'model/menu.php';

class EncuestaController
{

	public function __CONSTRUCT()
	{
		$this->model_men = new Menu();
	}

	public function Index()
	{
	    session_start();
	    require_once 'view/header.php';
	    require_once 'view/menu.php';
	    require_once 'view/form_encuesta.php';
	    require_once 'view/footer.php';
	}

}
?>

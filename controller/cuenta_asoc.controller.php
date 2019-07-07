<?php
require_once 'model/menu.php';
require_once 'model/cuenta.php';
require_once 'model/cuenta_asoc.php';
require_once 'model/centro_costo.php';

class Cuenta_asocController
{

	public function __CONSTRUCT()
	{
		$this->model_men = new Menu();
		$this->model_cue = new Cuenta();
		$this->model_cue_asoc = new Cuenta_asoc();
		$this->model_cec = new centro_costo();
	}

	public function Index()
	{
		session_start();
		if ($_SESSION['perfil'] == 3) {
		    require_once 'view/header.php';
		    require_once 'view/menu.php';
		    require_once 'view/list_cuenta_asoc.php';
		    require_once 'view/footer.php';
		} else {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/access_denied.php';
			require_once 'view/footer.php';
		}
	}

	public function Form_cuenta_asoc()
	{
		session_start();
		if ($_SESSION['perfil'] == 3) {
			require_once 'view/header.php';
		    require_once 'view/menu.php';
		    require_once 'view/form_cuenta_asoc.php';
		    require_once 'view/footer.php';
		} else {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/access_denied.php';
			require_once 'view/footer.php';
		}
	}


	public function Add()
	{
		$cue_asoc = new Cuenta_asoc();
		$cue_asoc->id_cuenta = $_REQUEST['ddl_cuenta_asoc'];
		$cue_asoc->id_centro_costo = $_REQUEST['ddl_centro_costo_asoc'];
		$this->model_cue_asoc->Insert($cue_asoc);
	}

	public function Delete()
	{
		$this->model_cue_asoc->Delete($_REQUEST['id']);
	}

}
?>
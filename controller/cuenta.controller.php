<?php
require_once 'model/menu.php';
require_once 'model/cuenta.php';

class CuentaController
{

	public function __CONSTRUCT()
	{
		$this->model_men = new Menu();
		$this->model_cue = new Cuenta();
	}

	public function Index()
	{
		session_start();
		if($_SESSION['perfil'] == 3) 
		{
		    require_once 'view/header.php';
		    require_once 'view/menu.php';
		    require_once 'view/list_cuenta.php';
		    require_once 'view/footer.php';
		} 
		else 
		{
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/access_denied.php';
			require_once 'view/footer.php';
		}
	}

	public function Form_cuenta()
	{
		session_start();
		if ($_SESSION['perfil'] == 3)
		{
			require_once 'view/header.php';
		    require_once 'view/menu.php';
		    require_once 'view/form_cuenta.php';
		    require_once 'view/footer.php';
		} 
		else 
		{
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/access_denied.php';
			require_once 'view/footer.php';
		}
	}
	public function Form_cuenta_edit()
	{
		session_start();
		if ($_SESSION['perfil'] == 3) 
		{
			$cue = $this->model_cue->Get($_REQUEST['id']);
		    require_once 'view/header.php';
		    require_once 'view/menu.php';
		    require_once 'view/form_cuenta_edit.php';
		    require_once 'view/footer.php';
		} 
		else 
		{
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/access_denied.php';
			require_once 'view/footer.php';
		}
	}

	public function Add()
	{
		$cue = new Cuenta();
		$cue->nro_cuenta = $_REQUEST['txt_nro_cuenta'];
		$cue->descripcion = $_REQUEST['txt_descripcion'];
		$this->model_cue->Insert($cue);
	}

	public function Edit()
	{
		$cue = new Cuenta();
		$cue->id_cuenta = $_REQUEST['id_cuenta'];
		$cue->nro_cuenta = $_REQUEST['txt_nro_cuenta'];
		$cue->descripcion = $_REQUEST['txt_descripcion'];

		$this->model_cue->Update($cue);
	}

	public function Delete()
	{
		$this->model_cue->Delete($_REQUEST['id']);
	}

}
?>

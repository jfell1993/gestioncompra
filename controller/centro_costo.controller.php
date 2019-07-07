<?php
require_once 'model/menu.php';
require_once 'model/centro_costo.php';

class Centro_costoController
{

	public function __CONSTRUCT()
	{
		$this->model_men = new Menu();
		$this->model_cec = new Centro_costo();
	}

	public function Index()
	{
	    session_start();
	    if ($_SESSION['perfil'] == 3) {
		    require_once 'view/header.php';
		    require_once 'view/menu.php';
		    require_once 'view/list_centro_costo.php';
		    require_once 'view/footer.php';
		} else {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/access_denied.php';
			require_once 'view/footer.php';
		}
	}

	public function Form_centro_costo()
	{
		session_start();
		if ($_SESSION['perfil'] == 3) {
			require_once 'view/header.php';
		    require_once 'view/menu.php';
		    require_once 'view/form_centro_costo.php';
		    require_once 'view/footer.php';
		} else {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/access_denied.php';
			require_once 'view/footer.php';
		}
	}

	public function Form_centro_costo_edit()
	{
		session_start();
		if ($_SESSION['perfil'] == 3) {
			$cec = new Centro_costo();
			$cec = $this->model_cec->Get($_REQUEST['id']);
			require_once 'view/header.php';
		    require_once 'view/menu.php';
		    require_once 'view/form_centro_costo_edit.php';
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
		$cec = new Centro_costo();
		$cec->centro_costo = $_REQUEST['txt_centro_costo'];
		$cec->area_carrera = $_REQUEST['txt_area_carrera'];
		$cec = $this->model_cec->Insert($cec);
	}

	public function Edit()
	{
		$cec = new Centro_costo();
		$cec->id_centro_costo = $_REQUEST['id_centro_costo'];
		$cec->centro_costo = $_REQUEST['txt_centro_costo'];
		$cec->area_carrera = $_REQUEST['txt_area_carrera'];
		$this->model_cec->Update($cec);
	}

	public function Delete()
	{
		$this->model_cec->Delete($_POST['id']);
	}



}
?>

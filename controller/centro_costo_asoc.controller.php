<?php
require_once 'model/menu.php';
require_once 'model/centro_costo.php';
require_once 'model/usuario.php';
require_once 'model/centro_costo_asoc.php';

class Centro_costo_asocController
{

	public function __CONSTRUCT()
	{
		$this->model_men = new Menu();
		$this->model_cec = new Centro_costo();
		$this->model_usu = new Usuario();
		$this->model_cec_asoc = new Centro_costo_asoc();
	}

	public function Index()
	{
	    session_start();
	    if ($_SESSION['perfil'] == 3) {
		    require_once 'view/header.php';
		    require_once 'view/menu.php';
		    require_once 'view/list_centro_costo_asoc.php';
		    require_once 'view/footer.php';
		} else {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/access_denied.php';
			require_once 'view/footer.php';
		}
	}
	public function Form_centro_costo_asoc()
	{
		session_start();
		if ($_SESSION['perfil'] == 3) 
		{
		    require_once 'view/header.php';
		    require_once 'view/menu.php';
		    require_once 'view/Form_centro_costo_asoc.php';
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
		$ceco_asoc = new Centro_costo_asoc();
		$ceco_asoc->id_centro_costo = $_REQUEST['ddl_centro_costo_asoc'];
		$ceco_asoc->id_usuario = $_REQUEST['ddl_usuario_asoc'];
		$this->model_cec_asoc->Insert($ceco_asoc);
	}
	public function Delete()
	{
		$this->model_cec_asoc->Delete($_REQUEST['id']);
	}


}
?>

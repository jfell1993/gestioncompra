<?php
require_once 'model/usuario.php';
require_once 'model/menu.php';
require_once 'model/perfil.php';

class UsuarioController
{

	public function __CONSTRUCT()
	{
		$this->model_usu = new Usuario();
		$this->model_men = new Menu();
		$this->model_per = new Perfil();
	}

	public function Index()
	{
		session_start();
		if ($_SESSION['perfil'] == 3) {
		    require_once 'view/header.php';
		    require_once 'view/menu.php';
		    require_once 'view/list_usuario.php';
		    require_once 'view/footer.php';
		} else {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/access_denied.php';
			require_once 'view/footer.php';
		}
	}

	public function Form_usuario()
	{
		session_start();
		if ($_SESSION['perfil'] == 3) {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/form_usuario.php';
			require_once 'view/footer.php';
		} else {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/access_denied.php';
			require_once 'view/footer.php';
		}
	}

	public function Form_usuario_edit()
	{
		session_start();
		if ($_SESSION['perfil'] == 3 || $_SESSION['perfil'] == 2) {
			$usu = new Usuario();
			$usu = $this->model_usu->Get($_REQUEST['id']);
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/form_usuario_edit.php';
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
		$usu = new Usuario();
		$usu->nombre = $_POST['txt_nombre_usuario'];
		$usu->email = $_POST['txt_email_usuario'];
		$usu->password = $_POST['txt_password_usuario'];
		$usu->id_perfil = $_POST['ddl_perfil_usuario'];
		$this->model_usu->Insert($usu);
		echo 'Usuario Creado!';
	}

	public function Edit()
	{
		$usu = new Usuario();
    	$usu->id_usuario = $_POST['id_usuario'];
		$usu->nombre = $_POST['txt_nombre_usuario_edit'];
		$usu->email = $_POST['txt_email_usuario_edit'];
		$usu->password = $_POST['txt_password_usuario_edit'];
		$usu->id_perfil = $_POST['ddl_perfil_usuario_edit'];
		$this->model_usu->Update($usu);
		echo 'Usuario editado!';
	}

	public function Delete()
	{
		$this->model_usu->Delete($_POST['id']);
	}

}
?>

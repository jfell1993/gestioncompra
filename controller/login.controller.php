<?php

require_once 'model/session.php';

class LoginController
{
	private $model_ses;

	public function __CONSTRUCT()
	{
		$this->model_ses = new Session();
	}

	public function Index()
	{
		require_once 'view/header_login.php';
		require_once 'view/form_login.php';
		require_once 'view/footer_login.php';
	}

	public function Check()
	{
		session_start();
		$nombre = $_POST['txt_nombre'].'@duoc.cl';
		$password = $_POST['txt_password'];
		$this->model_ses->Login($nombre, $password);
	}

	public function Check_timeout()
	{
		session_start();
		if($_SESSION["conectado"]) {
			session_destroy();
			echo true;
		}
	}

	public function Disconnect()
	{
		session_start();
		session_destroy();
		header('Location: index.php?c=Login&a=Index');
	}

	public function Message_timeout()
	{
		require_once 'view/header_login.php';
		require_once 'view/message_timeout.php';
		require_once 'view/footer_login.php';
	}
}
?>
<?php 

require_once 'model/producto.php';
require_once 'model/menu.php';

class ProductoController
{

	private $model_pro;

	public function __CONSTRUCT()
	{
		$this->model_pro = new Producto();
		$this->model_men = new Menu();
	}

	public function Index()
	{
		session_start();
		if ($_SESSION['perfil'] == 3) {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/list_producto.php';
			require_once 'view/footer.php';
		} else {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/access_denied.php';
			require_once 'view/footer.php';
		}
	}

	public function Form_producto()
	{
		session_start();
		if ($_SESSION['perfil'] == 3) {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/form_producto.php';
			require_once 'view/footer.php';
		} else {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/access_denied.php';
			require_once 'view/footer.php';
		}
	}

	public function Form_producto_edit()
	{
		session_start();
		if ($_SESSION['perfil'] == 3) {

			$pro = new Producto();
			$pro = $this->model_pro->Get($_REQUEST['id']);

			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/form_producto_edit.php';
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
		try {
			$pro = new Producto();
			$pro->codigo = strtoupper($_REQUEST['txt_codigo']);
			$pro->nombre = strtoupper($_REQUEST['txt_nombre']);
			$pro->valor_unitario = $_REQUEST['txt_valor_unitario'];
			$this->model_pro->Insert($pro);
			$response['status'] = "success";
			$response['message'] = "Producto Agregado!";
		} catch (Exception $e) {
			$response['status'] = "error";
			$response['message'] = (int)$e->getCode()." ".$e->getMessage();
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}

	public function Edit()
	{
		try {
			$pro = new Producto();
			$pro->codigo = strtoupper($_REQUEST['txt_codigo']);
			$pro->id_producto = strtoupper($_REQUEST['id_producto']);
			$pro->nombre = $_REQUEST['txt_nombre'];
			$pro->valor_unitario = $_REQUEST['txt_valor_unitario'];
			$this->model_pro->Update($pro);
			$response['status'] = "success";
			$response['message'] = "Producto Editado!";
		} catch (Exception $e) {
			$response['status'] = "error";
			$response['message'] = (int)$e->getCode()." ".$e->getMessage();
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}

	public function Delete()
	{
		$this->model_pro->Delete($_REQUEST['id']);
		header('Location: index.php?c=Producto&a=Index');
	}

}
 ?>
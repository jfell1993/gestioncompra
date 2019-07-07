<?php
require_once 'model/proveedor.php';
require_once 'model/documento_tributario.php';
require_once 'model/medio_pago.php';
require_once 'model/banco.php';
require_once 'model/menu.php';


class ProveedorController
{
	private $model_pro;
  	private $model_doc;
  	private $model_med;
  	private $model_ban;
  	private $model_men;

	public function __CONSTRUCT()
	{
		$this->model_pro = new Proveedor();
		$this->model_doc = new Documento_tributario();
		$this->model_med = new Medio_pago();
		$this->model_ban = new Banco();
		$this->model_men = new Menu();
	}

	public function Index()
	{
		session_start();
		if ($_SESSION['perfil'] == 3) {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/list_proveedor.php';
			require_once 'view/footer.php';
		} else {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/access_denied.php';
			require_once 'view/footer.php';
		}
	}

	public function FormAdd()
	{
		session_start();
		if ($_SESSION['perfil'] == 3) {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/form_proveedor.php';
			require_once 'view/footer.php';
		} else {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/access_denied.php';
			require_once 'view/footer.php';
		}
	}

	public function FormEdit()
	{
		session_start();
		if ($_SESSION['perfil'] == 3) {
			$pro = new Proveedor();
			$pro = $this->model_pro->Get($_REQUEST['id']);
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/form_proveedor_edit.php';
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
		$pro = new Proveedor();
		$pro->razon_social = $_REQUEST['txt_razon_social'];
		$pro->rut = $_REQUEST['txt_rut'];
		$pro->giro_actividad = $_REQUEST['txt_giro_actividad'];
		$pro->direccion = $_REQUEST['txt_direccion'];
    	$pro->telefono = $_REQUEST['txt_telefono'];
    	$pro->persona_contacto = $_REQUEST['txt_persona_contacto'];
    	$pro->correo_electronico = $_REQUEST['txt_correo_electronico'];
    	$pro->id_documento_tributario = $_REQUEST['ddl_documento_tributario'];
    	$pro->id_medio_pago = $_REQUEST['ddl_medio_pago'];
    	$pro->cuenta_empresa = $_REQUEST['txt_cuenta_empresa'];
    	$pro->id_banco = $_REQUEST['ddl_banco'];

		$this->model_pro->Insert($pro);
		echo 'Proveedor Agregado!';
	}

	public function Edit()
	{
		$pro = new Proveedor();
		$pro->id_proveedor = $_REQUEST['id'];
		$pro->razon_social = $_REQUEST['txt_razon_social_edit'];
		$pro->rut = $_REQUEST['txt_rut_edit'];
		$pro->giro_actividad = $_REQUEST['txt_giro_actividad_edit'];
		$pro->direccion = $_REQUEST['txt_direccion_edit'];
    	$pro->telefono = $_REQUEST['txt_telefono_edit'];
    	$pro->persona_contacto = $_REQUEST['txt_persona_contacto_edit'];
    	$pro->correo_electronico = $_REQUEST['txt_correo_electronico_edit'];
    	$pro->id_documento_tributario = $_REQUEST['ddl_documento_tributario_edit'];
    	$pro->id_medio_pago = $_REQUEST['ddl_medio_pago_edit'];
    	$pro->cuenta_empresa = $_REQUEST['txt_cuenta_empresa_edit'];
    	$pro->id_banco = $_REQUEST['ddl_banco_edit'];

		$this->model_pro->Update($pro);
		echo 'Proveedor Editado!';
	}

	public function Delete()
	{
		$this->model_pro->Delete($_REQUEST['id']);
		header('Location: index.php?c=Proveedor&a=Index');
	}
}
?>

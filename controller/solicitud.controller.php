<?php
require_once 'model/centro_costo.php';
require_once 'model/usuario.php';
require_once 'model/solicitud.php';
require_once 'model/estado.php';
require_once 'model/detalle_solicitud.php';
require_once 'model/menu.php';
require_once 'model/cuenta.php';
require_once 'model/tipo_solicitud.php';
require_once 'model/archivo.php';
require_once 'model/presupuesto.php';
require_once 'model/producto.php';

class SolicitudController
{

	public function __CONSTRUCT()
	{
		$this->model_ceco = new Centro_costo();
		$this->model_usu = new Usuario();
		$this->model_sol = new Solicitud();
		$this->model_est = new Estado();
		$this->model_det = new Detalle_solicitud();
		$this->model_men = new Menu();
		$this->model_cue = new Cuenta();
		$this->model_tip = new Tipo_Solicitud();
		$this->model_arc = new Archivo();
		$this->model_pre = new Presupuesto();
		$this->model_pro = new Producto();
	}

	public function Index()
	{
		session_start();
		if (!isset($_SESSION['estado'])) {
			$_SESSION['estado'] = 'Creada';
		}
		if ($_SESSION['perfil'] == 3 || $_SESSION['perfil'] == 2) {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/list_solicitud_admin.php';
			require_once 'view/footer.php';
		} else {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/list_solicitud.php';
			require_once 'view/footer.php';
		}

	}

	public function Bandeja_solicitud()
	{
		session_start();
		if (!isset($_SESSION['estado'])) {
			$_SESSION['estado'] = 'Creada';
		}
		require_once 'view/header.php';
		require_once 'view/menu.php';
		require_once 'view/list_solicitud.php';
		require_once 'view/footer.php';
	}

	public function Bandeja_solicitud_admin()
	{
		session_start();
		if ($_SESSION['perfil'] == 3 || $_SESSION['perfil'] == 2) {
			if (!isset($_SESSION['estado'])) {
			$_SESSION['estado'] = 'Creada';
			}
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/list_solicitud_admin.php';
			require_once 'view/footer.php';
		} else {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/access_denied.php';
			require_once 'view/footer.php';
		}
	}

	public function Form_solicitud()
	{
		session_start();
		require_once 'view/header.php';
		require_once 'view/menu.php';
		require_once 'view/form_solicitud.php';
		require_once 'view/footer.php';
	}

	public function Form_solicitud_read()
	{
		session_start();
		$sol = $this->model_sol->Get($_REQUEST['id']);
		$tip = new Tipo_Solicitud();
		$tip->nombre = $this->model_tip->Get_nombre($sol->id_tipo_solicitud)->nombre;
		$sol->fecha_actividad = date('d-m-Y',strtotime($sol->fecha_actividad));
		$sol->fecha_requerimiento = date('d-m-Y',strtotime($sol->fecha_requerimiento));
		$usu = $this->model_usu->Get($sol->id_usuario_solicitante);
		$cec = $this->model_ceco->Get($sol->id_centro_costo);
		$cue = $this->model_cue->Get($sol->id_cuenta);

		require_once 'view/header.php';
		require_once 'view/menu.php';
		require_once 'view/form_solicitud_read.php';
		require_once 'view/footer.php';
	}

	public function Form_solicitud_edit()
	{
		session_start();
		if ($_SESSION['perfil'] == 3 || $_SESSION['perfil'] == 2) {
			$sol = new Solicitud();
			$sol = $this->model_sol->Get($_REQUEST['id']);
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/form_solicitud_edit.php';
			require_once 'view/footer.php';
		} else {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/access_denied.php';
			require_once 'view/footer.php';
		}
	}

	public function Get_centro_costo() 
	{
		$area_carrera = $_POST['area_carrera'];
		$ceco = new Centro_costo();
		$ceco = $this->model_cue->Get($area_carrera);
		echo json_encode($ceco);
	}

	public function List_cuenta() 
	{
		$id_centro_costo = $_POST['id_centro_costo'];
		$list_cuenta = $this->model_cue->ListBy($id_centro_costo);
		$response_string = "";
		foreach($list_cuenta as $row)
		{
			$response_string.= '<option value="'.$row->nro_cuenta.'">'.$row->nro_cuenta.' - '.$row->descripcion.'</option>';
		}
		echo $response_string;
	}

	public function Add_producto(){
		try {		
			session_start();
			$sol = new Solicitud();
			$sol->id_tipo_solicitud = 1;
			$sol->fecha_solicitud = date('Y-m-d');
			$fecha = strtr($_POST['txt_fecha_requerimiento'], '/', '-');
			$sol->fecha_requerimiento = date('Y-m-d',strtotime($fecha));
			$sol->objetivo = strtoupper($_POST['txt_objetivo']);
			$usu = $this->model_usu->Get_current($_SESSION['nombre']);
			$sol->id_usuario = $usu->id_usuario;
			$sol->id_usuario_solicitante = $_POST['ddl_usuario_solicitante'];
			$sol->id_usuario_responsable = 48;
			$sol->id_centro_costo = $this->model_ceco->Get_by_ceco($_POST['txt_centro_costo'])->id_centro_costo;
			$sol->id_cuenta = $this->model_cue->Get_by_cuenta($_POST['ddl_cuenta'])->id_cuenta;
			$sol->oco = $_POST['txt_oco'];
			$sol->id_estado = 1;

			$this->model_sol->Insert_producto($sol);

			$id_solicitud = $this->model_sol->LastId();

			$list_material_servicio = json_decode($_POST['json_list_material_servicio']);
			$det = new Detalle_solicitud();
			foreach ($list_material_servicio as $obj) {
				$det->codigo = $obj->codigo;
				$det->material_servicio = $obj->nombre;
				$det->cantidad = $obj->cantidad;
				$det->valor_unitario = $obj->valor;
				$det->id_solicitud = $id_solicitud;
				$this->model_det->Insert($det);
			}
			$this->model_arc->Insert($id_solicitud);
			$response['status'] = "success";
			$response['message'] = "Solicitud Enviada!";
		} catch (Exception $e) {
			$response['status'] = "error";
			$response['message'] = (int)$e->getCode()." ".$e->getMessage();
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}

	public function Add_actividad_dentro(){
		try {
			session_start();
			$sol = new Solicitud();
			$sol->id_tipo_solicitud = 2;
			$sol->fecha_solicitud = date('Y-m-d');
			$fecha = strtr($_POST['txt_fecha_actividad'], '/', '-');
			$sol->fecha_actividad = date('Y-m-d',strtotime($fecha));
			$fecha = strtr($_POST['txt_fecha_requerimiento'], '/', '-');
			$sol->fecha_requerimiento = date('Y-m-d',strtotime($fecha));
			$sol->objetivo = strtoupper($_POST['txt_objetivo']);
			$sol->lugar_actividad = $_POST['txt_lugar_actividad'];
			$usu = $this->model_usu->Get_current($_SESSION['nombre']);
			$sol->id_usuario = $usu->id_usuario;
			$sol->id_usuario_solicitante = $_POST['ddl_usuario_solicitante'];
			$sol->id_usuario_responsable = 48;
			$sol->id_centro_costo = $this->model_ceco->Get_by_ceco($_POST['txt_centro_costo'])->id_centro_costo;
			$sol->id_cuenta = $this->model_cue->Get_by_cuenta($_POST['ddl_cuenta'])->id_cuenta;
			$sol->oco = $_POST['txt_oco'];
			$sol->id_estado = 1;

			$this->model_sol->Insert_actividad_dentro($sol);

			$id_solicitud = $this->model_sol->LastId();

			$list_material_servicio = json_decode($_POST['json_list_material_servicio']);
			$det = new Detalle_solicitud();
			foreach ($list_material_servicio as $obj) {
				$det->material_servicio = $obj->nombre;
				$det->codigo = $obj->codigo;
				$det->cantidad = $obj->cantidad;
				$det->valor_unitario = $obj->valor;
				$det->id_solicitud = $id_solicitud;
				$this->model_det->Insert($det);
			}
			$this->model_arc->Insert($id_solicitud);

			$response['status'] = "success";
			$response['message'] = "Solicitud Enviada!";
		} catch (Exception $e) {
			$response['status'] = "error";
			$response['message'] = (int)$e->getCode()." ".$e->getMessage();
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}

	public function Add_actividad_fuera(){
		try {
			session_start();
			$sol = new Solicitud();
			$sol->id_tipo_solicitud = 3;
			$sol->fecha_solicitud = date('Y-m-d');
			$fecha = strtr($_POST['txt_fecha_actividad'], '/', '-');
			$sol->fecha_actividad = date('Y-m-d',strtotime($fecha));
			$fecha = strtr($_POST['txt_fecha_requerimiento'], '/', '-');
			$sol->fecha_requerimiento = date('Y-m-d',strtotime($fecha));
			$sol->objetivo = strtoupper($_POST['txt_objetivo']);
			$sol->cantidad_asistente = $_POST['txt_cantidad_asistente'];
			$sol->lugar_actividad = $_POST['txt_lugar_actividad'];
			$sol->hora_salida_sede = $_POST['txt_hora_salida_sede'];
			$sol->hora_regreso_sede = $_POST['txt_hora_regreso_sede'];
			$usu = $this->model_usu->Get_current($_SESSION['nombre']);
			$sol->id_usuario = $usu->id_usuario;
			$sol->id_usuario_solicitante = $_POST['ddl_usuario_solicitante'];
			$sol->id_usuario_responsable = 48;
			$sol->id_centro_costo = $this->model_ceco->Get_by_ceco($_POST['txt_centro_costo'])->id_centro_costo;
			$sol->id_cuenta = $this->model_cue->Get_by_cuenta($_POST['ddl_cuenta'])->id_cuenta;
			$sol->oco = $_POST['txt_oco'];
			$sol->id_estado = 1;

			$this->model_sol->Insert_actividad_fuera($sol);

			$id_solicitud = $this->model_sol->LastId();

			$list_material_servicio = json_decode($_POST['json_list_material_servicio']);
			$det = new Detalle_solicitud();
			foreach ($list_material_servicio as $obj) {
				$det->material_servicio = $obj->nombre;
				$det->codigo = $obj->codigo;
				$det->cantidad = $obj->cantidad;
				$det->valor_unitario = $obj->valor;
				$det->id_solicitud = $id_solicitud;
				$this->model_det->Insert($det);
			}
			$this->model_arc->Insert($id_solicitud);

			$response['status'] = "success";
			$response['message'] = "Solicitud Enviada!";
		} catch (Exception $e) {
			$response['status'] = "error";
			$response['message'] = (int)$e->getCode()." ".$e->getMessage();
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}

	public function Edit(){
		try {
			if ($_POST['ddl_estado_edit'] == 5) 
			{
				if ($this->model_pre->Check_cuenta($_POST['id_cuenta']) == 0) 
				{
					$response['status'] = "error";
					$response['message'] = "Cuenta no encontrada!";
				} 
				else 
				{
					$this->model_pre->Update($_POST['id_solicitud'],$_POST['id_cuenta']);
					$sol = new Solicitud();
					$sol->id_solicitud = $_POST['id_solicitud'];
					$sol->id_estado = $_POST['ddl_estado_edit'];
					$sol->id_usuario_responsable = $_POST['ddl_responsable_edit'];
					$sol->observacion = ucfirst($_POST['txt_observacion']);
					$this->model_sol->Update($sol);
					$response['status'] = "success";
					$response['message'] = "Solicitud editada, total de cuenta actualizado!";
				}
			}
			else
			{
				$sol = new Solicitud();
				$sol->id_solicitud = $_POST['id_solicitud'];
				$sol->id_estado = $_POST['ddl_estado_edit'];
				$sol->id_usuario_responsable = $_POST['ddl_responsable_edit'];
				$sol->observacion = ucfirst($_POST['txt_observacion']);
				$this->model_sol->Update($sol);
				$response['status'] = "success";
				$response['message'] = "Solicitud Editada!";
			}		

		} catch (Exception $e) {
			$response['status'] = "error";
			$response['message'] = $e->getMessage()." thrown at ".$e->getFile()." line ".$e->getLine();
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}

	public function Edit_file(){
		$sol = new Solicitud();
		$sol->id_solicitud = $_POST['id_solicitud'];
		$sol->id_estado = $_POST['ddl_estado_edit'];
		$sol->id_usuario_responsable = $_POST['ddl_responsable_edit'];
		$this->model_sol->Update($sol);
		$this->model_arc->Insert($_POST['id_solicitud']);
		echo 'Solicitud editada!';
	}

	public function List_estado()
	{
		session_start();
		$_SESSION['estado'] = $_POST['estado'];
	}

	public function List_producto_by()
	{
		$result = '<ul id="product-list">';
		foreach($this->model_pro->ListBy($_REQUEST['keyword']) as $row)
		{
			$result .= '<li onClick="selectProducto(\''.$row->nombre.'\')">'.$row->nombre.'</li>';
		}
		$result .= '</ul>';

		echo $result;
	}

	public function Get_producto_cod_valor()
	{
		$pro = new Producto();
		$pro = $this->model_pro->GetVal($_REQUEST['nombre']);
		$response['codigo'] = $pro->codigo;
		$response['valor'] = $pro->valor_unitario;
		header('Content-type: application/json');
		echo json_encode($response);
	}

	public function Check_presupuesto()
	{
		if($this->model_pre->Check_presupuesto($_POST['id_cuenta'],$_POST['total']))
		{	
			$response['status'] = "success";
		}
		else
		{
			$presupuesto = $this->model_pre->Check_presupuesto_restante($_POST['id_cuenta']);
			$response['status'] = "error";
			$response['message'] = "Se ha excedido el presupuesto disponible en la cuenta seleccionada ($".$presupuesto.")";
		}
		header('Content-type: application/json');
		echo json_encode($response); 
	}

}
?>

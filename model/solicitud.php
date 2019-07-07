<?php 
class Solicitud
{

	private $conn;

	public $id_solicitud;
	public $id_tipo_solicitud;
	public $fecha_solicitud;
	public $fecha_actividad;
	public $fecha_requerimiento;
	public $objetivo;
	public $cantidad_asistente;
	public $lugar_actividad;
  	public $hora_salida_sede;
  	public $hora_regreso_sede;
  	public $id_usuario;
  	public $usuario_solicitante;
	public $id_usuario_responsable;
	public $id_centro_costo;
	public $id_cuenta;
	public $oco;
	public $observacion;
	public $id_estado;


	public function __CONSTRUCT()
	{
		try
		{
			$this->conn = Database::Conn();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Insert_producto($sol)
	{
		try {
		    $sql = $this->conn->prepare("INSERT INTO solicitud (id_tipo_solicitud, fecha_solicitud, fecha_requerimiento, objetivo, id_usuario, id_usuario_solicitante, id_usuario_responsable, id_centro_costo, id_cuenta, oco, id_estado) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
			$sql->execute(array($sol->id_tipo_solicitud, $sol->fecha_solicitud,$sol->fecha_requerimiento, $sol->objetivo, $sol->id_usuario, $sol->id_usuario_solicitante, $sol->id_usuario_responsable, $sol->id_centro_costo, $sol->id_cuenta, $sol->oco, $sol->id_estado));
		}
		catch( PDOException $Exception ) {
		    throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		}
	}

	public function Insert_actividad_dentro($sol)
	{
		try {
		    $sql = $this->conn->prepare("INSERT INTO solicitud (id_tipo_solicitud, fecha_solicitud, fecha_actividad, fecha_requerimiento, objetivo, lugar_actividad, id_usuario, id_usuario_solicitante, id_usuario_responsable, id_centro_costo, id_cuenta, oco, id_estado) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$sql->execute(array($sol->id_tipo_solicitud, $sol->fecha_solicitud, $sol->fecha_actividad, $sol->fecha_requerimiento, $sol->objetivo, $sol->lugar_actividad, $sol->id_usuario, $sol->id_usuario_solicitante, $sol->id_usuario_responsable, $sol->id_centro_costo, $sol->id_cuenta, $sol->oco, $sol->id_estado));
		}
		catch( PDOException $Exception ) {
		    throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		}
	}

	public function Insert_actividad_fuera($sol)
	{
		try {
			 $sql = $this->conn->prepare("INSERT INTO solicitud (id_tipo_solicitud, fecha_solicitud, fecha_actividad, fecha_requerimiento, objetivo, cantidad_asistente, lugar_actividad, hora_salida_sede, hora_regreso_sede, id_usuario, id_usuario_solicitante, id_usuario_responsable, id_centro_costo, id_cuenta, oco, id_estado) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$sql->execute(array($sol->id_tipo_solicitud, $sol->fecha_solicitud, $sol->fecha_actividad, $sol->fecha_requerimiento, $sol->objetivo, $sol->cantidad_asistente, $sol->lugar_actividad, $sol->hora_salida_sede, $sol->hora_regreso_sede, $sol->id_usuario, $sol->id_usuario_solicitante, $sol->id_usuario_responsable, $sol->id_centro_costo, $sol->id_cuenta, $sol->oco, $sol->id_estado));
		} catch (PDOException $Exception) {
			throw new MyDatabaseException ( $Exception->getMessage ( ), (int)$Exception->getCode( ) );
		}
	}

	public function Update($sol) {
		try {
			$sql = $this->conn->prepare("UPDATE solicitud SET id_estado = ?, id_usuario_responsable = ?, observacion = ? WHERE id_solicitud = ?");
			$sql->execute(array($sol->id_estado, $sol->id_usuario_responsable, $sol->observacion, $sol->id_solicitud));
		} catch (PDOEXeption $e) {
			throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		}
	}

	public function Get($id)
	{
		try {
			$sql = $this->conn->prepare("SELECT * FROM solicitud WHERE id_solicitud = ?");
			$sql->execute(array($id));
			return $sql->fetch(PDO::FETCH_OBJ);
		} catch (PDOExeption $e) {
			throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		}
	}

	public function LastId(){
		return $this->conn->lastInsertId();
	}

	public function List($estado)
	{
		if($estado == 'Todos') {
			$sql = $this->conn->prepare("SELECT so.id_solicitud AS 'id_solicitud', (SELECT nombre FROM usuario WHERE id_usuario = so.id_usuario) AS 'id_usuario', (SELECT nombre FROM usuario WHERE id_usuario = so.id_usuario_responsable) AS 'id_usuario_responsable', so.fecha_solicitud AS 'fecha_solicitud', so.objetivo AS 'objetivo', es.nombre AS 'estado' FROM solicitud so JOIN estado es ON so.id_estado = es.id_estado");
			$sql->execute();
		} else {
			$sql = $this->conn->prepare("SELECT so.id_solicitud AS 'id_solicitud', (SELECT nombre FROM usuario WHERE id_usuario = so.id_usuario) AS 'id_usuario', (SELECT nombre FROM usuario WHERE id_usuario = so.id_usuario_responsable) AS 'id_usuario_responsable', so.fecha_solicitud AS 'fecha_solicitud', so.objetivo AS 'objetivo', es.nombre AS 'estado' FROM solicitud so JOIN estado es ON so.id_estado = es.id_estado WHERE es.nombre = ?");
			$sql->execute(array($estado));
		}
		return $sql->fetchAll(PDO::FETCH_OBJ);
	}

	public function List_current_user($estado, $nombre)
	{
		if($estado == 'Todos') {
			$sql = $this->conn->prepare("SELECT so.id_solicitud AS 'id_solicitud', (SELECT nombre FROM usuario WHERE id_usuario = so.id_usuario) AS 'id_usuario', (SELECT nombre FROM usuario WHERE id_usuario = so.id_usuario_responsable) AS 'id_usuario_responsable', so.fecha_solicitud AS 'fecha_solicitud', so.objetivo AS 'objetivo', es.nombre AS 'estado' FROM solicitud so JOIN estado es ON so.id_estado = es.id_estado WHERE (SELECT nombre FROM usuario WHERE id_usuario = so.id_usuario) = ?");
			$sql->execute(array($nombre));
		} else {
			$sql = $this->conn->prepare("SELECT so.id_solicitud AS 'id_solicitud', (SELECT nombre FROM usuario WHERE id_usuario = so.id_usuario) AS 'id_usuario', (SELECT nombre FROM usuario WHERE id_usuario = so.id_usuario_responsable) AS 'id_usuario_responsable', so.fecha_solicitud AS 'fecha_solicitud', so.objetivo AS 'objetivo', es.nombre AS 'estado' FROM solicitud so JOIN estado es ON so.id_estado = es.id_estado WHERE es.nombre = ? AND (SELECT nombre FROM usuario WHERE id_usuario = so.id_usuario) = ?");
			$sql->execute(array($estado, $nombre));
		}
		return $sql->fetchAll(PDO::FETCH_OBJ);
	}

}
?>
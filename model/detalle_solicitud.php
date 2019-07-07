<?php 

class Detalle_solicitud {
	
	private $conn;
	public $id_detalle_solicitud;
	public $codigo;
	public $material_servicio;
	public $cantidad;
	public $valor_unitario;

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

	public function Insert($det)
	{
		try {
		    $sql = $this->conn->prepare("INSERT INTO detalle_solicitud (material_servicio, codigo, cantidad, valor_unitario, id_solicitud) VALUES (?,?,?,?,?)");
			$sql->execute(array($det->material_servicio, $det->codigo, $det->cantidad, $det->valor_unitario, $det->id_solicitud));
		}
		catch( PDOException $Exception ) {
		    throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		}
	}

	public function List($id)
	{
		try {
			$sql = $this->conn->prepare("SELECT * FROM detalle_solicitud WHERE id_solicitud = ?");
			$sql->execute(array($id));

			return $sql->fetchAll(PDO::FETCH_OBJ);
		} catch ( PDOException $Exception) {
			throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		}
	}
}

 ?>
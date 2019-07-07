<?php 
class Tipo_Solicitud
{

	private $conn;

	public $id_tipo_solicitud;
	public $nombre;

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

	public function Get_nombre($id_tipo_solicitud)
	{
		$sql = $this->conn->prepare("SELECT * FROM tipo_solicitud WHERE id_tipo_solicitud = ?");
		$sql->execute(array($id_tipo_solicitud));

		return $sql->fetch(PDO::FETCH_OBJ);
	}
}
?>
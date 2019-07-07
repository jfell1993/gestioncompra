<?php 
class Medio_pago
{

	private $conn;

	public $id_medio_pago;
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

	public function List()
	{
		$sql = $this->conn->prepare("SELECT * FROM medio_pago");
		$sql->execute();

		return $sql->fetchAll(PDO::FETCH_OBJ);
	}
}
?>
<?php 
class Documento_tributario
{

	private $conn;

	public $id_documento_tributario;
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
		$sql = $this->conn->prepare("SELECT * FROM documento_tributario");
		$sql->execute();

		return $sql->fetchAll(PDO::FETCH_OBJ);
	}
}
?>
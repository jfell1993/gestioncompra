<?php 
class Estado
{

	private $conn;

	public $id_estado;
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
		$sql = $this->conn->prepare("SELECT * FROM estado");
		$sql->execute();

		return $sql->fetchAll(PDO::FETCH_OBJ);
	}
}
?>
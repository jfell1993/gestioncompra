<?php 
class Perfil
{
	private $conn;

	public $id_perfil;
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
		$sql = $this->conn->prepare("SELECT * FROM perfil");
		$sql->execute();

		return $sql->fetchAll(PDO::FETCH_OBJ);
	}
}
?>
<?php 
class Menu
{

	private $conn;

	public $id_menu;
	public $nombre;
	public $url;
	public $ico;

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

	public function List($id_perfil)
	{
		$sql = $this->conn->prepare("SELECT me.nombre AS 'nombre', me.url AS 'url', me.ico AS 'ico' FROM menu me JOIN perfil_menu pm ON me.id_menu = pm.id_menu WHERE pm.id_perfil = ?");
		$sql->execute(array($id_perfil));

		return $sql->fetchAll(PDO::FETCH_OBJ);
	}
}
?>
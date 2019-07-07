<?php 
class Producto
{

	private $conn;

	public $id_producto;
	public $codigo;
	public $nombre;
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

	public function List()
	{
		$sql = $this->conn->prepare("SELECT * FROM producto");
		$sql->execute();

		return $sql->fetchAll(PDO::FETCH_OBJ);
	}


	public function ListBy($keyword)
	{
		$sql = $this->conn->prepare("SELECT * FROM producto WHERE nombre LIKE ? ORDER BY nombre LIMIT 0,6");
		$sql->execute(array($keyword.'%'));

		return $sql->fetchAll(PDO::FETCH_OBJ);
	}

	public function Get($id)
	{
		$sql = $this->conn->prepare("SELECT * FROM producto WHERE id_producto = ?");
		$sql->execute(array($id));

		return $sql->fetch(PDO::FETCH_OBJ);
	}

	public function GetVal($nombre)
	{
		$sql = $this->conn->prepare("SELECT * FROM producto WHERE nombre = ?");
		$sql->execute(array($nombre));

		return $sql->fetch(PDO::FETCH_OBJ);
	}

	public function Insert($pro)
	{
		try {
			$sql = $this->conn->prepare("INSERT INTO producto (codigo, nombre, valor_unitario) VALUES(?,?,?)");
			$sql->execute(array($pro->codigo, $pro->nombre, $pro->valor_unitario));
		} catch (Exception $Exception) {
			throw new Exception( $Exception->getMessage( ) , (int)$Exception->getCode( ) );	
		}

	}

	public function Update($pro)
	{
		try {
			$sql = $this->conn->prepare("UPDATE producto SET codigo=?, nombre=?,valor_unitario=? WHERE id_producto=?");
			$sql->execute(array($pro->codigo, $pro->nombre, $pro->valor_unitario, $pro->id_producto));
		} catch (Exception $Exception) {
			throw new Exception( $Exception->getMessage( ) , (int)$Exception->getCode( ) );	
		}
	}

	public function Delete($id){
		try {
			$sql = $this->conn->prepare("DELETE FROM producto WHERE id_producto=?");
			$sql->execute(array($id));
		} catch (Exception $Exception) {
			throw new Exception( $Exception->getMessage( ) , (int)$Exception->getCode( ) );		
		}
	}
}
 ?>
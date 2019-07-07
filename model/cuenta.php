<?php 
class Cuenta
{

	private $conn;

	public $id_cuenta;
	public $nro_cuenta;
	public $descripcion;
	public $deshabilitado;

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

	public function ListBy($id_centro_costo)
	{
		$sql = $this->conn->prepare("SELECT cu.nro_cuenta AS 'nro_cuenta', cu.descripcion AS 'descripcion' FROM cuenta cu JOIN cuenta_centro_costo ccc ON cu.id_cuenta = ccc.id_cuenta JOIN centro_costo cc ON cc.id_centro_costo = ccc.id_centro_costo WHERE cc.ceco = ? AND cu.deshabilitado = 0");
		$sql->execute(array($id_centro_costo));

		return $sql->fetchAll(PDO::FETCH_OBJ);
	}

	public function List()
	{
		$sql = $this->conn->prepare("SELECT * FROM cuenta WHERE deshabilitado = 0");
		$sql->execute();
		return $sql->fetchAll(PDO::FETCH_OBJ);
	}


	public function Get($id)
	{
		try {
			$sql = $this->conn->prepare("SELECT * FROM cuenta WHERE id_cuenta = ?");
			$sql->execute(array($id));

			return $sql->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		}
	}

	public function Get_by_cuenta($nro_cuenta)
	{
		try {
			$sql = $this->conn->prepare("SELECT * FROM cuenta WHERE nro_cuenta = ?");
			$sql->execute(array($nro_cuenta));

			return $sql->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		}
	}

	public function Insert($cue)
	{
		try {
			$sql = $this->conn->prepare("INSERT INTO cuenta (nro_cuenta, descripcion) VALUES (?,?)");
			$sql->execute(array($cue->nro_cuenta, ucfirst($cue->descripcion)));
			$response['status'] = "success";
			$response['message'] = "Cuenta Creada!";
		} catch (Exception $e) {
			$response['status'] = "error";
			$response['message'] = (int)$e.getCode()." ".$e.getMessage();

		}
		header('Content-type: application/json');
		echo json_encode($response);
	}

	public function Update($cue)
	{
		try {
			$sql = $this->conn->prepare("UPDATE cuenta SET nro_cuenta = ?, descripcion = ? WHERE id_cuenta = ?");
			$sql->execute(array($cue->nro_cuenta, ucfirst($cue->descripcion), $cue->id_cuenta));
			$response['status'] = "success";
			$response['message'] = "Cuenta editada!";
		} catch (Exception $e) {
			$response['status'] = "error";
			$response['message'] = (int)$e.getCode()." ".$e.getMessage();

		}
		header('Content-type: application/json');
		echo json_encode($response);
	}

	public function Delete($id)
	{
		try {
			$sql = $this->conn->prepare("UPDATE cuenta SET deshabilitado = 1 WHERE id_cuenta = ?");
			$sql->execute(array($id));
		} catch (Exception $e) {
			throw new MyDatabaseException( $Exception->getMessage(), (int)$Exception->getCode() );
		}
	}
}
?>
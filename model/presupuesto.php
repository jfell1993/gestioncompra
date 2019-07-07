<?php 

class Presupuesto {

	private $conn;
	
	public $sociedad;
	public $division;
	public $centro_costo;
	public $cuenta_mayor;
	public $actividad;
	public $detalle;
	public $enero;
	public $febrero;
	public $marzo;
	public $abril;
	public $mayo;
	public $junio;
	public $julio;
	public $agosto;
	public $septiembre;
	public $octubre;
	public $noviembre;
	public $diciembre;
	public $total;

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
		$sql = $this->conn->prepare("SELECT * FROM presupuesto");
		$sql->execute();

		return $sql->fetchAll(PDO::FETCH_OBJ);
	}

	public function Insert($pre)
	{
		try {
			$sql = $this->conn->prepare("INSERT INTO presupuesto (sociedad, division, centro_costo, cuenta_mayor, actividad, detalle, enero, febrero, marzo, abril, mayo, junio, julio, agosto, septiembre, octubre, noviembre, diciembre, total) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$sql->execute(array($pre->sociedad,$pre->division,$pre->centro_costo,$pre->cuenta_mayor,$pre->actividad,$pre->detalle,$pre->enero,$pre->febrero,$pre->marzo,$pre->abril,$pre->mayo,$pre->junio,$pre->julio,$pre->agosto,$pre->septiembre,$pre->octubre,$pre->noviembre,$pre->diciembre,$pre->total));	
		} catch (PDOException $Exception) {
			throw new PDOException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );	
		}
	}

	public function Delete_All()
	{
		try {
			$sql = $this->conn->prepare("DELETE FROM presupuesto");
			$sql->execute();
		} catch (PDOException $Exception) {
			throw new PDOException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		}
	}

	public function Update($id_solicitud,$id_cuenta)
	{
		try {
			$sql = $this->conn->prepare("SELECT cantidad AS 'cantidad', valor_unitario AS 'valor_unitario' FROM detalle_solicitud WHERE id_solicitud=?");
			$sql->execute(array($id_solicitud));
			$detalle = $sql->fetch(PDO::FETCH_OBJ);
			$total = $detalle->cantidad * $detalle->valor_unitario;
			$sql = $this->conn->prepare("SELECT nro_cuenta FROM cuenta WHERE id_cuenta = ?");
			$sql->execute(array($id_cuenta));
			$obj = $sql->fetch(PDO::FETCH_OBJ);
			$sql = $this->conn->prepare("UPDATE presupuesto SET total=total-? WHERE cuenta_mayor=?");
			$sql->execute(array($total,$obj->nro_cuenta));
		} catch (PDOException $Exception) {
			throw new PDOException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		}
	}

	public function Check_cuenta($id_cuenta)
	{
		try {
			$sql = $this->conn->prepare("SELECT nro_cuenta FROM cuenta WHERE id_cuenta = ?");
			$sql->execute(array($id_cuenta));
			$obj = $sql->fetch(PDO::FETCH_OBJ);
			$sql = $this->conn->prepare("SELECT Count(*) AS 'result' FROM presupuesto WHERE cuenta_mayor = ?");
			$sql->execute(array($obj->nro_cuenta));
			$rows = $sql->fetch(PDO::FETCH_OBJ);
			return $rows->result;
		} catch (PDOException $Exception) {
			throw new PDOException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		}
	}

	public function Check_presupuesto($id_cuenta, $total)
	{
		try {
			$sql = $this->conn->prepare("SELECT * FROM presupuesto WHERE cuenta_mayor = ?");
			$sql->execute(array($id_cuenta));
			$obj = $sql->fetch(PDO::FETCH_OBJ);
			if($obj->total < $total)
			{
				return false;
			}
			else
			{
				return true;
			}
		} catch (PDOException $Exception) {
			throw new PDOException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		}
	}

	public function Check_presupuesto_restante($id_cuenta)
	{
		try {
			$sql = $this->conn->prepare("SELECT * FROM presupuesto WHERE cuenta_mayor = ?");
			$sql->execute(array($id_cuenta));
			$obj = $sql->fetch(PDO::FETCH_OBJ);
			return $obj->total;
		} catch (PDOException $Exception) {
			throw new PDOException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		}
	}
}
	
?>
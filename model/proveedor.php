<?php 
class Proveedor
{

	private $conn;

	public $id_proveedor;
	public $razon_social;
	public $rut;
	public $giro_actividad;
	public $direccion;
  	public $telefono;
  	public $persona_contacto;
  	public $correo_electronico;
  	public $id_documento_tributario;
  	public $id_medio_pago;
  	public $cuenta_empresa;
  	public $id_banco;

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
		$sql = $this->conn->prepare("SELECT pro.id_proveedor AS 'id_proveedor', pro.razon_social AS 'razon_social', pro.rut AS 'rut', pro.giro_actividad AS 'giro_actividad', pro.direccion AS 'direccion', pro.telefono AS 'telefono', pro.persona_contacto AS 'persona_contacto', pro.correo_electronico AS 'correo_electronico', doc.nombre AS 'documento_tributario', med.nombre AS 'medio_pago', pro.cuenta_empresa AS 'cuenta_empresa', ban.nombre AS 'banco' FROM proveedor pro JOIN documento_tributario doc ON pro.id_documento_tributario = doc.id_documento_tributario JOIN medio_pago med ON pro.id_medio_pago = med.id_medio_pago JOIN banco ban ON pro.id_banco = ban.id_banco");
		$sql->execute();

		return $sql->fetchAll(PDO::FETCH_OBJ);
	}

	public function Insert($pro)
	{
		$sql = $this->conn->prepare("INSERT INTO proveedor (razon_social, rut, giro_actividad, direccion, telefono, persona_contacto, correo_electronico, id_documento_tributario, id_medio_pago, cuenta_empresa, id_banco) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
		$sql->execute(array($pro->razon_social,$pro->rut,$pro->giro_actividad,$pro->direccion,$pro->telefono, $pro->persona_contacto, $pro->correo_electronico, $pro->id_documento_tributario, $pro->id_medio_pago, $pro->cuenta_empresa, $pro->id_banco));
	}

	public function Get($id_proveedor)
	{
		$sql = $this->conn->prepare("SELECT * FROM proveedor where id_proveedor = ?");
		$sql->execute(array($id_proveedor));

		return $sql->fetch(PDO::FETCH_OBJ);
	}

	public function Update($pro)
	{
		$sql= $this->conn->prepare("UPDATE proveedor SET razon_social=?, rut=?, giro_actividad=?, direccion=?, telefono=?, persona_contacto=?, correo_electronico=?, id_documento_tributario=?, id_medio_pago=?, cuenta_empresa=?, id_banco=? WHERE id_proveedor = ?");
		$sql->execute(array($pro->razon_social, $pro->rut, $pro->giro_actividad, $pro->direccion, $pro->telefono, $pro->persona_contacto, $pro->correo_electronico, $pro->id_documento_tributario, $pro->id_medio_pago, $pro->cuenta_empresa, $pro->id_banco, $pro->id_proveedor));
	}

	public function Delete($id_proveedor)
	{
		$sql = $this->conn->prepare("DELETE FROM proveedor where id_proveedor = ?");
		$sql->execute(array($id_proveedor));
	}

}
?>
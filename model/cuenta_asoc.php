<?php 
	class Cuenta_asoc
	{

		private $conn;

		public $id_cuenta_centro_costo;
		public $id_centro_costo;
		public $id_cuenta;

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
			try {
				$sql = $this->conn->prepare("SELECT ccc.id_cuenta_centro_costo AS 'id_cuenta_centro_costo', cu.nro_cuenta AS 'nro_cuenta', cu.descripcion AS 'descripcion', cc.ceco AS 'ceco', cc.area_carrera AS 'area_carrera' FROM cuenta cu JOIN cuenta_centro_costo ccc ON cu.id_cuenta = ccc.id_cuenta JOIN centro_costo cc ON ccc.id_centro_costo = cc.id_centro_costo ORDER BY cu.descripcion ASC");
				$sql->execute();
				return $sql->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				throw new MyDatabaseException ($Exception->getMessage(), (int)$Exception->getCode());
			}
		}

		public function Insert($cue_asoc)
		{
			try {
				$sql = $this->conn->prepare("INSERT INTO cuenta_centro_costo (id_cuenta, id_centro_costo) VALUES (?,?)");
				$sql->execute(array($cue_asoc->id_cuenta, $cue_asoc->id_centro_costo));
				$response['status'] = "success";
				$response['message'] = "Cuenta Asociada Creada!";
			} catch (Exception $e) {
				$response['status'] = "error";
				$response['message'] = (int)$e->getCode()." ".$e->getMessage();
			}

			header('Content-type: application/json');
			echo json_encode($response);
		}
		public function Delete($id)
		{
			try {
				$sql = $this->conn->prepare("DELETE FROM cuenta_centro_costo WHERE id_cuenta_centro_costo=?");
				$sql->execute(array($id));
			} catch (Exception $e) {
				throw new MyDatabaseException ($Exception->getMessage(), (int)$Exception->getCode());
			}
		}
	}
?>
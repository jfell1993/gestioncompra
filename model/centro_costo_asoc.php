<?php 
	class Centro_costo_asoc
	{

		private $conn;

		public $id_usuario_ceco;
		public $id_usuario;

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
				$sql = $this->conn->prepare("SELECT uc.id_usuario_ceco AS 'id_usuario_ceco', cc.ceco AS 'centro_costo', cc.area_carrera AS 'area_carrera', us.nombre AS 'nombre_usuario'  FROM centro_costo cc JOIN usuario_ceco uc ON cc.id_centro_costo = uc.id_centro_costo JOIN usuario us ON uc.id_usuario = us.id_usuario ORDER BY cc.area_carrera ASC");
				$sql->execute();
				return $sql->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				throw new MyDatabaseException ($Exception->getMessage(), (int)$Exception->getCode());
			}
		}

		public function Insert($ceco_asoc)
		{
			try {
				$sql = $this->conn->prepare("INSERT INTO usuario_ceco (id_centro_costo, id_usuario) VALUES (?,?)");
				$sql->execute(array($ceco_asoc->id_centro_costo, $ceco_asoc->id_usuario));
				$response['status'] = "success";
				$response['message'] = "Centro de Costo Asociado Creado!";
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
				$sql = $this->conn->prepare("DELETE FROM usuario_ceco WHERE id_usuario_ceco=?");
				$sql->execute(array($id));
			} catch (Exception $e) {
				throw new MyDatabaseException ($Exception->getMessage(), (int)$Exception->getCode());
			}
		}
	}
?>
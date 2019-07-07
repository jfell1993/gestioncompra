<?php 
	class Centro_costo
	{

		private $conn;

		public $id_centro_costo;
		public $area_carrera;
		public $centro_costo;
		public $id_usuario;
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

		public function ListBy($nombre)
		{
			try {
				$sql = $this->conn->prepare("SELECT cc.ceco AS 'centro_costo', cc.area_carrera AS 'area_carrera' FROM centro_costo cc JOIN usuario_ceco uc ON cc.id_centro_costo = uc.id_centro_costo JOIN usuario us ON us.id_usuario = uc.id_usuario WHERE us.nombre = ? AND cc.deshabilitado = 0");
				$sql->execute(array($nombre));

				return $sql->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
			}
		}

		public function List()
		{
			try {
				$sql = $this->conn->prepare("SELECT * FROM centro_costo WHERE deshabilitado = 0");
				$sql->execute();
				return $sql->fetchAll(PDO::FETCH_OBJ);
				
			} catch (Exception $e) {
				throw new MyDatabaseException ($Exception->getMessage(), (int)$Exception->getCode());
			}
		}

		public function Get($id)
		{
			try {
				$sql = $this->conn->prepare("SELECT * FROM centro_costo WHERE id_centro_costo = ? AND deshabilitado = 0");
				$sql->execute(array($id));

				return $sql->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
			}
		}

		public function Get_by_ceco($ceco)
		{
			try {
				$sql = $this->conn->prepare("SELECT * FROM centro_costo WHERE ceco = ?");
				$sql->execute(array($ceco));

				return $sql->fetch(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
			}
		}

		public function Insert($cec)
		{
			try {
				$sql = $this->conn->prepare("INSERT INTO centro_costo (ceco, area_carrera, deshabilitado) VALUES (?,?,?)");
				$sql->execute(array(strtoupper($cec->centro_costo),strtoupper($cec->area_carrera),0));
				$response['status'] = "success";
				$response['message'] = "Centro de costo creado!";
			} catch (Exception $e) {
				$response['status'] = "error";
				$response['message'] = (int)$e->getCode( )." ".$e->getMessage( );
			}

			header('Content-type: application/json');
			echo json_encode($response);
		}
		public function Update($cec)
		{
			try {
				$sql = $this->conn->prepare("UPDATE centro_costo SET ceco=?, area_carrera=? WHERE id_centro_costo=?");
				$sql->execute(array(strtoupper($cec->centro_costo),strtoupper($cec->area_carrera),$cec->id_centro_costo));
				$response['status'] = "success";
				$response['message'] = "Centro de costo editado!";
			} catch (Exception $e) {
				$response['status'] = "error";
				$response['message'] = (int)$e->getCode( )." ".$e->getMessage( );
			}

			header('Content-type: application/json');
			echo json_encode($response);
		}

		public function Delete($id)
		{	
			try {
				$sql = $this->conn->prepare("UPDATE centro_costo SET deshabilitado = 1 WHERE id_centro_costo=?");
				$sql->execute(array($id));
			} catch (Exception $e) {
				throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
			}
		}
	}
?>
<?php

class Usuario {

	private $conn;

	public $id_usuario;
	public $nombre;
	public $email;
	public $password;
	public $deshabilitado;
	public $id_perfil;

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
		$sql = $this->conn->prepare("SELECT id_usuario AS 'id_usuario', us.nombre AS 'nombre', us.email AS 'email', pe.nombre AS 'perfil' FROM usuario us JOIN perfil pe ON us.id_perfil = pe.id_perfil WHERE deshabilitado = 0");
		$sql->execute();

		return $sql->fetchAll(PDO::FETCH_OBJ);
	}

	public function Get($id_usuario)
	{
		$sql = $this->conn->prepare("SELECT * FROM usuario WHERE id_usuario = ?");
		$sql->execute(array($id_usuario));

		return $sql->fetch(PDO::FETCH_OBJ);
	}

	public function Get_current($nombre)
	{
		$sql = $this->conn->prepare("SELECT * FROM usuario WHERE nombre = ?");
		$sql->execute(array($nombre));

		return $sql->fetch(PDO::FETCH_OBJ);
	}

	public function Insert($usu)
	{
		try {
			$sql = $this->conn->prepare("INSERT INTO usuario (nombre, email, password, deshabilitado, id_perfil) VALUES(?,?,?,?,?)");
			$usu->nombre = mb_strtoupper($usu->nombre);		
			$usu->password = password_hash($usu->password,PASSWORD_BCRYPT);
			$sql->execute(array($usu->nombre, $usu->email, $usu->password, 0, $usu->id_perfil));
		}
		catch( PDOException $Exception ) {
			throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		}
	}

	public function Update($usu)
	{
		try {
			$sql = $this->conn->prepare("UPDATE usuario SET nombre=?, email=?, password=?, id_perfil=? WHERE id_usuario=?");
			$usu->nombre = mb_strtoupper($usu->nombre);	
			$usu->password = password_hash($usu->password,PASSWORD_BCRYPT);
			$sql->execute(array($usu->nombre,$usu->email, $usu->password, $usu->id_perfil, $usu->id_usuario));
		}
		catch( PDOException $Exception ) {
			throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
		}
	}

	public function Delete($id) 
	{
		try {
			$sql = $this->conn->prepare("UPDATE usuario SET deshabilitado = 1 WHERE id_usuario = ?");
			$sql->execute(array($id));
		} catch (PDOException $Exception) {
			throw new MyDatabaseException( $Exception->getMessage(), (int)$Exception->getCode() );
		}
	}

}

?>

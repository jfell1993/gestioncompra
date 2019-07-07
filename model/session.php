<?php 

class Session {

	private $conn;
	
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

	public function Login($nombre, $password)
	{
		$sql = $this->conn->prepare("SELECT * FROM usuario WHERE email = '$nombre'");
		$sql->execute(array($nombre));

		if ($sql->rowCount() == 0) {
			$response['status'] = 'error';
			$response['message'] = 'Usuario incorrecto!';
		} else {
			if ($sql->rowCount() == 1) 
			{
				$user = $sql->fetch(PDO::FETCH_OBJ);

				if ($user->deshabilitado == 0) 
				{
					if (password_verify($password, $user->password) ) 
					{
				        $_SESSION['nombre'] = $user->nombre;
				        $_SESSION['conectado'] = true; 
				        $_SESSION['perfil'] = $user->id_perfil;
				        $response['status'] = 'success';
				    }
				    else 
				    {
				    	$response['status'] = 'error';
				        $response['message'] = 'Contraseña incorrecta!';
				    }
				}
				else
				{
					$response['status'] = 'error';
					$response['message'] = 'Usuario deshabilitado!';
				}
			} 
			else
			{
				$sql = $this->conn->prepare("SELECT * FROM usuario WHERE email = '$nombre' AND deshabilitado = 0");
				$sql->execute(array($nombre));

				$user = $sql->fetch(PDO::FETCH_OBJ);

				if ($user->deshabilitado == 0) 
				{
					if (password_verify($password, $user->password) ) 
					{
				        $_SESSION['nombre'] = $user->nombre;
				        $_SESSION['conectado'] = true; 
				        $_SESSION['perfil'] = $user->id_perfil;
				        $response['status'] = 'success';
				    }
				    else 
				    {
				    	$response['status'] = 'error';
				        $response['message'] = 'Contraseña incorrecta!';
				    }
				}
				else
				{
					$response['status'] = 'error';
					$response['message'] = 'Usuario deshabilitado!';
				}
			}
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}

}
	
?>
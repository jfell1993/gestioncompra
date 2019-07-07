<?php 
class Archivo
{
	private $conn;

	public $id_archivo;
    public $archivo;
    public $id_solicitud;

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

	public function List_by($id_solicitud)
	{
		$sql = $this->conn->prepare("SELECT * FROM archivo WHERE id_solicitud = ?");
		$sql->execute(array($id_solicitud));

		return $sql->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function Insert($id) {

		$folder = 'docs/';
		$file_count = count($_FILES['file']['name']);


		for ($i=0; $i < $file_count; $i++) { 

			$name = $_FILES['file']['name'][$i];
			$tmp_name = $_FILES['file']['tmp_name'][$i];
			$ext = strtolower(pathinfo($name,PATHINFO_EXTENSION));
			$name = pathinfo($name, PATHINFO_FILENAME);

			$sql = $this->conn->prepare("SELECT count(*) AS 'contador' FROM archivo");
			$sql->execute();
			$obj = $sql->fetch(PDO::FETCH_OBJ);
			$numero = $obj->contador;
			$new_name = $name." - ".$numero.".".$ext;
			$sql = $this->conn->prepare("INSERT INTO archivo (archivo, id_solicitud) VALUES ('$new_name', '$id')");
			$sql->execute();
			move_uploaded_file($tmp_name,$folder.$new_name);
		}
		
	}
}
?>
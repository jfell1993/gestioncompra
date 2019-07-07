<?php

require_once 'model/presupuesto.php';
require_once 'model/menu.php';
require_once 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class PresupuestoController
{
	private $model_pre;
	private $model_men;

	public function __CONSTRUCT()
	{
		$this->model_pre = new Presupuesto();
		$this->model_men = new Menu();
	}

	public function Index()
	{
		session_start();
		if ($_SESSION['perfil'] == 3) {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/list_presupuesto.php';
			require_once 'view/footer.php';
		} else {
			require_once 'view/header.php';
			require_once 'view/menu.php';
			require_once 'view/access_denied.php';
			require_once 'view/footer.php';
		}
	}

	public function Upload()
	{
		try {
			$folder = "docs/";
			$name = $_FILES['btn_presupuesto']['name'];
			$tmp_name = $_FILES['btn_presupuesto']['tmp_name'];
			$extention = substr(strrchr($name,'.'),1);
			if ($extention == "xlsx") {
				move_uploaded_file($tmp_name,$folder.$name);


				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
				$spreadsheet = $reader->load($folder.$name);

		        $worksheet = $spreadsheet->getSheet(0);

		        $columnCheck = $worksheet->getHighestColumn();

				if($columnCheck == 'S'){

					$count = 1;
					while ($worksheet->getCell("A".$count) == "") {
						$count++;
					}

					$highestRow = $worksheet->getHighestRow();

					$this->model_pre->Delete_All();

					for ($row = $count + 1; $row <= $highestRow; ++$row) {
						$pre = new Presupuesto();
				        $pre->sociedad = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
				        $pre->division = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
				        $pre->centro_costo = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
				        $pre->cuenta_mayor = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
				        $pre->actividad = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
				        $pre->detalle = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
				        $pre->enero = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
				        $pre->febrero = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
				        $pre->marzo = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
				        $pre->abril = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
				        $pre->mayo = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
				        $pre->junio = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
				        $pre->julio = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
				        $pre->agosto = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
				        $pre->septiembre = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
				        $pre->octubre = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
				        $pre->noviembre = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
				        $pre->diciembre = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
				        $pre->total = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
				        $this->model_pre->Insert($pre);
					}
				} else {
					$response['status'] = "error";
					$response['message'] = "Formato de archivo incorrecto!";
				}
				
				unlink($folder.$name);

				$response['status'] = "success";
				$response['message'] = "Presupuesto Cargado!";
			} else {
				$response['status'] = "error";
				$response['message'] = "Extension de archivo no admitida, solo se admiten archivos (xlsx)!";
			}
					
		} catch (Exception $e) {
			$response['status'] = "error";
			$response['message'] = (int)$e->getCode()." ".$e->getMessage();
		}

		header('Content-type: application/json');
		echo json_encode($response);

	}
}
?>

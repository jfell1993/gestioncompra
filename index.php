<?php

require_once 'model/database.php';

$controller = 'login';

if (!isset($_REQUEST['c'])) 
{
	require_once "controller/$controller.controller.php";
	$controller = ucwords($controller) . 'Controller';
	$controller = new $controller;
	$controller->Index();
} else {
	$controller = strtolower($_REQUEST['c']);
	$accion = $_REQUEST['a'];
	require_once "controller/$controller.controller.php";
	$controller = ucwords($controller) . 'Controller';
	$controller = new $controller;
	call_user_func(array($controller, $accion));
}

?>

 
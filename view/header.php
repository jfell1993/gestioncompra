<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Gestión Compra Dashboard</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="assets/datepicker/css/bootstrap-datepicker.min.css">
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="assets/select2/css/select2.css">
		<link rel="stylesheet" href="assets/gestioncompra/css/gestioncompra.css">
		<link rel="stylesheet" href="assets/gestioncompra/css/skin-blue.min.css">
		<link rel="stylesheet" href="assets/datatables/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="assets/datatables/css/responsive.bootstrap.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		<link rel="stylesheet" href="assets/icheck/skins/minimal/blue.css">
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="spinner">
			<div class="rect1"></div>
			<div class="rect2"></div>
			<div class="rect3"></div>
			<div class="rect4"></div>
			<div class="rect5"></div>
		</div>
		<div class="wrapper" id="content" style="display : none">
			<header class="main-header">
				<a class="logo">
					<span class="logo-mini"><b>GC</b></span>
					<span class="logo-lg"><b>GC</b> Gestión Compra</span>
				</a>
				<nav class="navbar navbar-static-top" role="navigation">
					<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
						<span class="sr-only">Navegar</span>
					</a>
					<div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li>
                            	<form method="POST" action="?c=Login&a=Disconnect" class="navbar-btn">
                                    <button type="submit" class="btn btn-default" name="desconectar">
                                        <span class="hidden-xs"> Desconectar</span>
                                        <i class="fa fa-sign-out"></i>
                                    </button>
                      	        </form>
                            </li>
                        </ul>
                    </div>
				</nav>
			</header>

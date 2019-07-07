<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu" data-widget="tree">
			<div class="sidebar-form">
			<p style="color:white; padding-left:10px; padding-top:5px; font-size:1.3em;">
				<?php 
				if(isset($_SESSION['conectado'])){
					$name_array = str_word_count($_SESSION['nombre'],1,'1234567890áéíóúñ.,;ÁÉÍÓÚÑ');
					if (sizeof($name_array) > 3) {
						echo $name_array[0]." ".$name_array[2].'<p style="color:white; padding-left:10px; font-size:0.7em;"><i class="fa fa-circle text-success"></i> CONECTADO</div></p>';
					}
					else
					{
						echo $name_array[0]." ".$name_array[1].'<p style="color:white; padding-left:10px; font-size:0.7em;"><i class="fa fa-circle text-success"></i> CONECTADO</div></p>';
					}
					
				} ?>
			</p>
			<li class="header">MENU PRINCIPAL</li>
			<?php foreach($this->model_men->List($_SESSION['perfil']) as $row): ?>
	        	<li>
					<a href="<?php echo $row->url ?>">
		            	<i class="<?php echo $row->ico ?>"></i>
		            	<span><?php echo $row->nombre ?></span>
		          	</a>
	        	</li>
			<?php endforeach; ?>
		</ul>
	</section>
</aside>
<div class="content-wrapper">
	<section class="content container-fluid">
		<section class="content">
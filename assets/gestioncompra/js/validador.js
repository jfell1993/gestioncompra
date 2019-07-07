function mensaje_success(mensaje) {
	var alert = '<div class="alert alert-success alert-dismissible" role="alert">' +
		'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
		'<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong> ' + mensaje + ' </div>';
	return alert;
}

function mensaje_error(mensaje) {
	var alert = '<div class="alert alert-danger alert-dismissible" role="alert">' +
		'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
		'<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + mensaje + '</div>';
	return alert;
}

function timeout() {
	window.setTimeout(function () {
		$(".alert").fadeTo(500, 0).slideUp(500, function () {
			$(this).remove();
		});
	}, 5000);
}

$(window).on('load', function(){
	$(".spinner").fadeOut("slow", function() {
			$("#content").fadeIn("slow");
			$('#dataTable').DataTable().responsive.recalc();
			$('#table_archivo').DataTable().responsive.recalc();
			$('#table_material_servicio').DataTable().responsive.recalc();
			$('#table_bandeja').DataTable().responsive.recalc();
			$('#table_usuario').DataTable().responsive.recalc();
	});
});

$(document).ready(function () {
	function check_session()
    {
        $.ajax({
        	url:"?c=Login&a=Check_timeout",
            method:"POST",
            success: function (data) {
            	if (data == true) {
            		window.location.href = "index.php?c=Login&a=Message_timeout";
            	}
            }
        });
    }
    var session_timeout = 15; // minutos para cerrar sesion
    setInterval(function(){
        check_session();
    }, session_timeout*60000);  //10000 means 10 seconds

    var datatable;

	dataTable = $("#dataTable").DataTable({
		language: { "url": "assets/datatables/js/spanish.js" },
		paging: true,
		lengthChange: true,
		lengthMenu: [[8, -1], [8, "Todos"]],
		searching: true,
		ordering: false,
		info: false,
		autoWidth: false,
		responsive: true,
		order: []
	});

	dataTable = $("#table_archivo").DataTable({
		language: { "url": "assets/datatables/js/spanish.js" },
		paging: false,
		lengthChange: false,
		lengthMenu: false,
		searching: false,
		ordering: true,
		info: false,
		autoWidth: false,
		responsive: true,
		order: []
	});

	dataTable = $("#table_material_servicio").DataTable({
		language: { "url": "assets/datatables/js/spanish.js" },
		paging: false,
		lengthChange: false,
		lengthMenu: false,
		searching: false,
		ordering: true,
		info: false,
		autoWidth: false,
		responsive: true,
		order: []
	});

	dataTable = $("#table_bandeja").DataTable({
		language: { "url": "assets/datatables/js/spanish.js" },
		paging: true,
		lengthChange: true,
		lengthMenu: [[5, -1], [5, "Todos"]],
		searching: true,
		ordering: false,
		info: false,
		autoWidth: false,
		responsive: true,
		order: []
	});

	dataTable = $("#table_usuario").DataTable({
		language: { "url": "assets/datatables/js/spanish.js" },
		paging: true,
		lengthChange: true,
		lengthMenu: [[8, -1], [8, "Todos"]],
		searching: true,
		ordering: false,
		info: false,
		autoWidth: false,
		responsive: true,
		order: []
	});

	dataTable = $("#table_producto").DataTable({
		language: { "url": "assets/datatables/js/spanish.js" },
		paging: true,
		lengthChange: true,
		lengthMenu: [[8, -1], [8, "Todos"]],
		searching: true,
		ordering: false,
		info: false,
		autoWidth: false,
		responsive: true,
		order: []
	});

	$('.select2').select2({
		width: '100%',
		placeholder: 'Seleccionar',
		language: 'es'
	});

	$('[name=txt_fecha_actividad]').datepicker({
		autoclose: true,
		language: 'es',
	});

	$('[name=txt_fecha_requerimiento]').datepicker({
		autoclose: true,
		language: 'es',
	});

	$("[name=ddl_documento_tributario]").val(['']).trigger('change');
	$("[name=ddl_medio_pago]").val(['']).trigger('change');
	$("[name=ddl_banco]").val(['']).trigger('change');
	$("[name=ddl_tipo_solicitud]").val(['']).trigger('change');
	$("[name=ddl_estado]").val(['']).trigger('change');
	$("[name=ddl_perfil_usuario]").val(['']).trigger('change');
	$("[name=ddl_cuenta_asoc]").val(['']).trigger('change');
	$("[name=ddl_centro_costo_asoc]").val(['']).trigger('change');
	$("[name=ddl_usuario_asoc]").val(['']).trigger('change');

	$('input').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass: 'iradio_minimal-blue',
		increaseArea: '20%'
	});

	var estado = $('[name=ddl_estado_edit]').val();

	if (estado == 6) {
		$('#div_archivos').css('display','block');
	} else {
		$('#div_archivos').css('display','none');
	}

	$("[name=form_login]").submit(function () {

		var usuario = $("[name=txt_nombre]").val();
		var password = $("[name=txt_password]").val();

		if (usuario == "") {
			$("[name=txt_nombre]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_nombre]").closest('.form-group').removeClass('has-error');
			$("[name=txt_nombre]").closest('.form-group').addClass('has-success');
		}

		if (password == "") {
			$("[name=txt_password]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_password]").closest('.form-group').removeClass('has-error');
			$("[name=txt_password]").closest('.form-group').addClass('has-success');
		}

		if (usuario && password) {

			var form = $('[name=form_login]')[0];
			var formData = new FormData(form);

			$.ajax({
				url: '?c=Login&a=Check',
				data: formData,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function (data) {
					if (data.status == 'success') {
						window.location.href = '?c=Solicitud&a=Index';
					} else if (data.status == 'error') {
						$(".mensajes").html(mensaje_error(data.message));
						if (data.message == "Usuario incorrecto!" ) {
							$("[name=txt_nombre]").closest('.form-group').addClass('has-error');
						} else if (data.message == "Contraseña incorrecta!") {
							$("[name=txt_password]").closest('.form-group').addClass('has-error');
						}
					}
				}
			});

		} else {

			$(".mensajes").html(mensaje_error('Error, complete los campos requeridos!'));

		}
		timeout();
		return false;
	});

	$("[name=form_proveedor]").submit(function () {

		var razon_social = $("[name=txt_razon_social]").val();
		var rut = $("[name=txt_rut]").val();
		var giro_actividad = $("[name=txt_giro_actividad]").val();
		var direccion = $("[name=txt_direccion]").val();
		var telefono = $("[name=txt_telefono]").val();
		var persona_contacto = $("[name=txt_persona_contacto]").val();
		var correo_electronico = $("[name=txt_correo_electronico]").val();
		var documento_tributario = $("[name=ddl_documento_tributario]").val();
		var medio_pago = $("[name=ddl_medio_pago]").val();
		var cuenta_empresa = $("[name=txt_cuenta_empresa]").val();
		var banco = $("[name=ddl_banco]").val();

		if (razon_social == "") {
			$("[name=txt_razon_social]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_razon_social]").closest('.form-group').removeClass('has-error');
			$("[name=txt_razon_social]").closest('.form-group').addClass('has-success');
		}

		if (rut == "") {
			$("[name=txt_rut]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_rut]").closest('.form-group').removeClass('has-error');
			$("[name=txt_rut]").closest('.form-group').addClass('has-success');
		}

		if (giro_actividad == "") {
			$("[name=txt_giro_actividad]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_giro_actividad]").closest('.form-group').removeClass('has-error');
			$("[name=txt_giro_actividad]").closest('.form-group').addClass('has-success');
		}

		if (direccion == "") {
			$("[name=txt_direccion]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_direccion]").closest('.form-group').removeClass('has-error');
			$("[name=txt_direccion]").closest('.form-group').addClass('has-success');
		}

		if (telefono == "") {
			$("[name=txt_telefono]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_telefono]").closest('.form-group').removeClass('has-error');
			$("[name=txt_telefono]").closest('.form-group').addClass('has-success');
		}

		if (persona_contacto == "") {
			$("[name=txt_persona_contacto]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_persona_contacto]").closest('.form-group').removeClass('has-error');
			$("[name=txt_persona_contacto]").closest('.form-group').addClass('has-success');
		}

		if (correo_electronico == "") {
			$("[name=txt_correo_electronico]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_correo_electronico]").closest('.form-group').removeClass('has-error');
			$("[name=txt_correo_electronico]").closest('.form-group').addClass('has-success');
		}

		if (documento_tributario == null) {
			$("[name=ddl_documento_tributario]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=ddl_documento_tributario]").closest('.form-group').removeClass('has-error');
			$("[name=ddl_documento_tributario]").closest('.form-group').addClass('has-success');
		}

		if (medio_pago == null) {
			$("[name=ddl_medio_pago]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=ddl_medio_pago]").closest('.form-group').removeClass('has-error');
			$("[name=ddl_medio_pago]").closest('.form-group').addClass('has-success');
		}

		if (cuenta_empresa == "") {
			$("[name=txt_cuenta_empresa]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_cuenta_empresa]").closest('.form-group').removeClass('has-error');
			$("[name=txt_cuenta_empresa]").closest('.form-group').addClass('has-success');
		}

		if (banco == null) {
			$("[name=ddl_banco]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=ddl_banco]").closest('.form-group').removeClass('has-error');
			$("[name=ddl_banco]").closest('.form-group').addClass('has-success');
		}

		if (razon_social && rut && giro_actividad && direccion && telefono && persona_contacto && correo_electronico && documento_tributario && medio_pago && cuenta_empresa && banco) {
			var form = $('[name=form_proveedor]')[0];
			var formData = new FormData(form);
			$.ajax({
				url: '?c=Proveedor&a=Add',
				data: formData,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function (data) {
					form.reset();
					$("[name=ddl_documento_tributario]").val(['']).trigger('change');
					$("[name=ddl_medio_pago]").val(['']).trigger('change');
					$("[name=ddl_banco]").val(['']).trigger('change');
					$(".mensajes").html(mensaje_success(data));
					$(".form-group").removeClass('has-error').removeClass('has-success');
				}
			});
		} else {
			$(".mensajes").html(mensaje_error('Error al agregar proveedor, completar campos requeridos!'));
		}

		timeout();
		return false;
	});

	$("[name=form_proveedor_edit]").submit(function () {

		var razon_social = $("[name=txt_razon_social_edit]").val();
		var rut = $("[name=txt_rut_edit]").val();
		var giro_actividad = $("[name=txt_giro_actividad_edit]").val();
		var direccion = $("[name=txt_direccion_edit]").val();
		var telefono = $("[name=txt_telefono_edit]").val();
		var persona_contacto = $("[name=txt_persona_contacto_edit]").val();
		var correo_electronico = $("[name=txt_correo_electronico_edit]").val();
		var documento_tributario = $("[name=ddl_documento_tributario_edit]").val();
		var medio_pago = $("[name=ddl_medio_pago_edit]").val();
		var cuenta_empresa = $("[name=txt_cuenta_empresa_edit]").val();
		var banco = $("[name=ddl_banco_edit]").val();


		if (razon_social == "") {
			$("[name=txt_razon_social_edit]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_razon_social_edit]").closest('.form-group').removeClass('has-error');
			$("[name=txt_razon_social_edit]").closest('.form-group').addClass('has-success');
		}

		if (rut == "") {
			$("[name=txt_rut_edit]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_rut_edit]").closest('.form-group').removeClass('has-error');
			$("[name=txt_rut_edit]").closest('.form-group').addClass('has-success');
		}

		if (giro_actividad == "") {
			$("[name=txt_giro_actividad_edit]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_giro_actividad_edit]").closest('.form-group').removeClass('has-error');
			$("[name=txt_giro_actividad_edit]").closest('.form-group').addClass('has-success');
		}

		if (direccion == "") {
			$("[name=txt_direccion_edit]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_direccion_edit]").closest('.form-group').removeClass('has-error');
			$("[name=txt_direccion_edit]").closest('.form-group').addClass('has-success');
		}

		if (telefono == "") {
			$("[name=txt_telefono_edit]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_telefono_edit]").closest('.form-group').removeClass('has-error');
			$("[name=txt_telefono_edit]").closest('.form-group').addClass('has-success');
		}

		if (persona_contacto == "") {
			$("[name=txt_persona_contacto_edit]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_persona_contacto_edit]").closest('.form-group').removeClass('has-error');
			$("[name=txt_persona_contacto_edit]").closest('.form-group').addClass('has-success');
		}

		if (correo_electronico == "") {
			$("[name=txt_correo_electronico_edit]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_correo_electronico_edit]").closest('.form-group').removeClass('has-error');
			$("[name=txt_correo_electronico_edit]").closest('.form-group').addClass('has-success');
		}

		if (cuenta_empresa == "") {
			$("[name=txt_cuenta_empresa_edit]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_cuenta_empresa_edit]").closest('.form-group').removeClass('has-error');
			$("[name=txt_cuenta_empresa_edit]").closest('.form-group').addClass('has-success');
		}

		if (razon_social && rut && giro_actividad && direccion && telefono && persona_contacto && correo_electronico && documento_tributario && medio_pago && cuenta_empresa && banco) {
			var form = $('[name=form_proveedor_edit]')[0];
			var formData = new FormData(form);
			$.ajax({
				url: '?c=Proveedor&a=Edit',
				data: formData,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function (data) {
					$(".mensajes").html(mensaje_success(data));
					$(".form-group").removeClass('has-error').removeClass('has-success');
				}
			});
		} else {
			$(".mensajes").html(mensaje_error('Error al editar proveedor, completar campos requeridos!'));
		}

		timeout();
		return false;
	});

	$("[name=form_update_presupuesto]").submit(function () {

		if (nombre) {

			$.ajax({
				url: '?c=Presupuesto&a=Upload',
				data: data,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function (response) {
					$(".message").html(mensaje_success(response));
					$(".form-group").removeClass('has-error').removeClass('has-success');
				}
			});
		} else {
			$(".message").html(mensaje_error('Error al agregar presupuesto!'));
		}
		timeout();
		return false;
	});

	$('[name=ddl_tipo_solicitud]').on('select2:select', function (e) {

		

		if ($('[name=ddl_tipo_solicitud]').select2('data')[0]['text'] == 'Producto') {

			$(".form-group").removeClass('has-error').removeClass('has-success');
			$('[name=form_solicitud]')[0].reset();
			$('[name=ddl_tipo_solicitud]').val(['1']).trigger('change');
			$('[name=ddl_area_carrera]').val(['']).trigger('change');
			$('#div_fecha_actividad').css('display', 'none');
			$('#div_fecha_requerimiento').css('display', 'block');
			$('#div_objetivo').css('display', 'block');
			$('#lbl_objetivo').text('Objetivo Compra');
			$('#div_cantidad_asistente').css('display', 'none');
			$('#div_lugar_actividad').css('display', 'none');
			$('#div_hora_salida_sede').css('display', 'none');
			$('#div_hora_regreso_sede').css('display', 'none');
			$('#div_usuario_solicitante').css('display', 'block');
			$('#div_area_carrera').css('display', 'block');
			$('#div_centro_costo').css('display', 'block');
			$('#div_cuenta').css('display', 'block');
			$('#div_oco').css('display', 'block');
			$('[name=ddl_cuenta]').empty();
			$('[name=ddl_cuenta]').val(['']).trigger('change');
			$('#lbl_material').css('display', 'block');
			$('#lbl_servicio').css('display', 'none');
			$('#spn_material').css('display', 'block');
			$('#spn_servicio').css('display', 'none');
			$('#div_detalle').css('display', 'block');

			$('[name=form_solicitud]').submit(function () {

				var id_tipo_solicitud = $('[name=ddl_tipo_solicitud]').val();
				var fecha_requerimiento = $('[name=txt_fecha_requerimiento]').val();
				var objetivo = $('[name=txt_objetivo]').val();
				var usuario_solicitante = $('[name=ddl_usuario_solicitante]').val();
				var area_carrera = $('[name=ddl_area_carrera]').val();
				var centro_costo = $('[name=txt_centro_costo]').val();
				var cuenta = $('[name=ddl_cuenta]').val();
				var oco = $('[name=txt_oco]').val();
				var file = $('#file').val();
				var table_material_servicio = $('#table_material_servicio').DataTable();
				var rows = table_material_servicio.rows().data();
				var list_material_servicio = {};
				for (var i = rows.length - 1; i >= 0; i--) {
					list_material_servicio[i] = {
						nombre: rows[i][0],
						codigo : rows[i][1],
						cantidad: rows[i][2],
						valor: rows[i][3]
					};
				}
				var json_list_material_servicio = JSON.stringify(list_material_servicio);

				if (fecha_requerimiento == "") {
					$("[name=txt_fecha_requerimiento]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=txt_fecha_requerimiento]").closest('.form-group').removeClass('has-error');
					$("[name=txt_fecha_requerimiento]").closest('.form-group').addClass('has-success');
				}
				if (objetivo == "") {
					$("[name=txt_objetivo]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=txt_objetivo]").closest('.form-group').removeClass('has-error');
					$("[name=txt_objetivo]").closest('.form-group').addClass('has-success');
				}
				if (usuario_solicitante == null) {
					$("[name=ddl_usuario_solicitante]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=ddl_usuario_solicitante]").closest('.form-group').removeClass('has-error');
					$("[name=ddl_usuario_solicitante]").closest('.form-group').addClass('has-success');
				}
				if (area_carrera == null) {
					$("[name=ddl_area_carrera]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=ddl_area_carrera]").closest('.form-group').removeClass('has-error');
					$("[name=ddl_area_carrera]").closest('.form-group').addClass('has-success');
				}
				if (centro_costo == "") {
					$("[name=txt_centro_costo]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=txt_centro_costo]").closest('.form-group').removeClass('has-error');
					$("[name=txt_centro_costo]").closest('.form-group').addClass('has-success');
				}
				if (cuenta == null) {
					$("[name=ddl_cuenta]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=ddl_cuenta]").closest('.form-group').removeClass('has-error');
					$("[name=ddl_cuenta]").closest('.form-group').addClass('has-success');
				}
				if (oco == "") 
				{
					$("[name=txt_oco]").closest('.form-group').addClass('has-success');
				} else 
				{
					$("[name=txt_oco]").closest('.form-group').addClass('has-success');
				}
				if (file == "") {
					$("#file").closest('.form-group').addClass('has-error');
				} else {
					$("#file").closest('.form-group').removeClass('has-error');
					$("#file").closest('.form-group').addClass('has-success');
				}

				if (id_tipo_solicitud && fecha_requerimiento && objetivo && usuario_solicitante && area_carrera && centro_costo && cuenta && file) {

					var form = $('[name=form_solicitud]')[0];
					var formData = new FormData(form);
					var fp = $("#file");
					var lg = fp[0].files.length;
					var items = fp[0].files;
					var err = false;
					var err_msj = "";
					var fileSize = 0;

					for (var i = 0; i < lg; i++) {
						fileSize += items[i].size;
					}

					if (fileSize > 30000000) {
						err_msj = "Peso maximo en archivos excedido! (máximo 30MB)";
						err = true;
					}

					if (err == false) {
						formData.append('json_list_material_servicio', json_list_material_servicio);
						if(rows.length == 0)
						{
							$(".mensajes").html(mensaje_error("Error tabla de detalle vacia!"));
						} else {
							var total = 0;
							for (var i = rows.length - 1; i >= 0; i--) {
								total += list_material_servicio[i]["cantidad"] * list_material_servicio[i]["valor"];
							}
							$.ajax({
								url: '?c=Solicitud&a=Check_presupuesto',
								data: {id_cuenta : cuenta, total : total},
								type: 'POST',
								success: function (response) {
									if (response.status == "success") {
										$.ajax({
											url: '?c=Solicitud&a=Add_producto',
											data: formData,
											processData: false,
											contentType: false,
											type: 'POST',
											success: function (response) {
												if (response.status == "success") {
													$(".mensajes").html(mensaje_success(response.message));
													$(".form-group").removeClass('has-error').removeClass('has-success');
												} else if (response.status == "error"){
													$(".mensajes").html(mensaje_error(response.message));
													$(".form-group").removeClass('has-error').removeClass('has-success');
												}
											}
										});
									} else if (response.status == "error"){
										$(".mensajes").html(mensaje_error(response.message));
										$(".form-group").removeClass('has-error').removeClass('has-success');
									}
								}
							});							
						}
					} else {
						$(".mensajes").html(mensaje_error(err_msj));
					}
				} else {
					$(".mensajes").html(mensaje_error('Error al agregar solicitud, complete los campos requeridos!'));
				}
				window.scrollTo(0, 0);
				timeout();
				return false;

			});
		}

		if ($('[name=ddl_tipo_solicitud]').select2('data')[0]['text'] == 'Actividad Dentro de Sede') {

			$(".form-group").removeClass('has-error').removeClass('has-success');
			$('[name=form_solicitud]')[0].reset();
			$('[name=ddl_tipo_solicitud]').val(['2']).trigger('change');
			$('[name=ddl_area_carrera]').val(['']).trigger('change');
			$('#div_fecha_actividad').css('display', 'block');
			$('#div_fecha_requerimiento').css('display', 'block');
			$('#div_objetivo').css('display', 'block');
			$('#lbl_objetivo').text('Objetivo Actividad');
			$('#div_cantidad_asistente').css('display', 'none');
			$('#div_lugar_actividad').css('display', 'block');
			$('#div_hora_salida_sede').css('display', 'none');
			$('#div_hora_regreso_sede').css('display', 'none');
			$('#div_usuario_solicitante').css('display', 'block');
			$('#div_area_carrera').css('display', 'block');
			$('#div_centro_costo').css('display', 'block');
			$('#div_cuenta').css('display','block');
			$('#div_oco').css('display', 'block');
			$('[name=ddl_cuenta]').empty();
			$('[name=ddl_cuenta]').val(['']).trigger('change');
			$('#lbl_material').css('display', 'none');
			$('#lbl_servicio').css('display', 'block');
			$('#spn_material').css('display', 'none');
			$('#spn_servicio').css('display', 'block');
			$('#div_detalle').css('display', 'block');

			$('[name=form_solicitud]').submit(function () {

				var id_tipo_solicitud = $('[name=ddl_tipo_solicitud]').val();
				var fecha_actividad = $('[name=txt_fecha_actividad]').val();
				var fecha_requerimiento = $('[name=txt_fecha_requerimiento]').val();
				var objetivo = $('[name=txt_objetivo]').val();
				var lugar_actividad = $('[name=txt_lugar_actividad]').val();
				var usuario_solicitante = $('[name=ddl_usuario_solicitante]').val();
				var area_carrera = $('[name=ddl_area_carrera]').val();
				var centro_costo = $('[name=txt_centro_costo]').val();
				var cuenta = $('[name=ddl_cuenta]').val();
				var oco = $('[name=txt_oco]').val();
				var file = $('#file').val();
				var table_material_servicio = $('#table_material_servicio').DataTable();
				var rows = table_material_servicio.rows().data();
				var list_material_servicio = {};
				for (var i = rows.length - 1; i >= 0; i--) {
					list_material_servicio[i] = {
						nombre: rows[i][0],
						codigo : rows[i][1],
						cantidad: rows[i][2],
						valor: rows[i][3]
					};
				}
				var json_list_material_servicio = JSON.stringify(list_material_servicio);


				if (fecha_actividad == "") {
					$("[name=txt_fecha_actividad]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=txt_fecha_actividad]").closest('.form-group').removeClass('has-error');
					$("[name=txt_fecha_actividad]").closest('.form-group').addClass('has-success');
				}
				if (fecha_requerimiento == "") {
					$("[name=txt_fecha_requerimiento]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=txt_fecha_requerimiento]").closest('.form-group').removeClass('has-error');
					$("[name=txt_fecha_requerimiento]").closest('.form-group').addClass('has-success');
				}
				if (objetivo == "") {
					$("[name=txt_objetivo]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=txt_objetivo]").closest('.form-group').removeClass('has-error');
					$("[name=txt_objetivo]").closest('.form-group').addClass('has-success');
				}
				if (lugar_actividad == "") {
					$("[name=txt_lugar_actividad]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=txt_lugar_actividad]").closest('.form-group').removeClass('has-error');
					$("[name=txt_lugar_actividad]").closest('.form-group').addClass('has-success');
				}
				if (usuario_solicitante == null) {
					$("[name=ddl_usuario_solicitante]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=ddl_usuario_solicitante]").closest('.form-group').removeClass('has-error');
					$("[name=ddl_usuario_solicitante]").closest('.form-group').addClass('has-success');
				}
				if (area_carrera == null) {
					$("[name=ddl_area_carrera]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=ddl_area_carrera]").closest('.form-group').removeClass('has-error');
					$("[name=ddl_area_carrera]").closest('.form-group').addClass('has-success');
				}
				if (centro_costo == "") {
					$("[name=txt_centro_costo]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=txt_centro_costo]").closest('.form-group').removeClass('has-error');
					$("[name=txt_centro_costo]").closest('.form-group').addClass('has-success');
				}
				if (cuenta == null) {
					$("[name=ddl_cuenta]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=ddl_cuenta]").closest('.form-group').removeClass('has-error');
					$("[name=ddl_cuenta]").closest('.form-group').addClass('has-success');
				}
				if (oco == "") 
				{
					$("[name=txt_oco]").closest('.form-group').addClass('has-success');
				} else {
					$("[name=txt_oco]").closest('.form-group').addClass('has-success');
				}
				if (file == "") {
					$("#file").closest('.form-group').addClass('has-error');
				} else {
					$("#file").closest('.form-group').removeClass('has-error');
					$("#file").closest('.form-group').addClass('has-success');
				}

				if (id_tipo_solicitud && fecha_actividad && fecha_requerimiento && objetivo && lugar_actividad && usuario_solicitante && area_carrera && centro_costo && cuenta && file)  {

					var form = $('[name=form_solicitud]')[0];
					var formData = new FormData(form);
					var fp = $("#file");
					var lg = fp[0].files.length;
					var items = fp[0].files;
					var err = false;
					var err_msj = "";
					var fileSize = 0;

					for (var i = 0; i < lg; i++) {
						fileSize += items[i].size;
					}

					if (fileSize > 30000000) {
						err_msj = "Peso maximo en archivos excedido! (máximo 30MB)";
						err = true;
					}

					if (!err) {
						formData.append('json_list_material_servicio', json_list_material_servicio);
						if(rows.length == 0)
						{
							$(".mensajes").html(mensaje_error("Error tabla de detalle vacia!"));
						} else {
							var total = 0;
							for (var i = rows.length - 1; i >= 0; i--) {
								total += list_material_servicio[i]["cantidad"] * list_material_servicio[i]["valor"];
							}
							$.ajax({
								url: '?c=Solicitud&a=Check_presupuesto',
								data: {id_cuenta : cuenta, total : total},
								type: 'POST',
								success: function (response) {
									if (response.status == "success") {
										$.ajax({
											url: '?c=Solicitud&a=Add_actividad_dentro',
											data: formData,
											processData: false,
											contentType: false,
											type: 'POST',
											success: function (response) {
												if (response.status == "success") {
													$(".mensajes").html(mensaje_success(response.message));
													$(".form-group").removeClass('has-error').removeClass('has-success');
												} else if (response.status == "error"){
													$(".mensajes").html(mensaje_error(response.message));
													$(".form-group").removeClass('has-error').removeClass('has-success');
												}
											}
										});
									} else if (response.status == "error"){
										$(".mensajes").html(mensaje_error(response.message));
										$(".form-group").removeClass('has-error').removeClass('has-success');
									}
								}
							});						
						}
					} else {
						$(".mensajes").html(mensaje_error(err_msj));
					}
				} else {
					$(".mensajes").html(mensaje_error('Error al agregar solicitud, complete los campos requeridos!'));
				}

				window.scrollTo(0, 0);
				timeout();
				return false;
			});

		}

		if ($('[name=ddl_tipo_solicitud]').select2('data')[0]['text'] == 'Actividad Fuera de Sede') {

			$(".form-group").removeClass('has-error').removeClass('has-success');
			$('[name=form_solicitud]')[0].reset();
			$('[name=ddl_tipo_solicitud]').val(['3']).trigger('change');
			$('[name=ddl_area_carrera]').val(['']).trigger('change');
			$('#div_fecha_actividad').css('display', 'block');
			$('#div_fecha_requerimiento').css('display', 'block');
			$('#div_objetivo_compra').css('display', 'block');
			$('#div_objetivo').css('display', 'block');
			$('#lbl_objetivo').text('Objetivo Actividad');
			$('#div_cantidad_asistente').css('display','block');
			$('#div_lugar_actividad').css('display', 'block');
			$('#div_hora_salida_sede').css('display', 'block');
			$('#div_hora_regreso_sede').css('display', 'block');
			$('#div_hora_regreso_sede').css('display', 'block');
			$('#div_usuario_solicitante').css('display', 'block');
			$('#div_area_carrera').css('display', 'block');
			$('#div_centro_costo').css('display', 'block');
			$('#div_cuenta').css('display','block');
			$('#div_oco').css('display', 'block');
			$('[name=ddl_cuenta]').empty();
			$('[name=ddl_cuenta]').val(['']).trigger('change');
			$('#lbl_material').css('display', 'none');
			$('#lbl_servicio').css('display', 'block');
			$('#spn_material').css('display', 'none');
			$('#spn_servicio').css('display', 'block');
			$('#div_detalle').css('display', 'block');


			$('[name=form_solicitud]').submit(function () {

				var fecha_actividad = $('[name=txt_fecha_actividad]').val();
				var fecha_requerimiento = $('[name=txt_fecha_requerimiento]').val();
				var objetivo = $('[name=txt_objetivo]').val();
				var cantidad_asistente = $('[name=txt_cantidad_asistente]').val();
				var lugar_actividad = $('[name=txt_lugar_actividad]').val();
				var hora_salida_sede = $('[name=txt_hora_salida_sede]').val();
				var hora_regreso_sede = $('[name=txt_hora_regreso_sede]').val();
				var usuario_solicitante = $('[name=ddl_usuario_solicitante]').val();
				var area_carrera = $('[name=ddl_area_carrera]').val();
				var centro_costo = $('[name=txt_centro_costo]').val();
				var cuenta = $('[name=ddl_cuenta]').val();
				var oco = $('[name=txt_oco]').val();
				var file = $('#file').val();
				var table_material_servicio = $('#table_material_servicio').DataTable();
				var rows = table_material_servicio.rows().data();
				var list_material_servicio = {};
				for (var i = rows.length - 1; i >= 0; i--) {
					list_material_servicio[i] = {
						nombre: rows[i][0],
						codigo : rows[i][1],
						cantidad: rows[i][2],
						valor: rows[i][3]
					};
				}
				var json_list_material_servicio = JSON.stringify(list_material_servicio);

				if (fecha_actividad == "") {
					$("[name=txt_fecha_actividad]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=txt_fecha_actividad]").closest('.form-group').removeClass('has-error');
					$("[name=txt_fecha_actividad]").closest('.form-group').addClass('has-success');
				}
				if (fecha_requerimiento == "") {
					$("[name=txt_fecha_requerimiento]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=txt_fecha_requerimiento]").closest('.form-group').removeClass('has-error');
					$("[name=txt_fecha_requerimiento]").closest('.form-group').addClass('has-success');
				}
				if (objetivo == "") {
					$("[name=txt_objetivo]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=txt_objetivo]").closest('.form-group').removeClass('has-error');
					$("[name=txt_objetivo]").closest('.form-group').addClass('has-success');
				}
				if (cantidad_asistente == "") {
					$("[name=txt_cantidad_asistente]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=txt_cantidad_asistente]").closest('.form-group').removeClass('has-error');
					$("[name=txt_cantidad_asistente]").closest('.form-group').addClass('has-success');
				}
				if (lugar_actividad == "") {
					$("[name=txt_lugar_actividad]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=txt_lugar_actividad]").closest('.form-group').removeClass('has-error');
					$("[name=txt_lugar_actividad]").closest('.form-group').addClass('has-success');
				}
				if (hora_salida_sede == "") {
					$("[name=txt_hora_salida_sede]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=txt_hora_salida_sede]").closest('.form-group').removeClass('has-error');
					$("[name=txt_hora_salida_sede]").closest('.form-group').addClass('has-success');
				}
				if (hora_regreso_sede == "") {
					$("[name=txt_hora_regreso_sede]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=txt_hora_regreso_sede]").closest('.form-group').removeClass('has-error');
					$("[name=txt_hora_regreso_sede]").closest('.form-group').addClass('has-success');
				}
				if (usuario_solicitante == null) {
					$("[name=ddl_usuario_solicitante]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=ddl_usuario_solicitante]").closest('.form-group').removeClass('has-error');
					$("[name=ddl_usuario_solicitante]").closest('.form-group').addClass('has-success');
				}
				if (area_carrera == null) {
					$("[name=ddl_area_carrera]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=ddl_area_carrera]").closest('.form-group').removeClass('has-error');
					$("[name=ddl_area_carrera]").closest('.form-group').addClass('has-success');
				}
				if (centro_costo == "") {
					$("[name=txt_centro_costo]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=txt_centro_costo]").closest('.form-group').removeClass('has-error');
					$("[name=txt_centro_costo]").closest('.form-group').addClass('has-success');
				}
				if (cuenta == null) {
					$("[name=ddl_cuenta]").closest('.form-group').addClass('has-error');
				} else {
					$("[name=ddl_cuenta]").closest('.form-group').removeClass('has-error');
					$("[name=ddl_cuenta]").closest('.form-group').addClass('has-success');
				}
				if (file == "") {
					$("#file").closest('.form-group').addClass('has-error');
				} else {
					$("#file").closest('.form-group').removeClass('has-error');
					$("#file").closest('.form-group').addClass('has-success');
				}
				if (oco == "") 
				{
					$("[name=txt_oco]").closest('.form-group').addClass('has-success');
				} else {
					$("[name=txt_oco]").closest('.form-group').addClass('has-success');
				}
				if (fecha_actividad && fecha_requerimiento && objetivo && lugar_actividad && hora_salida_sede && hora_regreso_sede && usuario_solicitante && area_carrera && centro_costo && cuenta && file) {
					var form = $('[name=form_solicitud]')[0];
					var formData = new FormData(form);
					var fp = $("#file");
					var lg = fp[0].files.length;
					var items = fp[0].files;
					var err = false;
					var err_msj = "";
					var fileSize = 0;

					for (var i = 0; i < lg; i++) {
						fileSize += items[i].size;
					}

					if (fileSize > 30000000) {
						err_msj = "Peso maximo en archivos excedido! (máximo 30MB)";
						err = true;
					}

					if (!err) {
						formData.append('json_list_material_servicio', json_list_material_servicio);
						if(rows.length == 0)
						{
							$(".mensajes").html(mensaje_error("Error tabla de detalle vacia!"));
						} else {
							var total = 0;
							for (var i = rows.length - 1; i >= 0; i--) {
								total += list_material_servicio[i]["cantidad"] * list_material_servicio[i]["valor"];
							}
							$.ajax({
								url: '?c=Solicitud&a=Check_presupuesto',
								data: {id_cuenta : cuenta, total : total},
								type: 'POST',
								success: function (response) {
									if (response.status == "success") {
										$.ajax({
											url: '?c=Solicitud&a=Add_actividad_fuera',
											data: formData,
											processData: false,
											contentType: false,
											type: 'POST',
											success: function (response) {
												if (response.status == "success") {
													$(".mensajes").html(mensaje_success(response.message));
													$(".form-group").removeClass('has-error').removeClass('has-success');
												} else if (response.status == "error"){
													$(".mensajes").html(mensaje_error(response.message));
													$(".form-group").removeClass('has-error').removeClass('has-success');
												}
											}
										});
									} else if (response.status == "error"){
										$(".mensajes").html(mensaje_error(response.message));
										$(".form-group").removeClass('has-error').removeClass('has-success');
									}
								}
							});				
						}
					} else {
						$(".mensajes").html(mensaje_error(err_msj));
					}
				} else {
					$(".mensajes").html(mensaje_error('Error al agregar solicitud, complete los campos requeridos!'));
				}
				window.scrollTo(0, 0);
				timeout();
				return false;
			});
		}
	});

	$('[name=ddl_area_carrera]').on('select2:select', function (e) {
		var id_centro_costo = $('[name=ddl_area_carrera]').select2('val');
		$('[name=txt_centro_costo]').val(id_centro_costo);
		$('[name=ddl_cuenta]').empty();
		$.ajax({
			url: '?c=Solicitud&a=List_cuenta',
			data: { id_centro_costo: id_centro_costo },
			type: 'POST',
			success: function (response) {
				$('[name=ddl_cuenta]').append(response);
				$('[name=ddl_cuenta]').val(['']).trigger('change');
			}
		});
	});

	$('#table_material_servicio tbody').on('click', 'button.btn-danger', function () {
		var table = $('#table_material_servicio').DataTable();
		table.row($(this).parents('tr')).remove().draw();
	});

	$('[name=ddl_estado]').on('select2:select', function (e) {
		var estado = $("[name=ddl_estado] option:selected").text();
		$.ajax({
			url: '?c=Solicitud&a=List_estado',
			data: { estado: estado },
			type: 'POST',
			success: function (response) {
				window.location.reload();
			}
		});
	});

	$('[name=ddl_estado_edit]').on('select2:select', function (e) {
		var estado = $('[name=ddl_estado_edit]').val();
		if (estado == 6) {
			$('#div_archivos').css('display','block');
		} else {
			$('#div_archivos').css('display','none');
		}
	});

	$("[name=form_usuario]").submit(function () {

		var nombre = $("[name=txt_nombre_usuario]").val();
		var email = $("[name=txt_email_usuario]").val();
		var password = $("[name=txt_password_usuario]").val();
		var perfil = $("[name=ddl_perfil_usuario]").val();
		var words = $.trim($("[name=txt_nombre_usuario]").val()).split(" ");
		var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		var err = false;
		var err_msg = "";

		if (nombre == "") {
			$("[name=txt_nombre_usuario]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_nombre_usuario]").closest('.form-group').removeClass('has-error');
			$("[name=txt_nombre_usuario]").closest('.form-group').addClass('has-success');
		}

		if (email == "") {
			$("[name=txt_email_usuario]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_email_usuario]").closest('.form-group').removeClass('has-error');
			$("[name=txt_email_usuario]").closest('.form-group').addClass('has-success');
		}

		if (password == "") {
			$("[name=txt_password_usuario]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_password_usuario]").closest('.form-group').removeClass('has-error');
			$("[name=txt_password_usuario]").closest('.form-group').addClass('has-success');
		}

		if (perfil == null) {
			$("[name=ddl_perfil_usuario]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=ddl_perfil_usuario]").closest('.form-group').removeClass('has-error');
			$("[name=ddl_perfil_usuario]").closest('.form-group').addClass('has-success');
		}

		if (nombre && email && password && perfil) 
		{

			if (words.length > 2) 
			{
				$("[name=txt_nombre_usuario]").closest('.form-group').removeClass('has-error');
				$("[name=txt_nombre_usuario]").closest('.form-group').addClass('has-success');
			} 
			else
			{
				err = true;
				$("[name=txt_nombre_usuario]").closest('.form-group').addClass('has-error');
				$(".mensajes").html(mensaje_error('Error, formato de nombre incorrecto!'));
				err_msg = "Formato de nombre incorrecto! ";
			}

		    if (filter.test(email)) 
		    {
		    	
				$("[name=txt_email_usuario]").closest('.form-group').removeClass('has-error');
				$("[name=txt_email_usuario]").closest('.form-group').addClass('has-success');
		    }
		    else 
		    {
		    	err = true;
		    	$("[name=txt_email_usuario]").closest('.form-group').addClass('has-error');
		    	err_msg += "Formato de email incorrecto! ";
		    } 

		    if (!err) 
		    {
		    	var form = $('[name=form_usuario]')[0];
				var formData = new FormData(form);
				$.ajax({
				url: '?c=Usuario&a=Add',
				data: formData,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function (data) {
					$(".mensajes").html(mensaje_success(data));
					$(".form-group").removeClass('has-error').removeClass('has-success');
				}
				});
		    }	
		    else
		    {
		    	$(".mensajes").html(mensaje_error(err_msg));
		    }
		} 
		else 
		{
			$(".mensajes").html(mensaje_error('Error al crear usuario, completar campos requeridos!'));
		}

		timeout();
		return false;
	});
	
	$("[name=form_usuario_edit]").submit(function () {

		var nombre = $("[name=txt_nombre_usuario_edit]").val();
		var email = $("[name=txt_email_usuario_edit]").val();
		var password = $("[name=txt_password_usuario_edit]").val();
		var perfil = $("[name=ddl_perfil_usuario_edit]").val();
		var words = $.trim($("[name=txt_nombre_usuario_edit]").val()).split(" ");
		var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		var err = false;
		var err_msg = "";

		if (nombre == "") 
		{
			$("[name=txt_nombre_usuario_edit]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_nombre_usuario_edit]").closest('.form-group').removeClass('has-error');
			$("[name=txt_nombre_usuario_edit]").closest('.form-group').addClass('has-success');
		}

		if (email == "") 
		{
			$("[name=txt_email_usuario_edit]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_email_usuario_edit]").closest('.form-group').removeClass('has-error');
			$("[name=txt_email_usuario_edit]").closest('.form-group').addClass('has-success');
		}

		if (password == "") 
		{
			$("[name=txt_password_usuario_edit]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_password_usuario_edit]").closest('.form-group').removeClass('has-error');
			$("[name=txt_password_usuario_edit]").closest('.form-group').addClass('has-success');
		}

		if (perfil == null) 
		{
			$("[name=ddl_perfil_usuario_edit]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=ddl_perfil_usuario_edit]").closest('.form-group').removeClass('has-error');
			$("[name=ddl_perfil_usuario_edit]").closest('.form-group').addClass('has-success');
		}

		if (password == "**********")
		{
			$("[name=txt_password_usuario_edit]").val("password");
		}

		if (nombre && email && password && perfil) {

			if (words.length > 2) 
			{
				$("[name=txt_nombre_usuario_edit]").closest('.form-group').removeClass('has-error');
				$("[name=txt_nombre_usuario_edit]").closest('.form-group').addClass('has-success');
			} 
			else
			{
				err = true;
				$("[name=txt_nombre_usuario_edit]").closest('.form-group').addClass('has-error');
				$(".mensajes").html(mensaje_error('Error, formato de nombre incorrecto!'));
				err_msg = "Formato de nombre incorrecto! ";
			}

		    if (filter.test(email)) 
		    {
		    	
				$("[name=txt_email_usuario_edit]").closest('.form-group').removeClass('has-error');
				$("[name=txt_email_usuario_edit]").closest('.form-group').addClass('has-success');
		    }
		    else 
		    {
		    	err = true;
		    	$("[name=txt_email_usuario_edit]").closest('.form-group').addClass('has-error');
		    	err_msg += "Formato de email incorrecto! ";
		    } 

		    if (!err) 
		    {
				var form = $('[name=form_usuario_edit]')[0];
				var formData = new FormData(form);
				$.ajax({
					url: '?c=Usuario&a=Edit',
					data: formData,
					processData: false,
					contentType: false,
					type: 'POST',
					success: function (data) {
						$(".mensajes").html(mensaje_success(data));
						$(".form-group").removeClass('has-error').removeClass('has-success');
					}
				});
			}
			else
			{
				$(".mensajes").html(mensaje_error(err_msg));
			}
		} else {
			$(".mensajes").html(mensaje_error('Error al editar usuario, completar campos requeridos!'));
		}

		timeout();
		return false;
	});

	$("[name=form_solicitud_edit]").submit(function () {

		var form = $('[name=form_solicitud_edit]')[0];
		var formData = new FormData(form);
		var estado = $('[name=ddl_estado_edit]').val();

		if(estado == 6){
			var fp = $("#file");
			var lg = fp[0].files.length;
			var items = fp[0].files;
			var err = false;
			var err_msj = "";
			var fileSize = 0;

			for (var i = 0; i < lg; i++) {
				fileSize += items[i].size;
			}

			if (fileSize > 30000000) {
				err_msj = "Peso maximo en archivos excedido! (máximo 30MB)";
				err = true;
			}

			if (err == false) {
				$.ajax({
					url: '?c=Solicitud&a=Edit_file',
					data: formData,
					processData: false,
					contentType: false,
					type: 'POST',
					success: function (response) {
						$(".mensajes").html(mensaje_success(response));
						$(".form-group").removeClass('has-error').removeClass('has-success');
					}
				});
			} else {
				$(".mensajes").html(mensaje_error(err_msj));
			}
		} else {
			$.ajax({
				url: '?c=Solicitud&a=Edit',
				data: formData,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function (response) {
					if (response.status == "success") {
						$(".mensajes").html(mensaje_success(response.message));
						$(".form-group").removeClass('has-error').removeClass('has-success');
					} else if (response.status == "error"){
						$(".mensajes").html(mensaje_error(response.message));
						$(".form-group").removeClass('has-error').removeClass('has-success');
					}
				}
			});
		}
		window.scrollTo(0, 0);
		timeout();
		return false;
	});

	$("[name=form_centro_costo]").submit(function () {

		var centro_costo = $("[name=txt_centro_costo]").val();
		var area_carrera = $("[name=txt_area_carrera]").val();

		if (centro_costo == "") {
			$("[name=txt_centro_costo]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_centro_costo]").closest('.form-group').removeClass('has-error');
			$("[name=txt_centro_costo]").closest('.form-group').addClass('has-success');
		}

		if (area_carrera == "") {
			$("[name=txt_area_carrera]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_area_carrera]").closest('.form-group').removeClass('has-error');
			$("[name=txt_area_carrera]").closest('.form-group').addClass('has-success');
		}

		if (centro_costo && area_carrera) 
		{

			var form = $('[name=form_centro_costo]')[0];
			var formData = new FormData(form);

			$("[name=txt_centro_costo]").closest('.form-group').removeClass('has-success');
			$("[name=txt_area_carrera]").closest('.form-group').removeClass('has-success');


			$.ajax({
				url: '?c=Centro_costo&a=Add',
				data: formData,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function (response) {
					if (response.status == 'success') 
					{
						$(".mensajes").html(mensaje_success(response.message));
					} else if (response.status == 'error') 
					{
						$(".mensajes").html(mensaje_error(response.message));
					}
				}
			});	

		} else {
			$(".mensajes").html(mensaje_error('Error, complete los campos requeridos!'));
		}
		timeout();
		return false;
	});

	$("[name=form_centro_costo_edit]").submit(function () {

		var centro_costo = $("[name=txt_centro_costo]").val();
		var area_carrera = $("[name=txt_area_carrera]").val();

		if (centro_costo == "") {
			$("[name=txt_centro_costo]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_centro_costo]").closest('.form-group').removeClass('has-error');
			$("[name=txt_centro_costo]").closest('.form-group').addClass('has-success');
		}

		if (area_carrera == "") {
			$("[name=txt_area_carrera]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_area_carrera]").closest('.form-group').removeClass('has-error');
			$("[name=txt_area_carrera]").closest('.form-group').addClass('has-success');
		}

		if (centro_costo && area_carrera) 
		{

			var form = $('[name=form_centro_costo_edit]')[0];
			var formData = new FormData(form);

			$("[name=txt_centro_costo]").closest('.form-group').removeClass('has-success');
			$("[name=txt_area_carrera]").closest('.form-group').removeClass('has-success');


			$.ajax({
				url: '?c=Centro_costo&a=Edit',
				data: formData,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function (response) {
					if (response.status == 'success') 
					{
						$(".mensajes").html(mensaje_success(response.message));
					} else if (response.status == 'error') 
					{
						$(".mensajes").html(mensaje_error(response.message));
					}
				}
			});	

		} else {
			$(".mensajes").html(mensaje_error('Error, complete los campos requeridos!'));
		}
		timeout();
		return false;
	});

	$("[name=form_centro_costo_asoc]").submit(function () {

		var id_centro_costo = $("[name=ddl_centro_costo_asoc]").val();
		var id_usuario = $("[name=ddl_usuario_asoc]").val();

		if (id_centro_costo == null) {
			$("[name=ddl_centro_costo_asoc]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=ddl_centro_costo_asoc]").closest('.form-group').removeClass('has-error');
			$("[name=ddl_centro_costo_asoc]").closest('.form-group').addClass('has-success');
		}

		if (id_usuario == null) {
			$("[name=ddl_usuario_asoc]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=ddl_usuario_asoc]").closest('.form-group').removeClass('has-error');
			$("[name=ddl_usuario_asoc]").closest('.form-group').addClass('has-success');
		}

		if (id_centro_costo && id_usuario) 
		{

			var form = $('[name=form_centro_costo_asoc]')[0];
			var formData = new FormData(form);

			$("[name=ddl_centro_costo_asoc]").closest('.form-group').removeClass('has-success');
			$("[name=ddl_usuario_asoc]").closest('.form-group').removeClass('has-success');


			$.ajax({
				url: '?c=Centro_costo_asoc&a=Add',
				data: formData,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function (response) {
					if (response.status == 'success') 
					{
						$(".mensajes").html(mensaje_success(response.message));
					} else if (response.status == 'error') 
					{
						$(".mensajes").html(mensaje_error(response.message));
					}
				}
			});	

		} else {
			$(".mensajes").html(mensaje_error('Error, complete los campos requeridos!'));
		}
		timeout();
		return false;
	});

	$("[name=form_cuenta]").submit(function () {

		var nro_cuenta = $("[name=txt_nro_cuenta]").val();
		var descripcion = $("[name=txt_descripcion]").val();

		if (nro_cuenta == "") {
			$("[name=txt_nro_cuenta]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_nro_cuenta]").closest('.form-group').removeClass('has-error');
			$("[name=txt_nro_cuenta]").closest('.form-group').addClass('has-success');
		}

		if (descripcion == "") {
			$("[name=txt_descripcion]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_descripcion]").closest('.form-group').removeClass('has-error');
			$("[name=txt_descripcion]").closest('.form-group').addClass('has-success');
		}

		if (nro_cuenta && descripcion) 
		{

			var form = $('[name=form_cuenta]')[0];
			var formData = new FormData(form);

			$("[name=txt_nro_cuenta]").closest('.form-group').removeClass('has-success');
			$("[name=txt_descripcion]").closest('.form-group').removeClass('has-success');


			$.ajax({
				url: '?c=Cuenta&a=Add',
				data: formData,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function (response) {
					if (response.status == 'success') 
					{
						$(".mensajes").html(mensaje_success(response.message));
					} else if (response.status == 'error') 
					{
						$(".mensajes").html(mensaje_error(response.message));
					}
				}
			});	

		} else {
			$(".mensajes").html(mensaje_error('Error, complete los campos requeridos!'));
		}
		timeout();
		return false;
	});

	$("[name=form_cuenta_asoc]").submit(function () {

		var cuenta = $("[name=ddl_cuenta_asoc]").val();
		var centro_costo = $("[name=ddl_centro_costo_asoc]").val();

		if (cuenta == null) {
			$("[name=ddl_cuenta_asoc]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=ddl_cuenta_asoc]").closest('.form-group').removeClass('has-error');
			$("[name=ddl_cuenta_asoc]").closest('.form-group').addClass('has-success');
		}

		if (centro_costo == null) {
			$("[name=ddl_centro_costo_asoc]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=ddl_centro_costo_asoc]").closest('.form-group').removeClass('has-error');
			$("[name=ddl_centro_costo_asoc]").closest('.form-group').addClass('has-success');
		}

		if (cuenta && centro_costo) 
		{

			var form = $('[name=form_cuenta_asoc]')[0];
			var formData = new FormData(form);

			$("[name=ddl_cuenta_asoc]").closest('.form-group').removeClass('has-success');
			$("[name=ddl_centro_costo_asoc]").closest('.form-group').removeClass('has-success');


			$.ajax({
				url: '?c=Cuenta_asoc&a=Add',
				data: formData,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function (response) {
					if (response.status == 'success') 
					{
						$(".mensajes").html(mensaje_success(response.message));
					} else if (response.status == 'error') 
					{
						$(".mensajes").html(mensaje_error(response.message));
					}
				}
			});	

		} else {
			$(".mensajes").html(mensaje_error('Error, complete los campos requeridos!'));
		}
		timeout();
		return false;
	});

	$("[name=form_cuenta_edit]").submit(function () {

		var nro_cuenta = $("[name=txt_nro_cuenta]").val();
		var descripcion = $("[name=txt_descripcion]").val();

		if (nro_cuenta == "") {
			$("[name=txt_nro_cuenta]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_nro_cuenta]").closest('.form-group').removeClass('has-error');
			$("[name=txt_nro_cuenta]").closest('.form-group').addClass('has-success');
		}

		if (descripcion == "") {
			$("[name=txt_descripcion]").closest('.form-group').addClass('has-error');
		} else {
			$("[name=txt_descripcion]").closest('.form-group').removeClass('has-error');
			$("[name=txt_descripcion]").closest('.form-group').addClass('has-success');
		}

		if (nro_cuenta && descripcion) 
		{

			var form = $('[name=form_cuenta_edit]')[0];
			var formData = new FormData(form);

			$("[name=txt_nro_cuenta]").closest('.form-group').removeClass('has-success');
			$("[name=txt_descripcion]").closest('.form-group').removeClass('has-success');


			$.ajax({
				url: '?c=Cuenta&a=Edit',
				data: formData,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function (response) {
					if (response.status == 'success') 
					{
						$(".mensajes").html(mensaje_success(response.message));
					} else if (response.status == 'error') 
					{
						$(".mensajes").html(mensaje_error(response.message));
					}
				}
			});	

		} else {
			$(".mensajes").html(mensaje_error('Error, complete los campos requeridos!'));
		}
		timeout();
		return false;
	});

	$('[name=form_upload_presupuesto]').submit(function(){
		var file = $('[name=btn_presupuesto]').val();
		if (file == "") {
			$(".message").html(mensaje_error("Seleccione un archivo"));
		}

		if (file) {

			var form = $('[name=form_upload_presupuesto]')[0];
			var formData = new FormData(form);

			$.ajax({
				url : '?c=Presupuesto&a=Upload',
				data: formData,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function(response) {
					if (response.status == 'success') {
						$(".message").html(mensaje_success(response.message));
						setTimeout(function() {
						    location.reload();
						}, 5000);
					} else if(response.status == "error") {
						$(".message").html(mensaje_error(response.message));
					}
				}
			});
		}
		timeout();
		return false;
	});

	$('[name=form_producto]').submit(function(){
		var form = $('[name=form_producto]')[0];
		var formData = new FormData(form);

		$.ajax({
			url : '?c=Producto&a=Add',
			data: formData,
			processData: false,
			contentType: false,
			type: 'POST',
			success: function(response) {
				if (response.status == 'success') {
					$(".message").html(mensaje_success(response.message));
				} else if(response.status == "error") {
					$(".message").html(mensaje_error(response.message));
				}
			}
		});

		timeout();
		return false;
	});

	$('[name=form_producto_edit]').submit(function(){
		var form = $('[name=form_producto_edit]')[0];
		var formData = new FormData(form);

		$.ajax({
			url : '?c=Producto&a=Edit',
			data: formData,
			processData: false,
			contentType: false,
			type: 'POST',
			success: function(response) {
				if (response.status == 'success') {
					$(".message").html(mensaje_success(response.message));
				} else if(response.status == "error") {
					$(".message").html(mensaje_error(response.message));
				}
			}
		});

		timeout();
		return false;
	});

	$("[name=txt_material_servicio]").keyup(function(){
		$.ajax({
		type: "POST",
		url: "?c=Solicitud&a=List_producto_by",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("[name=txt_material_servicio]").css("background","#FFF url(assets/gestioncompra/img/LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("[name=txt_material_servicio]").css("background","#FFF");
		}
		});
	});

});

function selectProducto(nombre) {
	$("[name=txt_material_servicio]").val(nombre);
	$("#suggesstion-box").hide();
	$.ajax({
		type: "POST",
		url: "?c=Solicitud&a=Get_producto_cod_valor",
		data: {nombre : nombre},
		success: function(response){
			$("[name=txt_codigo]").val(response.codigo);
			$("[name=txt_valor_unitario]").val(parseInt(response.valor));
			$("[name=txt_cantidad]").val(1);
		}
	});
}

function add_material_servicio() {

	var table = $('#table_material_servicio').DataTable();

	var codigo = $('[name=txt_codigo]').val();
	var material_servicio = $('[name=txt_material_servicio]').val();
	var cantidad = $('[name=txt_cantidad]').val();
	var valor_unitario = $('[name=txt_valor_unitario]').val();
	var eliminar = '<p class="text-center"><button class="btn btn-danger"><i class="fa fa-trash"></button></p>';

	if (codigo == "") {
		$("[name=txt_codigo]").closest('.form-group').addClass('has-error');
	} else {
		$("[name=txt_codigo]").closest('.form-group').removeClass('has-error');
		$("[name=txt_codigo]").closest('.form-group').addClass('has-success');
	}
	if (material_servicio == "") {
		$("[name=txt_material_servicio]").closest('.form-group').addClass('has-error');
	} else {
		$("[name=txt_material_servicio]").closest('.form-group').removeClass('has-error');
		$("[name=txt_material_servicio]").closest('.form-group').addClass('has-success');
	}
	if (cantidad == "") {
		$("[name=txt_cantidad]").closest('.form-group').addClass('has-error');
	} else {
		$("[name=txt_cantidad]").closest('.form-group').removeClass('has-error');
		$("[name=txt_cantidad]").closest('.form-group').addClass('has-success');
	}
	if (valor_unitario == "") {
		$("[name=txt_valor_unitario]").closest('.form-group').addClass('has-error');
	} else {
		$("[name=txt_valor_unitario]").closest('.form-group').removeClass('has-error');
		$("[name=txt_valor_unitario]").closest('.form-group').addClass('has-success');
	}

	if (codigo && material_servicio && cantidad && valor_unitario) {
		$(".form-group").removeClass('has-error').removeClass('has-success');
		table.row.add([
			material_servicio,
			codigo,
			cantidad,
			valor_unitario,
			eliminar
		]).draw(false);
		$('[name=txt_codigo]').val('');
		$('[name=txt_material_servicio]').val('');
		$('[name=txt_cantidad]').val('');
		$('[name=txt_valor_unitario]').val('');
	}
}

function delete_usuario(id = null) 
{
	if(id)
	{
		$("#removeBtn").unbind('click').bind('click', function() {
			$.ajax({
				url : "?c=Usuario&a=Delete",
				data : {id : id},
				dataType: false,
				type: 'POST',
				success: function(response) 
				{
					location.reload();					
				}
			});
		});
	}
}

function delete_centro_costo(id = null) 
{
	if(id)
	{
		$("#removeBtn").unbind('click').bind('click', function() {
			$.ajax({
				url : "?c=Centro_costo&a=Delete",
				data : {id : id},
				dataType: false,
				type: 'POST',
				success: function(response) 
				{
					location.reload();					
				}
			});
		});
	}
}

function delete_cuenta(id = null) 
{
	if(id)
	{
		$("#removeBtn").unbind('click').bind('click', function() {
			$.ajax({
				url : "?c=Cuenta&a=Delete",
				data : {id : id},
				dataType: false,
				type: 'POST',
				success: function(response) 
				{
					location.reload();					
				}
			});
		});
	}
}

function delete_cuenta_asoc(id = null) 
{
	if(id)
	{
		$("#removeBtn").unbind('click').bind('click', function() {
			$.ajax({
				url : "?c=Cuenta_asoc&a=Delete",
				data : {id : id},
				dataType: false,
				type: 'POST',
				success: function(response) 
				{
					location.reload();					
				}
			});
		});
	}
}

function delete_centro_costo_asoc(id = null) 
{
	if(id)
	{
		$("#removeBtn").unbind('click').bind('click', function() {
			$.ajax({
				url : "?c=Centro_costo_asoc&a=Delete",
				data : {id : id},
				dataType: false,
				type: 'POST',
				success: function(response) 
				{
					location.reload();					
				}
			});
		});
	}
}

$(document).ready(function() {
	var nombreLlave, contenidollave, tablaLlave, opcionClick;
	$(".option").click(function(){
		$("#options-container").animate({
    		marginLeft: "-=100%"
		},700);
		$(".logo").fadeOut(100);
		$(".contain1").animate({
    		marginTop: "+=90px"
		},700);
		opcionClick = $(this).html();
		var tabla;
		switch(opcionClick){
			case "Información Usuarios":
				tabla = "clientes";
			break;

			case "Colaboradores":
				tabla = "cpanel";
			break;

			case "Lecturas":
				tabla = "lecturas";
			break;

			case "Boletas":
				tabla = "boletas";
			break;

			case "Pagos":
				tabla = "pagos";
			break;
		}
		rescatar_tabla(tabla, opcionClick);
		$("#menu").delay(700).fadeIn(500);
	})
	$("#menu").click(function(){
		$(this).fadeOut(0);
		$("#options-container").animate({
    		marginLeft: "+=100%"
		},700);
		$(".logo").fadeIn(100);
		$(".contain1").animate({
    		marginTop: "-=90px"
		},700);
	})
	$("#x-editar").click(function(){
		ocultarEditarShow();
	})
	$("#x-agregar").click(function(){
		ocultarAgregarShow();
	})
});
function crearHead(){
	var total = $(".fila:eq(1)").children().length;
	var filasHead = [];
	var fixedHead = $(".thead");
	for(var i=0;i<total;i++){
		filasHead[i] = $(".fila").children("td:eq("+i+")").width();
		$(".thead").children("th:eq("+i+")").width(filasHead[i]);
	}
}
function rescatar_tabla(t, o){
	$.post("rescatar_tabla_"+t+".php",{tablaBusqueda: t, optionBusqueda: o}, function(tablaListado){
        $("#show-container").html(tablaListado);
    });
    tablaLlave = t;
}
function poblarConfirmacion(){
	$("#confirmacion-eliminar").html('<p>¿Seguro que quieres eliminar esta fila completa?</p><div onclick="aceptarEliminar(this)" class="opciones-eliminar" id="eliminar-aceptar">Aceptar</div><div onclick="cancelarEliminar();"class="opciones-eliminar" id="eliminar-cancelar">Cancelar</div>');
}

function eliminar(btn){
	poblarConfirmacion();
	$("#confirmacion-eliminar-show").fadeIn(100);
	var fila = $(btn).parent().parent().parent();
	var indice;
	switch(tablaLlave){
		case "clientes":
			indice = 11;
			nombreLlave = "medidor";
		break;

		case "cpanel":
			indice = 3;
			nombreLlave = "rut";
		break;

		case "lecturas":
			indice = 1;
			nombreLlave = "id";
		break;

		case "boletas":
			indice = 1;
			nombreLlave = "numero_boleta";
		break;

		case "pagos":
			indice = 1;
			nombreLlave = "codigo";
	}
	contenidoLlave =$(fila).children("td:eq("+indice+")").html();
}
function aceptarEliminar(){
	$.post("eliminarFila.php",{nombreLlave:nombreLlave,contenidoLlave:contenidoLlave,tablaLlave:tablaLlave}, function(resultado){
		$("#confirmacion-eliminar").html(resultado);
	});
}
function cancelarEliminar(){
	$("#confirmacion-eliminar-show").fadeOut(100);
}
function editarClientes(p){
	var filaPadre = $(p).parent().parent().parent();
	var tablaEditar = $(filaPadre).parent();
	var filaHead = $(tablaEditar).children("tr:eq(0)");
	var cantidadCeldas = $(filaPadre).children().length;
	var	arrayCeldas = [];
	var arrayHead = [];
	var contenidoHtml = "";
	for (var i = 1; i < cantidadCeldas; i++) {
		arrayHead[i] = $(filaHead).children("th:eq("+i+")").text();
		arrayCeldas[i] = $(filaPadre).children("td:eq("+i+")").text();
		var idTh = $(filaHead).children("th:eq("+i+")").attr("id");
		if(idTh == "llave"){
			arrayHead[i] += "*";
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' disabled type='text' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else if(idTh == "number"){
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='number' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else if(idTh == "email"){
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='email' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else if(idTh == "date"){
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='date' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else{
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='text' value='"+arrayCeldas[i]+"'/></td></tr>";
		}
	};
	$("#editar-container").html("<h1>Modificación de registros</h1><form id='formulario-modificar'><table class='table-modificar'>"+contenidoHtml+"</table><p>*Registros no modificables. Llaves de fila.</p><div id='modificar-fila' onclick='modificarTablaClientes();'>Modificar</div><div id='cancelar-fila' onclick='ocultarEditarShow();'>Cancelar</div></form>");
	$("#editar-show").fadeIn(500);
}
function editarColaboradores(p){
	var filaPadre = $(p).parent().parent().parent();
	var tablaEditar = $(filaPadre).parent();
	var filaHead = $(tablaEditar).children("tr:eq(0)");
	var cantidadCeldas = $(filaPadre).children().length;
	var	arrayCeldas = [];
	var arrayHead = [];
	var contenidoHtml = "";
	for (var i = 1; i < cantidadCeldas; i++) {
		arrayHead[i] = $(filaHead).children("th:eq("+i+")").text();
		arrayCeldas[i] = $(filaPadre).children("td:eq("+i+")").text();
		var idTh = $(filaHead).children("th:eq("+i+")").attr("id");
		if(idTh == "llave"){
			arrayHead[i] += "*";
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' disabled type='text' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else if(idTh == "number"){
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='number' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else if(idTh == "email"){
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='email' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else if(idTh == "date"){
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='date' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else if(idTh == "select"){
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><select class='input"+i+"' selected='"+arrayCeldas[i]+"''><option>administrador</option><option>pagos</option><option>boletas</option><option>lecturas</option></select></td></tr>";
		}else{
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='text' value='"+arrayCeldas[i]+"'/></td></tr>";
		}
	};
	$("#editar-container").html("<h1>Modificación de registros</h1><form id='formulario-modificar'><table class='table-modificar'>"+contenidoHtml+"</table><p>*Registros no modificables. Llaves de fila.</p><div id='modificar-fila' onclick='modificarTablaColaboradores();'>Modificar</div><div id='cancelar-fila' onclick='ocultarEditarShow();'>Cancelar</div></form>");
	$("#editar-show").fadeIn(500);
}
function editarLecturas(p){
	var filaPadre = $(p).parent().parent().parent();
	var tablaEditar = $(filaPadre).parent();
	var filaHead = $(tablaEditar).children("tr:eq(0)");
	var cantidadCeldas = $(filaPadre).children().length;
	var	arrayCeldas = [];
	var arrayHead = [];
	var contenidoHtml = "";
	for (var i = 1; i < cantidadCeldas; i++) {
		arrayHead[i] = $(filaHead).children("th:eq("+i+")").text();
		arrayCeldas[i] = $(filaPadre).children("td:eq("+i+")").text();
		var idTh = $(filaHead).children("th:eq("+i+")").attr("id");
		if(idTh == "llave" || idTh == "disabled"){
			arrayHead[i] += "*";
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' disabled type='text' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else if(idTh == "number"){
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='number' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else if(idTh == "email"){
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='email' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else if(idTh == "date"){
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='date' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else{
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='text' value='"+arrayCeldas[i]+"'/></td></tr>";
		}
	};
	$("#editar-container").html("<h1>Modificación de registros</h1><form id='formulario-modificar'><table class='table-modificar'>"+contenidoHtml+"</table><p>*Registros no modificables. Llaves de fila.</p><div id='modificar-fila' onclick='modificarTablaLecturas();'>Modificar</div><div id='cancelar-fila' onclick='ocultarEditarShow();'>Cancelar</div></form>");
	$("#editar-show").fadeIn(500);
}
function editarBoletas(p){
	var filaPadre = $(p).parent().parent().parent();
	var tablaEditar = $(filaPadre).parent();
	var filaHead = $(tablaEditar).children("tr:eq(0)");
	var cantidadCeldas = $(filaPadre).children().length;
	var	arrayCeldas = [];
	var arrayHead = [];
	var contenidoHtml = "";
	for (var i = 1; i < cantidadCeldas; i++) {
		arrayHead[i] = $(filaHead).children("th:eq("+i+")").text();
		arrayCeldas[i] = $(filaPadre).children("td:eq("+i+")").text();
		var idTh = $(filaHead).children("th:eq("+i+")").attr("id");
		if(idTh == "llave" || idTh == "disabled"){
			arrayHead[i] += "*";
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' disabled type='text' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else if(idTh == "number"){
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='number' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else if(idTh == "email"){
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='email' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else if(idTh == "date"){
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='date' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else{
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='text' value='"+arrayCeldas[i]+"'/></td></tr>";
		}
	};
	$("#editar-container").html("<h1>Modificación de registros</h1><form id='formulario-modificar'><table class='table-modificar'>"+contenidoHtml+"</table><p>*Registros no modificables. Llaves de fila.</p><div id='modificar-fila' onclick='modificarTablaBoletas();'>Modificar</div><div id='cancelar-fila' onclick='ocultarEditarShow();'>Cancelar</div></form>");
	$("#editar-show").fadeIn(500);
}
function editarPagos(p){
	var filaPadre = $(p).parent().parent().parent();
	var tablaEditar = $(filaPadre).parent();
	var filaHead = $(tablaEditar).children("tr:eq(0)");
	var cantidadCeldas = $(filaPadre).children().length;
	var	arrayCeldas = [];
	var arrayHead = [];
	var contenidoHtml = "";
	for (var i = 1; i < cantidadCeldas; i++) {
		arrayHead[i] = $(filaHead).children("th:eq("+i+")").text();
		arrayCeldas[i] = $(filaPadre).children("td:eq("+i+")").text();
		var idTh = $(filaHead).children("th:eq("+i+")").attr("id");
		if(idTh == "llave" || idTh == "disabled"){
			arrayHead[i] += "*";
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' disabled type='text' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else if(idTh == "number"){
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='number' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else if(idTh == "email"){
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='email' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else if(idTh == "date"){
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='date' value='"+arrayCeldas[i]+"''/></td></tr>";
		}else{
			contenidoHtml += "<tr><td>"+arrayHead[i]+"</td><td>:</td><td><input class='input"+i+"' type='text' value='"+arrayCeldas[i]+"'/></td></tr>";
		}
	};
	$("#editar-container").html("<h1>Modificación de registros</h1><form id='formulario-modificar'><table class='table-modificar'>"+contenidoHtml+"</table><p>*Registros no modificables. Llaves de fila.</p><div id='modificar-fila' onclick='modificarTablaPagos();'>Modificar</div><div id='cancelar-fila' onclick='ocultarEditarShow();'>Cancelar</div></form>");
	$("#editar-show").fadeIn(500);
}
function agregarUsuario(){
	$("#agregar-show").fadeIn(500);
	$('#agregar-container').html("<h1>Agregar Usuario</h1><form id='formulario-agregar-usuario'><table><tr><td>Nombre</td><td>:</td><td><input id='agregar-nombre' type='text'/></td></tr><tr><td>Apellido Pat</td><td>:</td><td><input id='agregar-apellidoPat' type='text'/></td></tr><tr><td>Apellido Mat</td><td>:</td><td><input id='agregar-apellidoMat' type='text'/></td></tr><tr><td>Rut</td><td>:</td><td><input id='agregar-rut' type='number' maxlength='8' onKeyUp='copiarClave();'/></td></tr><tr><td>Dv</td><td>:</td><td><input id='agregar-dv' type='text'/></td></tr><tr><td>Pseudónimo</td><td>:</td><td><input id='agregar-pseudonimo' type='text'/></td></tr><tr><td>Calle Nombre</td><td>:</td><td><input id='agregar-calleNombre' type='text'/></td></tr><tr><td>Calle N°</td><td>:</td><td><input id='agregar-calleNumero' type='number'/></td></tr><tr><td>Fono</td><td>:</td><td><input id='agregar-fono' type='number'/></td></tr><tr><td>correo</td><td>:</td><td><input id='agregar-correo' type='email'/></td></tr><tr><td>Medidor</td><td>:</td><td><input id='agregar-medidor' type='number' value='0'/></td></tr><tr><td>F. Incorporacion</td><td>:</td><td><input id='agregar-fechaIncorporacion' type='date'/></td></tr><tr><td>deuda</td><td>:</td><td><input id='agregar-deuda' type='number' value='0'/></td></tr><tr><td>Saldo Favor</td><td>:</td><td><input id='agregar-saldoFavor' type='number' value='0'/></td></tr><tr><td>Password</td><td>:</td><td><input id='agregar-password' type='text' disabled/></td></tr><tr><td>Credencial</td><td>:</td><td><input id='agregar-credencial' type='text' value='Usuario' disabled/></td></tr><tr><td>Mod. Password</td><td>:</td><td><input id='agregar-modPassword' type='number' value='0' disabled/></td></tr></table><div id='modificar-fila' onclick='insertarUsuario();'>Agregar</div><div id='cancelar-fila' onclick='ocultarAgregarShow();'>Cancelar</div></form>")
}
function agregarColaborador(){
	$("#agregar-show").fadeIn(500);
	$('#agregar-container').html("<h1>Agregar Colaborador</h1><form id='formulario-agregar-usuario'><table><tr><td>Nombre</td><td>:</td><td><input id='agregar-nombre' type='text'/></td></tr><tr><td>Apellido</td><td>:</td><td><input id='agregar-apellido' type='text'/></td></tr><tr><td>Rut</td><td>:</td><td><input id='agregar-rut' type='number'/></td></tr><tr><td>Dv</td><td>:</td><td><input id='agregar-dv' type='number' maxlength='1'/></td></tr><tr><td>Password</td><td>:</td><td><input id='agregar-password' type='text'/></td></tr><tr><td>Credencial</td><td>:</td><td><select id='agregar-credencial'><option>administrador</option><option>pagos</option><option>boletas</option><option>lecturas</option></select></td></tr><tr><td>Email</td><td>:</td><td><input id='agregar-email' type='email'/></td></tr><tr><td>Fono</td><td>:</td><td><input id='agregar-fono' type='number'/></td></tr></table><div id='modificar-fila' onclick='insertarColaborador();'>Agregar</div><div id='cancelar-fila' onclick='ocultarAgregarShow();'>Cancelar</div></form>")
}
function copiarClave(){
	var valorRut = parseInt($('#agregar-rut').val());
	$('#agregar-password').val(valorRut);
}
function ocultarEditarShow(){
	$("#editar-show").fadeOut(500);
}
function ocultarEliminarShow(){
	$("#confirmacion-eliminar-show").fadeOut(100);
	var tit = $("#show-title").children("h2").html();
	rescatar_tabla(tablaLlave, tit);
}
function ocultarAgregarShow(){
	$("#agregar-show").fadeOut(500);
}
function modificarTablaClientes(){
	var t = $(".table-modificar").children();
	var nombre = $(".input1").val();
	var apellidoPat = $(".input2").val();
	var apellidoMat = $(".input3").val();
	var rut = $(".input4").val();
	var dv = $(".input5").val();
	var pseudonimo = $(".input6").val();
	var calleNombre = $(".input7").val();
	var calleNumero = $(".input8").val();
	var fono = $(".input9").val();
	var correo = $(".input10").val();
	var medidor = $(".input11").val();
	var incorporacion = $(".input12").val();
	var deuda = $(".input13").val();
	var saldoFavor = $(".input14").val();
	var password = $(".input15").val();
	var credencial = $(".input16").val();
	var modPass = $(".input17").val();
    $.post("modificar-tabla-clientes.php",{nombre:nombre, apellidoPat:apellidoPat, apellidoMat:apellidoMat, rut:rut, dv:dv,pseudonimo:pseudonimo,calleNombre:calleNombre,calleNumero:calleNumero,fono:fono,correo:correo,medidor:medidor,incorporacion:incorporacion,deuda:deuda,saldoFavor:saldoFavor,password:password,credencial:credencial,modPass:modPass}, function(respuesta){
        $("#editar-container").html(respuesta);
        rescatar_tabla("clientes", "Información Usuarios");
    });
}
function modificarTablaColaboradores(){
	var t = $(".table-modificar").children();
	var nombre = $(".input1").val();
	var apellido = $(".input2").val();
	var rut = $(".input3").val();
	var dv = $(".input4").val();
	var passcode = $(".input5").val();
	var credencial = $(".input6").val();
	var email = $(".input7").val();
	var fono = $(".input8").val();
    $.post("modificar-tabla-colaboradores.php",{nombre:nombre, apellido:apellido,rut:rut,dv:dv,passcode:passcode,credencial:credencial,email:email,fono:fono}, function(respuesta){
        $("#editar-container").html(respuesta);
        rescatar_tabla("cpanel", "Colaboradores");
    });
}
function modificarTablaLecturas(){
	var t = $(".table-modificar").children();
	var id = $(".input1").val();
	var medidor = $(".input2").val();
	var fecha = $(".input3").val();
	var kw = $(".input4").val();

    $.post("modificar-tabla-lecturas.php",{id:id,medidor:medidor,fecha:fecha,kw:kw}, function(respuesta){
        $("#editar-container").html(respuesta);
        rescatar_tabla("lecturas", "Lecturas");
    });
}
function modificarTablaPagos(){
	var t = $(".table-modificar").children();
	var codigo = $(".input1").val();
	var rut = $(".input2").val();
	var monto = $(".input3").val();
	var metodo = $(".input4").val();
	var fecha = $(".input5").val();

    $.post("modificar-tabla-pagos.php",{codigo:codigo,rut:rut,monto:monto,metodo:metodo,fecha:fecha}, function(respuesta){
        $("#editar-container").html(respuesta);
        rescatar_tabla("pagos", "Pagos");
    });
}
function modificarTablaBoletas(){
	var t = $(".table-modificar").children();
	var numBoleta = $(".input1").val();
	var medidor = $(".input2").val();
	var fechaEmision = $(".input3").val();
	var fechaVencimiento = $(".input4").val();
	var lecturaActual = $(".input5").val();
	var lecturaAnterior = $(".input6").val();
	var valorKw = $(".input7").val();
	var consumoKw = $(".input8").val();
	var consumoDinero = $(".input9").val();
	var cargoFijo = $(".input10").val();
	var cliente = $(".input11").val();
	var saldoAnterior = $(".input12").val();
	var saldoFavor = $(".input13").val();
	var corteRep = $(".input14").val();
	var gastosOp = $(".input15").val();
	var interes = $(".input16").val();
	var total = $(".input17").val();
	var montoUltimoPago = $(".input18").val();
	var fechaUltimoPago = $(".input19").val();
	var metodo = $(".input20").val();
	var codigoPago = $(".input21").val();

    $.post("modificar-tabla-boletas.php",{fechaEmision:fechaEmision,fechaVencimiento:fechaVencimiento,lecturaActual:lecturaActual,numBoleta:numBoleta}, function(respuesta){
        $("#editar-container").html(respuesta);
        rescatar_tabla("boletas", "Boletas");
    });
}
function insertarUsuario(){
	var nombre = $("#agregar-nombre").val();
	var apellidoPat = $("#agregar-apellidoPat").val();
	var apellidoMat = $("#agregar-apellidoMat").val();
	var rut = $("#agregar-rut").val();
	var dv = $("#agregar-dv").val();
	var pseudonimo = $("#agregar-pseudonimo").val();
	var calleNombre = $("#agregar-calleNombre").val();
	var calleNumero = $("#agregar-calleNumero").val();
	var fono = $("#agregar-fono").val();
	var correo = $("#agregar-correo").val();
	var medidor = $("#agregar-medidor").val();
	var incorporacion = $("#agregar-fechaIncorporacion").val();
	var deuda = $("#agregar-deuda").val();
	var saldoFavor = $("#agregar-saldoFavor").val();
	var password = $("#agregar-password").val();
	var credencial = $("#agregar-credencial").val();
	var modPass = $("#agregar-modPassword").val();
	if(medidor != "0" && medidor != ""){
		$.post("agregar-usuario.php",{nombre:nombre,apellidoPat:apellidoPat,apellidoMat:apellidoMat,rut:rut,dv:dv,pseudonimo:pseudonimo,calleNombre:calleNombre,calleNumero:calleNumero,fono:fono,correo:correo,medidor:medidor,incorporacion:incorporacion,deuda:deuda,saldoFavor:saldoFavor,password:password,credencial:credencial,modPass:modPass}, function(respuesta){
        $("#agregar-container").html(respuesta);
        rescatar_tabla("clientes", "Información Usuarios");
    	});
	}else{
		$("#agregar-container").html("Número medidor incorrecto.");
        rescatar_tabla("clientes", "Información Usuarios");
	}
}
function insertarColaborador(){
	var nombre = $("#agregar-nombre").val();
	var apellido = $("#agregar-apellido").val();
	var rut = $("#agregar-rut").val();
	var dv = $("#agregar-dv").val();
	var password = $("#agregar-password").val();
	var credencial = $("#agregar-credencial").val();
	var email = $("#agregar-email").val();
	var fono = $("#agregar-fono").val();

	if(rut != "0" && rut != ""){
		$.post("agregar-colaborador.php",{nombre:nombre,apellido:apellido,rut:rut,dv:dv,password:password,credencial:credencial,email:email,fono:fono}, function(respuesta){
        $("#agregar-container").html(respuesta);
        rescatar_tabla("cpanel", "Colaboradores");
    	});
	}else{
		$("#agregar-container").html("Número rut incorrecto.");
        rescatar_tabla("cpanel", "Colaboradores");
	}
}
$(document).ready(function() {
    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
});

	$("#buscar").click(function () {
		buscar();
	});

	function buscar() {
	    var textoBusqueda = $("#busqueda").val();	
	    if(textoBusqueda != "") {    		    	
	    	$.post("buscar.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
	            $(".historial").html(mensaje);
	        }); 
		}else{
			$("#busqueda").val("");
		};
	};

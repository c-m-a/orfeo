/*
 * Archivo acciones masivas
 * Se manejan los eventos para incluir modificar 
 * la seleccion de subserie al cambiar serie 
 * masivaIncluir.tpl
*/

//Inicia cuando todos los elementos estan activos
	YAHOO.util.Event.onDOMReady(function () {			
		
		// FUNCION  
		//Solicita los radicados como prestamos
				
		function soliPrestMass(){
			var Dom 			= YAHOO.util.Dom,
			
				radiSoli		= Dom.get('radiSoli'),
				radiNoSoli		= Dom.get('radiNoSoli'),				
				masiva			= Dom.get('masiva'),
				element5		= Dom.get('respuestaPrestMass'),
				
				sUrl		= 'requestAjax/masivaPrestamo.php';
			
			Dom.get("soliPrestMass").value 		= "Enviando...";
			Dom.get("soliPrestMass").disabled 	= true;
					
			var callback = {					
						
				success: function(o) {		
					var r		= eval('(' + o.responseText + ')');
					Dom.removeClass(element5, 'yui-hidden2');	
					//borramos la tabla de crear expedientes						
					while (masiva.hasChildNodes()) masiva.removeChild(masiva.firstChild);				
					
					if (r.respuesta == true) {
						var texto4 		= document.createTextNode(r.mensaje);
						var texto5 		= document.createTextNode(r.existen);
									
						radiSoli.appendChild(texto4);
						radiNoSoli.appendChild(texto5);
											
		            }else{
						alert(r.mensaje);
					}
				},
										
				failure: function(o) {
					alert("Error retornando datos de subSerie " 
							+ o.status + " : " + o.statusText);
				}
			};	
			
			var formObject = masiva;
				YAHOO.util.Connect.setForm(formObject);
				
			var transaction = YAHOO.util.Connect.asyncRequest(
						"POST"
						, sUrl
						, callback);
			
			Dom.get("soliPrestMass").value = "Incluir";
			Dom.get("soliPrestMass").disabled = false;			
		}		
		
		
		//EVENTO
		/*
		 * Manejo de eventos originados por acciones o botones
		 */	
		
		YAHOO.util.Event.on(	"soliPrestMass",
								"click",
								soliPrestMass);
								
		YAHOO.util.Event.on(	"cerrarPrest",
								"click", 
								function(){
									opener.location.reload();
									window.close();
								});	
		YAHOO.util.Event.on(	"cerrarPrest2",
								"click", 
								function(){
									opener.location.reload();
									window.close();
								});	
	});
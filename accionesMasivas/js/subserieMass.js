/*
 * Archivo acciones masivas
 * Se manejan los eventos para incluir modificar 
 * la seleccion de subserie al cambiar serie 
 * masivaIncluir.tpl
*/

//Inicia cuando todos los elementos estan activos
	YAHOO.util.Event.onDOMReady(function () {			
		
		// FUNCION  
		//ENVIAR SERIE PARA OPTENER SUBSERIE	
		/*
		*Funcion que cambia los valores de la subserie en
		*el siguiete input y generar combobox en cascada
		*/
		
		function sendSerie(e){
			var serieInput 	= YAHOO.util.Event.getTarget(e).value,				
				selSubSer	= YAHOO.util.Dom.get("selectSubSerie"),
				masiva		= YAHOO.util.Dom.get('masiva'),
				sUrl		= 'requestAjax/masivaFiltros.php',	
				postData 	= '&evento=' + 1;					
							
			selSubSer.options.length=0;
			selSubSer.options[0] = new Option('Seleccione una subSerie',0,true,true);
			
			if(serieInput != 0){			
				 
				var callback = {
							
					success: function(o) {		
						var r		= eval('(' + o.responseText + ')');
						if (r.respuesta == true) {					
							var lenSuv = r.mensaje.length;					
							for (i = 0; i < lenSuv; i++) {
								var j = selSubSer.options.length;																	
								selSubSer.options[j] = 
									new Option(r.mensaje[i].nombre,r.mensaje[i].codigo,false,false);
							}
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
							, callback
							, postData);					
			}
		}		
		
		
		//EVENTO
		/*
		 * Manejo de eventos originados por acciones o botones
		 */	
		
		YAHOO.util.Event.on(	"selectSerie",
								"change",
								sendSerie);
	});
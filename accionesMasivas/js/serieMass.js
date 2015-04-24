/*
 * Archivo acciones masivas
 * Se manejan los eventos para incluir modificar 
 * la seleccion de subserie al cambiar serie 
 * masivaIncluir.tpl
*/

//Inicia cuando todos los elementos estan activos
	YAHOO.util.Event.onDOMReady(function () {			
		
		// FUNCION  
		//ENVIAR DEPENDENCIA PARA OPTENER SERIE	
		/*
		*Funcion que cambia los valores de la subserie en
		*el siguiete input y generar combobox en cascada
		*/
		
		function sendDepen(e){
			var depeInput 	= YAHOO.util.Event.getTarget(e).value,
				Dom 		= YAHOO.util.Dom,	
				selectSerie	= Dom.get("selectSerie"),			
				selSubSer	= Dom.get("selectSubSerie"),				
				masiva		= Dom.get('masiva'),
				sUrl		= 'requestAjax/masivaFiltros.php',	
				postData 	= '&evento=3';			
			
			selectSerie.options.length=0;
			selectSerie.options[0] = new Option('Seleccione una Serie',0,true,true);		
							
			selSubSer.options.length=0;
			selSubSer.options[0] = new Option('Seleccione una subSerie',0,true,true);
			
			if(depeInput != 0){							 
				var callback = {
							
					success: function(o) {		
						var r		= eval('(' + o.responseText + ')');
						if (r.respuesta == true) {					
							var lenSuv = r.mensaje.length;					
							for (i = 0; i < lenSuv; i++) {
								var j = selectSerie.options.length;																	
								selectSerie.options[j] = 
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
		
		YAHOO.util.Event.on(	"selectDepe",
								"change",
								sendDepen);
	});
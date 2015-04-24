/*
 * Archivo acciones masivas
 * Se manejan los eventos para incluir modificar 
 * la seleccion de tipo documental al cambiar subserie 
 * masivaIncluir.tpl
*/

//Inicia cuando todos los elementos estan activos
	YAHOO.util.Event.onDOMReady(function () {			
		
		// FUNCION  
		//ENVIAR SUBSERIE PARA OPTENER TIPOS DOCUMENTALES	
		/*
		*Funcion que cambia los valores de la subserie en
		*el siguiete input y generar combobox en cascada
		*/
		
		function sendSubSerie(e){
			var subSerieInput 	= YAHOO.util.Event.getTarget(e).value,				
				selTipoDoc		= YAHOO.util.Dom.get("selectTipoDoc"),
				masiva			= YAHOO.util.Dom.get('masiva'),
				sUrl			= 'requestAjax/masivaFiltros.php',	
				postData 		= '&evento=' + 2;					
							
			selTipoDoc.options.length=0
			selTipoDoc.options[0] = new Option('Seleccione una TipoDoc',0,true,true)
			
			if(subSerieInput != 0){			
				 
				var callback = {
							
					success: function(o) {		
						var r		= eval('(' + o.responseText + ')');
						if (r.respuesta == true) {					
							var lenSuv = r.mensaje.length;					
							for (i = 0; i < lenSuv; i++) {
								var j = selTipoDoc.options.length;																	
								selTipoDoc.options[j] = 
									new Option(r.mensaje[i].nombre,r.mensaje[i].codigo,false,false);
							}
			            }else{
							alert(r.mensaje);
						}
					},
											
					failure: function(o) {
						alert("Error retornando datos de TipoDoc" 
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
		
		YAHOO.util.Event.on(	"selectSubSerie",
								"change",
								sendSubSerie);
	});
/*
 * Archivo acciones masivas
 * Se manejan los eventos para incluir modificar 
 * la seleccion de temas segun el sector
 * masivaTemaSector.tpl
*/

//Inicia cuando todos los elementos estan activos
	YAHOO.util.Event.onDOMReady(function () {			
		
		// FUNCION  
		//ENVIAR DEPENDENCIA PARA OPTENER SERIE	
		/*
		*Funcion que cambia los valores de tema en 
		*el siguiete input y generar combobox en cascada
		*/
		
		function selectSector(e){
			
			var selectSector		= YAHOO.util.Event.getTarget(e).value,
				Dom 				= YAHOO.util.Dom,	
				selectTema			= Dom.get("selectTema"),
				masiva				= Dom.get("masiva"),			
				sect_Tema_search	= Dom.get("sect_Tema_search"),
				sUrl				= 'requestAjax/masivaFiltros.php',	
				postData 			= '&evento=6';			
			
			selectTema.options.length=0;
			selectTema.options[0] = new Option('Seleccione una tema',0,true,true);		
			
			if(selectSector != 0){							 
				var callback = {
							
					success: function(o) {		
						var r		= eval('(' + o.responseText + ')');
						if (r.respuesta == true) {					
							var lenSuv = r.mensaje.length;					
							for (i = 0; i < lenSuv; i++) {
								var j = selectTema.options.length;																	
								selectTema.options[j] = 
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
		
		YAHOO.util.Event.on(	"selectSector",
								"change",
								selectSector);
	});
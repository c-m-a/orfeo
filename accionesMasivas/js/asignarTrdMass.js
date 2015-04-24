/*
 * Archivo acciones masivas
 * Se manejan los eventos para incluir modificar 
 * la seleccion de subserie al cambiar serie 
 * masivaIncluir.tpl
*/

//Inicia cuando todos los elementos estan activos
	YAHOO.util.Event.onDOMReady(function () {			
		
		// FUNCION  
		//MODIFICAR LA TRD DE LOS RADICADOS
		/*
		*Funcion que cambia los valores de los
		*radicados que se enviaron desde la 
		*ventana principal del sistema
		*/
		
		function modificarTrdMass(){
			var selectTipoDoc	= YAHOO.util.Dom.get("selectTipoDoc").value,
				sUrl			= 'requestAjax/masivaAsignarTrd.php',
				Dom 			= YAHOO.util.Dom,	
				
				element1		= Dom.get('radicadosResulTex'),
				element2		= Dom.get('tipoDocResul'),
				element3		= Dom.get('subSerResul'),
				element4		= Dom.get('serieResul'),
				element5		= Dom.get('respuestaTrdMass'),
				element6		= Dom.get('masiva'),
				
				text_Serie		= (Dom.get("selectSerie")).options[Dom.get('selectSerie').selectedIndex].text,
				text_SubSer 	= (Dom.get("selectSubSerie")).options[Dom.get('selectSubSerie').selectedIndex].text,
				text_tipDoc 	= (Dom.get("selectTipoDoc")).options[Dom.get('selectTipoDoc').selectedIndex].text,
				
				texto1 			= document.createTextNode(text_Serie),
				texto2 			= document.createTextNode(text_SubSer),
				texto3 			= document.createTextNode(text_tipDoc),
									
				mensaje1		= 'Seleccione un Tipo Documental';
			
			element4.appendChild(texto1);
			element3.appendChild(texto2);
			element2.appendChild(texto3);
			
			if(selectTipoDoc != 0){			
				 
				var callback = {
							
					success: function(o) {		
						var r		= eval('(' + o.responseText + ')');
						if (r.respuesta == true) {							
							while (element6.hasChildNodes()) element6.removeChild(element6.firstChild);
							Dom.removeClass(element5, 'yui-hidden2');	
							texto4 		= document.createTextNode(r.mensaje);			
							element1.appendChild(texto4);					
			            }else{
							alert(r.mensaje);
						}
					},
											
					failure: function(o) {
						alert("Error retornando datos de subSerie " 
								+ o.status + " : " + o.statusText);
					}
				};	
				
				var formObject = element6;
					YAHOO.util.Connect.setForm(formObject);
					
				var transaction = YAHOO.util.Connect.asyncRequest(
							"POST"
							, sUrl
							, callback);					
			}else{
				alert(mensaje1);
			}
		}		
		
		
		//EVENTO
		/*
		 * Manejo de eventos originados por acciones o botones
		 */	
		
		YAHOO.util.Event.on(	"modificarTrd",
								"click",
								modificarTrdMass);
								
		YAHOO.util.Event.on(	"cerrarTrd",
								"click", 
								function(){
									opener.location.reload();
									window.close();
								});	
		YAHOO.util.Event.on(	"cerrarTrd2",
								"click", 
								function(){
									opener.location.reload();
									window.close();
								});	
	});
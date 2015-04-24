/*
 * Archivo acciones masivas
 * Se manejan los eventos para cambiar
 * el tema y sector de un radicado 
 * masivaTemaSector.tpl
*/

//Inicia cuando todos los elementos estan activos
	YAHOO.util.Event.onDOMReady(function () {			
		
		// FUNCION  
		// Agregar un nuevo tema a un radicado
				
		function temasSecMass(){
			var Dom 			= YAHOO.util.Dom,								
				myHidden		= Dom.get("myHidden").value,
				selectTema		= Dom.get("selectTema").value,
				sect_Tema_search= Dom.get("sect_Tema_search"),
				masiva			= Dom.get('masiva'),
								
				sUrl			= 'requestAjax/masivaTemSect.php',							
									
				mensaje1		= 'No seleccion un nombre de tema valido';
			
			if((myHidden != '' && sect_Tema_search.value.length > 4) || selectTema != 0){	
			
				Dom.get("temasSecMass").value = "Enviando...";
    			Dom.get("temasSecMass").disabled = true;
					
				var callback = {					
							
					success: function(o) {		
						var r		= eval('(' + o.responseText + ')');
						
						if (r.respuesta == true) {
							alert(r.mensaje);												
			            }else{
							alert(r.mensaje);
						}						
					},
											
					failure: function(o) {
						alert("Error retornando datos" 
								+ o.status + " : " + o.statusText);
					}
				};	
				
				var formObject = masiva;
					YAHOO.util.Connect.setForm(formObject);
					
				var transaction = YAHOO.util.Connect.asyncRequest(
							"POST"
							, sUrl
							, callback);
				
				Dom.get("temasSecMass").value = "Incluir";
    			Dom.get("temasSecMass").disabled = false;
									
			}else{
				alert(mensaje1);
			}
		}		
		
		
		//EVENTO
		/*
		 * Manejo de eventos originados por acciones o botones
		 */	
		
		YAHOO.util.Event.on(	"temasSecMass",
								"click",
								temasSecMass);
								
		YAHOO.util.Event.on(	"cerrarTemMass",
								"click", 
								function(){
									opener.location.reload();
									window.close();
								});	
	});
/*
 * Archivo acciones masivas
 * Se manejan los eventos para incluir modificar 
 * la seleccion de subserie al cambiar serie 
 * masivaIncluir.tpl
*/

//Inicia cuando todos los elementos estan activos
	YAHOO.util.Event.onDOMReady(function () { 
		
		//FUNCION
		//BUSCAR NOMBRE DEL EXPEDIENTE CON EL NUMERO
		/*
		 * Si el usuario digita o pega el nuemro del expediente
		 * se debe buscar el nombre que le corresponde
		 * respetando los filtros seleccionados
		 */
		
		function buscNombExpNumero(){
			
			var exp				= /^[0-9]{16,18}[E]{1}/,
				Dom 			= YAHOO.util.Dom,	
				numeroExp		= Dom.get("nomb_Expe_search").value,
				masiva			= Dom.get('masiva'),
				no_exp			= exp.exec(numeroExp),
				mensaje2		= "El numero del expediente no es correcto",
				
				sUrl			= 'requestAjax/masivaFiltros.php',	
				
				postData 		= '&evento=5' ;
				
			if(exp.test(no_exp)){
				var callback = {
							success: function(o) {
										var r		= eval('(' + o.responseText + ')');
										if (r.respuesta == true){
										
											var renTex = Dom.get("nombActuExp");
											
											while (renTex.hasChildNodes()) 
												renTex.removeChild(renTex.firstChild);			
																								
											texto1 		= document.createTextNode(r.mensaje);			
											renTex.appendChild(texto1);
															                						
							            }else{
											alert(r.mensaje);
										}							
									},
			  				
							failure: function(o) {
										alert("Error " + o.status + " : " + o.statusText)
									}
					};
						
				var formObject = masiva;
					YAHOO.util.Connect.setForm(formObject);
						
				var transaction = YAHOO.util.Connect.asyncRequest(
								"POST"
								, sUrl
								, callback
								, postData);			
			}else{
				alert(mensaje2);
			}	
		};
		
		
		//EVENTO
		/*
		 * Manejo de eventos originados por acciones o botones
		 */	
		
		YAHOO.util.Event.on(	"buscNomExp",
								"click",
								buscNombExpNumero);
		
	});
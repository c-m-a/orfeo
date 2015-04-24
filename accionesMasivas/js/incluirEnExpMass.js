/*
 * Archivo acciones masivas
 * Se manejan los eventos para incluir modificar 
 * la seleccion de subserie al cambiar serie 
 * masivaIncluir.tpl
*/

//Inicia cuando todos los elementos estan activos
	YAHOO.util.Event.onDOMReady(function () {			
		
		// FUNCION  
		//Incluir radicados en un expediente
				
		function incluirEnExpMass(){
			var Dom 			= YAHOO.util.Dom,
				exp				= /^[0-9]{16,18}[E]{1}/,					
				numeroExp		= Dom.get("nomb_Expe_search").value,
				masiva			= Dom.get('masiva'),
				no_exp			= exp.exec(numeroExp),
				
				sUrl			= 'requestAjax/masivaIncluirExp.php',
								
				element1		= Dom.get('numExpResul'),
				element2		= Dom.get('radiIncluidos'),
				element3		= Dom.get('radiNoIncluidos'),			
				element5		= Dom.get('respuestaTrdMass'),
				texto1 			= document.createTextNode(no_exp),
									
				mensaje1		= 'El numero del expediente no es correcto';
			
			element1.appendChild(texto1);	
			
			if(exp.test(no_exp)){	
			
				Dom.get("incluirEnExpMass").value = "Enviando...";
    			Dom.get("incluirEnExpMass").disabled = true;
					
				var callback = {					
							
					success: function(o) {		
						var r		= eval('(' + o.responseText + ')');
						Dom.removeClass(element5, 'yui-hidden2');	
						//borramos la tabla de crear expedientes						
						while (masiva.hasChildNodes()) masiva.removeChild(masiva.firstChild);				
						
						if (r.respuesta == true) {
							var texto4 		= document.createTextNode(r.mensaje);
							var texto5 		= document.createTextNode(r.existen);
										
							element2.appendChild(texto4);
							element3.appendChild(texto5);
												
			            }else{							
							alert(r.mensaje);
							var texto5 		= document.createTextNode(r.existen);								
							element3.appendChild(texto5);
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
				
				Dom.get("incluirEnExpMass").value = "Incluir";
    			Dom.get("incluirEnExpMass").disabled = false;
									
			}else{
				alert(mensaje1);
			}
		}		
		
		
		//EVENTO
		/*
		 * Manejo de eventos originados por acciones o botones
		 */	
		
		YAHOO.util.Event.on(	"incluirEnExpMass",
								"click",
								incluirEnExpMass);
								
		YAHOO.util.Event.on(	"cerrarInc",
								"click", 
								function(){
									opener.location.reload();
									window.close();
								});	
		YAHOO.util.Event.on(	"cerrarInc2",
								"click", 
								function(){
									opener.location.reload();
									window.close();
								});	
	});
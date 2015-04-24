/*
 * Archivo acciones masivas
 * Se manejan los eventos para incluir modificar 
 * la seleccion de subserie al cambiar serie 
 * masivaIncluir.tpl
*/

//Inicia cuando todos los elementos estan activos
	YAHOO.util.Event.onDOMReady(function () { 
		
		//FUNCION
		//BUSCAR EXPEDIENTES
		/*
		 * Busca las dependencias dependiendo de los permisos otorgados
		 * y de la dependencia seleccionada.
		 */		
		
		var search = new YAHOO.util.XHRDataSource('requestAjax/masivaFiltros.php');		
		
		// Set the responseType
		search.responseType = YAHOO.util.XHRDataSource.TYPE_TEXT;
		
		// Metodo envio
		search.connMethodPost = true;
		
		// colocar sibolo de concatenacion ? en url
		search.queryQuestionMark = false;
		
		// Define the schema of the delimited results
		search.responseSchema = {
			recordDelim: "\n",
			fieldDelim: "\t"
		};	
		
		// Instantiate the AutoComplete
		var autoNomb = new YAHOO.widget.AutoComplete("nomb_Expe_search", "contnExpSearch", search);
		
		// Tamaño maximo a mostrar de resultados
		autoNomb.maxResultsDisplayed = 30;
		
		/*funcion cuando se seleccione un item*/
	    var myHandler = function(sType, aArgs) {
							        
	        var oData 	= aArgs[2].toString().substring(19); // object literal of selected item's result data
	        var renTex 	= YAHOO.util.Dom.get("nombActuExp");			
			
			while (renTex.hasChildNodes()) 
				renTex.removeChild(renTex.firstChild);
																
			texto1 		= document.createTextNode(oData);			
			renTex.appendChild(texto1);			        
	    };
		
		// Set Request change de values to send		
		autoNomb.generateRequest = function(sQuery) {
			var ano_busq 		= YAHOO.util.Dom.get('ano_busq').value,
				selectSerie 	= YAHOO.util.Dom.get('selectSerie').value,	
				selectSubSerie 	= YAHOO.util.Dom.get('selectSubSerie').value,
				selectDepe		= YAHOO.util.Dom.get('selectDepe').value,
				PHPSESSID		= document.getElementsByName('PHPSESSID').value;
			
    		return 	"evento=4"			+
					"&query=" 			+ sQuery +
				   	"&ano_busq=" 		+ ano_busq +
					"&selectDepe=" 		+ selectDepe +
					"&selectSerie=" 	+ selectSerie +							
					"&selectSubSerie=" 	+ selectSubSerie +
					"&PHPSESSID="		+ document.masiva.PHPSESSID.value;		
		};
		
		//Evento cuando selecciona un item
		autoNomb.itemSelectEvent.subscribe(myHandler); 
		
		return {
			search: search,
			autoNomb: autoNomb
		};		
	});
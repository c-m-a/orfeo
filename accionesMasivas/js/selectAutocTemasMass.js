/*
 * Archivo acciones masivas
 * Se manejan los eventos para incluir modificar 
 * la seleccion de subserie al cambiar serie 
 * masivaTemasSectores.tpl
*/

//Inicia cuando todos los elementos estan activos
	YAHOO.util.Event.onDOMReady(function () { 
		
		//FUNCION
		//BUSCAR TEMAS Y SECTORES
		/*
		 * Busca los temas y retorna la seleccion con un campo hidden
		 */		
		
		var search = new YAHOO.util.DataSource('requestAjax/masivaFiltros.php');
		
		// Define the schema of the delimited results
		search.responseSchema = {fields : ["nombre", "codigo"]};		
		
		// Set the responseType
		search.responseType = YAHOO.util.XHRDataSource.TYPE_JSARRAY;
		
		// Metodo envio
		search.connMethodPost = true;		
		
		// colocar sibolo de concatenacion ? en url
		search.queryQuestionMark = false;
		
		
		
		// Instantiate the AutoComplete
		var autoNomb = new YAHOO.widget.AutoComplete("sect_Tema_search", "contnTemaSearch", search);
		
		
		autoNomb.resultTypeList = false;
		
		// Tamaño maximo a mostrar de resultados
		autoNomb.maxResultsDisplayed = 30;
		
		// funcion cuando se seleccione un item
	    // Define an event handler to populate a hidden form field 
	    // when an item gets selected 
	    var myHiddenField = YAHOO.util.Dom.get("myHidden"); 
		
	    var myHandler = function(sType, aArgs) {
			var codigo = aArgs[2].codigo; 	        			
	        myHiddenField.value = codigo; 
	    }; 
		
		// Set Request change de values to send		
		autoNomb.generateRequest = function(sQuery) {
			var PHPSESSID		= document.getElementsByName('PHPSESSID').value;
			
    		return 	"evento=7"			+
					"&query=" 			+ sQuery +
					"&PHPSESSID="		+ document.masiva.PHPSESSID.value;		
		};
		
		//Evento cuando selecciona un item
		autoNomb.itemSelectEvent.subscribe(myHandler);  
		
		return {
			search: search,
			autoNomb: autoNomb
		};		
	});
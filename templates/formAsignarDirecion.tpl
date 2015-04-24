<html>
	<head>
		<link rel="stylesheet" href="{RUTA_RAIZ}/estilos/orfeo.css">
		<script src="{RUTA_RAIZ}/js/popcalendar.js"></script>
		<script src="{RUTA_RAIZ}/js/mensajeria.js"></script>
		<script language="javascript">
			vecSubseccionE = new Array ({ARREGLOJS});
			vecSeccionE = new Array ();
			vecCategoriaE = new Array ();
			
			//Inicializo las variables isNav, isIE dependiendo del navegador
			var isNav, isIE

			if (parseInt(navigator.appVersion) >= 4) {
				if (navigator.appName == "Netscape" ) {
					isNav = true;
				} else{
					isIE = true;
				}	
			}

			//Variable que va a tener el valor de la opcion seleccionada para hacer la busqueda.
			var idFinal = 0;

			//Estructuras para almacenar la informacion de las tablas de categorias, seccion y subseccion de la base de datos.
			function categoriaE (id, nombre) {
				this.id = id;
				this.nombre = nombre;
			}

			function seccionE (id, nombre, id_categoria) {
				this.id = id;
				this.nombre = nombre;
				this.id_categoria = id_categoria;
			}

			function subseccionE (id, nombre, id_seccion) {
				this.id = id;
				this.nombre = nombre;
				this.id_seccion = id_seccion;
			}
	
			/* 
			 * Funcion que segun la opcion de la categoria, 
			 * arma el combo de la seccion con los datos que tienen como padre dicha categoria.
			 */
			function cambiar_seccion(elselect) {	
				var j = 1;
				limpiar_todo();
				indice = elselect.selectedIndex;
				id = elselect.options[indice].value;
				nombre = elselect.options[indice].text;
				for (i=0; i<vecSubseccionE.length;i++) {
					if (vecSubseccionE[i].id_categoria==id) {
						document.formDireccion.municipio.options[j] = new Option(vecSubseccionE[i].nombre,vecSubseccionE[i].id);
					j ++;
				}
			}
			if(j==1){
				document.formDireccion.causal_new.options[0] = new Option('No aplica.',0);
				document.formDireccion.municipio.options[0] = new Option('No aplica.',0);
			}
			idFinal = id;
			nombreFinal = nombre;
		}
	
		/* 
		 * Funcion que segun la opcion de la seccion, 
		 * arma el combo de la subseccion con los datos que tienen como padre dicha seccion.
		 */
		function cambiar_subseccion(elselect) {
			limpiar_subseccion();
			indice = elselect.selectedIndex;
			id = elselect.options[indice].value;
			nombre = elselect.options[indice].text;
			var j = 1;
			for (i=0; i<vecSubseccionE.length;i++) {
				if (vecSubseccionE[i].id_seccion==id) {
					document.formDireccion.municipio.options[j] = new Option(vecSubseccionE[i].nombre,vecSubseccionE[i].id);
					j ++;
				}	
			}
			if(j==1){
				document.formDireccion.deta_causal.options[0] = new Option('Seleccione un Municipio',1);
			}
			idFinal = id;
			nombreFinal = nombre;
		}

		//Funciones que borran los datos de los combos y los deja con un solo valor 0.
		function limpiar_todo(){
			document.formDireccion.municipio.options[0]= new Option('Seleccione un Municipio',1);
			var tamsubsec = document.formDireccion.municipio.options.length;
			for (j=1;j<tamsubsec;j++) {
				document.formDireccion.municipio.options[1] = null;
			}
		}

		function limpiar_subseccion(){
			document.formDireccion.municipio.options[0]= new Option('Seleccione un Municipio',1);
			var tamsubsec = document.formDireccion.municipio.options.length;
			alert(document.formDireccion.municipio.options[0]);
			for (j=1; j<tamsubsec ; j++) {
				document.formDireccion.municipio.options[1] = null;
			}
		}

		//Funcion que actualiza el idFinal
		function cambiar_idFinal(elselect){
			indice = elselect.selectedIndex;
			id = elselect.options[indice].value;
			nombre = elselect.options[indice].text;
			idFinal = id ;
			nombreFinal = nombre;
		}
	
		//Funcion que valida los campos y pasa a la pagina siguiente despues de hacer enter en el campo palabra
		function cambiar_pagina(){
			indice = document.formDireccion.categoria.selectedIndex;
			if (document.formDireccion.categoria.options[indice].value == 0) {
				alert("Escoja un Departamento");
				return (false);
			}  else if ( idFinal == 18 || idFinal == 16 ) {
				alert("Escoja una seccion");
				return (false);
			}  else if ( idFinal == 26 || idFinal == 27 || idFinal == 28 || idFinal == 29 ) {
				alert("Escoja una Subseccion");
				return (false);
			} else {
				document.formDireccion.target = "";
				document.formDireccion.action = "resultados_empleo.php";
				if (idFinal != "") {
					document.formDireccion.id.value = idFinal;
					document.formDireccion.nombre.value = nombreFinal;
				}	
				return (true); 
			}
		}

		/*
		 * Funcion que valida los campos y pasa a la pagina 
		 * siguiente despues de hacer click en el boton de buscar
		 */
		function cambiar_pagina_buscar(){
			//Obtengo la fecha que le interesa buscar al usuario
			//document.form_causales.historico.value = document.form_causales.fechas_historico.value;
			
			//Obtengo el indice de la fecha
			//indice_fecha = document.form_causales.fechas_historico.selectedIndex;
		
			//Obtengo el valor de la fecha completa
			//document.form_causales.fecha_completa.value = document.form_causales.fechas_historico.options[indice_fecha].text;
	
			indice = document.form_causales.categoria.selectedIndex;     
			if (document.form_causales.categoria.options[indice].value == 0) {
				alert("Escoja una categoria");
			} else if ( idFinal == 18 || idFinal == 16 ) {
				alert("Escoja una seccion");
			} else if ( idFinal == 26 || idFinal == 27 || idFinal == 28 || idFinal == 29 ) {
				alert("Escoja una Subseccion");
			} else {
				document.form_causales.target = "";
				document.form_causales.action = "resultados_empleo.php";
				if (idFinal != "") {
					document.form_causales.id.value = idFinal;
					document.form_causales.nombre.value = nombreFinal;
				}
				document.form_causales.submit();
			}
		}
	
		function verificacionCampos() {
			document.formDireccion.submit();
		}
	
		function cerrar() {
			opener.regresar();
			window.close();
		}
	</script>
</head>
<table border="0" width="100%" cellpadding="0" cellspacing="5" class="borde_tab">
<form name="formDireccion" method="post" action="{RUTA_RAIZ}{FILE_TARGET}?{SESS_NAME}={SESS_ID}&krd={USUARIO}&verrad={RADICADO}">
  <tr>
    <td class="titulos2">DIRECCI&Oacute;N:</td>
  <td>
	<input type="text" name="radicado[direccion]" value="{DIRECCION}">
	<input type="hidden" name="anexo" value="{ANEX_CODIGO}">
	<input type="hidden" name="verrad" value="{RADICADO}">
	<input type="hidden" name="{SESS_NAME}" value="{SESS_ID}">
  </td>
  </tr>
  <tr>
    <td class="titulos2">DEPARTAMENTO:</td>
    <td width="70%">
	{DPTO_SELECT}
    </td>
  <tr>
    <td class="titulos2">MUNICIPIO:</td>
    <td width="323">
	{MUNI_SELECT}
    </td>	
  </tr>
   {BORRAR}
  <tr>
    <td colspan="2" align="center">
      <table>
       <td align="right">
          <input type="button" name="grabarDireccion" value="{ACCION}"  class="botones" onclick="verificacionCampos();">
       </td>
       <td align="left">
          <input type="button" name="grabarDireccion" value="Cerrar" class="botones" onclick="cerrar();">
       </td>
      </table>
    </td>
  </tr>
</form>
</table>

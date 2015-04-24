<?PHP

/********* CONFIGURACION DE LOS PARAMETROS DEL FORMULARIO POR MEDIO DEL CUAL SE FILTRA LA CONSULTA *********/


       
      // Titulo del formulario de búsqueda segun la opcion seleccionada

      $sFormTitle[0]="GENERACION DE REPORTES - PRESTAMO DE DOCUMENTOS FISICOS";
      $sFormTitle[1]="BUSQUEDA - DOCUMENTOS SOLICITADOS PARA PRESTAR";
      $sFormTitle[2]="BUSQUEDA - DOCUMENTOS PRESTADOS PARA DEVOLVER";
      $sFormTitle[3]="BUSQUEDA - DOCUMENTOS SOLICITADOS PARA CANCELAR";
      $sFormTitle[4]="BUSQUEDA - ESTADO DE RESERVAS ".strtoupper($flds_USUA_LOGIN);	  



      // Oculta o hace visibles los criterios de búsqueda según la opcion seleccionada

      for ($i=0; $i<9; $i++) {
         for ($j=0; $j<5; $j++) { $tipoBusqueda[$i][$j]=""; }
      }
      $tipoBusqueda[0][8]="none"; //reporte
      $tipoBusqueda[1][4]="none"; //prestamo
      $tipoBusqueda[1][5]="none";
      $tipoBusqueda[1][6]="none";
      $tipoBusqueda[1][7]="none";
      $tipoBusqueda[1][8]="none";
      $tipoBusqueda[2][4]="none"; //devolucion
      $tipoBusqueda[2][5]="none";
      $tipoBusqueda[2][6]="none";
      $tipoBusqueda[2][7]="none";
      $tipoBusqueda[2][8]="none";
      $tipoBusqueda[3][0]="none"; //cancelacion
      $tipoBusqueda[3][1]="none";
      $tipoBusqueda[3][3]="none";
      $tipoBusqueda[3][4]="none";
      $tipoBusqueda[3][5]="none";
      $tipoBusqueda[3][6]="none";
      $tipoBusqueda[4][1]="none"; //estado de reservas
      $tipoBusqueda[4][2]="none";
      $tipoBusqueda[4][3]="none";
      $tipoBusqueda[4][8]="none";
      $tipoBusqueda[4][9]="none";
      $tipoBusqueda[4][10]="none";
      $tipoBusqueda[4][11]="none";	  	  	  	  
      $tipoBusqueda[4][12]="none";	  	  	  	  
      $tipoBusqueda[4][13]="none";	  	  	  	  
      $tipoBusqueda[4][14]="none";	 
?>		 
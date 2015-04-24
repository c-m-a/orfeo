<?PHP

/********* CONFIGURACION DE LA TABLA CON LOS RESULTADOS DE LA CONSULTA SEGUN LA OPCION SELECCIONADA *********/



         // Título de la tabla

         $tituloRespuesta[0]="RADICADOS ENCONTRADOS";
         $tituloRespuesta[1]="DOCUMENTOS SOLICITADOS";
         $tituloRespuesta[2]="DOCUMENTOS PRESTADOS";
         $tituloRespuesta[3]="RADICADOS SOLICITADOS ANTES DE ".$fechaFinal." (".$ps_hora_limite.":".$ps_minuto_limite." ".$ps_meridiano.")";
         $tituloRespuesta[4]="ESTADO DE RESERVAS ".strtoupper($ps_USUA_LOGIN);
         


         // Título del botón que procesa los registros marcados por el usuario

         $tituloSubmitRta[0]="";
         $tituloSubmitRta[1]="Prestar";
         $tituloSubmitRta[2]="Devolver";
         $tituloSubmitRta[3]="Confirmar";
         $tituloSubmitRta[4]="";



         // Título de ayuda de la diferencia de días

         if($opcionMenu==1 || $opcionMenu==3){ $ayudaDifFecha="D&iacute;as restantes para entregar el documento o los anexos"; }
         elseif($opcionMenu==2)              { $ayudaDifFecha="D&iacute;as transcurridos desde que se hizo la solicitud"; }



         // Oculta o hace visible las columnas

         $numRtaMax=19; 
         for ($i=0; $i<=$numRtaMax; $i++) {
            for ($j=0; $j<5; $j++) { $tipoRespuesta[$i][$j]=""; } //visibles
         }
         $tipoRespuesta[0][9] ="none"; //reporte
         $tipoRespuesta[0][11]="none";
         $tipoRespuesta[0][18]="none";
         $tipoRespuesta[0][19]="none";		  		 
         $tipoRespuesta[1][5] ="none"; //prestamo
         $tipoRespuesta[1][6] ="none";
         $tipoRespuesta[1][7] ="none";
         $tipoRespuesta[1][8] ="none";
         $tipoRespuesta[1][12]="none";
         $tipoRespuesta[1][13]="none";
         $tipoRespuesta[1][14]="none";
         $tipoRespuesta[1][15]="none";
         $tipoRespuesta[1][17]="none";
         $tipoRespuesta[1][18]="none";		 		 
         $tipoRespuesta[2][6] ="none"; //devolucion
         $tipoRespuesta[2][8] ="none";
         $tipoRespuesta[2][12]="none";		 
         $tipoRespuesta[2][14]="none";
         $tipoRespuesta[2][15]="none";
         $tipoRespuesta[2][17]="none";
         $tipoRespuesta[2][18]="none";		 
         $tipoRespuesta[3][5] ="none"; //cancelacion
         $tipoRespuesta[3][6] ="none";
         $tipoRespuesta[3][7] ="none";
         $tipoRespuesta[3][8] ="none";
         $tipoRespuesta[3][11]="none";
         $tipoRespuesta[3][12]="none";
         $tipoRespuesta[3][13]="none";
         $tipoRespuesta[3][14]="none";
         $tipoRespuesta[3][15]="none";
         $tipoRespuesta[3][17]="none";
         $tipoRespuesta[3][18]="none";		 
         $tipoRespuesta[4][1] ="none"; //estado de reserva
         $tipoRespuesta[4][2] ="none";
         $tipoRespuesta[4][3] ="none";
         $tipoRespuesta[4][9] ="none";
         $tipoRespuesta[4][11]="none";
         $tipoRespuesta[4][13]="none";
         $tipoRespuesta[4][14]="none";
         $tipoRespuesta[4][15]="none";
         $tipoRespuesta[4][17]="none";
         $tipoRespuesta[4][19]="none";


 
         // Número de columnas de la tabla

         $numCol=0;
         for ($j=0; $j<=$numRtaMax; $j++) { 
            if ($tipoRespuesta[$opcionMenu][$j]=="") { $numCol=$numCol+1; }
         }	  
?>
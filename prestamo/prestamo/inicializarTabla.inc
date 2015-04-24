<?PHP

/********* TITULO DE LAS COLUMNAS DE LA TABLA CON LOS RESULTADOS DE LA CONSULTA *********/


         // Oculta o Hace visible la flecha que indica la columna por la cual se ordena el resultado
         $numRta=16; //número de columnas de la respuestas
         for($j=1; $j<$numRta; $j++) {
            if($j==$iSort){ 
               if($sDirection==" DESC ") { $flecha[$j]="<img src='".$ruta_raiz."/iconos/flechadesc.gif' border=0 alt=''>"; }
               else                      { $flecha[$j]="<img src='".$ruta_raiz."/iconos/flechaasc.gif'  border=0 alt=''>"; }
            }
            else{ $flecha[$j]=""; }
         }       
         for($j=1; $j<$numRta; $j++) {
            $href[1][$j]="href=\"javascript: ordenar($j); \"";           //formEnvio.php
            $href[0][$j]="href=\"".$sFileName."?".$form_params.$j."&\""; //prestamo.php
         }
         $j=0;
         if($sFileName=="formEnvio.php") { $j=1; } 
?>
         <tr class="titulos5" align="center">
            <td id="r0"  style="display:<?=$tipoRespuesta[$opcionMenu][0]; ?>"><a class="vinculos" <?=$href[$j][1]?>> <?=$flecha[1]?> Radicado</a></td>	 
            <td id="r1"  style="display:<?=$tipoRespuesta[$opcionMenu][1]; ?>"><a class="vinculos">Expediente</a></td>	 
            <td id="r2"  style="display:<?=$tipoRespuesta[$opcionMenu][2]; ?>"><a class="vinculos" <?=$href[$j][3]?>> <?=$flecha[3]?> Usuario</a></td>	 
            <td id="r3"  style="display:<?=$tipoRespuesta[$opcionMenu][3]; ?>"><a class="vinculos" <?=$href[$j][4]?>> <?=$flecha[4]?> Dependencia</a></td>	 
            <td id="r4"  style="display:<?=$tipoRespuesta[$opcionMenu][4]; ?>"><a class="vinculos" <?=$href[$j][5]?>> <?=$flecha[5]?> Fecha<br>Solicitud</a></td>	 
            <td id="r5"  style="display:<?=$tipoRespuesta[$opcionMenu][5]; ?>"><a class="vinculos" <?=$href[$j][6]?>> <?=$flecha[6]?> Fecha<br>Prestamo</a></td>	 			
            <td id="r6"  style="display:<?=$tipoRespuesta[$opcionMenu][6]; ?>"><a class="vinculos" <?=$href[$j][7]?>> <?=$flecha[7]?> Fecha<br>Cancelaci&oacute;n</a></td>	 			
            <td id="r7"  style="display:<?=$tipoRespuesta[$opcionMenu][7]; ?>"><a class="vinculos" <?=$href[$j][8]?>> <?=$flecha[8]?> Fecha<br>Vencimiento</a></td>	 
            <td id="r8"  style="display:<?=$tipoRespuesta[$opcionMenu][8]; ?>"><a class="vinculos" <?=$href[$j][9]?>> <?=$flecha[9]?> Fecha<br>Devoluci&oacute;n</a></td>	 
            <td id="r9"  style="display:<?=$tipoRespuesta[$opcionMenu][9]; ?>" title="<?=$ayudaDifFecha?>"><a class="vinculos">Tiempo<br>Espera</font></a></td>	 
            <td id="r10" style="display:<?=$tipoRespuesta[$opcionMenu][10];?>"><a class="vinculos" <?=$href[$j][10]?>><?=$flecha[10]?> Requerimiento</a></td>
            <td id="r11" style="display:<?=$tipoRespuesta[$opcionMenu][11];?>"><a class="vinculos" <?=$href[$j][11]?>><?=$flecha[11]?> No Pag.</a></td>
            <td id="r12" style="display:<?=$tipoRespuesta[$opcionMenu][12];?>"><a class="vinculos" <?=$href[$j][12]?>><?=$flecha[12]?> Estado</a></td>
            <td id="r13" style="display:<?=$tipoRespuesta[$opcionMenu][13];?>"><a class="vinculos" <?=$href[$j][13]?>><?=$flecha[13]?> Usuario<br>Prestamo</a></td>
            <td id="r14" style="display:<?=$tipoRespuesta[$opcionMenu][14];?>"><a class="vinculos" <?=$href[$j][14]?>><?=$flecha[14]?> Usuario<br>Cancela</a></td>
            <td id="r15" style="display:<?=$tipoRespuesta[$opcionMenu][15];?>"><a class="vinculos" <?=$href[$j][15]?>><?=$flecha[15]?> Usuario<br>Recibe</a></td>
            <td id="r16" style="display:<?=$tipoRespuesta[$opcionMenu][16];?>"><a class="vinculos">Archivado</a></td>		 		 
            <td id="r17" style="display:<?=$tipoRespuesta[$opcionMenu][17];?>"><a class="vinculos">Ver Hist&oacute;rico</a></td>
            <td id="r18" style="display:<?=$tipoRespuesta[$opcionMenu][18];?>"><a class="vinculos">Acci&oacute;n</a></td>			
            <td id="r19" style="display:<?=$tipoRespuesta[$opcionMenu][19];?>"><input type="checkbox" name="rta_" value="checkbox" onClick="javascript: seleccionarRta();"></td>
         </tr> 
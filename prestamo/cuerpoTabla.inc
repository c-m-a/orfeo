<?PHP

/********* FILA DE LA TABLA CON LOS RESULTADOS *********/



         // Indica el estilo de la fila

         if($y%2==0){ $tipoListado="class=\"listado2\""; }
         else       { $tipoListado="class=\"listado1\""; }

 

         // Inicializa algunas de las variables

         $antfldEXPEDIENTE=$antfldEXP;
         $antfldARCHIVADO=$antfldARCH;
         $form_params_hist = "radicado=".$antfldRADICADO."&krd=".tourl($krd);
         $cadRadicado="<div align=\"right\">".$antfldRADICADO."</div>";
         if($antfldPATH!="") {
            $cadRadicado="<a class='vinculos' href='".$ruta_raiz."/bodega".$antfldPATH."' target='Imagen'>".$antfldRADICADO."</a>";
         }

         // Fila con los resultados
?>
         <tr <?= $tipoListado; ?>>
            <td id="r0"  style="display:<?=$tipoRespuesta[$opcionMenu][0]; ?>"  class="leidos"><?= $cadRadicado?></td>
            <td id="r1"  style="display:<?=$tipoRespuesta[$opcionMenu][1]; ?>"  class="leidos"><?= $antfldEXPEDIENTE; ?></td>	 
            <td id="r2"  style="display:<?=$tipoRespuesta[$opcionMenu][2]; ?>"  class="leidos"><?= tohtml($antfldNOMBRE); ?></td>	 
            <td id="r3"  style="display:<?=$tipoRespuesta[$opcionMenu][3]; ?>"  class="leidos"><?= tohtml($antfldDEPENDENCIA); ?></td>	 
            <td id="r4"  style="display:<?=$tipoRespuesta[$opcionMenu][4]; ?>"  class="leidos"><?= substr($antfldF_PEDIDO,0,10)."<br>".substr($antfldF_PEDIDO,11,18); ?></td>	 
            <td id="r5"  style="display:<?=$tipoRespuesta[$opcionMenu][5]; ?>"  class="leidos"><?= substr($antfldF_PRESTADO,0,10)."<br>".substr($antfldF_PRESTADO,11,18); ?></td>	 
            <td id="r6"  style="display:<?=$tipoRespuesta[$opcionMenu][6]; ?>"  class="leidos"><?= substr($antfldF_CANC,0,10)."<br>".substr($antfldF_CANC,11,18); ?></td>	 
            <td id="r7"  style="display:<?=$tipoRespuesta[$opcionMenu][7]; ?>"  class="leidos"><?= substr($antfldF_VENCIDO,0,10)."<br>".substr($antfldF_VENCIDO,11,18); ?></td>	 
            <td id="r8"  style="display:<?=$tipoRespuesta[$opcionMenu][8]; ?>"  class="leidos"><?= substr($antfldF_DEVUELTO,0,10)."<br>".substr($antfldF_DEVUELTO,11,18); ?></td>
            <td id="r9"  style="display:<?=$tipoRespuesta[$opcionMenu][9]; ?>"  class="leidos" title="<?=$ayudaDifFecha?>"><div align="center"><?= $antdifFecha; ?></div></td>
            <td id="r10" style="display:<?=$tipoRespuesta[$opcionMenu][10];?>"  class="leidos"><?= tohtml($antfldREQUERIMIENTO); ?></td>
            <td id="r11" style="display:<?=$tipoRespuesta[$opcionMenu][11];?>"  class="leidos"><?= tohtml($antfldNumPag); ?></td>
            <td id="r12" style="display:<?=$tipoRespuesta[$opcionMenu][12];?>"  class="leidos"><?= tohtml($antfldESTADO); ?></td>
            <td id="r13" style="display:<?=$tipoRespuesta[$opcionMenu][13];?>"  class="leidos"><?= tohtml($antfldLOGIN_PRES); ?></td>
            <td id="r14" style="display:<?=$tipoRespuesta[$opcionMenu][14];?>"  class="leidos"><?= tohtml($antfldLOGIN_CANC); ?></td>
            <td id="r15" style="display:<?=$tipoRespuesta[$opcionMenu][15];?>"  class="leidos"><?= tohtml($antfldLOGIN_RX); ?></td>
            <td id="r16" style="display:<?=$tipoRespuesta[$opcionMenu][16];?>"  class="leidos"><div align="center"><?= $antfldARCHIVADO; ?></div></td>
            <td id="r17" style="display:<?=$tipoRespuesta[$opcionMenu][17];?>"  class="leidos"><a href="historico.php?<?=$form_params_hist?>&">Ver hist&oacute;rico</a></td>
            <td id="r18" style="display:<?=$tipoRespuesta[$opcionMenu][18];?>"  class="leidos"><a><?=$antaccion?></a></td>
            <td id="r19" style="display:<?=$tipoRespuesta[$opcionMenu][19];?>"  class="leidos" align="right"><input type="checkbox" name="rta_<?=$y-1; ?>" value="<?=$antfldPRESTAMO_ID; ?>"></td>			
         </tr>
<?PHP?>		 

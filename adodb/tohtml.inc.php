<?php
  /*
    V4.52 10 Aug 2004  (c) 2000-2004 John Lim (jlim@natsoft.com.my). All rights reserved.
    Re  library license.
    Whenever there is any discrepancy between the two licenses,
    the BSD license will take precedence.

    Some pretty-printing by Chris Oxenreider <oxenreid@state.net>
  */

  // specific code for tohtml

  global $gSQLMaxRows,$gSQLBlockRows, $HTTP_GET_VARS;

  $gSQLMaxRows = 1000; // max no of rows to download
  $gSQLBlockRows=25; // max no of rows per table block
  global $colOptions;
  global $pagEdicion;
  global $pagConsulta;

  // Function to get the query in an array to work with Smarty
  function rs2array(&$db,&$rsTmp,$ztabhtml=false,
                                $zheaderarray=false,
                                $htmlspecialchars=true,
                                $echo = true,
                                $toRefVar,
                                $orderTipo,
                                $ordenActual,
                                $rutaRaiz,
                                $checkAll=false,
                                $checkTitulo=false,
                                $descCarpetasGen,
                                $descCarpetasPer,
                                $colOptions=false,
                                $pagEdicion=null,
                                $pagConsulta=null) {
    
    $rs_array = array();
    $enlace_ver_radicado = '';

    $orderTipo = (strtoupper(trim($orderTipo)) != 'DESC')? 'asc' : 'desc';
    $s = '';
    $rows = 0;
    $docnt = false;
    
    GLOBAL $gSQLMaxRows,$gSQLBlockRows,$HTTP_GET_VARS,$HTTP_SESSION_VARS;
    
    if (!$rsTmp) {
      printf(ADODB_BAD_RS,'rs2html');
      return false;
    }

    if (!$ztabhtml) $ztabhtml = " width='98%'";
    
    $typearr = array();
    
    // Respuesta de la consulta en un arreglo
    if (isset($rsTmp->_array)) {
      $rs_array = $rsTmp->_array;
    } else {
      while (!$rsTmp->EOF) {
        $rs_array[] = $rsTmp->fields;
        $rsTmp->MoveNext();
      }
    }

    $ncols = $rsTmp->FieldCount();

    $img_no = $ordenActual;

    $radicados = array();
    $contador = 0;
    
    foreach ($rs_array as $radicado) {
      $nombre_archivo       = '';
      $enlace_imagen        = '';
      $enlace_ver_radicado  = '';
      $ruta_archivo         = $radicado['HID_RADI_PATH'];
      $longitud_ruta        = strlen($ruta_archivo);
      $entidad              = $radicado['ENT SOLIDARIA'];
      $longitud_entidad     = strlen($entidad);
      $max_logintud         = 57;
    
      if($hor) {
        $order = $i -$hor;
        $hor = 0;
      } else {
       $order = $i;
      }
      
      $order = $i;
      
      $encabezado = $toRefVar . $order;
      
      if ($longitud_ruta > 2) {
        $arreglo_ruta = explode('/', $ruta_archivo);
        $nombre_archivo = end($arreglo_ruta);
        $enlace_imagen = $rutaRaiz . '/descargar_archivo.php?' .
                            'ruta_archivo=' . $ruta_archivo .
                            '&nombre_archivo=' . $nombre_archivo .
                            '&from=bandeja';
      }
      
      $numero_radicado = $radicado['IDT_NUMERO_RADICADO'];
      $enlace_ver_radicado = $rutaRaiz . '/ver_radicado.php?' .
                            'verrad=' . $numero_radicado .
                            '&' . $encabezado . 
                            '&from=bandeja';
      
      // Cortar el nombre de la entidad si son demasidos caracteres
      $entidad = ($longitud_entidad >= $max_logintud)? substr($entidad, 0, $max_logintud) . '...' : $entidad;
      
      $radicados[$contador]['ruta_imagen']    = $enlace_imagen;
      $radicados[$contador]['entidad']        = $entidad;
      $radicados[$contador]['enlace_ver_radicado'] = $enlace_ver_radicado;

      foreach ($radicado as $key => $value) {
        if ($key == 'HID_RADI_LEIDO')
          $radicados[$contador][$key] = (isset($value))? 'leidos' : 'no_leidos';
        else
          $radicados[$contador][$key] = $value;
      }
      
      $contador++;
    }
    
    return $radicados;
   } // rs2array

  function rs2html(&$db,&$rsTmp,$ztabhtml=false,
                                $zheaderarray=false,
                                $htmlspecialchars=true,
                                $echo = true,
                                $toRefVar,
                                $orderTipo,
                                $ordenActual,
                                $rutaRaiz,
                                $checkAll=false,
                                $checkTitulo=false,
                                $descCarpetasGen,
                                $descCarpetasPer,
                                $colOptions=false,
                                $pagEdicion=null,
                                $pagConsulta=null) {
    
    $orderTipo = (strtoupper(trim($orderTipo)) != 'DESC')? 'asc' : 'desc';
    $s ='';
    $rows=0;
    $docnt = false;
    
    GLOBAL $gSQLMaxRows,$gSQLBlockRows,$HTTP_GET_VARS,$HTTP_SESSION_VARS;
    
    if (!$rsTmp) {
      printf(ADODB_BAD_RS,'rs2html');
      return false;
    }

    if (! $ztabhtml) $ztabhtml = " width='98%'";
    //else $docnt = true;
    $typearr = array();
    $ncols = $rsTmp->FieldCount();

    $hdr = "<table cols='$ncols' $ztabhtml><tr>\n\n";
    $img_no = $ordenActual;

    for ($i=0; $i < $ncols; $i++) {
      $field = $rsTmp->FetchField($i);
      $fname = ($zheaderarray)? $zheaderarray[$i] : htmlspecialchars($field->name);
      
      $typearr[$i] = $rsTmp->MetaType($field->type,$field->max_length);
      
      if (strlen($fname)==0) $fname = '&nbsp;';
      
      if(isset($hor)) {
        $order = $i -$hor;
        $hor = 0;
      } else {
       $order = $i;
      }
      
      $order = $i;
      
      $encabezado = $toRefVar.$order;

      if($fname == "HID_RADI_LEIDO") {
        $campoLeido = $i;
      }

      if($fname == "IMG_Numero Radicado") {
        $iRad = $i;
      }

      $prefijo = substr($fname,0,4);

      switch(substr($fname,0,4)) {
        case 'CHU_':
          break;
        case 'CHR_':
          break;
        case 'CHK_':
          break;
        case 'IDT_';
          $fname = substr($fname,4,20);
          break;
        case 'IMG_';
          $fname = substr($fname,4,20);
          break;
        case 'DAT_':
          $fname = substr($fname,4,20);
          break;
        case 'HOR_':
          $hor = 1;
          break;
        case 'HID_':
          $hor = 1;
          break;
      }
      
      if($prefijo!="HID_" AND $prefijo!="CHU_" AND $prefijo!="CHR_" AND $prefijo!="CHK_" AND $prefijo!="HOR_") {
        $hdr .= "<th class='titulos3'><a href='".$_SERVER['PHP_SELF']."?$encabezado&orden_cambio=1'><span class=titulos3>";
        
        if($img_no==$i)
          $hdr .= "<img src='$rutaRaiz/iconos/flecha$orderTipo.gif' border='0'>";
        
        $hdr .= "$fname</span></a></th>";
      } else {
        if(substr($fname,0,4)=="CHU_") {
          $hdr .= "<td class='titulos2' width='1%'>
                    <center>
                      <img src='$rutaRaiz/imagenes/estadoDoc.gif' border='0' align='left' width='130' height='32'></td>";
        }

        if(substr($fname,0,4)=="CHR_") {
          $hdr .= "<th class='titulos2' width='1%'><center></th>";
        }

        if(substr($fname,0,4)=="CHK_") {
          if($checkAll==true) $valueCheck = " checked "; else $valueCheck = "";

          if($checkTitulo==true) {
           $fname = "<center>
                      <input type='checkbox' name='checkAll' value='checkAll' onClick='markAll();' $valueCheck>
                     </center>";
          } else {
           $fname = " ";
          }
          $hdr .= "<th class='titulos2' width='1%'>$fTitulo $fname</TH>";
        }
      }
    }

   /** Colocar el nombre de la Columna 'Opciones'
     * Fecha de modificacion: 10-Mayo-2006
     * Modificador: Supersolidaria
     */
    if($colOptions==true) {
      $hdr .= '<td class="titulos3">OPCIONES</td></tr>';
    }

    $hdr .= "\n</tr>";
    
    if ($echo)
      print $hdr."\n\n";
    else
      $html = $hdr;
    
    // smart algorithm - handles ADODB_FETCH_MODE's correctly by probing...
    $numoffset = isset($rsTmp->fields[0]) ||isset($rsTmp->fields[1]) || isset($rsTmp->fields[2]);
    $ii = 0;
    while (!$rsTmp->EOF) {
      if($ii==0) {
        $class_grid = 'listado1';
        $ii=1;
      }	else {
        $class_grid = 'listado2';
        $ii = 0;
      }
        if (empty($iRad))
          $iRad = null;
        
        $s .= "<tr class='$class_grid' valign='top'>\n";
        $estadoRad = (isset($rsTmp->fields["HID_RADI_LEIDO"]))? $rsTmp->fields["HID_RADI_LEIDO"] : null;
        $radicado = (isset($rsTmp->fields[$iRad]))? $rsTmp->fields[$iRad] : null;
        
        if($radicado)
          include("$rutaRaiz/tx/imgRadicado.php");
        
        $radFileClass = ($estadoRad == 1)? 'leidos' : 'no_leidos';
      
      if (strlen(trim($estadoRad)) == 0)
        $radFileClass = "leidos";
      
      for ($i=0; $i < $ncols; $i++) {
        $special = "no";

        if ($i===0) $v=($numoffset) ? $rsTmp->fields[0] : reset($rsTmp->fields);
        else $v = ($numoffset) ? $rsTmp->fields[$i] : next($rsTmp->fields);
        $field = $rsTmp->FetchField($i);
        $vNext = (isset($rsTmp->fields[($i+1)]))? $rsTmp->fields[($i+1)] : null;
        $vNext1 = (isset($rsTmp->fields[($i+2)]))? $rsTmp->fields[($i+2)] : null;
        $fname = substr($field->name,0,4);

        switch($fname) {
         case 'CHU_';
          $chk_nomb = substr($field->name,4,20);
          $chk_value = $v;
          $valVNext = 0;
          if ($vNext ==99)  $valVNext = 99;
          if ($vNext ==0 OR $vNext ==NULL) {
            $valVNext = 97;
          } else {
            if ($vNext > 0)
              $valVNext = 98;
          }
          $fecha_dev  = $vNext1;

          switch($valVNext) {
          case 99:
            $v =	"<img src='$rutaRaiz/imagenes/docDevuelto_tiempo.gif'  border=0 alt='Fecha Devolucion :$fecha_dev' title='Fecha Devolucion :$fecha_dev'>";
            break;
          case  98:
            $v =	"<img src='$rutaRaiz/imagenes/docDevuelto.gif'  border=0 alt='Fecha Devolucion :$fecha_dev' title='Fecha Devolucion :$fecha_dev'>";
            break;
          case 97:
            $fecha_dev = $rsTmp->fields["HID_SGD_DEVE_FECH"];
            if($rsTmp->fields["HID_DEVE_CODIGO1"]==99) {
              $v =	"<img src='$rutaRaiz/imagenes/docDevuelto_tiempo.gif'  border=0 alt='Fecha Devolucion :$fecha_dev' title='Devolucion por Tiempo de Espera'>";
              $noCheckjDevolucion = "enable";
              break;
            }
            if($rsTmp->fields["HID_DEVE_CODIGO"]>=1 and $rsTmp->fields["HID_DEVE_CODIGO"]<=98) {
              $v =	"<img src='$rutaRaiz/imagenes/docDevuelto.gif'  border=0 alt='Fecha Devolucion :$fecha_dev' title='Fecha Devolucion :$fecha_dev'>";
              $noCheckjDevolucion = "disable";
              break;
            }
            switch($v) {
              case 2;
              $v = "<img src='$rutaRaiz/imagenes/docRadicado.gif' border='0'>";
              break;
              case 3;
              $v = "<img src='$rutaRaiz/imagenes/docImpreso.gif' border='0'>";
              break;
              case 4;
              $v =	"<img src='$rutaRaiz/imagenes/docEnviado.gif' border='0'>";
              break;
            }
          break;
      }
    $special = 'si';
    break;
      case 'CHR_';
        $chk_value = $v;
        if ($vNext !=0 AND $vNext !=NULL AND $vNext1 ==3)
          $v = "<img src='$rutaRaiz/imagenes/check_x.jpg' alt='Debe Modificar el Documento para poder reenviarlo'  title='Debe Modificar el Documento para poder reenviarlo' >";
        else
          $v = "<input type='radio' name='valRadio' value='$chk_value' class='ebuttons2'>";
          $special = "si";
          break;
        case 'CHK_';
        $chk_nomb = substr($field->name,4,20);
        $chk_value = $v;
        
        $valueCheck = ($checkAll==true)? ' checked ' : '';

        if ($noCheckjDevolucion=="disable")
        $v = "<img src='$rutaRaiz/imagenes/check_x.jpg' alt='Debe Modificar el Documento para poder reenviarlo'  title='Debe Modificar el Documento para poder reenviarlo' >";
        else
        $v = "<input type='checkbox' name='checkValue[$chk_value]' value='$chk_nomb' $valueCheck >";
        $special = 'si';
        break;
      case ($fname =='IMG_' or $fname=='IDT_');
        /** Colocar en color rojo los radicados que tienen anexos impresos
              * Fecha de modificacion: 10-Agosto-2006
              * Modificador: Supersolidaria
                */
        
        include_once ("$rutaRaiz/include/tx/Radicacion.php");
        $radicacion = new Radicacion( $db );
        if ($rsTmp->fields["IDT_Numero Radicado"] != "") {
            $arrAnexos = $radicacion->getRadImpresos( $rsTmp->fields["IDT_Numero Radicado"] );
        }
        if ($arrAnexos[0] != 0) {
            $radFileClass = "impresos";
        } else {
          // Aki se verifica si el radicado en mensionado.. posee los impresos.
           $impSql = "SELECT * FROM ANEXOS 
                        WHERE RADI_NUME_SALIDA='".$rsTmp->fields["IDT_Numero Radicado"]."'
                          AND ANEX_ESTADO>=3";
           $rsImp   = $db->conn->query($impSql);
           if($rsImp->fields["ANEX_ESTADO"]>=3){
                        $radFileClass = "impresos";
            }
        }
        // Fin Modificacion Ses
        $i_path     = $i + 1;
        $fieldPATH  = $rsTmp->FetchField($i_path);
        $fnamePATH  = strtoupper($fieldPATH->name);
        $pathImagen = $rsTmp->fields[$fnamePATH];
        $arreglo_explode = explode('/', $pathImagen);
        
        foreach ($arreglo_explode as $value) {
          $nombre_archivo = (preg_match('/.+\.[a-z]+$/',$value, $rs_nombre))? $rs_nombre[0] : null;
        }

        $enlace_imagen = $rutaRaiz . '/descargar_archivo.php?' .
                              'ruta_archivo=' . $pathImagen .
                              '&nombre_archivo=' . $nombre_archivo .
                              '&from=bandeja';
        
        $v = ($pathImagen)?
                "<a href='$enlace_imagen'><span class='$radFileClass'>$v</span></a>" :
                $v;
        
        if ($fname == 'IDT_') {
          $carpPer = $rsTmp->fields["HID_CARP_PER"];
          $carpCodi = $rsTmp->fields["HID_CARP_CODI"];
          $noHojas = $rsTmp->fields["HID_RADI_NUME_HOJA"];
          //Modificado idrd
          $info_resp = $rsTmp->fields["HID_INFO_RESP"]; 

          /** Icono para los informados que necesitan respuesta
          ** Modificado idrd abril 4*/
          $imginfo = ($info_resp and $info_resp=='Responder')?
                        "<img src='$rutaRaiz/png/resp.jpeg' width=18 height=18 alt='$textCarpeta' title='$textCarpeta'>" :
                        '';
          
          $nombreCarpeta = ($carpPer == 0)?
                            $descCarpetasGen[$carpCodi] :
                            '(Personal)' . $descCarpetasPer[$carpCodi];
          
          $textCarpeta ="Carpeta Actual: ".$nombreCarpeta . " -- Numero de Hojas :". $noHojas;
          if($rsTmp->fields["HID_EANU_CODIGO"]==2) {
            $imgTp = "$rutaRaiz/iconos/anulacionRad.gif";
            $textCarpeta = " ** RADICADO ANULADO ** ".$textCarpeta;
          } else	{
            
            $imgTp = ($rsTmp->fields["HID_RADI_TIPO_DERI"]==0 AND $rsTmp->fields["HID_RADI_NUME_DERI"]!=0)?
                      "$rutaRaiz/iconos/anexos.gif" : 
                      "$rutaRaiz/iconos/comentarios.gif";

                      /** Icono que indica si el radicado esta incluido en un expediente.
                        * Fecha de modificacion: 30-Junio-2006
                        * Modificador: Supersolidaria
                        */
                      include_once ("$rutaRaiz/include/tx/Expediente.php");
                      $expediente = new Expediente( $db );
                      if( $rsTmp->fields["IDT_Numero Radicado"] != "" ) {
                          $arrEnExpediente = $expediente->expedientesRadicado( $rsTmp->fields["IDT_Numero Radicado"] );
                      }
                      else if( $rsTmp->fields["IDT_Numero_Radicado"] != "" ) {
                          $arrEnExpediente = $expediente->expedientesRadicado( $rsTmp->fields["IDT_Numero_Radicado"] );
                      }
            // Modificado SGD 20-Septiembre-2007
            if (is_array($arrEnExpediente)) {
              $imgExpediente = ($arrEnExpediente[0] !== 0)?
                                "<img src='$rutaRaiz/iconos/folder_open.gif' width=18 height=18 alt='$textCarpeta' title='$textCarpeta'>":
                                '';
            }
          }
          $imgEstado = "<img src='$imgTp' width=18 height=18 alt='$textCarpeta' title='$textCarpeta'>";
        }else{
          $imgEstado = "";
        }
              /** icono que indica si el radicado esta incluido en un expediente.
                * Fecha de modificacion: 30-Junio-2006
                * Modificador: Supersolidaria
                */
        if($i ==$iRad) {
          $v = ($info_resp and $info_resp="'Responder'")?
                $imgEstado."&nbsp;".$imgExpediente."&nbsp;".$imginfo.$imgRad.$v : 
                $imgEstado."&nbsp;".$imgExpediente."&nbsp;".$imgRad.$v;
        }
        break;
      case 'DAT_';
        $i_radicado = $i+1;
        $fieldDAT = $rsTmp->FetchField($i_radicado);
        $fnameDAT = $fieldDAT->name;
        // Modificado SGD 21-Septiembre-2007
        $verNumRadicado = trim(strtoupper($rsTmp->fields[$fnameDAT]));

        $enlace_ver_radi = $rutaRaiz . '/verradicado.php?' .
                            'verrad=' . $verNumRadicado .
                            '&' . $encabezado . 
                            '&from=bandeja';
        
        $v = '<a href="' . $enlace_ver_radi . '"><span class="'. $radFileClass . '">'.$v.'</span></a>';
        
        $special = "si";
        break;
      }
      
      $type = $typearr[$i];
      
      switch($type) {
      case 'D1':
        if (!strpos($v,':')) {
          $s .= "	<td><span class='$radFileClass'>".$rsTmp->UserDate($v,"d-m-Y, H:i") ."&nbsp;</span></td>\n";
          break;
        }
      case 'T1':
      $s .= "	<td><span class='$radFileClass'>".$rsTmp->UserTimeStamp($v,"d-m-Y, H:I") ."&nbsp;</span></TD>\n";
      break;
      case 'I':
        default:
        $v = stripcslashes(trim($v));
        if (strlen($v) == 0) $v = '&nbsp;';
        if(substr($fname,0,4)!="HID_" AND substr($fname,0,4)!="HOR_") {
          $s .= "<td><span class='$radFileClass'>". str_replace("\n",'<br>',$v) ."</span></td>\n";
        }
        }
      } // for

           /** Colocar las opciones de modificacion y consulta en la Columna 'Opciones'
                   * Fecha de modificacion: 10-Mayo-2006
                   * Modificador: Supersolidaria
                   */
      if($colOptions==true) {
        for ($i=0; $i < $ncols; $i++) {
          if ($i===0)
            $v = ($numoffset) ? $rsTmp->fields[0] : reset($rsTmp->fields);
          else
            $v = ($numoffset) ? $rsTmp->fields[$i] : next($rsTmp->fields);
          
          $field = $rsTmp->FetchField($i);
          $vNext = $rsTmp->fields[($i+1)];
          $vNext1 = $rsTmp->fields[($i+2)];
          $fname = substr($field->name,0,4);
          $i_radicado = $i;
          $fieldDAT = $rsTmp->FetchField($i_radicado);
          $fnameDAT = $fieldDAT->name;
          $identificador = strtoupper($rsTmp->fields[$fnameDAT]);
        }
        $enlace_consulta = $pagConsulta . '?' .
                            'verempresa=' . $identificador . '&' .
                            $encabezado;

        $vista_preliminar = 'iconos/vista_preliminar.gif';
        $pagina_edicion   = $pagEdicion . '?' .
                            'verempresa=' . $identificador . '&' .
                            $encabezado;

        $s .= "<td width='14%'>
                <div align='center'>
                  <a href='$enlace_consulta' target='_self'>
                    <img src='$vista_preliminar' alt='Consultar Datos' width='16' height='17' border='0' hspace='10'>
                  </a>
                  <a href='$pagina_edicion' target='_self'>
                    <img src='iconos/modificar.gif' alt='Modificar Datos' width='16' height='15' border='0' hspace='10'>
                  </a>
                </div>
              </td>";
          }


      $s .= "</tr>\n\n";
      $rows += 1;
      
      if ($rows >= $gSQLMaxRows) {
        $rows = "<p>Truncated at $gSQLMaxRows</p>";
        break;
      } // switch

      $rsTmp->MoveNext();

    // additional EOF check to prevent a widow header
      if (!$rsTmp->EOF && $rows % $gSQLBlockRows == 0) {

      //if (connection_aborted()) break;// not needed as PHP aborts script, unlike ASP
        if ($echo) print $s . "</table>\n\n";
        else $html .= $s ."</table>\n\n";
        $s = $hdr;
      }
    } // while

    if ($echo) print $s."</table>\n\n";
    else $html .= $s."</table>\n\n";
      if ($docnt) if ($echo) print '<h2>' . $rows . ' Rows</H2>';
      return ($echo) ? $rows : $html;
   }

  // pass in 2 dimensional array
  function arr2html(&$arr,$ztabhtml='',$zheaderarray='') {
    if (!$ztabhtml)
      $ztabhtml = 'border="1"';
    
    $s = "<table $ztabhtml class='t_bordeGris' width='98%'>";
    
    if ($zheaderarray) {
      $s .= '<tr class="tparr">';

      for ($i=0; $i<sizeof($zheaderarray); $i++)
        $s .= "	<th>{$zheaderarray[$i]}</th>\n";

      $s .= "\n</TR>";
    }

    for ($i=0; $i<sizeof($arr); $i++) {
      $s .= '<tr class="tparr">';
      $a = &$arr[$i];
      if (is_array($a))
        for ($j=0; $j<sizeof($a); $j++) {
          $val = $a[$j];
          if (empty($val)) $val = '&nbsp;';
          $s .= "	<td>$val</td>\n";
        }
      else if ($a) {
        $s .=  '	<td>'.$a."</td>\n";
      } else $s .= "	<td>&nbsp;</td>\n";
      $s .= "\n</tr>\n";
    }
    $s .= '</table>';
    print $s;
  }
?>

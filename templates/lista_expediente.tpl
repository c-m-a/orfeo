<html>
  <head>
    <title>.: Expedientes :.</title>
  <link rel="stylesheet" href="{$ORFEO_URL}estilos/orfeo.css">
  <script>
    function regresar(){
      window.location.reload();
      window.close();
    }

    function verTipoExpediente(numeroExpediente,codserie,tsub,tdoc,opcionExp) {
      window.open({$TIPIFICAR_EXPEDIENTE});
    }

    function verHistExpediente(numeroExpediente,codserie,tsub,tdoc,opcionExp) {
      window.open({$HISTORICO_EXPEDIENTE});
    }
    
    function crearProc(numeroExpediente){
      window.open({$CREAR_PROCESO});
    }
    
    function seguridadExp(numeroExpediente,nivelExp){
      window.open({$SEGURIDAD_EXPEDIENTE});
    }
    
    function verTipoExpedienteOld(numeroExpediente) {
      window.open({$VER_TIPO_EXPEDIENTE});
    }
    
    function modFlujo(numeroExpediente,texp,codigoFldExp) {
      window.open({$MODIFICAR_FLUJO});
    }

    function Responsable(numeroExpediente) {
      window.open({$ENLACE_RESPONSABLE});
    }

    function CambiarE(est,numeroExpediente) {
      window.open({$CAMBIAR_EXPEDIENTE});
    }

    function insertarExpediente() {
      window.open({$INSERT_EXPEDIENTE});
    }
    
    function crearExpediente() {
      numExpediente = document.getElementById('num_expediente').value;
      numExpedienteDep = document.getElementById('num_expediente').value.substr(4,3);
      if(numExpedienteDep==<?=$dependencia?>) {
        if(numExpediente.length==13) {
          insertarExpedienteVal = true;
        }else {
          alert("Error. El numero de digitos debe ser de 13.");
          insertarExpedienteVal = false;
        }
      } else {
        alert("Error. Para crear un expediente solo lo podra realizar con el codigo de su dependencia. ");
        insertarExpedienteVal = false;
      }

      if(insertarExpedienteVal == true) {
        respuesta = confirm("Esta apunto de crear el EXPEDIENTE No. " + numExpediente + " Esta Seguro ? ");
        insertarExpedienteVal = respuesta;
      
        if(insertarExpedienteVal == true) {
          dv = digitoControl(numExpediente);
          document.getElementById('num_expediente').value = document.getElementById('num_expediente').value + "E" + dv;
          document.getElementById('funExpediente').value = "CREAR_EXP"
          document.form2.submit();
        }
      }
    }
  </script>

  <script language="javascript">
    var varOrden = 'ASC';
    
    function ordenarPor( campo ) {
      if ( document.getElementById('orden').value == 'ASC' ) {
        varOrden = 'DESC';
      } else {
        varOrden = 'ASC';   
      }
      document.getElementById('orden').value = varOrden;
      document.getElementById('ordenarPor').value = campo + ' ' + varOrden;
      document.form2.submit();
    }

    var i = 1;
    var numRadicado;
    
    function cambiarImagen(imagen) {
      numRadicado = imagen.substr( 13 );
      if ( i == 1 ) {
        document.getElementById( 'anexosRadicado' ).value = numRadicado;
        i = 2;
      } else {
        document.getElementById( 'anexosRadicado' ).value = "";
        i = 1;
      }

      document.form2.submit();
    }

    function excluirExpediente() {
      window.open({$EXCLUIR_EXPEDIENTE});
    }

    // Incluir Anexos y Asociados a un Expediente.
    function incluirDocumentosExp() {
      var strRadSeleccionados = "";
      frm = document.form2;
      if( typeof frm.check_uno.length != "undefined" ) {
          for( i = 0; i < frm.check_uno.length; i++ ) {
              if( frm.check_uno[i].checked ) {
                  if( strRadSeleccionados == "" ) {
                      coma = "";
                  }
                  else {
                      coma = ",";
                  }
                  strRadSeleccionados += coma + frm.check_uno[i].value;
              }
          }
      } else {
          if( frm.check_uno.checked ) {
              strRadSeleccionados = frm.check_uno.value;
          }
      }

      if (strRadSeleccionados != "" ) {
        window.open({$INCLUIR_DOCS});
      } else {
        alert( "Error. Debe seleccionar por lo menos un \n\r documento a incluir en el expediente." );
        return false;
      }
    }

    // Crear Subexpediente
    function incluirSubexpediente( numeroExpediente, numeroRadicado ) {
      window.open({$INCLUIR_SUBEXP});
    }

  </script>
</head>
<body bgcolor="#FFFFFF" topmargin="0">
  <input type="hidden" name="ordenarPor" id="ordenarPor" value="">
  <input type="hidden" name="orden" id="orden" value="{$ORDEN}">
  <input type="hidden" name="verAnexos" id="verAnexos" value="">
  <input type="hidden" name="anexosRadicado" id="anexosRadicado" value="">

  {if $MOSTRAR_BORRADOS eq true}
		<input type="hidden" name="verBorrados" id="verBorrados" value="{$ANEXOS_RADICADOS}">
	{/if}
  <script>
    function digitoControl(cadena) {
      var cifras = new Array(71,67,59,53,47,43,41,37,29,23,19,17,13,7,3);
      var chequeo = 0;
      digito = cadena;
      digitosFalta =  15 - digito.length;

      for (var i=14; i >= 0; i--)
        chequeo += digito.charAt(i - digitosFalta) * cifras[i];

      chequeo = 11 - (chequeo % 11);
      
      if (chequeo == 11)
        chequeo = 0;
      
      if (chequeo == 10) 
        chequeo = 1;
      
      return chequeo;
    }
  </script>
	
  {if $MOSTRAR_DOCS}
  <input type="hidden" name="menu_ver_tmp" value="4">
  <input type="hidden" name="menu_ver" value="4">
  <table  cellspacing="5" width="98%" align="center" class="borde_tab">
    <tr>
      <td class="titulos5">
        <span class="leidos"> DOCUMENTO {$NOMBRE_DERI} <b>{$RADI_NUME_DERI}</b></span>
      </td>
    </tr>
  </table>
  <table border="0" width="98%" cellspacing="4" class="borde_tab" align="center">
  <!-- foreach -->
	<tr class="leidos2">
    <td class="listado5">
      <span class="leidos2">{$ref_radicado}</span>
	  </td>
	  <td class="listado5">
      <span class="leidos2">Fecha Rad:
	      <a href="{$ver_radicado}">{$fechaRadicadoPadre}</a>
      </span>
    </td>
    <td class="listado5">
      <span class="leidos2">Asunto:{$raAsunAnexo}</span>
    </td>
    <td class="listado5">
      <span class="leidos2">Ref:{$cuentaIAnexo}</span>
    </td>
  </tr>
  <!-- //foreach -->
</table>
	{/if}
<table border="0" width="98%" class="borde_tab" align="center" class="titulos2">
  <tr class="titulos2">
  {if $MOSTRAR_INSERTAR_EXP}
    <td align="left">
    <a href="#" onClick="insertarExpediente();" ><span class="leidos2"><b> INCLUIR EN</b></span></a>
  
      <?php
  {if $PERMISO_EXPEDIENTE}
    <a href="#" onClick="verTipoExpediente('<?=$num_expediente?>','<?=$codserie?>','<?=$tsub?>','<?=$tdoc?>','MODIFICAR')" >
    <span class="leidos"><b>CREAR</b></span></a>
		{$MOSTRAR_ALERTA}
	{else}
?>
    <td align="center" class="titulos2">
      <span class="titulos2" align="center">
        <b>ESTE DOCUMENTO SE ENCUENTRA INCLUIDO EN EL(LOS) SIGUIENTE(S) EXPEDIENTE(S).</b>
      </span>
    </td>
    <td align="center">
    </td>
    <td align="center" nowrap>
    <a href="#" onClick="insertarExpediente();" ><span class="leidos2"><b>INCLUIR EN</b></span></a>
      <br>
      <br>
      <a href="#" onClick="excluirExpediente();" ><span class="leidos2"><b>EXCLUIR DE</b></span></a>
      <br>
      <br>
	<!-- $usuaPermExpediente >= 1 -->
	<a href="#" onClick="verTipoExpediente('<?=$num_expediente?>',<?=$codserie?>,<?=$tsub?>,<?=$tdoc?>,'MODIFICAR')" >
	<span class="leidos"><b>CREAR</b></span></a>
  <!-- $usuaPermExpediente -->
  </td>
  {/if}
  {/if}
  </tr>
</table>

<table border="0" width="98%" class='borde_tab' align="center" cellspacing=1 >
<tr>
  <td class="listado5" colspan="6">
<?php
	if ( $num_expediente != "" && !isset( $expIncluido ) ) {
    ?>
    Nombre de Expediente
    <input name="num_expediente" type="text" size="30" maxlength="18" id="num_expediente" value="{$NUM_EXPEDIENTE}" class="tex_area" "{$DATOSS}">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Responsable: &nbsp;&nbsp;&nbsp;<b><span class=leidos2>
    {$RESPONSABLE}</b> &nbsp;&nbsp;&nbsp;
	<?
		if($krdperm==2){
			echo "<input type=\"button\" value=\"Cambiar\" class=\"botones_3\" onClick=\"Responsable('$NUM_EXPEDIENTE')\">";
			if ($arch!=2 && $mostar){
			?>
			<input type="button" class="botones_mediano2" value="Cerrar Expediente" onClick=" CambiarE(2,'<?=$num_expediente?>') ">
		<?
		}
		elseif($mostrar){
		?>
			<input type="button" class="botones_mediano2" value="Reabrir Expediente" onClick=" CambiarE(1,'<?=$num_expediente?>')">
		<?
		}
		}
	}
	else if ( isset( $expIncluido ) && $expIncluido != "" ) {
    ?>
    Nombre de Expediente
    <?php
    ?>
    <input name="num_expediente" type="text" size="30" maxlength="18" id='num_expediente' value="<? print $expIncluido; ?>" class="tex_area" '<?=$datoss?>'>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Responsable: &nbsp;&nbsp;&nbsp; <b> <span class=leidos2>
    <? echo $responsable;?></b> &nbsp;&nbsp;&nbsp;
<?
	if($krdperm==2){
	?>
<input type="button" value="Cambiar" class=botones_3 onClick="Responsable('<?=$num_expediente?>')">
<br>
<!-- if($mostrar) -->
			<input type="button" class="botones_mediano" value="Cerrar Expediente" onClick=" CambiarE(2,'<?=$num_expediente?>') ">
<1-- end if -->
  <?
  if ($arch==2 && $mostar){
  ?>
  <input type="button" class="botones_mediano" value="Reabrir Expediente" onClick=" CambiarE(1,'<?=$num_expediente?>')">
    <?php
	}
    }
    } else {
    ?>
    <input name="num_expediente" type="hidden" id='num_expediente' value="">
    <?php
    }
  ?>
    <input type="hidden" name='funExpediente' id='funExpediente' value="" >
    <input type="hidden" name='menu_ver_tmp' id='menu_ver_tmp' value="4" >
	<a href="#" onClick="insertarExpediente();" ><span class="leidos"><b>Incluir en</b></span></a> &nbsp;
	  <!-- if($usuaPermExpediente >=1) -->
	  ?>
	  <a href="#" onClick="verTipoExpediente('<?=$num_expediente?>',<?=$codserie?>,<?=$tsub?>,<?=$tdoc?>,'MODIFICAR')" >
		  <span class="leidos"><b>Crear</b></span>
	  </a>
	  <?
	  <!-- else -->
	  <!-- if(!$codserie and !$tsub) -->
	    <a href="#" onClick="verTipoExpedienteOld('<?=$num_expediente?>')" ><span class="leidos"><b>Tipificar Expediente</b></span></a>
	  <?
    <!-- if -->
	//<input type="button" name="ASOC_EXP" value="Asociar Anexos a Este Expediente" class="botones_largo" >
	<!-- else end -->
<!-- if -->
	<br>{$mensaje}<br>";
</td>
</tr>
<tr class="listado5">
<td class="listado5" width="42%" colspan="2">
<!-- if($descPExpediente) -->
	$expediente->consultaTipoExpediente($num_expediente);
&nbsp;&nbsp;&nbsp;&nbsp;Estado :<span class=leidos2> <?=$descFldExp?></span>&nbsp;&nbsp;&nbsp;
<input type="button" value="..." class=botones_2 onClick="modFlujo('<?=$num_expediente?>',<?=$texp?>,<?=$codigoFldExp?>)"></td>
<!-- if end -->
<!-- if($num_expediente !="") -->
     <td colspan="2">Historia del Expediente :<span class=leidos2> </span>&nbsp;&nbsp;&nbsp;
	 <input type="button" value="..." class=botones_2 onClick="verHistExpediente('<?=$num_expediente?>');">
	 </td>
  <td  nowrap>Adicionar Proceso :<span class=leidos2> </span>&nbsp;&nbsp;&nbsp;
    <input type="button" value="..." class=botones_2 onClick="crearProc('<?=$num_expediente?>');">
  </td>
<td  nowrap>Seguridad Exp (<?=$nivelExp?>) :<span class=leidos2> </span>&nbsp;&nbsp;&nbsp;
    <input type="button" value="..." class=botones_2 onClick="seguridadExp('<?=$num_expediente?>','<?=$nivelExp?>');">
  </td>
	<td>&nbsp;</td>	
</tr>
<tr>
  <td class='titulos5'>
    TRD:
  </td>
  <td class='leidos2'>
    <?php print $arrTRDExp['serie']." / ".$arrTRDExp['subserie']; ?>
  </td>
  <td colspan="3"></td>
  <td rowspan="3">
    <table width="100%" border="0" height="200%" cellspacing=1>
		<!-- foreach( $arrDatosParametro as $clave => $datos ) -->
      <tr rowspan="4"   class="leidos2">
        <td colspan="2" class="titulos5"><? print $datos['etiqueta']; ?>:</td>
        <td colspan="2" ><? print $datos['parametro']; ?></td>
      </tr>
    </table>
  </td>
</tr>
<tr >
  <td class="titulos5">
    Proceso:
  </td>
  <td colspan="4" class='leidos2'>
  </td>
</tr>
<tr >
  <td class="titulos5" nowrap>
    Fecha Inicio:
  </td>
  <td colspan="4" class='leidos2'>
    $arrTRDExp['fecha']
  </td>
</tr>

<tr class='timparr'>
<td colspan="6" class="titulos5">
  <p>Documentos Pertenecientes al expediente &nbsp;</p>
<?php
      /*
       *  Modificado: 23-Agosto-2006 Supersolidaria
       *  Bot�n para ver y ocultar los anexos borrados de un radicado cuando se ingresa.
       *  a la pesta�a EXPEDIENTES.
       */
        print "<p>";
        // Modificado Infom�trika 23-Julio-2009
        // Ajuste para adaptarse al cambio de m�todo (de POST a GET) en el script verradicado.php
        if( !isset( $verBorrados ) ) {
        ?>
        Ver Borrados:&nbsp;
        <?php
        } else {
        ?>
        Ocultar Borrados:&nbsp;
        <?php
        }
        print '<input type="button" name="btnVerBorrados" value="..." class="botones_2" onclick="document.form2.submit();">';
        print '</p>';
        $enlace_descarga = './descargar_archivos_expediente.php?' .
                            'numero_expediente=' . $numExpediente;
      ?>
        <p>
          <center>
            <a href="<?=$enlace_descarga?>">
              <span class="leidos">
                DESCARGAR TODOS LOS DOCUMENTOS DEL EXPEDIENTE EN UN ARCHIVO COMPRIMIDO
              </span>
            </a>
          </center>
        </p>
        <table border=0 width=98% class="borde_tab" align="center" cellpadding="0" cellspacing="0">
<?

}
    // Modificado Infom�trika 23-Julio-2009
    // Ajuste para adaptarse al cambio de m�todo (de POST a GET) en el script verradicado.php
    //if ( $num_expediente != "" && !isset( $_POST['expIncluido'][0] ) ) {
    if ( $num_expediente != "" && !isset( $expIncluido ) ) {
        $expedienteSeleccionado = $num_expediente;
    }
    // Modificado Infom�trika 23-Julio-2009
    // Ajuste para adaptarse al cambio de m�todo (de POST a GET) en el script verradicado.php
    //else if ( isset( $_POST['expIncluido'][0] ) && $_POST['expIncluido'][0] != "" ) {
    else if ( isset( $expIncluido ) && $expIncluido != "" ) {
	// Modificado Infom�trika 23-Julio-2009
	// Ajuste para adaptarse al cambio de m�todo (de POST a GET) en el script verradicado.php
        //$expedienteSeleccionado = $_POST['expIncluido'][0];
        $expedienteSeleccionado = $expIncluido;
    }

  // if( $num_expediente )
if($expedienteSeleccionado) {
	include_once($ruta_raiz.'/include/query/queryver_datosrad.php');
	$fecha = $db->conn->SQLDate("d-m-Y H:i A","a.RADI_FECH_RADI");

    // Modificacion: 14-Junio-2006 Supersolidaria Opcion para ordenar los registros
	$isql = "select ";
  if($driver=="oci8") {
		$isql .= " /*+ all_rows */ ";
	}
  
  // Modificado Carlos Barrero - Supersolidaria
	$isql = "SELECT R.*,
                  c.sgd_tpr_descrip,
                  " . $fecha . "as FECHA_RAD ,
                  a.RADI_CUENTAI,
                  a.RA_ASUN,
                  a.RADI_PATH,
                  a.SGD_SPUB_CODIGO,
                  a.*,
                  PRC.SGD_PRC_DESCRIP,
                  PRD.SGD_PRD_DESCRIP
              FROM RADICADO a,
                    SGD_TPR_TPDCUMENTO c,
                    SGD_EXP_EXPEDIENTE r
                  LEFT JOIN SGD_PRD_PRCDMENTOS PRD ON PRD.SGD_PRD_CODIGO = r.SGD_PRD_CODIGO
                  LEFT JOIN SGD_PRC_PROCESO PRC ON PRC.SGD_PRC_CODIGO = PRD.SGD_PRC_CODIGO
              WHERE
                  /*r.sgd_exp_numero='$num_expediente'*/
                  r.sgd_exp_numero='$expedienteSeleccionado' and
                  r.radi_nume_radi=a.radi_nume_radi and
                  a.tdoc_codi=c.sgd_tpr_codigo AND
                  r.SGD_EXP_ESTADO <> 2
                  /*order by TO_CHAR(a.RADI_FECH_RADI, 'YYYY-MM-DD HH24:MI AM') desc*/";

    // Modificado Infometrika 23-Julio-2009
    // Ajuste para adaptarse al cambio de m�todo (de POST a GET) en el script verradicado.php
    //if( $_POST['ordenarPor'] != "" ) {
    if( $ordenarPor != "" ) {
        //$isql .= "ORDER BY ".$_POST['ordenarPor'];
    }
    else {
        //$isql .= " order by $fecha desc";
    }
 $isql .= " order by a.radi_fech_radi desc";
  ?>
  <!--
  <tr class="titulos5" >
  -->
  <tr class="listado5" >
    <td>&nbsp;</td>
    <td align="center">
      <a href="#" onClick="javascript:ordenarPor( 'a.RADI_NUME_RADI' );">
      Radicado
      </a>
    </td>
  <td align="center">
    <a href="#" onClick="javascript:ordenarPor( 'a.RADI_FECH_RADI' );">
	Fecha Radicaci&oacute;n / Doc
    </a>
	</td>
	<TD align="center">
      <a href="#" onClick="javascript:ordenarPor( 'c.SGD_TPR_DESCRIP' );">
      Tipo<br> Documento
      </a>
    </TD>
    <!--
  <TD align="center">
		Cuenta<br>Interna
	</TD>
    -->
	<TD align="center">
      <a href="#" onClick="javascript:ordenarPor( 'a.RA_ASUN' );">
      Asunto
      </a>
    </TD>
    <TD align="center">
      <a href="#" onClick="javascript:ordenarPor( 'r.SGD_EXP_SUBEXPEDIENTE' );">
      Subexpediente
      </a>
	</TD>
	</tr>
<?php
$rs = $db->conn->query($isql);
$i = 0;
while(!$rs->EOF) {
	$radicado_d     = "";
	$radicado_path  = "";
	$radicado_fech  = "";
	$radi_cuentai   = "";
	$rad_asun       = "";
	$tipo_documento_desc = "";
	$radicado_d     = $rs->fields["RADI_NUME_RADI"];
	$radicado_path  = $rs->fields["RADI_PATH"];
	$radicado_fech  = $rs->fields["FECHA_RAD"];
	$radi_cuentai   = $rs->fields["RADI_CUENTAI"];
	$rad_asun       = $rs->fields["RA_ASUN"];
	$tipo_documento_desc = $rs->fields["SGD_TPR_DESCRIP"];
//	$subexpediente = $rs->fields["SGD_EXP_SUBEXPEDIENTE"];
	$subexpediente  = $rs->fields["SGD_PRC_DESCRIP"]."/".$rs->fields["SGD_PRD_DESCRIP"];
	$seguridadRadicado = $rs->fields["SGD_SPUB_CODIGO"];
	$usu_cod        = $rs->fields["RADI_USUA_ACTU"];
	$radi_depe      = $rs->fields["RADI_DEPE_ACTU"];
	$nivelRadicado  = $rs->fields["CODI_NIVEL"];
  $isqlSExp       = "select *
                        from sgd_exp_expediente 
                        where radi_nume_radi=$radicado_d and
                              sgd_exp_numero <> '$num_expediente'";
  $rsSExp = $db->conn->query($isqlSExp);
  $sExp = "";
  while(!$rsSExp->EOF){
    $sExp .= $rsSExp->fields["SGD_EXP_NUMERO"].  "<br>";
    $rsSExp->MoveNext();
  }
	
	$verImg = ($seguridadRadicado==1)?
              (($usu_cod!=$_SESSION['codusuario'] || $radi_depe!=$_SESSION['dependencia'])? false:true):($nivelRadicado >$nivelus?false:true);
	
  if($verImg <= 9999999999999999999999999) {
    $arreglo_explode = explode('/', $radicado_path);
    
    foreach ($arreglo_explode as $value) 
      $nombre_archivo = (preg_match('/.+\.[a-z]+$/',$value, $rs_nombre))? $rs_nombre[0] : null;
      $ano_creacion = substr($nombre_archivo, 0, 4);
      $dependencia_radicadora = substr($nombre_archivo, 4, 3);
      
      $enlace_descarga = $ruta_raiz . '/descargar_archivo.php?' .
                          'ruta_archivo=/' . $ano_creacion .
                          '/' . $dependencia_radicadora .
                          '/' . $nombre_archivo .
                          '&nombre_archivo=' . $nombre_archivo;
      $ref_radicado = "<a href='$enlace_descarga'><span class=leidos>$radicado_d</span></a>";
		$radicado_fech = "<a href='$ruta_raiz/verradicado.php?verrad=$radicado_d&PHPSESSID=".session_id()."&krd=$krd&carpeta=8&nomcarpeta=Busquedas&tipo_carp=0&menu_ver_tmp=3' target=".$radicado_fech."><span class=leidos>$radicado_fech</span></a>";
	}else{
			$ref_radicado = "$radicado_d";
			$radicado_fech = "<a href='#' onclick=\"alert('El documento posee seguridad y no posee los suficientes permisos'); return false;\"><span class=leidos>$radicado_fech</span></a>";
	}
?>
<tr class='tpar'>
  <td valign="baseline" class='listado1'>
<?php
  // Modificado Infometrika 23-Julio-2009
  // Ajuste para adaptarse al cambio de m�todo (de POST a GET) en el script verradicado.php
  //if( !isset( $_POST['verBorrados'] ) )
  if (!isset($verBorrados)) {
	// Modificado Infom�trika 23-Julio-2009
	// Ajuste para adaptarse al cambio de m�todo (de POST a GET) en el script verradicado.php
    //if( ( $_POST['anexosRadicado'] != $radicado_d ) )
    if( ( $anexosRadicado != $radicado_d ) )
    {
  ?>
        <!--
        /*
         *  Modificado: 23-Agosto-2006 Supersolidaria
         *  Muestra todos los anexos de un radicado.
         */
         -->
        <!--
        <a href="#t1" onMouseDown="cambiarImagen( 'imgVerAnexos_<?php print $radicado_d; ?>' );">
        -->
          <img name="imgVerAnexos_<?php print $radicado_d; ?>" src="imagenes/menu.gif" border="0">
        <!--
        </a>
        -->
  <?php
    }
    // Modificado Infom�trika 23-Julio-2009
    // Ajuste para adaptarse al cambio de m�todo (de POST a GET) en el script verradicado.php
    //else if( ( $_POST['anexosRadicado'] == $radicado_d ) )
    else if( ( $anexosRadicado == $radicado_d ) )
    {
  ?>
        <!--
        <a href="#t1">
        -->

          <img name="imgVerAnexos_<?php print $radicado_d; ?>" src="imagenes/menuraya.gif" border="0">
        <!--
        </a>
        -->
  <?php
    }
  }
  // Modificado Infom�trika 23-Julio-2009
  // Ajuste para adaptarse al cambio de m�todo (de POST a GET) en el script verradicado.php
  //if( isset( $_POST['verBorrados'] ) )
  if( isset( $verBorrados ) )
  {
    // Modificado Infom�trika 23-Julio-2009
    // Ajuste para adaptarse al cambio de m�todo (de POST a GET) en el script verradicado.php
    //if( ( $_POST['verBorrados'] == $radicado_d ) )
    if( ( $verBorrados == $radicado_d ) )
    {
  ?>
        <!--
        <a href="#t1">
        -->
          <img name="imgVerAnexos_<?php print $radicado_d; ?>" src="imagenes/menuraya.gif" border="0">
        <!--
        </a>
        -->
  <?php
    }
    // Modificado Infom�trika 23-Julio-2009
    // Ajuste para adaptarse al cambio de m�todo (de POST a GET) en el script verradicado.php
    //else if( ( $_POST['verBorrados'] != $radicado_d ) )
    else if( ( $verBorrados != $radicado_d ) )
    {
  ?>
        <!--
        <a href="#t1" onMouseDown="cambiarImagen( 'imgVerAnexos_<?php print $radicado_d; ?>' );">
        -->
          <img name="imgVerAnexos_<?php print $radicado_d; ?>" src="imagenes/menu.gif" border="0">
        <!--
        </a>
        -->
  <?php
    }
  }
  ?>
  </td>
  <td valign="baseline" class='listado1'>
    <span class="leidos"><?=$ref_radicado ?></span>
  </td>
<td valign="baseline" class='listado1' align="center" width="100"><span class="leidos2"><?=$radicado_fech ?></span></td>
<TD valign="baseline" class='listado1' ><span class="leidos2"><?=$tipo_documento_desc ?></span></TD>
<!--
<TD valign="baseline" class='listado1'><span class="leidos"><?=$radi_cuentai ?></span></TD>
-->
<TD valign="baseline" class='listado1'><span class="leidos2"><?=$rad_asun ?></span></TD>
<td valign="baseline" class='listado1'>
<?
 if( $usuaPermExpediente and $verradPermisos == "Full" ) {
?>
<a href="#" onClick="incluirSubexpediente( '<?php print $numExpediente; ?>', <?php print $radicado_d; ?> );">
    <span class="leidos2"> 
    <?php
    
   }
      echo $sExp;
    	if( $subexpediente != "/" ) {
       	 // print $subexpediente;
    	}	else {
        	// print "Sin";
      }
?>
    </span>
  </a>
</td>
</tr>
<?php
	/**
	  *   Carga los anexos del radicado indicado en la variable $radicado_d
		*   incluye la clase anexo.php
		**/
	include_once "$ruta_raiz/class_control/anexo.php";
	include_once "$ruta_raiz/class_control/TipoDocumento.php";
	$a = new Anexo($db->conn);
	$tp_doc = new TipoDocumento($db->conn);
    // Modificacion: 15-Julio-2006 Mostrar los anexos del radicado seleccionado.
    /*
     *  Modificado: 23-Agosto-2006 Supersolidaria
     *  Muestra todos los anexos de un radicado al ingresar a la pestana de EXPEDIENTES.
     */
    $num_anexos = $a->anexosRadicado($radicado_d);
    $anexos_radicado=$a->anexos;
    /*
     *  Modificado: 23-Agosto-2006 Supersolidaria
     *  Muestra los anexos borrados de un radicado al ingresar a la pestana de EXPEDIENTES.
     */
     // Modificado Infom�trika 23-Julio-2009
     // Ajuste para adaptarse al cambio de m�todo (de POST a GET) en el script verradicado.php
    //if( isset( $_POST['verBorrados'] ) )
    if(isset($verBorrados)) {
        $num_anexos = $a->anexosRadicado( $radicado_d, true );
    }
	if($num_anexos>=1) {
	for($iia=0;$iia<=$num_anexos;$iia++) {

	$codigo_anexo = $a->codi_anexos[$iia];
	if($codigo_anexo and substr($anexDirTipo,0,1)!='7') {
		$tipo_documento_desc  = "";
		$fechaDocumento       = "";
		$anex_desc            = "";
		$a->anexoRadicado($radicado_d,$codigo_anexo);
		$secuenciaDocto       = $a->get_doc_secuencia_formato($dependencia);
		$fechaDocumento       = $a->get_sgd_fech_doc();
		$anex_nomb_archivo    = $a->get_anex_nomb_archivo();
		$anex_desc            = $a->get_anex_desc();
		$dependencia_creadora = substr($codigo_anexo,4,3);
		$ano_creado= substr($codigo_anexo,0,4);
		$sgd_tpr_codigo       = $a->get_sgd_tpr_codigo();
		// Trae la descripcion del tipo de Documento del anexo

		if($sgd_tpr_codigo) {
		  //$tp_doc = new TipoDocumento($db->conn);
		  $tp_doc->TipoDocumento_codigo($sgd_tpr_codigo);
		  $tipo_documento_desc = $tp_doc->get_sgd_tpr_descrip();
		}
	$anexBorrado = $a->anex_borrado;
	$anexSalida = $a->get_radi_anex_salida();
	$ext = substr($anex_nomb_archivo,-3);

	if(trim($anex_nomb_archivo) or $anexSalida!=1 or $ii) {
	?>
	<tr  class='timpar'>
      <td valign="baseline" class='listado5'>&nbsp;</td>
  <td valign="baseline"  class='listado5'>
  <?php
  if($anexBorrado == 'S') {
  ?>
    <img src="iconos/docs_tree_del.gif">
  <?php
  }
  elseif($anexBorrado == 'N') {
  ?>
    <img src="iconos/docs_tree.gif">
  <?php
  }
  $rut = "bodega";
  $enlace_descarga = $ruta_raiz . '/descargar_archivo.php?' .
                    'ruta_archivo=/' . $ano_creado .
                                  '/' . $dependencia_creadora .
                                  '/docs/' . $anex_nomb_archivo .
                                  '&nombre_archivo='. $anex_nomb_archivo .
                                  '&from=expediente';
	echo "<a href='$enlace_descarga'>" . substr($codigo_anexo,-4)."</a>";
  ?>
  <!--<a href='<?=$rut."/".$ano_creado."/$dependencia_creadora/docs/$anex_nomb_archivo"?>'>
	  <?=substr($codigo_anexo,-4).""?> 
	</a>-->
  </td>
  <td valign="baseline" class='listado5'><?=$fechaDocumento ?></td>
  <td valign="baseline" class='listado5'><?=$tipo_documento_desc ?></TD>
  <TD valign="baseline" class='listado5'><span class='leidos2'><?=substr($anex_desc,0,30)?></span></td>
  <TD valign="baseline" class='leidos2'><?=$otroExpediente ?></TD>
  <TD valign="baseline"  class='listado5'></TD>
  </tr>
<?php
   	} // Fin del if que busca si hay link de archivo para mostrar o no el doc anexo
	}
}  // Fin del For que recorre la matriz de los anexos de cada radicado perteneciente al expediente
}
	 
	 $rs->MoveNext();
	}
} // Fin del While que Recorre los documentos de un expediente.
?>
</table>
  </td>
</tr>
<tr>
  <td class="titulosError" colspan="6" align="center">
    Nota.  En el momento de Grabar el expediente este aparecera en la pantalla de archivo para su re-ubicacion fisica. (Si no esta seguro de esto por favor no lo realice)
  </td>
</tr>
</table>
<p>
<table width="98%" class='borde_tab' cellspacing="0" cellpadding="0" align="center" id="tblAnexoAsociado">
  <tr>
    <td class="titulos5">Y ESTA RELACIONADO CON EL(LOS) SIGUIENTE(S) DOCUMENTOS:</td>
    <td class="titulos5" align="center">
<?php
  if( $usuaPermExpediente and $verradPermisos == "Full" or $dependencia=='999') {
?>
      <a href="#tblAnexoAsociado" onClick="incluirDocumentosExp();" >
        <span class="leidos2"><b>INCLUIR DOCUMENTOS EN EXPEDIENTE</b></span>
      </a>
<?
}
?>
  </td>
  </tr>
</table>
<span class="tituloListado"> </span>
<table border=0 width=98% class="borde_tab" align="center">
  <tr class='titulos5'>
    <td class="titulos5">
	  <input type="checkbox" name="check_todos" value="checkbox" onClick="todos( document.forms[1] );">
	</td>
    <td align="center">RADICADO</td>
    <td align="center">FECHA RADICACION</td>
    <td align="center">TIPO DOCUMENTO</td>
    <td align="center">ASUNTO</td>
    <td align="center">TIPO DE RELACION</td>
  </tr>
  <?php
    $arrAnexoAsociado = $expediente->expedienteAnexoAsociado( $verrad );

    if(is_array($arrAnexoAsociado)) {
        /*
         *  Modificado: 29-Agosto-2006 Supersolidaria
         *  Consulta los datos de los radicados Anexo de (Padre), Anexo y Asociado.
         */
        include_once "$ruta_raiz/include/tx/Radicacion.php";
        $rad = new Radicacion( $db );

        foreach( $arrAnexoAsociado as $clave => $datosAnexoAsociado ) {
            if( $datosAnexoAsociado['radPadre'] != "" && $datosAnexoAsociado['radPadre'] != $verrad && $datosAnexoAsociado['anexo'] == $verrad ) {
                $arrDatosRad = $rad->getDatosRad( $datosAnexoAsociado['radPadre'] );
                if($arrDatosRad['ruta'] != "") {
		    if(substr($datosAnexoAsociado['radPadre'],0,4)=='2007')$rut="bodega2007/";
		    elseif(substr($datosAnexoAsociado['radPadre'],0,4)=='2008')$rut="bodega2008/";
		    else $rut="bodega/";
                    $rutaRadicado = "<a href='".$rut.$arrDatosRad['ruta']."' >".$datosAnexoAsociado['radPadre']."</a>";
                }
                else
                {
                    $rutaRadicado = $datosAnexoAsociado['radPadre'];
                }
                $radicadoAnexo = $datosAnexoAsociado['radPadre'];
                $tipoRelacion = "ANEXO DE (PADRE)";
            }
            else if( $datosAnexoAsociado['radPadre'] == $verrad && $datosAnexoAsociado['anexo'] != "" ) {
                $arrDatosRad = $rad->getDatosRad( $datosAnexoAsociado['anexo'] );
                if( $arrDatosRad['ruta'] != "" )
                {
		    if(substr($datosAnexoAsociado['radPadre'],0,4)=='2007')$rut="bodega2007/";
		    elseif(substr($datosAnexoAsociado['radPadre'],0,4)=='2008')$rut="bodega2008/";
		    else $rut="bodega/";
                    $rutaRadicado = "<a href='".$rut.$arrDatosRad['ruta']."' >".$datosAnexoAsociado['anexo']."</a>";
                }
                else
                {
                    $rutaRadicado = $datosAnexoAsociado['anexo'];
                }
                $radicadoAnexo = $datosAnexoAsociado['anexo'];
                $tipoRelacion = "ANEXO";
            }
            else if( $datosAnexoAsociado['radPadre'] == $verrad && $datosAnexoAsociado['asociado'] != "" )
            {
                $arrDatosRad = $rad->getDatosRad( $datosAnexoAsociado['asociado'] );
                if( $arrDatosRad['ruta'] != "" )
                {
		    if(substr($datosAnexoAsociado['radPadre'],0,4)=='2007')$rut="bodega2007/";
		    elseif(substr($datosAnexoAsociado['radPadre'],0,4)=='2008')$rut="bodega2008/";
		    else $rut="bodega/";
                    $rutaRadicado = "<a href='".$rut.$arrDatosRad['ruta']."' >".$datosAnexoAsociado['asociado']."</a>";
                }
                else
                {
                    $rutaRadicado = $datosAnexoAsociado['asociado'];
                }
                $radicadoAnexo = $datosAnexoAsociado['asociado'];
                $tipoRelacion = "ASOCIADO";
            }
  ?>
  <tr class='listado5'>
    <td>
	  <input type="checkbox" name="check_uno" value="<?php print $radicadoAnexo; ?>" onClick="uno( document.forms[1] );">
	</td>
    <td>
      <?php
        print $rutaRadicado;
      ?>
    </td>
    <td>
      <a href='<?=$ruta_raiz?>/verradicado.php?verrad=<?=$radicadoAnexo?>&<?=session_name()?>=<?=session_id()?>&krd=<?=$krd?>' target="VERRAD<?=$radicadoAnexo?>">
        <?php
            print $arrDatosRad['fechaRadicacion'];
        ?>
      </a>
    </td>
    <td>
      <?php
        print $arrDatosRad['tipoDocumento'];
      ?>
    </td>
    <td>
      <?php
        print $arrDatosRad['asunto'];
      ?>
    </td>
    <td>
      <?php
        print $tipoRelacion;
      ?>
    </td>
  </tr>
  <?php
        }
    }
    $time_end = microtime_float();
	$time = $time_end - $time_start;
	echo "<span class='info'>";  
	echo "<br><b>Se demor&oacute;: $time segundos la Operaci&oacute;n total.</b>";
	echo "</span>"; 	
  ?>
</table>
</body>
</html>

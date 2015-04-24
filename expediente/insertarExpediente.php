<?php
session_start();
/** Modulo de Expedientes o Carpetas Virtuales
  * Modificacion Variables
  *@autor Jairo Losada 2009/06
  *Licencia GNU/GPL 
  */
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];
$tpNumRad = $_SESSION["tpNumRad"];
$tpPerRad = $_SESSION["tpPerRad"];
$tpDescRad = $_SESSION["tpDescRad"];
$tip3Nombre = $_SESSION["tip3Nombre"];
$tpDepeRad = $_SESSION["tpDepeRad"];
$usuaPermExpediente = $_SESSION["usuaPermExpediente"];
$ruta_raiz = ".."; 	

if ( !$nurad )
{
    $nurad = $rad;
}

include_once( "$ruta_raiz/include/db/ConnectionHandler.php" );
$db = new ConnectionHandler( "$ruta_raiz" );
//$db->conn->debug = true;
include_once( "$ruta_raiz/include/tx/Historico.php" );
include_once( "$ruta_raiz/include/tx/Expediente.php" );

$encabezado = "$PHP_SELF?".session_name()."=".session_id()."&opcionExp=$opcionExp&numeroExpediente=$numeroExpediente&nurad=$nurad&coddepe=$coddepe&codusua=$codusua&depende=$depende&ent=$ent&tdoc=$tdoc&codiTRDModi=$codiTRDModi&codiTRDEli=$codiTRDEli&codserie=$codserie&tsub=$tsub&ind_ProcAnex=$ind_ProcAnex";
$expediente = new Expediente( $db );

// Inserta el radicado en el expediente
if( $funExpediente == "INSERT_EXP" )
{   
    // Consulta si el radicado est� incluido en el expediente.
    $arrExpedientes = $expediente->expedientesRadicado( $nurad);
    /* Si el radicado esta incluido en el expediente digitado por el usuario.
     * != No identico no se puede poner !== por que la funcion array_search 
     * tambien arroja 0 o "" vacio al ver que un expediente no se encuentra
     */ 
	 $arrExpedientes[] = "1";
    foreach ( $arrExpedientes as $line_num => $line){
    	if ($line == $_POST['numeroExpediente']) {
    		  print '<center><hr><font color="red">El radicado ya est&aacute; incluido en el expediente.</font><hr></center>';
    	}else {
    		  $resultadoExp = $expediente->insertar_expediente( $_POST['numeroExpediente'], $_GET['nurad'], $dependencia, $codusuario, $usua_doc );
        if( $resultadoExp == 1 )
        {
            $observa = "Incluir radicado en Expediente";
            include_once "$ruta_raiz/include/tx/Historico.php";
            $radicados[] = $_GET['nurad'];
            $tipoTx = 53;
            $Historico = new Historico( $db );
            $Historico->insertarHistoricoExp( $_POST['numeroExpediente'], $radicados, $dependencia, $codusuario, $observa, $tipoTx, 0 );
            
            ?>
            <script language="JavaScript">
              opener.regresar();
              window.close();
            </script>  
            <?php
        }
        else
        {
            print '<hr><font color=red>No se anexo este radicado al expediente. Verifique que el numero del expediente exista e intente de nuevo.</font><hr>';	    
        }
    	}
    }
   
      
    
}
?>
<html>
<head>
<title>Incluir en Expediente</title>
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function validarNumExpediente()
{
    numExpediente = document.getElementById( 'numeroExpediente' ).value;
	
    // Valida que se haya digitado el nombre del expediente
    // a�o dependencia serie subserie consecutivo E
    if( numExpediente.length != 0 && numExpediente != "" )
    {
        insertarExpedienteVal = true;
    }
    else if( numExpediente.length == 0 || numExpediente == "" )
    {
        alert( "Error. Debe especificar el nombre de un expediente." );
        document.getElementById( 'numeroExpediente' ).focus();
        insertarExpedienteVal = false;
    }
    
    if( insertarExpedienteVal == true )
	{
        document.insExp.submit();
	}
}

function confirmaIncluir()
{
    document.getElementById( 'funExpediente' ).value = "INSERT_EXP";
    document.insExp.submit();
}

function cambia_Exp(expId, expNo){
	var exp_id = document.getElementById(expId);
	numExp = exp_id.value;
	var exp_no = document.getElementById(expNo);
	exp_no.value = numExp;
	document.insExp.numeroExpediente.focus();
	}
</script>
</head>
<body bgcolor="#FFFFFF" onLoad="document.insExp.numeroExpediente.focus();">

<form method="post" action="<?=$_SERVER['PHP_SELF']?>?nurad=<?=$nurad?>" name="insExpBus">
  <table border=0 width=70% align="center" class="borde_tab" cellspacing="1" cellpadding="0">        
    <tr align="center" class="titulos2">
      <td height="15" class="titulos2" colspan="2">BUSCAR EXPEDIENTE</td>
    </tr>
  </table>
<table width="70%" border="0" cellspacing="1" cellpadding="0" align="center" class="borde_tab">
</table>
<table border=0 width=70% align="center" class="borde_tab">
<form method="post" action="<?=$_SERVER['PHP_SELF']?>?nurad=<?=$nurad?>" name="insExpBus">
<table width="70%" border="0" cellspacing="1" cellpadding="0" align="center" class="borde_tab">
</table>
<table border=0 width=70% align="center" class="borde_tab">
<!--
      <tr align="center">
      <td class="titulos5" align="left" nowrap>
Buscar por: </td>
      <td class="titulos5" align="left">
        <?
    /*
    $dependencia = '210';
    $exp_varcod = "S.SGD_PAREXP_CODIGO";
    $exp_vareti = "S.SGD_PAREXP_ETIQUETA";
    
    $queryBus = "SELECT DISTINCT(SGD_PAREXP_ETIQUETA), S.SGD_PAREXP_CODIGO
          FROM 
          SGD_PAREXP_PARAMEXPEDIENTE S
          WHERE S.DEPE_CODI = '$dependencia'";
          
    $rsBus = $db->conn->query($queryBus);
    include "$ruta_raiz/include/tx/ComentarioTx.php";
    print $rsBus->GetMenu2("exp_cod_Bus", $exp_cod_Bus, "0:-- Seleccione --", false,"","onChange='submit();' class='select'" );
    */
    ?>
      </td>
    </tr>
  -->
  <tr align="center">
  <font face="Arial, Helvetica, sans-serif">
  <td class="listado5" valign="middle">
  <span class="titulos5">Expediente</span> 
  </td>
    <td class="listado5" valign="middle">
  <input type="text" name="criterio" id="criterio" size="30" value="<?=$_POST['criterio']?>" class="tex_area">
    </td>
  </font>
    </tr>
</table>
<table border=0 width=70% align="center" class="borde_tab">
  <tr align="center">
  <td width="33%" height="25" class="listado2">
  <div align="center">
  <input name="btnBuscaExp" type="submit" class="botones" id="btnBuscaExp" value="Buscar">  
  </div>
  </td>
  </tr>
</table>
</form>

<?
//$dependencia = '230';
/************************************************/
/* Ejecucion de los QUERYS respectivos para		*/
/* filtrar los expedientes coincidentes			*/
/************************************************/

$btnBuscaExp = $_POST['btnBuscaExp'];
if($btnBuscaExp){
	$criterio = strtoupper($_POST['criterio']);
	if(!$criterio)
	{
		$criterio="_nada_";
	}
	
	$sql_Fin = "SELECT * FROM SGD_SEXP_SECEXPEDIENTES 
			WHERE SGD_SEXP_PAREXP1 LIKE '%$criterio%' OR SGD_SEXP_PAREXP2 LIKE '%$criterio%' OR SGD_SEXP_PAREXP3 LIKE '%$criterio%'";
	}
else{
	$sql_rad = "SELECT * FROM RADICADO r, BODEGA_EMPRESAS b 
					WHERE b.IDENTIFICADOR_EMPRESA = r.EESP_CODI 
						AND r.RADI_NUME_RADI = '$nurad'";
	$rs_rad = $db->query($sql_rad);

	if(!$rs_rad->EOF){
		$sgd_sexp_parexp1 = $rs_rad->fields['NIT_DE_LA_EMPRESA'];
//		$sgd_sexp_parexp2 = $rs_rad->fields['SIGLA_DE_LA_EMPRESA'];
		if(!$sgd_sexp_parexp1)
		{
			$sgd_sexp_parexp1="_nada_";
		}
		
		$sql_Fin = "SELECT * FROM SGD_SEXP_SECEXPEDIENTES 
			WHERE SGD_SEXP_PAREXP1 LIKE '%$sgd_sexp_parexp1%'"; // OR SGD_SEXP_PAREXP2 LIKE '%$sgd_sexp_parexp2%'";
		}
	}
//echo $sql_Fin;
/*
	$campos = array("NIT" => "SGD_SEXP_PAREXP1",
					"SIGLA" => "SGD_SEXP_PAREXP2",
					"CARPETA" => "SGD_SEXP_PAREXP3"
					);
		
	$sql_pex = "SELECT * FROM SGD_PAREXP_PARAMEXPEDIENTE 
			WHERE DEPE_CODI = '$dependencia' AND SGD_PAREXP_CODIGO = '$exp_cod_Bus'";
					
	$rs_pex = $db->conn->query($sql_pex);
	
	$param = $rs_pex->fields['SGD_PAREXP_ETIQUETA'];
	
	$fieldBus = $campos[$param];
*/
	
	//echo $sql_Fin;
	$rs_Fin = $db->conn->query($sql_Fin);
	?>
	<table border=0 width=100% align="center" class="borde_tab" cellspacing="1" cellpadding="0">        
	<tr align="center" class="listado2">
	<td height="15" colspan="2" align="center">EXPEDIENTES RELACIONADOS</td>
	</tr>
	</table>
	<table border=0 width='100%' align="center" class="borde_tab">
	<tr>
	<td>
	<div class="scroll">
	<table border=0 width='100%' align="center" class="borde_tab">
	<?
	if(!$rs_Fin->EOF){
		?>
		<tr align="center">
		<td class="titulos5" align="left" width="15%">
		Fecha
		</td>
		<td class="titulos5" align="left" width="20%">
		No. Expediente
		</td>
		<td class="titulos5" align="left" width="7%">
		NIT / Cod.
		</td>
		<td class="titulos5" align="left" width="40%">
		Entidad / Sigla / Ciudadano
		</td>
		<td class="titulos5" align="left" width="20%">
		Carpeta
		</td>
		<td class="titulos5" align="left" width="20%">
		Usuario Resp.
		</td>
		<td class="titulos5" align="left" width="20%">
		Acci&oacute;n
		</td>
		</tr>
		<?
		while(!$rs_Fin->EOF){
			$exp_Fecha = $rs_Fin->fields['SGD_SEXP_FECH'];
			$exp_No = $rs_Fin->fields['SGD_EXP_NUMERO'];
			$exp_Nit = $rs_Fin->fields['SGD_SEXP_PAREXP1'];
			$exp_P02 = $rs_Fin->fields['SGD_SEXP_PAREXP2'];
			$exp_P03 = $rs_Fin->fields['SGD_SEXP_PAREXP3'];
			$exp_Usu = $rs_Fin->fields['USUA_DOC_RESPONSABLE'];
			/*
			$sql_Ent = "SELECT * FROM BODEGA_EMPRESAS
						WHERE NIT_DE_LA_EMPRESA = '$exp_Nit'";
						
			$rs_Ent = $db->conn->query($sql_Ent);
			
			$nom_Ent = $rs_Ent->fields['NOMBRE_DE_LA_EMPRESA'];
			$nom_Sig = $rs_Ent->fields['SIGLA_DE_LA_EMPRESA'];
			*/
			$sql_Usu = "SELECT * FROM USUARIO
						WHERE USUA_DOC  = '$exp_Usu'";
			
			$rs_Usu = $db->conn->query($sql_Usu);
			
			$usu_Log = $rs_Usu->fields['USUA_LOGIN'];
			
			?>
			<tr align="center">
			<td class="listado5" align="left" width="15%">
			<?
			echo $exp_Fecha;
			?>
			</td>
			<td class="listado5" align="left" width="20%">
			<?=$exp_No?>
			</td>
			<td class="listado5" align="left" width="7%">
			<?
			echo $exp_Nit;
			?>
			</td>
			<td class="listado5" align="left" width="40%">
			<?
			echo $exp_P02; //$nom_Ent;
			?>
			</td>
			<td class="listado5" align="left" width="20%">
			<?
			echo $exp_P03; //$nom_Sig;
			?>
			</td>
			<td class="listado5" align="left" width="20%">
			<?
			echo $usu_Log;
			?>
			</td>
			<td class="listado5" align="left" width="20%">
			<input type="hidden" id="<?=$exp_No?>" value="<?=$exp_No?>">
			<a href="#" onClick="cambia_Exp('<?=$exp_No?>', 'numeroExpediente');">IncLuir</a>
			</td>
			</tr>
			<?
			$rs_Fin->MoveNext();
			}
			?>
		<?
		}
	else{
		?>
		<tr align="center">
		<td class="listado5" align="left" colspan="7">
		No hay expedientes relacionados...
		</td>
		<?
		}
		?>
	</table>
	</div>
	</td></tr></table>
	</td>
	</tr>	
	</table>
	<br>
	<?
//	}
/*	FIN	*/
	?>


<form method="post" action="<?php print $encabezado; ?>" name="insExp">
<input type="hidden" name='funExpediente' id='funExpediente' value="" >
<input type="hidden" name='confirmaIncluirExp' id='confirmaIncluirExp' value="" >
  <table border=0 width=70% align="center" class="borde_tab" cellspacing="1" cellpadding="0">        
    <tr align="center" class="titulos2">
      <td height="15" class="titulos2" colspan="2">INCLUIR EN  EL EXPEDIENTE</td>
    </tr>
  </table>
<table width="70%" border="0" cellspacing="1" cellpadding="0" align="center" class="borde_tab">

</table>
<table border=0 width=70% align="center" class="borde_tab">
      <tr align="center">
      <td class="titulos5" align="left" nowrap>
  Nombre del Expediente </td>
      <td class="titulos5" align="left">
        <input type="text" name="numeroExpediente" id="numeroExpediente" value="<?php print $_POST['numeroExpediente']; ?>" size="30">
      </td>
    </tr>
</table>
<table border=0 width=70% align="center" class="borde_tab">
	<tr align="center">

	<td width="33%" height="25" class="listado2" align="center">
	<center>
	  <input name="btnIncluirExp" type="button" class="botones_funcion" id="btnIncluirExp" onClick="validarNumExpediente();" value="Incluir en Exp">
		</center></TD>
	<td width="33%" class="listado2" height="25">
	<center><input name="btnCerrar" type="button" class="botones_funcion" id="btnCerrar" onClick="opener.regresar(); window.close();" value=" Cerrar "></center></TD>
	</tr>
</table>
<?
// Consulta si existe o no el expediente.
if ( $expediente->existeExpediente( $_POST['numeroExpediente'] ) !== 0 )
{
?>
<table border=0 width=70% align="center" class="borde_tab">
  <tr align="center">
    <td width="33%" height="25" class="listado2" align="center">
      <center class="titulosError2">
        ESTA SEGURO DE INCLUIR ESTE RADICADO EN EL EXPEDIENTE: 
      </center>
      <B>
        <center class="style1"><b><?php print $numeroExpediente; ?></b></center>
      </B>
      <div align="justify"><br>
        <strong><b>Recuerde:</b>No podr&aacute; modificar el numero de expediente si hay
        un error en el expediente, m&aacute;s adelante tendr&aacute; que excluir este radicado del
        expediente y si es el caso solicitar la anulaci&oacute;n del mismo. Adem&aacute;s debe
        tener en cuenta que tan pronto coloca un nombre de expediente, en Archivo crean
        una carpeta f&iacute;sica en el cual empezaran a incluir los documentos
        pertenecientes al mismo.
        </strong>
      </div>
    </td>
  </tr>
</table>
<table border=0 width=70% align="center" class="borde_tab">
  <tr align="center">
    <td width="33%" height="25" class="listado2" align="center">
	  <center>
	    <input name="btnConfirmar" type="button" onClick="confirmaIncluir();" class="botones_funcion" value="Confirmar">
	  </center>
    </td>
	<td width="33%" class="listado2" height="25">
	<center><input name="cerrar" type="button" class="botones_funcion" id="envia22" onClick="opener.regresar(); window.close();" value=" Cerrar "></center></TD>
	</tr>
</table>
<?	
}
else if ( $_POST['numeroExpediente'] != "" && ( $expediente->existeExpediente( $_POST['numeroExpediente'] ) === 0 ) )
{
    ?>
    <script language="JavaScript">
      alert( "Error. El nombre del Expediente en el que desea incluir este radicado \n\r no existe en el sistema. Por favor verifique e intente de nuevo." );
      document.getElementById( 'numeroExpediente' ).focus();
    </script>
    <?php
}
?>
</form>
</body>
</html>

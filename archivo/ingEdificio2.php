<?php
session_start();
$krd = $_SESSION["krd"];
if (!$ruta_raiz) $ruta_raiz = "..";
include "$ruta_raiz/rec_session.php";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
include_once "$ruta_raiz/include/tx/Expediente.php";
$db = new ConnectionHandler( "$ruta_raiz" );
$db->debug = false;
$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&dependencia=$dependencia&krd=$krd";
?>
<script>
function RegresarV(){
	window.location.assign("adminEdificio.php?<?=$encabezado1?>&fechah=$fechah&$orno&adodb_next_page");
}
</script>
<?
/**
  * Grabar los datos del edificio.
  */
if( isset( $_POST['btnGrabar'] ) && $_POST['btnGrabar'] != "" )
{
    //$db->conn->BeginTrans();
    
    /**
      * Crea el registro con los datos del edificio.
      */
    $q_insertE  = "INSERT INTO SGD_EIT_ITEMS( SGD_EIT_CODIGO, SGD_EIT_COD_PADRE,";
    $q_insertE .= " SGD_EIT_NOMBRE, SGD_EIT_SIGLA, CODI_DPTO, CODI_MUNI )";
	$sec=$db->conn->nextId( 'SEC_EDIFICIO' );
    $q_insertE .= " VALUES( '$sec', 0,";
    $q_insertE .= " UPPER( '".$_POST['hidNombreEdificio']."' ),";
    $q_insertE .= " UPPER( '".$_POST['hidSiglaEdificio']."' ),";
    $q_insertE .= " ".$_POST['hidDepartamento'].", ".$_POST['hidMunicipio']." )";
echo $muni_us;
     $listo = $db->query( $q_insertE );
    
    /**
      * Datos de las unidades de almacenamiento del edificio.
      */
    foreach( $_POST as $clavePOST => $valorPOST )
    {
        if( strncmp( $clavePOST, 'nombre_', 7 ) == 0 )
        {
            $nombreUA = $valorPOST;
        }
        if( strncmp( $clavePOST, 'sigla_', 6 ) == 0 )
        {
            $siglaUA = $valorPOST;
        }
        
        if( $nombreUA != "" && $siglaUA != "" )
        {
            /*
             * Crea el registro correspondiente a la unidad de almacenamiento.
             */
            $q_insertUA  = "INSERT INTO SGD_EIT_ITEMS( SGD_EIT_CODIGO,SGD_EIT_COD_PADRE, SGD_EIT_NOMBRE,";
            $q_insertUA .= " SGD_EIT_SIGLA )";
            $q_insertUA .= " VALUES( ".$db->conn->nextId( 'SEC_EDIFICIO' ).", $sec,";
            $q_insertUA .= " UPPER( '".$nombreUA."' ), UPPER( '".$siglaUA."' ) )";
            if( $listo )
            {
                $listo = $db->query( $q_insertUA );
            }
            $nombreUA = "";
            $siglaUA = "";
        }
    }
    
    if( $listo )
    {
        //$db->conn->CommitTrans();
	?>
	<script>
	window.open('<?=$ruta_raiz?>/archivo/relacionTiposAlmac.php?dependencia=<?=$dependencia?>&krd=<?=$krd?>&tipo=<?=$tipo?>&idEdificio=<?=$idEdificio?>&codp=<?=$sec?>',"Relacion Tipos Almacenamiento","height=250,width=550,scrollbars=yes");
	</script>
	<?	
    }
    else
    {
        //$db->conn->RollbackTrans(); 
    }

   // header( "Location: relacionTiposAlmac.php?".$encabezadol."&idEdificio=".$idEdificio);
}
?>
<html>
<head>
<title>INGRESO DE EDIFICIOS</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
<script language="JavaScript">
function mostrarCampos()
{
    var departamento = document.getElementById( 'codep_us' ).selectedIndex;
    var municipio2 = document.getElementById( 'muni_us' ).selectedIndex;
	var nombreEdificio = document.getElementById( 'nombre' ).value;
    var siglaEdificio = document.getElementById( 'sigla' ).value;
    
    if( document.getElementById( 'numero' ).value == "" || isNaN( document.getElementById( 'numero' ).value ) )
    {
        alert( 'Debe ingresar Número de Tipos de Almacenamiento.' );
        document.getElementById( 'numero' ).focus();
        return false;
    }
    else
    {
        var i;
        var j = parseInt( document.getElementById( 'numero' ).value );
        document.open();
		document.write( "<html>" +
                        "<head>" +
                        "<title>INGRESAR EDIFICIOS</title>" +
                        "<link rel='stylesheet' href='../estilos/orfeo.css'>" +
                        "</head>"
                      );
        document.write( "<body bgcolor='#FFFFFF'>" +
                        "<form name='frmCampos' action='<?=$encabezadol?>' method='post' >" + 
                        "<input type='hidden' name='hidDepartamento' value='<?=$codep_us?>'>" +
                        "<input type='hidden' name='hidMunicipio' value='<?=$muni_us?>'>" +
                        "<input type='hidden' name='hidNombreEdificio' value='"+nombreEdificio+"'>" +
                        "<input type='hidden' name='hidSiglaEdificio' value='"+siglaEdificio+"'>" +
                        "<table border='0' width='60%' cellpadding='0' align='center' class='borde_tab'>" +
                        "<tr>" +
                        "<td height='35' colspan='2' class='titulos2'>" +
                        "<center>INGRESAR EDIFICIOS</center>" +
                        "</td>" +
                        "</tr>" +
                        "<tr>" +
                        "<td height='30' class='titulos2'>" +
                        "<div align='center'>" +
                        "NOMBRE" +
                        "</div>" +
                        "</td>" +
                        "<td height='30' class='titulos2'>" +
                        "<div align='center'>" +
                        "SIGLA" +
                        "</div>" +
                        "</td>" +
                        "</tr>"
                      );
        for ( i = 0; i < j; i++ )
        {
            document.write( "<tr>" +
                            "<td class='titulos5'>" +
                            "<div align='center'>" +
                            "<input type='text' name='nombre_" + i + "' size='40' maxlength='40'>" +
                            "</div>" +
                            "</td>" +
                            "<td class='titulos5'>" +
                            "<div align='center'>" +
                            "<input type='text' name='sigla_" + i + "' size='4' maxlength='4'>" +
                            "</div>" +
                            "</td>" +
                            "</tr>"
                          );
        }
        document.write( "<tr>" +
                        "<td align='center' colspan='3' class='titulos5'>" +
                        "<input type='submit' class='botones' value='Grabar' name='btnGrabar'>" +
                        "<input type='button' class='botones' value='Cancelar' name='Cancelar' onClick='javascript:history.back()'>" +
                        "</td>" +
                        "</tr>" +
                        "</table>" +
                        "</form>" +
                        "</body>" +
                        "</html>"
                      );
        document.close()
    }
}
</script>
</head>
<body bgcolor="#FFFFFF">
<form name="inEdificio" action="<?=$encabezadol?>" method="post" >
<table border="0" width="90%" cellpadding="0"  class="borde_tab">
<tr>
  <td height="35" colspan="2" class="titulos2">
  <center>INGRESO DE EDIFICIOS</center>
  </td>
</tr>
<tr>
 <td height="30" class="titulos5">
    <div align="left">
      Departamento
      <select name="codep_us" id="codep_us" onChange="document.inEdificio.submit();" class="select">
        <option value="" selected>
          <font color="">-----</font>
        </option>
        <?php
        $isql = "SELECT DPTO_CODI, DPTO_NOMB
                  FROM DEPARTAMENTO
                  ORDER BY DPTO_NOMB
                ";
        $rs = $db->query( $isql );
		while( $rs && !$rs->EOF )
        {
            $deptocodi = trim( $rs->fields[0] );
            $deptonomb = trim( $rs->fields[1] );
            if( strlen( trim( $codep_us ) ) !=0 )
            {
                if( $deptocodi == $codep_us )
                {
                    $datos =" selected ";
                }
                else
                {
                    $datos = "";
                }
            }
            print "<option value='$deptocodi' $datos><font color=''>$deptonomb</font></option>";
            $rs->MoveNext();
        }
?>
      </select>
    </div>
  </td>
  
  <td class="titulos5">
    <div align="left">
      <b>Municipio</b>
      <select name="muni_us" id="muni_us" onChange="document.inEdificio.submit();" class="select">
        <?php
        if( $codep_us )
		{
			$depto = $codep_us;
		}
		if ( strlen( trim( $codep_us ) ) !=0 )
		{
			$depto = $codep_us;
		}
		if( !$depto )
        {
            $depto = '0';
        }
		$isql = "SELECT MUNI_CODI,MUNI_NOMB FROM MUNICIPIO where DPTO_CODI = $depto order by muni_nomb";
		$rs = $db->query( $isql );
		echo "<option value='' $datos>---</font></option>";
	
        while( $rs && !$rs->EOF )
		{
			$municodi = trim( $rs->fields[0] );
			$muninomb = trim( $rs->fields[1] );
			if( strlen( trim( $muni_us ) ) !=0 )
			{
				if( $municodi == $muni_us )
                {
                    $datos = " selected ";
                }
                else
                {
                    $datos = "";
                }
			}
			print "<option value='$municodi' $datos>$muninomb</font></option>";
			$rs->MoveNext();
		}
        $municodi="";$muninomb="";$depto="";
        ?>
      </select>

    </div>
  </td>
</tr>
<tr>
  <td height="23" class="titulos5">
    <div align="left">
      Nombre
      <input type="text" name="nombre" id="nombre" value="<?php print $_POST['nombre']; ?>" size="40" maxlength="40" align="right">
    </div>
  </td>
  <td class="titulos5">
    <div align="left">
      Sigla
      <input type="text" name="sigla" id="sigla" value="<?php print $_POST['sigla']; ?>" size="4" maxlength="4" align="right">
    </div>
  </td>
</tr>
<tr>
  <td height="26" class="titulos5">
    <div align="left">
      Ingrese N&uacute;mero de Tipos de Almacenamiento
      <input type="text" name="numero" id="numero" value="<?php print $_POST['numero']; ?>" size="2" maxlength="2" align="right">
    </div>
  </td>
  <td class="titulos5">
    <input type="button" name="btnMostrarCampos" class="botones_2" value="&gt;&gt;" onClick="mostrarCampos();">
  </td>
</tr>
<tr><td><input name='SALIR' type="button" class="botones" id="envia22" onClick="opener.regresar();window.close();" value="SALIR" align="middle" ></td></tr>
</table>
</form>
</body>
</html>

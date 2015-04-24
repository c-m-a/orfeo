<?
session_start();
$ruta_raiz = "..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
include_once ("$ruta_raiz/class_control/TipoDocumental.php");

//echo $CFechaIni;
//echo $CFechaFin;

?>

	<script type="text/javascript" src="../Calendario/src/utils.js"></script>
	<script type="text/javascript" src="../Calendario/src/calendar.js"></script>
	
	<script type="text/javascript" src="../Calendario/lang/calendar-es.js"></script>
	
	<script type="text/javascript" src="../Calendario/src/calendar-setup.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="../Calendario/themes/aqua.css" title="Calendar Theme - winxp.css" >
	<link href="../Calendario/doc/css/zpcal.css" rel="stylesheet" type="text/css">
	<link href="../Calendario/doc/css/template.css" rel="stylesheet" type="text/css">


<form id="Formulario" name="Formulario" method="post" action="#">
<table>
	<tr>
		<td>Fecha Inicial</td>
		<td>
<input type="text" id="CFechaIni" style="WIDTH:80px;" name="CFechaIni"  value="<?=$CFechaIni?>" >
<input type="reset" value="...." id="bFechaIni" style="height:18px;" class="boton"  >
			<script type="text/javascript">
				var cal = new Zapatec.Calendar.setup({
				
					inputField     :    "CFechaIni",   // id of the input field
					button         :    "bFechaIni",  // What will trigger the popup of the calendar
					ifFormat       :    "%Y/%m/%d", // format of the input field: Mar 18, 2005
					showsTime      :     false,      //no time
					saveDate       :    0            // save for two days					
				});
		</script>
		</td>
		<td rowspan="2"><input type="submit" onClick="Buscar()" value="Generar"> </td>
	</tr>
	
	<tr>
		<td>Fecha Inicial</td>
		<td>
<input type="text" id="CFechaFin" style="WIDTH:80px;" name="CFechaFin" value="<?=$CFechaFin?>" >
<input type="reset" value="...." id="bFechaFin" style="height:18px;" class="boton"  >
			<script type="text/javascript">
				var cal = new Zapatec.Calendar.setup({
				
					inputField     :    "CFechaFin",   // id of the input field
					button         :    "bFechaFin",  // What will trigger the popup of the calendar
					ifFormat       :    "%Y/%m/%d", // format of the input field: Mar 18, 2005
					showsTime      :     false,      //no time
					saveDate       :    0            // save for two days					
				});
		</script>
		</td>
	</tr>
	
</table>


</form>


<?


if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->BeginTrans();

$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	
// $db->conn->debug=true;


$Numero=0;

 


$sql="select ANEX_ESTADO,to_date(ANEX_FECH_ENVIO,'yyyy/mm/dd') as ANEX_FECH_ENVIO ,RADI_NUME_SALIDA,ANEX_FECH_IMPRES   from anexos where ANEX_TIPO =20 ";

	$rs = $db->query($sql);
//	echo $rs->RecordCount()."<br>";
	while(!$rs->EOF )

	{

		$estado=$rs->fields["ANEX_ESTADO"];
		$fechaenvio=$rs->fields["ANEX_FECH_ENVIO"];	
		$fechaimpresion=$rs->fields["ANEX_FECH_IMPRES"];	
	 
		$sql1="update Anexos set ANEX_FECH_IMPRES=to_date('$fechaimpresion','yyyy-mm-dd'), ANEX_ESTADO=$estado, ANEX_FECH_ENVIO=to_date('$fechaenvio','yyyy-mm-dd') where RADI_NUME_SALIDA='".$rs->fields["RADI_NUME_SALIDA"]."' 
		and ANEX_TIPO =1 ";
			echo $sql1;
		$rs1 = $db->query($sql1);
		if(!$rs1)
		{
			die("error en radicado ".$rs->fields["RADI_NUME_SALIDA"] ." ".$db->ErrorMsg());
		}
		else
		{
			echo "bien ".$rs->fields["RADI_NUME_SALIDA"]." <br>";
		}

		
		$rs->MoveNext();
	}

//echo "$sql<br>";
$db->conn->CommitTrans();

?>
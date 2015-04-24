<html>
<body>
<?php
$ADODB_COUNTRECS = false;
$ruta_raiz="..";
include_once("$ruta_raiz/config.php"); 			// incluir configuracion.
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once("$ruta_raiz/adodb/adodb-paginacion.inc.php");

$db = new ConnectionHandler("$ruta_raiz");
if ($db){	
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	
	$query=unserialize($_SESSION['xsql']);
	$rs=$db->conn->execute($query);
	echo $_SESSION['xheader'];	
	?>
	<table border=1>
		<tr>	
	<?php	
	foreach($rs->fields as $key=>$campo){
		$pre=substr($key, 0, 4);		
		if($pre!='CHK_'	&& $pre!='HID_'&& $pre!='CHU_'){	
			if($pre=='IDT_' || $pre=='DAT_' || $pre=='IMG_'){
				$key=substr($key, 4);		
			}
			echo "<td> $key </td>";
		}		
	}
	?>
		</tr>	
	<?php
	reset($rs);	
	while(!$rs->EOF){
		?><tr><?php		
		foreach($rs->fields as $key=>$campo){
			$pre=substr($key, 0, 4);		
			if($pre!='CHK_'	&& $pre!='HID_' && $pre!='CHU_'){	
				echo "<td> &nbsp;$campo</td>";		
			}		
		}
		?></tr><?php		
		$rs->moveNext();	
	}
	?>
	</table>
	<?php		
}else{
	echo "<BR>NO CONECTADO<BR>";
}

?>
</body>
</html>

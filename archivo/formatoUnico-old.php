<?php 
//**********************************************************************//
// @name Formato  unico de  inventario documental						//
// @descripcion Genera por  caja y  por  sede el  contenido  de  cada  	//
//              de las cajas del inventario.   							//
// @autor  Hardy Deimont Niño Velasquez									//
//**********************************************************************//
$krdOld = $krd;
$per=1;
session_start();

if(!$krd) $krd = $krdOld;
if (!$ruta_raiz) $ruta_raiz = "..";
if(!$dependencia or !$tpDepeRad) include "$ruta_raiz/rec_session.php";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
include_once ('../adodb/toexport.inc.php');
include_once ('../adodb/adodb.inc.php');
$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&num_exp=$num_exp&krd=$krd";
$usua_perm_archi=1;
if($_GET['action']=="Cosultar"){
	$valida=$_GET['validar'];
	$id=$_GET['id'];
    if($valida=="caja"){
    	$isql="select e.sgd_exp_numero,r.radi_depe_radi,e.sgd_exp_titulo,e.SGD_EXP_FECH_ARCH,e.RADI_NUME_RADI,e.SGD_EXP_ESTADO,r.RADI_NUME_HOJA,e.sgd_exp_carpeta as CARP,e.sgd_exp_caja_bodega 
			FROM SGD_EXP_EXPEDIENTE e, RADICADO r WHERE e.sgd_exp_caja_bodega='".$id."' and r.RADI_NUME_RADI=e.RADI_NUME_RADI and e.sgd_exp_estado !=2 order by e.sgd_exp_carpeta asc";	
    }
    else{
    	if($valida=="estante")
    		$extra="(select  c.sgd_eit_codigo from SGD_EIT_ITEMS a ,SGD_EIT_ITEMS b,SGD_EIT_ITEMS c where b.SGD_EIT_COD_PADRE =$id and  b.SGD_EIT_COD_PADRE =a.sgd_eit_codigo and c.SGD_EIT_COD_PADRE =b.sgd_eit_codigo order by b.SGD_EIT_NOMBRE) ent";
        if($valida=="entre")
          	$extra="(select sgd_eit_codigo from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE =$id order by SGD_EIT_NOMBRE)  ent";
     	  $isql="select e.sgd_exp_numero,r.radi_depe_radi,e.sgd_exp_titulo,e.SGD_EXP_FECH_ARCH,e.RADI_NUME_RADI,e.SGD_EXP_ESTADO,r.RADI_NUME_HOJA,e.sgd_exp_carpeta as CARP,e.sgd_exp_caja_bodega 
			FROM SGD_EXP_EXPEDIENTE e, RADICADO r , $extra
			WHERE e.sgd_exp_caja_bodega is not NULL and r.RADI_NUME_RADI=e.RADI_NUME_RADI and ent.sgd_eit_codigo= e.sgd_exp_caja and e.sgd_exp_estado !=2 order by e.sgd_exp_carpeta asc";
    }
    // $isql;
$rs=$db->query($isql);
$style="class='titulos4' align='center'";
$rowspa="rowspan=2 ";
$table="<table class='borde_tab' border=0><tr><td $rowspa $style>No.</td><td $rowspa $style>dependecia</td>
				<td $rowspa $style>OFICINA PRODUCTORA</td><td $rowspa $style>CODIGO DEPENDENCIA</td><td $rowspa $style>Titulo</td>				
				<td colspan=4 $style>UNIDAD DOCUMENTAL</td><td colspan=2 $style>FECHAS EXTREMAS</td>
				<td $rowspa $style>radicados</td><td $rowspa $style>Folios</td><td $rowspa $style>NUMERO DE LA UNIDAD DOCUMENTAL SSPD</td>
				<td $rowspa $style> NUMERO DE LA UNIDAD DOCUMENTAL MTI</td><td $rowspa $style>caja</td>
				<td $rowspa $style>CAJA MTI</td><td $rowspa $style> NOMBRE DE LA SERIE</td><td $rowspa $style>NUMERO DE SERIE</td>
         		  <td $rowspa $style> NOMBRE DE LA SUB SERIE</td><td $rowspa $style>NUMERO DE LA SUBSERIE</td>
         		<td colspan=2 $style>RETENCION</td>  <td $rowspa $style> DISPOSICION FINAL</td><td $rowspa $style>UBICACIÓN</td>
				</tr><tr><td $style>CAR</td><td $style>AZ</td><td $style>LB</td><td $style>AR</td>
               <td $style>FECHA INCIAL</td><td  $style>FECHA FINAL</td>   
               <td $style>AG</td><td  $style>AC</td></tr>";               
//OJO  CON LOS  FOLIOS.
$consecutivo=1;
$consecutivo2="-1";
$carp;
$countfech=0;
$style2=" class='titulos5' align='center' " ;
		while (!$rs->EOF) {
			if($carp==$rs->fields["CARP"]|| $carp== NULL){
				
			$carp=$rs->fields["CARP"];
			$radicados.=$rs->fields["RADI_NUME_RADI"]." ";
				if($consecutivo!=$consecutivo2){
					$dependencias=getdepe($db,$rs->fields["RADI_DEPE_RADI"]);
				}
				$suma=folios($db,$rs->fields["RADI_NUME_RADI"]);
					$fechaarray[$countfech]=$rs->fields["SGD_EXP_FECH_ARCH"];
					$countfech++;	  	
			$resulT=$rs->fields["RADI_NUME_HOJA"]+$suma+$resulT;	
			}
			ELSE{
				$fechainifin=fechaIniFin($fechaarray,$countfech);
				//print_r($fechaarray);
				$trd=serie($db,$rs->fields["SGD_EXP_NUMERO"]);							  
			  $table.="<tr>";
			  $table.="<td $style2>".$consecutivo."</td>";
			  $table.="<td $style2>".$dependencias["PADRE"]." </td>";
			  $table.="<td $style2>".$dependencias["HIJO"]."  </td>";
			  $table.="<td $style2>".$rs->fields["RADI_DEPE_RADI"]."  </td>";
			  $table.="<td $style2>".$rs->fields["SGD_EXP_TITULO"]."- ".$rs->fields["SGD_EXP_NUMERO"]."</td>";
			  $table.="<td $style2> X </td>";
			  $table.="<td $style2> &thinsp; </td>";
			  $table.="<td $style2> &thinsp; </td>";
			  $table.="<td $style2> &thinsp; </td>";
			  $table.="<td $style2>".$fechainifin['INI']."</td>";
			  $table.="<td $style2> ".$fechainifin['FIN']."</td>";
			  $table.="<td $style2 align='center'>".$radicados."</td>";
              $table.="<td $style2>".$resulT."</td>";
              $table.="<td $style2>".$carp."</td>";
              $table.="<td $style2> &thinsp; </td>";
              $table.="<td $style2>".$rs->fields["SGD_EXP_CAJA_BODEGA"]."</td>";
              $table.="<td $style2> &thinsp; </td>";
              $table.="<td $style2> ".$trd['nSerie']." </td>";
              $table.="<td $style2> ".$trd['codSerie']." </td>";
              $table.="<td $style2> ".$trd['nSubSerie']." </td>";
              $table.="<td $style2> ".$trd['codSub']." </td>";
              $table.="<td $style2> ".$trd['AG']." </td>";
              $table.="<td $style2> ".$trd['AC']." </td>";
              $table.="<td $style2> ".$trd['DISPOSICION']." </td>";
              $table.="<td $style2> &thinsp; </td>";
            $table.="</tr>";
            $vectoreCSV.="$consecutivo,".$dependencias['PADRE'].",".$dependencias['HIJO'].",".$rs->fields["RADI_DEPE_RADI"].",".$rs->fields["SGD_EXP_TITULO"]." - ".$rs->fields["SGD_EXP_NUMERO"].",X,,,,".$fechainifin['INI'].",".$fechainifin['FIN'].",".$radicados.",".$resulT.",".$carp.",,".$rs->fields["SGD_EXP_ESTANTE"].",,".$trd['nSerie'].",".$trd['codSerie'].",".$trd['nSubSerie'].",".$trd['codSub'].",".$trd['AG'].",".$trd['AC']." ,".$trd['DISPOSICION'].",\n";
            $resulT=0;
            $consecutivo++;
            $carp=$rs->fields["CARP"];
			$radicados=$rs->fields["RADI_NUME_RADI"]." ";
				if($consecutivo!=$consecutivo2){
					$dependencias=getdepe($db,$rs->fields["RADI_DEPE_RADI"]);
				}
				$suma=folios($db,$rs->fields["RADI_NUME_RADI"]);
				 $fechaarray[0]=$rs->fields["SGD_EXP_FECH_ARCH"];
					 $countfech=1;		  	
			$resulT=$rs->fields["RADI_NUME_HOJA"]+$suma;	
            
			} 
            
			 $rs->MoveNext();	   
        }
               $fechainifin=fechaIniFin($fechaarray,$countfech);
				$trd=serie($db,$rs->fields["SGD_EXP_NUMERO"]);
        			  $table.="<tr>";
			  $table.="<td $style2>".$consecutivo."</td>";
			  $table.="<td $style2>".$dependencias["PADRE"]." </td>";
			  $table.="<td $style2>".$dependencias["HIJO"]."  </td>";
			  $table.="<td $style2>".$rs->fields["RADI_DEPE_RADI"]."  </td>";
			  $table.="<td $style2>".$rs->fields["SGD_EXP_TITULO"]."- ".$rs->fields["SGD_EXP_NUMERO"]."</td>";
			  $table.="<td $style2> X </td>";
			  $table.="<td $style2> &thinsp; </td>";
			  $table.="<td $style2> &thinsp; </td>";
			  $table.="<td $style2> &thinsp; </td>";
			  $table.="<td $style2>".$fechainifin['INI']."</td>";
			  $table.="<td $style2> ".$fechainifin['FIN']." </td>";
			  $table.="<td $style2 align='center'>".$radicados."</td>";
              $table.="<td $style2>".$resulT."</td>";
              $table.="<td $style2>".$carp."</td>";
              $table.="<td $style2> &thinsp; </td>";
              $table.="<td $style2>".$rs->fields["SGD_EXP_CAJA_BODEGA"]."</td>";
              $table.="<td $style2> &thinsp; </td>";
              $table.="<td $style2> ".$trd['nSerie']." </td>";
              $table.="<td $style2> ".$trd['codSerie']." </td>";
              $table.="<td $style2> ".$trd['nSubSerie']." </td>";
              $table.="<td $style2> ".$trd['codSub']." </td>";
               $table.="<td $style2> ".$trd['AG']." </td>";
              $table.="<td $style2> ".$trd['AC']." </td>";
              $table.="<td $style2> ".$trd['DISPOSICION']." </td>";
              $table.="<td $style2> &thinsp; </td>";
            $table.="</tr>";
             $vectoreCSV.="$consecutivo,".$dependencias['PADRE'].",".$dependencias['HIJO'].",".$rs->fields["RADI_DEPE_RADI"].",".$rs->fields["SGD_EXP_TITULO"]." - ".$rs->fields["SGD_EXP_NUMERO"].",X,,,,".$fechainifin['INI'].",".$fechainifin['FIN'].",".$radicados.",".$resulT.",".$carp.",,".$rs->fields["SGD_EXP_ESTANTE"].",,".$trd['nSerie'].",".$trd['codSerie'].",".$trd['nSubSerie'].",".$trd['codSub'].",".$trd['AG'].",".$trd['AC']." ,".$trd['DISPOSICION'].",\n";
echo $table."</table>";	
//exec("rm ../bodega/estadisticasDatabox/prueba1.csv");
//echo exec("pwd");
$nameFile="FUD".$rs->fields["SGD_EXP_ESTANTE"];
$path = "../bodega/estadisticasDatabox/$nameFile.csv";
$fp = fopen($path, "w+");
	fwrite($fp,$vectoreCSV); //# Escribe a un archivo (tambien existe la funcion rs2tabfile)
	fclose($fp);
	?>El archivo generado lo puede descargar de	<br><br>
	<a href='<?=$path?>'> <input type="button" class="botones_funcion" value="Descargar" name="descargar"></a><?

}
elseif($_GET['action']=="cajas"){
	$edificio=$_GET['edificio'];
	$next=$_GET['nextx'];
//		$isql="select sgd_exp_caja_bodega  from sgd_exp_expediente where sgd_exp_caja_bodega is not null and sgd_exp_edificio=$edificio group by  (sgd_exp_caja_bodega)";
 $isql="select e.sgd_exp_caja_bodega from sgd_exp_expediente e ,(select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE =$edificio order by sgd_eit_codigo) ent
               where e.sgd_exp_caja_bodega is not null 
               and e.sgd_exp_caja=ent.SGD_EIT_CODIGO group by (sgd_exp_caja_bodega)";
$rs=$db->query($isql);
        $i=0; $j=0;
		while (!$rs->EOF) {
              $cajas[$i]=$rs->fields["SGD_EXP_CAJA_BODEGA"];
              $i++;
			 $rs->MoveNext();	   
			 }
//        sort($cajas);
		while ($j<$i) {
              $option.="<OPTION value=\"".$cajas[$j]."\">".$cajas[$j]."</OPTION>";
			 $j++;  
			 }
	?><select id='caja' ><option value='not'>-- Selecione -- </option><?php echo $option; ?></select><?php 	
	
}
elseif($_GET['action']=="piso" || $_GET['action']=="modulo"|| $_GET['action']=="area" || $_GET['action']=="estante" || $_GET['action']=="entre"){
	     $next=$_GET['nextx'];
	     $edificio=$_GET['edificio'];
	     $id=$_GET['action'];
		 $isql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE =$edificio order by  sgd_eit_codigo"; 	
$rs=$db->query($isql);
        $i=0; $j=0;
		while (!$rs->EOF) {
              $cajas[$i]=$rs->fields["SGD_EIT_CODIGO"];
              $cajas2[$i]=$rs->fields["SGD_EIT_NOMBRE"];
              $i++;
			 $rs->MoveNext();	   
			 }
        //sort($cajas);
		while ($j<$i) {
              $option.="<OPTION value=\"".$cajas[$j]."\">".$cajas2[$j]."</OPTION>";
			 $j++;  
			 }
	?><select id='<?=$id; ?>'  onchange='CAJAS("<? echo $next;?>");'><option value='not'>-- Selecione -- </option><?php echo $option; ?></select><?php 	
	
}
else{	
	$isql="select SGD_EIT_NOMBRE, SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '0'";
$rs=$db->query($isql);
		while (!$rs->EOF) {
              $option.="<OPTION value=\"".$rs->fields["SGD_EIT_CODIGO"]."\">".$rs->fields["SGD_EIT_NOMBRE"]."</OPTION>";  
			 $rs->MoveNext();	   
			 }
?>
<html>
  <head>
 	<script type="text/javascript" src="../js/Archivo.js"></script>
<script type="text/javascript">
function planilla(div,planilla){
	   document.getElementById('estructura').innerHTML = ' ';
	   switch(planilla){
	       case "caja":
  	         caja= document.getElementById('caja').value;
  	         if (caja!="not"){
             	var poststr = "id="+caja+"&div="+div+"&action=Cosultar&validar="+planilla; 
	         	divajax('formatoUnico.php',poststr,div);
  	         }
  	         else
  	            alert('Tiene que seleccionar la caja');
	       break;
	       case "estante":
	  	         caja= document.getElementById('estante').value;
	  	        if (caja!="not"){
	            	 var poststr = "id="+caja+"&div="+div+"&action=Cosultar&validar="+planilla; 
		         	divajax('formatoUnico.php',poststr,div);
	  	     	}
	  	        else
	  	            alert('Tiene que seleccionar El estante');
		   break;
	       case "entre":
   	  	         caja= document.getElementById('entre').value;
   	  	    	 if (caja!="not"){
	             	var poststr = "id="+caja+"&div="+div+"&action=Cosultar&validar="+planilla; 
		         	divajax('formatoUnico.php',poststr,div);
	    	   	 }
	  	         else
	  	            alert('Tiene que seleccionar El entrepa&ntilde;o');
		   break;
	   }
}
function CAJAS(div){
	   document.getElementById('estructura').innerHTML = ' ';
	   switch(div){
	   case "combopiso":
		   nivel='';
		   caja= document.getElementById('edificio').value;
           action='action=piso&nextx=comboarea';
           break;
	   case "comboarea":
		   nivel='';
		   caja= document.getElementById('piso').value;; 
           action='action=area&nextx=combomodulo';
           break;
	   case "combomodulo":
		   nivel='';
		   caja= document.getElementById('area').value;; 
           action='action=modulo&nextx=comboestante';
	      break;
       case "comboestante":
    	   nivel='';
	   caja= document.getElementById('modulo').value;; 
        action='action=estante&nextx=comboentre';
       break;
       case "comboentre":
    	   nivel='';
    	   caja= document.getElementById('estante').value;; 
            action='action=entre&nextx=combocaja';
           break;
       case "combocaja":
    	   caja= document.getElementById('entre').value;;
    	   nivel= document.getElementById('edificio').value; 
            action='action=cajas';
           break;
           
       }
	   if (caja!="not" && edificio!="not"){
         var poststr = "edificio="+caja+"&div="+div+"&"+action+"&nivel="+nivel; 
	     divajax('formatoUnico.php',poststr,div);
	   }
}

</script>
<?php echo $_GET['action'];?>
<link rel="stylesheet" href="../estilos/orfeo.css">
  </head>
  <body >
  <center><table class="borde_tab" class="borde_tab" bgcolor="#ffffff">
  <tr>
    <td colspan="6" class="titulos4">Formato Unico de Inventario Documental</td>
  </tr>
  <tr><td class="titulos2"> Edificio</td><td class="titulos2">
 <select id="edificio"  onchange='CAJAS("combopiso");'><option value="not">-- Selecione -- </option>
<?php ECHO $option; ?></select></td>
<td class="titulos2">Piso</td><td class="titulos2"><div id="combopiso">
<select id="piso"><option value='not'>-- Selecione -- </option></select>
</div></td>
</tr><tr>
<td class="titulos2">Area</td><td class="titulos2"><div id="comboarea">
<select id="area"><option value='not'>-- Selecione -- </option></select>
</div></td>
<td class="titulos2">Modulo</td><td class="titulos2"><div id="combomodulo">
<select><option value='not'>-- Selecione -- </option></select>
</div id="modulo"></td>
</tr><tr>
<td class="titulos2">Estante</td><td class="titulos2"><div id="comboestante">
<select id="estante"><option value='not'>-- Selecione -- </option></select>
</div></td>
<td class="titulos2" colspan=2 align="center"><input type="submit" class="botones" onclick='planilla("estructura","estante");' value="Generar Estante" name="Buscar"></td>
</tr><tr>
<td class="titulos2">Entrepa&ntilde;o</td><td class="titulos2"><div id="comboentre">
<select><option value='not'>-- Selecione -- </option></select>
</div id="entre"></td>
<td class="titulos2" colspan=2 align="center"><input type="submit" class="botones" onclick='planilla("estructura","entre");' value="Generar Entrepa&ntilde;o" name="Buscar"></td>
</tr><tr>
<td class="titulos2" >Caja</td><td class="titulos2" ><div id="combocaja">
<select id="caja"><option value='not'>-- Selecione -- </option></select>
</div></td>
<td class="titulos2" colspan=2 align="center"><input type="submit" class="botones"  onclick='planilla("estructura","caja");' value="Generar Caja" name="Buscar"></td>
 </tr>

  </table><br>
<div id="estructura"></div>

  </body>
</html>
<?php }

/**
* @name getdepe
* @desc funcion que determinar la dependecia y  su dependecia padre. 
* @author Hardy deimont Niño Velasquez
* **/
function getdepe($db,$depe){
	$sql="select  db.depe_nomb as PADRE,da.depe_nomb as HIJO from dependencia da,dependencia db where da.depe_codi=".$depe." and db.depe_codi=da.depe_codi_padre";
 		           $rs2=$db->query($sql);
	$res['PADRE']=$rs2->fields["PADRE"];
	$res['HIJO']=$rs2->fields["HIJO"];
	return $res;
	
}
/**
* @name folios
* @desc funcion para determinar el  numero de folios contado  los que hay en los  anexos. 
* @author Hardy deimont Niño Velasquez
* **/
function folios($db,$radicado){
 $sqlanexo="select sum(TO_NUMBER(substr(replace( anex_desc, 'Paginas)',' '),2,4))) as suma from anexos 
where anex_radi_nume=".$radicado."   and anex_nomb_archivo like '%.tif' and anex_borrado='N'";
			$rs3=$db->query($sqlanexo);
			return $rs3->fields["SUMA"];
}

/**
* @name fechaIniFin
* @desc funcion para determina el  fecha inicial y final de las carpetas. 
* @author Hardy deimont Niño Velasquez
* **/
function  fechaIniFin($vectore,$countd){
	$i=0;
	while($i<$countd){
		$fechas[$i]=$vectore[$i];
	$i++;
	}
sort($fechas);	
$res['INI']=$fechas[0];
$res['FIN']=$fechas[$countd-1];
return $res;	
}

function serie($db,$numExpediente){
	$sql="select se.SGD_EXP_NUMERO, sb.SGD_SRD_CODIGO, sr.SGD_SRD_DESCRIP, sb.SGD_SBRD_CODIGO, sb.SGD_SBRD_DESCRIP,sb.SGD_SBRD_TIEMAG,sb.SGD_SBRD_TIEMAC,
	       (CASE WHEN sb.SGD_SBRD_DISPFIN = 1 THEN 'C. TOTAL' ELSE CASE WHEN sb.SGD_SBRD_DISPFIN = 2 THEN 'ELIMINACION' ELSE CASE WHEN sb.SGD_SBRD_DISPFIN = 3 THEN 'M.TECNICO' ELSE  'MUESTREO' END END END) AS DISPOSICION
			from SGD_SEXP_SECEXPEDIENTES se, SGD_SBRD_SUBSERIERD sb, SGD_SRD_SERIESRD sr
			WHERE SGD_EXP_NUMERO='$numExpediente' AND se.SGD_SRD_CODIGO=sr.SGD_SRD_CODIGO AND se.SGD_SRD_CODIGO=sb.SGD_SRD_CODIGO AND se.SGD_SBRD_CODIGO=sb.SGD_SBRD_CODIGO
			order by se.SGD_SEXP_FECH DESC";
	$rs2=$db->query($sql);
    $detalles['nSerie']= $rs2->fields["SGD_SRD_DESCRIP"];
	$detalles['nSubSerie']= $rs2->fields["SGD_SBRD_DESCRIP"];
	$detalles['codSerie'] = $rs2->fields["SGD_SRD_CODIGO"];
	$detalles['codSub'] = $rs2->fields["SGD_SBRD_CODIGO"];
	$detalles['AG'] = $rs2->fields["SGD_SBRD_TIEMAG"];
	$detalles['AC'] = $rs2->fields["SGD_SBRD_TIEMAC"];
	$detalles['DISPOSICION'] = $rs2->fields["DISPOSICION"];	
	return $detalles;
	
}

?>
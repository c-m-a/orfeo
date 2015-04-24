<?
session_start();
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
import_request_variables("gp", "");
$ruta_raiz = "..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$db = new ConnectionHandler($ruta_raiz);
$objHistorico= new Historico($db);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
?>

<html>
<head>
  <meta http-equiv="Cache-Control" content="cache">
  <meta http-equiv="Pragma" content="public">
<link rel="stylesheet" href="../estilos/orfeo.css">
<?php
$fechah=date("dmy") . "_". time("h_m_s");
$encabezado = session_name()."=".session_id()."&krd=$krd";
 if(!$estado_sal)   {$estado_sal=2;}
 if(!$estado_sal_max) $estado_sal_max=3;
  $accion_sal = "Marcar como Archivado Fisicamente";
  $pagina_sig = "envio.php";
  if(!$dep_sel) $dep_sel = $dependencia;
  $dependencia_busq1= " and d.depe_codi like '$dep_sel'";
  $dependencia_busq2= " and radi_depe_actu like '$dep_sel'";
$tbbordes = "#CEDFC6";
$tbfondo = "#FFFFCC";
if(!$orno){$orno=1;}
$imagen="flechadesc.gif";
?>
<CENTER>
<body bgcolor="#FFFFFF">
<div id="spiffycalendar" class="text"></div>
 <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
 <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js">
</script><style type="text/css">
<!--
.textoOpcion {  font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #000000; text-decoration: underline}
-->
</style>
<script>
function Etiquetas(numeroExpediente) {
window.open("<?=$ruta_raiz?>/expediente/etiquetas.php?&numeroExpediente=" + numeroExpediente +
				"&numRad=<?=$nurad?>&krd=<?=$krd?>&coddepe=<?=$coddepe?>&codusua=<?=$codusua?>","Etiquetas","height=300,width=450");
}
</script>
</head>

<body bgcolor="#FFFFFF" topmargin="0" >
<div id="object1" style="position:absolute; visibility:show; left:10px; top:-50px; width=80%; z-index:2" >
  <p>Cuadro de Historico</p>
</div>
<?php
 /*
 PARA EL FUNCIONAMIENTO CORRECTO DE ESTA PAGINA SE NECESITAN UNAS VARIABLE QUE DEBEN VENIR
 carpeta  "Codigo de la carpeta a abrir"
 nomcarpeta "Nombre de la Carpeta"
 tipocarpeta "Tipo de Carpeta  (0,1)(Generales,Personales)"
 seleccionar todos los checkboxes
*/
    $img1="";$img2="";$img3="";$img4="";$img5="";$img6="";$img7="";$img8="";$img9="";
    if($ordcambio){if($ascdesc=="DESC" ){$ascdesc="";	$imagen="flechaasc.gif";}else{$ascdesc="DESC";$imagen="flechadesc.gif";}}
    if($orno==1){$order=" d.sgd_exp_numero $ascdesc";$img1="<img src='../iconos/$imagen' border=0 alt='$data'>";}
    if($orno==2){$order=" a.radi_nume_radi $ascdesc";$img2="<img src='../iconos/$imagen' border=0 alt='$data'>";}
    if($orno==3){$order=" a.radi_fech_radi $ascdesc";$img3="<img src='../iconos/$imagen' border=0 alt='$data'>";}
    if($orno==4){$order=" a.ra_asun $ascdesc";$img4="<img src='../iconos/$imagen' border=0 alt='$data'>";}
    if($orno==5){$order=" e.depe_nomb $ascdesc";$img5="<img src='../iconos/$imagen' border=0 alt='$data'>";}
    if($orno==6){$order=" f.usua_nomb $ascdesc";$img6="<img src='../iconos/$imagen' border=0 alt='$data'>";}
    if($orno==9){$order=" f.usua_nomb $ascdesc";$img9="<img src='../iconos/$imagen' border=0 alt='$data'>";}
    if($orno==7){$order=" plt_codi desc ,radi_fech_radi";$img7=" <img src='../iconos/flechanoleidos.gif' border=0 alt='$data'> ";}
    if($orno==8){$order=" plt_codi asc ,radi_fech_radi";$img7=" <img src='../iconos/flechaleidos.gif' border=0 alt='$data'> ";}

    $datosaenviar = "fechaf=$fechaf&tipo_carp=$tipo_carp&ascdesc=$ascdesc&orno=$orno";
    $encabezado = session_name()."=".session_id()."&krd=$krd&estado_sal=$estado_sal&fechah=$fechah&estado_sal_max=$estado_sal_max&ascdesc=$ascdesc&dep_sel=$dep_sel&exp_fechaFin=$exp_fechaFin&exp_fechaIni=$exp_fechaIni&exp_retenci=$exp_retenci&orno=";
    $fechah=date("dmy") . "_". time("h_m_s");

    $check=1;
    $fechaf=date("dmy") . "_" . time("hms");

    $numeroa=0;$numero=0;$numeros=0;$numerot=0;$numerop=0;$numeroh=0;
    $isql = "select * From usuario where  USUA_LOGIN ='$krd' and USUA_SESION='". substr(session_id(),0,29)."' ";
    $rs=$db->query($isql);
    // Validacion de Usuario y COntrasea MD5
    //echo "** $krd *** $drde";
  if (trim($rs->fields["USUA_LOGIN"])==trim($krd))
      {
      $nombusuario =$rs->fields["USUA_NOMB"];
      $contraxx=$rs->fields["USUA_PASW"];
      $permiso=$rs->fields["USUA_ADMIN_ARCHIVO"];
      $nivelus=$rs->fields["CODI_NIVEL"];
      $codusuario=$rs->fields["USUA_CODI"];


      if($rs->fields["USUA_NUEVO"]=="1"){
	      $carpeta=200;
	$nomcarpeta = "UBICACI&Oacute;N EXPEDIENTE";
	include "../envios/paEncabeza.php";
?>
    <br>
     <form name='form1' action='datos_expediente.php?<?=session_name()."=".session_id()."&krd=$krd&fechah=$fechah&nurad=$nurad&num_expediente=$num_expediente&exp_fechaFin=$exp_fechaFin&exp_fechaIni=$exp_fechaIni&exp_archivo=$exp_archivo&exp_unicon=$exp_unicon&item3=$item3&item4=$item4&item5=$item5&car=$car&exp_carpeta2=$exp_carpeta2 "?>' method="POST">
    <TABLE width="100%" align="center" cellspacing="5" cellpadding="0" class="borde_tab">
      <tr>
	<TD class='titulos2' height="58">
	  <table BORDER=0  cellpad=2 cellspacing='2' WIDTH=100% class='t_bordeGris' valign='top' align='center' cellpadding="2" >
	    <tr><td class='titulos2'>Radicado No <b><?=$nurad?></b> Perteneciente al expediente No <b><?=$num_expediente?></b></td>
<?php
	  $ruta_raiz = "..";
	  require "$ruta_raiz/class_control/class_control.php";
	  $btt = new CONTROL_ORFEO($db);
	  //$db->conn->debug = true;
	  if(!$Archivar)
	  {
	    $observa = " Almacenado en Fisico ";
	    $observa2 = " Almacenado en Fisico del radicado ".$numrad;
	    $sqlrad="select RADI_NUME_RADI FROM SGD_EXP_EXPEDIENTE WHERE SGD_EXP_NUMERO LIKE '$num_expediente' order by RADI_NUME_RADI";
	    $rsrad=$db->query($sqlrad);
	    $j=1;
	    $sqm="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo like '$exp_piso2'";
	    $rs=$db->conn->Execute($sqm);
	    //$exp_piso=$rs->fields['SGD_EIT_SIGLA'];
	    $exp_piso=$exp_piso2;
      echo "<hr>".$exp_item12 . "<hr>";
	    if ($exp_item12!=""){
	    $ttp="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo like '$exp_item12'";
	    $rs=$db->conn->Execute($ttp);
	    $tmp=$rs->fields['SGD_EIT_NOMBRE'];
	    for ($i=1;$i<=22;$i++){
	    $tmp1=explode("$i",$tmp);
	    if($tmp1[0]=="CAJA " or $tmp1=="caja ")$exp_caja=$exp_item12;
	    if($tmp1[0]=="AREA " or $tmp1[0]=="ZONA " or $tmp1[0]=="area " or $tmp1=="zona ")$exp_item1=$exp_item12;
	    if($tmp1[0]=="CARRO " or $tmp1=="carro ")$exp_carro=$exp_item12;
	    if($tmp1[0]=="ESTANTE " or $tmp1=="estante ")$exp_estante=$exp_item12;
	    if($tmp1[0]=="ENTREPANO " or $tmp1=="eentrepano ")$exp_entrepa=$exp_item12;
	    }
	    }
	    if ($exp_item22!=""){
	    $ttp="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo like '$exp_item22' order by SGD_EIT_CODIGO";
	    $rs=$db->conn->Execute($ttp);
	    $tmp=$rs->fields['SGD_EIT_NOMBRE'];
	    for ($i=1;$i<=22;$i++){
	    $tmp1=explode("$i",$tmp);
	    if($tmp1[0]=="CAJA " or $tmp1=="caja ")$exp_caja=$exp_item22;
	    if($tmp1[0]=="AREA " or $tmp1=="ZONA " or $tmp1[0]=="area " or $tmp1=="zona ")$exp_item1=$exp_item22;
	    if($tmp1[0]=="CARRO " or $tmp1=="carro ")$exp_carro=$exp_item22;
	    if($tmp1[0]=="ESTANTE " or $tmp1=="estante ")$exp_estante=$exp_item22;
	    if($tmp1[0]=="ENTREPANO " or $tmp1=="eentrepano ")$exp_entrepa=$exp_item22;
	    }
	    }
	    if ($exp_item31!=""){
	    $ttp="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo like '$exp_item31' order by SGD_EIT_CODIGO";
	    $rs=$db->conn->Execute($ttp);
	    $tmp=$rs->fields['SGD_EIT_NOMBRE'];
	    for ($i=1;$i<=22;$i++){
	    $tmp1=explode("$i",$tmp);
	    if($tmp1[0]=="CAJA " or $tmp1=="caja ")$exp_caja=$exp_item31;
	    if($tmp1[0]=="AREA " or $tmp1=="ZONA " or $tmp1[0]=="area " or $tmp1=="zona ")$exp_item1=$exp_item31;
	    if($tmp1[0]=="CARRO " or $tmp1=="carro ")$exp_carro=$exp_item31;
	    if($tmp1[0]=="ESTANTE " or $tmp1=="estante ")$exp_estante=$exp_item31;
	    if($tmp1[0]=="ENTREPANO " or $tmp1=="eentrepano ")$exp_entrepa=$exp_item31;
	    }
	    }
	    if ($exp_entre!=""){
	    $ttp="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo like '$exp_entre' order by SGD_EIT_CODIGO";
	    $rs=$db->conn->Execute($ttp);
	    $tmp=$rs->fields['SGD_EIT_NOMBRE'];
	    for ($i=1;$i<=22;$i++){
	    $tmp1=explode("$i",$tmp);
	    if($tmp1[0]=="CAJA " or $tmp1=="caja ")$exp_caja=$exp_entre;
	    if($tmp1[0]=="ESTANTE " or $tmp1=="estante ")$exp_estante=$exp_entre;
	    if($tmp1[0]=="ENTREPANO " or $tmp1=="entrepano ")$exp_entrepa=$exp_entre;
	    }
	    }

	    while(!$rsrad->EOF){
	    $arrayRad[$j]=$rsrad->fields['RADI_NUME_RADI'];
	    $j++;
	    $rsrad->MoveNext();
	    }
	    $sqlrad3="select e.RADI_NUME_RADI,e.SGD_EXP_ESTADO,r.RADI_NUME_HOJA FROM SGD_EXP_EXPEDIENTE e, RADICADO r WHERE SGD_EXP_NUMERO LIKE '$num_expediente' and r.RADI_NUME_RADI=e.RADI_NUME_RADI";
	    if($exp_carpeta!="" and $car)$sqlrad3.=" and e.SGD_EXP_CARPETA LIKE '$carpe'";
	    $sqlrad3.=" ORDER BY e.RADI_NUME_RADI";
	    
    	    //echo "<hr>**** $sqlrad3 **** <hr>";
	    $rsrad3=$db->query($sqlrad3);
	    $j=1;
	    $exp_folio=0;
	    while(!$rsrad3->EOF){
	      $arrayRad2[$j]=$rsrad3->fields['RADI_NUME_RADI'];
	      $foli[$j]=$rsrad3->fields['RADI_NUME_HOJA'];
	      $esta[$j]=$rsrad3->fields['SGD_EXP_ESTADO'];
	      if($esta[$j]==1)$exp_folio+=$foli[$j];
	      $rsrad3->MoveNext();
	      $j++;
	    }
	    $fo=$fol[1];
	    $cont=count($arrayRad2);
	      if($EST==2){$exp_rete='1';$exp_fechaFin = date("Y-m-d");}
	      else $exp_rete="";
	    if($cont==1){

	    //if($h2!=2)$exp_fechaFin ="";
// Aqui se accede a la clase class_control para actualizar expedientes.
//echo "aki va";

  if($exp_fechaFin<=date("Y-m-d")){
    
  $res=$btt->modificar_expediente($arrayRad2[1],$num_expediente,$exp_titulo,$exp_asunto,$exp_item1,
  $exp_piso,$exp_caja,$exp_estante,$exp_carpeta,$exp_subexpediente,' ',$EST,$UN,$exp_fechaIni,
  $exp_fechaFin,$exp_folio,$exp_rete,$exp_entrepa,$exp_edificio2,$krd,$exp_carro,' ',' ');
  $sqm="update radicado set RADI_NUME_HOJA='$fo' where radi_nume_radi like '$arrayRad2[1]'";
  $rst=$db->query($sqm);
  }
  else echo "La fecha final esta incorrecta";
  }
  else {
    if($exp_fechaFin<=date("Y-m-d")){
    $i=1;$k=3;
   while($i<=$cont){
      //$exp_fechaIni = "0";
    if($inclu[$i]==$k){
      $res=$btt->modificar_expediente($arrayRad2[$i],$num_expediente,
      $exp_titulo,$exp_asunto,$exp_item1,$exp_piso,$exp_caja,$exp_estante,$exp_carpeta,
      $exp_subexpediente,' ',$EST,$UN,$exp_fechaIni,$exp_fechaFin,$exp_folio,$exp_rete,$exp_entrepa,$exp_edificio2
      ,$krd,$exp_carro,'','');
      $sqm="update radicado set RADI_NUME_HOJA=$fol[$i] where radi_nume_radi like '$arrayRad2[$i]'";
      $rst=$db->query($sqm);
    }
     $i++;$k++;
    }
    }
    else echo "La fecha final esta incorrecta";

  }

   if ($res == false){
  echo '<br>Lo siento no pudo Actualizar los datos del expediente<br>';
  }else{
  echo "<br>Datos de expediente Grabados Correctamente<br>";
  $objHistorico->insertarHistorico($arrayRad,$dep_sel ,$codusuario, $dep_sel,$codusuario, $observa, 57);
//$this->db->conn->debug=true;
  }

//$objHistorico->insertarHistoricoExp($num_expediente,$arrayRad,$dep_sel ,$codusuario, $observa2, 57,1);
    }
    if($ent==1){
      echo "<hr> Emtro <hr>";
      $btt->datos_expediente($num_expediente,$nurad);
      $num_carpetas = $btt->exp_num_carpetas;
      $exp_subexpediente= $btt->exp_subexpediente;
      $exp_item1 = $btt->exp_item1;
      $exp_piso = $btt->exp_item2;
      $exp_caja = $btt->exp_caja;
      $exp_estante = $btt->exp_estante;
      $exp_carpeta = $btt->exp_carpeta;
      $exp_estado = $btt->exp_estado;
      $exp_archivo = $btt->exp_archivo;
      $exp_unidad = $btt->exp_unicon;
      $exp_fechaIni = $btt->exp_fechaIni;
      $exp_fechaFin = $btt->exp_fechaFin;
      $exp_folio = $btt->exp_folio;
      $exp_retenci = $btt->exp_rete;
      $exp_entrepa= $btt->exp_entrepa;
      $exp_edificio=$btt->exp_edificio;
      $exp_carro=$btt->exp_carro;
      $EST=$btt->exp_archivo;
      $UN=$btt->exp_unicon;
      
      echo "<hr>Caja :$exp_caja<br> Edificio: $exp_edificio<hr>";
      
      $resultadoBtt = $btt->datosUbicacionExpediente($btt->exp_caja);
      print_r($resultadoBtt);
      echo "<br>";
      print_r($btt->itemCodigo);
      echo "<br>";
      print_r($btt->itemCodigoPadre);
      echo "<br>";
      print_r($btt->itemNombre);
      echo "<BR>---> ". $btt->itemMuniCodi . "---". $btt->itemDptoCodi;
      if ($exp_item1!="")$u=explode($exp_piso,$exp_item1);
      else $u[1]="";
      $exp_item11=$u[1];
      $ent++;
      }
    //$permiso = $btt->permiso;
    //if(!trim($numcarpetas)) $numcarpetas=$exp_carpeta;

    $queryUs = "select SGD_SEXP_PAREXP1,SGD_SEXP_PAREXP2,SGD_SEXP_PAREXP3,SGD_SEXP_PAREXP4,SGD_SEXP_PAREXP5 from
    SGD_SEXP_SECEXPEDIENTES where SGD_EXP_NUMERO='$num_expediente'";
    $rsUs = $db->conn->Execute($queryUs);
    if (!$rsUs->EOF){
    $eti1=$rsUs->fields['SGD_SEXP_PAREXP1'];
    $eti2=$rsUs->fields['SGD_SEXP_PAREXP2'];
    $eti3=$rsUs->fields['SGD_SEXP_PAREXP3'];
    $eti4=$rsUs->fields['SGD_SEXP_PAREXP4'];
    $eti5=$rsUs->fields['SGD_SEXP_PAREXP5'];
    }
    $etiquetas=$eti1;
    if($eti2!="")$etiquetas.=",".$eti2;
    if($eti3!="")$etiquetas.=",".$eti3;
    if($eti4!="")$etiquetas.=",".$eti4;
    if($eti5!="")$etiquetas.=",".$eti5;

    /** $queryed = "select CODI_DPTO,CODI_MUNI from SGD_EIT_ITEMS where SGD_EIT_CODIGO LIKE '$exp_edificio'";
    
    //$db->conn->debug=true;
    $rsed = $db->conn->Execute($queryed);
    if (!$rsed->EOF){
      $codDpto=$rsed->fields['CODI_DPTO'];
      $codMuni=$rsed->fields['CODI_MUNI'];
    } */
    ?>
	</tr>
	</TABLE>
      </td>
    </tr>
    <tr>
    <td class=listado2>
      <table><tr><td></td></tr></table>
      <table width="80%" height="99%" cellspacing="5"  align="center" class="borde_tab" >
      <tr valign="bottom" >
	<TD class='titulos2'><?=$etiquetas?></td>
	  </tr>
	 <tr><td class='titulos2'>SUBEXPEDIENTE
	  <input type=text class='tex_area' name="exp_subexpediente" id="exp_subexpediente" value='<?=$exp_subexpediente?>' size=3 maxlength="2"><BR></TD>
	 </tr>
	 <!--TR>
	 <TD colspan="3" align="center" class='titulos2' height="30"><b>Folio
	   <?=$exp_carpeta?> de <?=$num_carpetas?></b>
	 </TD>
	 </TR-->
	 <TR class='titulos2'>
	 <TD colspan="3">
    <? // parametrizacion de items
    $sql="select SGD_EIT_NOMBRE, SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '0'";
    $rs=$db->query($sql);
    $item1=$rs->fields["SGD_EIT_NOMBRE"];
    $cod1=$rs->fields["SGD_EIT_CODIGO"];
    ?>
    <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center" class="borde_tab"  >
      <TR  class='titulos2'><TD>&nbsp;</TD></TR>
	<tr valign="bottom" class='titulos2'>
	<td class="titulos2">DEPARTAMENTO
	<td class="titulos2" >
	  <?
	  if ($codDpto!="") {
      $codDpto2=$codDpto;
    }else{
      $codDpto2 = $btt->itemDptoCodi;
    }
	  $queryDpto = "select distinct(d.DPTO_NOMB),d.DPTO_CODI FROM DEPARTAMENTO d, SGD_EIT_ITEMS i
                  WHERE d.DPTO_CODI=i.CODI_DPTO
                  AND ID_PAIS=170
                  ORDER BY DPTO_NOMB";
	  $rsD=$db->query($queryDpto);
	  print $rsD->GetMenu2("codDpto2", $codDpto2, "0:-- Seleccione --", false,""," onChange='submit()' class='select'" );
	  ?>
	  </td>
	  <td class="titulos2">MUNICIPIO
	  <td class="titulos2">
	  <? 
	  if ($codMuni!=""){
       $codMuni2=$codMuni;
      }else{
       $codMuni2 = $btt->itemMuniCodi;
    }
	  $queryMuni = "select distinct(m.MUNI_NOMB),m.MUNI_CODI FROM MUNICIPIO m , SGD_EIT_ITEMS i WHERE m.MUNI_CODI=i.CODI_MUNI and DPTO_CODI='$codDpto2' AND ID_PAIS=170 ORDER BY MUNI_NOMB";
	  $rsm=$db->query($queryMuni);
	  print $rsm->GetMenu2("codMuni2", $codMuni2, "0:-- Seleccione --", false,""," onChange='submit()' class='select'" );
	  ?>
	  </td>
	  </tr>
	  <tr class="titulos2">

	  <td  class='titulos2'>EDIFICIO </td>
	  <TD >
	  <?
	  if ($exp_edificio!="" and $exp_edificio2=="")$exp_edificio2=$exp_edificio;
	  $sql="select SGD_EIT_SIGLA,SGD_EIT_CODIGO from SGD_EIT_ITEMS where CODI_MUNI like '$codMuni2'
	  and CODI_DPTO like '$codDpto2' order by SGD_EIT_NOMBRE";
	  $rs=$db->query($sql);
    
	  //print $rs->GetMenu2('exp_edificio2',$exp_edificio2,true,false,""," onChange='submit()' class=select");
    $iItem = 1;
    print $rs->GetMenu2('exp_edificio2',$btt->itemCodigo[$iItem],true,false,""," onChange='submit()' class=select");
	  ?>
        </td>
       <td class='titulos2'>PISO</td>
	<TD >
	<?
	if ($exp_piso!="" and $exp_piso2=="")$exp_piso2=$exp_piso;
  
	//$sql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$exp_edificio2' order by SGD_EIT_NOMBRE";
  $sql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS
        where SGD_EIT_COD_PADRE like '".$btt->itemCodigo[$iItem]."'
        order by SGD_EIT_NOMBRE";
	$rs=$db->query($sql);
  $iItem++;
	print $rs->GetMenu2('exp_piso2',$btt->itemCodigo[$iItem],true,false,""," onChange='submit()' class=select");
?>
      </TD>
	</tr>
	<tr class='titulos2'>
	<?
	//$sql="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$exp_piso2' order by SGD_EIT_NOMBRE ";
  $sql="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS
        where SGD_EIT_COD_PADRE like '".$btt->itemCodigo[$iItem]."'
        order by SGD_EIT_NOMBRE ";
	$rs=$db->query($sql);
	if (!$rs->EOF)	$item31=$rs->fields["SGD_EIT_NOMBRE"];
		$item3=explode('1',$item31);
	if($btt->itemCodigo[$iItem]>=1){
	?>
      <td class='titulos2'>
      <?=$item3[0]?> - 
      <?=$btt->itemNombre[$iItem+1]?>
       </td>
      <TD >
      <?
      //if ($exp_item1!="" and $exp_item12==""){
      /** if($ent==2){
      if($item3[0]=="CARRO ")$exp_item12=$exp_carro;
      elseif($item3[0]=="ESTANTE ")$exp_item12=$exp_estante;
      elseif($item3[0]=="ENTREPANO ")$exp_item12=$exp_entrepa;
      else $exp_item12=$exp_item1;
      } */
      //$sql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$exp_piso2' order by SGD_EIT_NOMBRE";
      $sql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO
            from SGD_EIT_ITEMS
            where SGD_EIT_COD_PADRE like '".$btt->itemCodigo[$iItem]."'
            order by SGD_EIT_NOMBRE";
      $rs=$db->query($sql);
      $iItem++;
      print $rs->GetMenu2('exp_item12',$btt->itemCodigo[$iItem],true,false,""," onChange='submit()' class=select");
  
      ?>
      </td>
      <?
    }
	  //$sql="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$exp_item12' order by SGD_EIT_NOMBRE";
    $sql="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS
          where SGD_EIT_COD_PADRE like '".$btt->itemCodigo[$iItem]."' 
          order by SGD_EIT_NOMBRE";
	  $rs=$db->query($sql);
	  if (!$rs->EOF)$item41=$rs->fields["SGD_EIT_NOMBRE"];
	  $item4=explode('1',$item41);
	  if($item4[0]!=""){
	  ?>
	  <td class='titulos2'><?=$item4[0]?></td>
	  <TD >
	  <?
	  $sql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO
          from SGD_EIT_ITEMS
          where SGD_EIT_COD_PADRE like '".$btt->itemCodigo[$iItem]."'
          order by SGD_EIT_NOMBRE";
	  $rs=$db->query($sql);
    $iItem++;
	  print $rs->GetMenu2('exp_item22',$btt->itemCodigo[$iItem],true,false,""," onChange='submit()' class=select");

	  ?>
	  </TD>
	</tr>
	<? }
	// $sql="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$exp_item22' order by SGD_EIT_NOMBRE";
  $sql="select SGD_EIT_NOMBRE
        from SGD_EIT_ITEMS
        where SGD_EIT_COD_PADRE like '".$btt->itemCodigo[$iItem]."'
        order by SGD_EIT_NOMBRE";
	$rs=$db->query($sql);
	if (!$rs->EOF)$item51=$rs->fields["SGD_EIT_NOMBRE"];
	$item5=explode('1',$item51);
	?>
	<tr >
	<?
	if($item5[0]!=""){
      ?>
      <td class='titulos2'><?=$item5[0]?>
       </td>
      <TD >
      <?
      $sql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS
            where SGD_EIT_COD_PADRE like '".$btt->itemCodigo[$iItem]."'
            order by SGD_EIT_NOMBRE";
      $rs=$db->query($sql);
      $iItem++;
      print $rs->GetMenu2('exp_item31',$btt->itemCodigo[$iItem],true,false,""," onChange='submit()' class=select");

      ?>
      </TD>
      <? }
	$sql="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS
    where SGD_EIT_COD_PADRE like '".$btt->itemCodigo[$iItem]."'
    order by SGD_EIT_NOMBRE";
	$rs=$db->query($sql);
	if (!$rs->EOF)$item61=$rs->fields["SGD_EIT_NOMBRE"];
	$item6=explode('1',$item61);
	if($item6[0]!=""){
	?>
	<td class="titulos2" ><?=$item6[0]?>
	</td>
	<td >
	<?
	if($exp_entre=="" or $ent==2){
	if($item5[0]=="CAJA")$exp_entre=$exp_caja;
	  else $exp_entre=$exp_entrepa;
	  }
	  $sql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO
      from SGD_EIT_ITEMS
      where SGD_EIT_COD_PADRE like '".$btt->itemCodigo[$iItem]."' order by SGD_EIT_NOMBRE";
	  $rs=$db->query($sql);
    $iItem++;
	  print $rs->GetMenu2('exp_entre',$btt->itemCodigo[$iItem],true,false,"","onChange='submit()'  class=select");

	  ?>
	  </td>
	  <? }
	  $sql="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS
      where SGD_EIT_COD_PADRE like '".$btt->itemCodigo[$iItem]."'
      order by SGD_EIT_NOMBRE";
	  $rs=$db->query($sql);
    
	  if (!$rs->EOF)$item71=$rs->fields["SGD_EIT_NOMBRE"];
	  $item7=explode('1',$item71);
	  ?>
	  </tr>
	  <tr>
	  <?
	  if($item7[0]!=""){
	  ?>
	    <td class='titulos2' colspan="2" align="right"><?=$iItem;?><?=$item7[0]?> &nbsp;&nbsp;
	     </td>
	    <TD colspan="2" align="left">
	    <?
	    $sql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO
            from SGD_EIT_ITEMS
            where SGD_EIT_COD_PADRE like '".$btt->itemCodigo[$iItem]."' order by SGD_EIT_NOMBRE";
	    $rs=$db->query($sql);
      $iItem++;
	    print $rs->GetMenu2('exp_caja',$btt->itemCodigo[$iItem],true,false,""," class=select");

	    ?>
	    </TD>
	    <? }
	    ?>
	    </tr>

	    <?
	    if(!$exp_fechaIni) $exp_fechaIni = date("Y-m-d");
	    ?>
	    <tr class='titulos2'>
	    <td width="20%" class='titulos2' >Fecha Inicial </td>
	    <TD width="25%" >
	    <script language="javascript">
	   var dateAvailable1 = new ctlSpiffyCalendarBox("dateAvailable1", "form1", "exp_fechaIni","btnDate1","<?=$exp_fechaIni?>",scBTNMODE_CUSTOMBLUE);
	    dateAvailable1.date = "<?=date('Y-m-d');?>";
	    dateAvailable1.writeControl();
	    dateAvailable1.dateFormat="yyyy-MM-dd";
	  </script></td>
	  <? if($EST==2 or $exp_fechaFin!=""){?>
	  <td width="20%" class='titulos2' >Fecha Final&nbsp;&nbsp;&nbsp;</td>
	  <TD width="30%" >
	  <script language="javascript">
	  var dateAvailable3 = new ctlSpiffyCalendarBox("dateAvailable3", "form1", "exp_fechaFin","btnDate1","<?=$exp_fechaFin?>",scBTNMODE_CUSTOMBLUE);
	  dateAvailable3.date = "<?=date('Y-m-d');?>";
		  dateAvailable3.writeControl();
		  dateAvailable3.dateFormat="yyyy-MM-dd";
	  </script>
	  <? }?>
	  &nbsp;
	  </td>
	  </tr>
	  <tr>
	  <?
	  $sqlrad="select e.RADI_NUME_RADI,e.SGD_EXP_ESTADO,r.RADI_NUME_HOJA FROM SGD_EXP_EXPEDIENTE e, RADICADO r WHERE SGD_EXP_NUMERO LIKE '$num_expediente' and r.RADI_NUME_RADI=e.RADI_NUME_RADI";
	  if($exp_carpeta!="" and $car)$sqlrad.=" and e.SGD_EXP_CARPETA LIKE '$exp_carpeta'";
	  $sqlrad.=" ORDER BY e.RADI_NUME_RADI";
	  $rsrad=$db->query($sqlrad);
	  $j=1;
	  $exp_folio=0;
	  while(!$rsrad->EOF){
	    $fol[$j]=$rsrad->fields['RADI_NUME_HOJA'];
	    $esta[$j]=$rsrad->fields['SGD_EXP_ESTADO'];
	    if($esta[$j]==1)$exp_folio+=$fol[$j];
	    $rsrad->MoveNext();
	    $j++;
	  }
	  if($exp_folio>=200){
	  ?>
	  <script language="javascript">
	  confirm('Debe hacer el cambio de carpeta');
	  </script>
	  <? }
	  ?>
	  <td colspan="2" align="right" class='titulos2'>FOLIOS TOTAL:&nbsp; </td>
	  <TD colspan="2" align="left" class='titulos2'><?=$exp_folio?></TD>
	  </tr>
	  <tr>
    	  <td class='titulos2'colspan="4" align="center">ESTADO :</td></tr>
	  <TR>
	  <td class='titulos2' align="right">ABIERTO 
	  <td class='titulos2' align="left">
	  <?
	  if($EST == 1 or $EST==""){//$datoss = "checked"; else $datoss= "";
	  ?>
	  <h1>&nbsp;&nbsp;&nbsp;&nbsp;  X
	  </h1>
	  <? }?>
	  <td class='titulos2' align="right">CERRADO
	  <td class='titulos2' align="left">
	  <?
	  if($EST == 2 ){  //$datoss = " checked"; else $datoss= "";
	  ?>
	  <h1>&nbsp;&nbsp;&nbsp;&nbsp;   X
	  </h1>
	  <? }?>
	  </td></tr>
	  <td class='titulos2'colspan="4" align="center">UNIDAD DE CONSERVACION :</td></tr>
	  <TR>
	    <td class='titulos2'colspan="4" align="center">CAR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <?
	    if($UN == 1 ) $datoss = "checked"; else $datoss= "";
	    ?>
	    <input name="UN" type="radio" class="select" value="1" <?=$datoss?>>
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AZ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <?
	    if($UN == 2) $datoss = "checked"; else $datoss= "";
	    ?>
	    <input name="UN" type="radio" class="select" value="2" <?=$datoss?>>
				    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LB &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <?
	    if($UN == 3 ) $datoss = "checked"; else $datoss= "";
	    ?>
	    <input name="UN" type="radio" class="select" value="3" <?=$datoss?>>
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <?
	    if($UN == 4 ) $datoss = "checked"; else $datoss= "";
	    ?>
	    <input name="UN" type="radio" class="select" value="4" <?=$datoss?>></td></tr>
	    </tr>
	    <?
	    $querycar="select max(cast(sgd_exp_carpeta as int)) MAXI from sgd_exp_expediente where sgd_exp_numero like '$num_expediente'";
	    $rscar=$db->conn->Execute($querycar);
	    $carpetamax=$rscar->fields['MAXI'];
	    ?>
	    <tr><td class="titulos2" align="center" colspan="4"> 
	    No:<input type="text" name="exp_carpeta" value="<?=$exp_carpeta?>" size="3" maxlength="2" > DE <?=$carpetamax?>&nbsp;&nbsp;&nbsp;
	    <input type="submit" name="car" value=">>" class="botones_2"> </TD>
	    </tr>
	    <input type="hidden" name="carpe" value="<?=$exp_carpeta2?>">
	    <?
	    $sqlrad1="select e.RADI_NUME_RADI,e.SGD_EXP_ESTADO,r.RADI_NUME_HOJA FROM SGD_EXP_EXPEDIENTE e, RADICADO r WHERE SGD_EXP_NUMERO LIKE '$num_expediente' and r.RADI_NUME_RADI=e.RADI_NUME_RADI";
	      if($exp_carpeta!="" and $car)$sqlrad1.=" and e.SGD_EXP_CARPETA LIKE '$exp_carpeta'";
	      $sqlrad1.=" ORDER BY e.RADI_NUME_RADI";
	      //$db->conn->debug=true;
	      $rsrad=$db->query($sqlrad1);
	      $ce=1;
	      while(!$rsrad->EOF){
		$arrayRad[$ce]=$rsrad->fields['RADI_NUME_RADI'];
		$rsrad->MoveNext();
		$ce++;
	      }
	    ?>
	    <tr><td class='titulos2' align="center" colspan="4">ESTOS SON LOS RADICADOS INCLUIDOS EN ESTE EXPEDIENTE:</tr>
	    <tr><td class='titulos2' align="center" colspan="2">Radicado</td>
	    <td class='titulos2' align="center" >Folios </td>
	    <td class='titulos2' align="center" >Incluir </td>
	    </tr>
	    <?
	    
	    $p=3;
	    for($t=1;$t<$ce;$t++){
	      ?>
	      <tr><td class='titulos2' align="center" colspan="2"><?=$arrayRad[$t]?></td>
	      <? if ($esta[$t]=='1' or $arrayRad[$t]==$nurad)$st="checked"; else $st="";
	      if($fol[$t]=="")$fol[$t]=0;
	      ?>
	    <td class='titulos2' align="center" ><input type="text" class="titulos2" value="<?=$fol[$t]?>" name="fol[<?=$t?>]" maxlength="4" size="5">
	    <td class='titulos2' align="center" ><input name="inclu[<?=$t?>]" type="checkbox" class="select" value="<?=$p?>" <?=$st?>>
	    </tr>
	    <?
	    $arrayRad3[$t]=$arrayRad[$t];
	    $p++;
	    }
		  
	  ?>
	  <tr><td>&nbsp;</td></tr>
	<TR>

  <?

  if($exp_estado==0 or $permiso>=1){
  ?>
  
  <td colspan="4" align="center"><input type=submit value=Archivar name=Archivar class="botones">&nbsp;</td>
  <?
  if($Grabar){$exp_archivo=$EST;
  $exp_unidad=$UN;$exp_rete=$exp_retenci;
  $arrayRad3=$arrayRad;
  }
  }?> <BR>
  </tr>
  <tr><td colspan="4"></td> </tr>
  <TR class='titulos2'  >
    <TD  colspan="4"><p>
    </TD>
  </table>	<td></td>
  <tr><td colspan="4"></td></tr>
  <table><tr><td></td></tr></table>
  </TR>
</table>
</form>
<table border=0 cellspace=2 cellpad=2 WIDTH=98% class='t_bordeGris' align='center'>
<tr align="center">
<td>&nbsp; </td>
</tr></table>
</td></tr></table>


<br>
<?

//    	  $row = array();
}
else
{
			     ?> <form name='form1' action='../enviar.php' method=post>
<?
  echo "<input type=hidden name=depsel>";
  echo "<input type=hidden name=depsel8>";
  echo "<input type=hidden name=carpper>";
  echo "</form>";
  echo "<form action='usuarionuevo.php' method=post name=form2>";
  // Si es un usuario nuevo pide la nueva contrasea.
  if($rs->fields["USUA_NUEVO"]=="0")
  {
    echo "<center><B>USUARIO NUEVO </CENTER>";
    echo "<P><P><center>Por favor introduzca la nueva contrasea<p></p>";
    echo "<CENTER><input type=hidden name='usuarionew' value=$krd><B>USUARIO $krd<br></p>";
    echo "<table border=0>";
    echo "<tr>";
    echo "<td><center>CONTRASE  </td><td><input type=password name=contradrd vale=''><br></td>";
    echo "</tr>"				 ;
    echo "<tr><td><center>RE-ESCRIBA LA CONTRASE  </td><td><input type=password name=contraver vale=''></td>";
    echo "</tr>";
    echo "</table></p></p>";
    echo "";
    echo "";
    echo "<center>Seleccione la dependencia a la cual pertenece \n";
    $isql = "select depe_codi,depe_nomb from DEPENDENCIA ORDER BY DEPE_NOMB";
    $rs1 = $db->query($isql);
    $numerot = $rs1->RecordCount();
    echo "<br><b><center>Dependencia <select name='depsel' class='e_buttons'>\n";
    $dependencianomb=substr($dependencianomb,0,35);
    echo "<option value=$dependencia>$dependencianomb</option>\n";
    do
    {
       $depcod = $rs1->fields["DEPE_CODI"];
       $depdes = substr($rs1->fields["DEPE_NOMB"],0,35);
       echo "<option value=$depcod>$depdes</option>\n";
     }while(!$rs1->EOF);
  echo "</select>";
  echo "<br><input type=submit value=Aceptar>";
  ?>
</form> <?

  }else{echo "<input type=hidden name=depsel>";
   echo "<input type=hidden name=carpper>";
  }
  }
}
else
  {
    ?><form name='form1' action='../enviar.php' method=post>
 <div align="center">
   <input type=hidden name=depsel>
   <input type=hidden name=depsel8>
   <input type=hidden name=carpper>
   <span class='etextou'>NO TIENE AUTORIZACION PARA INGRESAR</span><BR>
   <span class='eerrores'><a href='../login.php' target=_parent><span class="textoOpcion">Por
   Favor intente validarse de nuevo. Presione aca !</span></a></span> </div>
</form>
  <?
   }
 ?>
 <br>

 <form name=jh >
 <input type=hidDEN name=jj value=0>
  <input type=hidDEN name=dS value=0>
 </form>
</body>
</html>
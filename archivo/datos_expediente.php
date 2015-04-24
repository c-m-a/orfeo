<?
session_start();

if (!$ruta_raiz) $ruta_raiz = "..";
if (!$_SESSION['dependencia']) header ("Location: $ruta_raiz/cerrar_session.php");

/**
* Pagina excluirExpediente.php que muestra el contenido de las Carpetas
* Modificado por Correlibre.org en el año 2012
* Se añadio compatibilidad con variables globales en Off
* @autor Jairo Losada 2012-05
* @licencia GNU/GPL V 3
*/

foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

define('ADODB_ASSOC_CASE', 1);

$krd            = $_SESSION["krd"];
$dependencia    = $_SESSION["dependencia"];
$usua_doc       = $_SESSION["usua_doc"];
$codusuario     = $_SESSION["codusuario"];

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$db = new ConnectionHandler($ruta_raiz);
$objHistorico= new Historico($db);
//$db->conn->debug = true;
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
if($_GET["nurad"]) $nurad = $_GET["nurad"];
?>
<HTML>
<HEAD>
<META http-equiv="Cache-Control" content="cache">
<META http-equiv="Pragma" content="public">
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
<div id="spiffycalendar" class="text"></div>
 <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
 <script type="text/javascript" src="../js/tabber.js"></script> 
 <link rel="stylesheet" href="../estilos/tabber.css" TYPE="text/css" MEDIA="screen">
 <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js"></script>
  <script>
  function Etiquetas(numeroExpediente) {
  window.open("<?=$ruta_raiz?>/expediente/etiquetas.php?&numeroExpediente=" + numeroExpediente +
          "&numRad=<?=$nurad?>&krd=<?=$krd?>&coddepe=<?=$coddepe?>&codusua=<?=$codusua?>","Etiquetas","height=300,width=450");
  }
  </script>
</HEAD>

<body bgcolor="#FFFFFF" topmargin="0" >
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
    //$isql = "select * From usuario where  USUA_LOGIN ='$krd' and USUA_SESION='". substr(session_id(),0,29)."' ";
    
    //$rs=$db->query($isql);
    // Validacion de Usuario y COntrasea MD5
    //echo "** $krd *** $drde";
  if ($krd)
      {
      $nombusuario =$rs->fields["USUA_NOMB"];
      $contraxx=$rs->fields["USUA_PASW"];
      $permiso=$rs->fields["USUA_ADMIN_ARCHIVO"];
      $nivelus=$rs->fields["CODI_NIVEL"];
      // $codusuario=$rs->fields["USUA_CODI"];


      if(!$lashdflasdf){
	      $carpeta=200;
	$nomcarpeta = "UBICACI&Oacute;N EXPEDIENTE";
	include "../envios/paEncabeza.php";
?>
  <form name='form1' method="POST" action='datos_expediente.php?<?=session_name()."=".session_id()."&krd=$krd&fechah=$fechah&nurad=$nurad&num_expediente=$num_expediente&exp_fechaFin=$exp_fechaFin&exp_fechaIni=$exp_fechaIni&exp_archivo=$exp_archivo&exp_unicon=$exp_unicon&item3=$item3&item4=$item4&item5=$item5&car=$car&exp_carpeta2=$exp_carpeta2 "?>' >
  <TABLE width="100%" align="center" cellspacing="1" cellpadding="0" class="borde_tab">
    <tr>
	  <TD class='titulos2' height="58">
	  <table BORDER=0  cellpad=1 cellspacing='2' WIDTH=100% class='t_bordeGris' valign='top' align='center' cellpadding="1" >
	    <tr><td class='titulos2'>Radicado No <b><?=$nurad?></b> Perteneciente al expediente No <b><?=$num_expediente?></b></td>
    <?php
	  $ruta_raiz = "..";
	  require "$ruta_raiz/class_control/class_control.php";
	  $btt = new CONTROL_ORFEO($db);
	  //$db->conn->debug = true;
    
   //$grabar = "";
 
  if($expItem1)                  {  $exp_caja= $expItem1; if($expItem1!=$expItem1Ant){$grabar= "No";  }    }
  if($expItem2 && $grabar!= "No"){  $exp_caja = $expItem2;  if($expItem2 !=$expItem2Ant ){$grabar= "No";}}
  if($expItem3 && $grabar!= "No"){  $exp_caja = $expItem3;  if($expItem3 !=$expItem3Ant ){$grabar= "No";}}
  if($expItem4 && $grabar!= "No"){  $exp_caja = $expItem4;  if($expItem4 !=$expItem4Ant ){$grabar= "No";}}
  if($expItem5 && $grabar!= "No"){  $exp_caja = $expItem5;  if($expItem5 !=$expItem5Ant ){$grabar= "No";}}
  if($expItem6 && $grabar!= "No"){  $exp_caja = $expItem6;  if($expItem6 !=$expItem6Ant ){$grabar= "No";}}
  if($expItem7 && $grabar!= "No"){  $exp_caja = $expItem7;  if($expItem7 !=$expItem7Ant ){$grabar= "No";}}
  if($expItem8 && $grabar!= "No"){  $exp_caja = $expItem8;  if($expItem8 !=$expItem8Ant ){$grabar= "No";}}
  if($expItem9 && $grabar!= "No"){  $exp_caja = $expItem9;  if($expItem9 !=$expItem9Ant ){$grabar= "No";}}
  if($expItem10 && $grabar!= "No"){  $exp_caja= $expItem10; if($expItem10!=$expItem10Ant){$grabar= "No";}}
  if($expItem11 && $grabar!= "No"){  $exp_caja= $expItem11; if($expItem11!=$expItem11Ant){$grabar= "No";}}
  if($expItem12 && $grabar!= "No"){  $exp_caja= $expItem12; if($expItem12!=$expItem12Ant){$grabar= "No";}}
  if($expItem13 && $grabar!= "No"){  $exp_caja= $expItem13; if($expItem13!=$expItem13Ant){$grabar= "No";}}
  if($expItem14 && $grabar!= "No"){  $exp_caja= $expItem14; if($expItem14!=$expItem14Ant){$grabar= "No";}}
  if($grabar=="No") $Archivar = "Nueva U";

	  if($Archivar)
	  {
	    $observa = " Almacenado en Fisico ";
	    $observa2 = " Almacenado en Fisico del radicado ".$numrad;
	    $sqlrad="select RADI_NUME_RADI FROM SGD_EXP_EXPEDIENTE
                WHERE SGD_EXP_NUMERO LIKE '$num_expediente' AND SGD_EXP_ESTADO <> 2
                order by RADI_NUME_RADI";
	    $rsrad=$db->query($sqlrad);
	    $j=1;
	    if (!$exp_piso2) $exp_piso2=0;
	    $sqm="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo = '$exp_piso2'";
      //$db->conn->debug = true;
	    $rs=$db->conn->Execute($sqm);
	    $exp_piso=$exp_piso2;
	    
	    while(!$rsrad->EOF){
        $arrayRad[$j]=$rsrad->fields['RADI_NUME_RADI'];
        $j++;
        $rsrad->MoveNext();
	    }
	    $sqlrad3="select e.RADI_NUME_RADI,e.SGD_EXP_ESTADO,r.RADI_NUME_HOJA
      , e.SGD_EXP_CARPETA FROM SGD_EXP_EXPEDIENTE e, RADICADO r
      WHERE SGD_EXP_NUMERO = '$num_expediente' and r.RADI_NUME_RADI=e.RADI_NUME_RADI AND e.SGD_EXP_ESTADO <> 2";
      
	    //if($exp_carpeta!="" and $car) $sqlrad3.=" and e.SGD_EXP_CARPETA LIKE '$carpe'";
	    $sqlrad3.=" ORDER BY e.SGD_EXP_CARPETA ,e.RADI_NUME_RADI";
    
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

// Aqui se accede a la clase class_control para actualizar expedientes.
  if($exp_fechaFin<=date("Y-m-d h:i:s")){
  
  $res=$btt->modificar_expediente($arrayRad2[1],
	$num_expediente,
	$exp_titulo,
	$exp_asunto,
	$exp_item1,
	$exp_piso,
	$exp_caja,
	$exp_estante,
	$exp_carpeta,
	$exp_subexpediente,
	$EST,	
	$UN,
	$exp_fechaIni,
	$exp_fechaFin,
	$exp_folio,
	$exp_rete,$exp_entrepa,$exp_edificio2,$krd,$exp_carro,' ',' ');
   
  $sqm="update radicado set RADI_NUME_HOJA='$fo' where cast(radi_nume_radi as varchar(20)) like '$arrayRad2[1]'";

  $rst=$db->query($sqm);
  }else echo "La fecha final esta incorrecta";
  }else{
    //if($exp_fechaFin<=date("Y-m-d")){
    $i=1;$k=3;
   while($i<=$cont){
      //$exp_fechaIni = "0";
    if($inclu[$i]==$k){
      
      $res=$btt->modificar_expediente($arrayRad2[$i],$num_expediente,
      $exp_titulo,$exp_asunto,$exp_item1,$exp_piso,$exp_caja,$exp_estante,$exp_carpeta,
      $exp_subexpediente,$EST,$UN,$exp_fechaIni,$exp_fechaFin,$exp_folio,$exp_rete,$exp_entrepa,$exp_edificio2
      ,$krd,$exp_carro,'','');
      $sqm="update radicado set RADI_NUME_HOJA=$fol[$i] where radi_nume_radi = '$arrayRad2[$i]'";
      $rst=$db->query($sqm);
    }
     $i++;$k++;
    }
    //}
    //else echo "La fecha final esta incorrecta";

  }
  if($exp_caja){
    $iSql = " UPDATE SGD_EXP_EXPEDIENTE
                set SGD_EXP_CAJA=$exp_caja, SGD_EXP_ESTADO=1
              WHERE SGD_EXP_NUMERO='$num_expediente'";
     //$db->conn->debug = true;
     $resultadoGen = $db->conn->query($iSql);
     //$db->conn->debug = true;
     if($resultadoGen) {
      echo ".. Ubicacion Grabada corectamente ..";
     }else{
      echo ".. No grabo ubicacion ..";
     }
     
  }

  if ($res == false){
    echo '.. No actualizo Radicados en Carpetas ..';
  }else{
  echo " .. Datos de radicados Grabados Correctamente ..";
//$this->db->conn->debug=true;
  $objHistorico->insertarHistorico($arrayRad,$dep_sel ,$codusuario, $dep_sel,$codusuario, $observa, 57);
//
  }

//$objHistorico->insertarHistoricoExp($num_expediente,$arrayRad,$dep_sel ,$codusuario, $observa2, 57,1);
    }
    //if($ent==1){



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
    //  $resultadoBtt = $btt->datosUbicacionExpediente($btt->exp_caja);
      if ($exp_item1!="")$u=explode($exp_piso,$exp_item1);
      else $u[1]="";
      $exp_item11=$u[1];
      $ent++;
     // }
    //$permiso = $btt->permiso;
    //if(!trim($numcarpetas)) $numcarpetas=$exp_carpeta;

    $queryUs = "select SGD_SEXP_PAREXP1,SGD_SEXP_PAREXP2,SGD_SEXP_PAREXP3,SGD_SEXP_PAREXP4,SGD_SEXP_PAREXP5 from
    SGD_SEXP_SECEXPEDIENTES where SGD_EXP_NUMERO='$num_expediente' order by sgd_exp_caja desc";
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


    ?>

	</tr>
	</TABLE>
      </td>
    </tr>
    <tr>
    <td class=listado2>
      <table width="80%" height="99%" cellspacing="1"  align="center" class="borde_tab" >
      <tr valign="bottom" >
	<TD class='titulos2'><?=$etiquetas?></td>
	  </tr>
	 <TR class='titulos2'>
	 <TD colspan="3">
    <? // parametrizacion de items
    if (!$exp_caja) $exp_caja=0;
    
    $sql="select SGD_EIT_NOMBRE, SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_CODIGO = '$exp_caja'";
    $rs=$db->query($sql);
    $item1=$rs->fields["SGD_EIT_NOMBRE"];
    $cod1=$rs->fields["SGD_EIT_CODIGO"];
    ?>
    <table width="90%" border="0" cellspacing="0" cellpadding="0" align="center" class="borde_tab"  >
	<tr valign="bottom" class='titulos2'>
	<td class="titulos2">DEPARTAMENTO
	<td class="titulos2" >
	  <?
	  if ($codDpto!="") {
      $codDpto2=$codDpto;
    }elseif($btt->itemDptoCodi){
      $codDpto2 = $btt->itemDptoCodi;
    }elseif($codDpto2){
      $codDpto2 = 11;
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
	  <td class="titulos2" colspan=2>
	  <? 
	  if ($codMuni!=""){
       $codMuni2=$codMuni;
      }elseif($btt->itemMuniCodi){
       $codiMuni=0;
       $codMuni2 = $btt->itemMuniCodi;
    }
     if(!$codDpto2) $codDpto2=0;
	  $queryMuni = "select distinct(m.MUNI_NOMB),m.MUNI_CODI
                  FROM MUNICIPIO m, SGD_EIT_ITEMS i
                  WHERE m.MUNI_CODI=i.CODI_MUNI and DPTO_CODI=$codDpto2 AND ID_PAIS=170
                  ORDER BY MUNI_NOMB";
	  $rsm=$db->query($queryMuni);
    if($rsm){
	    print $rsm->GetMenu2("codMuni2", $codMuni2, "0:-- Seleccione --", false,""," onChange='submit()' class='select'" );
    }
	  ?>
	  </td>
	  </tr>
  <?
  
  
    $iItem=1;
    $itemCount = $btt->itemCount + 1;
    $col =0;
  ?>
   <TR class='titulos2'>
  <?
    while($iItem<=$itemCount or ($codMuni2 && $iItem==1)){
      
  ?>
	 <TD class='titulos2'>
      <?
        $itemNombreL = "";
        if($iItem ==1 ) $itemNombreL = "Edificio";
        if($iItem ==2 ) $itemNombreL = "Piso";
        //if($iItem ==1 ) $itemNombreL = "Edificio";
      ?>
      <?=$itemNombreL?> 
       </TD>
      <TD >
      <?
      // echo "A".$btt->itemCodigo[$iItem]."<br>";
      // echo "A Padre".$btt->itemCodigoPadre[$iItem]."<br>";
      // echo "Anterior > $itemCodigoAnt<br>$iItem";
      if(!$codMuni2) $codMuni2=0;
      $itemCodigoPadre = $btt->itemCodigoPadre[$iItem];
      if(!$itemCodigoPadre) $itemCodigoPadre = $itemCodigoAnt;
      if(!$itemCodigoPadre && $iItem==1) {
          $itemCodigoPadre = 0;
          $whereInicio = " AND CODI_MUNI=$codMuni2 AND CODI_DPTO=$codDpto2 ";
          
      }else{
        $whereInicio="";
      }
      if($iItem>=2) $itemCodigo = $btt->itemCodigoPadre[$iItem]; else $itemCodigo = $btt->itemCodigo[$iItem];
      $sql="select SGD_EIT_NOMBRE, SGD_EIT_CODIGO, SGD_EIT_COD_PADRE from SGD_EIT_ITEMS
              where SGD_EIT_COD_PADRE = '$itemCodigoPadre'
              $whereInicio
              order by SGD_EIT_NOMBRE ";
      //$db->conn->debug = true;
      $rs=$db->query($sql);
      //$db->conn->debug = false;
      $itemCodigoAnt = $btt->itemCodigo[$iItem];
      $nombreSelectItem = "expItem". $iItem;
      if($rs){
       print $rs->GetMenu2($nombreSelectItem,$btt->itemCodigo[$iItem],true,false,""," onChange='submit()' class=select");
       echo "<input type=hidden name='".trim($nombreSelectItem)."Ant'  value='".$btt->itemCodigo[$iItem]."' >";
      }
      $iItem++;
      $col++;
      if($col==3)
      {
        $col=0;
        ?>
        </td></tr><TR class='titulos2'>
        <?
        
      }else{
        ?>
	  </TD>
	
	<?
        
      }
  
 
   
  } // fin de While (itemCOunt) qeu recorre el arreglo de ItEM'S
  ?>
  </TR>
  <?
	// $sql="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$exp_item22' order by SGD_EIT_NOMBRE";
  $sql="select SGD_EIT_NOMBRE
        from SGD_EIT_ITEMS
        where SGD_EIT_COD_PADRE = '".$btt->itemCodigo[$iItem]."'
        order by SGD_EIT_NOMBRE";
	$rs=$db->query($sql);
	if (!$rs->EOF)$item51=$rs->fields["SGD_EIT_NOMBRE"];
	$item5=explode('1',$item51);

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
	  $sqlrad="select e.RADI_NUME_RADI,e.SGD_EXP_ESTADO,r.RADI_NUME_HOJA, e.SGD_EXP_CARPETA
               FROM SGD_EXP_EXPEDIENTE e, RADICADO r
               WHERE SGD_EXP_NUMERO LIKE '$num_expediente' and r.RADI_NUME_RADI=e.RADI_NUME_RADI
			    AND E.SGD_EXP_ESTADO =1";
	  //if($exp_carpeta!="" and $car)$sqlrad.=" and e.SGD_EXP_CARPETA LIKE '$exp_carpeta'";
	  $sqlrad.=" ORDER BY e.sgd_exp_carpeta, e.RADI_NUME_RADI";  
	  $rsrad=$db->query($sqlrad);
	  $j=1;
	  $exp_folio=0;
	  $carpetaOld=$rsrad->fields['SGD_EXP_CARPETA'];
	  while(!$rsrad->EOF){
	    $fol[$j]=$rsrad->fields['RADI_NUME_HOJA'];
	    $esta[$j]=$rsrad->fields['SGD_EXP_ESTADO'];
        $carpeta[$j]=$rsrad->fields['SGD_EXP_CARPETA'];
	    if($esta[$j]==1) $noHojasXCarpeta+=$fol[$j];
		
    	if($noHojasXCarpeta>=201 and $carpetaOld!=$carpeta[$j]){
		
	    ?>
	     <script language="javascript">
	      confirm('Debe hacer el cambio de carpeta '+<?=$carpeta[$j]?>+'. Numero de Folios:'+<?=$noHojasXCarpeta?>);
	     </script>
	    <? 
		   $noHojasXCarpeta = 0; 
		}
		$carpetaOld = $carpeta[$j];
		$rsrad->MoveNext();
		$j++;
	  }
	  	if($noHojasXCarpeta>=201){
		
	    ?>
	     <script language="javascript">
	      confirm('Debe hacer el cambio de carpeta '+<?=$carpeta[$j]?>+'. Numero de Folios:'+<?=$noHojasXCarpeta?>);
	     </script>
	    <? 
		}
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
	  if($EST == 1 or $EST=="")$datoss = "checked"; else $datoss= "";
	  ?>
	  <h1>&nbsp;&nbsp;&nbsp;&nbsp;  X
	  </h1>
	  <? }?>
	  <td class='titulos2' align="right">CERRADO
	  <td class='titulos2' align="left">
	  <?
	  if($EST == 2 ) $datoss = " checked"; else $datoss= "";
	  ?>
	  <h1>&nbsp;&nbsp;&nbsp;&nbsp;   X
	  </h1>
	  <? }?>
	  </td></tr>
	  <td class='titulos2' colspan="4" align="center">UNIDAD DE CONSERVACION :</td></tr>
	  <TR>
	    <td class='titulos2' colspan="4" align="center">CAR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
	    $querycar="select max(sgd_exp_carpeta) MAXI from sgd_exp_expediente where sgd_exp_numero like '$num_expediente'";
	    $rscar=$db->conn->Execute($querycar);
	    $carpetamax=$rscar->fields['MAXI'];
	    ?>
	    <input type="hidden" name="carpe" value="<?=$exp_carpeta2?>">
	    <?
	    $sqlrad1="select e.RADI_NUME_RADI,e.SGD_EXP_ESTADO,r.RADI_NUME_HOJA, e.SGD_EXP_CARPETA, r.RA_ASUN
         FROM SGD_EXP_EXPEDIENTE e, RADICADO r
         WHERE SGD_EXP_NUMERO LIKE '$num_expediente'
            AND r.RADI_NUME_RADI=e.RADI_NUME_RADI AND e.SGD_EXP_ESTADO <> 2";
	      //if($exp_carpeta!="" and $car)$sqlrad1.=" and e.SGD_EXP_CARPETA LIKE '$exp_carpeta'";
	      $sqlrad1.=" ORDER BY e.SGD_EXP_CARPETA ,e.RADI_NUME_RADI";
	      //$db->conn->debug=true;
	      $rsrad=$db->query($sqlrad1);
	      $ce=1;
        $carpeta = array();
        $foliosXCarpeta = array();
        $docsXCarpeta = array();
	      while(!$rsrad->EOF){
         $arrayRad[$ce]=$rsrad->fields['RADI_NUME_RADI'];
         $carpeta[$ce] = $rsrad->fields['SGD_EXP_CARPETA'];
         $asunto[$ce] = $rsrad->fields['RA_ASUN'];
         $foliosXCarpeta[$carpeta[$ce]] += $rsrad->fields['RADI_NUME_HOJA'];
         $docsXCarpeta[$carpeta[$ce]]++;
         $rsrad->MoveNext();
         $ce++;
	      }
	    ?>
	    
     </table>
    </table></table></table></div>
        
    <div class="tabber">
    <?
	    $p=3;
      $estiloCarpeta = $carpeta[1];
      //if(!$carpeta[1]) $carpeta[1] = 0;
      //$nuevoEstiloCarpeta = $carpeta[1];
      $k=1;
      $nuevoEstiloCarpeta = 999;
	    for($t=1;$t<$ce;$t++){
        if(!$carpeta[$t]) $carpeta[$t] =0;
        $estiloCarpeta = $carpeta[$t];
        //echo "<hr> $estiloCarpeta!=$nuevoEstiloCarpeta <hr>";
        if($estiloCarpeta!=$nuevoEstiloCarpeta) {
          $estiloC = "listado1";
            $k++;
            if($t>=2) {echo "</table></div>";}
            ?>
              <div class="tabbertab">
              <?
              if($carpeta[$t]==0 or !trim($carpeta[$t])){
              ?>
              <H3><font color=red>Sin Carpeta Asignada (<?=$foliosXCarpeta[$carpeta[$t]]?>Folios)</font></h3>
              <?
              }else{
              ?>
              <h3>C<?=$carpeta[$t]?> (<?=$foliosXCarpeta[$carpeta[$t]]?>Folios)</h3>
              <?
              }
              ?>
              <table width="80%" class=borde_tab><tr>
              <td class=titulos2><b>Carpeta No <?=$carpeta[$t]?></td>
              <td class=titulos2>Numero de Documentos:</td>
              <td><?=$docsXCarpeta[$carpeta[$t]]?> </td>
              <td class=titulos2>Numero de Folios o Paginas</td>
              <td><?=$foliosXCarpeta[$carpeta[$t]]?></b>
              </td>
              </tr>
              </table>
              <table width="100%" class=borde_tab>
                <tr><td class='titulos2' align="center" colspan="2">Radicado</td>
                <td class='titulos2' align="center" colspan=2>Folios </td>
                <td class='titulos2' align="center" colspan=2>Incluir </td>
                <td class='titulos2' align="center" colspan=2>No Carpeta </td>
                <td class='titulos2' align="center" colspan="2">Asunto</td>  
                </tr>
             <?
             }else{ $estiloC="listado2";}
	      ?>   
                  <tr class='<?=$estiloC?>'>
          
                  <td  align="center" colspan="2">
                  <?
                  if($arrayRad[$t]==$nurad) echo "<font color=red>";
                  ?>
                  
                  <?=$arrayRad[$t]?>
                  </td>
                   <? if ($esta[$t]=='10000' or $arrayRad[$t]==$nurad9)$st="checked"; else $st="";
                   if($fol[$t]=="")$fol[$t]=0;
                   ?>
                  <td align="center" colspan=2><input type="text" class="titulos2" value="<?=$fol[$t]?>" name="fol[<?=$t?>]" maxlength="4" size="5"></TD>
                  <td align="center" colspan=2><input name="inclu[<?=$t?>]" type="checkbox" class="select" value="<?=$p?>" <?=$st?>></TD>
                  <td align="center" colspan=2><?=$carpeta[$t]?></TD>
                  <td  align="left" colspan="2"><?=$asunto[$t]?></td>
                  </tr>
	    <?
	    $arrayRad3[$t]=$arrayRad[$t];
	    $p++;
      $nuevoEstiloCarpeta = $carpeta[$t];
	    }
		  
	  ?>
    </table>
    </div>
    </div>


    
        
  <table width=90%>          
	<TR>

  <?
  echo "***> $exp_carpeta <<< $exp_estado ==0 or $permiso >=1";
  //if($exp_estado==0 or $permiso>=1){
  if($exp_caja and $exp_caja !=0){
  ?>
  
  <td colspan="4" align="center">
    Archivar a Carpeta No<input type="text" name="exp_carpeta" size="3" maxlength="2" ><input type=submit value=Archivar name=Archivar class="botones">&nbsp;</td>
  <?
  }else{
      echo "<span class=titulos2>Para Grabar en una Carpeta debe Primero Seleccionar la Ubicacion.</span>";
  }
  if($Grabar){
    
    $exp_archivo=$EST;
    $exp_unidad=$UN;$exp_rete=$exp_retenci;
    $arrayRad3=$arrayRad;
  }
  //}
  ?>
  </tr>
</table>
</form>
</body>
</html>

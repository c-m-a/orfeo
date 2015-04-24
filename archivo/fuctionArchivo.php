<?php
/**
*  @name :   funtionArchivo.php
*  @desc :   Genera combos de la ubicacion.
*  @author  :  Hardy  Deimont Niño Velasquez.
*  @version 0.1
*/
	
  $ruta_raiz = "..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$db = new ConnectionHandler($ruta_raiz);
$objHistorico= new Historico($db);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
//print_r($_GET);
//titulo
if($_GET['action']=='titulo'){
	$titulo=$_GET['titulo'];
	$nExp=$_GET['nExp'];
	//echo $sql= 'update sgd_exp_expediente set sgd_exp_titulo="'.$titulo.'" where sgd_exp_numero="'.$nExp.'"';
	 $sql= "update sgd_exp_expediente set sgd_exp_titulo='$titulo' where sgd_exp_numero='$nExp'";
  echo "<input type=text class='tex_area' size='50' name='tituloNombre' id='tituloNombre' value='$titulo' id='titulo' >";
  $rs=$db->conn->Execute($sql);

  	
}



if($_GET['action']=='muni'){
    ?><select  class='select' id="mun" name="codMuni2" onchange="edi()"><option>-- Seleccione --</option><?
	 echo       municipio($db,$_GET['depto']);
		  	?></select><?
}

if($_GET['action']=='edificio'){
?><select class='select' id="exp_edificio2" name="exp_edificio2" onchange="piso('piso')"><option>-- Seleccione --</option><?
          echo       edificio($db,$_GET['depto'],$_GET['muni'],$_GET['coddep']);
		  	?></select><?
}
if($_GET['action']=='piso'){
    ?><select class='select' id="Piso" name="exp_piso2" onchange="wait('wait','Piso',1)"><option>-- Seleccione --</option><?
          echo       piso($db,$_GET['padre']);
		  	?></select> <?
}

if($_GET['action']=='wait'){
		if($_GET['pos']==NULL || $_GET['pos']==1){
           $nombre=wait($db,$_GET['padre']);
		   if($nombre[1]==Null){
		 //  echo $_GET['padre'];
?><input type="hidden" name="exp_entre" value="<? echo $_GET['padre']; ?>">
<input type="hidden" name="exp_caja" value="<? echo $_GET['padre']; ?>">
<?
		   }
		   else{
	//	   echo $_GET['padre'];
			?>
			<table width="100%" cellpadding="0" cellspacing="0"  >
				<tr>
			     <td width="25%" class='titulos2'><? echo $nombre[1];?></td><td width="25%" class='titulos2'><select class='select' id="<? echo $nombre[1];?>" name="<? echo $nombre[1] ;?>" onchange="wait('<? echo $nombre[1];?>Div','<? echo $nombre[1];?>','2',<? echo $_GET['con']+1;?>)"><option>-- Seleccione --</option><?
		          echo      $nombre[0];
			  	?></select> </td><td   width="50%" class='titulos2'> 
			<div id="<? echo $nombre[1] ;?>Div"></div></td>
  			</tr> </table>
			<div  id="waitDiv<? echo $_GET['con']+1;?>"></div><?
			}
		}
    else{
	   $nombre=wait($db,$_GET['padre']);
	   		   if($nombre[1]==Null){
		  // echo $_GET['padre'];
?><input type="hidden" name="exp_entre" value="<? echo $_GET['padre']; ?>">
<input type="hidden" name="exp_caja" value="<? echo $_GET['padre']; ?>"><?
		   }
		   else{		   
	?> <table cellpadding="0" cellspacing="0"  width="100%"><TR><TD class='titulos2' width="50%"><? echo $nombre[1]; ?></TD><TD width="50%"><select  id="<? echo $nombre[1];?>" name="<? echo $nombre[1] ;?>" class='select' onchange="wait('waitDiv<? echo $_GET['con'];?>','<? echo $nombre[1];?>',1,<? echo $_GET['con']+1;?>)"><option>-- Seleccione --</option><?
		          echo      $nombre[0];
			  	?></select></TD></TR></TABLE>  <?
	}
	}
}
if($_GET['action']=='mod'){
include("ubicacionArchivo.php");



}


/**
* @autor Hardy Deimont Ni�o Velasquez
* Funtion Ubicacion
* @param $db coneccion base de datos
* @param $codigo codigo  selecionado
* @param $padre codigo del padre para crear el  combo

*/
function municipio($db,$codigo){
//$sql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE = '$padre' order by SGD_EIT_NOMBRE";
//$db->query
$query= "select distinct(m.MUNI_NOMB),m.MUNI_CODI FROM MUNICIPIO m , SGD_EIT_ITEMS i WHERE m.MUNI_CODI=i.CODI_MUNI and DPTO_CODI='$codigo' ORDER BY MUNI_NOMB";
			$rs=$db->query($query);
		while (!$rs->EOF) {
              $option.="<OPTION value=\"".$rs->fields["MUNI_CODI"]."\">".$rs->fields["MUNI_NOMB"]."</OPTION>";
			 $rs->MoveNext();  
			 }
     return $option;
}

/**
 * Funcion que busca el Edificio .
 *
 * @param  $db variable dase de datos
 * @param entero $codigo variable
 * @return String
 */
function edificio($db,$codiDepto,$codiMuni,$coddep){
 //$query= "select SGD_EIT_SIGLA,SGD_EIT_CODIGO from SGD_EIT_ITEMS where CODI_MUNI = '$codiMuni' 	and CODI_DPTO = '$codiDepto' order by SGD_EIT_NOMBRE";
 $query= "select i.SGD_EIT_SIGLA,i.SGD_EIT_CODIGO from SGD_EIT_ITEMS  i,sgd_arch_depe arch where i.CODI_MUNI = '$codiMuni' 	and i.CODI_DPTO = '$codiDepto' and i.SGD_EIT_CODIGO= arch.sgd_arch_edificio and arch.sgd_arch_depe = $coddep order by i.SGD_EIT_NOMBRE";
			$rs=$db->query($query);
		while (!$rs->EOF) {
              $option.="<OPTION value=\"".$rs->fields["SGD_EIT_CODIGO"]."\">".$rs->fields["SGD_EIT_SIGLA"]."</OPTION>";
			 $rs->MoveNext();  
			 }
     return $option;
}

/**
 * Funcion que busca el piso .
 *
 * @param  $db variable dase de datos
 * @param entero $codigo variable
 * @return String
 */
function piso($db,$codigo){
 $query= "select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE = '$codigo' order by SGD_EIT_NOMBRE";
			$rs=$db->query($query);
		while (!$rs->EOF) {
              $option.="<OPTION value=\"".$rs->fields["SGD_EIT_CODIGO"]."\">".$rs->fields["SGD_EIT_NOMBRE"]."</OPTION>";
			 $rs->MoveNext();  
			 }
     return $option;
}

/**
 * Funcion que busca la siguiente ubucacion.
 *
 * @param  $db variable dase de datos
 * @param entero $codigo variable
 * @return String
 */
function wait($db,$codigo){
            $query= "select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE = '$codigo' order by SGD_EIT_NOMBRE";
			$rs=$db->query($query);
			$son=explode(" ",$rs->fields["SGD_EIT_NOMBRE"]);
			$option[1]=$son[0];
						$option[2]=$rs->fields["SGD_EIT_CODIGO"];
		while (!$rs->EOF) {
              $option[0].="<OPTION value=\"".$rs->fields["SGD_EIT_CODIGO"]."\">".$rs->fields["SGD_EIT_NOMBRE"]."</OPTION>";
			 $rs->MoveNext();  
			 }
     return $option;
}

?>
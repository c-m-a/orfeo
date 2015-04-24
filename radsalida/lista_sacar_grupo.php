<?
/**
 * Programa que lista los radicados que hacen parte de un grupo de masiva. Desde este listado es posible sacar los radicados del grupo
 * que no ser�n enviados, es llamado desde cuerpo_masiva.php
 * @author      Sixto Angel Pinz�n
 * @version     1.0
 */
session_start(); 
$ruta_raiz = "..";
include_once "../class_control/Radicado.php"; 
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/class_control/GrupoMasiva.php"; 

if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	 
//$db->conn->debug=true;		
if (!$dependencia || !$nombusuario)   
	include "../rec_session.php";

//variable que referencia un objeto tipo radicado
$rad = & new Radicado($db);
//$db->conn->debug=true;
//variable que referencia un objeto tipo grupo massiva
$grupoMas = & new GrupoMasiva($db);
if (strlen($dep_sel)<1)
	$dep_sel=$dependencia;	
//variable que contiene un arrego de radicados de un grupo de masiva
$radsGrupo=$grupoMas->obtenerGrupo($dep_sel,$grupo,$busq_radicados);

?>
<html><head>
<link rel="stylesheet" href="../estilos/orfeo.css">

<script>

/** 
* Env�a el formulario hacia el programa que realiza la edici�n del grupo de radicados
*/
function enviar() {
document.formSacarGrupo.submit();
}

</script>
</head>
<body  topmargin="0" bgcolor="#ffffff">
        <?
	   		$nomcarpeta="EDICION DE RADICADOS DEL GRUPO <b> $grupo </b> <BR> DE RADICACION MASIVA ";
		?>     
  <table BORDER=0  cellpad=2 cellspacing='0' WIDTH=98% class='t_bordeGris' valign='top' align='center' >
		<TR>
		 <td width='35%' >
      <table width='100%' border='0' cellspacing='1' cellpadding='0'>
        <tr> 
          <td height="20" bgcolor="377584"><div align="left" class="titulo1">LISTADO DE: </div></td>
        </tr>
		<tr class="info">
          <td height="30"><?=$nomcarpeta ?></td>
        </tr>
      </table>
    </td>	
		
     <td width='35%' >
      <table width='100%' border='0' cellspacing='1' cellpadding='0'>
        <tr> 
          <td height="20" bgcolor="377584"><div align="left" class="titulo1">USUARIO </div></td>
        </tr>
		<tr class="info">
          <td height="30"><?=$nombusuario ?></td>
        </tr>
      </table>
    </td>	
	 <td width='35%' >
      <table width='100%' border='0' cellspacing='1' cellpadding='0'>
        <tr> 
          <td height="20" bgcolor="377584"><div align="left" class="titulo1">DEPENDENCIA </div></td>
        </tr>
		<tr class="info">
          <td height="30"><?=$depe_nomb ?></td>
        </tr>
      </table>
    </td>
</TR>
	</table>
        
        
        
        
        
		<TABLE width="98%" align="center" cellspacing="0" cellpadding="0">
    	<tr class="tablas">
      	<TD  > 
					
           	<FORM name=form_busq_rad action='lista_sacar_grupo.php?<?=session_name()."=".trim(session_id())?>' method=post>
                Buscar radicado(s) (Separados por coma)<input name="busq_radicados" type="text" size="70" class="tex_area" value="<?=$busq_radicados?>">
							<input type=submit name=buscar valign='middle' class='botones'  value="Buscar" />
							<input name="grupo" type="hidden" value="<?=$grupo?>" />
							<input name="dep_sel" type="hidden" value="<?=$dep_sel?>" />
							<input name="krd" type="hidden" value="<?=$krd?>" />
							<?//almacena los elementos de sesi�n
								$encabezado="&".session_name()."=".session_id()."&krd=$krd&carpeta=$carpeta&tipo_carp=$tipo_carp&fechah=$fechah&ascdesc=$ascdesc";
								$encabezado.="&agendado=$agendado&mostrar_opc_envio=$mostrar_opc_envio&chk_carpeta=$chk_carpeta&busq_radicados=$busq_radicados&nomcarpeta=$nomcarpeta&orno=";
							?>
      			</form>
					
				</td>
		  </tr>
	 </table>
	 <form method="post" action="sacar_grupo_registro.php?grupo=<?=$grupo?>&pagina></$grupo&pagina>=<?=$pagina?><?=session_name()."=".session_id()."&krd=$krd&fechah=$fechah&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max" ?>" name="formSacarGrupo">
		<input name="grupo" type="hidden" value="<?=$grupo?>" />
			<table align="center" cellpadding="0" cellspacing="0" border="0" width="98%">
      	<tbody> 
          <tr> 
            <td bgcolor="" colspan="3" height="59"> 
            	<table cellpadding="2"  align="center" width="98%" cellspacing="2" cellpad="2" border="0">
              	<tbody> 
                	<tr> 
                  	<td > 
                    	<div align="right"> 
                      <input class="botones" valign="middle" id="Enviar" name="Enviar" value="Actualizar" type="button" onclick="enviar()" >
                    	</div>
                  	</td>
                	</tr>
                </tbody> 
              </table>
            </td>
          </tr>
          <tr> 
            <td class="grisCCCCCCs" valign="top" colspan="3" height="120"> 
            	<table border=0 width="100%" border=0 cellpadding=0 cellspacing=5 class='borde_tab'>
              	<tr class="textoOpcion" bgcolor="#cccccc"> 
                	<td class="titulos3"> <a alt="Seleccione una busqueda" class="textoOpcion" > 
                  	  
                    	NUMERO RADICADO</a> 
									</td>
                  <td class="titulos3" width="15%">  
                    FECHA RADICADO</td>
                  <td class="titulos3" width="21%">  
                    NOMBRE DESTINATARIO</td>
                  <td class="titulos3" width="12%">  
                    DIRECCION</td>
                  <td class="titulos3" width="12%">  
                    DEPARTAMENTO</td>
                  <td class="titulos3" width="8%">  
                    MUNICIPIO </td>
                  <td class="titulos3" width="8%">  
                    ELIMINADOS </td>
                </tr>
                <?php
								  //var que recoge el n�mero de radicados del grupo
									$num = count($radsGrupo);
									$i = 0;
									// var que recoge todos os radicados que fueron retirados
									$retirados="";
									//var de indicador del rango de registros que ha de mostrarse
								  $registro=$pagina*20;
									
									//Recorre el arreglo de registros que hacen parte del grupo y va imprimiendolos
									while ($i < $num) {
										
									  //Imprime solo los 20 de la p�gina seleccionada
										if($i>=$registro and $i<($registro+20)){
									
											//Decice el fromato gr�fico de cada registro
											if (($i%2)==0)
												 $clase ="listado2";
											else
												$clase="listado1";
												//obtiene los datos del radicado
												$datosRad=$rad->radicado_codigo($radsGrupo[$i]);
												$datosRad=$rad->getDatosRemitente();
												$chequeado="";
												
												//Si el radicado fue retirado del grupo entonces lo marca como tal
												if ($grupoMas->radicadoRetirado($grupo,$radsGrupo[$i])){
													$retirados=$retirados.";".$radsGrupo[$i].";";
												  $chequeado="checked";
												}
											
								?>
                <tr class="<?=$clase?>"> 
                  <td class="leidos"> <span class="tpar"> 
                    <?=$radsGrupo[$i]?>
                    </span> </td>
                  <td class="leidos"><font size="1"><span class="tpar"> 
                    <?=$rad->getRadi_fech_radi()?>
                    </span></td>
                  <td class="leidos"> 
                    <?=$datosRad["nombre"]?>
                  </td>
                  <td class="leidos"> 
                    <?=$datosRad["direccion"]?>
                  </td>
                  <td class="leidos"> 
                    <?=$datosRad["deptoNombre"]?>
                  </td>
                  <td class="leidos"> 
                    <?=$datosRad["muniNombre"]?>
                  </td>
                  <td class="leidos" align="center"> 
                    <input  type="checkbox" id="check_value"  value="retirar"  <?php echo "$chequeado NAME=check_value[$radsGrupo[$i]]" ?> >
                  </td>
                </tr>
                <?
										}
										$i++; 
									}
								?>
                <tr class="<?=$clase?>" > 
                  <td class="tpar" colspan="7"> 
                    <div align="center"><span class='paginacion'> 
                      <?	 	
												$numeroRegs = $i;
												// Se alcula el numero de paginas a mostrar
												$paginas = ($numeroRegs / 20);
											?>
                      Paginas</span> 
                      <?
												if(intval($paginas)<=$paginas)
													{$paginas=$paginas;}
												else{$paginas=$paginas-1;}
												
												// Se imprime el numero de Paginas.
												for($j=0;$j<$paginas;$j++){
	  												
														if($pagina==$j){$letrapg="<font color=green size=3>";}else{$letrapg="<font color=blue size=2>";}
	  													echo " <a class ='vinculos' href='lista_sacar_grupo.php?grupo=$grupo&dep_sel=$dep_sel&pagina=$j&$encabezado$orno'>$letrapg".($j+1)."</a>\n";
												}
	 
	 
   ?>
                      <BR>
					  <a class="vinculos" href='cuerpo_masiva.php?<?=$encabezado?>'>
					  Grupos a Enviar de Masiva
					  </a>
                    </div>
                  </td>
                </tr>
              </table>
              <br>
            </td>
          </tr>
          </tbody> 
        </table>
    <input name="retirados" type="hidden" id="retirados" value="<?php echo $retirados ?>">
	 </form>
 <table align="center" class="t_bordeGris" width="98%" cellpad="2" cellspace="2" border="0">
 	<tbody>
		<tr align="center"> 
      <td> <span class="etextou"> </span>
			</td>
     </tr>
	</tbody>
 </table>
</td></tr></tbody></table>

<br>
<br> 
</body>
</html>
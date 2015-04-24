<?
if (!$ruta_raiz)
	$ruta_raiz = "..";

require_once("$ruta_raiz/include/db/ConnectionHandler.php"); 	

if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	 
//$db->conn->debug=true;	

// var que almacena la hora de la fecha actual
$hora=date("H")."_".date("i")."_".date("s");
// var que almacena el dia de la fecha
$ddate=date('d');
// var que almacena el mes de la fecha
$mdate=date('m');
// var que almacena el año de la fecha
$adate=date('Y');
// var que almacena  la fecha formateada
$fecha=$adate."_".$mdate."_".$ddate;
//guarda el path del archivo generado
$archivo = "$ruta_raiz/bodega/masiva/tmp_$usua_doc"."_$fecha"."_$hora.csv";	
$sql="	
select r.RADI_NUME_RADI,r.RADI_FECH_RADI,r.RADI_DEPE_RADI,

(CASE WHEN dir.SGD_DIR_TIPO = 1 THEN 'REMITENTE'
      WHEN dir.SGD_DIR_TIPO = 2 THEN 'PREDIO'
      WHEN dir.SGD_DIR_TIPO = 3 THEN 'ESP'
      ELSE 'NO DEFINIDO' 
 END
) AS DIR_TIPO,

(CASE WHEN DIR.SGD_CIU_CODIGO !=0 THEN
	(SELECT c.SGD_CIU_NOMBRE || ' ' || c.sgd_ciu_apell1 || ' '|| c.sgd_ciu_apell2 from  sgd_ciu_ciudadano c where c.sgd_ciu_codigo=dir.sgd_ciu_codigo)
      WHEN DIR.SGD_OEM_CODIGO !=0 THEN
	(SELECT o.SGD_OEM_OEMPRESA from SGD_OEM_OEMPRESAS o where o.sgd_oem_codigo=dir.sgd_oem_codigo)
      WHEN DIR.sgd_esp_codi !=0 THEN
	(SELECT b.nombre_de_la_empresa from BODEGA_EMPRESAS b where b.identificador_empresa=dir.sgd_esp_codi)
      WHEN DIR.sgd_doc_fun !=0 THEN
	(SELECT u.usua_nomb from USUARIO u where u.usua_doc = dir.sgd_doc_fun and rownum = 1 )
 END	
) AS NOMBRE,
(CASE WHEN DIR.SGD_CIU_CODIGO !=0 THEN
	(SELECT c.sgd_ciu_direccion from  sgd_ciu_ciudadano c where c.sgd_ciu_codigo=dir.sgd_ciu_codigo)
      WHEN DIR.SGD_OEM_CODIGO !=0 THEN
	(SELECT o.sgd_oem_direccion from  SGD_OEM_OEMPRESAS o where o.sgd_oem_codigo=dir.sgd_oem_codigo)
      WHEN DIR.sgd_esp_codi !=0 THEN
	(SELECT b.direccion from BODEGA_EMPRESAS b where b.identificador_empresa=dir.sgd_esp_codi)
      WHEN DIR.sgd_doc_fun !=0 THEN
	(SELECT 'Dependencia-->' ||  u.depe_codi || ' ' || dp.dep_direccion from USUARIO u , dependencia dp 
		where u.usua_doc = dir.sgd_doc_fun and u.depe_codi = dp.depe_codi and rownum = 1)
 END	
) AS DIRECCION,
(CASE WHEN DIR.SGD_CIU_CODIGO !=0 THEN
	(SELECT d.dpto_nomb from  sgd_ciu_ciudadano c , departamento d where c.sgd_ciu_codigo=dir.sgd_ciu_codigo and c.dpto_codi=d.dpto_codi)
      WHEN DIR.SGD_OEM_CODIGO !=0 THEN
	(SELECT d.dpto_nomb  from  SGD_OEM_OEMPRESAS o , departamento d where o.sgd_oem_codigo=dir.sgd_oem_codigo and o.dpto_codi = d.dpto_codi)
      WHEN DIR.sgd_esp_codi !=0 THEN
	(SELECT d.dpto_nomb  from BODEGA_EMPRESAS b, departamento d  where b.identificador_empresa=dir.sgd_esp_codi and b.codigo_del_departamento = d.dpto_codi)
      WHEN DIR.sgd_doc_fun !=0 THEN
	(SELECT d.dpto_nomb from USUARIO u,departamento d , dependencia dp 
		where u.usua_doc = dir.sgd_doc_fun and u.depe_codi=dp.depe_codi and dp.dpto_codi=d.dpto_codi and rownum = 1)
 END	
) AS DEPARTAMENTO,
(CASE WHEN DIR.SGD_CIU_CODIGO !=0 THEN
	(SELECT m.muni_nomb from  sgd_ciu_ciudadano c , municipio m where c.sgd_ciu_codigo=dir.sgd_ciu_codigo 
			and c.dpto_codi=m.dpto_codi and c.muni_codi=m.muni_codi)
      WHEN DIR.SGD_OEM_CODIGO !=0 THEN
	(SELECT m.muni_nomb  from  SGD_OEM_OEMPRESAS o , municipio m where o.sgd_oem_codigo=dir.sgd_oem_codigo 
			and o.dpto_codi = m.dpto_codi and o.muni_codi = m.muni_codi)
      WHEN DIR.sgd_esp_codi !=0 THEN
	(SELECT m.muni_nomb  from BODEGA_EMPRESAS b, municipio m  where b.identificador_empresa=dir.sgd_esp_codi 
		and b.codigo_del_departamento = m.dpto_codi and b.codigo_del_municipio = m.muni_codi)
      WHEN DIR.sgd_doc_fun !=0 THEN
	(SELECT m.muni_nomb from USUARIO u,municipio m  , dependencia dp 
		where u.usua_doc = dir.sgd_doc_fun and u.depe_codi=dp.depe_codi 
			and dp.dpto_codi=m.dpto_codi and dp.muni_codi = m.muni_codi and rownum = 1 )
 END	
) AS MUNICIPIO,
r.radi_cuentai CUENTA_INTERNA,
u.usua_nomb USUARIO_RADICADOR,
r.RADI_PATH as PATH
from radicado r,sgd_dir_drecciones dir, usuario u
where r.RADI_FECH_RADI >= '$fechaIni' and r.RADI_FECH_RADI <= '$fechaFin'  and
r.RADI_NUME_RADI = dir.RADI_NUME_RADI  and
r.radi_usua_radi = u.usua_codi and
u.depe_codi = substr (r.radi_nume_radi,5,3) and
r.radi_nume_radi like '%2' AND
R.radi_tipo_deri=1

union 

select r.RADI_NUME_RADI,r.RADI_FECH_RADI,r.RADI_DEPE_RADI,
'ESP'  AS DIR_TIPO,
(SELECT b.nombre_de_la_empresa from BODEGA_EMPRESAS b where b.identificador_empresa=r.EESP_CODI) AS NOMBRE,
(SELECT b.direccion from BODEGA_EMPRESAS b where b.identificador_empresa=r.EESP_CODI) AS DIRECCION,
(SELECT d.dpto_nomb  from BODEGA_EMPRESAS b, departamento d  where b.identificador_empresa=r.EESP_CODI and b.codigo_del_departamento = d.dpto_codi) AS DEPARTAMENTO,
(SELECT m.muni_nomb  from BODEGA_EMPRESAS b, municipio m  where b.identificador_empresa=r.EESP_CODI 
		and b.codigo_del_departamento = m.dpto_codi and b.codigo_del_municipio = m.muni_codi)  AS MUNICIPIO,
r.radi_cuentai CUENTA_INTERNA,
u.usua_nomb USUARIO_RADICADOR,
r.RADI_PATH as PATH
from radicado r, usuario u
where r.RADI_FECH_RADI >= '$fechaIni' and r.RADI_FECH_RADI <= '$fechaFin'  and
r.radi_usua_radi = u.usua_codi and
u.depe_codi = substr (r.radi_nume_radi,5,3) and
r.radi_nume_radi like '%2' AND
R.radi_tipo_deri=1 AND 
r.EESP_CODI != 0 and
r.EESP_CODI is not null

order by 1 ";

$rs=$db->query($sql);
?>
<html>
<head>
<title>Untitled Document</title>
<link rel="stylesheet" href="../estilos_totales.css">
</head>
<body>
<form action="resumenRads.php"  method="post" enctype="multipart/form-data" name="formSeleccionar">
  <table width="52%" border="0" cellspacing="1" cellpadding="0" align="center" class="t_bordeGris">
    <tr align="center"> 
      <td height="25" class="grisCCCCCC" colspan="5"> <span class="etextomenu"> 
        CONSULTA DE RADICADOS </span> </td>
    </tr>
     </tr>
    <tr align="center"> 
      <td class="celdaGris" height="12" colspan="5"> 
        <div align="left"><span class="etextomenu"> 
          Resutado de la consulta...... <BR>
        </span></div>
      </td>
    </tr>
      <tr align="justify"> <td>
      <?
      	$com = chr(34); 
		$contenido="RADI_NUME_RADI;RADI_FECH_RADI;RADI_DEPE_RADI;NOMBRE_REM;DIRECCION_REM;DEPARTAMENTO_REM;MUNICIPIO_REM;";
		$contenido.="NOMBRE_PRED;DIRECCION_PRED;DEPARTAMENTO_PRED;MUNICIPIO_PRED;";
		$contenido.="NOMBRE_ESP;DIRECCION_ESP;DEPARTAMENTO_ESP;MUNICIPIO_ESP;";
		$contenido.="CUENTA_INTERNA;USUARIO_RADICADOR;PATH\n";
		$radAuxPrev = -1;
		$radAuxNuevo = -1;
		$fp=fopen($archivo,"w");
      	while  ($rs&&!$rs->EOF) {
      		$radAuxNuevo=$rs->fields['RADI_NUME_RADI'];
      		
      		if ($radAuxNuevo!=$radAuxPrev && $radAuxPrev!=-1){
      			$contenido.="$radAuxPrev;$fecha;$depeRad;$nombre_rem;$direccion_rem;$depto_rem;$muni_rem;";
				$contenido.="$nombre_pred;$direccion_pred;$depto_pred;$muni_pred;";
				$contenido.="$nombre_esp;$direccion_esp;$depto_esp;$muni_esp;";
				$contenido.="$cuenta;$radicador;$path\n";
				
				
				
      			$nombre_rem = ""; 
      			$direccion_rem = ""; 
      			$depto_rem = ""; 
      			$muni_rem = ""; 
      		
      		
      			$nombre_pred = ""; 
      			$direccion_pred = ""; 
      			$depto_pred = ""; 
      			$muni_pred = ""; 
      		
      		
      		
      			$nombre_esp = ""; 
      			$direccion_esp = ""; 
      			$depto_esp = ""; 
      			$muni_esp = ""; 
      		
				
				
      	   }
      	   
      	   
      		$fecha = $rs->fields['RADI_FECH_RADI'];
      		$depeRad= $rs->fields['RADI_DEPE_RADI'];
      		$dirTipo = $rs->fields['DIR_TIPO'];
      		$cuenta=$rs->fields['CUENTA_INTERNA'];  
      		$radicador=$rs->fields['USUARIO_RADICADOR'];  
      		$path=$rs->fields['PATH'];  
      		
      		if ($dirTipo=="REMITENTE"){
      			$nombre_rem = $rs->fields['NOMBRE']; 
      			$direccion_rem = $rs->fields['DIRECCION']; 
      			$depto_rem = $rs->fields['DEPARTAMENTO']; 
      			$muni_rem = $rs->fields['MUNICIPIO']; 
      		} 
      		if ($dirTipo=="PREDIO"){
      			$nombre_pred = $rs->fields['NOMBRE']; 
      			$direccion_pred = $rs->fields['DIRECCION']; 
      			$depto_pred = $rs->fields['DEPARTAMENTO']; 
      			$muni_pred = $rs->fields['MUNICIPIO']; 
      		}
      		
      		if ($dirTipo=="ESP"){
      			$nombre_esp = $rs->fields['NOMBRE']; 
      			$direccion_esp = $rs->fields['DIRECCION']; 
      			$depto_esp = $rs->fields['DEPARTAMENTO']; 
      			$muni_esp = $rs->fields['MUNICIPIO']; 
      		}
      		
      		$radAuxPrev = $radAuxNuevo;
      		$rs->MoveNext();
      		
      	}
      	fputs($fp,$contenido);
		fclose($fp);
      
      ?>
     <font color="#FF0000" size="1" face="Verdana, Arial, Helvetica, sans-serif">
     	<strong>
     		<span class="textoComentario"> <BR>
     			Se ha generado un archivo con el resultado de la consulta realizada.<BR>
            	<BR>
            	Para obtener el archivo guarde del destino del siguiente link 
            	al archivo: <a href="<?=$archivo?>">CSV GENERADO</a>
            </span>
        </strong>
    </font>
    </td>
    </tr> 
    <tr align="center"> 
      <td height="25" class="grisCCCCCC" colspan="5"> <span class="etextomenu"> 
		<input name="consultar" type="button"  class="ebuttons2" id="envia22"  value="Consultar"  onClick="history.go(-1);">
      </span> </td>
    </tr>
    
    	
    		
    	
    
    </table>
   
    </body>
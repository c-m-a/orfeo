<?
/*  Visualizador de Listados.
*	Creado por: Ing. Hollman Ladino Paredes.
*	Para el proyecto ORFEO.
*
*	Permite la visualización general de paises, departemntos, municipios, tarifas, etc.
*	Es una idea básica. Aún està bajo desarrollo.
*/


$ruta_raiz="../..";
include("$ruta_raiz/config.php"); 		// incluir configuracion.
include($ADODB_PATH.'/adodb.inc.php');
include($ADODB_PATH.'/tohtml.inc.php');
$ADODB_FETCH_MODE = ADODB_FETCH_NUM;
$ADODB_COUNTRECS = false;

$error = 0;
$dsn = $driver."://".$usuario.":".$contrasena."@".$servidor."/".$db;
$conn = NewADOConnection($dsn);
//$conn->debug=1;

switch ($_GET['var'])
{	case 'tar'	:
		{	$titulo = "LISTADO GENERAL DE TARIFAS";
			$tit_columnas = array('Forma Envio','Nal / InterNal.','C&oacute;d. Tarifa','Desc. Tarifa','Valor Local/America','Valor Nal./Resto');
			$valor1 = $conn->IfNull('SGD_TAR_TARIFAS.SGD_TAR_VALENV1', 'SGD_TAR_TARIFAS.SGD_TAR_VALENV1G1');
			$valor2 = $conn->IfNull('SGD_TAR_TARIFAS.SGD_TAR_VALENV2', 'SGD_TAR_TARIFAS.SGD_TAR_VALENV2G2');
			$isql =	"SELECT SGD_FENV_FRMENVIO.SGD_FENV_DESCRIP, SGD_CLTA_CLSTARIF.SGD_CLTA_CODSER, SGD_CLTA_CLSTARIF.SGD_TAR_CODIGO, SGD_CLTA_CLSTARIF.SGD_CLTA_DESCRIP, 
                      $valor1 AS VALOR1, $valor2 AS VALOR2 
					FROM SGD_CLTA_CLSTARIF, SGD_TAR_TARIFAS, SGD_FENV_FRMENVIO 
					WHERE SGD_CLTA_CLSTARIF.SGD_FENV_CODIGO = SGD_TAR_TARIFAS.SGD_FENV_CODIGO AND 
                      SGD_CLTA_CLSTARIF.SGD_TAR_CODIGO = SGD_TAR_TARIFAS.SGD_TAR_CODIGO AND 
                      SGD_CLTA_CLSTARIF.SGD_CLTA_CODSER = SGD_TAR_TARIFAS.SGD_CLTA_CODSER AND
					  SGD_CLTA_CLSTARIF.SGD_FENV_CODIGO = SGD_FENV_FRMENVIO.SGD_FENV_CODIGO
					ORDER BY SGD_CLTA_CLSTARIF.SGD_CLTA_CODSER, SGD_CLTA_CLSTARIF.SGD_FENV_CODIGO, 
					SGD_CLTA_CLSTARIF.SGD_TAR_CODIGO";			
		}break;
	case 'pai'	:
		{	$titulo = "LISTADO GENERAL DE PAISES";
			$tit_columnas = array('Continente','Id País','Nombre País');
			$isql =	"SELECT SGD_DEF_CONTINENTES.NOMBRE_CONT, SGD_DEF_PAISES.ID_PAIS, SGD_DEF_PAISES.NOMBRE_PAIS 
					FROM SGD_DEF_PAISES, SGD_DEF_CONTINENTES WHERE SGD_DEF_PAISES.ID_CONT = SGD_DEF_CONTINENTES.ID_CONT
					ORDER BY SGD_DEF_CONTINENTES.NOMBRE_CONT, SGD_DEF_PAISES.NOMBRE_PAIS";
			
		}break;
	case 'dpt'	:
		{	$titulo = "LISTADO GENERAL DE DEPARTAMENTOS";
			$tit_columnas = array('Continente','Nombre País','Id Dpto','Nombre Dpto');
			$isql =	"SELECT SGD_DEF_CONTINENTES.NOMBRE_CONT, SGD_DEF_PAISES.NOMBRE_PAIS, DEPARTAMENTO.DPTO_CODI, DEPARTAMENTO.DPTO_NOMB
					FROM SGD_DEF_PAISES, SGD_DEF_CONTINENTES, DEPARTAMENTO 
					WHERE SGD_DEF_PAISES.ID_CONT = SGD_DEF_CONTINENTES.ID_CONT AND 
						SGD_DEF_PAISES.ID_PAIS = DEPARTAMENTO.id_pais AND 
						SGD_DEF_PAISES.ID_CONT = DEPARTAMENTO.id_cont
					ORDER BY SGD_DEF_CONTINENTES.NOMBRE_CONT, SGD_DEF_PAISES.NOMBRE_PAIS, DEPARTAMENTO.DPTO_NOMB";			
		}break;
	case 'ctt'	:
		{	$titulo = "LISTADO GENERAL DE CONTACTOS";
			$tit_columnas = array('Tipo Contacto','Empresa/Entidad','Id Contacto','Nombre Contacto','Cargo Contacto','Telefono Contacto');
			$isql =	"SELECT 'TIPO' = CASE WHEN c.CTT_ID_TIPO = 1 THEN 'Entidad' WHEN c.CTT_ID_TIPO = 2 THEN 'Otras Emp.' END,b.NOMBRE_DE_LA_EMPRESA,c.CTT_ID, c.CTT_NOMBRE, c.CTT_CARGO, c.CTT_TELEFONO 
					FROM SGD_DEF_CONTACTOS c, BODEGA_EMPRESAS b
					WHERE c.CTT_ID_EMPRESA = b.NUIR AND c.CTT_ID_TIPO=1
					UNION 
					SELECT 'TIPO' = CASE WHEN c.CTT_ID_TIPO = 1 THEN 'Entidad' WHEN c.CTT_ID_TIPO = 2 THEN 'Otras Emp.' END, 	b.SGD_OEM_OEMPRESA,c.CTT_ID, c.CTT_NOMBRE, c.CTT_CARGO, c.CTT_TELEFONO 
					FROM SGD_DEF_CONTACTOS c, SGD_OEM_OEMPRESAS b
					WHERE c.CTT_ID_EMPRESA = b.SGD_OEM_CODIGO AND c.CTT_ID_TIPO=2
					ORDER BY 1,2,4";			
		}break;
	case 'bge'	:
		{	$titulo = "LISTADO GENERAL DE ESP";
			$tit_columnas = array('Empresa','Sigla','Correo E', 'Teléfonos' , 'NIT', 'NIUR', 'Id Empresa');
			$isql =	"SELECT NOMBRE_DE_LA_EMPRESA, SIGLA_DE_LA_EMPRESA, EMAIL, TELEFONO_1, NIT_DE_LA_EMPRESA,
					NUIR, IDENTIFICADOR_EMPRESA 
					FROM BODEGA_EMPRESAS
					ORDER BY NOMBRE_DE_LA_EMPRESA, SIGLA_DE_LA_EMPRESA";
			
		}break;
	default		:
		{	$titulo = "LISTADO GENERAL DE MUNICIPIOS";
			$isql = "SELECT SGD_DEF_CONTINENTES.NOMBRE_CONT, SGD_DEF_PAISES.NOMBRE_PAIS, 
                      DEPARTAMENTO.DPTO_NOMB, MUNICIPIO.MUNI_CODI, MUNICIPIO.MUNI_NOMB 
					FROM MUNICIPIO, SGD_DEF_CONTINENTES, SGD_DEF_PAISES, DEPARTAMENTO 
					WHERE MUNICIPIO.ID_CONT = SGD_DEF_CONTINENTES.ID_CONT AND
                      MUNICIPIO.ID_PAIS = SGD_DEF_PAISES.ID_PAIS AND
                      MUNICIPIO.DPTO_CODI = DEPARTAMENTO.DPTO_CODI
					ORDER BY SGD_DEF_CONTINENTES.NOMBRE_CONT, SGD_DEF_PAISES.NOMBRE_PAIS, 
                      DEPARTAMENTO.DPTO_NOMB, MUNICIPIO.MUNI_NOMB ";
		}break;
}
//$conn->debug=true;
$Rs_clta = $conn->Execute($isql); 

?>
<html>
<head><title><?= $titulo ?></title></head>
<body>
<?
switch ($_GET['var'])
{	case 'tar'	:	rs2html($Rs_clta,'border=1 cellpadding=0',$tit_columnas);break;
	case 'pai'	:	rs2html($Rs_clta,'border=1 cellpadding=0',$tit_columnas);break;
	case 'ctt'	: 	rs2html($Rs_clta,'border=1 cellpadding=0',$tit_columnas);break;
	case 'dpt'	:	rs2html($Rs_clta,'border=1 cellpadding=0',$tit_columnas);break;
	case 'bge'	:	rs2html($Rs_clta,'border=1 cellpadding=0',$tit_columnas);break;
	default		:	include($ADODB_PATH.'/adodb-pager.inc.php');
					$pager = new ADODB_Pager($conn,$isql);
					$pager->Render($rows_per_page=20);
					break;
}
$Rs_clta->Close();
?>
</body>
</html>

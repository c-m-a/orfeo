<?PHP
/********* CONSTRUCCION DE LA CONSULTA PARA VER EL HISTORICO DE PRESTAMOS DE UN RADICADO *********/

// Nombre de la transacción
$sqlEstadoVis[0]=" 1 "; //Solicitado
$sqlEstadoVis[1]=" 2 "; //Préstado
$sqlEstadoVis[2]=" 3 "; //Devuelto sin registro del usuario que hizo la transacción
$sqlEstadoVis[3]=" 4 "; //Cancelado con registro del usuario que hizo la transacción
$sqlEstadoVis[4]=" 5 "; //Préstamo Indefinido
$sqlEstadoVis[5]=" 4 "; //Cancelado sin registro del usuario que hizo la transacción
$sqlEstadoVis[6]=" 3 "; //Devuelto con registro del usuario que hizo la transacción

// Estado que define la transacción en la consulta
$sqlEstado[0]=" (1,2,3,4,5) ";   //Solicitado
$sqlEstado[1]=" (2,5,3) and P.PRES_FECH_VENC is not null "; //Préstado
$sqlEstado[2]=" (3) ";           //Devuelto sin usuario
$sqlEstado[3]=" (4) ";           //Cancelado con usuario
$sqlEstado[4]=" (5,2,3) and P.PRES_FECH_VENC is null ";     //Préstamo Indefinido
$sqlEstado[5]=" (5) ";           //Cancelado sin Usuario
$sqlEstado[6]=" (3) ";           //Devuelto con usuario


// Fecha de la transacción
$sqlPRES_FECH_PEDI=$db->conn->SQLDate("Y-m-d h:i:s A","P.PRES_FECH_PEDI"); 
$sqlPRES_FECH_PRES=$db->conn->SQLDate("Y-m-d h:i:s A","P.PRES_FECH_PRES"); 
$sqlPRES_FECH_CANC=$db->conn->SQLDate("Y-m-d h:i:s A","P.PRES_FECH_CANC"); 
$sqlPRES_FECH_DEVO=$db->conn->SQLDate("Y-m-d h:i:s A","P.PRES_FECH_DEVO");
  
$sqlFecha[0]=$sqlPRES_FECH_PEDI; //Solicitado
$sqlFecha[1]=$sqlPRES_FECH_PRES; //Prestado
$sqlFecha[2]=$sqlPRES_FECH_DEVO; //Devuelto sin usuario
$sqlFecha[3]=$sqlPRES_FECH_CANC; //Cancelado 
$sqlFecha[4]=$sqlPRES_FECH_PRES; //Préstamo Indefinido
$sqlFecha[5]=$sqlPRES_FECH_CANC; //Cancelado sin Usuario
$sqlFecha[6]=$sqlPRES_FECH_DEVO; //Devuelto con usuario


// Usuario que realiza la transacción
$sqlUsuario[0]=" P.USUA_LOGIN_ACTU "; //Solicitado
$sqlUsuario[1]=" P.USUA_LOGIN_PRES "; //Préstado
$sqlUsuario[2]=" P.USUA_LOGIN_ACTU and P.USUA_LOGIN_RX is null "; //Devuelto sin usuario
$sqlUsuario[3]=" P.USUA_LOGIN_CANC "; //Cancelado   
$sqlUsuario[4]=" P.USUA_LOGIN_PRES "; //Préstamo Indefinido
$sqlUsuario[5]=" '' ";                //Cancelado sin usuario
$sqlUsuario[6]=" P.USUA_LOGIN_ACTU and UR.USUA_LOGIN= P.USUA_LOGIN_RX "; //Devuelto con usuario


// Comentario
$sqlDesc[0]=" '' ";         //Solicitado
$sqlDesc[1]=" P.PRES_DESC ";//Préstado
$sqlDesc[2]=" P.DEV_DESC "; //Devuelto sin usuario
$sqlDesc[3]=" '' ";         //Cancelado            
$sqlDesc[4]=" P.PRES_DESC ";//Préstamo Indefinido
$sqlDesc[5]=" '' ";         //Cancelado sin usuario
$sqlDesc[6]=" P.DEV_DESC "; //Devuelto con usuario

// Construcción de la consulta
$sSQLTot=""; // consulta definitiva
for($i=0; $i<7; $i++)
{	// Manejo de cancelado con y sin usuario
    if ($i==5)
    {	$selectUsuario=" '' as USUARIO,";
    	$selectDepe=" '' as DEPENDENCIA,";
    	$fromUsuario="";
    	$fromDepe="";
    	$whereUsua=" P.USUA_LOGIN_CANC='' and ";
    	$whereDepe="";
    }
    else
    {	$selectUsuario=" U.USUA_NOMB as USUARIO,";
    	if($i==6) 
    		{	$selectUsuario="U.USUA_NOMB".$db->conn->concat_operator."'(Ent)<br>'".$db->conn->concat_operator."UR.USUA_NOMB".$db->conn->concat_operator."'(Rx)' as USUARIO,"; }	//Devuelto con usuario
    	$selectDepe=" D.DEPE_NOMB as DEPENDENCIA,"; 
    	$fromUsuario=" USUARIO U,";
    	if($i==6)
    		{ $fromUsuario=" USUARIO U,USUARIO UR,"; } //Devuelto con usuario
    	$fromDepe =" DEPENDENCIA D,";
    	$whereUsua=" U.USUA_LOGIN=".$sqlUsuario[$i]." and ";
    	$whereDepe=" D.DEPE_CODI=U.DEPE_CODI and ";
    }
    
    $sSQL[$i]="select $selectDepe ".
    			$sqlFecha[$i]." as FECHA,
    			E.PARAM_VALOR as TRANSACCION, 
    			$selectUsuario
    			R.PARAM_VALOR as COMENTARIO1, ".
    			$sqlDesc[$i]." as COMENTARIO2  
			from 
				PRESTAMO P,
				".$fromUsuario."
				".$fromDepe."
				SGD_PARAMETRO E,
				SGD_PARAMETRO R
			where 
				R.PARAM_NOMB='PRESTAMO_REQUERIMIENTO' and
				R.PARAM_CODI=P.PRES_REQUERIMIENTO and 
				E.PARAM_NOMB='PRESTAMO_ESTADO' and
				E.PARAM_CODI=".$sqlEstadoVis[$i]." and 
				".$whereUsua."
				".$whereDepe."
				P.PRES_ESTADO in ".$sqlEstado[$i]." and
				P.RADI_NUME_RADI=".$antfldRADICADO;
    if($i!=0){ $sSQLTot.="union all "; }
	$sSQLTot.=$sSQL[$i]; 
}		
$sSQLTot.=" order by 2 desc";   
?>
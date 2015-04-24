<?PHP

/********* TERCERA PARTE DE LA CONSULTA *********/
$sWhere_non_exp=$sWhere." and P.RADI_NUME_RADI not in (select RADI_NUME_RADI from SGD_EXP_EXPEDIENTE) "; //radicados sin expediente
    echo "<hr>";   
if($db->conn->dataProvider=="oci8")
{
	$sWhere_exp    =$sWhere." and E.RADI_NUME_RADI (+)=P.RADI_NUME_RADI ";            //radicados con expediente
}

if($db->conn->dataProvider=="mssql")
{
	$sWhere_exp    =$sWhere." and E.RADI_NUME_RADI =P.RADI_NUME_RADI ";            //radicados con expediente
}

if($db->conn->dataProvider=="postgres")
{
	$sWhere_exp    =$sWhere." and E.RADI_NUME_RADI =P.RADI_NUME_RADI ";            //radicados con expediente
}

            // Build SQL statement

            $sSQL_non_exp=$sSelect_non_exp.$sFrom_non_exp.$sWhere_non_exp;  		 
            $sSQL_exp    =$sSelect_exp.$sFrom_exp.$sWhere_exp;  		 

            if ($sFileName=="formEnvio.php") {
               $sSQL=$sSQL_exp.$sSQLsele." union all ".$sSQL_non_exp.$sSQLsele;  		             
            }
            else {
               $sSQL=$sSQL_exp." union all ".$sSQL_non_exp;  		 
            } 
?>		 

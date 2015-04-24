<?php
/**
 * Retorna los datos iniciales para que se grafiquen
 * los datos de los radicados.
 */

    $ruta_raiz = "../..";

    //Paremetros get y pos enviados desde la aplicacion origen
    import_request_variables("gP", ""); 

    include_once    ("$ruta_raiz/include/db/ConnectionHandler.php");
    $db             = new ConnectionHandler("$ruta_raiz");
    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);


    /********************INICIO DATOS GRAFICA TORTA *****************************/


    // Redondeo entre la diferencia de la fecha actual y la fecha de radicación
    $redondeo   = " round(
                        (radi_fech_radi-".$db->conn->sysTimeStamp.")+
                        floor(c.sgd_tpr_termino * 7/5)+(
                            SELECT 
                                count(*) 
                            FROM 
                                sgd_noh_nohabiles 
                            WHERE
                                NOH_FECHA between radi_fech_radi and ".$db->conn->sysTimeStamp."
                        )
                    )";
                    
    if($db->driver =='postgres'){
        $redondeo=" date_part('days', radi_fech_radi-".$db->conn->sysTimeStamp.")
                    +floor(c.sgd_tpr_termino * 7/5)+(
                        SELECT 
                            count(*) 
                        FROM
                            sgd_noh_nohabiles 
                        WHERE 
                            NOH_FECHA between radi_fech_radi and ".$db->conn->sysTimeStamp."
                    )";
    }

    // Radicados con diferencia igual o inferior a 0 
    //***alerta Roja***
    $isql   = " SELECT
                    count(*) as RADS
                FROM
                    radicado b left outer join SGD_TPR_TPDCUMENTO c on 
                            (b.tdoc_codi=c.sgd_tpr_codigo)
                WHERE
                    b.radi_nume_radi is not null
                    and b.radi_depe_actu = $dependencia                    
                    and b.radi_usua_actu = $codusuario";
                    
    $consla1        = $isql ."and $redondeo <= 0";                                    
    $rs             = $db->conn->Execute($consla1);
    $alertaRoja     = $rs->fields["RADS"];


    // Radicados con diferencia mayor a 0 y menor igual que 10 
    //***alerta Amarilla***    
    $consla2        = $isql . "and $redondeo > 0 and $redondeo <= 10";
    $rs             = $db->conn->Execute($consla2);
    $alertaAmarilla = $rs->fields["RADS"];    

    
    // Radicados con diferencia mayor a 10 
    //***alerta Verde***    
    $consla3        = $isql . "and $redondeo > 10";                    
    $rs             = $db->conn->Execute($consla3);
    $alertaVerde    = $rs->fields["RADS"];    
    
    
    //Si el usuario no tiene datos 
    if(empty($alertaVerde) 
        && empty($alertaAmarilla)
        && empty($alertaRoja)){
        $alertaRoja  = $alertaAmarilla = 0;
        $alertaVerde = 1;
    }    
    //Arreglo a retonar
    //[['Sony',7], ['Samsumg',13.3]];
    $tortaGrafica   = array(array('Activos',$alertaVerde),
                            array('Proximos',$alertaAmarilla),
                            array('Vencidos',$alertaRoja)
                            );                               
    
    /******************** FIN DATOS GRAFICA TORTA     *************************/
    
    /******************** INICIO DATOS GRAFICA BARRAS *************************/
   
    $isqlIni = "    SELECT
                        c.SGD_TPR_DESCRIP
                        ,count(*) as RADS
                    FROM
                        radicado b left outer join SGD_TPR_TPDCUMENTO c on 
                            (b.tdoc_codi=c.sgd_tpr_codigo)
                    WHERE
                        b.radi_nume_radi is not null
                        and b.radi_usua_actu = $codusuario
                        and b.radi_depe_actu = $dependencia";

    $consul1    = $isqlIni . "and $redondeo < 0 group by c.SGD_TPR_DESCRIP";                        
    $rsA        = $db->conn->Execute($consul1);

    while (!$rsA->EOF) {
        $tipoDoc    = $rsA->fields["SGD_TPR_DESCRIP"];
        $tipoDoc    = ucfirst(strtolower(substr($tipoDoc, 0, 30)));
        $rads       = $rsA->fields["RADS"];
        $infoXtipoRojo[$tipoDoc]        = (int)$rads;  
        $infoXtipoAmarillo[$tipoDoc]    += 0;
        $infoXtipoVerde[$tipoDoc]       += 0;  
        $infoXtipoDoc[$tipoDoc]         = $tipoDoc;    
        $rsA->MoveNext();
    }

    $consul2    = $isqlIni . "AND $redondeo > 0 AND $redondeo <= 10 group by c.SGD_TPR_DESCRIP";
    $rs     = $db->conn->Execute($consul2);    

    while (!$rs->EOF) {
        $tipoDoc    = $rs->fields["SGD_TPR_DESCRIP"];
        $tipoDoc    = ucfirst(strtolower(substr($tipoDoc, 0, 30)));
        $rads       = $rs->fields["RADS"];
        $infoXtipoRojo[$tipoDoc]        += 0;
        $infoXtipoAmarillo[$tipoDoc]    = (int)$rads;
        $infoXtipoVerde[$tipoDoc]       += 0;
        $infoXtipoDoc[$tipoDoc]         = $tipoDoc;
        $rs->MoveNext();
    }
 
    $consul3    = $isqlIni . " AND $redondeo > 10 group by c.SGD_TPR_DESCRIP";
    $rs = $db->conn->Execute($consul3);

    while (!$rs->EOF) {
        $tipoDoc    = $rs->fields["SGD_TPR_DESCRIP"];
        $tipoDoc    = substr($tipoDoc, 0, 30);
        $rads       = $rs->fields["RADS"];
        $infoXtipoRojo[$tipoDoc]        += 0;
        $infoXtipoAmarillo[$tipoDoc]    += 0;        
        $infoXtipoVerde[$tipoDoc]       = (int)$rads;
        $infoXtipoDoc[$tipoDoc]         = $tipoDoc;
        $rs->MoveNext();
    }
    
    //Si el usuario no tiene datos 
    if(count($infoXtipoRojo == 0) 
        && count($infoXtipoAmarillo) == 0 
        && count($infoXtipoVerde) == 0 ){
        $barraRoja = $barraAmar = array(0);
        $barraVerd = array(1);
        $infoXtDoc = array('Sin radicados');
    }else{
        $barraRoja  = array_values($infoXtipoRojo);
        $barraAmar  = array_values($infoXtipoAmarillo);
        $barraVerd  = array_values($infoXtipoVerde);
        $infoXtDoc  = array_values($infoXtipoDoc);        
    }    
    //Arreglo a retonar
    $barraGrafica   = array($barraVerd, $barraAmar, $barraRoja, $infoXtDoc);
    //    line1 = [1    , 0     , 9     , 16];
    //    line2 = [25   , 12.5  , 6.25  , 3.125];
    //    line3 = [2    , 7     , 15    , 0];
    //    ticks = ['a'  , 'b'   , 'c'   , 'd'];

    
    /******************** FIN DATOS GRAFICA BARRAS    *************************/
    
    //formato de la respuesta    
    $salida         = array($tortaGrafica, $barraGrafica);
    print_r(json_encode($salida));
?>
<?PHP

/********* INICIALIZA LoS VALORES OBTENIDOS CON LOS RESULTADOS DE LA CONSULTA A LA BD *********/



            // Create field variables based on database fields	
		
            $fldRADICADO     =$rs->fields["RADICADO"];
            $fldEXP          =$rs->fields["EXPEDIENTE"];
            $fldNOMBRE       =$rs->fields["NOMBRE"];
            $fldDEPENDENCIA  =$rs->fields["DEPE_USUA"];
            $fldF_PEDIDO     =$rs->fields["F_PEDIDO"];
            $fldF_PEDIDO     =$rs->fields["F_PEDIDO"];
            $fldF_CANC       =$rs->fields["F_CANCELADO"];			
            $fldF_PRESTADO   =$rs->fields["F_PRESTADO"];
            $fldF_VENCIDO    =$rs->fields["F_VENCIDO"];
            $fldF_DEVUELTO   =$rs->fields["F_DEVUELTO"];
            $fldREQUERIMIENTO=$rs->fields["REQUERIMIENTO"];
            $fldNumPag       =$rs->fields["NUM_PAG"];
            $fldESTADO       =$rs->fields["ESTADO"];
            $fldID_ESTADO    =$rs->fields["ID_ESTADO"];						
            $fldLOGIN_PRES   =$rs->fields["LOGIN_PRES"];
            $fldLOGIN_RX     =$rs->fields["LOGIN_RX"];
            $fldLOGIN_CANC   =$rs->fields["LOGIN_CANC"];
            $fldLOGIN_ACTU   =$rs->fields["LOGIN_ACTU"];
            $fldPRESTAMO_ID  =$rs->fields["PRESTAMO_ID"];
            $fldDEPE_CODI    =$rs->fields["DEPENDENCIA_CODI"];
            $fldARCH         =$rs->fields["ESTADO_EXP"]; //"DEPE_ACTU"
            $fldPATH         =$rs->fields["PATH"];
    

            // Verifica si el estado es vencido

	    if ($fldID_ESTADO==2) {	
               $fecha_vencido   = str_replace("-","",$fldF_VENCIDO);
               $fecha_hoy       = str_replace("-","",date("Y-m-d"));
      	       if ($fecha_hoy>$fecha_vencido){ $fldESTADO="Vencido "; }
            }



            // Indica si el documento se encuentra actualmente archivado	
            if($fldEXP=="")     { $fldARCH="";   }
            else {
     	       if($fldARCH=="1"){ $fldARCH="SI"; }  
     	       else             { $fldARCH="NO"; }              
            }
	

				
            // Determina si es o no posible cancelar la solicitud
  	    $accion="";
	    if (strcasecmp($fldLOGIN_ACTU,$ps_USUA_LOGIN)==0 && strlen($fldF_CANC)==0 && strlen($fldF_VENCIDO)==0 && strlen($fldF_DEVUELTO)==0 && strlen($fldF_PRESTADO)==0) { 
	       $accion="<a href=\"$ruta_raiz/solicitar/Reservar.php?&krd=".tourl($krd)."&s_PRES_ID=".tourl($fldPRESTAMO_ID).
	               "&dependencia=".tourl($fldDEPE_CODI)."&FormAction=delete&radicado=".tourl($fldRADICADO)."&s_PRES_REQUERIMIENTO=&\"><font class=\"ColumnFONT\">Cancelar Solicitud</font></a>";
	    }



	    // Cálculo del tiempo de espera

 	    $difFecha="";
	    if($opcionMenu==1 || $opcionMenu==3){ 
	       $s = strtotime(date("Y-m-d h:i A"))-strtotime($fldF_PEDIDO);
               $difFecha = intval($s/86400);
	    }	
	    elseif ($opcionMenu==2 && $fldID_ESTADO==2) { 
	       $s = strtotime($fldF_VENCIDO)-strtotime(date("Y-m-d h:i A"));
               $difFecha = intval($s/86400);
	    }	
?>		 
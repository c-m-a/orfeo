<?PHP

/********* INICIALIZA LAS VARIABLES PRESENTADAS EN LOS RESULTADOS DE LA BUSQUEDA CON LOS OBTENIDOS *********/
/********* EN LA CONSULTA A LA BASE DE DATOS. SE HACE PARA DARLE MANEJO A LOS REGISTROS DE PRESTAMO*********/
/********* QUE PERTENECEN A VARIOS EXPEDIENTES                                                     *********/



            // Create field variables based on database fields	
		
            $antfldRADICADO     =$fldRADICADO;
            $antfldEXP          =$fldEXP;
            $antfldNOMBRE       =$fldNOMBRE;
            $antfldDEPENDENCIA  =$fldDEPENDENCIA;
            $antfldF_PEDIDO     =$fldF_PEDIDO;
            $antfldF_CANC       =$fldF_CANC;			
            $antfldF_PRESTADO   =$fldF_PRESTADO;
            $antfldF_VENCIDO    =$fldF_VENCIDO;
            $antfldF_DEVUELTO   =$fldF_DEVUELTO;
            $antfldREQUERIMIENTO=$fldREQUERIMIENTO;
            $antfldNumPag       =$fldNumPag;
            $antfldESTADO       =$fldESTADO;
            $antfldID_ESTADO    =$fldID_ESTADO;						
            $antfldLOGIN_PRES   =$fldLOGIN_PRES;
            $antfldLOGIN_RX     =$fldLOGIN_RX;
            $antfldLOGIN_CANC   =$fldLOGIN_CANC;
            $antfldLOGIN_ACTU   =$fldLOGIN_ACTU;
            $antfldPRESTAMO_ID  =$fldPRESTAMO_ID;
            $antfldDEPE_CODI    =$fldDEPE_CODI;
	    if ($fldARCH=='SI') {
  	       $encabARCH = session_name()."=".session_id()."&buscar_exp=".tourl($fldEXP)."&krd=$krd&tipo_archivo=&nomcarpeta=";
	       $antfldARCH="<a href='".$ruta_raiz."/expediente/datos_expediente.php?".$encabARCH."&num_expediente=".tourl($fldEXP)."&nurad=".tourl($antfldRADICADO)."' class='vinculos'>".$fldARCH."</a>";
	    }
            else { $antfldARCH=$fldARCH; }
  	    $antaccion          =$accion;
 	    $antdifFecha        =$difFecha;
            $antfldPATH         =$fldPATH;
?>		 
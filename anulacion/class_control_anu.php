<?
   class CONTROL_ORFEO
   {
   var $cursor;
   var $db;
   var $num_expediente;  // Almacena el nume del expediente
   var $estado_expediente; // Almacena el estado 0 para organizaci�n y 1 para indicar ke ya esta clasificado fisicamente en archivo
   var $exp_titulo;
   var $exp_asunto;
   var $exp_ufisica;
   var $exp_isla;
   var $exp_caja;
   var $exp_estante;
   var $exp_carpeta;
   var $exp_num_carpetas;
   var $campos_tabla;
   var $campos_vista;
   var $campos_width;
   var $campos_align;
   var $tabla_html;
   var $archi_csv;
   var $tabla_htmlA;
     function CONTROL_ORFEO(& $db)
	 {
	 $this->cursor = & $db;
	 $this->db = & $db;	 
	 }
	 // FUNCION PARA LEER DE LA BD
	 function consulta_exp($radicado)
	 {
				$query="select SGD_EXP_NUMERO,RADI_NUME_RADI,SGD_EXP_ESTADO from SGD_EXP_EXPEDIENTE where RADI_NUME_RADI = $radicado";		 
				$rs=$this->cursor->query($query);
				if (!$rs){
 				     $this->num_expediente = $rs->fields["SGD_EXP_NUMERO"];
					 $this->estado_expediente = $rs->fields["SGD_EXP_ESTADO"];
				 }
				 else
				 	{
				    echo 'No tiene un Numero de expediente<br>';
					$this->num_expediente = "";
					$num_expediente = "";
					}
				return $num_expediente;
	 }
	 // FIN FUNCION PARA LEER
	 // Funcion para insertar un expediente nuevo apartir de un numero de radicado
	 function insertar_expediente($num_expediente,$radicado,$depe_codi,$usua_codi,$usua_doc)
	 {
	 			$estado_expediente =0;
				$record["SGD_EXP_NUMERO"]="$num_expediente";
				$record["RADI_NUME_RADI"]="$radicado";				
				$record["SGD_EXP_FECH"]= $this->db->conn->OffsetDate(0,$this->db->conn->sysTimeStamp);
				$record["DEPE_CODI"]="$depe_codi";
				$record["USUA_CODI"]="$usua_codi";				
				$record["USUA_DOC"]="$usua_doc";
				$record["SGD_EXP_ESTADO"]="$estado_expediente";
				$rs=$this->cursor->insert("SGD_EXP_EXPEDIENTE",$record);
																		   
				if ($rs==false){
				   echo '<br>Lo siento no pudo agregar el expediente<br>';
				}else{
				   echo "<br>Expediente Grabado Correctamente<br>";
				}
			
     }
	 function modificar_expediente($radicado,$num_expediente,$exp_titulo,$exp_asunto,$exp_ufisica,$exp_isla,$exp_caja,$exp_estante,$exp_carpeta)
	 {
	 			$estado_expediente =0;
				$record["SGD_EXP_NUMERO"]=$num_expediente;
				$record["SGD_EXP_TITULO"]="'".$exp_titulo."'";
				$record["SGD_EXP_ASUNTO"]="'".$exp_asunto."'";
				$record["SGD_EXP_UFISICA"]="'".$exp_ufisica."'";
				$record["SGD_EXP_ISLA"]="'".$exp_isla."'";
				$record["SGD_EXP_CAJA"]="'".$exp_caja."'";
				$record["SGD_EXP_ESTANTE"]="'".$exp_estante."'";
				$record["SGD_EXP_CARPETA"]="'".$exp_carpeta."'";
				$record["SGD_EXP_ESTADO"]='1';
				$record["SGD_EXP_FECH_ARCH"]=$this->db->conn->OffsetDate(0,$this->db->conn->sysTimeStamp);
				$record1["RADI_NUME_RADI"] = $radicado;
				$rs= $this->cursor->update("sgd_exp_expediente", $record, $record1);						
				if ($rs == false){
				echo '<br>Lo siento no pudo Actualizar los datos del expediente<br>';
				}else{
				echo "<br>Datos de expediente Grabados Correctamente<br>";
				}
     }	 
	 function datos_expediente($radicado,$num_expediente)
	 {
	 			$estado_expediente =0;
			    $query="select max(SGD_EXP_CARPETA) tt
						from sgd_exp_expediente
						WHERE
						SGD_EXP_NUMERO='$num_expediente'
						group by SGD_EXP_NUMERO ";
				$rs=$this->cursor->query($query);
				if (!$rs){
				    echo 'No tiene un N�mero de expediente<br>';
				 }else{
				   if ($rs->MoveNext()) $this->exp_num_carpetas = $rs->fields["tt"];
				}
			    $query="select
						SGD_EXP_TITULO
						,SGD_EXP_ASUNTO
						,SGD_EXP_UFISICA
						,SGD_EXP_ISLA
						,SGD_EXP_CAJA
						,SGD_EXP_ESTANTE
						,SGD_EXP_CARPETA
						from sgd_exp_expediente
						WHERE
						SGD_EXP_NUMERO='$num_expediente'
						and RADI_NUME_RADI = $radicado
						";
					
				$rs=$this->cursor->query($query);
				 $this->cursor->query($query);
				if (!$rs->EOF){

				  $this->exp_titulo = "'" . $rs->fields["sgd_exp_titulo"]."'";
				  $this->exp_asunto = "'" . $rs->fields["sgd_exp_asunto"] ."'";
				  $this->exp_ufisica = "'" . $rs->fields["sgd_exp_ufisica"] ."'";
				  $this->exp_isla = $rs->fields["sgd_exp_isla"] ;
				  $this->exp_caja = $rs->fields["sgd_exp_caja"] ;
				  $this->exp_estante = $rs->fields["sgd_exp_estante"] ;
				  $this->exp_carpeta = $rs->fields["sgd_exp_carpeta"] ;
				}else{
				   echo "<br>No se encontraron datos del expediente<br>";
				}
     }

	 // Fin funci�n de Inseci�n de expediente.
	 // Funcion que consulta un envio de radicado...
	 function consulta_envio($radicado)
	 {
				$query="select RADI_NUME_GRUPO,RADI_NUME_SAL from SGD_RENV_REGENVIO where RADI_NUME_GRUPO like '%$radicado%'";
				$rs=$this->cursor->query($query);				
				if (!$rs->EOF){
		              $grupo = "";
				 }else{
				   if ($rs->MoveNext())
				   {
					 $grupo = $rs->fields["RADI_NUME_SAL"];
				   }
				}
				return "$grupo";
	 }

	 function radicar_salida($tipoanexo,$cuentai,$documento_us3 ,$med ,$fec,$radicadopadre,$codusuario,$tip_doc ,$ane,$pais,$asu,$coddepe,$carp_codi,$tip_rem,$numdoc,$tdoc,$dpto_codi,$muni_codi,$archivo,$usua_doc,$depe_codi_territorial)
	 {
	 			$sec=$this->cursor->nextId("sec_$depe_codi_territorial");
				
				if ($sec!=-1){
				        
					  $sec = str_pad($sec,6,"0",STR_PAD_left);
						$nurad = date("Y") . $coddepe . $sec ."1";
						$carp_codi = 5;
						$query="insert into radicado(radi_tipo_deri  ,radi_cuentai,eesp_codi       ,mrec_codi  ,radi_fech_ofic,radi_nume_deri  ,radi_usua_radi,tdid_codi,radi_desc_anex,radi_nume_hoja,radi_pais,ra_asun ,radi_depe_radi,radi_usua_actu,carp_codi   ,radi_nume_radi,trte_codi ,radi_nume_iden,radi_fech_radi ,radi_depe_actu  ,tdoc_codi  ,esta_codi,dpto_codi ,muni_codi     ,radi_path,carp_per)
												 values ('$tipoanexo','$cuentai'  ,'$documento_us3','$med'     ," .$db->conn->OffsetDate(0,$db->conn->sysTimeStamp)."      ,'$radicadopadre','$codusuario' ,'$tip_doc','$ane'        ,0             ,'$pais'  ,'$asu' ,'$coddepe'    ,'$codusuario' ,'$carp_codi','$nurad'      ,'$tip_rem','$numdoc'     ," .$db->conn->OffsetDate(0,$db->conn->sysTimeStamp)."       ,'$coddepe'      ,'$tdoc'    ,9        ,'$dpto_codi','$muni_codi','$archivo',1)";
						$rs=$this->cursor->query($query);
	
						if (!$rs){
							$this->cursor->conn->RollbackTrans();
							die ("<span class='etextomenu'>No se ha podido insertar la informaci�n del nuevo radicado $nurad"); 
						}
										
				}else{
					$this->cursor->conn->RollbackTrans();
					die ("<span class='etextomenu'>No existe secuencia para la generaci�n del radicado (Territorial $depe_codi_territorial)");
				}
				return $nurad;
	 }
	 function grabar_usuario($no_documento,$nombre_us1,$direccion_us1,$prim_apell_us1,$seg_apell_us1,$telefono_us1,$mail_nus1,$codep_us,$muni_us)
	 {
	   $query = "select max(SGD_CIU_CODIGO) as MAXIMO  from SGD_CIU_CIUDADANO";
		 $rs=$this->cursor->query($query);
		 
		 	if  (!$rs->EOF) {
		 		$nextval=$rs->fields['MAXIMO'];
			}else{
				$nextval=0;
			}
			$nextval++;
			$query = "INSERT INTO SGD_CIU_CIUDADANO(
								SGD_CIU_CEDULA    ,TDID_CODI,SGD_CIU_CODIGO,SGD_CIU_NOMBRE,SGD_CIU_DIRECCION,SGD_CIU_APELL1   ,SGD_CIU_APELL2    ,SGD_CIU_TELEFONO,SGD_CIU_EMAIL  ,DPTO_CODI   ,MUNI_CODI)
						   values ('$no_documento',2        ,$nextval      ,'$nombre_us1' ,'$direccion_us1','$prim_apell_us1','$seg_apell_us1','$telefono_us1','$mail_us1' ,'$codep_us','$muni_us')";
			$rs=$this->cursor->query($query);			
			
			if (!$rs){
				$this->cursor->conn->RollbackTrans();
				die ("<span class='etextomenu'>No se ha podido insertar la informaci�n del nuevo usuario ($query)"); 
			}
			
			return $nextval;
	 }
	 function grabar_oem($no_documento,$nombre_us1,$direccion_us1,$prim_apell_us1,$seg_apell_us1,$telefono_us1,$mail_nus1,$codep_us,$muni_us)
	 {
	   $query = "select max(SGD_OEM_CODIGO) as MAXIMO  from SGD_OEM_OEMPRESAS ";
		 $rs=$this->cursor->query($query);
			
		 if  (!$rs->EOF) {
		 		$nextval=$rs->fields['MAXIMO'];
		 }else{
				$nextval=0;
		 }
		 $nextval++;
		 $query =  "INSERT INTO SGD_OEM_OEMPRESAS(tdid_codi,SGD_OEM_CODIGO ,SGD_OEM_NIT    ,SGD_OEM_OEMPRESA,SGD_OEM_DIRECCION ,SGD_OEM_REP_LEGAL   ,SGD_OEM_TELEFONO,DPTO_CODI   ,MUNI_CODI)
					                                                  values (4        ,$nextval       ,'$no_documento','$nombre_us1'   ,'$direccion_us1'  ,'$prim_apell_us1'   ,'$telefono_us1' ,'$codep_us','$muni_us'  )";
		 $rs=$this->cursor->query($query);		
		 
		 if (!$rs){
				$this->cursor->conn->RollbackTrans();
				die ("<span class='etextomenu'>No se ha podido insertar la informaci�n de OEM ($query)"); 
			}												
			return $nextval;
	 }
	 function grabar_dir($tipo_rem,$nombre,$prim_apell,$seg_apell,$dignatario,$direccion,$depto,$muni,$radicado,$cod_usuario)
	 {
	          $isql = "insert into SGD_DIR_DRECCIONES(MUNI_CODI         ,DPTO_CODI ,SGD_OEM_CODIGO    ,SGD_CIU_CODIGO ,SGD_ESP_CODI   ,RADI_NUME_RADI,SGD_SEC_CODIGO ,SGD_DIR_DIRECCION  ,SGD_DIR_TELEFONO ,SGD_DIR_MAIL,SGD_DIR_TIPO,SGD_DIR_CODIGO,SGD_DIR_NOMBRE)";
	          $isql .= "                      values($muni              ,$depto    ,0                 ,0              ,$esp           ,$nurad        ,0              ,'$direccion'       ,'$telefono'      ,'$mail_us1' ,1           ,$nextval      ,'$nombre' )";
				$query="select sec_$coddepe.nextval as SEC from dual";
				echo "$query <br>";
				if ($this->cursor->query($query)){
				        $this->cursor->next_record();
						$sec = $this->cursor->f('sec');
					    $sec = str_pad($sec,5,"0",STR_PAD_left);
						$nurad = date("Y") . $coddepe . $sec ."1";
						$carp_codi = 5;
						$query="insert into radicado(radi_tipo_deri  ,radi_cuentai,eesp_codi       ,mrec_codi  ,radi_fech_ofic,radi_nume_deri  ,radi_usua_radi,tdid_codi,radi_desc_anex,radi_nume_hoja,radi_pais,ra_asun ,radi_depe_radi,radi_usua_actu,carp_codi   ,radi_nume_radi,trte_codi ,radi_nume_iden,radi_fech_radi ,radi_depe_actu  ,tdoc_codi  ,esta_codi,dpto_codi ,muni_codi     ,radi_path,carp_per)
												 values ('$tipoanexo','$cuentai'  ,'$documento_us3','$med'     ," .$db->conn->OffsetDate(0,$db->conn->sysTimeStamp)."      ,'$radicadopadre','$codusuario' ,'$tip_doc','$ane'        ,0             ,'$pais'  ,'$asu' ,'$coddepe'    ,1             ,'5'         ,'$nurad'      ,'$tip_rem','$numdoc'     ," .$db->conn->OffsetDate(0,$db->conn->sysTimeStamp)."        ,'$coddepe'      ,'$tdoc'    ,9        ,'$dpto_codi','$muni_codi','$archivo','1')";
						if (!$this->cursor->query($query)){
							  echo "No se pudo realizar la consulta . . . ";
						 }else{
							  //echo "Se agrego el radicado correctamente . . . ";
						}
						//$this->num_expediente = $num_expediente;
				}
				return $nurad;
	 }
	 function tabla_sql($query)
	 {
	 	error_reporting(7);
	    $jh_db = $this->cursor->query($query);
	    //echo "<br>Numero de Registros " . $this->cursor->num_row();
		if ($jh_db) 
		{
		   $numreginf = 0;
		 	while(!$jh_db->EOF)
				{ 
	  				$numreginf++;
					 $jh_db->MoveNext();
	  			}
			echo "<p><span class=listado2>Numero de Registros " . $numreginf."</span>";
		}
		global $ADODB_FETCH_MODE;
		$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
		$jh_db = $this->cursor->conn->Execute($query);
	    $tabla_html = "<table border=1 width=100%>";
	    echo "<table class='borde_tab' width=100%>";
		if ($jh_db)
		  {
			echo "<tr class='titulos2'>";
			$tabla_html .= "<tr bgcolor='#D0D0FF'>";
			$iii = 0;
			foreach($this->campos_vista as $campos_d)
			  {
	        	$width = $this->campos_width[$iii];
				$tabla_html .=  "<td width='$width' bgcolor='#CCCCCC'><center>$campos_d</td>";
				echo "<td class='titulos2'  ><center>$campos_d</td>";
				$iii++;
		      }
			$tabla_html .=  "</tr>";
			echo "</tr>";
			$i = 0;
			while(!$jh_db->EOF)
			 {
				$tabla_html .=  "<tr>";
				echo "<tr class='listado2'>";
				$iii = 0;
				foreach($this->campos_tabla as $campos_d)
				  {
	
				 	switch  ($this->campos_align[$iii])
					  {
						case "L":
							$align = "Left";
							break;
						case "C":
							$align = "Center";
							break;
						case "R":
							$align = "Right";
							break;
						default:
							$align = "Left";
							break;
					  }
					error_reporting(7);
		
					$width = $this->campos_width[$iii];
					$width_max = intval(36 * $width / 250);
					if(!$jh_db->fields($campos_d)) $dato = "-"; else $dato=substr($jh_db->fields($campos_d),0,$width_max);
					$tabla_html .=  "<td  align=$align width=".$this->campos_width[$iii]." height=23>$dato</td>";
					echo "<td class='listado2' align=$align>".$jh_db->fields($campos_d)."</td>";
					$iii++;
				}
			$tabla_html .=  "</tr>";
			echo "</tr>";
			$jh_db->MoveNext();
		}
	$tabla_html .=  "</table>";
	$this->tabla_html = $tabla_html;
	echo "</table>";
	return $nextval;
   }
}
 function generacsv($query)
	 {
	 error_reporting(7);
	 $jh_db = $this->cursor->query($query);
	$iii = 0;
	$i = 0;
	while(!$jh_db->EOF)
	{
	 $iii = 0;
		foreach($this->campos_tabla as $campos_d)
		{
		    if(!$jh_db->fields($campos_d)) $dato = "-"; else $dato=$jh_db->fields($campos_d);
		    $contenido = $contenido ."$com$dato$com,";
		    $iii++;
		}
		$numChar= strlen(trim($contenido));
		$numChar = $numChar - 1;
		$contenido = substr($contenido,0,$numChar);
        $contenido= $contenido ."\n";
	$jh_db->MoveNext();
	
	}
	$this->archi_csv = $contenido;
	return $nextval;
     } 
	 
  }
	
?>

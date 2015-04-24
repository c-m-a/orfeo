<? 
/*  CLASS jhrtf
 *  @autor JAIRO LOSADA - SIXTO
 *  @fecha 2003/10/16
 *  @version 0.1
 *  Permite hacer combinación de correspondencia desde php con filas rtf-
 *  @VERSION 0.2 
 *  @fecha 2003/01/22
 *  Se añade combinación masiva // COMPATIBILIDAD CON WORD
 */
class jhrtf
{
 var $archivo_inicial;  // Ubicacion fisica del archivo a combinar
 var $archivo_final;    // Archivo conbinado
 var $alltext;          // ubicacion fisica del archivo a convertir 
 var $texto;  			// utilizado para combinar el vualquier texto
 var $texto_masivo;  			// utilizado para combinar el vualquier texto 
 var $encabezado;
 var $datos;
 var $ruta_raiz;
 var $definitivo;
 function jhrtf($archivo_inicial,$archivo_final,$ruta_raiz,$definitivo)
  {
     $this->archivo_inicial = $archivo_inicial;
	 $this->archivo_final = $archivo_final;
 	 $this->ruta_raiz = $ruta_raiz;
 	 $this->definitivo = $definitivo;	 
     
  }
  /* Función que abre el archivo y lo coloca en la variable
   * alltext
   */
  function abrir()
  {
		$h = fopen($this->archivo_inicial,"r") or $flag=2; 
		if (!$h) { 
		  echo "No hay una plantilla llamada $this->archivo_inicial"; 
		}else{
		$this->alltext = "";
		$paginas = 0;
		while ($line=fgets($h,81))
		 {
			$this->alltext.=$line . "";
			$paginas=$paginas +1;
		 }
		}     
  }
  function grabar()
  {	   print ("ENTRA A GRABAR");
       $fp=fopen($this->archivo_final,"w");
	   $this->alltext .="}";
	   fputs($fp,$this->alltext);
	   fclose($fp);
	   print ("GRABA  " . $this->archivo_final);
  }
  /* La función recibe en el costructor  los arreglos
   * $campos los campos que buscara en el archivo y 
   * $datos por los que se reemplazaran dichos campos
   */
  function combinar($campos=array(),$datos=array())
   { 
       $this->abrir();
	   $i=0;
	   foreach($campos as $campos_d) {
	   $this->alltext = str_replace($campos_d,$datos[$i],$this->alltext);
		$i++;
       }
	   $this->grabar();
   }
  /* 
   * $campos los campos que buscara en el archivo y 
   * $datos por los que se reemplazaran dichos campos
   * La diferencia con combinar es que  combina  solo el pedazo de texto en la variable texto 
   */    
  function combinar_csv($dependencia,$codusuario,$usua_doc,$archivo) 
   {   error_reporting(7);
       $this->abrir();
	   print ("0");
	                require $this->ruta_raiz."/class_control/class_control.php";
					print ("1");
				    $btt = new CONTROL_ORFEO($this->ruta_raiz);		
					echo "<p><b></center><span class=etextomenu align=left>Listado de datos de envio</b><br>Fecha Generado". date("Y/m/d") . "Hora "  ;		
					echo "<table class='t_bordeGris'>";
					echo "<tr class=timpar ><th >Registro</th><th >Radicado</th><th>Nombre</th><th>Direccion</th><th>Depto</th><th>Municipio</th></tr>";					
	   for($ii=0; $ii < count ($this->datos) ; $ii++) 
	   {   $i=0;
 			        // Aqui se accede a la clase class_control para actualizar expedientes.
			$ruta_raiz = "../..";		
		   $texto_tmp = $this->texto;	
		   foreach($this->encabezado[0] as $campos_d) {
		   	 // echo ("****  ".$campos_d . "  " . $this->datos[$ii][$i]."  ***"); 
			 $dato_r = $this->datos[$ii][$i];
             $texto_tmp = str_replace($campos_d,$dato_r,$texto_tmp);		   			 
				if($campos_d=="*TIPO*") $tip_doc =$dato_r;
				if($campos_d=="*NOMBRE*") $nombre =$dato_r;
				if($campos_d=="*DOCUMENTO*") $doc_us1 =$dato_r;
				if($campos_d=="*NOMBRE*") $nombre_us1 =$dato_r;
				if($campos_d=="*PRIM_APEL*") $prim_apel_us1 =$dato_r;
				if($campos_d=="*SEG_APEL*") $prim_apel_us2 =$dato_r;
				if($campos_d=="*DIGNATARIO*") $otro_us1 =$dato_r;
				if($campos_d=="*DIR*") $direccion_us1 =$dato_r;
				if($campos_d=="*TELEFONO*") $telefono_us1 =$dato_r;				
				if($campos_d=="*MUNI*") $muni_codi =$dato_r;
				if($campos_d=="*DEPTO*") $dpto_codi =$dato_r;
				if($campos_d=="*ASUNTO*") $asu =$dato_r;
				if($campos_d=="*ID*") $sgd_esp_codigo =$dato_r;				
				if($campos_d=="*DESC_ANEXOS*") $desc_anexos =$dato_r;
				$tipo_anexo = "0";$cuentai="";
				$documento_us3="";$med="";$fec="";$radicadopadre="";
				$tip_doc="1";$ane="";$pais="COLOMBIA";
				$carp_codi="12";
				$i++;
		   }
		    $tip_rem="1";
		   $numdoc="79802120";$tdoc="3";
		   	 $muni_us1 = $muni_codi;
			 $codep_us1= $dpto_codi;
		   if($this->definitivo=="si")
		   {
		   // COMENTARIADO **********************************************
		   //  $nurad = $btt->radicar_salida($tipoanexo,$cuentai,$documento_us3 ,$med ,$fec,$radicadopadre,$codusuario,$tip_doc ,$ane,$pais,$asu,$dependencia,$carp_codi,$tip_rem,$numdoc,$tdoc,$dpto_codi,$muni_codi,$archivo);
			 $nombre = $nombre_us1;
			 $documento_us1=$sgd_esp_codigo;
			 $documento_us2 = "";
			 $documento_us3 = "";
			 $mail_us1;
			 $tipo_emp_us1=1;
			 $cc_documento_us1="documento"; 
			 // COMENTARIADO **********************************************
			 /*include "$ruta_raiz/config.php";
	         ora_commiton($handle); 
	         $cursor = ora_open($handle);*/
			 // COMENTARIADO **********************************************
             //include "$ruta_raiz/radicacion/grb_direcciones.php";			   
			}else
			{
			  		$sec = $ii;
					$sec = str_pad($sec,5,"X",STR_PAD_left);
				    $nurad = date("Y") . $dependencia . $sec ."1X";	
			}
		    $texto_tmp = str_replace("*RAD_S*",$nurad,$texto_tmp);	       
		    $texto_tmp = str_replace("*F_RAD_S*",date("d/m/Y"),$texto_tmp);	       		   
				if($muni_codi and $dpto_codi)
				{
				   // COMENTARIADO **********************************************
				   /*include "$ruta_raiz/jh_class/funciones_sgd.php";
				   $a = new LOCALIZACION($codep_us1,$muni_us1,$ruta_raiz); 
				   $dpto_nombre = $a->departamento;
				   $muni_nombre = $a->municipio;*/
				   $texto_tmp = str_replace("*DEPTO_NOMB*",$dpto_nombre,$texto_tmp);	       
				   $texto_tmp = str_replace("*MUNI_NOMB*",$muni_nombre,$texto_tmp);	       		   
				}		   
		   if($ii!=0) $this->texto_masivo .=  " \\par \\page\\pard\\plain \\ltrpar\\s1\\cf0\\ql\\rtlch\\af5\\afs22\\lang255\\ltrch\\dbch\\afs22\\langfe255\\loch\\f5\\fs22\\lang9226 ";
		   $this->texto_masivo .= $texto_tmp;
		   $texto_tmp = "";
		   $contador = $ii + 1;
		   echo "<tr class='t_bordeGris'><td class='t_bordeGris'  align=left>$contador</td><td class='t_bordeGris'  align=left>$nurad</td><td class='t_bordeGris' align=left>$nombre</td><td class='t_bordeGris'  align=left>$direccion_us1</td>
		          <td class='t_bordeGris'  align=left>$dpto_nombre</td><td class='t_bordeGris'  align=left>$muni_nombre</td></tr>";
	   }
	   					echo "</table>";
	   echo "Numero de registros $contador";
	   $this->texto_masivo .= " \\par }";
	   $this->alltext = $this->texto_masivo;
	   $this->grabar();
   }   
  function pb_busqueda($cadena_inicio,$cadena_fin,$dependencia,$codusuario,$usua_doc,$archivo)
  {
  	
	error_reporting(7);
     $this->abrir();
     $tamano = strlen($this->alltext);
     $pos_cadena_ini = strpos($this->alltext,$cadena_inicio);
	 $prim_llave=strpos($this->alltext,"{",$pos_cadena_ini+1); 
	 $ult_llave= strrpos ($this->alltext, "}");

     //$pos_cadena_fin = strpos($this->alltext,$cadena_fin);	 
	 $this->texto = substr($this->alltext,$prim_llave,$ult_llave-$prim_llave);
	// $this->texto = substr($this->alltext,$prim_llave,$ult_llave-$prim_llave);
 	 $this->texto_masivo = substr($this->alltext,0,$prim_llave-1);
	 $this->combinar_csv($dependencia,$codusuario,$usua_doc,$archivo);
	 //print ("ver ".$prim_llave."  ".$ult_llave."    ".$tamano);
	 //print("     "); 
	//print ($this->texto);
	 
}
 function cargar_csv($archivo_csv) {
 		$h = fopen($archivo_csv,"r") or $flag=2; 
		if (!$h) { 
		   // echo "No hay un archivo csv llamado  $archivo_csv"; 
		}else{
		$this->alltext_csv = "";
		$this->encabezado = array();
		$this->datos = array();
		$j=-1;
		while ($line=fgetcsv ($h, 10000, ","))
		 {
		$j++;
		if ($j==0)	
			$this->encabezado = array_merge ($this->encabezado,array($line));
		else
			$this->datos=  array_merge ($this->datos,array($line));
		
		} // while get  
		
		// echo ("El encabezado es " . $this->encabezado[0][0] .", ". $this->encabezado[0][1] .", ". $this->encabezado[0][2] .", ");
		// echo ("Las lineas de datos son " . count ($this->datos));
		$c=0;
		while ($c < count ($this->datos)){
			$c++;
		}
		
		
 
 }// else
 
 } // funcion




}
?>
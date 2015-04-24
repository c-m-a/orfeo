<? 
/*  CLASS jhrtf
 *  @autor JAIRO LOSADA
 *  @fecha 2003/10/16
 *  @version 0.1
 *  Permite hacer combinaci�n de correspondencia desde php con filas rtf-
 *  
 */ 
class jhrtf
{
 var $archivo_inicial;  // Ubicacion fisica del archivo a combinar
 var $archivo_final;    // Archivo conbinado
 var $alltext;          // ubicacion fisica del archivo a convertir 
 var $alltext_csv;          // ubicacion fisica del archivo a convertir 
 var $texto;  			// utilizado para combinar el vualquier texto
 var $texto_masivo;  			// utilizado para combinar el vualquier texto 
 var $encabezado;
 var $datos;
 function jhrtf($archivo_inicial,$archivo_final)
  {
     $this->archivo_inicial = $archivo_inicial;
	 $this->archivo_final = $archivo_final;
     
  }
  /* Funci�n que abre el archivo y lo coloca en la variable
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
  {	   $fp=fopen($this->archivo_final,"w");
	   fputs($fp,$this->alltext);
	   fclose($fp);
  }
  /* La funci�n recibe en el costructor  los arreglos
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
  function combinar_csv()
   { 
       $this->abrir();
	   for($ii=0; $ii<=4; $ii++)
	   {   $i=0;
           $campos = array ("*DESTINATARIO*"            ,"*DIRECCION*"     ,"TELEFONO"  ,"*ASUNTO*","*F_RAD_E*"            ,"*NOM_R*"        ,"*DIR_R*"         ,"*DEPTO_R*"     ,"*MPIO_R*"        ,"*TEL_R*"      ,"*MAIL_R*","*DOC_R*"          ,"*NOM_P*"       ,"*DIR_P*"      ,"*DEPTO_P*"         ,"*MPIO_P*"        ,"*TEL_P*"      ,"*MAIL_P*","*DOC_P*"          ,"*NOM_E*"     ,"*DIR_E*"       ,"*MPIO_E*"     ,"*DEPTO_E*"        ,"*TEL_E*"       ,"*MAIL_E*","*NIT_E*"          ,"*F_RAD_S*"       ,"*RAD_E*","*SECTOR*"       ,"*NRO_PAGS*"   ,"*DESC_ANEXOS*","*F_HOY_CORTO*"    ,"*F_HOY*");
		   $datos = array  ("jhRAD_S AKSDFJASDHF "      ,"jhRAD_E_PADRE"   ,"6913005"   ,"*ASUNTO*","y23523454"            ,"*NOM_R*"        ,"*DIR_R*"         ,"*DEPTO_R*"     ,"*MPIO_R*"        ,"*TEL_R*"      ,"*MAIL_R*","*DOC_R*"          ,"*NOM_P*"       ,"*DIR_P*"      ,"*DEPTO_P*"         ,"*MPIO_P*"        ,"*TEL_P*"      ,"*MAIL_P*","*DOC_P*"          ,"*NOM_E*"     ,"*DIR_E*"       ,"*MPIO_E*"     ,"*DEPTO_E*"        ,"*TEL_E*"       ,"*MAIL_E*","*NIT_E*"          ,"*F_RAD_S*"       ,"*RAD_E*","*SECTOR*"       ,"*NRO_PAGS*"   ,"*DESC_ANEXOS*","*F_HOY_CORTO*"    ,"*F_HOY*");
		   $texto_tmp = $this->texto;	
		   foreach($campos as $campos_d) {
		      $texto_tmp = str_replace($campos_d,$datos[$i],$texto_tmp);
			  $i++;
		   }
		   if($ii!=0) $this->texto_masivo .=  " \\par \\page\\pard\\plain \\ltrpar\\s1\\cf0\\ql\\rtlch\\af5\\afs22\\lang255\\ltrch\\dbch\\afs22\\langfe255\\loch\\f5\\fs22\\lang9226 ";
		   $this->texto_masivo .= $texto_tmp;
		   $texto_tmp = "";
		   echo "Paso $ii<br>";
	   }
	   $this->texto_masivo .= " \\par }";
	   $this->alltext = $this->texto_masivo;
	   $this->grabar();
   }   
  function pb_busqueda($cadena_inicio,$cadena_fin)
  {
  	error_reporting(7);
     $this->abrir();
     $tamano = strlen($this->alltext);
     $pos_cadena_ini = strpos($this->alltext,$cadena_inicio);
     $pos_cadena_fin = strpos($this->alltext,$cadena_fin);	 
	 echo "---- $tamano  ---- $pos_cadena_ini --- $pos_cadena_fin";
	 $this->texto = substr($this->alltext,$pos_cadena_ini,$tamano-$pos_cadena_ini-6);
 	 $this->texto_masivo = substr($this->alltext,0,$pos_cadena_ini-1);
	 $this->combinar_csv();

  }
 function cargar_csv($archivo_csv) {
 		$h = fopen($archivo_csv,"r") or $flag=2; 
		if (!$h) { 
		  echo "No hay un archivo csv llamado  $archivo_csv"; 
		}else{
		$this->alltext_csv = "";
		$this->encabezado = array();
		//$this->datos = array();
		$j=-1;
		while ($line=fgetcsv ($h, 10000, ";"))
		 {
		$j++;
		if ($j==0)	
			$this->encabezado = array_merge ($this->encabezado,array($line));
		else
			$this->datos=  array_merge ($this->datos,array($line));
		
		} // while get  
		
		/*echo ("El encabezado es " . $this->encabezado[0][0] .", ". $this->encabezado[0][1] .", ". $this->encabezado[0][2] .", ");
		echo ("Las lineas de datos son " . count ($this->datos));
		$c=0;
		while ($c < count ($this->datos)){
			
			echo ("**** " . $this->datos[$c][0] .", ". $this->datos[$c][1] .", ". $this->datos[$c][2] ." *** ");
			$c++;
		}
		*/
		
 
 }// else
 
 } // funcion


}
?>
<?
//muestra nombre mes
function nombremes($mes)
{
	switch($mes)
	{
		case "01":
			return "enero";
		case "02":
			return "febrero";
		case "03":
			return "marzo";
		case "04":
			return "abril";
		case "05":
			return "mayo";
		case "06":
			return "junio";
		case "07":
			return "julio";
		case "08":
			return "agosto";
		case "09":
			return "septiembre";
		case "10":
			return "octubre";
		case "11":
			return "noviembre";
		case "12":
			return "diciembre";
	}
}
//muestra nombre dia
function nombredia($dia)
{
	switch($dia)
		{
		case 1:
			return "Lunes";
		case 2:
			return "Martes";
		case 3:
			return "Miercoles";
		case 4:
			return "Jueves";
		case 5:
			return "Viernes";
		case 6:
			return "Sabado";
		case 7:
			return "Domingo";
		}
}
//inserta en cualquier tabla, los parametros campos y valores son arreglos
function inserta($tabla,$campos,$valores,$db)
{
	$tcampos=count($campos);
	$tvalores=count($valores);
	$sql="insert into ".$tabla;
	$sql.="(";
	$k=1;
	foreach($campos as $valorc)
		{
			$sql.=$valorc;
			if($k < $tcampos)
				$sql.=",";
			$k++;
		}
	$sql.=")values(";
	$k=1;
	foreach($valores as $valorv)
		{
			if(gettype($valorv)=="string")
				$sql.="'".$valorv."'";
			else	
				$sql.=$valorv;
			if($k < $tvalores)
				$sql.=",";
			$k++;
		}
	$sql.=")";
$db->conn->Execute($sql);
//echo $sql;
echo $db->ErrorMsg();
}
//\ el ultimo consecutivo de cualquier tabla
function consecutivo($tabla,$primaria,$db)
{
$sql="select MAX(".$primaria.") as cont from ".$tabla;
$rs=$db->conn->Execute($sql);
$ultimo=$rs->fields['cont'];
return $ultimo;
}
//borra un registro
function borra($tabla,$campo,$valor,$db)
{
$sql_del="delete from ".$tabla." where ".$campo."=".$valor;
$rs_del=$db->conn->Execute($sql_del);
}
//reemplaza tildes
function texto_ajax($texto)
{
	if($texto)
	{
		$texto=replace($texto,"�","&aacute;");
		$texto=replace($texto,"�","&Aacute;");
		$texto=replace($texto,"�","&eacute;");
		$texto=replace($texto,"�","&Eacute;");
		$texto=replace($texto,"�","&iacute;");
		$texto=replace($texto,"�","&Iacute;");
		$texto=replace($texto,"�","&oacute;");
		$texto=replace($texto,"�","&Oacute;");
		$texto=replace($texto,"�","&uacute;");
		$texto=replace($texto,"�","&Uacute;");
		$texto=replace($texto,"�","&ntilde;");
		$texto=replace($texto,"�","&Ntilde;");
		$texto=replace($texto,"�","&iquest;");
		$texto=replace($texto,"?","&#63;");
		
		
//		$texto=replace($texto,'"',"&quot;");
//		$texto=replace($texto,"\\","");
//		$texto=replace($texto,'"',"&quot;");
//		$texto=replace($texto,"\"","&");
	}
	return $texto;
}
function texto_ajax2($texto)
{
	if($texto)
	{
		$texto=replace($texto,"&aacute;","�");
		$texto=replace($texto,"&Aacute;","�");
		$texto=replace($texto,"&eacute;","�");
		$texto=replace($texto,"&Eacute;","�");
		$texto=replace($texto,"&iacute;","�");
		$texto=replace($texto,"&Iacute;","�");
		$texto=replace($texto,"&oacute;","�");
		$texto=replace($texto,"&Oacute;","�");
		$texto=replace($texto,"&uacute;","�");
		$texto=replace($texto,"&Uacute;","�");
		$texto=replace($texto,"&ntilde;","�");
		$texto=replace($texto,"&Ntilde;","�");
//		$texto=replace($texto,'"',"&quot;");
//		$texto=replace($texto,"\"","&");
	}
	return $texto;
}

function replace($original,$nuevo,$otro)
{
	return str_replace($nuevo,$otro,$original);
}
//funcion para validar direcciones de correo electronico
function check_email_address($email) 
{
	// Primero, chequeamos que solo haya un simbolo @, y que los largos sean correctos
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) 
	{
		// correo invalido por numero incorrecto de caracteres en una parte, o numero incorrecto de simbolos @
    return false;
  }
  // se divide en partes para hacerlo mas sencillo
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) 
	{
    if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) 
		{
      return false;
    }
  } 
  // se revisa si el dominio es una IP. Si no, debe ser un nombre de dominio valido
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) 
	{ 
     $domain_array = explode(".", $email_array[1]);
     if (sizeof($domain_array) < 2) 
		 {
        return false; // No son suficientes partes o secciones para se un dominio
     }
     for ($i = 0; $i < sizeof($domain_array); $i++) 
		 {
        if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) 
				{
           return false;
        }
     }
  }
  return true;
}
//validador de correos
function emailValidator($email){
	$email	= trim($email);
	if(!(preg_match('/^[\w\-\.]+[@][A-z0-9]+[\w\-.]*([.][A-z]{2,6}){1}([.][A-z]{2}){0,1}$/x',$email))){
		return false;
	}
	return true;
}
// web en miniatura
function miniatura_web($url, $servicio = "browsercamp", $tamanio = "1", $calidad = "high"){
	$tamanios = array("800", "832", "1024", "1280", "1600");
	$calidades = array("png" => "1", "high" => "2", "medium" => "3", "low" => "4");
	if("ipinfo" == $servicio){
		$sevicios = 'http://ipinfo.info/netrenderer/index.php?browser=ie7&url='.$url;
		$exp_info = '!http://renderer.geotek.de/image.php\?imgid=(.+)&browser=ie7!U';
		$query = @file_get_contents($sevicios);
		preg_match_all($exp_info, $query, $info);
		$s = $info[0][0];
		return $s;
	}
	if("browsercamp" == $servicio){
		$sevicios  = "http://www.browsrcamp.com/?get=1&width=".$tamanios[$tamanio]."&url=".$url;
		$sevicios .= "&quality=".$calidades[$calidad];
		$exp_info = '!<a href="(.+)" target="_blank">!U';
		$query = @file_get_contents($sevicios);
		preg_match_all($exp_info, $query, $info);
		$s = array(
			"full" => $info[1][0],
			"thumb" => str_replace("full", "thumb", $info[1][0])
		);
		return $s;
	}
	if("thumbalizr" == $servicio){
		$s = "http://www.thumbalizr.com/api/?url=".$url."&width=".$tamanios[$tamanio];
		return $s;
	}
}
function ordena_fecha($fecha)
{
	$fechav=split("-",$fecha);
	$fechac=$fechav[2]."-".$fechav[1]."-".$fechav[0];
	return $fechac;
}
function randomText($length) {
   // $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
   $pattern = "123456789012345678901234567890";
    
	for($i=0;$i<$length;$i++) {
      $key .= $pattern{rand(0,35)};
    }
    return $key;
}

//funcion para validar la fecha habil de la radicacion del formulario
//Carlos Barrero carlosabc81@gmail.com

$num_dias[]=0;
$num_dias[]=31;
$num_dias[]=28;
$num_dias[]=31;
$num_dias[]=30;
$num_dias[]=31;
$num_dias[]=30;
$num_dias[]=31;
$num_dias[]=31;
$num_dias[]=30;
$num_dias[]=31;
$num_dias[]=30;
$num_dias[]=31;


function valida_fecha($db)
{
global $num_dias;
//consulta si la fecha es festivo, sabado o domingo
$dia=date('j');
$mes=date('n');
$ano=date('Y');
$dia_num=date('N');

/*
$dia=1;
$mes=11;
$ano=2009;
$dia_num=7;
*/

$j="";
$k=0;
while($j!='ok')
	{
		$sql_fes="select count(*) as k from sgd_noh_nohabiles where noh_fecha=to_date('".$dia."/".$mes."/".$ano." ','dd/mm/yyyy')";
		$rs_fes=$db->conn->Execute($sql_fes);
		if((($rs_fes->fields['K']) != 1) && ($dia_num != 6 && $dia_num != 7))
			{
				$dia=$dia;
				$mes=$mes;
				$ano=$ano;
				$j='ok';
			}
		else
			{
				if($num_dias[$mes] > $dia)
					{
						$dia=$dia+1;
						$dia_num=$dia_num+1;
						$k=1;
					}
				if($num_dias[$mes] == $dia)
					{
						$dia=1;
						$mes=$mes+1;
						$dia_num=$dia_num+1;
						$k=1;
					}
			}
	}
$hora=date('G');
$minuto=date('i');
/*
$hora=16;
$minuto=31;
*/

$fechah=date('h:i:s');
//valida la hora de radicacion

if($k==0)
	{
		if(($hora <= 8) && ($minuto < 30))
			$fechah="08:30:00";
		if(($hora >= 16) && ($minuto > 30))
			{
			$fechah="08:30:00";
			if($num_dias[$mes] > $dia)
					{
						$dia=$dia+1;
					}
				if($num_dias[$mes] == $dia)
					{
						$dia=1;
						$mes=$mes+1;
					}
			}
	}
else
	$fechah="08:30:00";

$fecha=$dia."/".$mes."/".$ano." ".$fechah;
return $fecha;
}


?>


<?
 //*********************************************************//
 //*    Reservados todos los derechos HACKPRO TM © 2005    *//
 //*-------------------------------------------------------*//
 //* NOTA IMPORTANTE                                       *//
 //*-------------------------------------------------------*//
 //* Siéntase libre para usar esta clase en sus páginas,   *//
 //* con tal de que TODOS los créditos permanecen intactos.*//
 //* Sólo ladrones deshonrosos transmite el código que los *//
 //* programadores REALES escriben con difícultad y libre- *//
 //* mente lo comparten quitando los comentarios y diciendo*//
 //* que ellos escribieron el código.                      *//
 //*.......................................................*//
 //* Encrypts and Decrypts a chain.                        *//
 //*-------------------------------------------------------*//
 //* Original in VB for:    Kelvin C. Perez.               *//
 //* E-Mail:                kelvin_perez@msn.com           *//
 //* WebSite:               http://home.coqui.net/punisher *//
 //*+++++++++++++++++++++++++++++++++++++++++++++++++++++++*//
 //* Programmed in PHP for: Heriberto Mantilla Santamaría. *//
 //* E-Mail:                heri_05-hms@mixmail.com        *//
 //* WebSite:               www.geocities.com/hackprotm/   *//
 //*.......................................................*//
 //* IMPORTANT NOTE                                        *//
 //*-------------------------------------------------------*//
 //* Feel free to use this class in your pages, provided   *//
 //* ALL credits remain intact. Only dishonorable thieves  *//
 //* download code that REAL programmers work hard to write*//
 //* and freely share with their programming peers, then   *//
 //* remove the comments and claim that they wrote the     *//
 //* code.                                                 *//
 //*-------------------------------------------------------*//
 //*         All Rights Reserved HACKPRO TM © 2005         *//
 //*********************************************************//

 class EnDecryptText // Create a class of EnDecryptText.
 {
  //------------------------------------------------------------------------------------
  // Encrypt a chain of text.
  //------------------------------------------------------------------------------------
  // Parameters
  //------------------------------------------------------------------------------------
  // $cText: Chain to encrypt.
  //------------------------------------------------------------------------------------
  function Encrypt_Text($cText)
  {$eText = $cText;
   // Get a random Number between 1 and 100. This will be the multiplier
   // for the Ascii value of the characters.
   $nEncKey = intval((100 * $this->Rnd()) + 1);
   // Loop until we get a random value betwee 5 and 7. This will be
   // the lenght (with leading zeros) of the value of the Characters.
   $nCharSize = 0;
   $nUpperBound = 10;
   $nLowerBound = 5;
   $nCharSize = intval(($nUpperBound - $nLowerBound + 1) * $this->Rnd() + $nLowerBound);
   // Encrypt the Size of the characters and convert it to String.
   // This size has to be standard so we always get the right character.
   $cCharSize = $this->fEncryptedKeySize($nCharSize);
   // Convert the KeyNumber to String with leading zeros.
   $cEncKey = $this->NumToString($nEncKey, $nCharSize);
   // Get the text to encrypt and it's size.
   $cEncryptedText = '';
   $nTextLenght = strlen($eText);
   // Loop thru the text one character at the time.
   for($nCounter = 1; $nCounter <= $nTextLenght; $nCounter++)
   {// Get the Next Character.
    $cChar = $this->Mid($eText, $nCounter, 1);
    // Get Ascii Value of the character multplied by the Key Number.
    $nChar = ord($cChar) * $nEncKey;
    // Get the String version of the Ascii Code with leading zeros.
    // using the Random generated Key Lenght.
    $cChar2 = $this->NumToString($nChar, $nCharSize);
    // Add the Newly generated character to the encrypted text variable.
    $cEncryptedText .= $cChar2;
   }
   // Separate the text in two to insert the enc
   // key in the middle of the string.
   $nLeft = intval(strlen($cEncryptedText) / 2);
   $cLeft = $this->strleft($cEncryptedText, $nLeft);
   $nRight = strlen($cEncryptedText) - $nLeft;
   $cRight = $this->strright($cEncryptedText, $nRight);
   // Add a Dummy string at the end to fool people.
   $cDummy = $this->CreateDummy();
   // Add all the strings together to get the final result.
   $this->InsertInTheMiddle($cEncryptedText, $cEncKey);
   $this->InsertInTheMiddle($cEncryptedText, $cCharSize);
   $cEncryptedText = $this->CreateDummy() . $cEncryptedText . $this->CreateDummy();
   return $cEncryptedText;
  }

  //------------------------------------------------------------------------------------
  // Decrypt a chain of text.
  //------------------------------------------------------------------------------------
  // Parameters
  //------------------------------------------------------------------------------------
  // $cText: Chain to decrypt.
  //------------------------------------------------------------------------------------
  function Decrypt_Text($cText)
  {$cTempText = $cText;
   $cDecryptedText = '';
   $cText = '';
   // Replace alpha characters for zeros.
   for($nCounter = 1; $nCounter <= strlen($cTempText); $nCounter++)
   {$cChar = $this->Mid($cTempText, $nCounter, 1);
    if ($this->IsNumeric($cChar) == true)
     $cText .= $cChar;
    else
     $cText .= '0';
   }
   // Get the size of the key.
   $cText = $this->strleft($cText, strlen($cText) - 4);
   $cText = $this->strright($cText, strlen($cText) - 4);
   $nCharSize = 0;
   $this->Extract_Char_Size($cText, $nCharSize);
   $this->Extract_Enc_Key($cText, $nCharSize, $nEncKey);
   // Decrypt the Size of the encrypted characters.
   $nTextLenght = strlen($cText);
   // Loop thru text in increments of the Key Size.
   $nCounter = 1;
   do
   {// Get a Character the size of the key.
    $cChar = $this->Mid($cText, $nCounter, $nCharSize);
    // Get the value of the character.
    $nChar = $this->Val($cChar);
    // Divide the value by the Key to get the real value of the character.
    if ($nEncKey > 0) $nChar2 = $nChar / $nEncKey;
    // Convert the value to the character.
    $cChar2 = chr($nChar2);
    $cDecryptedText .= $cChar2;
    $nCounter += $nCharSize;
   }while ($nCounter <= strlen($cText));
   // Clear any unwanted spaces and show the decrypted text.
  echo "$cDecryptedText";
   return trim($cDecryptedText);
  }

  //------------------------------------------------------------------------------------
  // Extract the Character Size from the middle of the exncrypted text.
  //------------------------------------------------------------------------------------
  // Parámetros
  //------------------------------------------------------------------------------------
  // &$cText:     Cadena.
  // &$nCharSize: Tamaño de la cadena.
  //------------------------------------------------------------------------------------
  function Extract_Char_Size(&$cText, &$nCharSize)
  {// Get the half left side of the text.
   $nLeft = intval(strlen($cText) / 2);
   $cLeft = $this->strleft($cText, $nLeft);
   // Get the half right side of the text.
   $nRight = strlen($cText) - $nLeft;
   $cRight = $this->strright($cText, $nRight);
   // Get the key from the text.
   $nKeyEnc = $this->Val($this->strright($cLeft, 2));
   $nKeySize = $this->Val($this->strleft($cRight, 2));
   if ($nKeyEnc >= 5)
    $nCharSize = $nKeySize + $nKeyEnc;
   else
    $nCharSize = $nKeySize - $nKeyEnc;
   $cText = $this->strleft($cLeft, strlen($cLeft) - 2) . $this->strright($cRight, strlen($cRight) - 2);
  }

  //------------------------------------------------------------------------------------
  // Extract the Encryption Key from the middle of the encrypted text.
  //------------------------------------------------------------------------------------
  // Parameters
  //------------------------------------------------------------------------------------
  // &$cText:    Chain.
  // $nCharSize: Length of the chain.
  // &$nEncKey:  Length of the chain encrypt.
  //------------------------------------------------------------------------------------
  function Extract_Enc_Key(&$cText, $nCharSize, &$nEncKey)
  {$cEncKey = '';
   // Get the real size of the text (without the previously
   // stored character size).
   $nLenght = strlen($cText) - $nCharSize;
   // Get the half left and half right sides of the text.
   $nLeft = intval($nLenght / 2);
   $cLeft = $this->strleft($cText, $nLeft);
   $nRight = $nLenght - $nLeft;
   $cRight = $this->strright($cText, $nRight);
   // Get the key from the text.
   $cEncKey = $this->Mid($cText, $nLeft + 1, $nCharSize);
   // Get the numeric value of the key.
   $nEncKey = $this->Val(trim($cEncKey));
   // Get the real text to decrypt (left side + right side).
   $cText = $cLeft . $cRight;
  }

  //------------------------------------------------------------------------------------
  // Just to fool people....never show the real size in the string but we need to know
  // what we used in order to decrypt it so we will store the both in the string but
  // maked.
  //------------------------------------------------------------------------------------
  // Parameters
  //------------------------------------------------------------------------------------
  // $nKeySize: Length of the chain encrypt.
  //------------------------------------------------------------------------------------
  function fEncryptedKeySize($nKeySize)
  {$nLowerBound = 0;
   $nKeyEnc = intval(($nKeySize - $nLowerBound + 1) * $this->Rnd() + $nLowerBound);
   if ($nKeyEnc >= 5)
    $nKeySize = $nKeySize - $nKeyEnc;
   else
    $nKeySize = $nKeySize + $nKeyEnc;
   return $this->NumToString($nKeyEnc, 2) . $this->NumToString($nKeySize, 2);
  }

  //------------------------------------------------------------------------------------
  // Convert a number to string using a fixed size using zeros in front of the real
  // number to match the desired size.
  //------------------------------------------------------------------------------------
  // Parameters
  //------------------------------------------------------------------------------------
  // $nNumber: Chain that n Numbers contains.
  // $nZeros:  Quantity of zeros to add to the chain.
  //------------------------------------------------------------------------------------
  function NumToString($nNumber, $nZeros)
  {// Check that the zeros to fill are not smaller than the actual size.
   $cNumber = trim(strval($nNumber));
   $nLenght = strlen($cNumber);
   if ($nZeros < $nLenght) $nZeros = 0;
   $nUpperBound = 122;
   $nLowerBound = 65;
   for($nCounter = 1; $nCounter <= ($nZeros - $nLenght); $nCounter++)
   {// Add a zero in front of the string until we reach the desired size.
    $lCreated = false;
    do
    {$nNumber = intval(($nUpperBound - $nLowerBound + 1) * $this->Rnd() + $nLowerBound);
     if (($nNumber > 90) && ($nNumber < 97))
      $lCreated = false;
     else
      $lCreated = true;
    }while ($lCreated == false);
    $cChar = chr($nNumber);
    $cNumber = $cChar . $cNumber;
   }
   // Return the resulting string.
   return $cNumber;
  }

  //------------------------------------------------------------------------------------
  // Insert a string in the middle of another.
  //------------------------------------------------------------------------------------
  // Parameters
  //------------------------------------------------------------------------------------
  // &$cSourceText:  Chain.
  // $cTextToInsert: Chain to insert inside $cSourceText.
  //------------------------------------------------------------------------------------
  function InsertInTheMiddle(&$cSourceText, $cTextToInsert)
  {// Get the half left and half right sides of the text.
   $nLeft = intval(strlen($cSourceText) / 2);
   $cLeft = $this->strleft($cSourceText, $nLeft);
   $nRight = strlen($cSourceText) - $nLeft;
   $cRight = $this->strright($cSourceText, $nRight);
   // Insert cTextToString in the middle of cSourceText.
   $cSourceText = $cLeft . $cTextToInsert . $cRight;
  }

  //------------------------------------------------------------------------------------
  //
  //------------------------------------------------------------------------------------
  function CreateDummy()
  {$nUpperBound = 122;
   $nLowerBound = 48;
   for($nCounter = 1; $nCounter <= 4; $nCounter++)
   {$lCreated = false;
    do
    {$nDummy = intval(($nUpperBound - $nLowerBound + 1) * $this->Rnd() + $nLowerBound);
     if ((($nDummy > 57) && ($nDummy < 65)) || (($nDummy > 90) && ($nDummy < 97)))
      $lCreated = false;
     else
      $lCreated = true;
    }while ($lCreated == false);
    $cDummy .= chr($nDummy);
   }
   return $cDummy;
  }

 /////////////////////////////////////////////////////////////////////
 // Function of chain handling.                                     //
 /////////////////////////////////////////////////////////////////////

  //------------------------------------------------------------------------------------
  // Returns a specification number of characters of the left side of a chain.
  //------------------------------------------------------------------------------------
  // Parameters
  //------------------------------------------------------------------------------------
  // $tmp:   Chain.
  // $nLeft: Number of left characters to right.
  //------------------------------------------------------------------------------------
  function strleft($tmp, $nLeft)
  {$len = strlen($tmp);
   if ($nLeft == 0)
    $str = '';
   else if ($nLeft < $len)
    $str = $this->Mid($tmp, 1, $nLeft);
   return $str;
  }

  //------------------------------------------------------------------------------------
  // Returns a specification number of characters of the right side of a chain.
  //------------------------------------------------------------------------------------
  // Parameters
  //------------------------------------------------------------------------------------
  // $tmp:    Chain.
  // $nRight: Number of right characters to left.
  //------------------------------------------------------------------------------------
  function strright($tmp, $nRight)
  {$len = strlen($tmp);
   if ($nRight == 0)
    $str = '';
   else if ($nRight < $len)
    $str = $this->Mid($tmp, $len - $nRight + 1, $len);
   return $str;
  }

  //------------------------------------------------------------------------------------
  // Returns a specification number of characters of a chain.
  //------------------------------------------------------------------------------------
  // Parameters
  //------------------------------------------------------------------------------------
  // $tmp:    Chain.
  // $start:  Starting position in the chain.
  // $length: Quantity of left characters to right.
  //------------------------------------------------------------------------------------
  function Mid($tmp, $start, $length)
  {$str = substr($tmp, $start - 1, $length);
   return $str;
  }

 /////////////////////////////////////////////////////////////////////
 // Functions for handling of numbers.                               //
 /////////////////////////////////////////////////////////////////////

  //------------------------------------------------------------------------------------
  // Generates a Random number.
  //------------------------------------------------------------------------------------
  function Rnd()
  {srand(); // Initialize random-number generator.
   do
   {$tmp = abs(tan(rand()));
   }while (($tmp > "1") || ($tmp < "0"));
   $tmp = $this->Mid($tmp, 1, 8);
   return $tmp;
  }

  //------------------------------------------------------------------------------------
  // Takes the numbers that it is in a chain.
  //------------------------------------------------------------------------------------
  // Parameters
  //------------------------------------------------------------------------------------
  // $tmp: Chain.
  //------------------------------------------------------------------------------------
  function Val($tmp)
  {$length = strlen($tmp);
   $tmp2 = 0;
   for ($i = 1; $i <= $length; $i++)
   {$tmp1 = $this->Mid($tmp, $i, 1);
    if ($this->IsNumeric($tmp1) == 1)
    {$tmp2 .= $tmp1;}
   }
   return intval($tmp2);
  }

  //------------------------------------------------------------------------------------
  // Returns if an expression you can evaluate as a number.
  //------------------------------------------------------------------------------------
  // Parameters
  //------------------------------------------------------------------------------------
  // $cChar: Chain.
  //------------------------------------------------------------------------------------
  function IsNumeric($cChar)
  {$tmp = ord($cChar);
   if (($tmp < 48) || ($tmp > 57))
    $tmp = false;
   else
    $tmp = true;
   return $tmp;
  }
 }
?>


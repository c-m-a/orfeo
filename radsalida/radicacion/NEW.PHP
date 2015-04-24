<?    
 error_reporting(7); 
 session_start(); 
 if($nurad)
		{ 
		$ent = substr($nurad,-1);
		} 
 $ruta_raiz = ".."; 
 if (!$dependencia or !$krd) { include "../rec_session.php";}
	$no_tipo = "true"; 
?> 
<head>
<title>.:: DocuImage Módulo de Captura::.</title>
<meta http-equiv="expires" content="99999999999">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../estilos_totales.css" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Comienzo
closetime = 0; // Cantidad de segundos a esperar para abrir la ventana nueva
dato1 = 333;
function radicar_doc()
{
   if (document.formulario.tdoc.value != 0 &&  document.formulario.documento_us1.value)
     {
	   document.formulario.submit();
	 }
	 else
	 {

	   alert("El tipo de Documento, Remitente/Destinatario son obligatorios ");

	 }  

}

function modificar_doc()
{
   if (document.formulario.tdoc.value != 0 &&  document.formulario.documento_us1.value)
     {
       document.formulario.submit();
	 }
	 else
	 {
	   alert("El tipo de Documento, Remitente/Destinatario son obligatorios ");
	 }
}
function pestanas(pestana)
{
 <? 
   if($ent==1) $ver_pestana="none"; else $ver_pestana="";
  ?>
   document.getElementById('remitente').style.display = "";   
   document.getElementById('remitente_R').style.display = "none";   
   document.getElementById('predio').style.display = "<?=$ver_pestana?>";
   document.getElementById('predio_R').style.display = "none";      
   document.getElementById('empresa').style.display = "<?=$ver_pestana?>";   
   document.getElementById('empresa_R').style.display = "none";            
  if(pestana==1) {
   document.getElementById('pes1').style.display = "";
   document.getElementById('remitente').style.display = "none";   
   document.getElementById('remitente_R').style.display = "";      
   }else
   {
    document.getElementById('pes1').style.display = "none";
   }
  if(pestana==2) 
  {
  document.getElementById('pes2').style.display = "";
   document.getElementById('predio').style.display = "none";   
   document.getElementById('predio_R').style.display = "";      
  }else{document.getElementById('pes2').style.display = "none";}
  if(pestana==3) {
  document.getElementById('pes3').style.display = "";
   document.getElementById('empresa').style.display = "none";   
   document.getElementById('empresa_R').style.display = "";        
  }
  else
  {document.getElementById('pes3').style.display = "none";}
}
function pb1()
{
   dato1 = document.forma.no_documento.value;
}
function traerdatos()
{


    <?

	if ($ent==1) $i_registros=1; else $i_registros=3;

	 for($i=1;$i<=$i_registros;$i++)

	 {

	 echo "documento = preview.document.getElementById('documento_us$i').value;";

	 echo "if(documento)

			   {
			   nombre = preview.document.getElementById('nombre_us$i').value + ' ';
			   apellido1 = preview.document.getElementById('prim_apell_us$i').value  + ' ' ;
			   apellido2 = preview.document.getElementById('seg_apell_us$i').value  + ' ' ;
			   document.formulario.documento_us$i.value = documento;
			   document.formulario.nombre_us$i.value = nombre ;
			   document.formulario.prim_apel_us$i.value = apellido1;
			   document.formulario.seg_ape1_us$i.value  = apellido2;
			   document.formulario.telefono_us$i.value  = preview.document.getElementById('telefono_us$i').value;      
			   document.formulario.mail_us$i.value      = preview.document.getElementById('mail_us$i').value;  
			   document.formulario.direccion_us$i.value = preview.document.getElementById('direccion_us$i').value;
			   document.formulario.tipo_emp_us$i.value = preview.document.getElementById('tipo_emp_us$i').value;
			   document.formulario.cc_documento_us$i.value = preview.document.getElementById('cc_documento_us$i').value;
		       document.formulario.codep_us$i.value = preview.document.getElementById('codep_us$i').value;
			   procEst(formulario,18,$i);
	  	       document.formulario.muni_us$i.value = preview.document.getElementById('muni_us$i').value;			   

			      }";

	}

	echo "preview.close();";

	?>   

}

function Start(URL, WIDTH, HEIGHT) {

windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=1020,height=500";

preview = window.open(URL , "preview", windowprops);

//if (closetime) setTimeout("preview.close();", closetime*1000);

}

function doPopup() {

url = "popup.htm";

width = 800; // ancho en pixels

height = 320; // alto en pixels

delay = 2; // tiempo de delay en segundos

timer = setTimeout("Start(url, width, height)", delay*1000);

}

// Fin -->

function buscar_usuario()

{

   <!-- documento= document.formulario.cc_documento_us1.value;  -->

   document.write("<form target='Buscar_Usuario' name=formb action=buscar_usuario.php?envio_salida=true method=get > ");

   document.write("<input type=hidden name=no_documento value='" + documento +"'>");

   document.write("</form> ");       

   <!-- document.formb.submit();  -->

}

</script>

</head>

<body bgcolor="#FFFFFF" onLoad="pestanas(1);">

<?php
  $espcodi = 0;
  //error_reporting(0);
  $ddate=date('d');
  $mdate=date('m');
  $adate=date('Y');
  $nurad = trim($nurad);
  $hora=date('H:i:s');
  $fechaf =$date.$mdate.$adate.$hora;
  include "../config.php";
  // aqui se busca el radicado para editar si viene la variable $Buscar
 $tipoanexo = 0;
  if($Buscar)
	 {
	    $busqueda=$nurad;
		 $isql = "select a.*, TO_CHAR(a.RADI_FECH_OFIC,'DD') AS DOCDIA,TO_CHAR(a.RADI_FECH_OFIC,'MM') AS DOCMES,TO_CHAR(a.RADI_FECH_OFIC,'YYYY') AS DOCANO,a.EESP_CODI
		                    from radicado a where radi_nume_radi='$busqueda'";
		 $cursor = ora_open($handle);
		 $resultado = ora_parse($cursor,$isql) or die("<center><b>No se han encontrado registros con numero de radicado <font color=blue>$nurad</font> <br>  Revise el radicado escrito, solo pueden ser numeros de 14 digitos <br><p><hr><a href='edtradicado.php?fechaf=$fechaf&krd=$krd&drde=$drde'><font color=red>Intente de Nuevo</a><p><hr></font><p><p><p><p><p><p><p> Dato enviado por Oracle  <br><font color=blue>" .ora_error($cursor)." -- "); 
		 $resultado = ora_exec($cursor) or die("<center><b>No se han encontrado registros con numero de radicado <font color=blue>$nurad </font> <p><br>  Revise el radicado escrito, solo pueden ser numeros de 14 digitos <br><hr><a href='edtradicado.php?fechaf=$fechaf&krd=$krd&drde=$drde'><font color=red>Intente de Nuevo</a><p><hr></font><p><p><p><p><p><p><p> Dato enviado por Oracle<br><font color=blue> " .ora_error($cursor)." -- "); 
		 $error = ora_error($cursor);
		 $row=array();
		 ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
		  $numrows = ora_numrows($cursor);
		 if($numrows==0){die("<hr><p><p><center><b><font face='Arial, Helvetica, sans-serif' size=3 color='#000000' class='tituloListado'>No se ha encontrado el Radicado <font color=blue>$nurad </font> <p><br>  Revise el radicado escrito, solo pueden ser numeros de 14 digitos <br><hr><a href='edtradicado.php?fechaf=$fechaf&krd=$krd&drde=$drde'><font color=red>Intente de Nuevo</a><p><hr></font><p><p><p><p><p><p><p>"); }// error Dato enviado por Oracle<br><font color=blue> " .ora_error($cursor)." -- ");}
		 if(($cursor or $noradicar or $noradicar2) and (!$Submit3 and !$Submit4 ))
		 {
		     if($cursor ){$Submit4 = "Modificar";}
		 	 $pnom=$row["RADI_NOMB"];
			 $papl=$row["RADI_PRIM_APEL"];
			 $sapl=$row["RADI_SEGU_APEL"];
			 $numdoc=$row["RADI_NUME_IDEN"];
			 $asu=$row["RA_ASUN"];
			 $carp_codi = $row["CARP_CODI"];
			 $carp_per = $row["CARP_PER"];
			 $radi_usua_actu = $row["RADI_USUA_ACTU"];			 
			 $tel=$row["RADI_TELE_CONT"];
			 $rem2=$row["RADI_REM"];
			 $adress=$row["RADI_DIRE_CORR"];
			 $tip_doc =$row["TDID_CODI"];
			 $cuentai =$row["RADI_CUENTAI"];			 
			 if($row["RADI_NUME_DERI"]!=0) {$radicadopadre=$row["RADI_NUME_DERI"];}
			 $ane= $row["RADI_DESC_ANEX"];
			 $codep=$row["DEPTO_CODI"]; 
			 $pais=$row["RADI_PAIS"];
			 $asu=$row["RA_ASUN"];
			 $depende=$row["RADI_DEPE_ACTU"];
			 $tip_rem=$row["TRTE_CODI"]+1;$tdoc=$row["TDOC_CODI"];
     		 $med =$row["MREC_CODI"];
		     $cod=$row["MUNI_CODI"];$coddepe=$row["RADI_DEPE_ACTU"];
			 $espcodi=$row["EESP_CODI"];	 			 
			 $coddepe=$row["RADI_DEPE_ACTU"];
			 $fechproc12=$row["DOCDIA"];
			 $fechproc22=$row["DOCMES"];
			 $fechproc32=$row["DOCANO"];
			 $ruta_raiz = ".."; 
 	         $no_tipo = "true";
			 
			 include "busca_direcciones.php";
		 }else{
		   echo "<center><font color=red><b>No se ha  podido Modificar el registro Revise los datos <br> </center> $error <br></font>";
		   echo ora_error($cursor)."<br>";
		 }
	 }
	 // Fin de Busqueda del Radicado paara editar
	if($radicadopadre and !$radicadopadreseg and (!$Submit3  and !$Submit4)) {
	 $cursor = ora_open($handle);
	 $isql = "select a.*, TO_CHAR(a.RADI_FECH_OFIC,'DD') AS DOCDIA,TO_CHAR(a.RADI_FECH_OFIC,'MM') AS DOCMES,TO_CHAR(a.RADI_FECH_OFIC,'YYYY') AS DOCANO,a.EESP_CODI from radicado a where a.radi_nume_radi='$radicadopadre'";
	 $resultado = ora_parse($cursor,$isql);
	 $resultado = ora_exec($cursor);
	 $row=array();
     ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
     if(!$Buscar and !$Submit4){
	 $cuentaii =$row["RADI_CUENTAI"];
	 if($cuentaii){$cuentai=$cuentaii;}
	 $pnom=$row["RADI_NOMB"];
	 $papl=$row["RADI_PRIM_APEL"];
	 $sapl=$row["RADI_SEGU_APEL"];
	 $numdoc=$row["RADI_NUME_IDEN"];
	 $asu=$row["RA_ASUN"];
	 $tel=$row["RADI_TELE_CONT"];
	 $rem2=$row["RADI_REM"];
	 $adress=$row["RADI_DIRE_CORR"];}
	 $depende=$row["RADI_DEPE_ACTU"];
	 $tip_doc =$row["TDID_CODI"];
	 $ane= $row["RADI_DESC_ANEX"];
	 $cod=$row["MUNI_CODI"];
	 $codep=$row["DPTO_CODI"];
	 $pais=$row["RADI_PAIS"];
	 $espcodi=$row["EESP_CODI"];
	 if($noradicar2)
	 {
			 $fechproc12=$row["DOCDIA"];
			 $fechproc22=$row["DOCMES"];
			 $fechproc32=$row["DOCANO"];	 
     }
	$ruta_raiz = ".."; 
	$no_tipo = "true";
    include "busca_direcciones.php";
	}
	IF($noradicar1)
	{
	  $encabezado = "<center><b>Copia de datos del Radicado  $radicadopadre ";
	  $tipoanexo = "1";
	}
	IF($noradicar)
	{
	  $encabezado = "<center><b>Anexo de $radicadopadre ";
	  $tipoanexo = "0";
	  $radicadopadre_exist=1;	  
	}
	 IF($noradicar2)
     {
	 $encabezado = "<center><b>Documento Asociado de $radicadopadre ";
	  if(!$Submit4 and !$Submit3){$cuentai = "";}
	  $tipoanexo = "2"; 
 	  $radicadopadre_exist=1;
	}	
	 IF($noradicar1)
	  $radicadopadre_exist=0;
 ?>
  <script>
function procEst2(formulario,tb) 
{
	var lista = document.formulario.codep.value;
	i = document.formulario.codep.value;
	if (i != 0) {
		var dropdownObjectPath = document.formulario.tip_doc;
		var wichDropdown = "tip_doc";
		var d=tb;
		var withWhat = document.formulario.codep.value;
		populateOptions2(wichDropdown, withWhat,tb);
	  }
}
function populateOptions2(wichDropdown, withWhat,tbres) 
{
	r = new Array;
	i=0;
if (withWhat == "2") 
	{
   r[i++]=new Option("NIT", "1");
     }
if (withWhat == "1") 
	{
document.formulario.submit();	
  r[i++]=new Option("NIT","4");
  r[i++]=new Option("NUIR","5");
	}
if (withWhat == "3") 
	{
  r[i++]=new Option("CC", "0");
r[i++]=new Option("CE", "2");
r[i++]=new Option("TI", "1");
r[i++]=new Option("PASAPORTE", "3");
     }
	if (i==0) {
		alert(i + " " + "Error!!!");
		      }
	else{
		dropdownObjectPath = document.formulario.tip_doc;
		eval(document.formulario.tip_doc.length=r.length);
		largestwidth=0;
		for (i=0; i < r.length; i++) 
			{
			  eval(document.formulario.tip_doc.options[i]=r[i]);
			  if (r[i].text.length > largestwidth) {
			     largestwidth=r[i].text.length;    }
	        }
		eval(document.formulario.tip_doc.length=r.length);
		//eval(document.myform.cod.options[0].selected=true);

	   }

}

function procEst(formulario,tbres,muni_us) 

{

  if(muni_us==1)

  {

	var lista = document.formulario.codep_us1.value;

	i = document.formulario.codep_us1.value;

	if (i != 0) {

		var dropdownObjectPath = document.formulario.muni_us1;

		var wichDropdown = "muni_us1";

		var d=tbres;

	    var withWhat = document.formulario.codep_us1.value;

		populateOptions(wichDropdown, withWhat,tbres);

  }

 }

 

   if(muni_us==2)

  {



	var lista = document.formulario.codep_us2.value;

	i = document.formulario.codep_us2.value;

	

	if (i != 0) {

		var dropdownObjectPath = document.formulario.muni_us2;

		 

		var wichDropdown = "muni_us2";

		var d=tbres;

	    var withWhat = document.formulario.codep_us2.value;  

		populateOptions(wichDropdown, withWhat,tbres);

  }

 }

  

  

  if(muni_us==3)

  {

	var lista = document.formulario.codep_us3.value;

	i = document.formulario.codep_us3.value;

	if (i != 0) {

		var dropdownObjectPath = document.formulario.muni_us3;

		var wichDropdown = "muni_us3";

		var d=tbres;

	    var withWhat = document.formulario.codep_us3.value;

		populateOptions(wichDropdown, withWhat,tbres);

  }

 }  

}

function populateOptions(wichDropdown, withWhat,tbres) 

{

	o = new Array;

	i=0;



if (withWhat == "0") 

	{

	o[i++]=new Option("NADA", "0");  

	}

<?PHP



			$isql ="select * from departamento";

			$cursor = ora_open($handle);

			ora_parse($cursor,$isql) ;

			ora_exec($cursor);

			$numerot = ora_numrows($cursor);

			$row = array();

  			while(ora_fetch($cursor))

			 {

				   $deptocodi=trim(ora_getcolumn($cursor, 0));

 				   $deptonomb=trim(ora_getcolumn($cursor, 1));

				   $cursor2 = ora_open($handle);

  	               ora_parse($cursor2,"select MUNI_CODI,DPTO_CODI,MUNI_NOMB from municipio where dpto_codi='$deptocodi' ORDER BY MUNI_NOMB") or die("No se ha podido abrir la tabla");

 			 	   ora_exec($cursor2);

				   echo "if (withWhat == '$deptocodi')"; 

 				   echo "	{";

	  			  //echo "document.formulario.dep.value='$deptocodi';";

					$ii=0;

					ora_fetch($cursor2);

 				  do

				   {

					 $municodi=trim(ora_getcolumn($cursor2, 0));

				     $municodi=trim(ora_getcolumn($cursor2, 0));										 

					 $muninomb=trim(ora_getcolumn($cursor2, 2));										 										 	

				     echo "   o[$ii]=new Option('$muninomb','$municodi');\n";

					 $ii=$ii+1;

				   }while(ora_fetch($cursor2));

				 echo "o[$ii]=new Option('$muninomb','$munidepcodi');\n";

				 echo "	}; i=$ii;";

       }

?>

	if (i==0) {

		alert(i + " " + "Error!!!");

     }

	else

	{

	  if(wichDropdown=="muni_us1")

	  {

	    dropdownObjectPath = document.formulario.muni_us1;

		eval(document.formulario.muni_us1.length=o.length);

		largestwidth=0;

		for (i=0; i < o.length; i++) 

			{

			  eval(document.formulario.muni_us1.options[i+1]=o[i]);

			  if (o[i].text.length > largestwidth) {

			     largestwidth=o[i].text.length;    

		      }

	        }

		  eval(document.formulario.muni_us1.length=o.length);

		}

	  if(wichDropdown=="muni_us2")

	  {

	    dropdownObjectPath = document.formulario.muni_us2;

		eval(document.formulario.muni_us2.length=o.length);

		largestwidth=0;

		for (i=0; i < o.length; i++) 

			{

			  eval(document.formulario.muni_us2.options[i+1]=o[i]);

			  if (o[i].text.length > largestwidth) {

			     largestwidth=o[i].text.length;    

		      }

	        }

		  eval(document.formulario.muni_us2.length=o.length);

		}

		

    }

	  if(wichDropdown=="muni_us3")

	  {

	    dropdownObjectPath = document.formulario.muni_us1;

		eval(document.formulario.muni_us3.length=o.length);

		largestwidth=0;

		for (i=0; i < o.length; i++) 

			{

			  eval(document.formulario.muni_us3.options[i+1]=o[i]);

			  if (o[i].text.length > largestwidth) {

			     largestwidth=o[i].text.length;    

		      }

	        }

		  eval(document.formulario.muni_us3.length=o.length);

		}

	

}

function fechf(formulario,n) 

{

  var fechaActual = new Date();

  var fecha = new Date(formulario.fechproc32.value,formulario.fechproc22.value-1, formulario.fechproc12.value);

  var tiempoRestante = fechaActual.getTime() - fecha.getTime();

  var dias = Math.floor(tiempoRestante / (1000 * 60 * 60 * 24));

  if (dias >60){

    alert("El documento tiene fecha anterior a 60 dias!!");

		formulario.fechproc12.value="";

		formulario.fechproc22.value="";

		formulario.fechproc32.value="";

		}

  else

	  if (dias<0){

    alert("Verifique la fecha del documento!!");

		formulario.fechproc12.value="";

		formulario.fechproc22.value="";

		formulario.fechproc32.value="";

		}	

		4				

}

function vnum(formulario,n)

{

	valor = formulario.elements[n].value; 

	if (isNaN(valor))   

      {

		alert ("Dato incorrecto..");

		formulario.elements[n].value="";  

		formulario.elements[n].focus();    

		return false;

      }                                     

	else

		return true;		 

}

function fech(formulario,n)

{

m=n-1;

s=m-1;

var f=document.formulario.elements[n].value;

var meses=parseInt(document.formulario.elements[m].value);

eval(lona=document.formulario.elements[n].length);

eval(lonm=document.formulario.elements[m].length);

eval(lond=document.formulario.elements[s].length);

if(lona==44 || lonm==44 || lond==44)

{

alert("Fecha incorrecta  debe ser DD/MM/AAAA !!!");

document.formulario.elements[s].value="";

document.formulario.elements[m].value="";

document.formulario.elements[n].value="";  

document.formulario.elements[s].focus(); 

}

else{

if ((f%4)==0){

		if(document.formulario.elements[m].value<13){

		switch(meses){

               case 12 : if(document.formulario.elements[s].value>31)

		             {

						alert ("Fecha incorrecta..");

						document.formulario.elements[s].value="";

						document.formulario.elements[m].value="";

						document.formulario.elements[n].value="";  

						document.formulario.elements[s].focus();    

						return false;

					 }break;

		case 11 : if(document.formulario.elements[s].value>30)

		             {

						alert ("Fecha incorrecta..");

						document.formulario.elements[s].value="";

						document.formulario.elements[m].value="";

						document.formulario.elements[n].value="";  

						document.formulario.elements[s].focus();    

						return false;

					 }break;

		case 10 : if(document.formulario.elements[s].value>31)
		             {
						alert ("Fecha incorrecta..");
						document.formulario.elements[s].value="";
						document.formulario.elements[m].value="";
						document.formulario.elements[n].value="";  
						document.formulario.elements[s].focus();    
						return false;
					 }break;
		case 9 : if(document.formulario.elements[s].value>30)
		             {
						alert ("Fecha incorrecta..");
						document.formulario.elements[s].value="";
						document.formulario.elements[m].value="";
						document.formulario.elements[n].value="";  
						document.formulario.elements[s].focus();    
						return false;
					 }break;
		case 8 : if(document.formulario.elements[s].value>31)
		             {
						alert ("Fecha incorrecta..");
						document.formulario.elements[s].value="";
						document.formulario.elements[m].value="";
						document.formulario.elements[n].value="";  
						document.formulario.elements[s].focus();    
						return false;
					 }break;
		case 7 : if(document.formulario.elements[s].value>31)
		             {
						alert ("Fecha incorrecta..");
						document.formulario.elements[s].value="";
						document.formulario.elements[m].value="";
						document.formulario.elements[n].value="";  
						document.formulario.elements[s].focus();    
						return false;
					 }break;







		case 6 : if(document.formulario.elements[s].value>30)







		             {







						alert ("Fecha incorrecta..");







						document.formulario.elements[s].value="";







						document.formulario.elements[m].value="";







						document.formulario.elements[n].value="";  







						document.formulario.elements[s].focus();    







						return false;







					 }break;







		case 5 : if(document.formulario.elements[s].value>31)







		             {

						alert ("Fecha incorrecta..");

						document.formulario.elements[s].value="";

						document.formulario.elements[m].value="";

						document.formulario.elements[n].value="";  

						document.formulario.elements[s].focus();    

						return false;

					 }break;

		case 4 : if(document.formulario.elements[s].value>30)
		             {
						alert ("Fecha incorrecta..");
						document.formulario.elements[s].value="";
						document.formulario.elements[m].value="";
						document.formulario.elements[n].value="";  
						document.formulario.elements[s].focus();    
						return false;
					 }break;
		case 3 : if(document.formulario.elements[s].value>31)
		             {
						alert ("Fecha incorrecta..");
						document.formulario.elements[s].value="";
						document.formulario.elements[m].value="";
						document.formulario.elements[n].value="";  
						document.formulario.elements[s].focus();    
						return false;
					 }break;
		case 2 : if(document.formulario.elements[s].value>29)
		             {
						alert ("Fecha incorrecta..");
						document.formulario.elements[s].value="";
						document.formulario.elements[m].value="";
						document.formulario.elements[n].value="";  
						document.formulario.elements[s].focus();    
						return false;
					 }break;
		case 1 : if(document.formulario.elements[s].value>31)
	             {
						alert ("Fecha incorrecta..");
						document.formulario.elements[s].value="";
						document.formulario.elements[m].value="";
						document.formulario.elements[n].value="";  
						document.formulario.elements[s].focus();    
						return false;
					 }break;
				}
									    }
										else {alert("Fecha mes inexistente!!");
										document.formulario.elements[s].value="";

										document.formulario.elements[m].value="";

										document.formulario.elements[n].value="";  

										document.formulario.elements[s].focus();

											}

	         }

   else {

	if(document.formulario.elements[m].value<13){

		switch(meses){

		case 12 : if(document.formulario.elements[s].value>31)

		             {

						alert ("Fecha incorrecta..");

						document.formulario.elements[s].value="";

						document.formulario.elements[m].value="";

						document.formulario.elements[n].value="";  

						document.formulario.elements[s].focus();    

						return false;

					 }break;

		case 11 : if(document.formulario.elements[s].value>30)

		             {

						alert ("Fecha incorrecta..");

						document.formulario.elements[s].value="";

						document.formulario.elements[m].value="";

						document.formulario.elements[n].value="";  

						document.formulario.elements[s].focus();    

						return false;

					 }break;

		case 10 : if(document.formulario.elements[s].value>31)

		             {

						alert ("Fecha incorrecta..");

						document.formulario.elements[s].value="";

					document.formulario.elements[m].value="";

						document.formulario.elements[n].value="";  

						document.formulario.elements[s].focus();    

						return false;

					 }break;

		case 9 : if(document.formulario.elements[s].value>30)

		             {

						alert ("Fecha incorrecta..");

						document.formulario.elements[s].value="";

						document.formulario.elements[m].value="";

						document.formulario.elements[n].value="";  

						document.formulario.elements[s].focus();    

						return false;

					 }break;

		case 8 : if(document.formulario.elements[s].value>31)

		             {

						alert ("Fecha incorrecta..");

						document.formulario.elements[s].value="";

						document.formulario.elements[m].value="";

						document.formulario.elements[n].value="";  

						document.formulario.elements[s].focus();    

						return false;

					 }break;

		case 7 : if(document.formulario.elements[s].value>31)

		             {

						alert ("Fecha incorrecta..");

						document.formulario.elements[s].value="";

						document.formulario.elements[m].value="";

						document.formulario.elements[n].value="";  

						document.formulario.elements[s].focus();    

						return false;

					 }break;

		case 6 : if(document.formulario.elements[s].value>30)







		             {







						alert ("Fecha incorrecta..");







						document.formulario.elements[s].value="";







						document.formulario.elements[m].value="";







						document.formulario.elements[n].value="";  







						document.formulario.elements[s].focus();    







						return false;







					 }break;







		case 5 : if(document.formulario.elements[s].value>31)
		             {
						alert ("Fecha incorrecta..");
						document.formulario.elements[s].value="";
						document.formulario.elements[m].value="";
						document.formulario.elements[n].value="";  
						document.formulario.elements[s].focus();    
						return false;
					 }break;
		case 4 : if(document.formulario.elements[s].value>30)

		             {
						alert ("Fecha incorrecta..");







						document.formulario.elements[s].value="";







						document.formulario.elements[m].value="";







						document.formulario.elements[n].value="";  







						document.formulario.elements[s].focus();    







						return false;







					 }break;

		case 3 : if(document.formulario.elements[s].value>31)

		             {

						alert ("Fecha incorrecta..");

						document.formulario.elements[s].value="";

						document.formulario.elements[m].value="";

						document.formulario.elements[n].value="";  

						document.formulario.elements[s].focus();    

						return false;

					 }break;

	case 2 : if(document.formulario.elements[s].value>28)

           {

						alert ("Fecha incorrecta..");

						document.formulario.elements[s].value="";

						document.formulario.elements[m].value="";

						document.formulario.elements[n].value="";  

						document.formulario.elements[s].focus();    

						return false;

					 }break;

		case 1 : if(document.formulario.elements[s].value>31)

		             {

						alert ("Fecha incorrecta..");

						document.formulario.elements[s].value="";

						document.formulario.elements[m].value="";

						document.formulario.elements[n].value="";  

					document.formulario.elements[s].focus();    

					return false;

				 }break;

									}

									}

									else {alert("Fecha mes inexistente!!");

									document.formulario.elements[s].value="";

										document.formulario.elements[m].value="";

									document.formulario.elements[n].value="";  

										document.formulario.elements[s].focus();

								}

			}					

}		

}

var contadorVentanas=0

</script>

<?

    //$dependencia = 900;

  if ($Buscar1)

 {

	  include "busca_direcciones.php";

 }
  $var_envio=session_name()."=".trim(session_id())."&krd=$krd&ent=$ent&carp_per=$carp_per&carp_codi=$carp_codi&rad=$nurad&depende=$depende&radi_usua_actu=$radi_usua_actu&dependencia=$dependencia";
?>
<form action='NEW.PHP?<?=$var_envio?>'  method="post" name="formulario" id="formulario">
  <INPUT TYPE=HIDDEN NAME=radicadopadre value='<?=$radicadopadre ?>'>
  <input type=hidden name=tipoanexo value='<?=$tipoanexo ?>'>
  <input type=hidden name='noradicar' value='<?=$noradicar ?>'> 
 <input type=hidden name='noradicar1' value='<?=$noradicar1 ?>'>
  <input type=hidden name='noradicar2' value='<?=$noradicar2 ?>'>
  <table width="100%"  border="0" align="center" cellpadding="4" cellspacing="1" class="t_bordeGris">
    <tr> 
	<td class="tituloListado">
	<a href='./NEW.PHP?<?=session_name()."=".trim(session_id())?>&krd=<?=$krd?>&krd=<?=$krd?>&ent=<?=$ent?>&radicadopadre=<?=$radicadopadre?>&noradicar=<?=$noradicar?>&noradicar1=<?=$noradicar1?>&noradicar2=<?=$noradicar2?>'>
	Atras
	</a>
	</td>
      <td  valign="middle" align="center"> 
       <b><font face="Arial, Helvetica, sans-serif" size="3" color="#000000" class="tituloListado">MODULO 
        DE RADICACION (Dep 
        <?=$dependencia ?>
        )</font></b> 
        <?php if($nurad)
		{ 
		echo "<b>Rad No" . $nurad; 
		$ent = substr($nurad,-1);
		} ?>
		
		<br>
        <font size="-1" color=blue>
        <?=$encabezado ?>
        </font> </td>
          </tr>
        </table>
     <table  width=100% border="0" cellspacing="1" cellpadding="3" class="t_bordeGris" >

    <tr valign="middle"> 

      <td  class="grisCCCCCC" width="25%" align="right"> <font color="" face="Arial, Helvetica, sans-serif"><? 

	  ?><span class="etextomenu">FECHA: dd/mm/aaaa</span></font> </td>

     <td  class="celdaGris" width="25%"><font color="" face="Arial, Helvetica, sans-serif"> 

        <input name="fechproc1" type="text"  readonly="true" id="fechproc13" size="2" maxlength="2" value="<?php echo $ddate;?>" class="ecajasfecha">/ 
        <input name="fechproc2" type="text"  readonly="true" id="fechproc23" size="2" maxlength="2" value="<?php echo $mdate;?>" class="ecajasfecha">
       / 
        <input name="fechproc3" readonly="true" type="text" id="fechproc33" size="4" maxlength="4" value="<?php echo $adate;?>" class="ecajasfecha">
        </font> <font color="" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;</font></td>
      <td width="25%" class="grisCCCCCC" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">&nbsp; 
        </font><font size="-1"> Cuenta Interna, Oficio, Referencia</font></td>
      <td width="25%" class="celdaGris"> <font face="Arial, Helvetica, sans-serif"> 
        <input name="cuentai" type="text"  maxlength="20" class="ecajasfecha" value='<?php echo $cuentai; ?>' >
        &nbsp; </font></td>
    </tr>
  </table>
        <table width="600" border="0" cellspacing="0" cellpadding="2">

          <tr> 

<td height="1"> <input name="VERIFICAR" type="hidden" class="ebuttons2" value="Verifique Radicaci&oacute;n"> 

            </td>

          </tr>

        </table>

  <table width=100% border="0" cellspacing="1" cellpadding="3" class="t_bordeGris">

    <tr> 

      <td width="25%" class="grisCCCCCC" align="right"><font color="" face="Arial, Helvetica, sans-serif" class="etextomenu">FECHA 

        DOC. dd/mm/aaaa</font></td>

            <td width="25%" class="celdaGris"><font color="" face="Arial, Helvetica, sans-serif"> 
              <input name="fechproc12" type="text" id="fechproc122" size="2" value="<? echo $fechproc12; ?>" maxlength="2"  class="ecajasfecha" >
              / 
              <input name="fechproc22" type="text" id="fechproc222" size="2" maxlength="2" value="<? echo $fechproc22; ?>"   class="ecajasfecha">
              / 
              <input name="fechproc32" type="text" id="fechproc322" size="4" maxlength="4" value="<? echo $fechproc32; ?>" onBlur="fechf(formulario,16)"   class="ecajasfecha">
              </font> <font color="" face="Arial, Helvetica, sans-serif">&nbsp;&nbsp;&nbsp;</font></td>
      <td width="25%" class="grisCCCCCC" align="right"> <font face="Arial, Helvetica, sans-serif" class="etextomenu">PAIS</font> 
      </td>
            <td width="25%" class="celdaGris"> 
                <input name="pais" type="text" size="30" maxlength="25" value="COLOMBIA" class="ecajasfecha">
            </td>
          </tr>
        </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr valign="bottom"> 
      <td height="10"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
		  <? 
		   if($ent==1) $img_remitente = "destinatario"; else $img_remitente = "remitente";
		   ?>
			 <td width="523" height="50" valign="bottom"><a href="#"  onClick="pestanas(1);" class="etextomenu"><img src="../imagenes/<?=$img_remitente?>.gif" width="110" height="25" border="0" id=remitente><img src="../imagenes/<?=$img_remitente?>_R.gif" width="110" height="25" border="0" id=remitente_R></a><a href="#"  onClick="pestanas(2);" class="etextomenu"><img src="../imagenes/predio.gif" width="110" border="0"  id=predio><img src="../imagenes/predio_R.gif" width="110" border="0"  id=predio_R></a><a href="#"  onClick="pestanas(3);" class="etextomenu"><img src="../imagenes/empresa.gif" width="110" height="25" border="0"  id=empresa><img src="../imagenes/empresa_R.gif" width="110" height="25" border="0" id=empresa_R></a></td>
			 <?
			 if($ent==1) $busq_salida="true"; else  $busq_salida=""; ?>
            <td width="183" align="right" valign="bottom"> <input type="button" name="Button" value="BUSCAR" class="ebuttons2" onClick="Start('buscar_usuario.php?busq_salida=<?=$busq_salida?>',1024,400);"> 
              <input type="button" name="Submit" value="ACTUALIZAR" class="ebuttons2" onClick="traerdatos();"> 
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr valign="top"> 
      <td height="95" class="grisCCCCCC"> <BR><? 
	 for($i=1;$i<=3;$i++)
	    {
		  if($i==1)
		  {
			$nombre = $nombre_us1;
			$documento = $documento_us1;
			$papel = $prim_apel_us1;
			$sapel = $seg_apel_us1;
			$tel = $telefono_us1;
			$dir = $direccion_us1;
			$mail = $mail_us1;
			$muni = $muni_us1;
			$codep = $codep_us1;
			$tipo = $tipo_emp_us1;
			$cc_documento = $cc_documento_us1; 
			$otro = $otro_us1;			
			//echo "*--> $nombre - $muni_us1 - $codep_us1<--";
		 }
		 if($i==2)
 	     {
			$nombre = $nombre_us2;
			$documento = $documento_us2;
			$cc_documento = $cc_documento_us2;			
			$papel = $prim_apel_us2;
			$sapel = $seg_apel_us2;
			$tel = $telefono_us2;
			$dir = $direccion_us2;
			$mail = $mail_us2;
			$muni = $muni_us2;
			$codep = $codep_us2;
			$tipo = $tipo_emp_us2;
			$otro = $otro_us2;			
		 }
		 if($i==3)

		  {
			$nombre = $nombre_us3;
			$documento = $documento_us3;
			$cc_documento = $cc_documento_us3;			 
			$papel = $prim_apel_us3;
			$sapel = $seg_apel_us3;
			$tel = $telefono_us3;
			$dir = $direccion_us3;
			$mail = $mail_us3;
			$muni = $muni_us3;
			$codep = $codep_us3;
			$tipo = $tipo_emp_us3;
			$otro = $otro_us3;
		 }

		 

		 if($tipo==1 or $i==3)

		 { 
			$lbl_nombre = "Razon Social";
			$lbl_apellido = "Sigla";
		    $lbl_nombre2 = "Rep. Legarl";		 
		 }ELSE
		 {
		 	$lbl_nombre = "Nombres";
			$lbl_apellido = "Primer Apellido";
		    $lbl_nombre2 = "Segundo Apellido";
		 }
		?>  <table border=0 width=98%  name='pes<?=$i?>' id='pes<?=$i?>' class="t_bordeGris" align="center">

          <tr class=e_tablas> 

            <td class="grisCCCCCC" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Codigo 

              o Doc</font></td>

            <td bgcolor="#FFFFFF" height="25" class="celdaGris"> 

              <input type=text name='documento_us<?=$i ?>' value='<?=$documento?>' readonly="true" class="ecajasfecha">

              <input type=text name='cc_documento_us<?=$i?>' value='<?=$cc_documento?>' readonly="true" class="ecajasfecha">			  

            </td>

            <td class="grisCCCCCC" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">TIPO 

              </font></td>

           <td bgcolor="#FFFFFF" height="25" class="celdaGris"> 

              <select name="tipo_emp_us<?=$i?>" class="ecajasfecha" >
		<?
		if($i==1){if($tipo_emp_us1==0){$datos = " selected ";}else{$datos= "";}}
		if($i==2){if($tipo_emp_us2==0){$datos = " selected ";}else{$datos= "";}}
		if($i==3){if($tipo_emp_us3==0){$datos = " selected ";}else{$datos= "";}}				
		?>	  
	    <option value=0 '<?=$datos ?>'>Usuario  </option>
		<?
		if($i==1){if($tipo_emp_us1==1){$datos = " selected ";}else{$datos= "";}}
		if($i==2){if($tipo_emp_us2==1){$datos = " selected ";}else{$datos= "";}}
		if($i==3){if($tipo_emp_us3==1){$datos = " selected ";}else{$datos= "";}}						?>		
		<option value=1 '<?=$datos ?>'>ESP  </option>
		<?
		if($i==1){if($tipo_emp_us1==2){$datos = " selected ";}else{$datos= "";}}
		if($i==2){if($tipo_emp_us2==2){$datos = " selected ";}else{$datos= "";}}
		if($i==3){if($tipo_emp_us3==2){$datos = " selected ";}else{$datos= "";}}				
		?>
		<option value=2 '<?=$datos ?>'>OTRAS EMPRESAS  </option>
	  </select>
        <font color=""> 
        <input type="hidden" name="depende22" value="<?php echo $depende;?>">
        </font> </td>
</tr>
    <tr class=e_tablas> 
            <td width="20%" class="grisCCCCCC" height="25" align="right"> <font face="Arial, Helvetica, sans-serif" class="etextomenu"><?=$lbl_nombre ?> 
             </font></td>
            <td width="20%" bgcolor="#FFFFFF" height="25" class="celdaGris"> 
             <INPUT type=text name='nombre_us<?=$i ?>' value='<?=$nombre ?>'  readonly="true"  class="ecajasfecha">
      </td>
            <td width="20%" class="grisCCCCCC" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu"><?=$lbl_apellido ?></font></td>
            <td colspan="3" bgcolor="#FFFFFF" height="25" class="celdaGris"> 
          <?
		if($i==4)
		{
	error_reporting(0);
	$isql = "select * FROM PAR_SERV_SERVICIOS";
	$cursor = ora_open($handle);
	$resultado = ora_parse($cursor,$isql) or die ("No se pudo grabar <br> revise la instruccion sql <br> $isql");
	$resultado = ora_exec($cursor) or die ("Por favor revise . . . . .");
    $hh = ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC); 
	?>
	  <select name="sector_us<?=$i ?>" class="ecajasfecha">
			  <? do
	{
	  $codigo_sect = $row["PAR_SERV_CODIGO"];
	  $nombre_sect = $row["PAR_SERV_NOMBRE"];
	  echo "<option value=$codigo_sect>$nombre_sect</option>";
	}while($hh = ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC));
	  ?> 
        </select>
      <?
		}else
		{
		?>
		<INPUT type=text name='prim_apel_us<?=$i ?>' value='<?=$papel ?>' class="ecajasfecha"  readonly="true" >
		<?
		}
		?> 
      </td>
    </tr>
    <tr class=e_tablas> 
            <td width="20%" class="grisCCCCCC" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu"><?=$lbl_nombre2 ?></font></td>
            <td width="20%" bgcolor="#FFFFFF" height="25" class="celdaGris"> 
            <input type=text name='seg_apel_us<?=$i ?>' value='<?=$sapel ?>'  readonly="true"  class="ecajasfecha">
      </td>
  <td width="20%" class="grisCCCCCC" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">TELEFONO 
              </font></td>
            <td  colspan="3" bgcolor="#FFFFFF" height="25" class="celdaGris"> 
              <INPUT type=text name='telefono_us<?=$i ?>' value='<?=$tel ?>' class="ecajasfecha">
      </td>
    </tr>
    <tr class=e_tablas> 
           <td width="20%" class="grisCCCCCC" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">DIRECCION 
              </font></td>
            <td width="20%" bgcolor="#FFFFFF" height="25" class="celdaGris"> 
              <INPUT type=text name='direccion_us<?=$i ?>' value='<?=$dir ?>' class="ecajasfecha">
      </td>
            <td width="20%" class="grisCCCCCC" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">MAIL 
              </font></td>
            <td  colspan="3" bgcolor="#FFFFFF" height="25" class="celdaGris"> 
              <INPUT type=text name='mail_us<?=$i ?>' value='<?=$mail ?>' class="ecajasfecha">
      </td>
    </tr>
	<? 
		  if($i!=3)
		  {	
   ?>		  
    <tr class=e_tablas> 
            <td width="20%" class="grisCCCCCC" height="25" align="right" >Dignatario<font face="Arial, Helvetica, sans-serif" class="etextomenu">&nbsp;</font></td>
            <td width="20%" bgcolor="#FFFFFF" height="25" class="celdaGris" colspan="3"> 
              <INPUT type=text name='otro_us<?=$i ?>' value='<?=$otro ?>' class="ecajasfecha" size=60 maxlength="50">
      </td>
    </tr>
	<?
	 }
	 ?>
    <tr class=e_tablas> 
            <td width="20%" class="grisCCCCCC" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">DEPARTAMENTO 
             </font></td>
            <td width="20%" bgcolor="#FFFFFF" height="25" class="celdaGris"> 
            <select  name="codep_us<?=$i?>" onChange="procEst(formulario,18,<?=$i ?>)"class="ecajasfecha">
          <option value="0" selected><font color="">-----</font></option>
          <?PHP
			$isql ="SELECT DPTO_CODI FROM series where DEPE_CODI=$depende";
			$cursor = ora_open($handle);
		    ora_parse($cursor,$isql) ;
			ora_exec($cursor); 
  		    ora_fetch($cursor);
		    $depto=trim(ora_getcolumn($cursor, 0));
	  	    $isql ="select * from departamento ORDER BY DPTO_NOMB";
			$cursor = ora_open($handle);
			ora_parse($cursor,$isql) ;
			ora_exec($cursor);
			$numerot = ora_numrows($cursor);
			$row = array();
			while(ora_fetch($cursor))
				 {
				   $deptocodi=trim(ora_getcolumn($cursor, 0));
 				   $deptonomb=trim(ora_getcolumn($cursor, 1));
				   if($i==1)
				   {
      		          if($deptocodi==$codep_us1){ $datos=" selected ";}else{$datos="";}
				   }
				   if($i==2)
				   {
      		          if($deptocodi==$codep_us2){ $datos=" selected ";}else{$datos="";}
				   }
				   if($i==3)
				   {
      		          if($deptocodi==$codep_us3){ $datos=" selected ";}else{$datos="";}
				   }				   				   
				    ECHO "<option value='$deptocodi' $datos><font color=''>$deptonomb</font></option>";
 			   }
?> 
        </select>
      </td>
            <td width="20%" class="grisCCCCCC" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">MUNICIPIO 
              </font></td>
            <td  colspan="3" bgcolor="#FFFFFF" height="25" class="celdaGris"><font color=""> 
              <select  name="muni_us<?=$i ?>"  class="ecajasfecha">
          <?PHP
   	       if($i==1) {if($codep_us1){$depto=$codep_us1;}}
		    if($i==2) {if($codep_us2){$depto=$codep_us2;}}
		    if($i==3) {if($codep_us3){$depto=$codep_us3;}}						
		    $isql ="SELECT MUNI_CODI,MUNI_NOMB FROM MUNICIPIO where DPTO_CODI=$depto order by muni_nomb";
			$cursor = ora_open($handle);
		 	ora_parse($cursor,$isql) ;
			ora_exec($cursor);
			$numerot = ora_numrows($cursor);
     		$row = array();
			ora_fetch($cursor);
   		    echo "<option value='0' $datos>---</font></option>";
			do
		     {
			   $municodi1=trim(ora_getcolumn($cursor, 0));
			   $muninomb1=trim(ora_getcolumn($cursor, 1));
			   if($i==1)
			   {
			      if($municodi1==$muni_us1){ $datos=" selected ";}else{$datos="";}
			   }
			   if($i==2)
			   {
			      if($municodi1==$muni_us2){ $datos=" selected ";}else{$datos="";}
			   }
			   if($i==3)
			   {
			      if($municodi1==$muni_us3){ $datos=" selected ";}else{$datos="";}
			   }			   			     
 			    echo  "<option value='$municodi1' $datos>$muninomb1</font></option>";
			 }while(ora_fetch($cursor));
	$municodi="";$muninomb="";$depto="";	
?> 
</select>
</font> </td>
</tr>
</table>		
<?
}
?> 
 <table width=98% border="0" class="t_bordeGris" align="center">
          <tr>
            <td  class="grisCCCCCC" width="25%" align="right" > <font color="" face="Arial, Helvetica, sans-serif" class="etextomenu">ASUNTO 
             </font></td>
           <td width="75%" class="celdaGris" >
			  <?
			    // Aqui borro los campos de asunto y descripción de anexos
				if($noradicar2 and !$Submit3 and !$Submit4)
				{
				  $asu = " ";
				  $ane = " ";
				}
				// Fin Elimitnar contenido de Campos Asociado.
			  ?>
              <textarea name="asu" cols="70" class="ecajasfecha" rows="2" ><?php echo trim($asu);?></textarea>
              </td>
          </tr>
        </table>
        <table width=98% border="0" cellspacing="2" cellpadding="3" class="t_bordeGris" align="center">
          <!--DWLayoutTable--> 
          <tr> 
           <td width="25%" height="26"    class="grisCCCCCC" align="right">
		    <font color="" face="Arial, Helvetica, sans-serif" class="etextomenu">
			  <?
			   if($ent==1)
			  {
			    echo "MEDIO ENVIO";
			  }else{
			    echo "MEDIO RECEPCION";			  
			  }
			  ?>
			  </font></td>
           <td width="25%" valign="top" class="celdaGris"><font color=""> 
              <select  name='med'  class='ecajasfecha'>
          <?php 
					  if($med==1){$datosel=" selected ";}else {$datosel=" ";}
                     echo "<option value='1' $datosel><font>CORREO</font></option>";
  					  if($med==2){$datosel=" selected ";}else {$datosel=" ";}
                      echo "<option value='2' $datosel><font>FAX</font></option>";
  					  if($med==4){$datosel=" selected ";}else {$datosel=" ";}
                      echo "<option value='4' $datosel><font>EMAIL</font></option>";
  					  if($med==3){$datosel=" selected ";}else {$datosel=" ";}
                      echo "<option value='3' $datosel><font>INTERNET</font></option>";
  					  if($med==6){$datosel=" selected ";}else {$datosel=" ";}
                      echo "<option value='6' $datosel><font>TELEFONICO</font></option>";
  					  if($med==5){$datosel=" selected ";}else {$datosel=" ";}
                     echo "<option value='5' $datosel><font>PERSONAL</font></option>";
					 ?>
        </select>
        </font></td>
            <td width="25%"  class="grisCCCCCC" align="right"> <font face="Arial, Helvetica, sans-serif" class="etextomenu">TIPO 
              DOC </font></td>
            <td width="25%" valign="top" class="celdaGris"> <font color=""> 
             <input name="hoj" type=hidden value="<? echo $hoj; ?>">
        <select  name="tdoc" class="ecajasfecha" >
		<option value=0>Seleccione Un tipo </option>
          <?php
//----------------------------
$cursor = ora_open($handle); 
ora_commiton($handle); 
//$query = "select table_name from user_tables order by table_name";
$query2 = "select  SGD_TPR_CODIGO,SGD_TPR_DESCRIP from SGD_TPR_TPDCUMENTO WHERE SGD_TPR_TPUSO='$ent' OR SGD_TPR_TPUSO='4' ORDER BY SGD_TPR_DESCRIP "; 
ora_parse($cursor, $query2) or die ("no hay consulta"); 
ora_exec($cursor); 
while(ora_fetch($cursor)){ 
   $data = trim(ora_getcolumn($cursor, 0)); 
   $data2 = trim(ora_getcolumn($cursor, 1));
   if($data==$tdoc)   {$datosel = " selected ";}else {$datosel = "  ";}
   echo "<option value=$data $datosel>$data2</option>"; 
}
      ?>
       </select>
       </font></td>
   </tr>
  </table>
      <table width=98% border="0" cellspacing="2" cellpadding="3" class="t_bordeGris" align="center">
        <!--DWLayoutTable--> 
         <tr> 

           <td  class="grisCCCCCC" width="25%" align="right"> <font color="" face="Arial, Helvetica, sans-serif" class="etextomenu">DESC 

             ANEXOS </font></td>

            <td width="75%" class="celdaGris"><font color="" face="Arial, Helvetica, sans-serif"> 

              <input name="ane" type="text" size="70" class="ecajasfecha" value="<? echo $ane;?>">

        </font> 

    </tr>

    <tr> 

            <td class="grisCCCCCC" width="25%" align="right"><font color="" face="Arial, Helvetica, sans-serif" class="etextomenu">DEPENDENCIA 

              </font></td>

            <td colspan="3" width="75%" class="celdaGris"><font color="" face="Arial, Helvetica, sans-serif"> 

              <select  name="coddepe" class="ecajasfecha" >
          <?php
$cursor = ora_open($handle); 
ora_commiton($handle); 
//$query = "select table_name from user_tables order by table_name";
$query2 = "select * from dependencia order by depe_nomb"; 
$cursor2 = ora_open($handle);
ora_parse($cursor, $query2) or die ("no hay consulta"); 
ora_exec($cursor); 
while(ora_fetch($cursor)){ 
		   $numcols = ora_numcols($cursor);
  		   $data = trim(ora_getcolumn($cursor, 0)); 
		   $data2 = trim(ora_getcolumn($cursor, 1));
		  if($coddepe!="")
	   {
		  if($coddepe==$data){$datosel= " selected ";}else {$datosel="";}
	   }
	  else
	  {
        if($dependencia==$data){$datosel= " selected ";}else {$datosel="";}
      }  
      if(!$Buscar or $datosel)
      {
	  	/** Aki si es radicacion de entrada se limita a
		  * solo mostrar la dependencia actual de Radicacion y ademas la dependencia de 
		  * Salida
		  */
        if(($ent==1 and ($datosel or $data==999)) or $ent!=1)echo "<option value=$data $datosel ><b>$data2</b></option>"; 
      }
}
?> 
       </select>
        </font></td>
    </tr>
    <tr align="center"> 
            <td height="23" colspan="4" class="celdaGris"> <font color="" face="Arial, Helvetica, sans-serif"> 
              <?php 
	if($Submit3=="Radicar")
	{
					$cursor = ora_open($handle); 
					$ddate=date('d');
					$mdate=date('m');
					$adate=date('Y');
					ora_commiton($handle);
				    if($ent!=1) 
					    {
  					      $qu="select seri_nume from series where depe_codi=$dependencia and seri_ano = $adate and seri_tipo=$ent order by seri_nume desc";
					    }
						else 
						{
						  $qu= "select sec_$dependencia.nextval as SEC from dual";					   
						} 
					ora_parse($cursor, $qu); 
					ora_exec($cursor);
					$consec = ora_getcolumn($cursor,0);
					$conseca = $consec;
					if($ent!=1)
					{
						$consec = $consec+1;
						$secuens=str_pad($consec,6,"0",STR_PAD_left);
						$nurad=$adate.$dependencia.$secuens.$ent;
					}
					else
					{
						$secuens=str_pad($consec,5,"0",STR_PAD_left);
						$nurad=date("Y").$dependencia.$secuens.$ent;
					}
					$cursor = ora_open($handle); 
					ora_commiton($handle); 
					$fechproc4=substr($adate,2,4);
					$fechrd=$ddate.$mdate.$fechproc4; 
					if($fechproc12==''){
					$fechproc12=date('d');
					$fechproc22=date('m');
					$fechproc32=date('y');
                   }
					$fechrdoc=$fechproc12."-".$fechproc22."-".$fechproc32;
					$apl .='';$apl=trim(substr($apl,0,50));
					$sapl .='';$sapl=trim(substr($sapl,0,50));
					$pnom .='';$pnom =trim(substr($pnom,0,89));
					$adress .='';
					$tip_rem +=0;
					$tip_doc +=0;
					$numdoc .='';$numdoc =trim(substr($numdoc,0,13));
					$long=strlen($cod);
					$codep +=0;
					$tel +=0;
					$cod +=0;
					$radicadopadre +=0;					
					$asu.='';
					$tip_rem=$tip_rem-1;
					$rem2.='';
					$dep +=0;
					$hoj +=0;
					$codieesp +=0;
					$ane .='';
					$med +=0;
					$acceso = 0;
					if($ent!=1)
					{
					  $q="UPDATE series SET  bloq='$REMOTE_ADDR' WHERE depe_codi=$dependencia and seri_ano=$adate and seri_tipo=$ent and bLoq IS NULL "; // and seri_nume=$conseca";
					  $cursor = ora_open($handle);
					  ora_commiton($handle);	
   					  ora_parse($cursor, $q) or $flag=1; 
					  ora_exec($cursor) or $flag=1;
					  $acceso = ora_numrows($cursor);
					 }else
					 {
					   $acceso =1;
					 }
					  if($acceso==0){
						    $q="select * from series WHERE depe_codi=$dependencia and seri_ano=$adate and seri_tipo=$ent";
					   	ora_parse($cursor, $q) or $flag=1; 
					  	ora_exec($cursor) or $flag=1;
						$pcbq = ora_getcolumn($cursor , 5);
						echo "<script>alert('No se ha podido radicar ya que el registro lo esta usando otro equipo Pc Radicando : $pcbq, Intente de Nuevo');</script>";
                        $flag=1;
						$Submit3="";$Submit4="";
						ECHO "<INPUT TYPE=HIDDEN NAME='consec' value='$consec'>";
	                    ECHO "<INPUT TYPE=HIDDEN NAME='ent' value='$ent'>";
					}else{
					    if($tip_rem<0)
						{
						  $tip_rem=0;
						}
						if(!$documento_us3)
						{
						   $documento_us3=0;
						}
						/**  En esta linea si la dependencia es 999 ke es la dep. de salida envia el radicado a una
						  *	 carpeta con el codigo de los dos primeros digitos de la dependencia
						  */						
						if($coddepe==999) $carp_codi=substr($dependencia,0,2); 
						else {
						      $carp_codi=0;
						      if($ent==1) $carp_codi = "1";						    
							}
						$qw="insert into radicado(radi_tipo_deri,radi_cuentai,eesp_codi     ,mrec_codi,radi_fech_ofic                               ,radi_nume_deri,radi_usua_radi,tdid_codi,radi_desc_anex,radi_nume_hoja,radi_pais,ra_asun,radi_depe_radi,radi_usua_actu,carp_codi   ,radi_nume_radi,trte_codi,radi_nume_iden,radi_fech_radi                                  ,radi_depe_actu,tdoc_codi,esta_codi)";
						$qw=$qw . "           values ($tipoanexo,'$cuentai'  ,$documento_us3,$med,TO_DATE ('$fechrdoc $hora', 'DD-MM-YY HH24:MI:SS'),$radicadopadre,$codusuario   ,$tip_doc ,'$ane'        ,0             ,'$pais'  ,'$asu' ,$coddepe      ,1             ,'$carp_codi','$nurad'      ,$tip_rem ,'$numdoc'     ,TO_DATE ('$fechrd $hora', 'DD-MM-YY HH24:MI:SS'),$coddepe      ,$tdoc    ,9   )";
						$flag = 0;
						
						ora_parse($cursor, $qw) or $flag=1;
						ora_exec($cursor)or $flag=1;
					if($flag==1)
					{
					     if($ent!=1)
						 {
							$q="UPDATE series SET bloq='' WHERE depe_codi=$dependencia and seri_ano=$adate and seri_tipo=$ent and bLoq ='$REMOTE_ADDR'";
							ora_parse($cursor, $q) or $flag=3; 
							ora_exec($cursor) or $flag=3;
							$Submit3="";$Submit4="";
						}
				        //echo "No puedo actualizar registro <br> $qw <br>";
					}else{						
					     if($ent!=1)
						 {
					        $q="UPDATE series SET seri_nume =$consec, bloq='' WHERE depe_codi=$dependencia and seri_ano=$adate and seri_tipo=$ent and bLoq ='$REMOTE_ADDR'";
							ora_parse($cursor, $q) or $flag=3; 
							ora_exec($cursor) or $flag=3;
							echo "</p><center><img src='../iconos/img_alerta_2.gif'><font face='Arial' size='3'><b>Se ha generado el radicado No.<b></font> <font face='Arial' size='4' color='red'><b><u>$nurad</u></b></font><br>";
						}	
						    echo "<script>window.open('radicado_n.php?nurad=$nurad&var_envio=$var_envio', 'Confirmacion', 'height=200,width=400,left=350,top=300 ');</script>";
					   }
					   $sgd_dir_us2=2; 
 	                   include "grb_direcciones.php";	
					   $observa = "Rad. Correspondencia";	
					   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE) values ($coddepe, to_date ('". date('d-m-Y H:i:s')."' ,'dd-mm-yyyy hh24:mi:ss' ) ,1,$nurad,'$observa')";
					   ora_parse($cursor,$isql_hl);
					   ora_exec($cursor);
				 } 			
          ECHO "<INPUT TYPE=HIDDEN NAME=nurad value=$nurad>";
	      ECHO "<INPUT TYPE=HIDDEN NAME=codusuario value=$codusuario>";					
	      ECHO "<INPUT TYPE=HIDDEN NAME='codieesp' value='$codieesp'>";		
		  ECHO "<INPUT TYPE=HIDDEN NAME='flag' value='$flag'>";						
}
     if($Submit4 and !$Buscar)
	{
			$secuens=str_pad($consec,6,"0",STR_PAD_left);
			$cursor = ora_open($handle); 
			ora_commiton($handle); 
			$fechproc4=substr($adate,2,4);
			$fechrd=$ddate.$mdate.$fechproc4;
		    if($fechproc12==''){
			$fechproc12=date('d');
			$fechproc22=date('m');
			$fechproc32=date('y');
     }
				$fechrdoc=$fechproc12.$fechproc22.$fechproc32;
					$apl .=' ';$apl=trim(substr($apl,0,50));
					$sapl .=' ';$sapl=substr($sapl,0,50);
					$pnom .=' ';$pnom =substr($pnom,0,89);
					$adress .=' ';
					$tip_rem +=0;$tip_doc +=0;$numdoc .='';$numdoc =trim(substr($numdoc,0,13));
					$codieesp +=0;$radicadopadre +=0;$long=strlen($cod);
					$codep +=0;$tel +=0;$cod +=0;$asu.='';$tip_rem=$tip_rem-1;
					$rem2.='';
					$dep +=0;
					$hoj +=0;
					$ane .='';
					$med +=0;
					if($tip_rem<0)
						{
						  $tip_rem=0;
						}
					if(!$documento_us3)
					{
					  $documento_us3 = 0;
					}
					/**  En esta linea si la dependencia es 999 ke es la dep. de salida envia el radicado a una
					  *	 carpeta con el codigo de los dos primeros digitos de la dependencia
					  */
					if($coddepe==$depende)
					{
					if($coddepe==999){
						   $carp_codi=substr($dependencia,0,2);
						   $carp_per=1;
						   $radi_usua_actu = 1;
					   }else{
						if(!$carp_codi)  $carp_codi=0; 
						if(!$carp_codi and ent==1)  $carp_codi=1; 						
						if(!$carp_per)  $carp_per=0;
						if(!$radi_usua_actu)  $radi_usua_actu=1;						
					}
					}else
					{
						if($coddepe==999){
						   $carp_codi=substr($dependencia,0,2);
						   $carp_per=1;
						   $radi_usua_actu = 1;
					     }else{					
						   $carp_codi=0; 
						   if($ent==1) $carp_codi=1;
						   $carp_per=0;
						   $radi_usua_actu=1;											
					    }
					}
					$qw="update radicado
					    SET radi_tipo_deri=$tipoanexo,radi_cuentai='$cuentai'
							,mrec_codi=$med
							,radi_fech_ofic=TO_DATE ('$fechrdoc $hora', 'DD-MM-YY HH24:MI:SS')
							,radi_nume_deri=$radicadopadre,radi_usua_radi=$codusuario
							,tdid_codi=$tip_doc, radi_desc_anex='$ane'
							,dpto_codi=$codep,radi_pais='$pais'
							,ra_asun='$asu'
							,radi_depe_radi=$coddepe
							,radi_usua_actu=$radi_usua_actu
							,carp_codi=$carp_codi
							,carp_per=$carp_per
							,trte_codi=$tip_rem
							,tdoc_codi=$tdoc
							,radi_nume_iden='$numdoc'
							,radi_depe_actu=$coddepe
							,eesp_codi=$documento_us3 
						where radi_nume_radi='$nurad' ";
					ora_parse($cursor, $qw); 
				    ora_exec($cursor);
					ora_commiton($handle);
					$rowsafec = ora_numrows($cursor);
					if($rowsafec>0){
					ECHO "<center><b>Se ha modificado el radicado($rowsafec) <b> $nurad <br>";
					ECHO "<INPUT TYPE=HIDDEN NAME=nurad value=$nurad>";
					ECHO "<INPUT TYPE=HIDDEN NAME=flag value=$flag>";
					 $sgd_dir_us2=2; 
                     include "grb_direcciones.php";
					}else{
					ECHO "<center><b>No se ha encontrado registros para modificar <br>";
					}
					if($coddepeinf)
					{
					   $flag=0;
					   $observa = "Inf. Envio de Copia al radicar";
					   $isql_inf= "insert into INFORMADOS(DEPE_CODI,INFO_FECH,USUA_CODI,RADI_NUME_RADI,INFO_DESC) 
					               values ($coddepeinf, to_date ('". date('d-m-Y H:i:s')."','dd-mm-yyyy hh24:mi:ss' ) ,1,$nurad,'$observa')";
					   ora_parse($cursor, $isql_inf) or $flag=1; 
					   ora_exec($cursor) or $flag=1;
					   ora_commiton($handle);
					   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE) values ($coddepeinf, to_date ('". date('d-m-Y H:i:s')."' ,'dd-mm-yyyy hh24:mi:ss' ) ,1,$nurad,'$observa')";
					   ora_parse($cursor,$isql_hl);
					   ora_exec($cursor);
					   if($flag!=1)
					   {
                          ECHO "Se ha informado a la dependencia $coddepeinf<br>";
					   }
	 				}
					if(!$coddepeinf and $Submit4)
					{
					   $flag=0;
					    $observa = "Modificación de Documento"; 
					   ora_commiton($handle);
					   error_reporting(7);
					   $usuario_dest = substr("000$codusuario",-3);
					   $flag = "";
					   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE,USUA_CODI_DEST) values ($dependencia, to_date ('". date('d-m-Y H:i:s')."' ,'dd-mm-yyyy hh24:mi:ss') ,'$codusuario',$nurad,'$observa','$dependencia$usuario_dest')";
					   ora_parse($cursor,$isql_hl) or $flag = 1;
					   ora_exec($cursor) or $flag = 1;
					   if($flag!=1)
					   {
                          ECHO "Incluido en Historico. <br>";
					   }
	 				}					
					if($borrarradicado)
					{
					   $flag=0;
					   $observa = "Se borro de Inf.";
					   $depbrr = substr($borrarradicado,0,3); 
					   $fechbrr = substr($borrarradicado,3,20);
					   $data6 = substr($borrarradicado,3,50);
					   $isql_inf= "delete from informados where depe_codi=$depbrr and radi_nume_radi=$nurad and info_desc like '%$data6%'";
					   ora_parse($cursor, $isql_inf) or $flag=1; 
					   ora_exec($cursor) or $flag=1;
					   ora_commiton($handle);
					   $isql_hl= "insert into hist_eventos(DEPE_CODI,HIST_FECH,USUA_CODI,RADI_NUME_RADI,HIST_OBSE) values ($depbrr, to_date ('". date('d-m-Y H:i:s')."' ,'dd-mm-yyyy hh24:mi:ss' ) ,1,$nurad,'$observa')";
					   ora_parse($cursor,$isql_hl);
					   ora_exec($cursor);
					   if($flag==1)
					   {
                          ECHO "No se ha borrado la inf. de la dependencia $depbrr<br>";
					   }else
					   {
					   echo "<font color=red>Se ha borrardo un Inf. y registrado en eventos<br></font><br>";
					   }
	 				}
	}
       		 echo "<INPUT TYPE=HIDDEN NAME=codusuario value=$codusuario>";
			 echo "<INPUT TYPE=HIDDEN NAME=radicadopadre value=$radicadopadre>";		
			 ECHO "<INPUT TYPE=HIDDEN NAME=radicadopadreseg value=2>";
			 ECHO "<INPUT TYPE=HIDDEN NAME='codieesp' value='$codieesp'>";
			 ECHO "<INPUT TYPE=HIDDEN NAME='consec' value='$consec'>";	
			 ECHO "<INPUT TYPE=HIDDEN NAME='seri_tipo' value='$seri_tipo'>";		
				  if(!$Submit3 and !$Submit4){
                      ?><input type='button' onClick='radicar_doc()' name='Submit33' value='Radicar' class='ebuttons2'>
					  <input type='hidden'  name='Submit3' value='Radicar' class='ebuttons2'>
                      </font>
					  <?
                      }else{
                      ?>
					  <input type='button' onClick='modificar_doc()' name='Submit44' value='MODIFICAR DATOS' class='ebuttons2'>
					  <input type='hidden'  name='Submit4' value='MODIFICAR DATOS' class='ebuttons2'>					  
					  <input type='hidden' name='nurad' value='<?=$nurad?>'>
                      </font>
					  <? 
					  }
				  ?> </font></td>
    </tr>
    <?php       
	            /** Aki valida si ya radico para dejar informar o Anexat archivos para ras. de Salida. 
				*/
				if(($Submit4 or $Submit3) AND !$Buscar){
				if($ent==1 and !$Submit3)
				{
				?>
				<tr bgcolor=white>
				<td class="grisCCCCCC" colspan="5" align="center">
				<font color="" face="Arial, Helvetica, sans-serif" class="etextomenu">
				Anexar Archivo o Plantilla </td>
				</TR>
				<TR>
				<TD colspan="5">				
				<?
				$ruta_raiz = "..";
				$numrad = $nurad;
				$verrad = $nurad;
				 if($tipo_emp_us1>0){$datoos1 = "("; $datoos2 = ")";}else{$datoos1 = " "; $datoos2 = " ";}
				 $nombret_us1 = $nombre_us1 . " $datoos1 " . trim($prim_apel_us1) . " " . $seg_apel_us1 . " $datoos2";
				 if($tipo_emp_us2>0) {$datoos1 = "("; $datoos2 = ")";}else{$datoos1 = " " ; $datoos2 = " ";}
				 $nombret_us2 = $nombre_us2 . " $datoos1 " . trim($prim_apel_us2) . " " . $seg_apel_us2 . " $datoos2" ;
				 if($tipo_emp_us3>0){$datoos1 = "("; $datoos2 = ")";}else{$datoos1 = " "; $datoos2 = " ";}
				 $nombret_us3 = $nombre_us3 . " $datoos1 " . trim($prim_apel_us3) . " " . $seg_apel_us3 . " $datoos2" ;
				 $nombret_us1_u = $nombret_us1;
				 $nombret_us2_u = $nombret_us2;
				 $nombret_us3_u = $nombret_us3;
				 $ruta_raiz= "..";
				 if($tipo_emp_us1>0){$nombret_us1_u = $nombre_us1;}	 
				 if($tipo_emp_us2>0){$nombret_us2_u = $nombre_us2;}
				 if($tipo_emp_us3>0){$nombret_us3_u = $nombre_us3;}					
				  include "$ruta_raiz/jh_class/funciones_sgd.php";
				   $a = new LOCALIZACION($codep_us1,$muni_us1,$ruta_raiz); 
				   $dpto_nombre_us1 = $a->departamento;
				   $muni_nombre_us1 = $a->municipio; 				 
				 $datos_envio="&otro_us11=$otro_us1&dpto_nombre_us11=$dpto_nombre_us1&muni_nombre_us11=$muni_nombre_us1&direccion_us11=$direccion_us1&nombret_us11=$nombret_us1";
				 $datos_envio.="&dpto_nombre_us2=$dpto_nombre_us2&muni_nombre_us2=$muni_nombre_us2&direccion_us2=$direccion_us2&nombret_us2=$nombret_us2";	 
				 $datos_envio.="&dpto_nombre_us3=$dpto_nombre_us3&muni_nombre_us3=$muni_nombre_us3&direccion_us3=$direccion_us3&nombret_us3=$nombret_us3";	    	 
				$ruta_raiz_archivo="..";
				$num_archivos = 0;
				include "../lista_anexos.php";
				$radicar_documento = "true"; 
				if($num_archivos==1 and $radicado=="false") 
				  {
  				      $generar_numero = "no";			
					  $vp = "n";
					    
				      include "../genarchivo.php";
					  echo "<script>document.formulario.submit();</script>";
				  }
			    ?>
				</TD></tr>
				<?
				}
				?>
				<tr bgcolor=white>
				<td class="grisCCCCCC">
				<font color="" face="Arial, Helvetica, sans-serif" class="etextomenu">
				Informar a </td><td>
				<select  name='coddepeinf' class='ecajasfecha' >
				<?
				$cursor = ora_open($handle); 
				ora_commiton($handle); 
				$query2 = "select * from dependencia  order by depe_nomb "; 
				$cursor2 = ora_open($handle);
				ora_parse($cursor, $query2) or die ("no hay consulta"); 
				ora_exec($cursor); 
				echo "<option value='' selected >No informar . . .</option>"; 	   
				while(ora_fetch($cursor)){ 
				   $numcols = ora_numcols($cursor);
  				   $data = trim(ora_getcolumn($cursor, 0)); 
				   $data2 = trim(ora_getcolumn($cursor, 1));
				   echo "<option value=$data>$data2</option>";
				}
				?></select>
				</td>
			</tr>
				</table>
				<table border=0  width=100%>
				<tr>
				<td></td><td class="grisCCCCCC"><b>SE HA INFORMADO A:<b></td><td><font color="" face="Arial, Helvetica, sans-serif" class="etextomenu">Seleccione un doc. de Informado para borrar</font></td></tr>
				</table>
				<table border=0 class='' width=100%> 
				<?php 
				$cursor = ora_open($handle); 
				ora_commiton($handle); 
				$query2 = "select b.depe_nomb,a.info_desc,a.depe_codi,a.depe_codi,TO_CHAR (a.info_fech) as info_fech,info_desc from informados a,dependencia b where a.depe_codi=b.depe_codi and a.radi_nume_radi='$nurad'  order by info_fech desc "; 
				$cursor2 = ora_open($handle);
				ora_parse($cursor, $query2) or die( "Fallo la busqeda"); 
				ora_exec($cursor); 
				$k = 1;
				 while(ora_fetch($cursor)){ 
				   $numcols = ora_numcols($cursor);
  				   $data = trim(ora_getcolumn($cursor, 0)); 
				   $data2 = trim(ora_getcolumn($cursor, 1));
				   $data3 = trim(ora_getcolumn($cursor, 3));
   				   $data4 = DATE(trim(ora_getcolumn($cursor, 4))."dMy");
			       $data5 = trim(ora_getcolumn($cursor, 4));
				   $data6 = trim(ora_getcolumn($cursor, 5));
				   ?>
				   <tr  class='tituloListado'>
				   <td><input type='radio' name='borrarradicado' value='<?=$data3.$data6?>'></td>
				   <td class="grisCCCCCC"><b><?=$data?></td><td class="grisCCCCCC"> <center><?=$data2?></td><td class="grisCCCCCC"><?=$data5?></td></tr>
				   <? 
				   $k = $k +1;
				}
				$verrad = $nurad;
				?> 
				<tr><td>
				</td></tr>
				<? 
				}
           ?> 
  </table>
  <input type="hidden" name="depende" value="<?php echo $depende; ?>"><BR> 
		</td>
    </tr>
  </table>
  <br>
       </form>
	   <?PHP 
	   $verrad = $nurad;
	   $radi = $nurad;
	   $contra = $drde;
	   $tipo = 1;
	   //include ("../lista_anexos.php"); 
  	   if($Submit3 and $ent==1) 
	   {
		  echo "<script>document.formulario.submit();</script>";
	   }
	   ?>
</body>
</html>

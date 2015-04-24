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
function procEst(formulario,tbres) 
{

	var lista = document.formulario.codep.value;
	i = document.formulario.codep.value;
	if (i != 0) {
		var dropdownObjectPath = document.formulario.cod;
		var wichDropdown = "cod";
		var d=tbres;
		var withWhat = document.formulario.codep.value;
		populateOptions(wichDropdown, withWhat,tbres);
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
										do			 {
					 									 
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
	else{
		dropdownObjectPath = document.formulario.cod;
		eval(document.formulario.cod.length=o.length);
		largestwidth=0;
		for (i=0; i < o.length; i++) 
			{
			  eval(document.formulario.cod.options[i+1]=o[i]);
			  if (o[i].text.length > largestwidth) {
			     largestwidth=o[i].text.length;    }
	        }
		eval(document.formulario.cod.length=o.length);
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

		}	4				
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

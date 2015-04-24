
function fechas(caja)
{
   if (caja)
   {
      borrar = caja;
      if ((caja.substr(2,1) == "/") && (caja.substr(5,1) == "/"))
      {
         for (i=0; i<10; i++)
	     {
            if (((caja.substr(i,1)<"0") || (caja.substr(i,1)>"9")) && (i != 2) && (i != 5))
			{
               borrar = '';
               break;  
			}  
         }
	     if (borrar)
	     { 
	        a = caja.substr(6,4);
		    d = caja.substr(3,2);
		    m = caja.substr(0,2);
		    if((a < 1900) || (a > 2050) || (m < 1) || (m > 12) || (d < 1) || (d > 31))
		       borrar = '';
		    else
		    {
		       if((a%4 != 0) && (m == 2) && (d > 28))	   
		          borrar = ''; // Año no viciesto y es febrero y el dia es mayor a 28
			   else
			   {
		          if ((((m == 4) || (m == 6) || (m == 9) || (m==11)) && (d>30)) || ((m==2) && (d>29)))
			         borrar = '';	      				  	 
			   }  // else
		    } // fin else
         } // if (error)
      } // if ((caja.substr(2,1) == "/") && (caja.substr(5,1) == "/"))			    			
	  else
	     borrar = '';
	  if (borrar == '')
	     alert('Fecha erronea');
   } // if (caja)   
}

function fechas_comp(caja,caja2)
{ 
   
     
      borrar = caja;
	  borrar2 = caja;
     
	      
	        a = caja.substr(6,4);
		    d = caja.substr(3,2);
		    m = caja.substr(0,2);
			a2 = caja2.substr(6,4);
		    d2 = caja2.substr(3,2);
		    m2 = caja2.substr(0,2);
			
			if ((a+''+d+''+m)>=(a2+''+d2+''+m2)) {
				return false;
				
			}
	return true;		
}

function fechas_comp_ymd(caja,caja2)
{


      borrar = caja;
	  borrar2 = caja;


	        a = caja.substr(0,4);
			m = caja.substr(5,2);
			d = caja.substr(8,2);

			a2 = caja2.substr(0,4);
			m2 = caja2.substr(5,2);
		    d2 = caja2.substr(8,2);
		//	alert ((a+''+m+''+d));
		//	alert ((a2+''+m2+''+d2));



			if ((a+''+m+''+d)>=(a2+''+m2+''+d2)) {
				return false;

			}
	return true;
}




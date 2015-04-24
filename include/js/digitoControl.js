<script>
function digitoControl(cadena){
   var cifras = new Array(71,67,59,53,47,43,41,37,29,23,19,17,13,7,3);
   var chequeo = 0;
	 digito = cadena;
	 digitosFalta =  15 - digito.length; 
	 for (var i=14; i >= 0; i--)
	 {
    chequeo += digito.charAt(i - digitosFalta) * cifras[i];
   }
	 
   chequeo = 11 - (chequeo % 11);
   if (chequeo == 11) {chequeo = 0;}
   if (chequeo == 10) {chequeo = 1;}
   return chequeo;
}
</script>


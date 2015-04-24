<?
/** Fila que graba radicados en la session
  * @autor Correlibre.org
  * @fecha 2010/08
	*/
?>
	<script type="text/javascript">
  
	function selecciono(vars){
     var url = "include/ajax/ajaxRadSel.php";
     var xml = null;
     var valorCheck;
     try{
         xml = new ActiveXObject("Microsoft.XMLHTTP");
     }catch(expeption){
         xml = new XMLHttpRequest();
     }
		 valorCheck = "checkValue["+vars+"]";
    if(document.getElementById(valorCheck).checked) {
     xml.open("GET",url +"?rad="+ vars+"&krd=<?=$krd?>&accion=incluir", false);
		}else{
		 xml.open("GET",url +"?rad="+ vars+"&krd=<?=$krd?>&accion=Eliminar", false);	
    }
	
     xml.send(null);
     if(xml.status == 404) alert("Url no valida");
     return xml.responseText;
}
  </script>
<?
?>
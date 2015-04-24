<?
/** Fila que graba radicados en la session
  * @autor Correlibre.org
  * @fecha 2010/08
	*/
?>
	<script type="text/javascript">
  
	function seleccionoSess(vars){
     var url = "include/ajax/ajaxSessionRads.php";
     var xml = null;
     var valorCheck;
     try{
         xml = new ActiveXObject("Microsoft.XMLHTTP");
     }catch(expeption){
         xml = new XMLHttpRequest();
     }
    if(vars=="Activar") {
     xml.open("GET",url +"?rad="+ vars+"&krd=<?=$krd?>&accionSession=Activar", false);
		}else{
		 xml.open("GET",url +"?rad="+ vars+"&krd=<?=$krd?>&accionSession=Inactivar", false);	
    }
	
     xml.send(null);
     if(xml.status == 404) alert("Url no valida");
     return xml.responseText;
}
  </script>
<?
?>
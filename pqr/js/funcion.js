	function makeSublist(parent,child,isSubselectOptional)
		{
			$("body").append("<select style='display:none' id='"+parent+child+"'></select>");
			$('#'+parent+child).html($("#"+child+" option"));
			$('#'+child).html("<option value=0>--- Seleccione una opci&oacute;n ---</option>");
			$('#'+parent).change(
				function()
				{
					var parentValue = $('#'+parent).attr('value');
					$('#'+child).html($("#"+parent+child+" .sub_"+parentValue).clone());
					if(isSubselectOptional) $('#'+child).prepend("<option> -- Select -- </option>");
				}
			);
		}
	
		$(document).ready(function()
		{
			makeSublist('parent','child',false);
		});
	
	//-------------------------------------------------------------------------------------------
	
	function mostrar(num){
		document.getElementById(num).style.visibility = 'visible';
	}
	function ocultar(nom){
		document.getElementById(nom).style.visibility = 'hidden';
	}
	//-------------------------------------------------------------------------------------------
	function maximaLongitud(texto,maxlong) {
	var tecla, in_value, out_value;
	
	if (texto.value.length > maxlong) {
		alert('Supero el numero maximo de caracteres');
	in_value = texto.value;
	out_value = in_value.substring(0,maxlong);
	texto.value = out_value;
	return false;
	}
	return true;
	}
	
	
	
	function isEmailAddr(email)
	{
	  var result = false;
	  var theStr = new String(email);
	  var index = theStr.indexOf("@");
	  if (index > 0)
	  {
	    var pindex = theStr.indexOf(".",index);
	    if ((pindex > index+1) && (theStr.length > pindex+1))
		result = true;
	  }
	  if (/[\S\w-\.]{3,}@([\S\w-]{2,}\.)*([\w-]{2,}\.)[\S\w-]{2,4}/.test(email)){
	      
    		result = true;
 		 } else {
           result = false;
      }
	  return result;
	}
	
	
	//---------------------------------------------------------------------------------------------------------
	
	function validRequired(formField,fieldLabel)
	{
		var result = true;
	
		if (formField.value == "")
		{
			alert('El campo "'+fieldLabel +'" es requerido');
			formField.focus();
			result = false;
		}
	
		return result;
	}
	
	
	function validEmail(formField,fieldLabel)
	{
		var result = true;
	
		if ((formField.value != "") && ((formField.value.length < 2) || !isEmailAddr(formField.value)) )
		{
			alert("Formato de e-Mail invalido, verifique por favor");
			formField.focus();
			result = false;
		}
	
	  return result;
	
	}
	
	function validtipodoc(formField,fieldLabel)
	{
		var result = true;
	
		valor = formField.value;
			if( !(/^\d{14}$/.test(valor)) ) {
			alert('El "'+fieldLabel +'" es incorrecto. Este debe tener 14 digitos');
			formField.focus();
	  		return false;
		}
	
		return result;
	}
	
	
	//---------------------------------------------------------------------------------------------------------
	function validar_contacto(theForm)
	{
	
		if (document.getElementById('numerox') != null){
			if (!validRequired(theForm.numerox, " Numero xx "))
	 		return false;
		}
		
		
		if (!validEmail(theForm.txtCorr, "Email"))
	 		return false;
	
		if(theForm.tipoSolicitud.value == "0"){
			 alert("Debe seleccionar 'Tipo de solicitud'");
			 return false;
		}
	
		if (!validRequired(theForm.txtNomb, " Nombre "))
	 		return false;
	
	 	if (!validRequired(theForm.txtApell, " Apellido "))
	 		return false;
			 
        if(theForm.parent.value == "0"){
			 alert("Debe Seleccionar Un Departamento !");
			 return false;
		}	
		if(theForm.child.value == "0"){
			 alert("Debe Un Municipio . . . . ");
			 return false;
		}	
	
		if (!validRequired(theForm.txtCorr, " E-mail "))
	 		return false;
	
	 	if (!validRequired(theForm.txInfo, " Informacion a consultar "))
	 		return false;
					
		var GLOBAL_maxlong = 800;		
		
		if (theForm.txInfo.value.length > GLOBAL_maxlong) 
		{			
			theForm.txInfo.focus();
			alert('Supero el numero maximo de caracteres');
			out_value = theForm.txInfo.value.substring(0, GLOBAL_maxlong);
			theForm.txInfo.value = out_value;
			return false;
		}	
	
		return true;
	}
	
	
	function validar_tipodoc(theForm)
	{
		if (!validtipodoc(theForm.tpradi, "No de radicado"))
	 		return false;
	
		return true;
	}
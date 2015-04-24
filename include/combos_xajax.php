<?php
	
	// PATCH 2009-04-29
	// Loading Usuarios
	function setUsuarios($ruta_raiz, $option, $combo){		
		$xres=new xajaxResponse();		
		include_once "$ruta_raiz/include/db/ConnectionHandler.php";
		require_once("$ruta_raiz/class_control/usuario.php");
		$db = new ConnectionHandler("$ruta_raiz");
		
		error_reporting(7);
		
		$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
		$objects=Usuario::getObjects($db->conn, '%');
		require_once("$ruta_raiz/include/select.php");
		// Creando Objeto Select		
		
		$sel=new select();	
		
			
		//Agregando Opciones	
		
		if(count($objects)==0){			
			$sel->agregarOpcion('-1','No existen registros');
			
		}else{								
			// Opción inicial
			$sel->agregarOpcion('%','Todos los usuarios');
			$sel->agregarObjetos($objects);			
		}
		// Opción seleccionada
		if ($option!='') {
			$sel->seleccionarValue($option);	
		}
		// Cargo los datos en el combo
		$xres->addScript($sel->getJavaScript("$combo"));
				
		return utf8_encode($xres->getXML());
	}
	
	// PATCH 2009-05-05
	// Loading Dependencias
	function setDependencias($ruta_raiz, $option, $combo){		
		$xres=new xajaxResponse();
		
		include_once "$ruta_raiz/include/db/ConnectionHandler.php";
		require_once("$ruta_raiz/class_control/Dependencia.php");
		$db = new ConnectionHandler("$ruta_raiz");
		
		error_reporting(7);
		
		$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
		$objects=Dependencia::getObjects($db->conn, '%');
		require_once("$ruta_raiz/include/select.php");
		// Creando Objeto Select			
		$sel=new select();				
		//Agregando Opciones		
		if(count($objects)==0){			
			$sel->agregarOpcion('-1','No existen registros');
			
		}else{								
			// Opción inicial
			$sel->agregarOpcion('%','Todos las dependencias');
			$sel->agregarObjetos($objects);			
		}
		// Opción seleccionada
		if ($option!='') {
			$sel->seleccionarValue($option);	
		}
		// Cargo los datos en el combo
		$xres->addScript($sel->getJavaScript("$combo"));
				
		return utf8_encode($xres->getXML());
	}
	
	
	// Cargar combos de hora
	// PATCH 2008
	function cargar_combo_hora($combo, $hora=''){									
		$xres=new xajaxResponse();		
		require_once("../include/select.php");
		ob_start();
		?>
			<select id='<?php echo $combo?>1' name='<?php echo $combo?>1' class="select"></select>
			<select id='<?php echo $combo?>2' name='<?php echo $combo?>2' class="select"></select>
			<select id='<?php echo $combo?>3' name='<?php echo $combo?>3' class="select"></select>
		<?php		
		$xres->addAssign($combo,"innerHTML", ob_get_clean());
		$hora=explode(':',$hora);
		$h=$hora[0];
		$m=$hora[1];
		$s='AM';
		if($h>12){
			$h-=12;
			$s='PM';
			
		}			
		// Creando Objeto Select Hora
		$sel=new select();		
		//Agregando Opciones	
		$sel->agregarOpcion('1','01');
		$sel->agregarOpcion('2','02');
		$sel->agregarOpcion('3','03');
		$sel->agregarOpcion('4','04');
		$sel->agregarOpcion('5','05');
		$sel->agregarOpcion('6','06');
		$sel->agregarOpcion('7','07');
		$sel->agregarOpcion('8','08');
		$sel->agregarOpcion('9','09');
		$sel->agregarOpcion('10','10');
		$sel->agregarOpcion('11','11');
		$sel->agregarOpcion('12','12');						
		// Opción seleccionada
		if ($h!='') {
			$sel->seleccionarValue($h);	
		}
		// Cargo los datos en el combo
		$xres->addScript($sel->getJavaScript("$combo"."1"));
		// Creando Objeto Select Minutos
		$sel=new select();		
		//Agregando Opciones	
		$sel->agregarOpcion('0','00');		
		$sel->agregarOpcion('5','05');		
		$sel->agregarOpcion('10','10');
		$sel->agregarOpcion('15','15');
		$sel->agregarOpcion('20','20');
		$sel->agregarOpcion('25','25');
		$sel->agregarOpcion('30','30');
		$sel->agregarOpcion('35','35');
		$sel->agregarOpcion('40','40');
		$sel->agregarOpcion('45','45');
		$sel->agregarOpcion('50','50');
		$sel->agregarOpcion('55','55');		
		// Opción seleccionada
		if ($m!='') {
			$sel->seleccionarValue($m);	
		}
		// Cargo los datos en el combo
		$xres->addScript($sel->getJavaScript("$combo"."2"));
		// Creando Objeto Select AM/PM
		$sel=new select();		
		//Agregando Opciones	
		$sel->agregarOpcion('AM','AM');
		$sel->agregarOpcion('PM','PM');
		if ($s!='') {
			$sel->seleccionarValue($s);	
		}
		// Cargo los datos en el combo		
		$xres->addScript($sel->getJavaScript("$combo"."3"));
		return utf8_encode($xres->getXML());
	}
?>
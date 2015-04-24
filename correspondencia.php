<?php
  include_once('./config.php');
  include_once('./include/Smarty/libs/Smarty.class.php');
  session_start();
  
  $mostrar_plantilla = true;
  $smarty = new Smarty();
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;
  
  foreach ($_GET as $key => $valor)
    ${$key} = $valor;
  foreach ($_POST as $key => $valor)
    ${$key} = $valor;
  
  $tipo_carp = (isset($_GET["tipo_carp"])) ? $_GET["tipo_carp"] : null;
  $carpetano = (isset($_GET["carpetano"])) ? $_GET["carpetano"] : null;
  
  $krd          = (isset($_SESSION["krd"])) ? $_SESSION["krd"] : null;
  $dependencia  = (isset($_SESSION["dependencia"])) ? $_SESSION["dependencia"] : null;
  $usua_doc     = (isset($_SESSION["usua_doc"])) ? $_SESSION["usua_doc"] : null;
  $codusuario   = (isset($_SESSION["codusuario"])) ? $_SESSION["codusuario"] : null;
  $tip3Nombre   = (isset($_SESSION["tip3Nombre"])) ? $_SESSION["tip3Nombre"] : null;
  $tip3desc     = (isset($_SESSION["tip3desc"])) ? $_SESSION["tip3desc"] : null;
  $tip3img      = (isset($_SESSION["tip3img"])) ? $_SESSION["tip3img"] : null;
  $tpNumRad     = (isset($_SESSION["tpNumRad"])) ? $_SESSION["tpNumRad"] : null;
  $tpPerRad     = (isset($_SESSION["tpPerRad"])) ? $_SESSION["tpPerRad"] : null;
  $tpDescRad    = (isset($_SESSION["tpDescRad"])) ? $_SESSION["tpDescRad"] : null;
  $tip3Nombre   = (isset($_SESSION["tip3Nombre"])) ? $_SESSION["tip3Nombre"] : null;
  $ESTILOS_PATH = (isset($_SESSION["ESTILOS_PATH"])) ? $_SESSION["ESTILOS_PATH"] : null;
  $ruta_raiz    = '.';
  
  if (empty($_SESSION['dependencia']))
    include('./rec_session.php');
  
  $carpeta = $carpetano;
  
  include_once('./include/db/ConnectionHandler.php');
  $db = new ConnectionHandler($ruta_raiz);
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  
  $ruta_estilos = $ruta_raiz . $ESTILOS_PATH . 'orfeo.css';

	$enlace_cuerpo = 'cuerpo.php?' . session_name() . '=' . session_id() .
                    '&krd=' . $krd .
                    '&ascdesc=desFc';
  
  // transacciones del cursor de consulta primaria
  // Coloca de direccion ip del equipo desde el cual se esta entrando a la pagina.
  $logo = (!$db->imagen())? 'logoEntidad.gif' : $db->imagen();
  $direccion_ip = $_SERVER['REMOTE_ADDR'];
  $nombre_servidor = $_SERVER['HTTP_X_FORWARDED_FOR'];
?>
<html>
  <head>
    <link rel="stylesheet" href="<?=$ruta_estilos?>">
    <script type="text/javascript" language="javascript">
      /* Funcion que muestra la ventana de novedades de usuario
        Busca los radicados de entrada o internos que le llegaron al usuario.
        Además los documentos que le devolvieron,
        le reasignaron, le informaron, le dieron visto bueno.
      */
      /*
       *	La funcion updateFolders es la encargada de verificar
        los contenidos de las carpetas del usuario que se
        encuentra en la sesion actual,

        El intervalo de tiempo para hacer estas consultas se
        define en la funcion setTimeout
       */
      function showInBox() {
        xajax_updateInBox('<?=$usua_doc?>');
        setTimeout(showInBox, 10000);
      }

      // refresca las carpetas de documentos
      function updateFolders() {
        xajax_updateFolders('<?=$krd?>');
        setTimeout(updateFolders, 10000);
      }
      </script>
      <script type="text/javascript">
      // Variable que guarda la ultima opcion de la barra de herramientas de funcionalidades seleccionada
      function MM_swapImgRestore() { //v3.0
        var i,x,a=document.MM_sr;
        for (i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
      }

      function MM_preloadImages() { //v3.0
        var d=document;
        if(d.images) {
          if(!d.MM_p)
            d.MM_p=new Array();
          
          var i,j=d.MM_p.length,a=MM_preloadImages.arguments;
          
          for(i=0; i<a.length; i++) {
            if (a[i].indexOf("#")!=0) {
              d.MM_p[j]=new Image;
              d.MM_p[j++].src=a[i];
            }
          }
        }
      }

      function MM_findObj(n, d) { //v4.01
        var p,i,x;
        
        if(!d)
          d = document;
        
        if((p=n.indexOf("?"))>0&&parent.frames.length) {
          d=parent.frames[n.substring(p+1)].document;
          n=n.substring(0,p);
        }
        
        if(!(x=d[n])&&d.all) x=d.all[n];
        
        for (i=0;!x&&i<d.forms.length;i++)
          x=d.forms[i][n];
        
        for(i=0;!x&&d.layers&&i<d.layers.length;i++)
          x=MM_findObj(n,d.layers[i].document);
        
        if(!x && d.getElementById)
          x = d.getElementById(n);
        return x;
      }

      function MM_swapImage() { //v3.0
        var i, j = 0, x, a = MM_swapImage.arguments;
        document.MM_sr = new Array; 
        for(i=0;i<(a.length-2);i+=3)
         if ((x=MM_findObj(a[i]))!=null){
          document.MM_sr[j++]=x;
          if(!x.oSrc)
            x.oSrc=x.src;
          x.src=a[i+2];
        }
      }

      function reload_window($carpetano,$carp_nomb,$tipo_carp) {
        document.write("<form action='<?=$enlace_cuerpo?>' method='post' name='form4' target='mainFrame'>");
        document.write("<input type='hidden' name='carpetano' value='" + $carpetano + "'>");
        document.write("<input type='hidden' name='carp_nomb' value='" + $carp_nomb + "'>");
        document.write("<input type='hidden' name='tipo_carpp' value='" + $tipo_carp + "'>");
        document.write("<input type='hidden' name='tipo_carpt' value='" + $tipo_carpt + "'>");
        document.write("</form>");
        document.form4.submit();
      }

      selecMenuAnt=-1;
      swVePerso = 0;
      numPerso = 0;

      function cambioMenu(img){

        MM_swapImage('plus' + img,'','imagenes/menuraya.gif',1);

        if (selecMenuAnt!=-1 && img!=selecMenuAnt)
          MM_swapImage('plus' + selecMenuAnt,'','imagenes/menu.gif',1);
        selecMenuAnt = img;

        if (swVePerso==1 && numPerso!=img){
          document.getElementById('carpersolanes').style.display="none";
          MM_swapImage('plus' + numPerso,'','imagenes/menu.gif',1);
          swVePerso=0;
        }
      }

      function verPersonales(img) {
        if (swVePerso!=1){
          document.getElementById('carpersolanes').style.display="";
          swVePerso=1;
        }else{
          document.getElementById('carpersolanes').style.display="none";
          MM_swapImage('plus' + selecMenuAnt,'','imagenes/menu.gif',1);
          selecMenuAnt = img;
          swVePerso=0;
        }
        numPerso = img;
      }
    </script>
  </head>
  <body onload="<?=$on_load?>">
  <form action="./correspondencia.php" method="get">
<?php
  $fechah  = date("dmy") . "_" . time("hms");
  $carpeta = $carpetano;
  // Cambia a Mayuscula el login-->krd -- Permite al usuario escribir su login en mayuscula o Minuscula
  $numeroa = 0;
  $numero  = 0;
  $numeros = 0;
  $numerot = 0;
  $numerop = 0;
  $numeroh = 0;
  $fechah  = date('dmy') . time('hms');
  
  //Realiza la consulta del usuarios y de una vez cruza con la tabla dependencia
  $isql    = "SELECT A.*,
                      B.DEPE_NOMB
                FROM USUARIO A,
                    DEPENDENCIA B
                 WHERE A.DEPE_CODI = B.DEPE_CODI
                 AND USUA_LOGIN ='$krd' ";
  
  $rs         = $db->conn->query($isql);
  $phpsession = session_name() . "=" . session_id();
  echo '<font size="1" face="verdana">';
  
  // Valida Longin y contrasena encriptada con funcion md5()
  if (trim($rs->fields["USUA_LOGIN"]) == trim($krd)) {
    $contraxx = $rs->fields["USUA_PASW"];
    if (trim($contraxx)) {
      $codusuario      = $rs->fields["USUA_CODI"];
      $dependencianomb = $rs->fields["DEPE_NOMB"];
      $fechah          = date("dmy") . "_" . time("hms");
      $contraxx        = $rs->fields["USUA_PASW"];
      $nivel           = $rs->fields["CODI_NIVEL"];
      $iusuario        = " and us_usuario='$krd'";
      $perrad          = $rs->fields["PERM_RADI"];
      
      // Adicionado as contador
      // si el usuario tiene permiso de radicar el prog. muestra los iconos de radicacion
      include "$ruta_raiz/menu/menuPrimero.php";
      include "$ruta_raiz/menu/radicacion.php";
      
      // Esta consulta selecciona las carpetas Basicas de DocuImage que son extraidas de la tabla Carp_Codi
      $isql   = "select CARP_CODI,CARP_DESC from carpeta order by carp_codi ";
      
      $rs     = $db->conn->query($isql);
      $addadm = '';
?>
<table border="0" cellpadding="0" cellspacing="0" width="160">
	<tr>
		<td><img src="imagenes/spacer.gif" width="10" height="1" border="0" alt=""></td>
		<td><img src="imagenes/spacer.gif" width="150" height="1" border="0" alt=""></td>
		<td><img src="imagenes/spacer.gif" width="1" height="1" border="0" alt=""></td>
	</tr>
  <tr>
    <td colspan="2">
      <a href="#" onClick="window.location.reload()">
        <img name="menu_r3_c1" src="./imagenes/menu_r5_c1.gif" alt="Presione para actualizar las carpetas." width="148" height="31" border="0">
      </a>
    </td>
    <td>
      <img src="./imagenes/spacer.gif" width="1" height="25" border="0" alt="">
    </td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td valign="top">
	    <table width="150" border="0" cellpadding="0" cellspacing="0" class="eMenu">
        <tr>
          <td valign="top">
            <table width="150"  border="0" cellpadding="0" cellspacing="3">
<?php
      while (!$rs->EOF) {
        $data    = (empty($data) || $data == '') ? 'NULL' : '';
        $numdata = trim($rs->fields["CARP_CODI"]);
        
        $sqlCarpDep = "SELECT SGD_CARP_DESCR
                        FROM SGD_CARP_DESCRIPCION
                        WHERE SGD_CARP_DEPECODI = $dependencia AND
                              SGD_CARP_TIPORAD = $numdata";
        
        $rsCarpDesc         = $db->conn->query($sqlCarpDep);
        $descripcionCarpeta = (isset($rsCarpDesc->fields["SGD_CARP_DESCR"])) ? $rsCarpDesc->fields["SGD_CARP_DESCR"] : null;
        
        $data = (isset($descripcionCarpeta)) ? $descripcionCarpeta : trim($rs->fields["CARP_DESC"]);
        
        // Se realiza la cuenta de radicados en Visto Bueno VoBo
        if ($numdata == 11) {
          if ($codusuario == 1) {
            $isql = "SELECT COUNT(*) AS CONTADOR
                  FROM RADICADO
                  WHERE CARP_PER = 0 AND
                        CARP_CODI = $numdata and
                        RADI_DEPE_ACTU = $dependencia and
                        RADI_USUA_ACTU = $codusuario";
          } else {
            $isql = "SELECT COUNT(*) AS CONTADOR
                FROM RADICADO
                  WHERE CARP_PER = 0 AND
                        CARP_CODI = $numdata AND
                        RADI_DEPE_ACTU = $dependencia AND
                            (radi_usu_ante = '$krd' OR
                              (RADI_USUA_ACTU = $codusuario AND RADI_DEPE_ACTU = $dependencia))";
          }
          
          $addadm = "&adm=1";
        } else {
          $isql   = "select count(*) as CONTADOR
                  from radicado
                  where carp_per = 0 and
                        carp_codi = $numdata and
                        radi_depe_actu = $dependencia and
                        radi_usua_actu = $codusuario";
          $addadm = "&adm=0";
        }
        
        $imagen = ($carpeta == $numdata) ? 'folder_open.gif' : 'folder_cerrado.gif';
        $flag   = 0;
        
        $rs1     = $db->conn->query($isql);
        $numerot = $rs1->fields["CONTADOR"];
        $enlace_bandejas = 'cuerpo.php?' . $phpsession .
                            '&adodb_next_page=1' .
                            '&fechah=' . $fechah .
                            '&nomcarpeta=' . $data .
                            '&carpeta=' . $numdata .
                            '&tipo_carpt=0' .
                            '&adodb_next_page=1';
        $nombre_bandeja = "$data($numerot)";
?>
	<tr  valign="middle">
			<td width="25">
        <img src="imagenes/menu.gif" width="15" height="18" alt="<?=$data?>" title="<?=$data?>" name="plus<?=$i?>">
      </td>
			<td width="125">
					<a onclick="cambioMenu(<?= $i ?>);" href="<?=$enlace_bandejas?>" class="menu_princ" target="mainFrame" alt="Seleccione una Carpeta">
            <?=$nombre_bandeja?>
          </a>
			</td>
	</tr>
	<?php
        $i++;
        $rs->MoveNext();
      }
      /**
       * Para archivos agendados no vencidos
       *  (Por. SIXTO 20040302)
       */
      $sqlFechaHoy = $db->conn->DBTimeStamp(time());
      $sqlAgendado = " and (agen.SGD_AGEN_FECHPLAZO >= " . $sqlFechaHoy . ")";
      $isql        = "select count(*) as CONTADOR
          from SGD_AGEN_AGENDADOS agen
          where usua_doc='$usua_doc' and
                agen.SGD_AGEN_ACTIVO = 1 $sqlAgendado";
      $rs          = $db->conn->query($isql);
      $num_exp     = $rs->fields["CONTADOR"];
      $data        = "Agendados no vencidos";
?>
	<tr  valign="middle">
	<td width="25"><img src="imagenes/menu.gif" width="15" height="18" alt="<?= $data ?>" title="<?= $data ?>"  name="plus<?= $i ?>"></td>
	<td width="125">
	<a onclick="cambioMenu(<?= $i ?>);" href='cuerpoAgenda.php?<?= $phpsession ?>&agendado=1&fechah=<?php
      echo "$fechah&nomcarpeta=$data&tipo_carpt=0";
?>' class="menu_princ" target="mainFrame" alt="Seleccione una Carpeta">
	<?
      echo "Agendado($num_exp)";
?>
	</a>
	</td>
	</tr>
	<?php
      /**
       * PARA ARCHIVOS AGENDADOS  VENCIDOS
       *  (Por. SIXTO 20040302)
       */
      $sqlAgendado = " and (agen.SGD_AGEN_FECHPLAZO <= " . $sqlFechaHoy . ")";
      $isql        = "select count(*) as CONTADOR
          from SGD_AGEN_AGENDADOS agen
          where usua_doc='$usua_doc' and
                agen.SGD_AGEN_ACTIVO = 1 $sqlAgendado";
      
      $rs      = $db->conn->query($isql);
      $num_exp = $rs->fields["CONTADOR"];
      $data    = "Agendados vencidos";
      $i++;
?>
		<tr  valign="middle">
		<td width="25"><img src="imagenes/menu.gif" width="15" height="18" alt='<?= $data ?> ' title='<?= $data ?>' name="plus<?= $i ?>"></td>
		<td width="125">
			<a onclick="cambioMenu(<?= $i ?>);" href='cuerpoAgenda.php?<?= $phpsession ?>&agendado=2&fechah=<?php
      echo "$fechah&nomcarpeta=$data&&tipo_carpt=0&adodb_next_page=1";
?>' class="menu_princ" target="mainFrame" alt="Seleccione una Carpeta">
			<?
      echo "Agendado Vencido(<font color='#990000'>$num_exp</font>)";
?>
			</a>
		</td>
	</tr>
<?php
  // Coloca el mensaje de Informados y cuenta cuantos registros hay en informados
  $isql = "SELECT COUNT(*) AS CONTADOR
            FROM INFORMADOS
            WHERE DEPE_CODI = $dependencia AND
                  USUA_CODI = $codusuario ";
  $imagen = ($carpeta == $numdata and $tipo_carp = 0)? 'folder_open.gif' : 'folder_cerrado.gif';
  $rs1     = $db->conn->query($isql);
  $numerot = $rs1->fields["CONTADOR"];
  $i++;
  $data = "Documentos De Informacion";
  $enlace_cuerpo_inf = 'cuerpoinf.php?' . $phpsession .
                        '&mostrar_opc_envio=1' .
                        '&orderNo=2' .
                        '&fechaf=' . $fechah .
                        '&carpeta=8' .
                        '&nomcarpeta=Informados' .
                        '&orderTipo=desc' .
                        '&adodb_next_page=1';
?>
	<tr  valign="middle">
	<td width="25">
    <img src="imagenes/menu.gif" width="15" height="18" alt="<?=$data?>" title="<?=$data?>" name="plus<?=$i?>"></td>
	<td width="125">
	<a onclick="cambioMenu(<?= $i ?>);" href="<?=$enlace_cuerpo_inf?>" class="menu_princ" target="mainFrame" alt='Documentos De Informacion' title="Documentos De Informacion">
	Informados (<?=$numerot?>)
<?php
  $i++;
?>
	</a>
	</td>
	</tr>
<?php
    /**
     * Carpeta de transacciones realizadas por el usuario
     * @autor Jairo Losada
     * @fecha Marzo del 2009
     * @version Orfeo 3.7.2
     * @licencia GNU/GPL
     *
     */
    $data = "Ultimas Transacciones del Usuario";
    $enlace_cuerpo_tx = './cuerpoTx.php?' . $phpsession .
                        '&fechah=' . $fechah .
                        '&nomcarpeta=' . $data .
                        '&tipo_carpt=0';
?>
	<tr  valign="middle">
	<td width="25"><img src="imagenes/menu.gif" width="15" height="18" alt='<?= $data ?> ' title='<?= $data ?>'  name="plus<?= $i ?>"></td>
	<td width="125">
		<a onclick="cambioMenu(<?= $i ?>);" href="<?=$enlace_cuerpo_tx?>" class="menu_princ" target="mainFrame" alt="Transaccines del Usuario">
		Transacciones
		</a>
	</td>
	</tr>
	<tr  valign="middle">
<?php
  $data = "Despliegue de Carpetas Personales";
  $enlace_crear_carpeta = 'crear_carpeta.php?' . $phpsession .
                          '&krd=' . $krd .
                          '&fechah=' . $fechah .
                          '&adodb_next_page=1';
?>
	<td width="25">
			<img src="./imagenes/menu.gif" width="15" height="18" alt='<?= $data ?> ' title='<?= $data ?>' name="plus<?= $i ?>">
	</td>
	<td width="125">
		<a onclick="cambioMenu(<?= $i ?>);verPersonales(<?= $i ?>);" href='#marcaPersonales";' class="menu_princ"  alt="Despliegue de Carpetas Personales" title="Despliegue de Carpetas Personales" name="marcaPersonales">
		PERSONALES
		</a>
	</td>
	</tr>
	</table>
		<div id="folders"></div>
		<table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="cacac9" id=carpersolanes style="display:none"  >
		<tr>
		<td>
			<a class="vinculos" href="<?=$enlace_crear_carpeta?>" class="menu_princ" target="mainFrame" alt="Creacion de Carpetas Personales" title="Creacion de Carpetas Personales">
			<font size="2">Nueva carpeta</font>
			</a>
		</td>
		</tr>
<?php
      // BUSCA LAS CARPETAS PERSONALES DE CADA USUARIO Y LAS COLOCA contando el numero de documentos en cada carpeta.
      $isql = "SELECT DISTINCT CODI_CARP,
                                DESC_CARP,
                                NOMB_CARP
                          FROM CARPETA_PER
                          WHERE USUA_CODI = $codusuario AND
                                DEPE_CODI = $dependencia
                          ORDER BY CODI_CARP ";
      
      $rs = $db->conn->query($isql);
      while (!$rs->EOF) {
        if ($data == '')
          $data = 'NULL';
        $data    = trim($rs->fields["NOMB_CARP"]);
        $numdata = trim($rs->fields["CODI_CARP"]);
        $detalle = trim($rs->fields["DESC_CARP"]);
        $data    = trim($rs->fields["NOMB_CARP"]);
        $isql    = "SELECT COUNT(1) AS contador
                      FROM RADICADO
                      WHERE CARP_PER = 1 AND
                            CARP_CODI = $numdata AND
                            RADI_DEPE_ACTU = $dependencia AND
                            RADI_USUA_ACTU = $codusuario ";
        $rs1     = $db->conn->query($isql);
        $numerot = $rs1->fields["CONTADOR"];
        $datap   = "$data(Personal)";
        $enlace_carpeta = './cuerpo.php?' . $phpsession .
                          '&fechah=' . $fechah .
                          '&tipo_carp=1' .
                          '&carpeta=' . $numdata .
                          '&nomcarpeta=' . $data .
                          ' (Personal)';
        $nombre_carpeta = "$data($numerot)";
?>
<tr>
	<td height="18">
    <a href="<?=$enlace_carpeta?>" alt="<?=$detalle?>" title="<?= $detalle ?>" class="menu_princ" target="mainFrame">
      <?=$nombre_carpeta?>
    </a>
  </td>
</tr>
<?php
        $rs->MoveNext();
      }
?>
	</table>
	</td>
	</tr>
	</table>
</td>
</tr>
</table>
<?php
    }
  }
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="t_bordeVerde">
  <tr align="center">
    <td height="35">
      <img width="80" src="<?=$logo?>" alt="Logo">
    </td>
  </tr>
  <tr align="center">
    <td height="20">
      <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Equipo: <?=$direccion_ip?><br><?=$nombre_servidor?></font>
    </td>
  </tr>
</table>
</form>
</body>
</html>

<?php
  session_start();
  $ruta_raiz = ".";
  include('./include/db/ConnectionHandler.php');
  $db = new ConnectionHandler($ruta_raiz);
  $usua_doc = $_SESSION['usua_doc'];
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  switch ($db->driver) {
    case 'oci8':
      $query = "SELECT * FROM SGD_NOVEDAD_USUARIO WHERE USUA_DOC='$usua_doc'";
      break;
    case 'postgres':
      $campo = '"USUA_DOC"';
      $query = "SELECT * FROM SGD_NOVEDAD_USUARIO WHERE $campo='$usua_doc'";
      break;
  }
  $rs = $db->query($query);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<link rel="stylesheet" href="estilos/orfeo.css">
<meta http-equiv="Content-Type" content="text/html; charset=encoding">
<title>ORFEO :: Bandeja de entrada</title>
</head>
<body style="font-size: 10px; font-famly: Arial">
	<bgsound src="Bell1.mid" loop="1"></bgsound>
	<div>
		<table width='400px'>			
			<tr>
				<td align="center" colspan="3"  class="titulos3">
					<img alt="tux" src="img/tux_server_md_wht.gif" width="50px" style="padding: 5px">					
				</td>
			</tr>		
			<tr>
				<td align="center" class="titulos3">
					<b>Novedad.</b>
				</td>						
				<td align="center" class="titulos3">
					<b>Radicado.</b>
				</td>
				<td align="center" class="titulos3">
					<b>Observaciones.</b>
				</td>
			</tr>
			<?php
  while (!$rs->EOF) {
    $tipo = "NOV_INFOR";
    $ban  = 0;
    while ($ban < 5) {
      switch ($ban) {
        case "0":
          $tipo = "NOV_INFOR";
          $let  = "INFORMADO";
          break;
        case "1":
          $tipo = "NOV_REASIG";
          $let  = "REASIGNADO";
          break;
        case "2":
          $tipo = "NOV_VOBO";
          $let  = "VISTO BUENO";
          break;
        case "3":
          $tipo = "NOV_DEV";
          $let  = "DEVUELTO";
          break;
        case "4":
          $tipo = "NOV_ENTR";
          $let  = "ENTRADA";
          break;
      }
      
      // Verifico si tiene informados						
      if ($rs->fields["$tipo"] != "") {
        // SEPARO LOS RADICADOS QUE VIENEN SEPARADOS POR ","
        $xInfor = explode(",", $rs->fields["$tipo"]);
        foreach ($xInfor as $infor) {
          // consulto la informacion de cada radicado
          $query = "SELECT HIST_OBSE, USUA_DOC FROM HIST_EVENTOS WHERE RADI_NUME_RADI='$infor' ORDER BY HIST_FECH DESC";
          
          $rs2 = $db->query($query);
          if (!$rs2->EOF) {
            $query = "SELECT USUA_NOMB FROM USUARIO WHERE USUA_DOC='" . $rs2->fields['USUA_DOC'] . "'";
            $rs3   = $db->query($query);
            if (!$rs3->EOF) {
              $usua_nomb = $rs3->fields['USUA_NOMB'];
            }
?>
								<tr class="listado2">
									<td align="center" class="leidos">
										<?php
            echo $let;
?>
									</td>										
									<td align="center" class="leidos">
										<a href="./verradicado.php?verrad=<?php
            echo $infor;
?>" target='_blank'>
										<?php
            echo $infor;
?></a>
									</td>
									<td align="center" class="leidos">
										<?php
            if ($ban == 4) {
              $obs = "Nuevo Documento";
            } else {
              $obs = explode("-", $rs2->fields['HIST_OBSE']);
              $obs = $obs[1];
            }
            echo "$usua_nomb -> $obs";
?>
									</td>
								</tr>				
								<?php
          }
        }
      }
      $ban++;
    }
    $rs->moveNext();
  }
?>		
		</table>
	</div>			
</body>
</html>
<?php
  // Elimino el registro de la tabla sgd_novedad_usuario
  $query  = "DELETE FROM SGD_NOVEDAD_USUARIO WHERE USUA_DOC='$usua_doc'";
  $delete = $db->query($query);
?>

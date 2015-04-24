<?php
	$direccion_servidor_fax = '192.127.28.30';
	$direccion_debian = 'debian';
	$var_filename = (isset($_GET['var_filename']))? $_GET['var_filename'] : null;
	$usuario_ssh = 'root';
	$directorio_fax = '/var/www/bodegaProd/faxtmp/';
	$directorio_hylafax = '/var/spool/hylafax/recvq/';
	$ImageMagick = '/usr/bin/convert';

	if(isset($var_filename)) {
		//echo $var_filename = substr($var_filename,0,(strlen($var_filename)-1));
		if(!file_exists($directorio_fax . $var_filename.".pdf") or !file_exists($directorio_fax . $var_filename.".tif")) {
			$sshExec = "ssh $usuario_ssh@$direccion_servidor_fax chmod 775 $directorio_hylafax" . "$var_filename.tif";
			echo $sshExec . "<br>\n";
			exec($sshExec,$execOutput,$execReturn);	
			//$dirRaiz = str_replace("/fax/image.php","/bodega/faxtmp/",PHP_SELF);
			$sshExec = "scp $usuario_ssh@$direccion_servidor_fax:$directorio_hylafax" . "$var_filename.tif $direccion_debian:$directorio_fax";
			echo $sshExec."<br>\n";
			
			$sshExec = "scp $usuario_ssh@$direccion_servidor_fax:$directorio_hylafax" . "$var_filename.tif $directorio_fax";
			echo $sshExec."<br>\n";
			exec($sshExec,$execOutput,$execReturn);	
			if($execReturn==0)
			{
				$sshExec = "$ImageMagick " . 
						$directorio_fax .
						$var_filename . ".tif " . 
						$directorio_fax . "$var_filename.-%d".".bmp";
				
				exec($sshExec,$execOutput,$execReturn);	
				
				if($execReturn==0) {
				}
				else {
					echo "<script>alert('Convirtio Mal  --- $sshExec');</script>";
				}
				
				$sshExec = "$ImageMagick ". 
						$directorio_fax .
						$var_filename . ".*.bmp $directorio_fax".$var_filename.".pdf";

				exec($sshExec,$execOutput,$execReturn);

				if($execReturn==0){
				}
				else
				{
					echo "<script>alert('Convirtio Mal  --- ');</script>";
				}
//				$sshExec = "rm ../bodega/faxtmp/$var_filename*jpg";
//				exec($sshExec,$execOutput,$execReturn);
//quitar si es necesario
			}
			else {
				echo "<script>alert('No pudo copiar la Imagen  --- ');</script>";
			}
		}else {
			exec("chmod 775 " . $directorio_fax . $var_filename.".tif");
		}
		header("Content-type: application/pdf");
		readfile($directorio_fax . $var_filename . ".pdf");
	}
	else {
		print("<center><img src=\"warning.png\"><h1>No hay Imagen Cargada</h1></center>");
	}
?>

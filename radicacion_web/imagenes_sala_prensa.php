<?
//ciclo que recorre el directorio /images
$d = dir('../photos/01/');
?>
              <select name="imagen" class="Estilo4">
			  	<? while (false !== ($entrada = $d->read())){ ?>
			  		<option value="<?= $entrada?>"><?= $entrada?></option>
				<?  } 
			$d->close();			
				?>
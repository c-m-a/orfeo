<?
include('../adodb/adodb.inc.php');
include('../conecta/conecta.php');
include('../sql/sala_prensa_doc.php');
include('../funciones/funciones.php');

while(!$rs_documentos->EOF)
	 {
		?>
         <tr>
            <td class="Estilo4" align="justify">
			  <br><br>
			  <strong><?= utf8_decode($rs_documentos->fields["titulo"])?></strong>
					<br>
					<a href="data/<?=utf8_decode($rs_documentos->fields["vinculo"])?>">Ver</a>					
			</td>
         </tr>
	  <?
	  $rs_documentos->MoveNext();
	  }
?>

<?
include('../adodb/adodb.inc.php');
include('../conecta/conecta.php');
include('../sql/sala_prensa_doc.php');
include('../funciones/funciones.php');

while (!$rs_documentos->EOF) { ?>		  
		  <tr class="Estilo4">
            <td colspan="3" align="justify" class="Estilo4"><br /><a href="data/<?= $rs_documentos->fields['vinculo']?>" target="_blank"><?= utf8_decode($rs_documentos->fields['titulo'])?></a><br>&nbsp;</td>
          </tr>
<? 
$rs_documentos->MoveNext();
} ?>

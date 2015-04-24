<?
include('../adodb/adodb.inc.php');
include('../conecta/conecta.php');
include('../sql/faq.php');
include('../funciones/funciones.php');
?>
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#1F619B" class="Estilo4">
<? while (!$rs_faq->EOF) { ?>
              <tr>
                <td width="17%"><font color="#FFFFFF"><strong>Pregunta :</strong></font></td>
                <td width="83%" bgcolor="#FFFFFF"><strong><?= utf8_decode($rs_faq->fields['pregunta'])?></strong></td>
              </tr>
              <tr>
                <td><font color="#FFFFFF"><strong>Respuesta :</strong></font></td>
                <td bgcolor="#FFFFFF" align="justify"><?= utf8_decode($rs_faq->fields['respuesta'])?></td>
              </tr>
<? 
$rs_faq->MoveNext();
}
?>
            </table>
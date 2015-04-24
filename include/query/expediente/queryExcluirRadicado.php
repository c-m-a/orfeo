<?
switch($db->driver)
{
    case 'mssql':
        break;
    case 'oracle':
    case 'oci8':
    case 'postgres':
        $sqlExcluirRadicado  = "DELETE FROM SGD_EXP_EXPEDIENTE";
        $sqlExcluirRadicado .= " WHERE SGD_EXP_NUMERO = '".$_GET['expedienteExcluir']."'";
        $sqlExcluirRadicado .= " AND RADI_NUME_RADI = '".$_GET['radExcluido']."'";
        $sqlExcluirRadicado .= " AND SGD_EXP_ESTADO = 2";
        break;
}
?>
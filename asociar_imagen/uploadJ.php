<HTML>
<head>
<link rel="stylesheet" href="<?=$ruta_raiz?>/estilos/orfeo.css">
</head>
<BODY>
    <input type="file" name="attach" id="attach"
    onchange="setBlock();" />
    <div id="moreUploads"></div>
    <div id="moreLink" style="display:none;">
    <a href="javascript:addFileInput();">Agregar otro Archivo</a>
    </div>

</BODY>
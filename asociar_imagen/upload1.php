<HTML>
<head>
<link rel="stylesheet" href="<?=$ruta_raiz?>/estilos/orfeo.css">
<script>
    var upload_number = 2;
    function addFileInput() {
        var d = document.createElement("div");
        var file = document.createElement("input");
        file.setAttribute("type", "file");
        file.setAttribute("name", "attach"+upload_number);
        d.appendChild(file);
        document.getElementById("moreUploads").appendChild(d);
        upload_number++;
    }
    function setBlock() {
       document.getElementById('moreLink').style.display = 'block';
    }
</script>
</head>
<BODY>
    <input type="file" name="attach" id="attach"
    onchange="setBlock();" />
    <div id="moreUploads"></div>
    <div id="moreLink" style="display:none;">
    <a href="javascript:addFileInput();">Agregar otro Archivo</a>
    </div>

</BODY>
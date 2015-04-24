<form action="upload.php" method="post" enctype="multipart/form-data"> 
    <b>Campo de tipo texto:</b> 
    <br> 
    <input type="text" name="cadenatexto" value=5dd size="20" maxlength="100"> 
    <input type="hidden" name="MAX_FILE_SIZE" value="100000"> 
    <br> 
    <br> 
    <b>Enviar un nuevo archivo: </b> 
    <br> 
    <input name="archivo" type="file"> 
    <br> 
    <input type="submit" value="Enviar"> 
</form> 

<? 
//compruebo si las características del archivo son las que deseo 
echo "El tamaño es  $archivo_size";
if ($archivo_size >= 10000000) { 
    echo "el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>se permiten archivos de 100 Kb máximo.</td></tr></table>"; 
}else{ 
    if(!copy($archivo, "../../bodega/masiva/".$archivo_name) ) 
{ 
echo "error al copiar el archivo"; 
} 
else 
{ 
echo "archivo subido con exito"; 
} 
} 
?> 
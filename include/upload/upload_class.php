<?php 
/*
Easy PHP Upload - version 2.29
A easy to use class for your (multiple) file uploads

Copyright (c) 2004 - 2006, Olaf Lederer
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

    * Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
    * Neither the name of the finalwebsites.com nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

______________________________________________________________________
available at http://www.finalwebsites.com 
Comments & suggestions: http://www.finalwebsites.com/contact.php
*/
 
class file_upload {

    var $the_file;
	var $the_temp_file;
    var $upload_dir;
	var $replace;
	var $do_filename_check;
	var $max_length_filename = 100;
    var $extensions;
	var $ext_string;
	var $language;
	var $http_error;
	var $rename_file; // if this var is true the file copy get a new name
	var $file_copy; // the new name
	var $message = array();
	var $create_directory = true;
	
	function file_upload() {
		$this->language = "es"; // choice of en, nl, es
		$this->rename_file = false;
		$this->ext_string = "";
	}
	function show_error_string() {
		$msg_string = "";
		foreach ($this->message as $value) {
			$msg_string .= $value."<br>\n";
		}
		return $msg_string;
	}
	function set_file_name($new_name = "") { // this "conversion" is used for unique/new filenames 
		if ($this->rename_file) {
			if ($this->the_file == "") return;
			$name = ($new_name == "") ? strtotime("now") : $new_name;
			$name = $name.$this->get_extension($this->the_file);
		} else {
			$name = $this->the_file;
		}
		return $name;
	}
	function upload($to_name = "") {
		$new_name = $this->set_file_name($to_name);
		if ($this->check_file_name($new_name)) {
			if ($this->validateExtension()) {
				if (is_uploaded_file($this->the_temp_file)) {
					$this->file_copy = $new_name;
					if ($this->move_upload($this->the_temp_file, $this->file_copy)) {
						$this->message[] = $this->error_text($this->http_error);
						if ($this->rename_file) $this->message[] = $this->error_text(16);
						return true;
					}
				} else {
					$this->message[] = $this->error_text($this->http_error);
					return false;
				}
			} else {
				$this->show_extensions();
				$this->message[] = $this->error_text(11);
				return false;
			}
		} else {
			return false;
		}
	}
	function check_file_name($the_name) {
		if ($the_name != "") {
			if (strlen($the_name) > $this->max_length_filename) {
				$this->message[] = $this->error_text(13);
				return false;
			} else {
				if ($this->do_filename_check == "y") {
					if (preg_match("/^[a-z0-9_]*\.(.){1,5}$/i", $the_name)) {
						return true;
					} else {
						$this->message[] = $this->error_text(12);
						return false;
					}
				} else {
					return true;
				}
			}
		} else {
			$this->message[] = $this->error_text(10);
			return false;
		}
	}
	function get_extension($from_file) {
		$ext = strtolower(strrchr($from_file,"."));
		return $ext;
	}
	function validateExtension() {
		$extension = $this->get_extension($this->the_file);
		$ext_array = $this->extensions;
		if (in_array($extension, $ext_array)) { 
			// check mime type hier too against allowed/restricted mime types (boolean check mimetype)
			return true;
		} else {
			return false;
		}
	}
	// this method is only used for detailed error reporting
	function show_extensions() {
		$this->ext_string = implode(" ", $this->extensions);
	}
	function move_upload($tmp_file, $new_file) {
		umask(0);
		if ($this->existing_file($new_file)) {
			$newfile = $this->upload_dir.$new_file;
			if ($this->check_dir($this->upload_dir)) {
				if (move_uploaded_file($tmp_file, $newfile)) {
					if ($this->replace == "y") {
						//system("chmod 0777 $newfile"); // maybe you need to use the system command in some cases...
						chmod($newfile , 0777);
					} else {
						// system("chmod 0755 $newfile");
						chmod($newfile , 0755);
					}
					return true;
				} else {
					return false;
				}
			} else {
				$this->message[] = $this->error_text(14);
				return false;
			}
		} else {
			$this->message[] = $this->error_text(15);
			return false;
		}
	}
	function check_dir($directory) {
		if (!is_dir($directory)) {
			if ($this->create_directory) {
				umask(0);
				mkdir($directory, 0777);
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
	function existing_file($file_name) {
		if ($this->replace == "y") {
			return true;
		} else {
			if (file_exists($this->upload_dir.$file_name)) {
				return false;
			} else {
				return true;
			}
		}
	}
	function get_uploaded_file_info($name) {
		$str = "<br>Nombre de Archivo: ".basename($name)."\n";
		$str .= "<br>Tamaño de Archivo: ".filesize($name)." bytes\n";
		if (function_exists("mime_content_type")) {
			$str .= "<br>Mime type: ".mime_content_type($name)."\n";
		}
		if ($img_dim = getimagesize($name)) {
			$str .= "<br>Dimensiones De la Imagen: x = ".$img_dim[0]."px, y = ".$img_dim[1]."px\n";
		}
		return $str;
	}
	// this method was first located inside the foto_upload extension
	function del_temp_file($file) {
		$delete = @unlink($file); 
		clearstatcache();
		if (@file_exists($file)) { 
			$filesys = eregi_replace("/","\\",$file); 
			$delete = @system("del $filesys");
			clearstatcache();
			if (@file_exists($file)) { 
				$delete = @chmod ($file, 0775); 
				$delete = @unlink($file); 
				$delete = @system("del $filesys");
			}
		}
	}
	// some error (HTTP)reporting, change the messages or remove options if you like.
	function error_text($err_num) {
		switch ($this->language) {
			case "nl":
			$error[0] = "Foto succesvol kopieert.";
			$error[1] = "Het bestand is te groot, controlleer de max. toegelaten bestandsgrootte.";
			$error[2] = "Het bestand is te groot, controlleer de max. toegelaten bestandsgrootte.";
			$error[3] = "Fout bij het uploaden, probeer het nog een keer.";
			$error[4] = "Fout bij het uploaden, probeer het nog een keer.";
			$error[10] = "Selecteer een bestand.";
			$error[11] = "Het zijn alleen bestanden van dit type toegestaan: <b>".$this->ext_string."</b>";
			$error[12] = "Sorry, de bestandsnaam bevat tekens die niet zijn toegestaan. Gebruik alleen nummer, letters en het underscore teken. <br>Een geldige naam eindigt met een punt en de extensie.";
			$error[13] = "De bestandsnaam is te lang, het maximum is: ".$this->max_length_filename." teken.";
			$error[14] = "Sorry, het opgegeven directory bestaat niet!";
			$error[15] = "Uploading <b>".$this->the_file."...Fout!</b> Sorry, er is al een bestand met deze naam aanwezig.";
			$error[16] = "Het gekopieerde bestand is hernoemd naar <b>".$this->file_copy."</b>.";
			break;
			case "de":
			$error[0] = "Die Datei: <b>".$this->the_file."</b> wurde hochgeladen!"; 
			$error[1] = "Die hochzuladende Datei ist gr&ouml;&szlig;er als der Wert in der Server-Konfiguration!"; 
			$error[2] = "Die hochzuladende Datei ist gr&ouml;&szlig;er als der Wert in der Klassen-Konfiguration!"; 
			$error[3] = "Die hochzuladende Datei wurde nur teilweise &uuml;bertragen"; 
			$error[4] = "Es wurde keine Datei hochgeladen"; 
			$error[10] = "W&auml;hlen Sie eine Datei aus!."; 
			$error[11] = "Es sind nur Dateien mit folgenden Endungen erlaubt: <b>".$this->ext_string."</b>";
			$error[12] = "Der Dateiname enth&auml;lt ung&uuml;ltige Zeichen. Benutzen Sie nur alphanumerische Zeichen f&uuml;r den Dateinamen mit Unterstrich. <br>Ein g&uuml;ltiger Dateiname endet mit einem Punkt, gefolgt von der Endung."; 
			$error[13] = "Der Dateiname &uuml;berschreitet die maximale Anzahl von ".$this->max_length_filename." Zeichen."; 
			$error[14] = "Das Upload-Verzeichnis existiert nicht!"; 
			$error[15] = "Upload <b>".$this->the_file."...Fehler!</b> Eine Datei mit gleichem Dateinamen existiert bereits.";
			$error[16] = "Die hochgeladene Datei ist umbenannt in <b>".$this->file_copy."</b>.";
			break;
			//
			// place here the translations (if you need) from the directory "add_translations"
			//
			case "es": // spanish translation
			$error[0] = "El fichero: <b>".$this->the_file."</b> se ha cargado correctamente!";
			$error[1] = "El fichero a cargar excede del tama&ntilde;o m&aacute;ximo de la directiva en la configuraci&oacute;n del servidor.";
			$error[2] = "El fichero a cargar excede del tama&ntilde;o m&aacute;ximo de la directiva especificada en el formulario html.";
			$error[3] = "El fichero a cargar solo lo ha sido parcialmente.";
			$error[4] = "El fichero no ha sido cargado.";
			$error[10] = "Por favor seleccione un fichero a cargar.";
			$error[11] = "Solo ficheros con las siguientes extensiones est&aacute;n permitidos: <b>".$this->ext_string."</b>";
			$error[12] = "Lo siento, el nombre del fichero contiene car&aacute;cteres invalidos. Use solo car&aacute;cteres alfanum&eacute;ricos y separe (si es necesario) con un subrayado. <br>Un nombre de fichero correcto acaba con un punto seguido de la extensi&oacute;n.";
			$error[13] = "El nombre de fichero excede de la longitud m&aacute;xima de ".$this->max_length_filename." car&aacute;cteres.";
			$error[14] = "¡Lo siento, el directorio de destino no existe!";
			$error[15] = "Cargando <b>".$this->the_file."...Error!</b> lo siento, un fichero con el mismo nombre ya existe.";
			$error[16] = "The uploaded file is renamed to <b>".$this->file_copy."</b>.";
			break;
			default:
			// start http errors
			$error[0] = "File: <b>".$this->the_file."</b> successfully uploaded!";
			$error[1] = "The uploaded file exceeds the max. upload filesize directive in the server configuration.";
			$error[2] = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the html form.";
			$error[3] = "The uploaded file was only partially uploaded";
			$error[4] = "No file was uploaded";
			// end  http errors
			$error[10] = "Please select a file for upload.";
			$error[11] = "Only files with the following extensions are allowed: <b>".$this->ext_string."</b>";
			$error[12] = "Sorry, the filename contains invalid characters. Use only alphanumerical chars and separate parts of the name (if needed) with an underscore. <br>A valid filename ends with one dot followed by the extension.";
			$error[13] = "The filename exceeds the maximum length of ".$this->max_length_filename." characters.";
			$error[14] = "Sorry, the upload directory doesn't exist!";
			$error[15] = "Uploading <b>".$this->the_file."...Error!</b> Sorry, a file with this name already exitst.";
			$error[16] = "The uploaded file is renamed to <b>".$this->file_copy."</b>.";
			
		}
		return $error[$err_num];
	}
}
?>
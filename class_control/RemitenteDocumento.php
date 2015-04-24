<?php

/**
 * RemitenteDocumento es la clase encargada de gestionar las operaciones 
 * relacionadas con el manejo que se da a los tipos de remitente, dentro del formulario que
 * selecciona paqueted de numeración y fechado
 * a un radicado
 * <p>
 * @author      Sixto Angel Pinzón
 * @version     1.0
 */
 
class RemitenteDocumento {

/**
   * Almacena el nombre del remitente usuario
   * @var string
   * @access public
   */
var $usuarioRemitenteNombre;
/**
   * Almacena la dirección remitente usuario
   * @var string
   * @access public
   */
var $usuarioRemitenteDireccion;
/**
   * Almacena el nombre del departamento del remitente usuario
   * @var string
   * @access public
   */
var $usuarioRemitenteDepartamento;
/**
   * Almacena el nombre del municipio del remitente usuario
   * @var string
   * @access public
   */
var $usuarioRemitenteMunicipio;
/**
   * Almacena el nombre de la ESP remitente 
   * @var string
   * @access public
   */
var $ESPRemitenteNombre;
/**
   * Almacena la dirección de la ESP remitente 
   * @var string
   * @access public
   */
var $ESPRemitenteDireccion;
/**
   * Almacena el nombre del departamento de la ESP remitente 
   * @var string
   * @access public
   */
var $ESPRemitenteDepartamento;

/**
   * Almacena el nombre del municipio de la ESP remitente 
   * @var string
   * @access public
   */
var $ESPRemitenteMunicipio;
/**
   * Almacena el nombre del remitente "otro"
   * @var string
   * @access public
   */
var $otroRemitenteNombre;
/**
   * Almacena la dirección del remitente "otro"
   * @var string
   * @access public
   */
var $otroRemitenteDireccion;
/**
   * Almacena el nombre del departamento del remitente "otro"
   * @var string
   * @access public
   */
var $otroRemitenteDepartamento;
/**
   * Almacena el nombre del municipio del remitente "otro"
   * @var string
   * @access public
   */
var $otroRemitenteMunicipio;
/**
   * Almacena el nombre del predio
   * @var string
   * @access public
   */
var $predioRemitenteNombre;
/**
   * Almacena la dirección del predio
   * @var string
   * @access public
   */
var $predioRemitenteDireccion;
/**
   * Almacena el nombre del departamento del predio
   * @var string
   * @access public
   */
var $predioRemitenteDepartamento;
/**
   * Almacena el nombre del municipio del predio
   * @var string
   * @access public
   */
var $predioRemitenteMunicipio;
/**
   * Almacena el estilo css de la escritura de los datos
   * @var string
   * @access public
   */
var $estiloFila;

/** 
* Inicializa el estilo de escritura de los datos
* @return   void
*/
function RemitenteDocumento() {
	$this->estiloFila="timpar";
}

/** 
* Actualiza los atributos de usuario
* @param	$nombre	String	Corresponde al nombre del usuario
* @param	$direccion	String	Corresponde a la direccion del usuario
* @param	$departamento	String	Corresponde al nombre del departamento del usuario
* @param	$municipio	String	Corresponde al nombre del municipio del usuario
* @return   void
*/
function setDatosUsuario($nombre,$direccion,$departamento,$municipio){
	$this->usuarioRemitenteNombre=$nombre;
	$this->usuarioRemitenteDireccion=$direccion;	
	$this->usuarioRemitenteDepartamento=$departamento;
	$this->usuarioRemitenteMunicipio=$municipio;
}

/** 
* Actualiza los atributos de ESP
* @param	$nombre	String	Corresponde al nombre de la ESP
* @param	$direccion	String	Corresponde a la direccion de la ESP
* @param	$departamento	String	Corresponde al nombre del departamento la ESP
* @param	$municipio	String	Corresponde al nombre del municipio la ESP
* @return   void
*/
function setDatosESP($nombre,$direccion,$departamento,$municipio){
	$this->ESPRemitenteNombre=$nombre;
	$this->ESPRemitenteDireccion=$direccion;	
	$this->ESPRemitenteDepartamento=$departamento;
	$this->ESPRemitenteMunicipio=$municipio;
}

/** 
* Actualiza los atributos del remitente "otro"
* @param	$nombre	String	Corresponde al nombre del remitente "otro"
* @param	$direccion	String	Corresponde a la direccion del remitente "otro"
* @param	$departamento	String	Corresponde al nombre del remitente "otro"
* @param	$municipio	String	Corresponde al nombre del remitente "otro"
* @return   void
*/
function setDatosOtro($nombre,$direccion,$departamento,$municipio){
	$this->otroRemitenteNombre=$nombre;
	$this->otroRemitenteDireccion=$direccion;	
	$this->otroRemitenteDepartamento=$departamento;
	$this->otroRemitenteMunicipio=$municipio;
}

/** 
* Actualiza los atributos del predio
* @param	$nombre	String	Corresponde al nombre del predio
* @param	$direccion	String	Corresponde a la direccion del predio
* @param	$departamento	String	Corresponde al nombre del predio
* @param	$municipio	String	Corresponde al nombre del predio
* @return   void
*/
function setDatosPredio($nombre,$direccion,$departamento,$municipio){
	$this->predioRemitenteNombre=$nombre;
	$this->predioRemitenteDireccion=$direccion;	
	$this->predioRemitenteDepartamento=$departamento;
	$this->predioRemitenteMunicipio=$municipio;
}

/** 
* Escribe los datos de usuario
* @return   void
*/
function escribirCeldasUsuario(){

	$tag="<tr class='$this->estiloFila'> ";
	$tag.="<td> $this->usuarioRemitenteNombre</td>";
	$tag.="</tr>";
	$tag.="<tr class='$this->estiloFila'> ";
	$tag.="<td>$this->usuarioRemitenteDireccion</td>";
	$tag.="</tr>";
	$tag.="<tr class='$this->estiloFila'> ";
	$tag.="<td>$this->usuarioRemitenteDepartamento - $this->usuarioRemitenteMunicipio</td>";
	$tag.="</tr>";
	print($tag);

}

/** 
* Escribe los datos de la ESP
* @return   void
*/
function escribirCeldasESP(){

	$tag="<tr class='$this->estiloFila'> ";
	$tag.="<td> $this->ESPRemitenteNombre</td>";
	$tag.="</tr>";
	$tag.="<tr class='$this->estiloFila'> ";
	$tag.="<td>$this->ESPRemitenteDireccion</td>";
	$tag.="</tr>";
	$tag.="<tr class='$this->estiloFila'> ";
	$tag.="<td>$this->ESPRemitenteDepartamento - $this->ESPRemitenteMunicipio</td>";
	$tag.="</tr>";
	print($tag);

}


/** 
* Escribe los datos de predio
* @return   void
*/
function escribirCeldasPredio(){

	$tag="<tr class='$this->estiloFila'> ";
	$tag.="<td> $this->predioRemitenteNombre</td>";
	$tag.="</tr>";
	$tag.="<tr class='$this->estiloFila'> ";
	$tag.="<td>$this->predioRemitenteDireccion</td>";
	$tag.="</tr>";
	$tag.="<tr class='$this->estiloFila'> ";
	$tag.="<td>$this->predioRemitenteDepartamento - $this->predioRemitenteMunicipio</td>";
	$tag.="</tr>";
	print($tag);

}


/** 
* Escribe los datos de otro
* @return   void
*/
function escribirCeldasOtro(){

	$tag="<tr class='$this->estiloFila'> ";
	$tag.="<td> $this->otroRemitenteNombre</td>";
	$tag.="</tr>";
	$tag.="<tr class='$this->estiloFila'> ";
	$tag.="<td>$this->otroRemitenteDireccion</td>";
	$tag.="</tr>";
	$tag.="<tr class='$this->estiloFila'> ";
	$tag.="<td>$this->otroRemitenteDepartamento - $this->otroRemitenteMunicipio</td>";
	$tag.="</tr>";
	print($tag);

}

/** 
* Gestiona la escritura de los datos de un tipo de remitente
* @return   void
*/
function escribirRemitente($tipoRemitente){

	switch ($tipoRemitente) {
   case 0:
      $this->escribirCeldasESP();
       break;
   case 1:
      $this->escribirCeldasOtro();
       break;
   case 2:
        $this->escribirCeldasUsuario();
       break;
	  case 3:
        $this->escribirCeldasPredio();
       break;
			 
}

}

/** 
* Verifica la completitud de los datos de un tipo de remitente
* @return   void
*/
function verificarCompletitud ($tipoRemitente){

	switch ($tipoRemitente) {
   case 0:
      $this->verificarESP();
       break;
   case 2:
        $this->verificarUsuario();
       break;
	 case 3:
        $this->verificarPredio();
       break; 
			 }
}

/** 
* Verifica la completitud de los datos de ESP, si no estan completos escribe un mensaje indicando este problema
* @return   void
*/
function verificarESP(){

if (strlen($this->ESPRemitenteNombre)==0 || strlen($this->ESPRemitenteDireccion)==0 || strlen($this->ESPRemitenteDepartamento)==0 || strlen($this->ESPRemitenteMunicipio)==0)
	echo("Debe completar los datos refrentes a la ESP (Para envio son obligatorios Nombre, Direccion, Departamento, Municipio)");
}

/** 
* Verifica la completitud de los datos de usuario, si no estan completos escribe un mensaje indicando este problema
* @return   void
*/
function verificarUsuario(){
if (strlen($this->usuarioRemitenteNombre)==0 || strlen($this->usuarioRemitenteDireccion)==0 || strlen($this->usuarioRemitenteDepartamento)==0 || strlen($this->usuarioRemitenteMunicipio)==0)
	echo("Debe completar los datos refrentes al Usuario (Para envio son obligatorios Nombre, Direccion, Departamento, Municipio)");
}

/** 
* Verifica la completitud delos datos del predio, si no estan completos escribe un mensaje indicando este problema
* @return   void
*/
function verificarPredio(){
if (strlen($this->predioRemitenteNombre)==0 || strlen($this->predioRemitenteDireccion)==0 || strlen($this->predioRemitenteDepartamento)==0 || strlen($this->predioRemitenteMunicipio)==0)
	echo("Debe completar los datos refrentes al Usuario (Para envio son obligatorios Nombre, Direccion, Departamento, Municipio)");
}


}



?>

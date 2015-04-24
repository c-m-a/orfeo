<?php
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2002 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Urs Gehrig <urs@circle.ch>                                  |
// +----------------------------------------------------------------------+
//
// $Id: image2svg.php,v 1.1 2002/05/01 21:31:37 chregu Exp $

/**
* XML_image2svg - Image to SVG conversion
*
* The class converts images, such as of the format JPEG, PNG
* and GIF to a standalone SVG representation. The image is being 
* encoded by the PHP native encode_base64() function. You can use it
* to get back a complete SVG file, which is based on a predefinded,
* easy adaptable template file, or you can take the encoded
* file as a return value, using the get() method. Due to the 
* encoding by base64, the SVG files will increase approx. 30% in
* size compared to the conventional image.
*
* NOTE: 
*   Since PHP 4.0.5 GetImageSize() support has been added.
*
* EXAMPLE:
*   $i = &new XML_image2svg("test.jpg" );
*   $i->tplFile = "tpl.image.svg";
*   $i->show();
*
*   The class allows also commandline conversion of images:
*   C:\>php-cli -f Test_image2svg.php > test.svg
*
* REFERENCES:
*   http://www.ietf.org/rfc/rfc2397.txt, The "data" URL scheme
*   http://www.ietf.org/rfc/rfc2045.txt, Multipurpose Internet Mail Extensions
*   http://www.w3.org/Graphics/SVG/, Scalable Vector Graphics (SVG)
*/

/**
* Image to svg conversion.
*
*
* @version  $Id: image2svg.php,v 1.1 2002/05/01 21:31:37 chregu Exp $
* @package  XML
* @author   Urs Gehrig <urs@circle.ch> 
*/
require_once( "PEAR.php") ;
require_once( "HTML/IT.php") ;	

class XML_image2svg extends PEAR {

    /**
    * TODO: Modify the quality of the output image. Needs GD support.
    *
    * @var imageQuality
    */
    var $imageQuality = 0.8;
    
    /** 
    * Image file pointer. 
    *
    */
    var $fp = null;
        
    /**
    * Storage representation of the image string
    *
    * @var  string
    */
    var $buffer = "";
    
    /**
    * Image information
    *
    * @var  array
    */
    var $par = array(0, 0, 0, "" );    
    
    /**
    * Constructs a new XML_image2svg object.
    *
    * @param string image filename    
    * @access public
    * @author Urs Gehrig <urs@circle.ch>
    */
    function XML_image2svg ($fileName="" )
    {
        $this->PEAR();
        $this->fileName = $fileName;
        $this->tpl      = new IntegratedTemplate("." );
        $this->tplFile  = "";
        
        $this->_getImage();
    }

    /**
    * Read the image file binary-safe
    *
    * @access private
    * @return mixed bool on success or an error object otherwise
    * @author Urs Gehrig <urs@circle.ch>     
    */
    function _getImage ()
    {        
        if(file_exists($this->fileName )) {
            $fp = fopen ($this->fileName, "rb" );
            $this->buffer = fread($fp, filesize ($this->fileName ));
            
            if (!$fp) {
                return $this->errorHandler("FAILED_OPENING_FILE", __FILE__, __LINE__ );
            }
            
            $this->fp = $fp;
            fclose ($fp);
             
            return $this->_getImageParamteres();
        }
        return $this->errorHandler("FILE_NOT_FOUND", __FILE__, __LINE__ );         
    }
    
    /**
    * Get the specific image parameters
    *
    * @access private
    * @return mixed bool on success or an error object on fail
    * @author Urs Gehrig <urs@circle.ch>      
    */    
    function _getImageParamteres ()
    {
        if (is_resource($this->fp )) {
            $this->par = @getimagesize($this->fileName );
            SWITCH ($this->par[2] ) {
                case 1:
                    $this->imagetype = 'image/gif';
                    break;
                case 2:
                    $this->imagetype = 'image/jpg';
                    break;
                case 3:
                    $this->imagetype = 'image/png';
                    break;
                default:
                    return $this->errorHandler("MIME_ERROR", __FILE__, __LINE__ );    
            }
            return TRUE;
        }
        return $this->errorHandler("READ_ERROR", __FILE__, __LINE__ );
    }
    
    /**
    * Convert the image to an SVG file. Having specified a template file
    * allows direct inclusion of the image into a more sophisticated SVG file;
    * while not giving a template file, a most slim standalone SVG string will
    * be returned.
    * 
    * @access private
    * @return mixed a string on success or an error object otherwise
    * @author Urs Gehrig <urs@circle.ch>      
    */    
    function _convertToSvg ()
    {
        if(file_exists($this->tplFile ) ) {
            
            if(strlen($this->tplFile )) {
            	$this->tpl->loadTemplatefile($this->tplFile, true, true);
            	$content = array(
            	    "img_width"         =>  $this->par[0],
            	    "img_height"        =>  $this->par[1],
            	    "data_url_scheme"   =>  sprintf("data:%s;base64,%s", 
            	                                $this->imagetype,
            	                                $this->encodeImage()
            	                            )
            	);          
                $this->tpl->setVariable($content);  
                
                return $this->tpl->get();
                
            } else {
                $s .= sprintf("<?xml version=\"1.0\" ?>" );
                $s .= sprintf("<svg %s viewBox=\"0 0 %s %s\" xml:space=\"preserve\">",
                            $this->par[3],
                            $this->par[0],
                            $this->par[1]
                );   
                $s .= sprintf("<g><image %s xlink:href=\"data:%s;base64,%s\"  /></g>", 
                            $this->par[3],
                            $this->imagetype,
                            $this->encodeImage()
            	);
                $s .= sprintf("</svg>");
                
                return $s;
            }
            
        } else {
            return $this->errorHandler("TEMPLATE_FILE_MISSING", __FILE__, __LINE__ );
        }
    }

    /**
    * Encode image by base 64
    *
    * @access public
    * @return string Returns encoded image as string
    * @author Urs Gehrig <urs@circle.ch>      
    */    
    function encodeImage ()
    {
        return base64_encode($this->buffer );
    }
        
    /**
    * Return the SVG output
    *
    * @access public
    * @return mixed PEAR_Error object or string
    * @author Urs Gehrig <urs@circle.ch>      
    */    
    function get () 
    {
        if (is_resource($this->fp )) {
            return $this->_convertToSvg();
        }
        return $this->errorHandler("CONVERSION", __FILE__, __LINE__ );;        
    }

    /**
    * Display the SVG output
    *
    * @access public
    * @return mixed PEAR_Error object or bool on success
    * @author Urs Gehrig <urs@circle.ch>     
    */
    function show () 
    {
        if ($res = $this->get() ) {
            header("Content-type: image/svg+xml" );
            echo $res;
            return TRUE;
        }
        return $this->errorHandler("UNKNOWN", __FILE__, __LINE__ );
    }
    
    /**
    * Handling the error messages
    *
    * @param string error message
    * @param string file where the error occured
    * @param string linenumber where the error occured    
    * @access public
    * @return object PEAR_Error object
    * @author Urs Gehrig <urs@circle.ch>     
    */
    function errorHandler ($err="UNKNOWN", $file=__FILE__, $line=__LINE__ )
    {
        $this->error_codes = array (
            "FILE_NOT_FOUND"        => "The image file could not be found.",
            "FAILED_OPENING_FILE"   => "The image file could not be opened.",
            "READ_ERROR"            => "The image file could not be read.",
            "MIME_ERROR"            => "Unsupported mimetype.",
            "TEMPLATE_FILE_MISSING" => "The SVG template file is missing.",
            "CONVERSION"            => "Error on returning the conversion result.",
            "UNKNOWN"               => "Unknown error."
        );

        return $this->raiseError(sprintf("%s [%s on line %d].", 
                    $this->error_codes[$err], 
                    $file, 
                    $line ), 
                    null,
                    PEAR_ERROR_DIE 
               );    
    }
    
    /**
    * Class destructor
    *
    * @access private
    * @author Urs Gehrig <urs@circle.ch>       
    */
    function _XML_image2svg ()
    {
        $this->_PEAR();
    }    
}
?>
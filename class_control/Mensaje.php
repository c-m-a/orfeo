<?php
  /**
   * Mensaje es la clase encargada de gestionar las operaciones y los datos básicos referentes a una Mensaje Orfeo
   * @author	Sixto Angel Pinzón
   * @version	1.0
   */
  class  Mensaje {
    /**
     * Gestor de las transacciones con la base de datos
     * @var ConnectionHandler
     * @access public
     */
    var $cursor;
    /**
     * Variable que se corresponde con su par, uno de los campos de la tabla SGD_MSG_MENSAJE
     * @var string
     * @access public
     */
    var $sgd_msg_codi;
    /**
     * Variable que se corresponde con su par, uno de los campos de la tabla SGD_MSG_MENSAJE
     * @var string
     * @access public
     */
    var $sgd_tme_codi;
    /**
     * Variable que se corresponde con su par, uno de los campos de la tabla SGD_MSG_MENSAJE
     * @var string
     * @access public
     */
    var $sgd_msg_desc;
    /**
     * Variable que se corresponde con su par, uno de los campos de la tabla SGD_MSG_MENSAJE
     * @var string
     * @access public
     */
    var $sgd_msg_fechdesp;
    /**
     * Variable que se corresponde con su par, uno de los campos de la tabla SGD_MSG_MENSAJE
     * @var string
     * @access public
     */
    var $sgd_msg_url;
    /**
     * Variable que se corresponde con su par, uno de los campos de la tabla SGD_MSG_MENSAJE
     * @var string
     * @access public
     */
    var $sgd_msg_veces;
    
    
    /** 
    * Constructor encargado de obtener la conexion
    * @param	$db	ConnectionHandler es el objeto conexion
    * @return   void
    */
    function Mensaje($db) {
      $this->cursor = $db;
    }

    /** 
    * Función que crea el javascript que deplega los mensajes que tiene programados un usuario
    * @param	$usrDoc	Documento del usuario
    * @param	$Dependencia	$Dependencia a la que pertenece el usuario
    * @return   String	Retorna el Javascript que desplegará los mensajes
    */
    function getMsgsUsr($usrDoc,$Dependencia){
      $sqlFechaHoy=$this->cursor->conn->OffsetDate(0,$this->cursor->conn->sysTimeStamp);
      $sql = "select m.SGD_MSG_CODI,m.SGD_MSG_URL, m.SGD_MSG_VECES,t.SGD_TME_CODI,m.SGD_MSG_ANCHO,m.SGD_MSG_LARGO 
           from  SGD_MSDEP_MSGDEP md ,	USUARIO u , SGD_MSG_MENSAJE m, SGD_TME_TIPMEN t where
            t.SGD_TME_CODI = m.SGD_TME_CODI and 
          u.USUA_DOC = '$usrDoc' and u.DEPE_CODI = $Dependencia and 
          md.DEPE_CODI = u.DEPE_CODI and m.SGD_MSG_FECHDESP <= $sqlFechaHoy and
          m.SGD_MSG_CODI = md.SGD_MSG_CODI";
      $rs=$this->cursor->query($sql);
      /*$script = "<script> 
                                ventana = window.open(url,'Mensaje' + num,'top='+top+',left='+left+',height='+largo+',width='+ancho+',scrollbars=yes');
                                top = top +  30;
                                left = left + 200;
                                ventana.focus(); 
                                
                  </script>   ";*/
                  $script="";
            
      $i=0;
      $top = 0;
      $left = 100;
      while ($rs && !$rs->EOF ){
        $top+=100;
        $left+= 10;
        $url=$rs->fields['SGD_MSG_URL'];
        $codi=$rs->fields['SGD_MSG_CODI'];
        $vecesPorLer= $rs->fields['SGD_MSG_VECES'];
        $tipMens = $rs->fields['SGD_TME_CODI'];
        $ancho = $rs->fields['SGD_MSG_ANCHO'];
        $largo = $rs->fields['SGD_MSG_LARGO'];
        $sql2 = "select * from SGD_ACM_ACUSEMSG where SGD_MSG_CODI=$codi and USUA_DOC = '$usrDoc' ";
        //		and  SGD_MSG_LEIDO < $vecesPorLer ";
        $rs2=$this->cursor->query($sql2);
        $swExiste = 0;
        $swMostrar = 0;
        
              
        if (!$rs2 || $rs2->EOF ){
          $swMostrar = 1;
        }else {
          $vecesLeido=$rs2->fields['SGD_MSG_LEIDO'];	
          $swExiste = 1;
          
          if  ($vecesPorLer > $vecesLeido) 
            $swMostrar = 1;
            
        }
        $rs->MoveNext();	
        
        if ($swMostrar==1){
          $i++;
          $script.= " 
          

          <div id='capa$i' style='position:absolute;width:$ancho"."px;left:$left;top:$top;visibility:visible'>
          
           <table border='0' width='$ancho' bgcolor='#424242' cellspacing='0' cellpadding='5' >
            <tr>
              <td width='100%' >
                  <table border='0' width='100%' cellspacing='0' cellpadding='0'  >
                    <tr>
                      <td id='Mensaje$i' style='cursor:move' width='100%'  >
                        <ilayer width='100%' onSelectStart='return false'>
                          <layer width='100%' onMouseoverisHot=true;if (isN4) ddN4(capa$i) onMouseout='isHot=false'>
                            <font face='Arial' color='#FFFFFF'>Mensaje$i</font>
                          </layer>
                        </ilayer>
                      </td>
                      <td style='cursor:hand' valign='top'>
                        <a href='#' onClick=hideMe('capa".$i."');return false><font color=#ffffff size=2 face=arial  style='text-decoration:none'>X</font></a>
                      </td>
                    </tr>
                    <tr>
                      <td width='100%' bgcolor='#FFFFFF' style='padding:4px'  colspan='2' height='$largo'>
                      <!-- PLACE YOUR CONTENT HERE //-->  
                      <iframe src=$url height='100%'  width='100%'  ></iframe>
                      <!-- END OF CONTENT AREA //-->
                      </td>
                    </tr>
                  </table> 
            </td>
            </tr>
          </table> </div> 
        
          ";	
      
          
              $this->acuseRecibo($usrDoc,$codi,$swExiste,$tipMens);
        }
      }
      
      $script.= " </script>";
      return ($script);
      
    }

    
    function acuseRecibo($usrDoc,$msgCodi,$existe,$tipMsg){
      
      $this->cursor->conn->BeginTrans();
      
      //Acuse Automático para mensajes tipo POPUP
      if ($tipMsg==1){
        
        if ($existe==0){
          $values["SGD_MSG_CODI"] = $msgCodi;
          $values["USUA_DOC"] = "'$usrDoc'";
          $values["SGD_MSG_LEIDO"] = 1;
          $rs=$this->cursor->insert("SGD_ACM_ACUSEMSG",$values);
        
        }elseif ($existe==1){
          $values["SGD_MSG_LEIDO"] = "SGD_MSG_LEIDO + 1";
          $recordWhere["SGD_MSG_CODI"] = $msgCodi;
          $recordWhere["USUA_DOC"] = "'$usrDoc'";
          $rs=$this->cursor->update("SGD_ACM_ACUSEMSG", $values, $recordWhere);
          
        }
      
        if (!$rs){
          $this->cursor->conn->RollbackTrans();
          die ("<span class='etextomenu'>No se ha podido actualizar la información de notificación"); 
        }
      }
      
      $this->cursor->conn->CommitTrans();
			
			
	}
}
?>

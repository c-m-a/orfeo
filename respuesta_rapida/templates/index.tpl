<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Respuesta Rapida</title>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link href="../estilos/orfeo.css"         type="text/css"  rel="stylesheet" />

		<script src='js/jquery-1.2.6.min.js'      type="text/javascript"></script>
 		<script src='js/jquery.form.js'           type="text/javascript" language="javascript"></script>
		<script src='js/jquery.MetaData.js'       type="text/javascript" language="javascript"></script>
 		<script src='js/jquery.MultiFile.pack.js' type="text/javascript" language="javascript"></script>
 		<script src='js/jquery.blockUI.js'        type="text/javascript" language="javascript"></script>

        <script language="javascript">

            function valFo(el){
                var result = true;
                var destin = el.destinatario.value;
                var salida = destin.split(";");

                if (destin == ""){
                    alert('El campo destinatario es requerido');
                    el.destinatario.focus();
                    result = false;
                };

                for(i = 0; i < salida.length; i++){
                    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(salida[i])){
                        result = true;
                    }else{
                        alert('El destinatario es incorrecto:  ' + salida[i]);
                        el.destinatario.focus();
                        result = false;
                        break;
                    } 
                }


                if(result){
                    ray.ajax();
                };
                
                return result;
            };

            var ray={
                ajax:function(st){
                        this.show('load');
                },
                show:function(el){
                        this.getID(el).style.display='';
                },
                getID:function(el){
                        return document.getElementById(el);
                }
            }

			$(function(){ // wait for document to load 
				$('#T7').MultiFile({ 
					STRING: {
						remove: '<img src="./js/bin.gif" height="16" width="16" alt="x"/>'
					},
					list: '#T7-list'
				}); 
			})

        </script>

        <style type="text/css">

            HTML, BODY{
                font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;
                margin: 0px; 
                height: 100%;
            }

            #load{
                position:absolute;
                z-index:1;
                border:3px double #999;
                background:#f7f7f7;
                width:300px;
                height:300px;
                margin-top:-150px;
                margin-left:-150px;
                top:50%;
                left:50%;
                text-align:center;
                line-height:300px;
                font-family: verdana, arial,tahoma;
                font-size: 14pt;
            }

            img {
                border: 0 none;
            }

            .MultiFile-label{
                float: left;
                margin: 3px 15px 3px 3px;
            }

        </style>

    </head>
    <body>
        <div id="load" style="display:none;">Enviando.....</div>
        <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="../respuesta_rapida/procRespuesta.php?<!--{$sid}-->" onsubmit="return valFo(this)">
          <input type=hidden name="usuanomb"   value='<!--{$usuanomb}-->'>
          <input type=hidden name="usualog"    value='<!--{$usualog}-->'> 
          <input type=hidden name="radPadre"   value='<!--{$radPadre}-->'>
          <input type=hidden name="usuacodi"   value='<!--{$usuacodi}-->'> 
          <input type=hidden name="depecodi"   value='<!--{$depecodi}-->'> 
          <input type=hidden name="codigoCiu"  value='<!--{$codigoCiu}-->'>
          <input type=hidden name="codigoCiu"  value='<!--{$codigoCiu}-->'>
          <input type=hidden name="codigoCiu"  value='<!--{$codigoCiu}-->'>
          <input type=hidden name="rutaPadre"  value='<!--{$rutaPadre}-->'>

            <table border="0" width="100%" align="center" cellspacing="0" cellpadding="0">
                <tr align="center" class="titulos2">
                  <td height="15" colspan="4" class="titulos4">RESPUESTA RAPIDA</td>
                </tr>

                <tr>
                    <td class="titulos5" height="20">
                      <span>Para enviar a multiples correos Separe con ";"&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;    
                      Para escribir una nueva linea utilice las teclas [shift] + [Enter]&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                      Para escribir un nuevo parrafo utilice la tecla [Enter]</span> 
                    </td>
                </tr>

                <tr>
                    <td>
                        <table border="0" width="100%" align="center" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="20px" class="titulos">Remite:</td>
                                <td width="50%">
                                    <select class="select_resp" name="usMailSelect" id="usMailSelect">
                                      <option selected value="orfeo@supersolidaria.gov.co"> 
                                        orfeo@supersolidaria.gov.co
                                      </option>
                                    </selected>
                                </td>
                                <td width="20px" class="titulos">Destinatario:</td>
                                <td width="50%">
                                    <input class="select_resp" type=text id="destinatario" 
                                    name="destinatario" value='<!--{$destinatario}-->' maxlength="120">
                                </td>
                            </tr>
                            <tr>
                               <td width="20px" class="titulos">CC:</td>
                               <td>
                                 <input  class="select_resp" type=text name="concopia" value='' maxlength="120">
                               </td>
                               <td width="20px" class="titulos">CCO</td>
                               <td>
                                 <input class="select_resp" type=text name="concopiaOculta" value='' maxlength="120">
                               </td>
                            </tr>
                            <tr>
                               <td class="titulos" height="63px">Adjuntar</td>
                               <td colspan=2>
					<input class="select_resp" name="archs[]" type="file" id="T7" accept="<!--{$extn}-->"/>
       								<div id="T7-list" class="select_resp" ></div>
							   </td>
                            </tr>
                            <tr>
                               <td class="select_resp"  height="63px" colspan="4">
				     Se adjunta Documento <!--{$radPadre}--> <br>
                                    <b>Anexar documentos existentes<b><br>
                                    <table>
                                        <tr>
                                    <!--{counter start=0 skip=1 assign="count"}-->
                                    <!--{foreach key=key item=item from=$docAnex}-->
                                        <!--{counter}-->
                                        <td>
                                        <input checked="checked" type="checkbox" name="docAnex[]" value="<!--{$item.nomb}-->  ">
                                        <!--{$item.tama}--> <b><!--{$item.desc}--></b> 
                                        <!--{if ($count % 3 == 0)}-->
                                         </td></tr><tr>
                                        <!--{else}-->
                                         </td>
                                        <!--{/if}-->
                                    <!--{/foreach}-->
                                    </table>
                               </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr align="center">
                  <td width="100%" height="25" class="titulos5" align="center" colspan="4">
                    <input type="submit" name="Button" value="ENVIAR" class="botones">
                  </td>
                </tr>

                <tr>
                  <td colspan="4">
                     <textarea id="texrich" name="respuesta" value=''><!--{$asunto}--></textarea>
                  </td>
                </tr>
          </table>
         </form>
    </body>
</html>

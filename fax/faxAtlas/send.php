<?php
/*
 * $Id: form.php,v 1.4 2002/01/30 08:04:00 nisapus Exp $
 *
 * Copyright (C) 2002 Supasin Sae-heng <nisapus@yahoo.com>
 *
 * This file is subject to the terms and conditions of the GNU General Public
 * License.  See the file "COPYING" for more details.
 */

require("include/pre.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
 <title>Enviar FAX</title>
 <link rel="stylesheet" type="text/css" href="style.css">
<script language="Javascript">
<!--
function submit_login() {
    if (document.nfaxlogin.var_fax_from.value == "") {
        alert("Por favor ingrese campo \"De:\"" );
        document.nfaxlogin.var_fax_from.focus();
    return false;
    } else if (document.nfaxlogin.var_fax_no.value == "") {
        alert("Por favor ingrese campo \"N&uacute;mero de FAX:\"" );
        document.nfaxlogin.var_fax_no.focus();
    return false;
    } else {
        document.nfaxlogin.submit();
    return true;
    }
}

function open_help_win (win_location) {
    var screen_width, screen_height;
    var win_top, win_left;
    var HelpWin;

    screen_height        = 0;     screen_width      = 0;
    win_top              = 0;     win_left          = 0;

    var help_win_width   = 315;
    var help_win_height  = 270;

    if (window.innerWidth) screen_width = window.innerWidth;
    if (window.innerHeight) screen_height = window.innerHeight;

    win_top  = screen_height - help_win_height - 20;
    win_left = screen_width  - help_win_width  - 20;
    HelpWin  = window.open(
        win_location,
        'HelpWin',
    'width='+help_win_width+',height='+help_win_height+',top='+win_top   );
    HelpWin.focus();
}

//-->

</script>

</head>
<body bgcolor="#ffffff" marginheight="2" marginwidth="2">
<form enctype="multipart/form-data" action="preview.php" method="post" name="nfaxlogin">
<!-- end TOP_BAR -->

<font size="+1"><b>&nbsp; Enviar FAX</b></font>

<input type="hidden" name="MAX_FILE_SIZE" value="<?php print $DEFAULT_MAX_FILE_SIZE;?>">
<!-- +++ begin form +++ -->
<table border="0" cellspacing="0" cellpadding="0">
<caption>FAX</caption>
 <tr bgcolor="#999999">
  <td>
   <table border="0" cellspacing="1" cellpadding="3">
    <tr>
     <td align="left" bgcolor="#dcdcdc">
      <b>&nbsp; Por favor ingrese la informaci&oacute;n de FAX (<font color="#ff0000">*</font> es campo requerido.)</b>
     </td>
    </tr>

    <tr>
     <td bgcolor="#eeeeee">
      <table border="0" cellspacing="0" cellpadding="4">
       <tr>
        <td>
         &nbsp; <b>
         <a href="" style="TEXT-DECORATION: none" onclick="open_help_win('help.php?topic=var_fax_from'); return false;" notab tabstop="-1">
         <font color="#000000">De:</font>
         </a>
         <font color="#ff0000">*</font></b>
        </td>
        <td>
          <input type="text" name="var_fax_from" size="25" value="<?php print $var_fax_from;?>">
        </td>
       </tr>
 
       <tr>
        <td>
         &nbsp;<b>
         <a href="" style="TEXT-DECORATION: none" onclick="open_help_win('help.php?topic=var_fax_to'); return false;" notab tabstop="-1">
         <font color="#000000">Para:</font>
         </a>
         </b>
        </td>
        <td>
         <input type="text" name="var_fax_to" size="25" value="<?php print $var_fax_to;?>">
        </td>
       </tr>
 
       <tr>
        <td width="120">
         &nbsp; <b>
         <a href="" style="TEXT-DECORATION: none" onclick="open_help_win('help.php?topic=var_fax_no'); return false;" notab tabstop="-1">
          <font color="#000000">N&uacute;mero de FAX:</font>
          </a>
          <font color="#ff0000">*</font></b>
        </td>
        <td width="500">
         <input type="text" name="var_fax_no" size="25" value="<?php print $var_fax_no;?>">
        </td>
       </tr>
 
       <tr>
        <td>
         &nbsp; <b>
         <a href="" style="TEXT-DECORATION: none" onclick="open_help_win('help.php?topic=var_fax_company'); return false;" notab tabstop="-1">
         <font color="#000000">Compa&ntilde;&iacute;a:</font>
         </a>
         </b>
        </td>
        <td>
          <input type="text" name="var_fax_company" size="25" value="<?php print $var_fax_company;?>">
        </td>
       </tr>
 
       <tr>
        <td>
         &nbsp; <b>
         <a href="" style="TEXT-DECORATION: none" onclick="open_help_win('help.php?topic=var_fax_subject'); return false;" notab tabstop="-1">
         <font color="#000000">Asunto:</font>
         </a>
         </b>
        </td>
        <td>
         <input type="text" name="var_fax_subject" size="25" value="<?php print $var_fax_subject;?>">
        </td>
       </tr>

       <tr>
        <td colspan="2">&nbsp;
         <textarea name="var_fax_message" rows="4" cols="37" wrap="virtual"><?php print $var_fax_message;?></textarea>
        </td>
       </tr>
 
       <tr>
        <td>
         &nbsp; <b>
         <a href="" style="TEXT-DECORATION: none" onclick="open_help_win('help.php?topic=var_fax_attach'); return false;" notab tabstop="-1">
         <font color="#000000">Archivo:</font>
         </a>
         </b>
        </td>
        <td>
         <input name="var_fax_attach" type="file" size="15">
        </td>
       </tr>

      </table>
     </td>
    </tr>

    <tr bgcolor="#ffffff">
     <td>
      <input type="submit" value="Previsualizar" onClick="submit_login();return(false);">
      <input type="reset" value="Borrar">
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>
</form>
</body>
</html>

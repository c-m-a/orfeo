<?php
/*
 * $Id: preview.php,v 1.5 2002/01/30 08:04:00 nisapus Exp $
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
 <title>Fax preview</title>
<style TYPE="text/css">
<!--
 a:link { color: #222222; }  
-->
</style>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body bgcolor="#ffffff" marginheight="2" marginwidth="2">

<form action="send.php" method="post">
<font size="+1"><b>&nbsp; Previsualizar FAX</b></font>

<?php
//********************************************************
// create tmp directory for storing converted file
// You can define "$DEFAULT_TMP_DIR" in "include/pre.php"
// I recommend using "/var/tmp" instead of "/tmp"
//********************************************************
umask(077);
$DIR_TMP  = "$DEFAULT_TMP_DIR/.nweb2fax-" . getmypid() . time();
mkdir($DIR_TMP,0700);

//***********************
// check input variables
//***********************
if ($var_fax_no == "") {
    die("<p><font color=\"#ff0000\"><b>Error</b>: Por favor ingrese campo \"<b>N&uacute;mero de FAX</b>\"</font>");
}

if ($var_fax_from == "") {
    die("<p><font color=\"#ff0000\"><b>Error</b>: Por favor especifique campo \"<b>De</b>\"</font>");
}

if ($var_fax_message == "") {
    $var_fax_message = " ";
}

if ($var_fax_subject == "") {
    $var_fax_subject = " ";
}

if ($var_fax_to == "") {
    $var_fax_to = " ";
}

//*************************
// check attachment valid?
//*************************
if ($var_fax_attach == "none" || $var_fax_attach == "") {
    print ("<br>&nbsp; <font color=\"#000000\"><b>Advertencia!</b>: No hay un documento para enviar excepto una portada</font>");
    $var_attach_no_pages = 0;
} else {

    //**********************************************************
    // check attachment file type. If not PostScript, then die().
    //**********************************************************
    unset($exec_output);
    unset($exec_return);
    exec("$PROG_FILE $var_fax_attach",$exec_output,$exec_return);
    if (!eregi("postscript",$exec_output[0])) {
        die("<p>&nbsp;<font color=\"#ff0000\"><b>Error</b>: El archivo adjunto debe ser un archivo PostScript.</font>");
    }

    //**************************************************************************
    // use "gs" to covert PS attachment to mutiple PNG image files by pages.
    //**************************************************************************
    $FILE_ATTACH_PNG   = "$DIR_TMP/.nfax-attach.png";
    $FILE_ATTACH_PS    = "$DIR_TMP/.nfax-attach.ps";
    $FILE_sOutputFile  = $FILE_ATTACH_PNG . "-%d";
    $sDEVICE = "pnggray";

    unset($exec_output);
    unset($exec_return);
    exec("$PROG_CAT $var_fax_attach | $PROG_GS -sDEVICE=$sDEVICE -q -dNOPAUSE -sOutputFile=$FILE_sOutputFile - ",$exec_output,$exec_return);

    // find no. of pages of the attachment by counting generated PNG files
    $var_attach_no_pages = 0;
    $i=1;
    while(1) {
        if(is_readable("$FILE_ATTACH_PNG-$i")) {
            $var_attach_no_pages++;
        } else {
            break;
        }
        $i++;
    }

    //**************************************************************************
    // use "psselect" command to split PS attachment by pages.
    //**************************************************************************
    for ($no=1; $no<=$var_attach_no_pages; $no++) {
        exec("$PROG_PSSELECT -p$no $var_fax_attach > $FILE_ATTACH_PS-$no ");
    }
}

//==============================================================================
// Generate FAX cover page
//==============================================================================
$FILE_COVER_PNG    = "$DIR_TMP/.nfax-cover.png";
$FILE_COVER_PS     = "$DIR_TMP/.nfax-cover.ps";
$sDEVICE = "pnggray";

unset($exec_output);
unset($exec_return);
exec("$PROG_FAXCOVER \"$var_fax_message\" -C $FILE_COVER_TEMPLATE -f \"$var_fax_from\" -n \"$var_fax_no\" -p $var_attach_no_pages -r \"$var_fax_subject\" -s $PAGE_SIZE  -x \"$var_fax_company\" -t \"$var_fax_to\" > $FILE_COVER_PS",$exec_output,$exec_return);

//****************************************************
// convert conver.ps => cover.png to view on browser.
//****************************************************
unset($exec_output);
unset($exec_return);
$sOutputFile = $FILE_COVER_PNG;
exec("$PROG_CAT $FILE_COVER_PS | $PROG_GS -sDEVICE=$sDEVICE -q -dNOPAUSE -sOutputFile=$sOutputFile - ",$exec_output,$exec_return);
?>

<input type="hidden" name="var_fax_no"   value="<?php print $var_fax_no;?>">
<input type="hidden" name="var_fax_from" value="<?php print $var_fax_from;?>">
<input type="hidden" name="var_attach_no_pages" value="<?php print $var_attach_no_pages;?>">

<table border="0" cellspacing="2" cellpadding="0" width="200">
 <tr bgcolor="#999999">
  <td>
   <table border="0" cellspacing="1" cellpadding="0" width="100%">
    <tr>
     <td align="center" bgcolor="#dcdcdc" width="100%">
      <font color="#000000">
      <input type="checkbox" name="var_cover" value="<?php print $FILE_COVER_PS;?>" />
      <b>&nbsp; Portada de FAX</b></font>
     </td>
    </tr>

    <tr>
     <td width="200">
      <table border="0" cellspacing="0" cellpadding="5" width="100%">
       <tr>
        <td align="center" bgcolor="#eeeeee">
         <a href="showpng.php?var_file=cover&scale=1&png_file=<?php print $FILE_COVER_PNG;?>" target="new"><img src="showpng.php?var_file=cover&scale=4&png_file=<?php print $FILE_COVER_PNG;?>" alt="Click para aumentar" border=1></a>
        </td>
       </tr>
      </table>
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>

<!-- ====================================================================== -->
<!--  display attachment images  -->
<!--  default display column = 4 -->
<!-- ====================================================================== -->
<?php
$DEFAULT_DISPLAY_COL = 4;
$display_row = $var_attach_no_pages / $DEFAULT_DISPLAY_COL;

// xxx
//print "<br>:$var_attach_no_pages: <br>";
//print "<br>:$display_row: <br>";

for ($i=0; $i<$display_row; $i++) {
    print "<table height=\"10\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"800\">\n";
    print " <tr bgcolor=\"#ffffff\">\n";
    print "  <td>\n";
    print "  </td>\n";
    print " </tr>\n";
    print "</table>\n";

    print "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"800\">\n";
    print " <tr bgcolor=\"#ffffff\">\n";
    print "  <td>\n";
    print "   <table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" width=\"100%\">\n";
    print "    <tr align=\"center\" bgcolor=\"#ffffff\">\n";

    $td_width = 800 / $DEFAULT_DISPLAY_COL;
    for ($j=1; $j<= $DEFAULT_DISPLAY_COL; $j++) {
        $no = $DEFAULT_DISPLAY_COL*$i + $j;
        if (file_exists("$FILE_ATTACH_PS-$no")) {
            print "     <td width=\"$td_width\">\n";
            print "      <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">\n";
            print "       <tr align=\"center\" bgcolor=\"#999999\">\n";
            print "        <td width=\"$td_width\">\n";
            print "         <table border=\"0\" cellspacing=\"1\" cellpadding=\"5\" width=\"100%\">\n";
            print "          <tr align=\"center\" bgcolor=\"#dcdcdc\">\n";
            print "           <td>\n";
            print "            <input type=\"checkbox\" name=\"var_attach_file[$no]\" value=\"$FILE_ATTACH_PS-$no\" checked> P&aacute;gina $no\n";
            print "           </td>\n";
            print "          </tr>\n";
            print "          <tr align=\"center\" bgcolor=\"#eeeeee\">\n";
            print "           <td>\n";
            print "            <a href=\"showpng.php?scale=1&png_file=$FILE_ATTACH_PNG-$no\" target=\"new\"><img src=\"showpng.php?scale=4&png_file=$FILE_ATTACH_PNG-$no\" alt=\"Click para aumentar P&aacute;gina: $no\" border=1></a>\n";
            print "           </td>\n";
            print "          </tr>\n";
            print "         </table>\n";
            print "        </td>\n";
            print "       </tr>\n";
            print "      </table>\n";
            print "     </td>\n";
        } else {
            print "     <td width=\"$td_width\">\n";
            print "      <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">\n";
            print "       <tr align=\"center\" bgcolor=\"#ffffff\">\n";
            print "        <td width=\"$td_width\">\n";
            print "         &nbsp;\n";
            print "        </td>\n";
            print "       </tr>\n";
            print "      </table>\n";
            print "     </td>\n";
        }
    }

    print "    </tr>\n";
    print "   </table>\n";
    print "  </td>\n";
    print " </tr>\n";
    print "</table>\n";
    
}

?>

<table>
 <tr bgcolor="#ffffff">
  <td>
   <input type="submit" name="var_submit" value="Enviar FAX">
   <input type="reset"  value="Borrar">
  </td>
 </tr>
</table>

</form>
</body>
</html>

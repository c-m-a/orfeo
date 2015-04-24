<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onload="SetFocus();">
<div id="spiffycalendar" class="text"></div><link rel="stylesheet" type="text/css" href="spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="spiffyCal/spiffyCal_v2_1.js"></script>
<script language="javascript"><!--
  var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "new_product", "products_date_available","btnDate1","",scBTNMODE_CUSTOMBLUE);
//--></script>
<form name="new_product" > 
             <script language="javascript">
			    dateAvailable.writeControl(); 
			    dateAvailable.dateFormat="yyyy-MM-dd";
				alert(" ff "+btnDate1);
			  </script>
</form>
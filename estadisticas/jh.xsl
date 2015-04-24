<html xsl:version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" lang="en">
    <head>
        <title>Orfeo - Estadistiacas </title>
		<link rel="stylesheet" href="../estilos/orfeo.css" />
	</head>
<body>
   <table width="100%"  border="0" cellpadding="0" cellspacing="5" class="borde_tab">
	<tr >
			<td class="titulos3" width="1">	
			#
			</td>
			<td class="titulos3">	
			<a href='{$paginaActual}?cOrdenType={$cOrdenType}&amp;cOrdenDType=number&amp;cOrden=DEPE_CODI' >
				COD DEPENDENCIA
			</a>
			</td>
			<td class="titulos3">			
			<a href='{$paginaActual}?cOrdenType={$cOrdenType}&amp;cOrdenDType=text&amp;cOrden=USUA_NOMB' >
				USUARIO
			</a>
			</td>
			<td class="titulos3">						
			<a href='{$paginaActual}?cOrdenType={$cOrdenType}&amp;cOrdenDType=number&amp;cOrden=USUA_CODI' >
				COD USUARIO
			</a>			
			</td>			
	</tr> 
		<xsl:for-each select="/ROOT/ROW">
			<!-- order the result by revenue -->
			<xsl:sort select="*[name()=$cOrden]"
					  data-type='{$cOrdenDType}'
					  order="{$cOrdenType}" />
  		<xsl:if test="DEPE_CODI=$varDependencia">	
		<tr>			
	    <xsl:if test="position() mod 2 = 0">
    	    <xsl:attribute name="class">listado2</xsl:attribute>
	    </xsl:if>
	    <xsl:if test="position() mod 2 > 0">
    	    <xsl:attribute name="class">listado1</xsl:attribute>
	    </xsl:if>
			<td>
			<xsl:number value="position()" format="1. "/>
		      <xsl:value-of select="."/> **
			</td>
			<td>
				<xsl:value-of select="DEPE_CODI" />
			</td>
			<td>
				<xsl:value-of select="USUA_NOMB" />
			</td>
			<td>
				<xsl:value-of select="USUA_CODI" />
			</td>						

		</tr>
		</xsl:if>
		</xsl:for-each>
	</table>
</body>
</html>
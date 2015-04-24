<html xsl:version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" lang="en">
    <head>
        <title>Orfeo - Estadistiacas </title>
    </head>
<body>
   <table border="1">
	<tr>
			<xsl:for-each select="/ROOT/ROW[1]/*">
			<th>			
			<a href='{$paginaActual}?varDependencia={$varDependencia}' >
				<em><xsl:value-of select="name()" /></em>
			</a>
			</th>
			</xsl:for-each>
	</tr> 
		<xsl:for-each select="ROOT/ROW">
			<!-- order the result by revenue -->
			<xsl:sort select="USUA_CODI" 
					  data-type="number"
					  order="descending"/>xxx
		<xsl:if test="DEPE_CODI=$varDependencia">	
		<tr>			
			<xsl:for-each select="ROOT/ROW[0]/*">
			<td>
				<a href='{$paginaActual}?varDependencia={$varDependencia}' >
					<em><xsl:value-of select="position()" /></em>
				</a>
			</td>
			</xsl:for-each>
		</tr>
		</xsl:if>
		</xsl:for-each>
	</table>
</body>
</html>
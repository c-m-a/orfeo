<?php
  $coltp3Esp = '"'.$tip3Nombre[3][2].'"';	
  
  switch($db->driver) {
    case 'mssql':
      $isql = 'select
            convert(char(14), b.RADI_NUME_RADI) as "IDT_Numero_Radicado"
            ,b.RADI_PATH as "HID_RADI_PATH"
            ,'.$sqlFecha.' as "DAT_Fecha_Radicado"
            ,convert(char(14), b.RADI_NUME_RADI) as "HID_RADI_NUME_RADI"
            ,UPPER(b.RA_ASUN)  as "Asunto"'.
            $colAgendado.
            ',d.NOMBRE_DE_LA_EMPRESA "'.$tip3Nombre[3][2].'"
            ,c.SGD_TPR_DESCRIP as "Tipo_Documento" 
            ,b.RADI_USU_ANTE "Enviado_Por"
            ,convert(char(14),b.RADI_NUME_RADI) "CHK_CHKANULAR"
            ,b.RADI_LEIDO "HID_RADI_LEIDO"
            ,b.RADI_NUME_HOJA "HID_RADI_NUME_HOJA"
            ,b.CARP_PER "HID_CARP_PER"
            ,b.CARP_CODI "HID_CARP_CODI"
            ,b.SGD_EANU_CODIGO "HID_EANU_CODIGO"
            ,b.RADI_NUME_DERI "HID_RADI_NUME_DERI"
            ,b.RADI_TIPO_DERI "HID_RADI_TIPO_DERI"
         from
           radicado b left outer join SGD_TPR_TPDCUMENTO c
            on b.tdoc_codi = c.sgd_tpr_codigo
            left outer join BODEGA_EMPRESAS d
            on b.eesp_codi = d.identificador_empresa
        where 
        b.radi_nume_radi is not null
        and b.radi_depe_actu = ' . $dependencia .
        $whereUsuario . $whereFiltro . '
        '.$whereCarpeta.'
        '.$sqlAgendado.'
        order by '.$order .' ' .$orderTipo;	
    break;
    case 'oracle':
    case 'oci8':
    case 'oci805':
    case 'ocipo':
  /*
    $isql = 'select
          to_char(b.RADI_NUME_RADI) as "IDT_Numero Radicado"
          ,b.RADI_PATH as "HID_RADI_PATH"
          ,'.$sqlFecha.' as "DAT_Fecha Radicado"
          ,to_char(b.RADI_NUME_RADI) as "HID_RADI_NUME_RADI"
          ,UPPER(b.RA_ASUN)  as "Asunto"'.
          $colAgendado.
          ',d.NOMBRE_DE_LA_EMPRESA "'.$tip3Nombre[3][2].'"
          ,d.SIGLA_DE_LA_EMPRESA as "SIGLA"
          ,c.SGD_TPR_DESCRIP as "Tipo Documento" 
          ,round(((radi_fech_radi+(c.sgd_tpr_termino * 7/5))-sysdate)) as "Dias Restantes"
          ,b.RADI_USU_ANTE "Enviado Por"
          ,to_char(b.RADI_NUME_RADI) "CHK_CHKANULAR"
          ,b.RADI_LEIDO "HID_RADI_LEIDO"
          ,b.RADI_NUME_HOJA "HID_RADI_NUME_HOJA"
          ,b.CARP_PER "HID_CARP_PER"
          ,b.CARP_CODI "HID_CARP_CODI"
          ,b.SGD_EANU_CODIGO "HID_EANU_CODIGO"
          ,b.RADI_NUME_DERI "HID_RADI_NUME_DERI"
          ,b.RADI_TIPO_DERI "HID_RADI_TIPO_DERI"
       from
       radicado b,
       SGD_TPR_TPDCUMENTO c,
       BODEGA_EMPRESAS d

     where 
      b.radi_nume_radi is not null and b.radi_depe_actu='.$dependencia.
      $whereUsuario.$whereFiltro.
      'and b.tdoc_codi=c.sgd_tpr_codigo (+)
      and b.eesp_codi=d.identificador_empresa (+)
      '.$whereCarpeta.'
      '.$sqlAgendado.'
      order by '.$order .' ' .$orderTipo;
  */

  // Anadido CARLOS BARRERO -SES
      if($entidad='SES') {
        $isql='SELECT DISTINCT(TO_CHAR(b.RADI_NUME_RADI)) AS "IDT_Numero Radicado" ,
             b.RADI_PATH AS "HID_RADI_PATH",
             ' . $sqlFecha . ' AS "DAT_Fecha Radicado" ,
           TO_CHAR(b.RADI_NUME_RADI) AS "HID_RADI_NUME_RADI" ,
           UPPER(b.RA_ASUN) AS "Asunto" ' . $colAgendado . ',
           d.NOMBRE_DE_LA_EMPRESA ' . $coltp3Esp . ',
           d.SIGLA_DE_LA_EMPRESA  as "SIGLA" ,
           OE.SUPERVISION as "NIVEL SUPERVISION",
           c.SGD_TPR_DESCRIP AS "Tipo_Documento",
           round(((radi_fech_radi+(c.sgd_tpr_termino * 7/5))-sysdate)) as "Dias Restantes" ,
         -- ROUND( FECH_VCMTO - SYSDATE ) AS "Dias_Restantes",
           b.RADI_USU_ANTE "Enviado_Por",
           FUNC_SUPER(b.EESP_CODI) AS "FUNCIONARIO",
           DE.DEPE_NOMB AS "GRUPO",
           TO_CHAR(b.RADI_NUME_RADI) "CHK_CHKANULAR" ,
           b.RADI_LEIDO "HID_RADI_LEIDO",
           b.RADI_NUME_HOJA "HID_RADI_NUME_HOJA" ,
           b.CARP_PER "HID_CARP_PER",
           b.CARP_CODI "HID_CARP_CODI",
           b.SGD_EANU_CODIGO "HID_EANU_CODIGO",
           b.RADI_NUME_DERI "HID_RADI_NUME_DERI",
           b.RADI_TIPO_DERI "HID_RADI_TIPO_DERI"
           FROM  SGD_TPR_TPDCUMENTO c,
                  RADICADO b
           LEFT JOIN BODEGA_EMPRESAS d ON b.eesp_codi=d.identificador_empresa
           LEFT JOIN SGD_EMPUS_EMPUSUARIO EU ON EU.IDENTIFICADOR_EMPRESA=D.IDENTIFICADOR_EMPRESA
           LEFT JOIN USUARIO U ON EU.USUA_LOGIN=U.USUA_LOGIN
           LEFT JOIN DEPENDENCIA DE ON DE.DEPE_CODI=U.DEPE_CODI
           LEFT JOIN VW_ORFEO_ENTIDADES OE ON OE.CODIGO_ORFEO=d.identificador_empresa
           WHERE ' . $numero_max . '
              b.radi_nume_radi IS NOT NULL
           AND b.radi_depe_actu='.$dependencia.$whereUsuario.$whereFiltro.'
           AND b.tdoc_codi=c.sgd_tpr_codigo
           '.$whereCarpeta.'
             '.$sqlAgendado.'
             order by '. $order . ' ' . $orderTipo;

          if ($smarty_render) {
            $isql = str_replace('IDT_Numero Radicado', 'IDT_Numero_Radicado', $isql);
            $isql = str_replace('DAT_Fecha Radicado', 'DAT_Fecha_Radicado', $isql);
            $isql = str_replace('NIVEL SUPERVISION', 'NIVEL_SUPERVISION', $isql);
            $isql = str_replace('Dias Restantes', 'Dias_Restantes', $isql);
          }
      }
    
    break;
    case 'postgres':
      $whereFiltro = str_replace("b.radi_nume_radi","cast(b.radi_nume_radi as varchar(15))",$whereFiltro);
      
      $redondeo = "date_part('days', radi_fech_radi-".$db->conn->sysTimeStamp.") +
                    floor(c.sgd_tpr_termino * 7/5) +
                    (select count(*)
                      from sgd_noh_nohabiles
                      where NOH_FECHA between radi_fech_radi and ".$db->conn->sysTimeStamp.")";
    
      $isql = 'select distinct(b.RADI_NUME_RADI) as "IDT_NUMERO_RADICADO",
                    b.RADI_PATH as "HID_RADI_PATH",
                    '.$sqlFecha.' as "DAT_FECHA_RADICADO",
                    b.RADI_NUME_RADI as "HID_RADI_NUME_RADI",
                    b.RA_ASUN  as "ASUNTO"'.
                    $colAgendado.
                    ',d.SGD_DIR_NOMREMDES  as "REMITENTE",
                    c.SGD_TPR_DESCRIP as "TIPO_DOCUMENTO",
                    '.$redondeo.' as "DIAS_RESTANTES",
                    b.RADI_USU_ANTE as "ENVIADO_POR",
                    b.RADI_NUME_RADI as "CHK_CHKANULAR",
                    b.RADI_LEIDO as "HID_RADI_LEIDO",
                    b.RADI_NUME_HOJA as "HID_RADI_NUME_HOJA",
                    b.CARP_PER as "HID_CARP_PER",
                    b.CARP_CODI as "HID_CARP_CODI",
                    b.SGD_EANU_CODIGO as "HID_EANU_CODIGO",
                    b.RADI_NUME_DERI as "HID_RADI_NUME_DERI",
                    b.RADI_TIPO_DERI as "HID_RADI_TIPO_DERI"
       from
       radicado b
    left outer join SGD_TPR_TPDCUMENTO c
    on b.tdoc_codi=c.sgd_tpr_codigo
    left outer join SGD_DIR_DRECCIONES d
    on b.radi_nume_radi=d.radi_nume_radi
      where 
      b.radi_nume_radi is not null
      and b.radi_depe_actu='.$dependencia.
      $whereUsuario.$whereFiltro.'
      '.$whereCarpeta.'
      '.$sqlAgendado.'
      order by '.$order .' ' .$orderTipo;
    break;	
	}
?>

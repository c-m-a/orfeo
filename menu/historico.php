<?php
      /**
       * Carpeta de transacciones realizadas por el usuario
       * @autor Jairo Losada
       * @fecha Marzo del 2009
       * @version Orfeo 3.7.2
       * @licencia GNU/GPL
       *
       */
      $data_cuerpo_tx = "Ultimas Transacciones del Usuario";
      $id_cuerpo_tx     = $i;
      $enlace_cuerpo_tx = './cuerpoTx.php?' . $phpsession .
                          '&fechah=' . $fechah .
                          '&nomcarpeta=' . $data .
                          '&tipo_carpt=0';
      
      $smarty->assign('DATA_CUERPO_TX', $data_cuerpo_tx);
      $smarty->assign('ID_CUERPO_TX', $id_cuerpo_tx);
      $smarty->assign('ENLACE_CUERPO_TX', $enlace_cuerpo_tx);
?>

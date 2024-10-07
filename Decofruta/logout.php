<?php
  session_start();//inicia o reanuda

  session_unset();//libera

  session_destroy();

  header('Location: /acceso.php');
?>

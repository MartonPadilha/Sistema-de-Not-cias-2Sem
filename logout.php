<?php
session_start();
$idLogado = $_SESSION['idLogado'];
unset($idLogado);
header("location: login.php");
session_destroy();
exit;
 ?>

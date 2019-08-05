<?php
 //session_start();
$idLogado = $_SESSION['idLogado'];
$status = $_SESSION['statusLogado'];
if (!$idLogado) {
  header("location: login.php");
  session_destroy();
  exit;
} ?>

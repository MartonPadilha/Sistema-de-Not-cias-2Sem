<?php
session_start();
include "funcoes.php";
include "verificaLog.php";
$tipoLogado = $_SESSION['tipoLogado'];
$noticia = $_GET['noticia'];
$conexao = conectar();

if ($conexao) {
  if ($tipoLogado == "Administrador") {
    $query = "delete from noticia where idNoticia=?";
      $query_tratada = mysqli_prepare($conexao, $query);
        if ($query_tratada) {
          mysqli_stmt_bind_param($query_tratada, "i", $noticia);
            if (mysqli_stmt_execute($query_tratada)) {
              if (mysqli_stmt_affected_rows($query_tratada) > 0) {
                echo "<script>alert('Notícia apagado com sucesso!');
                window.location.href = 'noticias.php';</script>";
              }
            }
        else {
          echo "Registro não apagado";
        }
        mysqli_stmt_close($query_tratada);
        mysqli_close($conexao);
    }
  }

  if ($tipoLogado == "Autor") {
    $query = "update noticia set status = 0 where idNoticia=?";
      $query_tratada = mysqli_prepare($conexao, $query);
        if ($query_tratada) {
          mysqli_stmt_bind_param($query_tratada, "i", $noticia);
            if (mysqli_stmt_execute($query_tratada)) {
              if (mysqli_stmt_affected_rows($query_tratada) > 0) {
                echo "<script>alert('Notícia oculta com sucesso!');
                window.location.href = 'noticias.php';</script>";
              }
            }
        else {
          echo "Registro não apagado";
        }
        mysqli_stmt_close($query_tratada);
        mysqli_close($conexao);
    }
  }
}





 ?>

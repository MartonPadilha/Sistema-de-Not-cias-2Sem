<?php
session_start();
include "funcoes.php";
include "verificaLog.php";
$tipoLogado = $_SESSION['tipoLogado'];
$usuario = $_GET['usuario'];
$conexao = conectar();

if ($conexao) {
  if ($tipoLogado == "Administrador") {
    $query = "delete from autor where idAutor=?";
      $query_tratada = mysqli_prepare($conexao, $query);
        if ($query_tratada) {
          mysqli_stmt_bind_param($query_tratada, "i", $usuario);
            if (mysqli_stmt_execute($query_tratada)) {
              if (mysqli_stmt_affected_rows($query_tratada) > 0) {
                echo "<script>alert('Registro apagado com sucesso!');
                window.location.href = 'listarUsuarios.php';</script>";
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
    $query = "update autor set status = 0 where idAutor=?";
      $query_tratada = mysqli_prepare($conexao, $query);
        if ($query_tratada) {
          mysqli_stmt_bind_param($query_tratada, "i", $usuario);
            if (mysqli_stmt_execute($query_tratada)) {
              if (mysqli_stmt_affected_rows($query_tratada) > 0) {
                echo "<script>alert('Registro oculto com sucesso!');
                window.location.href = 'listarUsuarios.php';</script>";
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

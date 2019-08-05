<?php
session_start();
include_once "funcoes.php";
include_once "cabecalho.inc";
include_once "verificaLog.php";
$conexao = conectar();
if (!empty($_POST['tipoUsuario'])) {
  $nroAutor = $_POST['codigo'];
  $nome = $_POST['nome'];
  $dataNasc = $_POST['dataNasc'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $tipoUsuario = $_POST['tipoUsuario'];
  $descricao = $_POST['descricao'];

  if ($conexao) {
    $query = "update autor set nomeAutor = ?, tipo = ?, dataNascimento = ?, descricao = ?, email = ?, senha = ? where idAutor = ?";
    $query_tratada = mysqli_prepare($conexao, $query);
            if($query_tratada){
            mysqli_stmt_bind_param($query_tratada, "ssssssi", $nome, $tipoUsuario, $dataNasc, $descricao, $email, $senha, $nroAutor);
            if(mysqli_stmt_execute($query_tratada)){
                if(mysqli_stmt_affected_rows($query_tratada) > 0){
                  echo "<script>alert('Registro editado com sucesso!');
                  window.location.href = 'listarUsuarios.php';</script>";
                }
            }
            else{
                echo "Registro não gravado";
            }
            mysqli_stmt_close($query_tratada);
            mysqli_close($conexao);
        }
        else{
        mysqli_close($conexao);
        }
  }
}

?>

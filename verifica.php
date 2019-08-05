<?php
include "funcoes.php";
$conexao = conectar();
if (isset($_POST['email']) and (isset($_POST['senha']))) {
  $email = $_POST['email'];
  $senha = $_POST['senha'];

      if($conexao){
            if(loginComEmailSenha($email, $senha, $conexao)){}
      else {}
    }
  }

 ?>

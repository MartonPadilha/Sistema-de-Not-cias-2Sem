<?php
session_start();
include_once "funcoes.php";
include_once "cabecalho.inc";
include_once "verificaLog.php";
$conexao = conectar();
if (!empty($_POST['titulo'])) {
  $nroNoticia = $_POST['codigo'];
  $titulo = $_POST['titulo'];
  $idAutor = $_POST['autor'];
  $descricao = $_POST['descricao'];
  // $foto = $_POST['foto'];

  if ($conexao) {
    $query = "update noticia set titulo = ?, idAutor = ?, descricao = ? where idNoticia = ?";
    $query_tratada = mysqli_prepare($conexao, $query);
            if($query_tratada){
            mysqli_stmt_bind_param($query_tratada, "sisi", $titulo, $idAutor, $descricao, $nroNoticia);
            if(mysqli_stmt_execute($query_tratada)){
                if(mysqli_stmt_affected_rows($query_tratada) > 0){
                  echo "<script>alert('Notícia editada com sucesso!');
                  window.location.href = 'noticias.php';</script>";
                }
            }
            else{
                echo "Notícia não gravada";
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

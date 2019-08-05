<!DOCTYPE html>
<html lang="br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
  </head>
  <body>
<div class="container text-center">
  <fieldset>
    <legend>Visualizar Notícia</legend>
    <?php
    session_start();
    include_once "funcoes.php";
    include_once "cabecalho.inc";
    include_once "verificaLog.php";
    $conexao = conectar();
     ?>
     <div class="row">
       <div class="col-md-12">
         <?php
         if ($conexao) {
           $numeroNoticia = $_GET['noticia'];
           $query = "select noticia.idNoticia, noticia.titulo, noticia.descricao, noticia.status, noticia.data, autor.nomeAutor from noticia inner join autor on noticia.idAutor = autor.idAutor where noticia.idNoticia = '$numeroNoticia'";
           $resultado = mysqli_query($conexao, $query);
           while ($dados = mysqli_fetch_array($resultado)) {
             $id = $dados['idNoticia'];
             $titulo = $dados['titulo'];
             $descricao = $dados['descricao'];
             $status = $dados['status'];
             $data = $dados['data'];
             $nome = $dados['nomeAutor'];

             echo "<h1>$titulo</h1><br />";
             echo "Cód: $id <br />";
             echo "Data: $data<hr /><br />";
             echo "$descricao<br /><hr />";
             echo "$nome<br /><br />";
           }
         }
          ?>
          <a href="noticias.php">Voltar</a>
       </div>
     </div>
  </fieldset>
</div>
  </body>
</html>

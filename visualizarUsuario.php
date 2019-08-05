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
    <legend>Visualizar Usuário</legend>
    <?php
    session_start();
    include_once "funcoes.php";
    include_once "cabecalho.inc";
    include_once "verificaLog.php";
    $conexao = conectar();
     ?>
     <div class="row">
       <div class="col-md-3">
         <img src="imagens/logo.png" width="86" height="62">
       </div>
       <div class="col-md-9">
         <?php
         if ($conexao) {
           $numeroAutor = $_GET['numero'];
           $query = "select autor.idAutor, autor.nomeAutor, autor.tipo, DATE_FORMAT(autor.dataNascimento, '%d-%m-%Y') as dataNascimento, DATE_FORMAT(autor.dataCadastro, '%d-%m-%Y') as dataCadastro, autor.descricao, autor.email, autor.senha, autor.foto, COUNT(noticia.idAutor) as 'publicacoes' from autor INNER JOIN noticia ON autor.idAutor = noticia.idAutor where autor.idAutor = '$numeroAutor'";
           $resultado = mysqli_query($conexao, $query);

           echo "<table class='tabelaListarUsuarios' border = '1'><th>Código</th><th>Nome</th><th>Email</th><th>Data de Nasc.</th>";
           while ($dados = mysqli_fetch_array($resultado)) {
             $id = $dados['idAutor'];
             $nome = $dados['nomeAutor'];
             $email = $dados['email'];
             $dataNasc = $dados['dataNascimento'];
             $descricao = $dados['descricao'];
             $tipo = $dados['tipo'];
             $dataCadastro = $dados['dataCadastro'];
             $nroNoticias = $dados['publicacoes'];
             echo "<tr>
             <td>$id</td><td>$nome</td><td>$email</td><td>$dataNasc</td>
             </tr></table><br /><br />";?></div>
             <div class="col-md-12"><?php
                          echo "Descricao: $descricao <br />";
                          echo "Usuário do tipo: $tipo <br />";
                          echo "Usário desde: $dataCadastro <br />";
                          echo "Total de notícias publicadas: $nroNoticias";


             ?><br /><br /><button>Imprimir</button></div><?php
           }
         }
          ?>
       </div>
     </div>
  </fieldset>
</div>
  </body>
</html>

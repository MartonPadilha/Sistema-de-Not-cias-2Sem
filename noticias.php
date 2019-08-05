<!DOCTYPE html>
<html lang="br" dir="ltr">
  <head>
    <?php     session_start();
    include "funcoes.php";
    include_once "verificaLog.php";
 ?>
    <meta charset="utf-8">
    <title>Notícias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="estilo.css">
  </head>
  <body>
    <div class="container text-center">
      <fieldset>
        <legend>Visualizar Notícias</legend>
        <?php include "cabecalho.inc";  ?>
        <div class="row">
          <div class="col-sm-12 tabelaUsuarios text-center">
            <?php
            $conexao = conectar();
            $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

            function getTotal($conexao, $tabela){
                $query =  "select count(*) from $tabela";
                if ($resultado = mysqli_query($conexao, $query)) {
                    $resultado = mysqli_fetch_row($resultado);
                    return $resultado[0];
                        }
                      return 0;
                  }

            if ($conexao) {
                mysqli_set_charset($conexao, 'utf8');

                // PASSO 1
                $total = getTotal($conexao, "autor");

                // PASSO 2
                $qtdPorPagina = 8;

                //PASSO 3
                $paginas = ceil($total / $qtdPorPagina);


                //PASSO 4
                //verificar se a página foi passada como parâmetro; Se não for, o valor deve ser 1. Podem fazer outras validações.
                if (isset($_GET['pagina'])) {
                    $paginaAtual = $_GET['pagina'];
                }
                else{
                    $paginaAtual = 1;
                }

                //PASSO 5
                $inicio = ($qtdPorPagina * $paginaAtual) - $qtdPorPagina;
                //(quantidade de registros por pagina x pagina atual) - quantidade de registros por página

              $query = "select noticia.idNoticia, noticia.titulo, noticia.descricao, noticia.status, autor.nomeAutor, noticia.idAutor from noticia inner join autor on noticia.idAutor = autor.idAutor where noticia.status = 1 limit $inicio, $qtdPorPagina";
              $resultado = mysqli_query($conexao, $query);
              if ($resultado) {
                echo "<table class='tabelaListarUsuarios' border='1'>
                <tr><th>Número</th><th>Título</th><th>Ações</th></tr>";
                while ($dados = mysqli_fetch_array($resultado)) {
                  $numero = $dados['idNoticia'];
                  $idAutor = $dados['idAutor'];
                  $titulo = $dados['titulo'];
                  $idLogado = $_SESSION['idLogado'];
                  $tipoLogado = $_SESSION['tipoLogado'];
                  echo "<tr><td>$numero</td><td>$titulo</td><td><a href='visualizarNoticia.php?noticia=$numero'>Visualizar</a> - ";
                  if ($tipoLogado == "Autor") {
                      if ($idAutor == $idLogado) {
                           echo "<a href='editarNoticia.php?noticia=$numero'>Editar</a> - <a href='apagarNoticia.php?noticia=$numero'>Apagar</a></td></tr><br />";
                      }
                      else {
                          echo "<a>Editar</a> - <a>Apagar</a></td></tr><br />";
                      }
                  }

                  if($tipoLogado == "Administrador") {
                      echo "<a href='editarNoticia.php?noticia=$numero'>Editar</a> - <a href='apagarNoticia.php?noticia=$numero'>Apagar</a></td></tr><br />";
                  }





                  }
                  echo "</table>";
              }
            }
             ?>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 paginacao"><?php
                            echo "<a href='noticias.php?pagina=1'>Primeira</a> ";
                if ($paginaAtual > 1)
                    echo " <a href='noticias.php?pagina=" . ($paginaAtual - 1) . "'>Anterior</a> ";

                $select = " <select id='selecao_lista' onchange=\"direcionar()\">";

                for ($x = 1; $x <= $paginas; $x++) {
                    if ($x != $paginaAtual)
                        $select .= "<option value='$x'>$x</option>";
                    else
                        $select .= "<option value='$x' selected >$x</option>";
                }
                $select .= "</select>";

                echo "Ir para página " . $select;

                if ($paginaAtual + 1 <= $paginas)
                    echo " <a href='noticias.php?pagina=" . ($paginaAtual + 1) . "'>Próxima</a> ";

                echo " <a href='noticias.php?pagina=$paginas'>Última</a> ";

                echo "<br>";


                ?>
                <script>
                   function direcionar(){
                        var x = document.getElementById("selecao_lista").selectedIndex + 1;
                        window.location = "noticias.php?pagina="+x;
                   }
                </script>

          </div>
        </div><br>
        <a href="cadastrarNoticia.php">Cadastrar Notícia</a>
      </fieldset>
    </div>
  </body>
</html>

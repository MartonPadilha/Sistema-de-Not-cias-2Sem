<!DOCTYPE html>
<html lang="br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cadastrar Notícia</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
    <script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
  </head>
  <body>
    <div class="container text-center">
      <fieldset>
        <legend>Cadastrar Notícia</legend>
        <?php
        session_start();
        include_once "funcoes.php";
        include_once "cabecalho.inc";
        include_once "verificaLog.php";
        $conexao = conectar();
        $nome = $_SESSION['autorLogado'];
         ?>
         <div class="row">
             <form class="cadastro" action="cadastrarNoticia.php" method="post" enctype="multipart/form-data">
                <div class="form-row">
                  <div class="form-group col-sm-6">
                    <label for="tituloid">Título *</label>
                    <input type="text" name="titulo" class="form-control" id="tituloid" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group">
                      <label for="exampleFormControlSelect1">Autor *</label>
                      <select name="autor" class="form-control" id="exampleFormControlSelect1" required>
                        <?php
                        if ($conexao) {
                          if ($_SESSION['tipoLogado'] == "Administrador") {
                            $query = "select idAutor, nomeAutor from autor";
                            $resultado = mysqli_query($conexao, $query);
                            while ($dados = mysqli_fetch_array($resultado)) {
                              $nome = $dados['nomeAutor'];
                              $id = $dados['idAutor'];?>
                              <option value="<?php echo $id; ?>"><?php echo $nome; ?></option>

                              <?php
                            }
                          }else {
                             echo "<option value='$id'>$nome</option>";
                          }
                        }
                         ?>
                      </select>
                    </div>
                  </div><br>

                      <label for="descricaoid">Descrição *</label><br>
                      <textarea type="text" name="descricao" class="ckeditor" id="ckeditor" required>

                      </textarea><br>

                      <label for="fotoid">Foto</label>
                      <input type="file" class="form-control" name="foto" id="fotoid" value="Escolher"><br>

                      <button type="submit" class="btn btn-success">Cadastrar</button>
            </form>
           </div>
          </fieldset>
         </div>
  </body>
</html>

<?php
if (!empty($_POST['titulo']) and !empty($_POST['autor']) and !empty($_POST['descricao'])) {
  if ($conexao) {
    $titulo = $_POST['titulo'];
    $idAutor = $_POST['autor'];
    $status = 1;
    $descricao = $_POST['descricao'];
    $data = date("Y-m-d");
    $query = "insert into noticia (titulo, descricao, status, data, idAutor) values (?, ?, ?, ?, ?)";
    $query_tratada = mysqli_prepare($conexao, $query);
    if ($query_tratada) {
      mysqli_stmt_bind_param($query_tratada, "ssisi", $titulo, $descricao, $status , $data, $idAutor);
      if (mysqli_stmt_execute($query_tratada)) {
        if (mysqli_stmt_affected_rows($query_tratada) > 0) {
          echo "<script>alert('Notícia salva com sucesso!');
          window.location.href = 'noticias.php';</script>";
              }
              else {
                echo "Falha ao gravar";
              }
              mysqli_stmt_close($query_tratada);
              mysqli_close($conexao);
      }
    }
  }
}

 ?>

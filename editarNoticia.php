<?php
session_start();
include_once "funcoes.php";
include_once "verificaLog.php";
$conexao = conectar();

if ($conexao) {
  $numeroNoticia = $_GET['noticia'];
  $query = "select autor.idAutor, noticia.titulo, autor.nomeAutor, noticia.descricao, autor.foto from autor inner join noticia on autor.idAutor = noticia.idAutor WHERE noticia.idNoticia = '$numeroNoticia'";
  $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);
    $titulo = $dados['titulo'];
    $nome = $dados['nomeAutor'];
    $descricao = $dados['descricao'];
    $foto = $dados['descricao'];
    $id = $dados['idAutor'];
}
 ?>
 <!DOCTYPE html>
 <html lang="br" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Editar Notícia</title>
     <link rel="stylesheet" href="estilo.css">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
     <script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
   </head>
   <body>
     <div class="container text-center">
       <fieldset>
         <legend>Editar Notícia</legend>
         <?php
         include_once "cabecalho.inc";
          ?>
          <div class="row">
              <form class="cadastro" action="salveEditNoticia.php" method="post" enctype="multipart/form-data">
                <label for="codigoid">Código: </label>
                <input type="text" class="text-center" name="codigo" value="<?php echo $numeroNoticia; ?>" readonly="readonly"><br><br>
                 <div class="form-row">
                   <div class="form-group col-sm-6">
                     <label for="tituloid">Título *</label>
                     <input type="text" name="titulo" class="form-control" id="tituloid" value="<?php echo $titulo; ?>">
                   </div>
                 </div>

                 <div class="form-row">
                   <div class="form-group">
                       <label for="exampleFormControlSelect1">Autor *</label>
                       <select name="autor" class="form-control" id="exampleFormControlSelect1" value="<?php echo $nome; ?>">
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
                           }else {?><option value="<?php echo $id; ?>"><?php echo $nome; ?></option><?php
                           }
                         }
                          ?>
                       </select>
                     </div>
                   </div><br>

                       <label for="descricaoid">Descrição *</label><br>
                       <textarea type="text" name="descricao" class="ckeditor" id="ckeditor" >
                        <?php echo $descricao;?>
                       </textarea><br>

                       <label for="fotoid">Foto</label>
                       <input type="file" class="form-control" name="foto" id="fotoid" value="<?php echo $foto; ?>"><br>

                       <button type="submit" class="btn btn-success">Editar</button>
             </form>
            </div>
           </fieldset>
          </div>
   </body>
 </html>

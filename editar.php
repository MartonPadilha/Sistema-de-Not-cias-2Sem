<?php
session_start();
include_once "funcoes.php";
include_once "cabecalho.inc";
include_once "verificaLog.php";
$conexao = conectar();

if ($conexao) {
  $numeroAutor = $_GET['usuario'];
  $query = "select idAutor, nomeAutor, tipo, dataNascimento, DATE_FORMAT(dataCadastro, '%d-%m-%Y') as dataCadastro, descricao, email, senha, foto, noticias from autor where idAutor = '$numeroAutor'";
  $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);
    $id = $dados['idAutor'];
    $nome = $dados['nomeAutor'];
    $email = $dados['email'];
    $senha = $dados['senha'];
    $dataNasc = $dados['dataNascimento'];
    $descricao = $dados['descricao'];
    $tipo = $dados['tipo'];
    $dataCadastro = $dados['dataCadastro'];
    $nroNoticias = $dados['noticias'];?><?php
}
 ?>
<!DOCTYPE html>
<html lang="br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Editar</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
    <script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
  </head>
  <body>
    <div class="container text-center">
      <fieldset>
        <legend>Editar Usuário</legend>
         <div class="row">
             <form class="cadastro" action="salveEdit.php" method="post">
               <label for="codigoid">Código: </label>
               <input type="text" class="text-center" name="codigo" value="<?php echo $numeroAutor; ?>" readonly="readonly"><br><br>
                <div class="form-row">
                  <div class="form-group col-sm-6">
                    <label for="nomeid">Nome Completo *</label>
                    <input value = "<?php echo $nome;?>" type="text" name="nome" class="form-control" id="nomeid" required>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="dataNascid">Data de Nascimento *</label>
                    <input value = "<?php echo $dataNasc;?>" type="date" name="dataNasc" class="form-control" id="dataNascid" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-sm-6">
                    <label for="emailid">Email *</label>
                    <input value = "<?php echo $email;?>" type="email" name="email" class="form-control" id="emailid" required>
                  </div>
                  <div class="form-group col-sm-3">
                    <label for="senhaid">Senha *</label>
                    <input value = "<?php echo $senha;?>" type="password" name="senha" class="form-control" id="senhaid" required>
                  </div><br>

                      <div class="form-row text-center">
                          <div class="form-group col-sm-12">
                            <label for="">Tipo de Usuário *</label><br>
                          </div>
                      <div class="form-group col-sm-6">
                        Administrador<input type="radio" class="form-control" name="tipoUsuario" id="tipoUsuarioid" value="Administrador" <?php if($tipo == "Administrador"){echo "checked=\'checked\'";}if ($tipo == "Autor"){echo "style='display: none;'";} ?>>
                      </div>
                      <div class="form-group col-sm-6">
                        Autor<input type="radio" class="form-control" name="tipoUsuario" id="tipoUsuarioid" value="Autor" <?php if($tipo == "Autor"){echo "checked=\'checked\'";} ?>>
                      </div>
                    </div>
                       </div><br>


                      <label for="descricaoid">Descrição *</label><br>
                      <textarea type="text" name="descricao" class="ckeditor" id="ckeditor" required>
                        <?php echo $descricao;?>
                      </textarea><br>

                      <label for="fotoid">Foto</label>
                      <input type="file" class="form-control" id="fotoid" value="Escolher"><br>

                      <button type="submit" class="btn btn-success">Salvar</button>

            </form>
           </div>
          </fieldset>
         </div>
  </body>
</html>

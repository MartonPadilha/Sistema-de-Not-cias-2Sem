<!DOCTYPE html>
<html lang="br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
    <script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
  </head>
  <body>
    <div class="container text-center">
      <fieldset>
        <legend>Cadastrar Usuário</legend>
        <?php
        session_start();
        include_once "funcoes.php";
        include_once "cabecalho.inc";
        include_once "verificaLog.php";
         ?>
         <div class="row">
             <form class="cadastro" action="cadastroUsuario.php" method="post" enctype="multipart/form-data">
                <div class="form-row">
                  <div class="form-group col-sm-6">
                    <label for="nomeid">Nome Completo *</label>
                    <input type="text" name="nome" class="form-control" id="nomeid" required>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="dataNascid">Data de Nascimento *</label>
                    <input type="date" name="dataNasc" class="form-control" id="dataNascid" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-sm-6">
                    <label for="emailid">Email *</label>
                    <input type="email" name="email" class="form-control" id="emailid" required>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="senhaid">Senha *</label>
                    <input type="password" name="senha" class="form-control" id="senhaid" required>
                  </div><br>

                  <div class="form-row text-center">
                      <div class="form-group col-sm-12">
                        <label for="">Tipo de Usuário *</label><br>
                        </div>
                        <div class="form-group col-sm-6">
                          Administrador<input type="radio" class="form-control" name="tipoUsuario" id="tipoUsuarioid" value="Administrador">
                        </div>
                        <div class="form-group col-sm-6">
                          Autor<input type="radio" class="form-control" name="tipoUsuario" id="tipoUsuarioid" value="Autor">
                        </div>
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
if (!empty($_POST['nome']) and !empty($_POST['email']) and !empty($_POST['senha'])) {

  $conexao = conectar();
  $nome = $_POST['nome'];
  $dataNasc = $_POST['dataNasc'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $tipoUsuario = $_POST['tipoUsuario'];
  $descricao = $_POST['descricao'];
  $dataCadastro = date("Y-m-d");
  $status = 1;

  if ($conexao) {
	      if (!empty($_POST['foto'])) {
	  	$extensao = strtolower(substr($_FILES['foto']['name'], -4));//pega a extensão do arquivo
	  	$novo_nome = md5(time()) . $extensao;//define o nome do arquivo
	  	$diretorio = "upload/"; //define o diretorio para onde sera enviado o arquivo
	  	move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio . $novo_nome); //efetua o upload
	  	$query = "Insert into autor (nomeAutor, tipo, dataNascimento, dataCadastro, descricao, email, senha, foto, status) values (?, ?, ?, ?, ?, ?, ?, ?)";
	  	$query_tratada = mysqli_prepare($conexao, $query);
	    if ($query_tratada) {
	      mysqli_stmt_bind_param($query_tratada,"sssssssi", $nome, $tipoUsuario, $dataNasc, $dataCadastro, $descricao, $email, $senha, $novo_nome,$status);
	      if (mysqli_stmt_execute($query_tratada)) {
	        if (mysqli_stmt_affected_rows($query_tratada) > 0) {
	          echo "<script>alert('Cadastro realizado com sucesso!')</script>";
	          header("location: listarUsuarios.php");
	        }else {
	          echo "<script>alert('Falha ao gravar cadastro')</script>";
	        }
	        mysqli_stmt_close($query_tratada);
	        mysqli_close($conexao);
	      }
	    }
	  }else{
		$query = "Insert into autor (nomeAutor, tipo, dataNascimento, dataCadastro, descricao, email, senha, status) values (?, ?, ?, ?, ?, ?, ?, ?)";
	    $query_tratada = mysqli_prepare($conexao, $query);
	    if ($query_tratada) {
	      mysqli_stmt_bind_param($query_tratada,"sssssssi", $nome, $tipoUsuario, $dataNasc, $dataCadastro, $descricao, $email, $senha, $status);
	      if (mysqli_stmt_execute($query_tratada)) {
	        if (mysqli_stmt_affected_rows($query_tratada) > 0) {
	          echo "<script>alert('Cadastro realizado com sucesso!');
            window.location.href = 'listarUsuarios.php';</script>";
	        }else {
	          echo "<script>alert('Falha ao gravar cadastro')</script>";
	        }
	        mysqli_stmt_close($query_tratada);
	        mysqli_close($conexao);
	      }
	    }
	  }
	}
   }



 ?>

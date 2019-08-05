<!DOCTYPE html>
<html lang="br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="estilo.css">
  </head>
  <body>
  <div class="container login">
    <fieldset>
      <legend>Login</legend>
      <div class="row">
        <div class="col-8">
          <form action="verifica.php" class="formlogin"method="post">
            E-mail *<br><input type="text" name="email" value=""><br><br>
            Senha * <br><input type="password" name="senha" value=""><br><br>
            <input type="submit" name="" value="Entrar no Sistema"><br>
            <?php if(isset($_GET['erro'])){
              if ($_GET['erro'] == 1) {
              echo "Usuário ou senha incorretos";
              }
            }
?>
          </form>
        </div>
        <div class="col-4">
          <img src="imagens/logo.png" width="100" height="85">
        </div>
      </div>
    </fieldset>
  </div>
  </body>
</html>
<?php  ?>

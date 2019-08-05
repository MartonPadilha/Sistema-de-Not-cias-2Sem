<!DOCTYPE html>
<html lang="br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <header>
        <div class="row">
            <div class="col-sm-12 menuSuperior">
              <div class="col-sm-6">
                <img src="imagens/logo.png" width="86" height="62">
              </div>
              <div class="col-sm-6">
                  <?php
                  // session_start();
                  echo $_SESSION['autorLogado'];?> -
                  <a href="logout.php">Sair do Sistema</a><br>
                  <a href="listarUsuarios.php">Usuários</a> - <a href="noticias.php">Notícias</a>
              </div>
            </div>
          </div>
        </header>
  </body>
</html>

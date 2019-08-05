<?php
function conectar(){
  $conexao = mysqli_connect("localhost", "root", "", "trabalhofinal");
  return $conexao;
}

function loginComEmailSenha($email, $senha, $conexao){
              $query = "select * from autor where email=? and senha=?";
              $query_tratada = mysqli_prepare($conexao, $query);
               if ($query_tratada) {
                            mysqli_stmt_bind_param($query_tratada, "ss", $email, $senha);
                            mysqli_stmt_execute($query_tratada) ;
                            mysqli_stmt_bind_result($query_tratada, $idAutor, $nomeAutor, $tipo, $dataNascimento, $dataCadastro, $descricao, $email, $senha, $foto, $noticias,$status);
                            mysqli_stmt_store_result($query_tratada);
                            if (mysqli_stmt_num_rows($query_tratada) > 0) {
                                mysqli_stmt_fetch($query_tratada);
                                session_start();
                                $_SESSION['idLogado'] = $idAutor;
                                $_SESSION['autorLogado'] = $nomeAutor;
                                $_SESSION['tipoLogado'] = $tipo;
                                $_SESSION['dataNascLogado'] = $dataNascimento;
                                $_SESSION['dataCadastro'] = $dataCadastro;
                                $_SESSION['descricaoLogado'] = $descricao;
                                $_SESSION['emailLogado'] = $email;
                                $_SESSION['senhaLogado'] = $senha;
                                $_SESSION['fotoLogado'] = $foto;
                                $_SESSION['noticiasLogado'] = $noticias;
                                $_SESSION['statusLogado'] = $status;
                                mysqli_stmt_close($query_tratada);
                                mysqli_close($conexao);
                                header("location: listarUsuarios.php");

                                return true;

                        }

               }
               mysqli_close($conexao);
               header("location: login.php?erro=1");
               return false;
}

function geraSenha($limit){
  $alfanumericos = "sa1d561asd1as51dd1qwdq8d15as8q1vb1w8r1b8ymyu8m1m1g1s8a1c3z8qwqd1q1zc8qcq8c1xcbwbeamue78uo";

  $maximo = strlen($alfanumericos)-1;

  $senha = ' ';

  for ($i = 0; $i < $limit; $i++) :
    $senha .= $alfanumericos(mt_rand(0, $maximo));
endfor;
  return $senha;
}

 ?>

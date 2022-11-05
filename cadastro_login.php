<?php
  require "config.php";

  $nome = filter_input(INPUT_POST, 'nome');
  $email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
  $senha = filter_input(INPUT_POST, 'senha');
  $confirmar_senha = filter_input(INPUT_POST, 'confirmar_senha');

  if($nome && $email && $senha && $confirmar_senha) {
    $sql = $pdo->prepare("select * from tbl_usuario where email = :email");
    $sql->bindValue(':email', $email);
    $sql->execute();
  

  if($sql->rowCount() === 0) {
    //
    if($senha === $confirmar_senha) {

        $password_hash = password_hash($senha, PASSWORD_DEFAULT);
         
          $sql = $pdo->prepare("INSERT INTO tbl_usuario(nome,email,senha) VALUES(:nome,:email,:senha)" );
          $sql->bindValue(':nome', $nome);
          $sql->bindValue(':email', $email);
          $sql->bindValue(':senha', $password_hash);
          $sql->execute();

            header("Location: login.php");
            exit;
      } else {
            header("Location: cadastro_usuario.php");
            exit;
    }
      } else {
        header("Location: cadastro_usuario.php");
        exit;
  }
  } else {
    header("Location: cadastro_usuario.php");
    exit;
}
    


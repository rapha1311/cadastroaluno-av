<?php
    require 'config.php';

    $id = filter_input(INPUT_POST, 'id');
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email');  // filtra todos as novas informações no formulário e atribui às variáveis.
    $idade = filter_input(INPUT_POST, 'idade');
    $contato = filter_input(INPUT_POST, 'contato');
    $endereco = filter_input(INPUT_POST, 'endereco');

    if($id && $name && $email && $idade && $contato && $endereco) {  //Irá checar se todos os valores existem.

        $sql = $pdo->prepare("UPDATE tbl_aluno SET nome =:name, email = :email, idade = :idade, contato = :contato, endereco = :endereco WHERE id= :id");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':idade', $idade);          //Atualiza o banco de dados com as novas infromações.
        $sql->bindValue(':contato', $contato);
        $sql->bindValue(':endereco', $endereco);
        $sql->execute();

        header("Location: index.php");
        exit;

    } else {
        header("Location: edit.php");
        exit;
    }

?>
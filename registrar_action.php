<?php
    require 'config.php';

    $nome = filter_input(INPUT_POST, 'nome');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);  //Filtrar informações enviados ao formulário.
    $idade = filter_input(INPUT_POST, 'idade');
    $contato = filter_input(INPUT_POST, 'contato');
    $endereco = filter_input(INPUT_POST, 'endereço');

    if($nome && $email && $idade && $contato && $endereco) {  //Checar se todos os valores são existentes.

        $sql = $pdo->prepare("INSERT INTO tbl_aluno (nome, email, idade, contato, endereço) VALUES (:name, :email, :idade, :contato, :endereço)");
        $sql->bindValue(':name', $name);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':idade', $idade);            //Inserir dados na tabela de alunos.
        $sql->bindValue(':contato', $contato);
        $sql->bindValue(':endereço', $endereco);
        $sql->execute();

        header("Location: index.php");
        exit;

    } else {
        header("Location: registrar_aluno.php");
        exit;
    }

?>
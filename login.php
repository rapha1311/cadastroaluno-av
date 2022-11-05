<?php
    session_start();
    ob_start(); //limpa o buffer de saída. Usado no redirecionamento.
    require 'head.php';
    require 'config.php';
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    //var_dump($dados);
    if(!empty($dados['Logar'])) {

        $sql = $pdo->prepare("SELECT * FROM tbl_usuario WHERE email = :email");
        $sql->bindParam(':email', $dados['email'], PDO::PARAM_STR); //PDO::PARAM_STR só aceitará string para passar para banco.
        $sql->execute();
       
        if(($sql) && ($sql->rowCount() != 0)) {
            $resultado = $sql->fetch(PDO::FETCH_ASSOC);
            var_dump($resultado);
            //Verifica se tem algum email e conta a quantidade de linhas achadas deste email.
            if(password_verify($dados['senha'], $resultado['senha'])) {
                
                $_SESSION['id'] = $resultado['id'];
                $_SESSION['nome'] = $resultado['nome'];
                header('Location: registrar_aluno.php');
                exit;

            } else {
                $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário ou senha inválidos!</p>";
            }
        } else {
            $_SESSION['msg'] = "<p style='color: #ff0000'>Erro: Usuário ou senha inválidos!</p>";
        }

        if(isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            //Destrói a mensagem para não imprimir na tela novamente
            unset($_SESSION['msg']);
        }

    } else {
        $_SESSION['msg'] = "erro";
    }
?>

<body>
    <div class="container">

        <div>
            <h1> Login </h1>
        </div>

        <form action="" method="post">

            <label for="">
                E-mail: <br/>
                <input type="email" name="email" class="form-control" value="<?php if(isset($dados['email'])){ echo $dados['email']; } ?>">
            </label><br/><br/>

            <label for="">
                Senha: <br/>
                <input type="password" name="senha" class="form-control">
            </label><br/><br/>

            <input type="submit" value="Logar" name="Logar" class="btn btn-primary"><br/><br/>

            <h4> Não tem uma conta? Crie a sua agora mesmo! </h4>
            <a href="./cadastro_login.php" class="btn btn-success"> Criar uma conta</a>
        </form>

    </div>
</body>
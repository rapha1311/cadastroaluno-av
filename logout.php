<?php
session_start();
ob_start();
unset($_SESSION['id'], $_SESSION['nome']);

$_SESSION['msg'] = "<p style='color: red'>Deslogado com sucesso!</p>";

header("Location: home.php");
exit;
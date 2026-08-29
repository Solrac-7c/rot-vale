<?php

    session_start();

    require_once("../config/conexao.php");

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: index.php");
        exit;
    }

    $nome = trim($_POST["nome"] ?? "");
    $usuario = trim($_POST["usuario"] ?? "");
    $senha = $_POST["senha"] ?? "";
    $confirmarSenha = $_POST["confirmar_senha"] ?? "";

    if ($nome === "" || $usuario === "" || $senha === "" ||         $confirmarSenha === "") {
        header("Location: index.php?mensagem=erro");
            exit;
    }

    if ($senha !== $confirmarSenha) {
        header("Location: index.php?mensagem=senha_diferente");
            exit;
    }

// Verifica se o usuário já existe
    $sql = "SELECT id
            FROM usuarios
            WHERE usuario = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Erro ao preparar consulta: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s", $usuario);

    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) > 0) {
        header("Location: index.php?mensagem=usuario_existente");
        exit;
    }

// Gera o hash da senha
    $hash = password_hash($senha, PASSWORD_DEFAULT);

// Cadastra o usuário
    $sql = "INSERT INTO usuarios (nome, usuario, senha)
        VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Erro ao preparar cadastro: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param(
        $stmt,
        "sss",
        $nome,
        $usuario,
        $hash
    );

    if (!mysqli_stmt_execute($stmt)) {
        header("Location: index.php?mensagem=erro");
        exit;
    }

// ID do usuário recém-cadastrado
    $idUsuario = mysqli_insert_id($conn);

// Cria a sessão automaticamente
    session_regenerate_id(true);

    $_SESSION["usuario_id"] = $idUsuario;
    $_SESSION["usuario_nome"] = $nome;
    $_SESSION["usuario_usuario"] = $usuario;

// Redireciona para a página principal
    header("Location: ../index.php");
        exit;
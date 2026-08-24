<?php

session_start();

require_once("../config/conexao.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$usuario = trim($_POST["usuario"] ?? "");
$senha = $_POST["senha"] ?? "";

if ($usuario === "" || $senha === "") {
    header("Location: index.php?erro=1");
    exit;
}

$sql = "SELECT id, nome, usuario, senha
        FROM usuarios
        WHERE usuario = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $usuario);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) !== 1) {
    header("Location: index.php?erro=1");
    exit;
}

$usuarioBanco = mysqli_fetch_assoc($resultado);

if (!password_verify($senha, $usuarioBanco["senha"])) {
    header("Location: index.php?erro=1");
    exit;
}

session_regenerate_id(true);

$_SESSION["usuario_id"] = $usuarioBanco["id"];
$_SESSION["usuario_nome"] = $usuarioBanco["nome"];
$_SESSION["usuario_usuario"] = $usuarioBanco["usuario"];

header("Location: ../index.php");
exit;

?>
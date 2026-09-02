<?php

session_start();

require_once("../includes/auth.php");
require_once("../config/conexao.php");

if (isset($_POST["enviar"])) {

    $especie = trim($_POST["especie"] ?? "");

    $erros = [];

    if (empty($especie)) {
        $erros[] = "Preencha o nome da espécie";
    }

    if (count($erros) > 0) {

        foreach ($erros as $erro) {
            echo $erro . "<br>";
        }

        echo '<br><a href="index.php">Voltar</a>';

        exit;
    }

    $sql = "INSERT INTO especies (especie)
            VALUES (?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $especie
    );

    if (mysqli_stmt_execute($stmt)) {

        $_SESSION["msg"] = "Espécie cadastrada com sucesso.";
        $_SESSION["class"] = "alert alert-success";

    } else {

        $_SESSION["msg"] = "Houve um erro ao cadastrar a espécie.";
        $_SESSION["class"] = "alert alert-danger";

    }

    mysqli_stmt_close($stmt);

    mysqli_close($conn);

    header("Location: mostrar.php");
    exit;
}

if (isset($_POST["alterar"])) {

    $id = $_POST["id"] ?? "";
    $especie = trim($_POST["especie"] ?? "");

    $erros = [];

    if (empty($id)) {
        $erros[] = "ID da espécie não informado";
    }

    if (empty($especie)) {
        $erros[] = "Preencha o nome da espécie";
    }

    if (count($erros) > 0) {

        foreach ($erros as $erro) {
            echo $erro . "<br>";
        }

        echo '<br><a href="mostrar.php">Voltar</a>';

        exit;
    }

    $sql = "UPDATE especies
            SET especie = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "si",
        $especie,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {

        if (mysqli_stmt_affected_rows($stmt) == 1) {

            $_SESSION["msg"] = "Espécie alterada com sucesso.";
            $_SESSION["class"] = "alert alert-success";

        } else {

            $_SESSION["msg"] = "Nenhuma alteração foi realizada.";
            $_SESSION["class"] = "alert alert-warning";

        }

    } else {

        $_SESSION["msg"] = "Houve um erro ao alterar a espécie.";
        $_SESSION["class"] = "alert alert-danger";

    }

    mysqli_stmt_close($stmt);

    mysqli_close($conn);

    header("Location: mostrar.php");
    exit;
}

header("Location: index.php");
exit;
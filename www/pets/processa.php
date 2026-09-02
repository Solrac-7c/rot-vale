<?php

require_once("../includes/auth.php");
require_once("../config/conexao.php");

// CADASTRO

if (isset($_POST["enviar"])) {

    $nome = trim($_POST["nome"] ?? "");
    $nascimento = $_POST["nascimento"] ?? "";
    $especie_id = $_POST["especie_id"] ?? "";
    $prontuario = trim($_POST["prontuario"] ?? "");
    $genero = $_POST["genero"] ?? "";

    $erros = [];


    if ($nome === "") {
        $erros[] = "Preencha o nome do pet.";
    }

    if ($nascimento === "") {
        $erros[] = "Preencha a data de nascimento.";
    }

    if ($especie_id === "" || !is_numeric($especie_id)) {
        $erros[] = "Selecione uma espécie.";
    }

    if ($prontuario === "") {
        $erros[] = "Preencha o prontuário.";
    }

    if ($genero !== "Macho" && $genero !== "Fêmea") {
        $erros[] = "Selecione o gênero.";
    }


    if (count($erros) > 0) {

        foreach ($erros as $erro) {
            echo htmlspecialchars($erro) . "<br>";
        }

        echo '<br><a href="index.php">Voltar</a>';

        exit;
    }


    $sql = "INSERT INTO pets
            (nome, nascimento, especie_id, prontuario, genero)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Erro ao preparar cadastro: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param(
        $stmt,
        "ssiss",
        $nome,
        $nascimento,
        $especie_id,
        $prontuario,
        $genero
    );


    if (mysqli_stmt_execute($stmt)) {

        $_SESSION["msg"] = "Pet cadastrado com sucesso.";
        $_SESSION["class"] = "alert alert-success";

    } else {

        $_SESSION["msg"] = "Houve um erro ao cadastrar o pet.";
        $_SESSION["class"] = "alert alert-danger";

    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: mostrar.php");
    exit;
}

// ALTERAÇÃO

if (isset($_POST["alterar"])) {

    $id = $_POST["id"] ?? "";
    $nome = trim($_POST["nome"] ?? "");
    $nascimento = $_POST["nascimento"] ?? "";
    $especie_id = $_POST["especie_id"] ?? "";
    $prontuario = trim($_POST["prontuario"] ?? "");
    $genero = $_POST["genero"] ?? "";

    $erros = [];


    if (!is_numeric($id) || $id <= 0) {
        $erros[] = "ID do pet inválido.";
    }

    if ($nome === "") {
        $erros[] = "Preencha o nome do pet.";
    }

    if ($nascimento === "") {
        $erros[] = "Preencha a data de nascimento.";
    }

    if ($especie_id === "" || !is_numeric($especie_id)) {
        $erros[] = "Selecione uma espécie.";
    }

    if ($prontuario === "") {
        $erros[] = "Preencha o prontuário.";
    }

    if ($genero !== "Macho" && $genero !== "Fêmea") {
        $erros[] = "Selecione o gênero.";
    }


    if (count($erros) > 0) {

        foreach ($erros as $erro) {
            echo htmlspecialchars($erro) . "<br>";
        }

        echo '<br><a href="mostrar.php">Voltar</a>';

        exit;
    }

    $sql = "UPDATE pets
            SET nome = ?,
                nascimento = ?,
                especie_id = ?,
                prontuario = ?,
                genero = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Erro ao preparar alteração: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param(
        $stmt,
        "ssissi",
        $nome,
        $nascimento,
        $especie_id,
        $prontuario,
        $genero,
        $id
    );


    if (mysqli_stmt_execute($stmt)) {

        if (mysqli_stmt_affected_rows($stmt) > 0) {

            $_SESSION["msg"] = "Pet alterado com sucesso.";
            $_SESSION["class"] = "alert alert-success";

        } else {

            $_SESSION["msg"] = "Nenhuma alteração foi realizada.";
            $_SESSION["class"] = "alert alert-warning";

        }

    } else {

        $_SESSION["msg"] = "Houve um erro ao alterar o pet.";
        $_SESSION["class"] = "alert alert-danger";

    }


    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: mostrar.php");
    exit;
}


header("Location: index.php");
exit;
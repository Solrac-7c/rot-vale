<?php

require_once("../includes/auth.php");
require_once("../config/conexao.php");

$id = $_GET["id"] ?? "";

if (empty($id)) {

    $_SESSION["msg"] = "ID da espécie não informado.";
    $_SESSION["class"] = "alert alert-danger";

    header("Location: mostrar.php");
    exit;

}

$sql = "DELETE FROM especies WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

if (mysqli_stmt_execute($stmt)) {

    if (mysqli_stmt_affected_rows($stmt) == 1) {

        $_SESSION["msg"] = "Espécie foi excluída com sucesso.";
        $_SESSION["class"] = "alert alert-success";

    } else {

        $_SESSION["msg"] = "Houve um erro ao excluir a espécie. Verifique se o ID existe.";
        $_SESSION["class"] = "alert alert-danger";

    }

} else {

    $_SESSION["msg"] = "Houve um erro ao excluir a espécie.";
    $_SESSION["class"] = "alert alert-danger";

}

mysqli_stmt_close($stmt);

mysqli_close($conn);

header("Location: mostrar.php");
exit;
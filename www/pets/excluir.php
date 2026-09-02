<?php

require_once("../includes/auth.php");
require_once("../config/conexao.php");

$id = $_GET["id"] ?? "";

if (!is_numeric($id) || $id <= 0) {

    $_SESSION["msg"] = "ID do pet inválido.";
    $_SESSION["class"] = "alert alert-danger";

    header("Location: mostrar.php");
    exit;
}


$sql = "DELETE FROM pets
        WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {

    $_SESSION["msg"] = "Houve um erro ao preparar a exclusão.";
    $_SESSION["class"] = "alert alert-danger";

    header("Location: mostrar.php");
    exit;
}


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);


if (mysqli_stmt_execute($stmt)) {

    if (mysqli_stmt_affected_rows($stmt) === 1) {

        $_SESSION["msg"] = "Pet foi excluído com sucesso.";
        $_SESSION["class"] = "alert alert-success";

    } else {

        $_SESSION["msg"] =
            "Houve um erro ao excluir o pet. Verifique se o ID existe.";

        $_SESSION["class"] = "alert alert-danger";
    }

} else {

    $_SESSION["msg"] = "Houve um erro ao excluir o pet.";
    $_SESSION["class"] = "alert alert-danger";
}


mysqli_stmt_close($stmt);
mysqli_close($conn);

header("Location: mostrar.php");
exit;
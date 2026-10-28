<?php

require_once __DIR__ . "/../includes/auth.php";
require_once __DIR__ . "/../config/conexao.php";

//LÓGICA UPLOAD DE FOTO/IMAGEM

function receberFotoPet(): ?string
{
    if (!isset($_FILES["foto"]) || $_FILES["foto"]["error"] === UPLOAD_ERR_NO_FILE
    ) {
        return null;
    }

    $arquivo = $_FILES["foto"];

    if ($arquivo["error"] !== UPLOAD_ERR_OK) {
        throw new RuntimeException(
            "O envio da imagem falhou. Verifique o arquivo."
        );
    }

    $limite = 2 * 1024 * 1024;

    if ($arquivo["size"] > $limite) {
        throw new RuntimeException("A imagem deve ter no máximo 2 MB.");
    }

    $temporario = $arquivo["tmp_name"];

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($temporario);

    $tiposPermitidos = [
        "image/jpeg" => "jpg",
        "image/png"  => "png",
        "image/webp" => "webp"
    ];

    if (!isset($tiposPermitidos[$mime]) || @getimagesize($temporario) === false
    ) {
        throw new RuntimeException("Envie uma imagem JPG, PNG ou WEBP válida.");
    }

    $pasta = __DIR__ . "/../uploads/pets";

    if (!is_dir($pasta) && !mkdir($pasta, 0755, true) && !is_dir($pasta)
    ) {
        throw new RuntimeException("Não foi possível preparar a pasta de fotos.");
    }

    $nomeArquivo =bin2hex(random_bytes(16)) . "." . $tiposPermitidos[$mime];

    $destino = $pasta . "/" . $nomeArquivo;

    if (!move_uploaded_file($temporario,$destino)
    ){
        throw new RuntimeException("Não foi possível salvar a imagem no servidor.");
    }

    return "/uploads/pets/" . $nomeArquivo;
}


function apagarFotoPet(?string $caminhoPublico): void
{
    if ($caminhoPublico === null || !str_starts_with($caminhoPublico, "/uploads/pets/")
    ) {
        return;
    }

    $nomeArquivo = basename($caminhoPublico);

    $arquivo = __DIR__. "/../uploads/pets/" . $nomeArquivo;

    if (is_file($arquivo)) {
        unlink($arquivo);
    }
}

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

    try {
        $foto = receberFotoPet();
    } 
    catch (RuntimeException $e) {
        echo htmlspecialchars(
            $e->getMessage(),
            ENT_QUOTES,
            "UTF-8"
    );

    echo '<br><a href="index.php">Voltar ao cadastro</a>';

    exit;
}


    $sql = "INSERT INTO pets
        (nome, nascimento, especie_id, prontuario, genero, foto)
        VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Erro ao preparar cadastro: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param(
        $stmt,
        "ssisss",
        $nome,
        $nascimento,
        $especie_id,
        $prontuario,
        $genero,
        $foto
    );


    if (mysqli_stmt_execute($stmt)) {

        $_SESSION["msg"] = "Pet cadastrado com sucesso.";
        $_SESSION["class"] = "alert alert-success";

    } else {
        
        if ($foto !== null) {
            apagarFotoPet($foto);
        }
        
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
    
    $sqlFotoAntiga = "SELECT foto FROM pets WHERE id = ?";

    $stmtFotoAntiga = mysqli_prepare($conn, $sqlFotoAntiga);

    if (!$stmtFotoAntiga) {
        die("Erro ao consultar a foto do pet.");
    }

    mysqli_stmt_bind_param(
        $stmtFotoAntiga,
        "i",
        $id
    );

    mysqli_stmt_execute($stmtFotoAntiga);

    $resultadoFotoAntiga = mysqli_stmt_get_result($stmtFotoAntiga);

    $registroFotoAntiga = mysqli_fetch_assoc($resultadoFotoAntiga);

    mysqli_stmt_close($stmtFotoAntiga);

    if (!$registroFotoAntiga) {
        echo "Pet não encontrado.";
        exit;
    }

    $fotoAnterior = $registroFotoAntiga["foto"] ?? null;

    try {
        $fotoNova = receberFotoPet();
    } catch (RuntimeException $e) {
        echo htmlspecialchars(
            $e->getMessage(),
            ENT_QUOTES,
            "UTF-8"
        );

        echo '<br><a href="editar.php?id=' . urlencode((string) $id) . '">Voltar à edição</a>';
        exit;
}

    $sql = "UPDATE pets
            SET nome = ?,
                nascimento = ?,
                especie_id = ?,
                prontuario = ?,
                genero = ?,
                foto = COALESCE(?, foto)
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Erro ao preparar alteração: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param(
        $stmt,
        "ssisssi",
        $nome,
        $nascimento,
        $especie_id,
        $prontuario,
        $genero,
        $fotoNova,
        $id
    );


    if (mysqli_stmt_execute($stmt)) {

        if ($fotoNova !== null && !empty($fotoAnterior) && $fotoAnterior !== $fotoNova) { 
            apagarFotoPet($fotoAnterior);
        }

        if (mysqli_stmt_affected_rows($stmt) > 0) {

            $_SESSION["msg"] = "Pet alterado com sucesso.";
            $_SESSION["class"] = "alert alert-success";

        } else {

            $_SESSION["msg"] = "Nenhuma alteração foi realizada.";
            $_SESSION["class"] = "alert alert-warning";

        }

    } else {

        if ($fotoNova !== null) {
            apagarFotoPet($fotoNova);
        }

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
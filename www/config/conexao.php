<?php

try{
    
    $conn = mysqli_connect(
    "mysql",
    "root",
    "1234",
    "sistema_pets"
);
} catch (mysqli_sql_exception $e){
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

mysqli_set_charset($conn, "utf8mb4");
?>
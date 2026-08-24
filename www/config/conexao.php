<?php

try{
    
    $conn = mysqli_connect(
    "mysql",
    "root",
    "1234",
    "sistema-pets"
);
} catch (mysqli_sql_exception $e){
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>
<?php
    function conectarBanco() {
        // Configuração da conexão
        $dsn = "pgsql:host=localhost;port=5433;dbname=postgres";
        $username = "postgres";
        $password = "Estacio@123";

        try {
            $conexao = new PDO($dsn, $username, $password);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexao;
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }
?>
   
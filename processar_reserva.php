<?php
// Inclui o arquivo de conexão
require_once 'conexao.php';

try {
    // Conecta ao banco de dados chamando a função conectarBanco
    $conexao = conectarBanco();

    // Captura os dados enviados pelo formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $numero_pessoas = $_POST['numero_pessoas'];  // Alterado para 'numero_pessoas', conforme o banco

    // Inicia uma transação para garantir que os dados sejam inseridos de forma segura e atômica
    $conexao->beginTransaction();

    // Consulta SQL para inserir os dados na tabela clientes
    $sql_cliente = "INSERT INTO clientes (nome, email, telefone) VALUES (:nome, :email, :telefone)";
    $stmt_cliente = $conexao->prepare($sql_cliente);
    $stmt_cliente->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':telefone' => $telefone
    ]);

    // Pega o ID do último cliente inserido (autoincremento)
    $cliente_id = $conexao->lastInsertId();

    // Consulta SQL para inserir os dados na tabela reservas
    $sql_reserva = "INSERT INTO reservas (cliente_id, data, numero_pessoas, status) 
                    VALUES (:cliente_id, CURRENT_DATE, :numero_pessoas, 'Pendente')"; // Usa a data atual para a reserva
    $stmt_reserva = $conexao->prepare($sql_reserva);
    $stmt_reserva->execute([
        ':cliente_id' => $cliente_id,
        ':numero_pessoas' => $numero_pessoas
    ]);

    // Confirma a transação
    $conexao->commit();

    echo "Reserva cadastrada com sucesso!";
} catch (PDOException $e) {
    // Caso ocorra um erro, faz o rollback da transação
    $conexao->rollBack();
    echo "Erro ao cadastrar a reserva: " . $e->getMessage();
}
?>

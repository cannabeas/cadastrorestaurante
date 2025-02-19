<?php
    // Inclui o arquivo de conexão
    require_once 'conexao.php';
    $conexao = conectarBanco();

    // Consultar os check-ins
    $query = "SELECT * FROM checkin";
    $stmt = $conexao->prepare($query);
    $stmt->execute();
    $checkins = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Check-ins</title>
    <link rel="stylesheet" href="./style_consulta.css">
</head>
<body>
    <header>
        <h1>Lista de Check-ins Cadastrados</h1>
        
    </header>

    <!-- Tabela de Check-ins -->
    
    <table border=1 >
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Data Check-in</th>
                <th>Data Check-out</th>
                <th>Quantidade de Quartos</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($checkins as $checkin): ?>
                <tr>
                    <td><?php echo $checkin['nome']; ?></td>
                    <td><?php echo $checkin['email']; ?></td>
                    <td> 
                            <?php 
                            // Formatar o telefone para (XX) XXXX-XXXX ou (XX) XXXXX-XXXX
                            $telefone = preg_replace("/(\d{2})(\d{4,5})(\d{4})/", "($1) $2-$3", $checkin['telefone']);
                            echo $telefone; 
                        ?>
                    </td>
                   
                    <td>
                        <?php 
                            // Formatar a data de check-in para dd/mm/yyyy
                            $data_checkin = date("d/m/Y", strtotime($checkin['data_checkin']));
                            echo $data_checkin; 
                        ?>
                    </td>
                    <td>
                        <?php 
                            // Formatar a data de check-in para dd/mm/yyyy
                            $data_checkin = date("d/m/Y", strtotime($checkin['data_checkout']));
                            echo $data_checkin; 
                        ?>
                    </td>
                    <td><?php echo $checkin['numero_quartos']; ?></td>
                    <td>
                        <!-- Botões de Editar e Excluir -->
                        <a href=""> Editar</a>
                        <a href="">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</body>
</html>
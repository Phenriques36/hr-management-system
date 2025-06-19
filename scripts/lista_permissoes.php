<?php
try {
    // Connect to the SQLite database using the correct path
    $db = new PDO('sqlite:' . __DIR__ . '/../database/dados.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to join permissoes and funcionarios tables to get names and permissions
    $query = "SELECT f.nome as nome_funcionario, 
                     p.permissao as tipo_permissao,
                     p.id as permissao_id
              FROM permissoes p
              JOIN funcionarios f ON p.id_funcionario = f.id
              ORDER BY f.nome ASC";
              
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    // Fetch all rows
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nome_funcionario']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tipo_permissao']) . "</td>";
        echo "<td class='acoes'>";
        echo "<button class='editar-btn' data-id='" . $row['permissao_id'] . "'>";
        echo "<span class='material-symbols-outlined'>edit</span>";
        echo "</button>";
        echo "<button class='remover-btn' data-id='" . $row['permissao_id'] . "'>";
        echo "<span class='material-symbols-outlined'>delete</span>";
        echo "</button>";
        echo "</td>";
        echo "</tr>";
    }

} catch(PDOException $e) {
    // Log the error and show a user-friendly message
    error_log("Error: " . $e->getMessage());
    echo "<tr><td colspan='3'>Erro ao carregar as permissões. Por favor, tente novamente mais tarde.</td></tr>";
}
?>
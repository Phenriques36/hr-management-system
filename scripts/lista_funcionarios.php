<?php
try {
    // Usando caminho absoluto para maior confiabilidade
    $dbPath = $_SERVER['DOCUMENT_ROOT'] . '/database/dados.db';
    $db = new SQLite3($dbPath);
    
    $result = $db->query('SELECT * FROM funcionarios ORDER BY nome');
    
    if (!$result) {
        throw new Exception("Erro na consulta: " . $db->lastErrorMsg());
    }
    
    echo "<table>";
    echo "<tr><th>Nome</th><th>Telemóvel</th><th>Email</th><th>Morada</th></tr>";

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
        echo "<td>" . htmlspecialchars($row['telemovel']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['morada']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    
    $db->close();
} catch (Exception $e) {
    echo "<p>Erro ao carregar funcionários: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
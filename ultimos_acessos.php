<?php
try {
    $db = new SQLite3('database/dados.db');
    date_default_timezone_set('Europe/Lisbon');

    $result = $db->query('SELECT email, tipo, ultimo_acesso FROM utilizadores ORDER BY ultimo_acesso DESC');

    echo "
    <!DOCTYPE html>
    <html lang='pt'>
    <head>
        <meta charset='UTF-8'>
        <title>Últimos Acessos</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 40px;
                color: #333;
            }
            h1 {
                text-align: center;
                color: #2c3e50;
                margin-bottom: 30px;
            }
            table {
                width: 80%;
                margin: auto;
                border-collapse: collapse;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                background-color: #fff;
                border-radius: 8px;
                overflow: hidden;
            }
            th, td {
                padding: 14px 20px;
                text-align: left;
            }
            th {
                background-color: #34495e;
                color: white;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:hover {
                background-color: #e6f7ff;
            }
        </style>
    </head>
    <body>
        <h1>Últimos Acessos dos Utilizadores</h1>
        <table>
            <tr><th>Email</th><th>Tipo</th><th>Último Acesso</th></tr>
    ";

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $email = htmlspecialchars($row['email']);
        $tipo = htmlspecialchars($row['tipo']);
        $acesso = $row['ultimo_acesso'] ?? 'Nunca';

        echo "<tr>";
        echo "<td>$email</td>";
        echo "<td>$tipo</td>";
        echo "<td>$acesso</td>";
        echo "</tr>";
    }

    echo "
        </table>
    </body>
    </html>
    ";
} catch (Exception $e) {
    echo "<p>Erro ao carregar dados: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>

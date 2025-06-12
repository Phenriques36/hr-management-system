<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vacationDays = $_POST['vacation_days'] ?? [];
    
    // Basic validation
    if (!empty($vacationDays)) {
        // In a real application, you would:
        // 1. Validate each date
        // 2. Check for conflicts
        // 3. Save to database
        // 4. Send notifications
        
        // For this example, we'll just store in session
        $_SESSION['vacation_requests'] = $vacationDays;
        $_SESSION['message'] = "Pedido de férias submetido para " . count($vacationDays) . " dias: " . 
                              implode(", ", $vacationDays);
    } else {
        $_SESSION['message'] = "Por favor, selecione pelo menos um dia para férias.";
    }
    
    // Redirect back to calendar
    header('Location: ../ferias.html');
    exit;
}

// If someone accesses this page directly
header('Location: ../ferias.html');
exit;
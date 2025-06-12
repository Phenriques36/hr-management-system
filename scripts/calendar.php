<?php
session_start();

// Get current month and year from URL or use current date
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

// Calculate previous and next months
$prevMonth = $month - 1 < 1 ? 12 : $month - 1;
$prevYear = $month - 1 < 1 ? $year - 1 : $year;
$nextMonth = $month + 1 > 12 ? 1 : $month + 1;
$nextYear = $month + 1 > 12 ? $year + 1 : $year;

// Get first day of month and total days
$firstDay = mktime(0, 0, 0, $month, 1, $year);
$totalDays = date('t', $firstDay);
$firstDayOfWeek = date('w', $firstDay); // 0 = Sunday

// Month names in Portuguese
$monthNames = [
    1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
    5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
    9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
];

// Get existing vacation requests from session
$vacationRequests = $_SESSION['vacation_requests'] ?? [];
?>

<div class="calendar-container">
  <div class="calendar-header">
    <a href="?month=<?= $prevMonth ?>&year=<?= $prevYear ?>" class="nav-button">&lt;</a>
    <h2 class="month-year"><?= $monthNames[$month] ?> <?= $year ?></h2>
    <a href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>" class="nav-button">&gt;</a>
  </div>
  
  <form method="POST" action="scripts/process_vacation.php">
    <div class="calendar-grid">
      <div class="calendar-weekdays">
        <div>Dom</div>
        <div>Seg</div>
        <div>Ter</div>
        <div>Qua</div>
        <div>Qui</div>
        <div>Sex</div>
        <div>Sáb</div>
      </div>
      <div class="calendar-days">
        <?php
        // Empty cells for days before the first day of month
        for ($i = 0; $i < $firstDayOfWeek; $i++) {
            echo '<div class="calendar-day other-month"></div>';
        }
        
        // Days of the month
        for ($day = 1; $day <= $totalDays; $day++) {
            $currentDay = mktime(0, 0, 0, $month, $day, $year);
            $dayOfWeek = date('w', $currentDay);
            $isWeekend = ($dayOfWeek == 0 || $dayOfWeek == 6);
            $dateStr = date('Y-m-d', $currentDay);
            
            // Check if day is requested or approved
            $statusClass = '';
            if (in_array($dateStr, $vacationRequests)) {
                $statusClass = 'requested';
            }
            // In a real app, you would check against database for approved days
            
            echo '<div class="calendar-day ' . ($isWeekend ? 'weekend ' : '') . $statusClass . '">';
            echo '<label>';
            echo '<input type="checkbox" name="vacation_days[]" value="' . $dateStr . '"' . 
                 (in_array($dateStr, $vacationRequests) ? ' checked' : '') . '>';
            echo '<span>' . $day . '</span>';
            echo '</label>';
            echo '</div>';
        }
        
        // Empty cells after last day of month
        $daysDisplayed = $firstDayOfWeek + $totalDays;
        $remainingCells = 7 - ($daysDisplayed % 7);
        if ($remainingCells < 7) {
            for ($i = 0; $i < $remainingCells; $i++) {
                echo '<div class="calendar-day other-month"></div>';
            }
        }
        ?>
      </div>
    </div>
    
    <div class="calendar-actions">
      <button type="submit" class="request-button">Solicitar Férias</button>
      <div class="calendar-legend">
        <div class="legend-item"><span class="legend-color available"></span> Disponível</div>
        <div class="legend-item"><span class="legend-color requested"></span> Solicitado</div>
        <div class="legend-item"><span class="legend-color approved"></span> Aprovado</div>
      </div>
    </div>
  </form>
</div>
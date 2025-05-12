#!/usr/bin/env php
<?php
declare(strict_types=1);
// Задание 2: генератор расписания
// https://github.com/netology-code/bphp-2-homeworks/blob/master/005-objects/exercise-02.md
function printSchedule(int $year, int $month): void {
    static $daysBeforeWork = 0;
    $date = sprintf('%04d-%02d-01', $year, $month);
    $daysInMonth = date("t", strtotime($date));
    $dayOfWeek = (date("w", strtotime($date)) + 6) % 7;
    $months = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь",
               "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
    echo "\n" . str_pad($months[$month - 1], 28, ' ', STR_PAD_BOTH) . "\n";

    for ($i = 0; $i < $dayOfWeek; $i++)
        echo "    ";

    for ($day = 1; $day <= $daysInMonth; $day++) {
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            echo "\n";
        }
        if ($daysBeforeWork > 0 || $dayOfWeek > 4) {
            echo str_pad("$day", 4, ' ', STR_PAD_LEFT);
            $daysBeforeWork -= 1;
        } else {
            echo "\033[31m" . str_pad("+$day", 4, ' ', STR_PAD_LEFT) . "\033[0m";
            $daysBeforeWork = 2;
        }
        $dayOfWeek++;
    }

    echo "\n";
}

try {
    if ($argc !== 4)
        throw new InvalidArgumentException("Неверное количество аргументов.");

    $year = $argv[1];
    $firstMonth = $argv[2];
    $duration = $argv[3];

    if ($firstMonth != (int)$firstMonth || $firstMonth < 1 || $firstMonth > 12)
        throw new InvalidArgumentException("Месяц должен быть целым числом в промежутке от 1 до 12.");

    if ($year != (int)$year || $duration != (int)$duration || $year < 1 || $duration < 1)
        throw new InvalidArgumentException("Аргументы должны быть натуральными числами.");

    $year = (int)$year;
    $firstMonth = (int)$firstMonth;
    $duration = (int)$duration;
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . "\n";
    echo "Использование: php schedule.php <год> <месяц> <кол-во месяцев>\n";
    echo "Пример работы программы для мая 2025 года:\n";
    printSchedule(2025, 5);
    echo "\n";
    exit(1);
}

echo "Расписание для сотрудника на $duration месяцев, начиная с $firstMonth месяца $year года:\n";

for ($month = $firstMonth; $month < $firstMonth + $duration; $month++) {
    if ($month == 13) {
        $year++;
        $month = 1;
        $duration -= 12;
    }
    printSchedule($year, $month);
    echo "\n";
}

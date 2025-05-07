#!/usr/bin/env php
<?php
// Задание №2: создание консольного скрипта
// https://github.com/netology-code/bphp-2-homeworks/blob/master/002-console/exercise-02.md

echo("Введите первое целое число: ");
$a = trim(fgets(STDIN));

echo("Введите второе целое число: ");
$b = trim(fgets(STDIN));

if ((int) $a <> $a || (int) $b <> $b) {
    fwrite(STDERR, "Введите, пожалуйста, число\n");
} elseif ($b == 0) {
    fwrite(STDERR, "Делить на 0 нельзя\n");
} else {
    echo($a / $b . "\n");
}

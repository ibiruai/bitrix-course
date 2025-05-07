#!/usr/bin/env php
<?php
// Задание 2: стандартизатор имени
// https://github.com/netology-code/bphp-2-homeworks/blob/master/003-operators/exercise-02.md
echo("Введите имя: ");
$name = trim(fgets(STDIN));
echo("Введите фамилию: ");
$surname = trim(fgets(STDIN));
echo("Введите отчество: ");
$patronym = trim(fgets(STDIN));
$name = mb_strtoupper(mb_substr($name, 0, 1)) . mb_strtolower(mb_substr($name, 1));
$surname = mb_strtoupper(mb_substr($surname, 0, 1)) . mb_strtolower(mb_substr($surname, 1));
$patronym = mb_strtoupper(mb_substr($patronym, 0, 1)) . mb_strtolower(mb_substr($patronym, 1));
$fullname = $surname . " " . $name . " " . $patronym;
$surnameAndInitials = $surname . " " . mb_substr($name, 0, 1) . "." . mb_substr($patronym, 0, 1) . ".";
$fio = mb_substr($surname, 0, 1) . mb_substr($name, 0, 1) . mb_substr($patronym, 0, 1);
echo("Полное имя: '$fullname'\n");
echo("Фамилия и инициалы: '$surnameAndInitials'\n");
echo("Аббревиатура: '$fio' \\\n");

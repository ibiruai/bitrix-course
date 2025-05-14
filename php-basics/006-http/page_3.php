<?php
session_start();
$_SESSION['count'] = ($_SESSION['count'] ?? 0) + 1;
if ($_SESSION['count'] % 3 == 0) {
    header("Location: page_4.php");
    exit;
}
echo 'Сколько раз Вы открыли эту страницу: ' . $_SESSION['count'];

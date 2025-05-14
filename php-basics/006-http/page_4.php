<?php
session_start();
$_SESSION['count'] = $_SESSION['count'] ?? 0;
echo 'Сколько раз Вы открыли страницу page_3.php: ' . $_SESSION['count'];

<?php
session_start();
if (isset($_POST['username']) && !empty(trim($_POST['username']))) {
    $_SESSION['username'] = trim($_POST['username']);
}
header("Location: index.php");

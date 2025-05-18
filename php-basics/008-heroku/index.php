<?php
session_start();
include "includes/header.php";
include "includes/about.php";

if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
    include "includes/greeting.php";
} else {
    include "includes/form.php";
}

include "includes/footer.php";

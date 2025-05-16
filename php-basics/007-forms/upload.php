<?php
if (!isset($_POST["file_name"]) || !isset($_FILES["content"]) || $_FILES["content"]["error"]) {
    header("Location: index.html");
    exit;
}

if (!is_dir("upload")) {
    mkdir("upload", 0755, true);
}

$destination = "upload/" . basename($_POST["file_name"]);
move_uploaded_file($_FILES["content"]["tmp_name"], $destination);
echo "Файл загружен и находится здесь: " . realpath($destination) . "<br>";
echo "Размер загруженного файла: " . filesize($destination) . " байт";

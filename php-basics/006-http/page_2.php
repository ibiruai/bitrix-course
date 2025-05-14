<?php
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="text.txt"');
header('Content-Length: ' . $_GET['text']);
echo $_GET['text'];

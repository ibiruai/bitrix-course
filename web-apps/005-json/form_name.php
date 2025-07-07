<?
if (isset($_GET['source'])) {
    header('Content-Type: text/plain');
    readfile(__FILE__);
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Решение домашнего задания по теме "Форматы обмена данными JSON, XML"</title>
</head>
<body>
<?
echo "<pre>";  //  Выводим тег <pre> для форматирования результата var_dump
var_dump($_REQUEST);  // Выводим данные, пришедшие из формы
echo "</pre>";  // Закрываем тег <pre>

$arUserInfo = array(
    "name" => $_REQUEST['user_name'],
    "second_name" => $_REQUEST['user_second_name'],
    "last_name" => $_REQUEST['user_last_name'],
    "address" => array(
        "city" => $_REQUEST['user_city'],
        "street" => $_REQUEST['user_street'],
        "building" => $_REQUEST['user_building'],
        "apartment" => $_REQUEST['user_apartment']
    )
);

$strUserInfo = json_encode($arUserInfo, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);  // Преобразуем массив в JSON
?>

    <form action="" method="POST">
        <strong>Как вас зовут?</strong><br>
        <strong>Ваше имя</strong><br>
        <input type="text" name="user_name" id="user_name" value=""><br>
        <strong>Ваше отчество</strong><br>
        <input type="text" name="user_second_name" id="user_second_name" value=""><br>
        <strong>Ваша фамилия</strong><br>
        <input type="text" name="user_last_name" id="user_last_name" value=""><br><br>

        <strong>Где вы живёте?</strong><br>
        <strong>Город</strong><br>
        <input type="text" name="user_city" id="user_city" value=""><br>
        <strong>Улица</strong><br>
        <input type="text" name="user_street" id="user_street" value=""><br>
        <strong>Дом</strong><br>
        <input type="text" name="user_building" id="user_building" value=""><br>
        <strong>Квартира</strong><br>
        <input type="text" name="user_apartment" id="user_apartment" value=""><br>

        <input type="submit" name="submit" id="submit" value="Отправить">
    </form>
<div id="result">
    <?=$strUserInfo?>  <!-- Отображаем данные в виде JSON -->
</div>
<p>
    <a href="https://github.com/netology-code/bweb-homeworks/blob/main/5.%20JSON%2C%20XML/">Текст задания</a><br>
    <a href="?source">Показать код страницы</a>
</p>
</body>
</html>

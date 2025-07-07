<?
if (isset($_GET['source'])) {
    header('Content-Type: text/plain');
    $i = 0;
    foreach (file(__FILE__) as $line) {
        if ($i++ < 15)
            continue;
        if (preg_match('/^ +\$(DB_PASS|DB_USER|DB_HOST|DB_NAME) = /', $line)) {
            $line = preg_replace('/=.*/', "= '■■■■■';", $line);
        }
        echo $line;
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Оформление заказа</title>
</head>
<body>
    <div class="container">
        <p>
            Решение домашнего задания по теме "Базы данных. MySQL"<br>
            <a href="https://github.com/netology-code/bweb-homeworks/tree/main/6.%20MySQL">Текст задания</a><br>
            <a href="?source">Показать код страницы</a>
        </p>
<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<pre>";
print_r($_REQUEST);
echo "</pre>";

if (isset($_REQUEST['submit'])){
    //подключаемся к БД
    $DB_HOST = 'localhost'; 
    $DB_USER = 'userbx-stud49'; 
    $DB_PASS = '@yBKjv7%Km9';
    $DB_NAME = 'dbbx-stud49';
    $link = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    if (!$link) {
         echo "Ошибка: Невозможно установить соединение с MySQL.";
         echo "Код ошибки errno: ".mysqli_connect_errno( );
         echo "Текст ошибки error: ".mysqli_connect_error( );
    } else {
        $sql_contact = "INSERT INTO contacts (Name, SecondName, LastName) VALUES ('".$_REQUEST['user_name']."', '".$_REQUEST['user_second_name']."', '".$_REQUEST['user_last_name']."')";
        $result = mysqli_query($link, $sql_contact);
        $contact_id = mysqli_insert_id($link);

        $sql_order = "INSERT INTO orders (ContactId, City, Street, House, Flat) VALUES ('".$contact_id."', '".$_REQUEST['user_address_city']."', '".$_REQUEST['user_address_street']."', '".$_REQUEST['user_address_house']."', '".$_REQUEST['user_address_flat']."')";
        $result2 = mysqli_query($link, $sql_order);
        $order_id = mysqli_insert_id($link);

        if ($result == false) {
            echo "Произошла ошибка при выполнении запроса";
        } else {
            echo "Спасибо за ваш заказ! Ему присвоен номер $order_id";
        }
    }
}
?>

        <h2>Оформление заказа</h2>
        <form method="POST">
            <fieldset>
                <legend>Контактная информация</legend>
                <div class="mb-3">
                    <label class="form-label">Ваше имя<span class="mf-req">*</span></label>
                    <input type="text" name="user_name" id="user_name" class="form-control" value=""><br>
                    <label class="form-label">Ваше отчество<span class="mf-req">*</span></label>
                    <input type="text" name="user_second_name" id="user_second_name" class="form-control" value=""><br>
                    <label class="form-label">Ваша фамилия<span class="mf-req">*</span></label>
                    <input type="text" name="user_last_name" id="user_last_name" class="form-control" value=""><br>
                </div>
            </fieldset>
            <fieldset>
                <legend>Адрес доставки</legend>
                <div class="mb-3">
                    <label class="form-label">Город<span class="mf-req">*</span></label>
                    <input type="text" name="user_address_city" id="user_address_city" class="form-control" value=""><br>
                    <label class="form-label">Улица<span class="mf-req">*</span></label>
                    <input type="text" name="user_address_street" id="user_address_street" class="form-control" value=""><br>
                    <label class="form-label">Дом и корпус<span class="mf-req">*</span></label>
                    <input type="text" name="user_address_house" id="user_address_house" class="form-control" value=""><br>
                    <label class="form-label">Квартира<span class="mf-req">*</span></label>
                    <input type="text" name="user_address_flat" id="user_address_flat" class="form-control" value=""><br>
                </div>
            </fieldset>
            <button type="submit" name="submit" class="btn btn-primary" value="submit">Заказать</button>
        </form>
        <div id="result"></div>
    </div>
</body>
</html>

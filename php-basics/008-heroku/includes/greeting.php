<p><em>А как зовут тебя?</em></p>
<p>Меня зовут <?php echo htmlspecialchars($_SESSION["username"]); ?>.</p>
<p><em>Хорошего дня, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</em></p>
<form action="exit.php" method="POST">
    <p><input type="submit" value="Мне пора" autofocus></p>
</form>

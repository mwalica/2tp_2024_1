<?php
$msg = null;
$data = null;
$conn = mysqli_connect("localhost", "root", "", "portal");
$sql1 = "SELECT COUNT(*) FROM dane";
$result = mysqli_query($conn, $sql1);
$counter = mysqli_fetch_row($result);

if (isset($_POST['btn'])) {
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $sql2 = "SELECT haslo FROM uzytkownicy WHERE login='$login'";
        $result2 = mysqli_query($conn, $sql2);
        $pass = mysqli_fetch_assoc($result2);
        if (!$pass) {
            $msg = "login nie istnieje";
        } else if (sha1($password) !== $pass['haslo']) {
            $msg = "hasło nieprawidłowe";
        } else {
            $sql3 = "SELECT uzytkownicy.login, dane.rok_urodz, dane.przyjaciol, dane.hobby, dane.zdjecie FROM uzytkownicy JOIN dane ON dane.id=uzytkownicy.id WHERE login='$login'";
            $result3 = mysqli_query($conn, $sql3);
            $data = mysqli_fetch_assoc($result3);
        }
    }
}

mysqli_close($conn);
?>

<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal społecznościowy</title>
    <link rel="stylesheet" href="styl5.css">
</head>
<body>
<header class="banner-1">
    <h2>Nasze osiedle</h2>
</header>
<header class="banner-2">
    <?php
    echo "<h5>Liczba użytkowników portalu: {$counter[0]}</h5>"
    ?>
</header>
<section class="left">
    <h3>Logowanie</h3>
    <form action="" method="post">
        <label>login</label><br>
        <input type="text" name="login"><br>
        <label>hasło</label><br>
        <input type="password" name="password"><br>
        <input type="submit" name="btn" value="Zaloguj">
    </form>
</section>
<section class="right">
    <h3>Wizytówka</h3>
    <?php echo $msg; ?>
    <?php if ($data): ?>
        <div class="wizytowka">
            <img src="<?php echo $data['zdjecie']; ?>" alt="osoba">
            <h4><?php echo $data['login'] ?>(<?php echo 2025 - $data['rok_urodz'] ?>)</h4>
            <p>hobby: <?php echo $data['hobby']; ?></p>
            <h1><img src="icon-on.png" alt=""><?php echo $data['przyjaciol']; ?></h1>
            <a href="dane.html" class="btn">Więcej informacji</a>
        </div>
    <?php endif; ?>
</section>
<footer>Stronę wykonał: 000000000</footer>
</body>
</html>

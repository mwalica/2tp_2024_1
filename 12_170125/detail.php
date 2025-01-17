<?php
$id = $_GET['id'];
$phone = [];

$conn = mysqli_connect("localhost", "root", "", "phones_crud");
mysqli_set_charset($conn, "utf8");
$sql = "SELECT * FROM phones WHERE id = $id";
$result = mysqli_query($conn, $sql);
$phone = mysqli_fetch_assoc($result);

mysqli_close($conn);

?>

<!doctype html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Telefon <?php echo $phone['title']; ?></title>
</head>
<body>
<a href="01.php">Powrót</a>
<?php if ($phone): ?>
	<h3><?php echo $phone['title']; ?></h3>
	<p><?php echo $phone['description']; ?></p>
<?php else: ?>
	<p>Nie ma takiego telefonu</p>
<?php endif; ?>

</body>
</html>

<?php
$phones = [];

$conn = mysqli_connect("localhost", "root", "", "phones_crud");
mysqli_set_charset($conn, "utf8");
$sql = "SELECT * FROM phones ORDER BY create_date DESC";
$result = mysqli_query($conn, $sql);
$phones = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_close($conn);
?>

<!doctype html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Telefony</title>
	<style>
        table {
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid grey;
            padding: 0.4em;
        }
	</style>
</head>
<body>
<h3>Telefony</h3>
<table>
	<tr>
		<th>Nazwa</th>
		<th>Data</th>
		<th>Akcje</th>
	</tr>
    <?php foreach ($phones as $phone): ?>
    <tr>
	    <td><?php echo $phone['title']; ?></td>
	    <td><?php echo $phone['create_date']; ?></td>
	    <td><a href="detail.php?id=<?php echo $phone['id']; ?>">Szczegóły</a></td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>

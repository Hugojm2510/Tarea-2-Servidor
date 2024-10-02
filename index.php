<?php

function connection(){
    $host = "localhost:3306";
    $user = "root";
    $pass = "root";

    $bd = "northwind";

    $connect=mysqli_connect($host, $user, $pass);

    mysqli_select_db($connect, $bd);

    return $connect;

}

$con = connection();

$sql = "SELECT ProductName, CategoryName, UnitPrice FROM products
join categories on products.categoryid = categories.CategoryID
where products.UnitPrice >
	(
    select avg(products.UnitPrice)
    from products
    where products.CategoryID = products.CategoryID
    );";

$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea 2</title>
</head>
<body>
    <div>
        <table border="1">
            <tr>
                <th>ProductName</th>
                <th>CategoryName</th>
                <th>UnitPrice</th>
            </tr>
            <?php while ($row = mysqli_fetch_array($query)): ?>
            <tr>
                <td><?=$row["ProductName"] ?></td>
                <td><?=$row["CategoryName"] ?></td>
                <td><?=$row["UnitPrice"] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
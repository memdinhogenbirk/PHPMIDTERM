<?php 
/*4) Admin Page

    Create an admin page that:

    Displays all registration records from the database in a table
    Allows the admin to update and delete records as needed*/
    require 'includes/connect.php';

    $sql = "SELECT * FROM registrations";//select all data from registrations table
    $stmt = $pdo->prepare($sql);//prepare statement
    $stmt->execute();//bind the id, execute query
    $entries = $stmt->fetchAll();//fetch all data from reg table
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
</head>
<body>

    <h1>Admin Page</h1>

    <form action="process.php" method="POST">
        <?php foreach($entries as $e=> $entry): ?><!--for every row of data in the reg table, display data-->
            <tr>
              <td><?= htmlspecialchars($entry['id']); ?></td><!--display id, first_name, etc in a not so tidy string (ideally with more time I'd make this look presentable)-->
              <td>
                <?= htmlspecialchars($entry['first_name']); ?>
                <?= htmlspecialchars($entry['last_name']); ?>
              </td>
              <td><?= htmlspecialchars($entry['phone']); ?></td>
              <td><?= htmlspecialchars($entry['email']); ?></td>
              <td><?= htmlspecialchars($entry['created_at']); ?></td>

              <td>
                <a href="update.php?id=<?= urlencode($entry['id']); ?>"> Update </a><!--append id to update page link-->
              </td>
            </tr>
            <a href="delete.php?id=<?= urlencode($entry['id']); ?>">Delete</a><!--append id to delete page link-->
            <br>
        <?php endforeach; ?>
    </form>

    <p>
        <a href="index.php">Go to Event Registration</a>
    </p>

</body>
</html>
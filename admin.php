<?php 
/*4) Admin Page

    Create an admin page that:

    Displays all registration records from the database in a table
    Allows the admin to update and delete records as needed*/
    require 'includes/connect.php';

    $sql = "SELECT * FROM registrations";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();//bind the id, execute query
    $entries = $stmt->fetchAll();
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
        <?php foreach($entries as $e=> $entry): ?>
            <tr>
              <td><?= htmlspecialchars($entry['id']); ?></td>
              <td>
                <?= htmlspecialchars($entry['first_name']); ?>
                <?= htmlspecialchars($entry['last_name']); ?>
              </td>
              <td><?= htmlspecialchars($entry['phone']); ?></td>
              <td><?= htmlspecialchars($entry['email']); ?></td>
              <td><?= htmlspecialchars($entry['created_at']); ?></td>

              <td>
                <a href="update.php?id=<?= urlencode($order['id']); ?>"
                > Update </a>
              </td>
            </tr>
            <a href="delete.php?id=<?= urlencode($entry['id']); ?>">Delete</a>
        <?php endforeach; ?>
    </form>

    <p>
        <a href="index.php">Go to Event Registration</a>
    </p>

</body>
</html>
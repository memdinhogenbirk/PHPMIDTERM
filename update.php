<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Entry</title>
</head>
<?php 
    require 'includes/connect.php'; 
    if (!isset($_GET['id'])) {//if no id, kill the whole thing, display message
            die("No id provided.");
        }
    $regid =(int) $_GET['id'];//get url appended id and assign to variable
    $sql_existing = "SELECT * FROM registrations WHERE id = :id LIMIT 1";//select all data from row associated with get-ed id

    $stmt_existing = $pdo->prepare($sql_existing);
    $stmt_existing->execute([':id' => $regid]);//bind the id, execute query
    $entry = $stmt_existing->fetch();//fetch data to contact variable 
?>
<body>

    <h1>Update Registry</h1>

    <form action="process.php" method="POST">
        <input type="hidden" name="updated_id" value="<?= $regid ?>">
        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($entry['first_name'] ?? '') ?>"><br><br>

        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($entry['last_name'] ?? '') ?>"><br><br>

        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="<?= htmlspecialchars($entry['email'] ?? '') ?>"><br><br>

        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($entry['phone'] ?? '') ?>"><br><br>

        <button type="submit">Update</button>

    </form>

    <p>
        <a href="admin.php">Go to Admin Page</a>
    </p>

</body>
</html>
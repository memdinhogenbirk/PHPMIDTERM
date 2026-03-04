<?php 
    require 'includes/connect.php'; 
    if (!isset($_GET['id'])) {
            die("No id provided.");
        }
    $regid =(int) $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM registrations WHERE id = :id");
    $stmt->execute([':id' => $regid]);
    header("Location: admin.php"); 
    exit; 
?>
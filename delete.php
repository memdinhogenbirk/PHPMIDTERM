<?php 
    require 'includes/connect.php'; 
    if (!isset($_GET['id'])) {
            die("No id provided.");
        }
    $regid =(int) $_GET['id'];//get url appended id and assign to variable

    $stmt = $pdo->prepare("DELETE FROM registrations WHERE id = :id");//delete all data from row associated with get-ed id
    $stmt->execute([':id' => $regid]);
    header("Location: admin.php"); //nothing to display on this page, stay on admin page
    exit; 
?>
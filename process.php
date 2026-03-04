<?php 
    /*first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    3) Registration Form

    Using the provided HTML form:

    Accept user input and submit it to the server
    Sanitize and validate the form data on the server (3 marks)
    If valid, store the registration in the database
    If invalid, display a clear error message and do not store the record*/
    
    require 'includes/connect.php';
    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        die('Invalid request');//make sure method is post from forms
    }

    $firstName = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS));
    $lastName = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS));
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS));
    
    $errors = [];

    if($firstName === null || $firstName === ''){
        $errors[] = "First Name is Required.";
    }

    if($lastName === null || $lastName === ''){
        $errors[] = "Last Name is Required.";
    }

    if($email === null || $email === ''){
        $errors[] = "Email is Required";
    } 
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Email must be a valid email";
    }

    if($phone === null || $phone === ''){
        $errors[] = "Phone number is required.";
    }
    elseif(!filter_var($phone, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^[0-9\-\+\(\)\s]{7,25}$/']])){
        $errors[] = "Phone number format is invalid.";
    }
    
    if (!empty($errors)){
        echo '<h1>Fields Missing</h1>';
        foreach ($errors as $error) : ?>
            <li><?php echo $error; ?> </li>
        <?php endforeach;
        echo 'data not submitted';
        exit;
    }
    $regid = filter_input(INPUT_POST,'updated_id', FILTER_VALIDATE_INT);
    if ($regid !== false && $regid > 0){
        $sql = "UPDATE registrations SET
        first_name = :first_name,
        last_name = :last_name,
        email = :email,
        phone = :phone
        WHERE id = :id";
        $stmt = $pdo->prepare($sql);//prepare query
        //execute
        $stmt ->execute([':first_name' => $firstName, ':last_name' => $lastName, ':email' => $email, ':phone' => $phone, ':id' => $regid]);
            
        echo'Entry successfully updated';
        echo'<a href="admin.php">View Data</a>';
    }
    else{
        $sql = "INSERT INTO registrations(first_name,last_name,email,phone) 
                                VALUES(:first_name,:last_name,:email,:phone)";
        $stmt = $pdo->prepare($sql);//prepare query
        //execute
        $stmt ->execute([':first_name' => $firstName, ':last_name' => $lastName, ':email' => $email, ':phone' => $phone]);
            
        echo'Data successfully uploaded';
        echo'<a href="admin.php">View Data</a>';
    }
    
?>
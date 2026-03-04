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
    
    $errors = [];//initialize error collecting array

    if($firstName === null || $firstName === ''){//no empty first name
        $errors[] = "First Name is Required.";
    }

    if($lastName === null || $lastName === ''){//no empty last name
        $errors[] = "Last Name is Required.";
    }

    if($email === null || $email === ''){//no empty email
        $errors[] = "Email is Required";
    } 
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){//check email is valid format
        $errors[] = "Email must be a valid email";
    }

    if($phone === null || $phone === ''){//no empty phone number
        $errors[] = "Phone number is required.";
    }
    elseif(!filter_var($phone, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^[0-9\-\+\(\)\s]{7,25}$/']])){//check phone number matches regex pattern
        $errors[] = "Phone number format is invalid.";
    }
    
    if (!empty($errors)){//if any arrays caught, display them and do not execute the rest of the php
        echo '<h1>Fields Missing</h1>';
        foreach ($errors as $error) : ?>
            <li><?php echo $error; ?> </li>
        <?php endforeach;
        echo 'data not submitted';
        exit;
    }
    $regid = filter_input(INPUT_POST,'updated_id', FILTER_VALIDATE_INT);//update page id collected here
    if ($regid !== false && $regid > 0){//if there is an update id, do an update query
        $sql = "UPDATE registrations SET
        first_name = :first_name,
        last_name = :last_name,
        email = :email,
        phone = :phone
        WHERE id = :id";
        $stmt = $pdo->prepare($sql);//prepare query
        //execute
        $stmt ->execute([':first_name' => $firstName, ':last_name' => $lastName, ':email' => $email, ':phone' => $phone, ':id' => $regid]);//must bind id for update
            
        echo'Entry successfully updated';//update message
        echo'<a href="admin.php">View Data</a>';//link to admin page for ease of access
    }
    else{//not an update, but a fresh entry, insert query instead. Prepare named place holders and where the data will be inserted
        $sql = "INSERT INTO registrations(first_name,last_name,email,phone) 
                                VALUES(:first_name,:last_name,:email,:phone)";
        $stmt = $pdo->prepare($sql);//prepare query
        //execute
        $stmt ->execute([':first_name' => $firstName, ':last_name' => $lastName, ':email' => $email, ':phone' => $phone]);//bind place holders to variables that have been sanitized and validated
            
        echo'Data successfully uploaded';//new entry message
        echo'<a href="admin.php">View Data</a>';//link to admin page for ease of access
    }
    
?>
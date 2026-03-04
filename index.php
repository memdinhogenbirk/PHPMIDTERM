<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Registration</title>
</head>
<body>

    <h1>Event Registration</h1>

    <form action="process.php" method="POST">

        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name"><br><br>

        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name"><br><br>

        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email"><br><br>

        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone"><br><br>

        <button type="submit">Register</button>

    </form>

    <p>
        <a href="admin.php">Go to Admin Page</a>
    </p>

</body>
</html>
<!--Event Registration System
Overview

Using the provided SQL (to create the database table) and the provided HTML form, you will build a simple PHP + database CRUD application.

Users must be able to register for an event, and an administrator must be able to manage registrations. You DO NOT need to create a login or check that a user is logged in in order to see the admin page.
Your Task
1) Create a New Repository

    Create a new GitHub repository for this exam question.
    Build your application inside that repository.
    When finished, submit the link to your repository as your answer on Blackboard.

2) Set Up the Database

    Run the provided SQL to create the required table.
    Connect your PHP application to the database.

3) Registration Form

Using the provided HTML form:

    Accept user input and submit it to the server
    Sanitize and validate the form data on the server (3 marks)
    If valid, store the registration in the database
    If invalid, display a clear error message and do not store the record

4) Admin Page

Create an admin page that:

    Displays all registration records from the database in a table
    Allows the admin to update and delete records as needed

5) CRUD Requirements

Your application must support:

    Create: Add a new registration (5 marks)
    Read: Display all registrations (5 marks)
    Update: Edit an existing registration and save changes (5 marks)
    Delete: Remove a registration (5 marks)

Additional Requirements

    Include code comments to explain what your code is doing (2 marks)
    Use secure database coding practices (do not place raw user input directly into SQL)

Submission

Submit the GitHub repository link as your answer on Blackboard

Total - / 25 marks-->
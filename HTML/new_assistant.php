<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/EditListOfStudents.css" />
</head>
<body>

</body>
</html>
<?php

$firstname = filter_input(INPUT_POST, 'firstname');
$lastname = filter_input(INPUT_POST, 'lastname');
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');

include("connect.php");

$sql = "INSERT INTO users (username, password, firstname, lastname) 
VALUES ('$username', '$password', '$firstname', '$lastname');";

if ($link->query($sql) === TRUE){
    echo 'New assistant added successfully';
} else {
    echo 'Error: '.$sql ."<br>". $link->error;
}

echo '<script>window.location.href = "MESS_assistants.php";</script>';

$link->close();

?>
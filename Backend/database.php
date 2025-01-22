<?php
$servername = "localhost";
$username = "root";
$password = "Madara*@7";

try {
    // Establish connection
    $conn = new PDO("mysql:host=$servername;dbname=taskmanagement", $username, $password);
    echo " c successfull";
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}

    //to check if user exists in database
    $stmt = "SELECT id,email FROM users WHERE email = 'lyanptech@gmail.com'";
    $sql = $conn->prepare($stmt);
    $sql->execute();
    //fetch results
    $results = $sql->fetch(PDO::FETCH_ASSOC);
    if($results)
    {
        echo "id:" . $results['id'] . "email :" .$results['email'];
    }
    else
    {
        echo "user notexits";
    }
    
    $conn = null; // Close connection
?>
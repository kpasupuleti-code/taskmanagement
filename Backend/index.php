<?php
    $servername  = "localhost";
    $username = "root";
    $password = "Madara*@7";

    try{
        $conn = new PDO("mysql:host=$servername;dbname=taskmanagement", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * From users";
        $stmt = $conn->query($query);

        if ($stmt->rowCount() >= 0) {
            // Fetch the first row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "id: " . $row["id"] . " - Email: " . $row["email"] . " - Password: " . $row["password"] . "<br>";
        } else {
            echo "No results found";
        }
    }
    catch(PDOException $e){
        echo "failed: ". $e->getMessage();
    }

    $conn = null;
?>

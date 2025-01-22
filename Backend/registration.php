<?php
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header('Content-Type: application/json');

    // Handle preflight request
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }
    //Establish a connection
    //include 'database.php';
    $servername = "localhost";
    $username = "root";
    $password = "Madara*@7";

    try {
    // Establish connection
    $conn = new PDO("mysql:host=$servername;dbname=taskmanagement", $username, $password);
}   catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
    //read the json data sent from front end
    $data = json_decode(file_get_contents('php://input'),true);

    //check if user exits in database
    $stmt1 = $conn->prepare("SELECT email FROM users WHERE email=:email");
    //bind parameters
    $stmt1->bindParam(':email',$data['email']);
    $stmt1->execute();
    //fetch results to check
    $results = $stmt1->fetch(PDO::FETCH_ASSOC);
    if($results)
    {
        echo json_encode(array("status" => "error", "mess" => "User exists"));
    }
    else{
    //hash the password
    $password = $data['password'];
    // Hash the password using the default algorithm (bcrypt)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //prepare sql query with place holders
    $stmt = $conn->prepare('INSERT INTO users(email,password) 
                                    VALUES (:email,:password)');

    //bind the parameters to query
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':password', $hashedPassword);

    //execute sql statement
    if ($stmt->execute()) {
        // Return success response
        echo json_encode(["status" => "success", "mess" => "User registered successfully."]);
    } else {
        // Return failure response
        echo json_encode(["status" => "error", "mess" => "An error occurred while registering the user."]);
    }
}
    $conn = null;
?>


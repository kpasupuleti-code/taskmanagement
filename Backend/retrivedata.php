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

$stmt = $conn->prepare('SELECT Description,Status FROM tasks Where email = :email');
$stmt->bindParam(':email',$data['email']);
if($stmt->execute())
{
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(["status" => "success", "tasks" => $res]);
}
else{
    echo json_encode(["status" => "success" ,"message" => "no tasks available"]);
}

?>
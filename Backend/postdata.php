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
$stmt = $conn->prepare('INSERT INTO tasks( Description, Status, email)
                               VALUES (:Status, :Description, :email)');
$stmt->bindParam(':Status', $data['Status']);
$stmt->bindParam(':Description', $data['Description']);
$stmt->bindParam(':email', $data['email']);
$res = $stmt->execute();
if($res)
{
    echo json_encode(["status" => "success", "message"=>"posted"]);
}
else{
    echo json_encode(["status" => "failure", "message"=>"not posted"]);
}
$conn = null;
?>
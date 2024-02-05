<?php
require_once 'db.php';
// require_once 'Zinojumi.php';

$conn = new DBconn();
if(isset($_POST['searchQuery'])){
    $searchQuery = $_POST['searchQuery'];
    $messages = $conn->searchMessages($searchQuery);
    
    foreach ($messages as $message) {
        echo "Name: " . $message['name'] . ", Email: " . $message['email'] . ", Message: " . $message['message'] . "<br>";
    }
}

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])){
    $conn->insertMessage($_POST['name'],$_POST['email'],$_POST['message']);
    // echo json_encode($_POST['name']);
    // return json_encode($_POST['name']);
}
?>

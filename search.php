<?php
require_once 'db.php';
// require_once 'Zinojumi.php';

$conn = new DBconn();

if(isset($_POST['searchQuery'])){

    $searchQuery = $_POST['searchQuery'];
    $messages = $conn->searchMessages($searchQuery,$_POST['criteria'],  $_POST['order']);
    
    foreach ($messages as $message) {
        echo "<div class='message flex col'><p>".$message['name']."</p><p>".$message['email']."</p><p>".$message['message']."</p><br></div>";
    }
}

// if(!isset($_POST['searchQuery']) || $_POST['searchQuery'] == ""){
//     echo "<h1>No results found</h1>";
//     // $messages = $conn->getAllMessages();
//     // foreach ($messages as $message) {
//     //     echo "<div class='flex row message'><p>Name: ".$message['name']."</p><p>Email: ".$message['email']."</p><p>Message: ".$message['message']."</p><br></div>";
//     // }
// }

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])){
    $conn->insertMessage($_POST['name'],$_POST['email'],$_POST['message']);
    // echo json_encode($_POST['name']);
    // return json_encode($_POST['name']);
}
?>

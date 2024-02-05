<?php
require_once 'db.php';
// require_once 'Zinojumi.php';

$zinojumi = new DBconn();
$searchQuery = $_POST['searchQuery'];
$messages = $zinojumi->searchMessages($searchQuery);

foreach ($messages as $message) {
    echo "Name: " . $message['name'] . ", Email: " . $message['email'] . ", Message: " . $message['message'] . "<br>";
}
?>

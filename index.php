<?php
include_once("./db.php");
$dbConn= new DbConn();
// $messages = $dbConn->getAllMessages();
// $messages = $dbConn->searchMessages("rob");
// --- dynamoc search
// if(isset($_POST['searchQuery'])){
    
// }
$searchQuery = $_POST['searchQuery'];
// $searchQuery = 'rob';
$messages = $dbConn->searchMessages($searchQuery);
// ---
if(isset($_POST['button'])){
    $dbConn->insertMessage($_POST['name'],$_POST['email'],$_POST['message']);
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php foreach($messages as $message){?>
<div>
    <p><?= $message['name'] ?></p>
    <p><?= $message['email'] ?></p>
    <p><?= $message['message'] ?></p>
</div>
<?php } ?>
<script>
    $(document).ready(function(){
    $('#search').on('input', function(){
        var searchQuery = $(this).val();
        if (searchQuery.length > 0) {
            $.ajax({
                url: 'search.php',
                type: 'POST',
                data: {searchQuery: searchQuery},
                success: function(data){
                    $('#results').html(data);
                }
            });
        } else {
            $('#results').html('');
        }
    });
});
</script>
<form method="post">
    <input type="text" name="searchQuery" id="search" placeholder="Search">
    <input type="text" name="name" id="" placeholder="Username">
    <input type="email" name="email" id="" placeholder="Email">
    <input type="text" name="message" id="" placeholder="Message">
    <input type="submit" name="button" value="Create">
</form>
<div id="results"></div>
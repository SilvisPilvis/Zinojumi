<?php
include_once("./db.php");
$dbConn= new DbConn();
$messages = $dbConn->getAllMessages();

// if(isset($_POST['button'])){
//     $dbConn->insertMessage($_POST['name'],$_POST['email'],$_POST['message']);
// }
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

    // $("#form").submit(function(e) {
    //     e.preventDefault(); // avoid to execute the actual submit of the form.
    //     $.ajax({
    //         type: "POST",
    //         url: 'search.php',
    //         data: {
    //             name: $('#name').val(),
    //             email: $('#email').val(),
    //             message: $('#message').val()
    //         },
    //         success: function(data)
    //         {
    //             console.log(data);
    //         },
    //         error: function(error) { 
    //             console.error(error);
    //         }
    //     });
    // });
});
</script>
<input type="text" name="searchQuery" id="search" placeholder="Search">
<form method="post" id="form">
    <input type="text" name="name" id="name" placeholder="Username">
    <input type="email" name="email" id="email" placeholder="Email">
    <input type="text" name="message" id="message" placeholder="Message">
    <input type="submit" name="button" value="Create">
</form>
<div id="results"></div>
<script>
    $("#form").submit(function(e) {
        e.preventDefault();
        // console.log($('#name').val()); // avoid to execute the actual submit of the form.
        $.ajax({
            type: "POST",
            url: 'search.php',
            data: {
                name: $('#name').val(),
                email: $('#email').val(),
                message: $('#message').val()
            },
            success: function(data)
            {
                console.log(data);
                $('#results').html(data);
            },
            error: function(error) { 
                console.error(error);
            }
        });
    });
    // $('#form').submit(function(event){
    //     event.preventDefault();
    // });
</script>
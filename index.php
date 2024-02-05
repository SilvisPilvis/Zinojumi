<?php
include_once("./db.php");
$dbConn= new DbConn();
$messages = $dbConn->getAllMessages();
?>
<link rel="stylesheet" href="style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div id="results" class="flex row gap">
<?php foreach($messages as $message){?>
    <div class="message flex col">
        <p><?= $message['name'] ?></p>
        <p><?= $message['email'] ?></p>
        <p><?= $message['message'] ?></p>
    </div>
<?php } ?>
</div>
<script>
    $(document).ready(function(){
    $('#search').on('input', function(){
        var searchQuery = $(this).val();
        if (searchQuery.length >= 0) {
            $.ajax({
                url: 'search.php',
                type: 'POST',
                data: {
                    searchQuery: searchQuery,
                    order: $('#order').val(),
                    criteria: $('#criteria').val()
                },
                success: function(data){
                    console.log(data);
                    $('.message').find().remove();
                    $('#results').html(data);
                }
            });
        } else {
            $('#results').html('<div class="message"><p>Result not Found.</p></div>');
        }
    });

    $('#order').on('change', function(){
        var searchQuery = $('#search').val();
        if (searchQuery.length >= 0) {
            $.ajax({
                url: 'search.php',
                type: 'POST',
                data: {
                    searchQuery: searchQuery,
                    order: $('#order').val(),
                    criteria: $('#criteria').val()
                },
                success: function(data){
                    console.log(data);
                    $('.message').find().remove();
                    $('#results').html(data);
                }
            });
        } else {
            $('#results').html('<div class="message flex col"><p>Result not Found.</p></div>');
        }
    });

    $('#criteria').on('change', function(){
        var searchQuery = $('#search').val();
        if (searchQuery.length >= 0) {
            $.ajax({
                url: 'search.php',
                type: 'POST',
                data: {
                    searchQuery: searchQuery,
                    order: $('#order').val(),
                    criteria: $('#criteria').val()
                },
                success: function(data){
                    console.log(data);
                    $('.message').find().remove();
                    $('#results').html(data);
                }
            });
        } else {
            $('#results').html('<div class="message flex col"><p>Result not Found.</p></div>');
        }
    });
});
</script>

<div class="flex col gap align inputs">
    <select name="criteria" id="criteria">
        <option value="name">Username</option>
        <option value="message">Message</option>
        <option value="created">Created</option>
    </select>
    <select name="order" id="order">
        <option value="ASC">Ascending</option>
        <option value="DESC">Descending</option>
    </select>
    <input type="text" name="searchQuery" id="search" placeholder="Search">
    <form method="post" id="form" class="flex col gap align">
        <input type="text" name="name" id="name" placeholder="Username">
        <input type="email" name="email" id="email" placeholder="Email">
        <input type="text" name="message" id="message" placeholder="Message">
        <input type="submit" name="button" value="Create">
    </form>
    <div class="error" hidden>Please fill all the fields</div>
</div>

<script>
    $("#form").submit(function(e) {
        if($('#name').val().length < 1 || $('#email').val().length < 1 || $('#message').val().length < 1)
        {
            $('.error').show();
            return false;
        }else{
            $('.error').hide();
        }
        
        e.preventDefault();
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
                $('#results').append(`<div class="message flex col"><p>${$('#name').val()}</p><p>${$('#email').val()}</p><p>${$('#message').val()}</p></div>`);
            },
            error: function(error) { 
                console.error(error);
            }
        });
    });
</script>
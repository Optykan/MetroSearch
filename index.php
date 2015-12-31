<?php 
define('auth', 'yes');
include("verify.php"); 
?>

    <!DOCTYPE html>

    <html lang="en-US">

    <head>
        <meta charset="UTF-8">

        <title>MetroSearch</title>
        <!-- FONTS -->
        <link href='https://fonts.googleapis.com/css?family=Raleway:200' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="css/home.css" rel="stylesheet">
        <link href="css/snow.css" rel="stylesheet">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
        <script src="js/home.js"></script>

    </head>

    <body class='snow'>
        <div class="container">
            <center>
                <h1 class="header">Metro Search</h1>
                <form id="form" class="valign">
                    <input type="text" name="inputname" id="inputname" class="search" placeholder="name" required>
                    <i onclick='verify(callback);' class="fa fa-angle-right icon-ready"></i>
                </form>
                <h1 class="error" id="error"></h1>
            </center>
        </div>
        <script>
            $("#form").keypress(function (e) {
                if (e.keyCode === 13) {
                    e.preventDefault();
                    verify(callback);
                }
            });
        </script>
    </body>

    </html>
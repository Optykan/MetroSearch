<?php 
define('auth', 'yes');

#if user is looking for something don't display the main page
if(isset($_GET['inputname']))
    include("verify.php"); 
else
    #otherwise include the main page
    include("home.html");
?>
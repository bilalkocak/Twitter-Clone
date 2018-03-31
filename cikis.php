<?php 
    include('girisyap.php');
    session_destroy();
    header("Location: http://localhost/Twitter/index.php");
?>
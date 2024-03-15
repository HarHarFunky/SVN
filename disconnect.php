<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"])) {
    $username = $_POST["username"];
    
    exec("pkill -u $username")
    
    
}
header("Location: index.php");
exit();
?>
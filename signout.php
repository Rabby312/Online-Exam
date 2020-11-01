<?php
//sign out for user
session_start();
session_destroy();
header("Location: index.php");
?>

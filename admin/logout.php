<?php
session_start();
session_destroy();
header("Location: /cit17finalproject/php/login.php");
exit();
?>

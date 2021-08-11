<?php

session_start();
session_destroy();
header("Location: index.php");
setcookie("nr2", "");
exit;


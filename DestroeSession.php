<?php
ob_start(); // levanta memoria antes de iniciar 
session_start();
session_destroy();

header("Location: index.php");

exit;
ob_end_flush(); //limpara memoria.

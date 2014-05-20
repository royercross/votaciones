<?php
//Prueba usuario
session_start();
session_destroy();
header('Location: index.php');
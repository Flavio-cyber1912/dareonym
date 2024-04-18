<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn_number = 1;


if (!in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
    $conn_number = 2;
}



switch ($conn_number) {
    case 1: // locale
        $host_name = "localhost";
        $db_name = "db_dareonym"; // Cambiato il nome del database a "db_dareonym"
        $username = "root";
        $password = "";
        break;

    case 2: // altervista
        $host_name = "localhost";
        $db_name = "my_fpetrone"; // Cambiato il nome del database a "my_fpetrone"
        $username = "fpetrone";
        $password = "8tcQqPtPNrgU";
        break;
}
 
try {
    $db = new PDO("mysql:host=" . $host_name . ";dbname=" . $db_name, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR-001 : " . $e->getMessage());
}

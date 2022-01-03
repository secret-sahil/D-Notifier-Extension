<?php
$host = "localhost";
$username = "mrsa_root";
$password = "IpdFK8knob%ayFk*";
$database = "mrsa_api";
$message = "";
try {
    $db = new PDO("mysql:host=$host; dbname=$database", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    $message = $error->getMessage();
}

<?php
session_start();
require_once "db.php";
try {
     if (isset($_POST["login"])) {
          if (empty($_POST["username"]) || empty($_POST["password"])) {
               header("Location: login.php?errorcode=empty");
          } else {
               $query = "SELECT * FROM users WHERE username = :username AND password = :password";
               $statement = $db->prepare($query);
               $statement->execute(
                    array(
                         'username'     =>     $_POST["username"],
                         'password'     =>     $_POST["password"]
                    )
               );
               $count = $statement->rowCount();
               if ($count > 0) {
                    $_SESSION["username"] = $_POST["username"];
                    header("location:login_success.php");
               } else {
                    header("Location: login.php?errorcode=loginFailed");
               }
          }
     }
} catch (PDOException $error) {
     $message = $error->getMessage();
}
?>
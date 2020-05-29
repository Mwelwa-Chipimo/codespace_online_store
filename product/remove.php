<?php

//remove.php


session_start();
var_dump($_SESSION);
$username = $_SESSION["email"];
//Establish connection with the SQL database
require_once 'connect.php';


if(isset($_POST["action"])){

    $action = $_POST["action"];
    $book_code = $_POST["code"];
    $book_title = $_POST["title"];
    $book_author = $_POST["author"];
    $book_price = $_POST["price"];

    echo $book_code;
    echo $book_title;
    echo $book_author;
    echo $book_price;
    
    // sql to delete a record
    $sql = "DELETE FROM shopping_cart WHERE book_code='$book_code'";
    
    $result = mysqli_query($mysqli, $sql);  
}

echo ""
?>

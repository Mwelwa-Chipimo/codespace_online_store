<?php

    // Start the session
    session_start();

    $firstname = $_SESSION['firstname'];
    $id = $_SESSION['id'];


    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: userprofile/register.php");
        exit;
    }

    //Establish connection with the SQL database
    require_once 'connect.php';

    //Include task class.
    include_once 'product/product_card.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/book_store.css">
    
    
</head>

<body>


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container">
        <a class="navbar-brand" href="index.php">Books Store</a>
       
       <div class="navbar-header">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="logout.php">Logout
                <span class="sr-only">(current)</span>
                </a>
                <a class="nav-link" href="cart.php">Cart
                </a>
            </li>
            </ul>
        </div>
        </div>
    </nav>

    
    <!-- Header -->

    <header class="text-black">
        <div class="container text-center">
            <h1>Welcome to the Book Store</h1>
            <p class="lead">Have a look at the books we have to offer</p>
        </div>
    </header>


    <!-- Page Content -->

    <div class="container">
        <div class="row row-cols-1 row-cols-md-4">
            
        <!---------------------- SHOW BOOKS ------------------------>

        <?php

        //Build a resource
        $sql = "SELECT * FROM books";
        $result = mysqli_query($mysqli, $sql);


        //$row = mysqli_fetch_assoc($result);
        //var_dump($row);

        if(mysqli_num_rows($result) > 0) {

            
            //Loops through an associative array.
            while ($row = mysqli_fetch_assoc($result)) {
                
                $task_1 = new product_item($row["book_code"], $row["title"], $row["author"], $row["stock"], $row["price"], $row["image"]);
                $task_1->display_product_card();
                
                //var_dump($question);
                
            }
        } else {
            echo "There was a problem echoing out your question.";
        } 


        $mysqli -> close();

        ?>
    
        </div>
    </div>

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js" defer></script> <!-- Vue JS CDN -->

    <script>

$(document).ready(function () {

    $(document).on('click', 'a.addAction', function() {
        const action = 'add';
        console.log(action); 
        const book_code = $(this).data('book_code');
        console.log(book_code);
        const book_title = $(this).data('book_title');
        console.log(book_title);
        const book_author = $(this).data('book_author');
        console.log(book_author);
        const book_price = $(this).data('book_price');
        console.log(book_price);

        $.ajax({
            type: 'POST',
            url: 'product/action.php',
            data: {
                action: action,
                code: book_code,
                title: book_title,
                author: book_author,
                price: book_price
            },
            dataType: 'html',
            success: function(data) {
                alert("Product has been added to your cart");
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        })
    });

    $(document).on('click', 'a.deleteAction', function() {
        const action = 'delete';
        console.log(action); 
        const book_code = $(this).data('book_code');
        console.log(book_code);

        $.ajax({
            type: 'POST',
            url: 'product/remove.php',
            data: {
                action: action,
                code: book_code,
            },
            dataType: 'html',
            success: function(data) {
                alert("Item removed");
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        })
    })

});



    </script>
    
</body>
</html>
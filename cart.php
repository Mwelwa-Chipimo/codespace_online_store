<?php

    // Start the session
    session_start();
   

    $username = $_SESSION['email'];
    $firstname = $_SESSION['firstname'];
    $id = $_SESSION['id'];
   

    

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
    <title>Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/book_store.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> <!-- JQuery CDN -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js" defer></script> <!-- Vue JS CDN -->    
</head>

<body>


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container">
        <a class="navbar-brand" href="index.php">Book Store</a>
       
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
    </nav>

    
    <!-- Header -->

    <header class="text-black">
        <div class="container text-center">
            <h1>This is your Shopping Cart</h1>
        </div>
    </header>


    <!-- Page Content -->

    <div class="container">
        <div class="row">
        <aside class="col-lg-9">
            <div class="card">

            <div class="table-responsive">

            <table class="table table-borderless table-shopping-cart">
            <thead class="text-muted">
            <tr class="small text-uppercase">
            <th scope="col">Product</th>
            <th scope="col" width="120">Quantity</th>
            <th scope="col" width="120">Price</th>
            <th scope="col" class="text-right d-none d-md-block" width="200"> </th>
            </tr>
            </thead>
            <tbody>

        <!---------------------- SHOW CART ITEMS ------------------------>
        <?php

        //Build a resource
        $sql = "SELECT * FROM shopping_cart WHERE username ='$username' ";
        $result = mysqli_query($mysqli, $sql);

        if(mysqli_num_rows($result) > 0) {
 
            //Loops through an associative array.
            while ($row = mysqli_fetch_assoc($result)) {
                
                $task_1 = new product_item($row["book_code"], $row["title"], $row["author"], $row["stock"], $row["price"], $row["image"]);
                $task_1->product_cart_view();
                
            }
        } else {
            echo "There was a problem echoing out your question.";
        } 

        $mysqli -> close();
        ?>
        </tbody>
            </table>
            </div> <!-- table-responsive.// -->
            </div> <!-- card.// -->
        </aside> <!-- col.// -->

        <aside class="col-lg-3">
            <div class="card">
            <div class="card-body">
                    <dl class="dlist-align">
                    <dt>Total price:</dt>
                    <dd class="text-right">$69.97</dd>
                    </dl>
                    <hr>
                    <p class="text-center mb-3">
                        <img src="bootstrap-ecommerce-html/images/misc/payments.png" height="26">
                    </p>
                    <a href="#" class="btn btn-primary btn-block"> Make Purchase </a>
                    <a href="#" class="btn btn-light btn-block">Continue Shopping</a>
            </div> <!-- card-body.// -->
            </div> <!-- card.// -->
        </aside> <!-- col.// -->
        </div>
    </div>

    <script>

    $(document).on('click', 'a.deleteAction', function() {
            const action = 'delete';
            console.log(action); 
            const book_code = $(this).data('book_code');
            console.log(book_code);

            $.ajax({
                type: 'POST',
                url: 'remove.php',
                data: {action: action, code: book_code,},
                dataType: 'html',
                success: function(data) {
                    alert("Item removed");
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            })
        });
    </script>

</body>
</html>
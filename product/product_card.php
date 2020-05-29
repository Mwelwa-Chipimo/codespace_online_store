<?php



class product_item{


    // P R O P E R T I E S

    public $book_code, $title, $author, $stock, $price, $image;


    //Set values of the properties above

    function __construct ($book_code, $title, $author, $stock, $price, $image) {
        $this->book_code = $book_code;
        $this->title = $title;
        $this->author = $author;
        $this->stock = $stock;
        $this->price = $price;
        $this->image = $image;
    }

    // M E T H O D S

    //This method will print out the product card item on the homepage.
    function display_product_card(){
        //Product Card Item (Bootstrap)
        echo    "<div class='col mb-3'>";
        echo       "<div class='card'>";   
        echo        "<img class='card-img-top' src='img/". $this->image .".jpg' alt='Card image cap'>";
        echo            "<div class='card-body'>";
        echo                "<h4 class='card-title'><a href='#'>" . $this->title ."</a></h4>";
        echo                "<h6>". $this->author ."</h6>";
        echo                "<h5>". $this->price ."</h5>";
        echo            "</div>";
        echo            "<div class='card-footer'>";
        echo            "<a id='". $this->book_code ."' class='btn text-white btn-primary btn-block addAction' data-book_code='". $this->book_code ."' data-book_title='". $this->title ."' data-book_author='". $this->author ."' data-book_price='". $this->price ."'>Add to cart</a>";
        echo            "</div>";
        echo            "</div>"; // Close card-body
        echo       "</div>"; // Close card class    
    }

    //This method displays the products that the user has added to their shopping cart.
    function product_cart_view() {

        echo 
        "<tr>
            <td>
                <figure class=\"itemside align-items-center\">
                    <div class=\"aside\"><img src=\"img/". $this->image .".jpg\" class=\"img-md\"></div>
                    <figcaption class=\"info\">
                        <a href=\"#\" class=\"title text-dark\">". $this->title ."</a>
                        <p class=\"text-muted small\">Author:". $this->author ."</p>
                    </figcaption>
                </figure>
            </td>
            <td>
                <select class=\"form-control\">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </td>
            <td>
                <div class=\"price-wrap\">
                    <var class=\"price\">". $this->price ."</var>
                    <small class=\"text-muted\">". $this->price ." each </small>
                </div> <!-- price-wrap .// -->
            </td>
            <td class=\"text-right d-none d-md-block\">
            <a data-original-title=\"Save to Wishlist\" title=\"\" href=\"\" class=\"btn btn-light\" data-toggle=\"tooltip\"> <i class=\"fa fa-heart\"></i></a>
            <a id='". $this->book_code ."' class='btn btn-primary btn-block text-white deleteAction' data-book_code='". $this->book_code ."'>Remove</a>

            </td>
        </tr>";

    }
}


?>


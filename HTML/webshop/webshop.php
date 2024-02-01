<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="../../js/admin.js"></script>

    <link rel="stylesheet" href="../../CSS/menu_footer/menu.css">
    <link rel="stylesheet" href="../../CSS/webshop/webshopT.css">
    <title>Webshop</title>
</head>
<header>
    <div id="bar"> 
        <img src="../../img/menu/logo.png" alt="logo" id="logo">

        <h1 id="menuHeader">Store:</h1>
        
        <div class="dropdown">
            <button class="dropbtn"><img src="../../img/menu/menu icon.png" id="menuPNG"></button>
            <div class="dropdown-content">
                <a href="../../index.html">Home</a>
                <a href="../livesteams/liveCams.html">LiveCams</a>
                <a href="../plattegrond.html">Map</a>
                <a href="#">WebShop</a>
                <a href="../tickets/tickets.html">TicketVerkoop</a>
                <a href="../review.php">Reviews</a>
                <a href="../news.html">Nieuws</a>
                <a href="../Contactpagina.html">Contact</a>
                <a href="../login.html">Admin?</a>
            </div>
          </div>
    </div>
</header>

<body>
    <div id="divall">
        <!--hier beginnen!!!-->
        <div id="div">
            </div>
                <div id="ProductWrapper">

                    <?php

                        $infoFile = fopen("../../data/webshop/test.txt", "a+");

                        if(isset($_POST["submit"])){

                            $name = "";
                            $price = "";
                            $img = "";

                            $name = $_POST["name"];
                            $price = $_POST["price"];

                            updateTXT($name, $price, $img);
                        }

                        //unofiical onload here :)
                        echo fread($infoFile, (filesize("../../data/webshop/test.txt") + 1));

                        error_reporting(0);
                        ini_set('display_errors', 0);


                        function updateTXT($name, $price, $img){
                            global $infoFile;
                            global $number;

                            //get and add a 1 to it that we can use
                            $number = (int)file_get_contents("../../data/webshop/counter.txt");
                            $number++;
                            file_put_contents("../../data/webshop/counter.txt", $number);


                            //update the txt file(s)

                            //save's the uploaded img in the img folder and rename it to $Number
                            //this way it is more easy to inject in js :( man no wonder why im singel...
                            $FileDir = "../../img/webshop/";
                            $FileLocation = $FileDir . basename($_FILES["file"]["name"]);
                            
                            move_uploaded_file($_FILES["file"]["tmp_name"], $FileLocation);
                            //rename the file
                            rename($FileDir . basename( $_FILES["file"]["name"]), $FileDir . $number . ".webp");
                            
                            
                            //write the needed code for the product to the TXT file
                            fwrite($infoFile, '
                            <PRODUCT>
                                <div id="product1">
                                    <p class="text">' . $name . '</p>
                                    <div id="img1">
                                        <button type="button" onClick="document.location=' . '#' . '"' .'class="btn">
                                            <img src="../../img/webshop/'. $number . '.webp" class="shop">
                                        </button>
                                    </div>

                                    <button type="button" class="addbtn" onclick="addToCart(' . "'" . $name . "'" .',' . $price . ',' . $number . ')">ADD</button>
                                    <div class="price">$' . $price . '</div>
                                    <button type="button" class="removeBTN" onclick="removeProduct()">REMOVE</button>
                                </div>
                            </PRODUCT>
                            '
                            );

                            fclose($infoFile);
                            
                            //refresh the page
                            header("Refresh:0");
                        }


                        //if we receve a sting via the post method 
                        //(from the javascript(we removed a review clientside))
                        if(isset($_POST['string'])){
                            //calls the UpdateReviews 
                            //with the paramethers we got from javasrcipt
                            UpdateReviews($_POST['string']);
                        }

                        function UpdateReviews($webshopCode){
                            $myFile = fopen("../../data/webshop/test.txt", "a+");
                            //emptys the file
                            file_put_contents("../../data/webshop/test.txt", "");
                            //write the sting in
                            fwrite($myFile, $webshopCode);
                        }
                    ?>

                </div>
            </div>

            <CART>
                <div id="cart">
                    <div class="heading">
                        <p id="heading1">PRODUCT</p>
                        <p id="heading2">PRICE</p>
                        <p id="heading3">AMOUNT</p>
                    </div>
                    
                    <PRODUCTEN>
                        <div id="producten">
                        </div>
                    </PRODUCTEN>
                </div>

                <TOTAL>
                    <div id="cartwrapper">
                        <p1 id="total">Total: $0.00</p1>
                        <button type="button" id="Buy" onClick="document.location='gegevens.html'">Buy Now</button>
                    </div>
                </TOTAL>

                <form action="" enctype="multipart/form-data" method="POST" id="ProductForm"> 
                    <input type="text" placeholder="name" name="name" id="ProductNameInput" value="test">
                    <input type="text" placeholder="price" name="price" id="ProductPriceInput">
                    <input type="file" placeholder="name" name="file" id="ProductImgInput">

                    <button type="submit" name="submit" id="ProductSubmitInput">SUBMIT</button>
                </form>

            </CART>
        </div>
    </div>



    <script>
        //DONT TOUCH, ME DONT KNOW WHAT IT IS BUT WILL BREAK WITHOUT :D
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        //Go futher here :)


        //unofiical onload here :)

        let logged = document.cookie;

        if(logged === "loggedin=true"){
            document.getElementById("ProductSubmitInput").style.display = "block";
            document.getElementById("ProductPriceInput").style.display = "block";
            document.getElementById("ProductNameInput").style.display = "block";
            document.getElementById("ProductImgInput").style.display = "block";
        }else{
            document.getElementById("ProductSubmitInput").style.display = "none";
            document.getElementById("ProductPriceInput").style.display = "none";
            document.getElementById("ProductNameInput").style.display = "none";
            document.getElementById("ProductImgInput").style.display = "none";
        }


        if(logged === "loggedin=true" ){
            let admin = true
            hideBTN(admin)
        }
        else{
            admin = false
            hideBTN(admin)
        }

        function hideBTN(admin){
            let deleteBTN = document.getElementsByClassName("removeBTN");
            let ProductForm = document.getElementById("ProductForm");

            for(i = 0; i < deleteBTN.length; i++ ){
                
                if(admin == true){
                    deleteBTN[i].style.display="block";
                    deleteBTN[i].style.opacity = "1"
                    
                    ProductForm.style.display="block";
                    ProductForm.style.opacity = "1"
                }else{
                    deleteBTN[i].style.opacity = "0"; 
                    ProductForm.style.opacity = "0";
                }
            }
        }


        //Removes the review admin client side
        var removeProductBTN = document.getElementsByClassName("removeBTN");
        removeProduct()

        function removeProduct(){
            //onclick
            var buttonClicked = event.target

            //removes the product client side
            buttonClicked.parentElement.parentElement.remove();

            //makes a string of all the code that is still there (without the removed one)
            let HtmlForm = document.getElementById("ProductWrapper");
            let HtmlFormString =  HtmlForm.innerHTML;
    
            //calls the php function that updates the txt file
            //we sent the code it needs to update with it
            $.ajax({
                url: 'webshop.php',
                type: 'POST',
                data: {string: HtmlFormString}
            })
        }
    </script>

    <script src="../../js/cart.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="../js/admin.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> 

    <link rel="stylesheet" href="../CSS/menu_footer/menu.css">
    <link rel="stylesheet" href="../CSS/review.css"> 
    <title>Reviews</title>
</head>
<header>
    <div id="bar"> 
        <img src="../img/menu/logo.png" alt="logo" id="logo">

        <h1 id="menuHeader">Reviews:</h1>
        
        <div class="dropdown">
            <button class="dropbtn"><img src="../img/menu/menu icon.png" id="menuPNG"></button>
            <div class="dropdown-content">
            <a href="../index.html">Home</a>
                <a href="livesteams/liveCams.html">LiveCams</a>
                <a href="plattegrond.html">Map</a>
                <a href="webshop/webshop.php">WebShop</a>
                <a href="tickets/tickets.html">TicketVerkoop</a>
                <a href="#">Reviews</a>
                <a href="news.html">Nieuws</a>
                <a href="Contactpagina.html">Contact</a>
                <a href="login.html">Admin?</a>
            </div>
        </div>
    </div>
</header>

<body>
    <div id="divall">
        <!--hier beginnen!!!-->   
        <form action="Review.php" method="POST">
            <h3 id="FormHeader">Share your review here!</h3>
            <input type="text" name="username" placeholder="username" id="username" required maxlength="10"><br>
            <input type="text" name="review" placeholder="review" id="review" required maxlength="100"><br>
            <label for="stars" id="starsL">Hoe many stars did we earn?</label><br>
            <input type="number" name="stars" value="1" min="1" max="5" placeholder="1" id="stars"><br>

            <button type="submit" name="submitBTN" id="submit">Post it</button>
        </form>

        <div id="reviewDIV">    
            <?php
                //a+ stands for read/write
                $myFile = fopen("../data/reviews.txt", "a+");
                readReview();

                function readReview(){
                    global $myFile;
                    //read the whole file out and shows the reviews on the web
                    echo fread($myFile, (filesize("../data/reviews.txt") + 1));
                }

                //if form is submitted, we get the input here and we set some vars to it
                if(isset($_POST["submitBTN"])){
                    $username = $_POST["username"];
                    $review = $_POST["review"];
                    $stars = $_POST["stars"];
                    //call the text function to update the text file
                    text();
                }

                function text(){
                    global $myFile;

                    global $username;
                    global $review;
                    global $stars;

                    $usernameclass = "usernameD";
                    $starTxt = "";

                    $TotalReview = "";

                    //this takes the form start input and translates it visa this
                    if($stars == 1){
                        $starTxt = 
                        '<img src="../img/review/Greenstar.png" id="s19_1" class="star" alt="Green">
                        
                        <img src="../img/review/Redstar.png" id="s19_5" class="star" alt="Red">
                        <img src="../img/review/Redstar.png" id="s19_5" class="star" alt="Red">
                        <img src="../img/review/Redstar.png" id="s19_5" class="star" alt="Red">
                        <img src="../img/review/Redstar.png" id="s19_5" class="star" alt="Red">';
                    }
                    else if($stars == 2){
                        $starTxt = 
                        '<img src="../img/review/Greenstar.png" id="s19_1" class="star" alt="Green">
                        <img src="../img/review/Greenstar.png" id="s19_2" class="star" alt="Green">
                        
                        <img src="../img/review/Redstar.png" id="s19_5" class="star" alt="Red">
                        <img src="../img/review/Redstar.png" id="s19_5" class="star" alt="Red">
                        <img src="../img/review/Redstar.png" id="s19_5" class="star" alt="Red">';
                    } 
                    else if($stars == 3){
                        $starTxt = 
                        '<img src="../img/review/Greenstar.png" id="s19_1" class="star" alt="Green">
                        <img src="../img/review/Greenstar.png" id="s19_2" class="star" alt="Green">
                        <img src="../img/review/Greenstar.png" id="s19_3" class="star" alt="Green">

                        <img src="../img/review/Redstar.png" id="s19_5" class="star" alt="Red">
                        <img src="../img/review/Redstar.png" id="s19_5" class="star" alt="Red">';
                    } 
                    else if($stars == 4){
                        $starTxt = 
                        '<img src="../img/review/Greenstar.png" id="s19_1" class="star" alt="Green">
                        <img src="../img/review/Greenstar.png" id="s19_2" class="star" alt="Green">
                        <img src="../img/review/Greenstar.png" id="s19_3" class="star" alt="Green">
                        <img src="../img/review/Greenstar.png" id="s19_4" class="star" alt="Green">

                        <img src="../img/review/Redstar.png" id="s19_5" class="star" alt="Red">';
                    } 
                    else if($stars == 5){
                        $starTxt = 
                        '<img src="../img/review/Greenstar.png" id="s19_1" class="star" alt="Green">
                        <img src="../img/review/Greenstar.png" id="s19_2" class="star" alt="Green">
                        <img src="../img/review/Greenstar.png" id="s19_3" class="star" alt="Green">
                        <img src="../img/review/Greenstar.png" id="s19_4" class="star" alt="Green">
                        <img src="../img/review/Greenstar.png" id="s19_4" class="star" alt="Green">';
                    }

                    //set the total reivew that we must add to the text here
                    $TotalReview =
                        '   <REVIEW>
                                <button type="button" class="DeleteBTN">Remove</button>
                                <div>
                                    <h3 class="' . $usernameclass . '">' . $username . ' said:</h3>
                                </div>

                                <div>
                                    <div class="reviewT">
                                        <p>' . $review . '</p>
                                    </div>

                                    <div class="starwrapper">
                                        ' . $starTxt . '
                                    </div>
                                </div>
                            </REVIEW>

                        ' ;

                    //write that review to the txtfile
                    fwrite($myFile, $TotalReview);
                    //displays the review that you just posted
                    echo $TotalReview;

                    //close this file
                    fclose($myFile);
                }
            ?>
        </div>

        <script type="text/javascript">
            //DONT TOUCH, ME DONT KNOW WHAT IT IS BUT WILL BREAK WITHOUT :D
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
            //Go futher here :)



            //Removes the review admin client side
            var removeReviewBTN = document.getElementsByClassName("DeleteBTN");
            removeReview()

            function removeReview(){
                    for(var i = 0; i < removeReviewBTN.length; i++) {
                    var button = removeReviewBTN[i]
                    button.addEventListener ('click', 
                    function(event) {
                        //onclick
                        var buttonClicked = event.target

                        //removes the review client side
                        buttonClicked.parentElement.remove();

                        //makes a string of all the code that is still there (without the removed one)
                        let reviewElement = document.getElementById("reviewDIV");
                        let reviewString = reviewElement.outerHTML;
                        
                        //calls the php function that updates the txt file
                        //we sent the code it needs to update with it
                        $.ajax({
                            url: 'Review.php',
                            type: 'POST',
                            data: {string: reviewString}
                        })
                    })
                }
            }

            //only shows the remove btn if loggedin
            let logged = document.cookie;
            console.log(logged)

            if(logged === "loggedin=true" ){
                let admin = true
                console.log(admin)
                hideBTN(admin)
            }
            else{
                admin = false
                console.log(admin)
                hideBTN(admin)
            }

            function hideBTN(admin){
                let deleteBTN = document.getElementsByClassName("DeleteBTN")

                for(i = 0; i < deleteBTN.length; i++ ){
                    
                    if(admin == true){
                        //alert("Show")
                        deleteBTN[i].style.display="block";
                        deleteBTN[i].style.opacity = "1"
                    }else{
                        //alert("Hide")
                        deleteBTN[i].style.opacity = "0"; 
                    }
                }
            }
        </script>

        <?php
        //if we receve a sting via the post method 
        //(from the javascript(we removed a review clientside))
        if(isset($_POST['string'])){
            //calls the UpdateReviews 
            //with the paramethers we got from javasrcipt
            UpdateShop($_POST['string']);
        }

        function UpdateShop($reviewcode){
            $myFile = fopen("../data/reviews.txt", "a+");
            //emptys the file
            file_put_contents("../data/reviews.txt", "");
            //write the sting in
            fwrite($myFile, $reviewcode);
        }
        ?>
</body>

</html>
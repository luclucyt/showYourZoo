var removeCartItemBtn = document.getElementsByClassName("removeFromCart");
removeFromCart()

function removeFromCart(){
    for(var i = 0; i < removeCartItemBtn.length; i++) {
        var button = removeCartItemBtn[i]
        button.addEventListener ('click', function(event) {
            var buttonClicked = event.target
            buttonClicked.parentElement.remove()
        })
    }
}


var addtocart = document.getElementsByClassName("btn1");
for(var i = 0; i < addtocart.length; i++) {

    var button = addToCart[i]
    button[i].addEventListener ('click', function(event) {
        addToCart()
    })
}

let Totalprice = 0;

function addToCart(ProductName, ProductPrice, ProductImage){
    var currentList = document.getElementById("producten").innerHTML

    document.getElementById("producten").innerHTML = currentList + '<div class="cartProduct"> <div class="pic"> <img src="../../img/webshop/' + ProductImage + '.webp" alt="mug" class="img"> <p class="name">' + ProductName + '</p> </div> <p class="priceCart">$' + ProductPrice + '</p> <input type="number" value="1" min="1" max="99" class="amount"> <button type="button" class="removeFromCart" onclick="updatePrice(' + ProductPrice +');">Remove</button> </div>'
    removeFromCart()

    Totalprice = Totalprice + ProductPrice;
    updatePrice(0);
}


function updatePrice(price){

    Totalprice = Totalprice - price;
    let TotalPrice = Totalprice.toFixed(2);

    console.log(Totalprice);
    document.getElementById("total").innerText = "Total: $" + TotalPrice;
}




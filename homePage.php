<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./homep.css">
    <title>Snap Up</title>
</head>

<body>
    <?php
    include('nav.php');
    ?>

    <div class="containers">
        <div class="item">
            <h1>Your Shopping <span>Adventure Begins</span> Here.</h1>
            <p>Shop your Favourite High Quality
                Organic Food Easily in a click </p>

            <button type="submit">
                <p>Shop Now</p>
            </button>


        </div>
        <div class="item"><img src="image/image1.jpg" alt="image1"></div>

    </div>
    <div class="short-desc">
        <h1>We bring the best <span>products</span> for our <span>customers.</span></h1>
        <p>Just a click away to have the best
            shopping experience ever</p>
        <hr>

    </div>


    <div class="header">
        <h2>New Arrivals</h2>
    </div>
    <div class="new-arrivals">

        <div class="row">
            <a href="#"> <img src="image/croissant.jpg" alt="croissant"></a>
            <!-- <div class="textblock">
      <h4><a href="#">croissant</a></h4>
    </div> -->
        </div>
        <div class="row">
            <div class="column">
                <a href="#"><img src="image/divinebites.jpg" alt="divinebites"></a>
                <!-- <div class="textblock">
        <h4><a href="#">Divine Bites</a></h4>
      </div> -->
                <a href="#"><img src="image/lobster.jpg" alt="lobster"></a>
                <!-- <div class="textblock">
        <h4><a href="#">Lobster</a></h4>
      </div> -->
            </div>
        </div>
        <div class="row">
            <a href="#"><img src="image/spinach.jpg" alt="spinach"></a>
            <!-- <div class="textblock">
      <h4><a href="#">Spinach</a></h4>
    </div> -->
        </div>
        <div class="row">
            <a href="#"><img src="image/bacon.jpg" alt="bacon"></a>
            <!-- <div class="textblock">
      <h4><a href="#">Bacon</a></h4>
    </div> -->
        </div>
    </div>
    <!-- new arrivals end here -->

    <!-- border line area -->
    <div class="border-line">
        <div class="line1">
            <hr>
        </div>
        <div class="text">
            <h2>Best Seller Of the Week</h2>

        </div>
        <div class="line2">
            <hr>
        </div>
    </div>

    <div class="best-seller">
        <div class="image-1">
            <img src="image/chicken.jpg" alt="chicken">
        </div>
        <div class="image-2">
            <img src="image/fish-fillet.jpg" alt="chicken">
        </div>
        <div class="image-3">
            <img src="image/asparagus.jpg" alt="chicken">
        </div>
        <div class="image-4">
            <img src="image/brownie.jpg" alt="chicken">
        </div>

        <div class="caption-1">
            <h4>Boneless Chicken</h4>
            <p>£ 1.32/Kilogram</p>
            <a class="btn btn-primary" onclick="addToCart()">Add to cart</a>
        </div>
        <div class="caption-2">
            <h4>Fish Fillets</h4>
            <p>£ 8.68/Kilogram</p>
            <a class="btn btn-primary" onclick="addToCart()">Add to cart</a>
        </div>
        <div class="caption-3">
            <h4>Asparagus</h4>
            <p>£ 9.58/Kilogram</p>
            <a class="btn btn-primary" onclick="addToCart()">Add to cart</a>
        </div>
        <div class="caption-4">
            <h4>Chocolate Brownie</h4>
            <p>£ 1.65/piece</p>
            <a class="btn btn-primary" onclick="addToCart()">Add to cart</a>
        </div>
    </div>


    <!-- border line area -->
    <div class="border-line">
        <div class="line1">
            <hr>
        </div>
        <div class="text">
            <h2>Recommended For You</h2>

        </div>
        <div class="line2">
            <hr>
        </div>
    </div>

    <!-- recommended for you starts here -->
    <div class="card-area">
        <div class="card-1">
            <div class="card">
                <img src="image/raspberry.jpg" class="card-img-top" alt="raspberry">
                <div class="card-body">
                    <h4 class="card-title"><b>Raspberry</b></h4>
                    <p class="card-text">Rich in vitamin A, C, K, manganese, potassium....</p>
                    <a href="#" class="btn btn-primary">See More</a>
                </div>
            </div>
        </div>

        <div class="card-2">
            <div class="card">
                <img src="image/chocolatecookie.jpg" class="card-img-top" alt="cookies">
                <div class="card-body">
                    <h4 class="card-title"><b>Chocolate Cookie</b></h4>
                    <p class="card-text">Contains brown sugar, eggs, flour, chocochips....</p>
                    <a href="#" class="btn btn-primary">See More</a>
                </div>
            </div>
        </div>

        <div class="card-3">
            <div class="card">
                <img src="image/mincedmeat.jpg" class="card-img-top" alt="mincedmeat">
                <div class="card-body">
                    <h4 class="card-title"><b>Minced Meat</b></h4>
                    <p class="card-text">Finely chopped for pie filling,dumplings and pie...</p>
                    <a href="#" class="btn btn-primary">See More</a>
                </div>
            </div>
        </div>

        <div class="card-4">
            <div class="card">
                <img src="image/cauliflower.jpg" class="card-img-top" alt="cauliflower">
                <div class="card-body">
                    <h4 class="card-title"><b>Cauliflower</b></h4>
                    <p class="card-text">Rich in fibres and vitamin B and C,cholesterol free...</p>
                    <a href="#" class="btn btn-primary">See More</a>
                </div>
            </div>
        </div>
    </div>


    <!-- border line area -->
    <div class="border-line" style="margin-top: 6vh;">
        <div class="line1">
            <hr>
        </div>
        <div class="text">
            <h2>How We Work</h2>

        </div>
        <div class="line2">
            <hr>
        </div>
    </div>

    <!-- how we work starts here -->
    <div class="how-we-work">
        <div class="step-1">
            <i class="fa fa-search"></i>
            <h4><b>Search</b></h4>
            <p>Search your favourite products from different categories through our site.</p>
        </div>
        <div class="step-2">
            <i class="fa fa-mobile"></i>
            <h4><b>Place Order</b></h4>
            <p>To place order, add your products to the cart or directly place order by clicking on buy now option.</p>
        </div>
        <div class="step-3">
            <i class="fa fa-credit-card"></i>
            <h4><b>Make Payment</b></h4>
            <p>Make payment using your PayPal account inorder to confirm your order placement.</p>
        </div>
        <div class="step-4">
            <i class="fa fa-shopping-bag"></i>
            <h4><b>Collect Order</b></h4>
            <p>Collect your goods from the shop after you receive your order confirmation email.</p>
        </div>
    </div>


    <?php
    include('footer.php');
    ?>
</body>

</html>


<script>
    function addToCart() {
        let cart = parseInt(document.getElementById("numberOfCart").innerHTML);
        cart = cart + 1;
        document.getElementById("numberOfCart").innerHTML = cart;
    }
</script>
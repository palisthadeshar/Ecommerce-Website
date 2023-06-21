<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./category.css">
    
    <title>Snap Up</title>
</head>
<body>
 
 <div class="wrapper">
        <!-- Sidebar Holder -->
      <nav  id="sidebar-trader" style="height:500px; width:250px;">
      
            <div class="col-lg-3 form">

                <img src="#">
                 <p>Trader Name</p>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <a href="#">Report</a>
            </li>
            <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">My Shop</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="traderProducts.php">Shop 1</a>
                        </li>
                        <li>
                            <a href="traderProducts.php">Shop 2</a>
                        </li>
                    </ul>
                </li>
                <li>
                   <a href="addProduct.php">Add Product</a>
                 
                </li>
                <li>
                   <a href="addShop.php">Add New Shop</a>
                 
                </li>
                
            </ul>


           
        </nav>
			
					
</div>



    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js">
  </script>
  <!-- icon -->
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>

</html>

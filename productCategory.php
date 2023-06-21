<?php
session_start();
?>
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
	<?php
	include('nav.php');
	?>

	<section class="page-section">
		<?php
		if (isset($_GET['sucess'])) {
			echo "<h3 style='color:red; text-align:center'>Product added to cart</h3>";
		}

		if (isset($_GET['updated']) && $_GET['updated'] == true) {
			echo "<p>product updated sucessfully</p>";
		}

		if (isset($_GET['added']) && $_GET['added'] == true) {
			echo "<p>product added sucessfully</p>";
		}

		?>
		<div class="container">
			<div class="row">

				<div class="col-lg-3 col-md-3 col-sm-4 form">
					<h2 class="sidebar-title"><b>Snap Up</b></h2>
					<hr />
					<p class="sidebar-text">Buy your favourite products.</p>

					<div>&nbsp;</div>
					<div>&nbsp;</div>

					<h2 class="sidebar-title"><b>Search</b></h2>
					<hr />

					<div class="input-group mb-3">
						<form action="./Backend/search.php" method="POST" class="searchss" name="search">
							<input type="text" class="form-control" placeholder="Search product.." aria-label="Receipient's username" aria-describely="basic-addon2" name="searchinp">

							<div class="input-group-append" type="submit">
								<span class="input-group-text" id="basic-addon2" name="searchButton" onclick="searchCaller()"><i class="fa fa-search"></i></span>
							</div>
						</form>

					</div>

					<div>&nbsp;</div>
					<div>&nbsp;</div>

					<h2 class="sidebar-title"><b>Categories</b></h2>
					<hr />

					<?php
					include('./backend/connect.php');
					$sql = "SELECT * FROM PRODUCT_CATEGORY";
					$compiled = oci_parse($conn, $sql);
					oci_execute($compiled);

					while ($category = oci_fetch_array($compiled, OCI_ASSOC)) {

					?>
						<a href="./backend/sort.php?category=<?php echo $category['CATEGORY_ID'] ?>" class="sidebar-list"><?php echo $category['CATEGORY_NAME'] ?></a><br>
					<?php } ?>
					<div>&nbsp;</div>
					<div>&nbsp;</div>

					<h2 class="sidebar-title"><b>Price</b></h2>
					<hr />

					<form name="sortForm" action="./backend/sort.php" method="POST">
						<a href="./backend/sort.php?fetch=all" name="sort" class="sidebar-list" value="All"> All</a><br>

						<a href="./backend/sort.php?fetch=0-5" name="sort" class="sidebar-list" value="0-5">Under £5</a><br>

						<a href="./backend/sort.php?fetch=5-10" name="sort" class="sidebar-list" value="5-10">£5 to £10</a><br>

						<a href="./backend/sort.php?fetch=10-15" name="sort" class="sidebar-list" value="10-15"> £10 to £15</a><br>

						<a href="./backend/sort.php?fetch=15-20" name="sort" class="sidebar-list" value="15-20"> £15 to £20</a>
					</form>
				</div>
				<!--END  <div class="col-lg-3 form">-->

				<?php
				include('./backend/connect.php');

				$sql = "SELECT * FROM PRODUCT";
				$compiled_for_product = oci_parse($conn, $sql);
				oci_execute($compiled_for_product);
				$status = false;

				if (oci_fetch_array($compiled_for_product, OCI_ASSOC) == null) {
					echo "<h1 style='color:red;'>No products available</h1>";
					$status = true;
				} else {
					if (isset($_GET["category"])) {
						$category = $_GET['category'];
						if (!is_numeric($_GET["category"])) {
							echo "<h4 style ='color:red'> category id should be numeric </h4>";
							exit();
						}

						$category = $_GET["category"];
						$sql = "SELECT * FROM PRODUCT WHERE CATEGORY_ID = $category";
						$compiled = oci_parse($conn, $sql);
						oci_execute($compiled);
						if (oci_fetch_array($compiled, OCI_ASSOC) == null) {
							echo "<h1 style='color:red;'>No product of this category available</h1>";
							$status = true;
						}
					}
				}

				if (isset($_GET["search"])) {
					$inp = strtoupper($_GET["search"]);
					$sql = "SELECT *  FROM PRODUCT WHERE PRODUT_NAME LIKE '%$inp%'";
					$compiled = oci_parse($conn, $sql);
					oci_execute($compiled);
				}

				if (isset($_GET["price"])) {
					if (strpos($_GET["price"], "-") == false && $_GET["price"] != "all") {

						echo " <h4 style ='color:red'> The convention to write price does not match please select links below to sort products</h4>";
						exit();
					}

					$prices = array(0 => "0", 1 => "0");
					$sql = "SELECT * FROM PRODUCT";

					if ($_GET["price"] != "all") {
						$prices = explode("-", $_GET["price"]);
						$sql = "SELECT *  FROM PRODUCT WHERE PRICE >= $prices[0] AND PRICE <= $prices[1]";
					}

					$compiled = oci_parse($conn, $sql);
					oci_execute($compiled);
				}

				?>
				<div class="col-lg-9 col-md-9 col-sm-8" style="padding-left: 30px;">

					<!-- Sorting by <div class="row"> -->
					<div>&nbsp;</div>
					<div>&nbsp;</div>

					<div class="row">
						<?php

						$compiled_for_product = oci_parse($conn, $sql);
						oci_execute($compiled_for_product);

						while ($row = oci_fetch_array($compiled_for_product, OCI_ASSOC)) {
							$image = $row['IMAGE'];
							$status = true;
						?>
							<div class="col-sm-10 col-md-6 col-lg-4 " style="margin-bottom:2%;">
								<div class="card" style="height: 400px ;">
									<a href="./backend/productDetailBack.php?id=<?php echo $row['PRODUCT_ID'] ?>">
										<img src=<?php echo "./image/$image" ?> style="height: 140px;" class="card-img-top" class="product-image">
										<div class="card-body">
											<h5 class="card-title"><b><?php echo $row['PRODUT_NAME'] ?></b></h5>
											<p class="card-text small">description: <?php if (count_chars($row['DESCRIPTION']) > 21) {
																						echo substr($row['DESCRIPTION'], 0, 17) . "....";
																					}
																					?></p>
											<p class="tags">price: £ <?php echo $row['PRICE'] ?></p>
											<p class="tags">quantity: <?php echo $row['QUANTITY'] ?></p>


										</div>
									</a>
								</div>
							</div>
						<?php
						}
						?>

					</div>
					<!-- Sorting by <div class="row"> -->

					<?php
					if (!$status) {
						echo "<h1 style='color:red;'>Sorry couldn't find anything!</h1>";
					}
					?>


				</div>
				<!--END  <div class="col-lg-9">-->

			</div>
		</div>
	</section>
	<?php
	include('footer.php');
	?>


	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js">
	</script>
	<!-- icon -->
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>

</html>


<script>
	function searchCaller() {

		document.search.submit();

	}
</script>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.2/css/boxicons.min.css">
	<link rel="stylesheet" href="./trader.css">
	<title>Snap Up</title>
</head>

<body>
	<?php
	include('trader.php')
	?>
	<div class="col-lg-9" style="padding-left: 30px;">


		<div class="row mt-5">
			<div class="col-md-4 ml-sm-3 col-lg-4 ">
				<h2> My Products</h2>
			</div>


			<div class="col-md-4 ml-sm-3 col-lg-6">
				<div class="input-group ">
					<input type="text" class="form-control" placeholder="Search product.." aria-label="Receipient's username" aria-describely="basic-addon2">
					<div class="input-group-append">
						<span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
					</div>

				</div>
			</div>

			<div>&nbsp; &nbsp;</div>

			<?php
			include('./backend/connect.php');

			$sql = "SELECT * FROM PRODUCT WHERE SHOP_ID= $_GET[shop_id]";
			$compiled = oci_parse($conn, $sql);
			oci_execute($compiled);

			while ($row = oci_fetch_array($compiled, OCI_ASSOC)) {

			?>
				<div class="col-md-6 col-lg-6">
					<div class="card">
						<div class="card-body text-center">
							<img src="image/<?php echo $row['IMAGE'] ?>" class="product-image">
							<h5 class="card-title"><b><?php echo $row['PRODUT_NAME'] ?></b></h5>
							<p class="card-text small"><?php echo $row['DESCRIPTION'] ?></p>
							<p class="tags">Price £ <?php echo $row['PRICE'] ?></p>
							<a href="./backend/productDetailBack.php?traproid=<?php echo $row['PRODUCT_ID'] ?>" target=" _blank" class="btn btn-success button-text"> <i class="fas fa-edit"></i></a>
							<a href="./backend/TraderDeleteProduct.php?traproid=<?php echo $row['PRODUCT_ID'] ?>" target="_blank" class="btn btn-success button-text"><i class="fa fa-trash" aria-hidden="true"></i> </a>
						</div>

					</div>
				</div>

			<?php } ?>

			<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>

</html>
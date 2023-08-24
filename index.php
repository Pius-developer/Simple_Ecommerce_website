
<?php

// Start Session
  session_start();

  require_once('php/component.php');

  require_once('php/classDb.php');

  // Creating instance of my classdb

  $database = new CreatDb("ProductDb", "ProductTb");
  if (isset($_POST['add'])) {
  	
  	// print_r($_POST['product_id']);

  	if (isset($_SESSION['cart'])) {
  		
  		$item_array_id = array_column($_SESSION['cart'], "product_id");

  		// checking product existence in the cart

  		if (in_array($_POST['product_id'], $item_array_id)) {
  			
  			echo"<script>alert('Product is already in the cart! ')</script>";

  			echo "<script>window.location = 'index.php'</script>";
  		}else{

  			$count = count($_SESSION['cart']);

  		    $item_array = array(

  		       'product_id' => $_POST['product_id']
  		    );

  		    $_SESSION['cart'][$count] = $item_array;

  		}



  	}else{

  		$item_array = array(

  			'product_id' => $_POST['product_id']
  		);

  		// Craeting New Session Variable

  		$_SESSION['cart'][0] = $item_array;

  		// print_r($_SESSION['cart']);
  	}
  }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Simple Shopping Cart</title>

	<!-- Boostrap cdn-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Font aewsome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>


	<?php

      require_once('php/header.php');
	?>


	<div class="container">
		<div class="row text-center py-5">

         <?php
           
           // component("Product1"," 599"," uploads/image1.jpg");

           // component("Product2"," 999"," uploads/image2.jpg");
           // component("Product3"," 1099"," uploads/image3.jpg");
           // component("Product4"," 2099"," uploads/image4.jpg");


           $result = $database->getData();

           while ($row = mysqli_fetch_assoc($result)) {
           	
           	 component($row['product_name'], $row['product_price'], $row['product_img'], $row['id']);


           }
         ?>

			
		</div>
	</div>



<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>

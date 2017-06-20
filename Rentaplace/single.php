<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>OpenRoom | Single</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-select.css">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<!--fonts-->
<link href='//fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!--//fonts-->	
<!-- js -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- js -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.js"></script>
<script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>
<script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
<link href="css/jquery.uls.css" rel="stylesheet"/>
<link href="css/jquery.uls.grid.css" rel="stylesheet"/>
<link href="css/jquery.uls.lcd.css" rel="stylesheet"/>
<!-- Source -->
<script src="js/jquery.uls.data.js"></script>
<script src="js/jquery.uls.data.utils.js"></script>
<script src="js/jquery.uls.lcd.js"></script>
<script src="js/jquery.uls.languagefilter.js"></script>
<script src="js/jquery.uls.regionfilter.js"></script>
<script src="js/jquery.uls.core.js"></script>

		<link rel="stylesheet" href="css/flexslider.css" media="screen" />
</head>
<body>
	<?php
		if(isset($_SESSION['email']))
			include 'includes/sessionHeader.php';
		else
			include 'includes/headerbanner.php';
	?>
		
		<?php 
			include'php/db.php';
			if(isset($_GET['single_id']))
			{
				
				$Query = "SELECT * FROM ads WHERE id = '$_GET[single_id]' ";
				$run = mysqli_query($connection,$Query);
				while($rows = mysqli_fetch_assoc($run))
				{
					$name = $rows['name'];
					$adTitle = $rows['adTitle'];
					$mobileNum = $rows['MobileNum'];
					$price = $rows['price'];
					$id = $rows['id'];
					$town = $rows['Town'];
					$date = $rows['date'];
					$photo = "php/uploads/".$rows['Photos'];
					//$photo1 = "php/uploads/".$rows['Photos1'];
					//$photo2 = "php/uploads/".$rows['Photos2'];
					$adDescription = $rows['adDescription'];
					$phoneNumber = $rows['MobileNum'];
					$price = $rows['price'];
				}
			}
		?>
	<!--single-page-->
	<div class="single-page main-grid-border">
		<div class="container">
			<div class="product-desc">
				<div class="col-md-7 product-view">
					<h2><?php echo $adTitle;?></h2>
					<p> <i class="glyphicon glyphicon-map-marker"></i><?php echo $town." | "."posted on ".$date; ?></p>
					<div class="flexslider">
						<ul class="slides">
						<?php
							//echo "<li data-thumb='$photo'>";
								echo"<img src='$photo' style='height:400px; width:800px;' />";
							//echo "</li>";
							/*echo "<li data-thumb='$photo1'>";
								echo"<img src='$photo1' />";
							echo "</li>";
							echo"<li data-thumb='$photo2'>";
								echo"<img src='$photo2' />";
							echo"</li>";*/
							?>
						</ul>
					</div>
					<div class="product-details">
						<h4>Name : <?php echo $name;?> </h4>
						<p><strong>Description</strong> : <?php echo $adDescription;?></p>
					
					</div>
				</div>
					<!-- FlexSlider
					  <script defer src="js/jquery.flexslider.js"></script>
					<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />

						<script>
					// Can also be used with $(document).ready()
					$(window).load(function() {
					  $('.flexslider').flexslider({
						controlNav: "thumbnails"
					  });
					});
					</script> 
					FlexSlider -->
					
				</div>
				<div class="col-md-5 product-details-grid">
					<div class="interested text-center">
						<div class="product-price">
							<span class="adprice"><?php echo "Price: ₦".$price;?></span>
							<div class="clearfix"></div>
						</div>
						<h4>Interested in this Ad?<small> Contact the Agent!</small></h4>
						<p><i class="glyphicon glyphicon-earphone"></i><?php echo $phoneNumber;?></p>
					</div>
						<div class="tips">
						<h4>Safety Tips for Students</h4>
							<ol>
								<li>NEVER PAY BEFORE SEEING THE ROOM.</li>
								<li>NEVER MEET WITH AGENT ALONE.</li>
								<li>ENSURE THE LOCALE IS SAFE BEFORE PAYING(Ask neighbours).</li>
								<li>Try to confirm the authenticity of the agent.</li>
								<li>Always request a receipt after payment.</li>
							</ol>
						</div>
				</div>
			<div class="clearfix"></div>
				<div class="container">
					<h2 style="color:#01a185;"> Related ads</h2>
					<?php
						$query = "SELECT * FROM ads WHERE Town = '$town'";
						$run = mysqli_query($connection, $query);
						$count = 0;
						while($rows = mysqli_fetch_assoc($run))
						{
							if($count < 3 && $rows['id'] != $id)
							{
								echo "
									<div class='col-md-3'>
									<div class='thumbnail'>
										<a href='single.php?single_id=$rows[id]'>
											<img src='php/uploads/$rows[Photos]' title='' alt='' style='width:100%; height:250px'/>
										 
										<div class='caption'>
											<h3 class='title'>$rows[adTitle]</h3>
											<span class='adprice'>₦ $rows[price]</span>
											<p>$rows[date]</p>
										</div>
										</a>
									</div>
								</div>
								";
							}
							$count++;
						}
					?>
				</div>
			</div>
			
			
		</div>
	</div>
	<!--//single-page-->
	<!--footer section start-->		
		<?php include 'includes/footer.php';?>
        <!--footer section end-->
</body>
</html>
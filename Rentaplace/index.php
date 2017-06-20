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
<title>OpenRoom</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-select.css">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/font-awesome.min.css" />
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Resale Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
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
</head>
<body>
	<?php
		if(isset($_SESSION['email']))
			include 'includes/sessionHeader.php';
		else
			include 'includes/headerbanner.php';
		?>
		<!-- content-starts-here -->
		<div class="content">
			<div class="categories">
				<div class="container">
				<h1 style="text-align: center; color: #01a185;">Trending rooms</h1>
				<div class='row'>
				<?php 
					include 'php/db.php';
					$count = 0;
					$result = mysqli_query($connection, "SELECT id,email,adTitle,adDescription,Photos,MobileNum,Town,date,price from ads");
					while($rows = mysqli_fetch_assoc($result))
					{	if($count <8)
						{
							echo "
								<div class='col-md-3'>
									<div class='thumbnail'>
										<a href='single.php?single_id=$rows[id]'>
											<img src='php/uploads/$rows[Photos]' title='' alt='' style='width:100%; height:200px'/>
										 
										<div class='caption'>
											<h3 class='title'>$rows[adTitle]</h3>
											<span class='adprice'>₦ $rows[price]</span>
											<p>$rows[date]</p>
										</div>
										</a>
									</div>
								</div>
								
							";
							$count++;
						}
					}
				?>
				</div>
					<div class="col-md-4 col-md-offset-5">
						<a class="account" href="real-estate.php" style="padding:10px; padding-left: 20px; padding-right: 20px;">
							View All
						</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			

			<!-- TODO: no mobile app yet
			<div class="mobile-app">
				<div class="container">
					<div class="col-md-5 app-left">
						<a href="mobileapp.html"><img src="images/app.png" alt=""></a>
					</div>
					<div class="col-md-7 app-right">
						<h3>Rentaplace App is the <span>Easiest</span> way for Selling and buying second-hand goods</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam auctor Sed bibendum varius euismod. Integer eget turpis sit amet lorem rutrum ullamcorper sed sed dui. vestibulum odio at elementum. Suspendisse et condimentum nibh.</p>
						<div class="app-buttons">
							<div class="app-button">
								<a href="#"><img src="images/1.png" alt=""></a>
							</div>
							<div class="app-button">
								<a href="#"><img src="images/2.png" alt=""></a>
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div> -->
		<!--footer section start-->		
		<?php include 'includes/footer.php';?>
        <!--footer section end-->
</body>
</html>